<?php
App::import('Model','AppSub');
class ParentGroup extends AppSub
{
	public $name = 'ParentGroup';
	public $useTable = 'groups';
	public $hasMany = array('Guest' => array('order' => array('Guest.sort','Guest.id')));
	
	public function getGroupList($cond = array())
	{
		$conditions = array();
		if($this->_user_id) $conditions[] = array('Group.user_id =' => $this->_user_id);
		$order = array('Group.sort','Group.id');
		return $this->find('all',compact('conditions','order'));
	}
}
?>