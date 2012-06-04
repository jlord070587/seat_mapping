<?php
App::import('Controller','AppSub');
class ParentMypagesController extends AppSubController
{
	public $name = 'ParentMypages';
	public $uses = array('Guest','Group');
	public $component = array();
	
	public function dev()
	{
		foreach(range(1,10) as $num){
			$rgst['Guest'] = array(
				'user_id'=>2,'whose_guest'=>1,'name_sei'=>'招待','name_mei'=>'客男'.$num
			);
//			$rgst['Guest'] = array(
//				'user_id'=>2,'whose_guest'=>2,'name_sei'=>'招待','name_mei'=>'客子'.$num
//			);
			$this->Guest->create($rgst);
			$this->Guest->save();
		}
		die('complete');
	}
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Guest->setUserId($this->Session->read('UserInfo.User.id'));
		$this->Group->setUserId($this->Session->read('UserInfo.User.id'));
	}
	
	public function index()
	{
		
	}
	
	public function enquete()
	{
		$this->_dieMsg('enqueteアクションのスタブ');
	}
	
	public function photo_select()
	{
		$this->_dieMsg('photo_selectアクションのスタブ');
	}
	
	public function seat_mapping()
	{
		$this->set('guest_list',$this->Guest->getGuestList());
		$this->set('group_list',$this->Group->getGroupList());
	}
	
	public function ajax_guest_list()
	{
		
	}
	
	public function ajax_regist_relation()
	{
		$this->TokenUtil->checkToken($this);
		$bool = $this->Guest->registRelation($this->params['form']);
		echo $bool ? 'success' : 'failure';
		exit;
	}
}
?>
