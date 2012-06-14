<?php
App::import('Controller','AppSub');
class ParentMypagesController extends AppSubController
{
	public $name = 'ParentMypages';
	public $uses = array('Guest','Group','GroupGuest','User');
	public $components = array();
	public $helpers = array('Text');
	
	protected $_u_info = null;
	
	public function dev()
	{
//		foreach(range(1,60) as $num){
//			$rgst['Guest'] = array(
//				'user_id'=>1,'whose_guest'=>1,'affiliation2' => '友人'.$num,'name_sei'=>'招待','name_mei'=>'客男',
//			);
//			$rgst['Guest'] = array(
//				'user_id'=>1,'whose_guest'=>2,'affiliation2' => '友人'.$num,'name_sei'=>'招待','name_mei'=>'客子',
//			);
//			$this->Guest->create($rgst);
//			$this->Guest->save();
//		}
		
//		$conditions = array('Group.user_id =' => $this->_u_info['id']);
//		$gr_list = $this->Group->find('list',compact('conditions'));
//		$conditions = array('Guest.user_id =' => $this->_u_info['id']);
//		$gu_list = $this->Guest->find('list',compact('conditions'));
//		//prx($gr_list,$gu_list);
//		foreach($gr_list as $group_id){
//			$guest_10 = array_splice($gu_list,0,10);
//			foreach($guest_10 as $guest_id){
//				$this->GroupGuest->create($rgst = array(
//					'guest_id' => $guest_id,'group_id' => $group_id,
//					'template_type' => 1
//				));
//				$this->GroupGuest->save();
//			}
//		}
		
		
		die('complete');
	}
	
	public function beforeFilter()
	{
		parent::beforeFilter();
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
		$this->set('guest_list',$this->Guest->getNoBelongedGuestList());
		$this->set('group_list',$this->Group->getGroupList());
	}
	
	public function ajax_regist_relation()
	{
		$this->TokenUtil->checkToken($this);
		$bool = $this->GroupGuest->registRelation($this->params['form']);
		echo $bool ? 'success' : 'failure';
		exit;
	}
	
	public function ajax_regist_sort()
	{
		$this->TokenUtil->checkToken($this);
		if(!in_array($this->params['form']['model'],array('GroupGuest','Group'))) die('failure');
		$model = $this->params['form']['model'];
		$bool = $this->$model->updateSort($this->params['form']);
		echo $bool ? 'success' : 'failure';
		exit;
	}
	
	public function ajax_update_group_pos()
	{
		$this->TokenUtil->checkToken($this);
		$bool = $this->Group->updatePos($this->params['form']);
		echo $bool ? 'success' : 'failure';
		exit;
	}
	
	public function ajax_add_group()
	{
		$this->TokenUtil->checkToken($this);
		$g_info = $this->Group->addCustomGroup();
		echo $g_info ? json_encode($g_info['Group']) : 'failure';
		exit;
	}
	
	public function ajax_delete_group_unit()
	{
		$this->TokenUtil->checkToken($this);
		$bool = $this->Group->delete($this->params['form']['gid'],$cascade = false);
		echo $bool ? 'success' : 'failure';
		exit;
	}
	public function reset_relation()
	{
		$this->GroupGuest->resetRelation();
		$this->Session->setFlash('紐付けをリセットしました。');
		$this->redirect(array('action'=>'seat_mapping'));
	}
	
	public function switch_template()
	{
		$t_code = $this->passedArgs['template_type'];
		$this->User->setDefaultTemplate($t_code);
		$this->Session->write('UserInfo.User.template_type',$t_code);
		if($t_code) $this->Group->setEmptyGroupByTemplateOf($t_code);
		$this->redirect('seat_mapping');
	}
}
?>
