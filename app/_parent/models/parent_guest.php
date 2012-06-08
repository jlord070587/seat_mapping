<?php
App::import('Model','AppSub');
class ParentGuest extends AppSub
{
	public $name = 'ParentGuest';
	
	public function getGuestList($cond = array())
	{
		$conditions = array();
		if($this->_user_id) $conditions[] = array('Guest.user_id =' => $this->_user_id);
		$conditions[] = array('Guest.group_id' => $cond['group_id'] ? $cond['group_id'] : NULL);
		return $this->find('all',compact('conditions'));
	}
	
	public function registRelation($post)
	{
		try{
			$this->set('id',$post['id']);
			$this->saveField('group_id',$post['gid']=='null' ? null : $post['gid']);
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	
	public function resetRelation()
	{
		try{
			$this->begin();
			$regist = array('Guest.group_id' => NULL,'Guest.sort' => 0);
			$conditions = array('Guest.user_id =' => $this->_user_id);
//			prx($this->find('list',compact('conditions')));
			$this->updateAll($regist,$conditions);
			$this->commit();
			return true;
		}catch(Exception $e){
			$this->rollback();
			return false;
		}
	}
}
?>