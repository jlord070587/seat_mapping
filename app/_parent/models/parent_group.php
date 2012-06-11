<?php
App::import('Model','AppSub');
class ParentGroup extends AppSub
{
	public $name = 'ParentGroup';
	public $useTable = 'groups';
	
	public function getGroupList()
	{
		$this->bindModel(array('hasAndBelongsToMany'=>array('Guest')));
		$conditions = array(
			'Group.user_id =' => $this->_user_id,
			'Group.template_type =' => $this->_u_info['template_type'],
		);
		$order = array('Group.sort','Group.id');
		$list = $this->find('all',compact('conditions','order'));
		return $list;
	}
	
	public function setEmptyGroupByTemplateOf($t_code)
	{
		$t_c_map = Configure::read('template_count_map');
		$conditions = array(
			'Group.user_id =' => $this->_user_id,
			'Group.template_type =' => $t_code
		);
		$cnt = $this->find('count',compact('conditions'));
		if($t_c_map[$t_code] == $cnt) return true;
		try{
			$this->begin();
			$add_cnt = $t_c_map[$t_code] - $cnt;
			for($i=1; $i<=$add_cnt; $i++){
				$rgst[] = array('Group'=>array(
					'user_id' => $this->_user_id,'template_type' => $t_code,
				));
			}
			$this->saveAll($rgst);
			$this->commit();
			return true;
		}catch(Exception $e){
			$this->rollback();
			return false;
		}
	}
}
?>