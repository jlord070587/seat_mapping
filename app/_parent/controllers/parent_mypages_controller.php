<?php
App::import('Controller','AppSub');
class ParentMypagesController extends AppSubController
{
	public $name = 'ParentMypages';
	public $uses = array('Guest','Group');
	public $component = array();
	
	public function dev()
	{
		foreach(range(1,60) as $num){
//			$rgst['Guest'] = array(
//				'user_id'=>1,'whose_guest'=>1,'affiliation2' => '友人'.$num,'name_sei'=>'招待','name_mei'=>'客男',
//			);
			$rgst['Guest'] = array(
				'user_id'=>1,'whose_guest'=>2,'affiliation2' => '友人'.$num,'name_sei'=>'招待','name_mei'=>'客子',
			);
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
		$this->set('guest_list',$this->Guest->getGuestList($cond['group_id'] = null));
		$this->set('group_list',$this->Group->getGroupList());
	}
	
	public function sort_member()
	{
		$this->set('guest_list',
			$this->Guest->getGuestList($cond['group_id'] = $this->passedArgs['gid'])
		);
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
	
	public function ajax_regist_sort()
	{
		$this->TokenUtil->checkToken($this);
		if(!in_array($this->params['form']['model'],array('Guest','Group'))) die('failure');
		$model = $this->params['form']['model'];
		$bool = $this->$model->updateSort(explode('#',$this->params['form']['sort_str']));
		echo $bool ? 'success' : 'failure';
		exit;
	}
	
	public function reset_relation()
	{
		$this->Guest->resetRelation();
		$this->Session->setFlash('紐付けをリセットしました。');
		$this->redirect(array('action'=>'seat_mapping'));
	}
}
?>
