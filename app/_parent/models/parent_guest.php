<?php
App::import('Model','AppSub');
class ParentGuest extends AppSub
{
	public $name = 'ParentGuest';
	public $useTable = 'guests';
	public $GroupGuest = null;
	
	public function getGuestList($cond = array())
	{
		$conditions = array();
		if($this->_user_id) $conditions[] = array('Guest.user_id =' => $this->_user_id);
		$conditions[] = array('Guest.group_id' => $cond['group_id'] ? $cond['group_id'] : NULL);
		return $this->find('all',compact('conditions'));
	}
	public function getNoBelongedGuestList()
	{
		$this->GroupGuest = ClassRegistry::init('GroupGuest');
		$related_guest_ids = $this->GroupGuest->getRelatedUserIds();
		$conditions = array(
			'Guest.user_id =' => $this->_user_id,
			'NOT' => array('Guest.id' => $related_guest_ids),
		);
		$order = array('Guest.id');
		return $list = $this->find('all',compact('conditions','order'));
	}
}
?>