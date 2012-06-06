<?php
App::import('Model','AppSub');
class ParentGuest extends AppSub
{
	public $name = 'ParentGuest';
	
	public function getGuestList($cond = array())
	{
		$conditions = array();
		if($this->_user_id) $conditions[] = array('Guest.user_id =' => $this->_user_id);
		if(isset($cond['group_id'])
			 || $cond['group_id']==null//何故かNULLのときはissetがfalseになるためこの条件を追加
		) $conditions[] = array('Guest.group_id' => $cond['group_id']);
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
}
?>