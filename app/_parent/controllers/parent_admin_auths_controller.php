<?php
App::import('Controller','AppSub');
class ParentAdminAuthsController extends AppSubController
{
	public $name = 'ParentAdminAuths';
	public $uses = array();
	public $component = array();
	
	public function index()
	{
		if(isset($this->data)){
			$this->data = h($this->data);
			$bool_core = ($this->data['AdminAuth']['id']==CORE_ID && $this->data['AdminAuth']['password']==CORE_PWD);
			$bool_admin = ($this->data['AdminAuth']['id']==ADMIN_ID && $this->data['AdminAuth']['password']==ADMIN_PWD);
			if($bool_core || $bool_admin){
				$this->Session->write('AdminLogonFlg',$bool_core ? '1' : '2');
				$this->redirect('/admins/');
			}else{
				$this->set('msg','ID・PWが誤っています');
			}
		}else{
			
		}
	}
	
	public function admin_ng(){}
	
	public function logout()
	{
		$_SESSION = array();
		session_destroy();
		$this->redirect('/');
	}
}
?>
