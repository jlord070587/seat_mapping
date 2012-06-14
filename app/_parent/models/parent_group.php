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
		$t_c_map = Configure::read('template.count');
		$conditions = array(
			'Group.user_id =' => $this->_user_id,
			'Group.template_type =' => $t_code
		);
		$cnt = $this->find('count',compact('conditions'));
		
		if($t_c_map[$t_code] == $cnt) return true;
		try{
			$this->begin();
			$add_cnt = $t_c_map[$t_code] - $cnt;
			for($i=0; $i<$add_cnt; $i++){
				$rec = array('Group'=>array(
					'user_id' => $this->_user_id,'template_type' => $t_code,
				));
				if($t_code == 'x'){
					$rec['Group']['custom_point'] = Configure::read('template.position.x.point.'.$i);
				}
				$rgst[] = $rec;
			}
			$this->saveAll($rgst);
			$this->commit();
			return true;
		}catch(Exception $e){
			$this->rollback();
			return false;
		}
	}
	
	public function updatePos($post)
	{
		try{
			$this->set('id',$post['gid']);
			$bool = $this->saveField('custom_point',$post['custom_point']);
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	
	public function addCustomGroup()
	{
		try{
			$rgst = array('Group'=>array(
				'user_id' => $this->_user_id,'template_type' => 'x','custom_point' => '10,10',
			));
			$this->save($rgst);
			$gid = $this->getLastInsertID();
			$conditions = array('Group.id =' => $gid);
			$group_info = $this->find('first',compact('conditions'));
			return $group_info;
		}catch(Exception $e){
			return false;
		}
	}
}
?>