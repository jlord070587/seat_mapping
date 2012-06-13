<?php
App::import('Controller','AppSub');
class ParentGuestsController extends AppSubController
{
	public $name = 'ParentGuests';
	public $uses = array('Guest');
	
	public function index()
	{
		if(!empty($this->data)){
			$this->Guest->create($this->data);
			if($this->Guest->validates()){
				if($this->Guest->save()){
					$this->Session->setFlash('登録完了しました。');
					$this->redirect('index');
				}
			}else{
				$this->Session->setFlash('入力にエラーがあります。');
			}
		}
		$this->set('guest_list',$this->Guest->getGuestList());
	}
	
	public function ajax_get_guest_info()
	{
		$g_info = $this->Guest->getGuestOf(h($this->params['url']['id']));
		echo json_encode($g_info);
		exit;
	}
	public function ajax_delete_guest()
	{
		$this->TokenUtil->checkToken($this);
		$bool = $this->Guest->deleteGuest(h($this->params['form']['id']));
		echo $bool ? 'success' : 'failure';
		exit;
	}
}
?>
