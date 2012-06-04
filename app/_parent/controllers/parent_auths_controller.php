<?php
App::import('Controller','AppSub');
class ParentAuthsController extends AppSubController
{
	public $name = 'ParentAuths';
	public $uses = array('User');
	
	
	public function index($uid = null)
	{
		if(isset($this->data)){
			$this->data = h($this->data);
			$conditions = array(
				'User.login_id =' => $this->data['User']['login_id'],
				'User.login_pwd =' => $this->data['User']['login_pwd'],
			);
		}elseif(isset($uid) && $this->Session->check('AdminLogonFlg')){
			$uid = (int)h($uid);
			$conditions = array('User.id =' => $uid);
		}else{
			$conditions = array('User.id =' => -1);
		}
		$u_info = $this->User->find('first',compact('conditions'));
		
		if($u_info){
			$this->Session->write('LogonFlg','1');
			$this->Session->write('UserInfo',$u_info);
			$this->redirect('/mypages');
			
			return;
		}else{
			if(!empty($this->data))$this->set('msg','ログインIDが誤っています。再度確認して入力してください。');
		}
	}
	
	public function logout()
	{
		if(isset($_POST['logout'])){
			$this->Session->delete('LogonFlg');
			$this->Session->delete('UserInfo');
			foreach($_SESSION as $k=>$v){
				if($k != 'Config')unset($_SESSION[$k]);
			}
			$this->redirect('/');	
		}
	}
	
	public function timeout(){}
}
?>
