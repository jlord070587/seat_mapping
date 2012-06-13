<?php
App::import('Model','AppSub');
class ParentGuest extends AppSub
{
	public $name = 'ParentGuest';
	public $useTable = 'guests';
	public $GroupGuest = null;
	
	public $validate = array(
		'whose_guest'=>array('rule'=>'notEmpty','message'=>'区分は入力必須です。'),
		'name_sei'=>array('rule'=>'notEmpty','message'=>'姓は入力必須です。'),
		'name_mei'=>array('rule'=>'notEmpty','message'=>'名は入力必須です。'),
		'proper_title'=>array('rule'=>'notEmpty','message'=>'敬称は入力必須です。'),
	);
	
	public function getGuestOf($id)
	{
		$conditions = array('Guest.id =' => $id);
		return $this->find('first',compact('conditions'));
	}
	public function getGuestList($cond = array())
	{
		$conditions = array(
			'Guest.user_id =' => $this->_user_id,
		);
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
	
	public function deleteGuest($id)
	{
		try{
			$this->begin();
			$this->GroupGuest = ClassRegistry::init('GroupGuest');
			$conditions = array(
				'GroupGuest.guest_id =' => $id,
				'GroupGuest.user_id =' => $this->_user_id
			);
			$this->GroupGuest->deleteAll($conditions,$cascade = false);
			$this->delete($id,$cascade = false);
			$this->commit();
			return true;
		}catch(Exception $e){
			$this->rollback();
			return false;
		}
	}
}
?>