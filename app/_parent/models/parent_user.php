<?php
App::import('Model','AppSub');
class ParentUser extends AppSub
{
	public $name = 'ParentUser';
	public $useTable = 'users';
	
	public function setDefaultTemplate($t_code)
	{
		try{
			$this->set('id',$this->_user_id);
			$this->saveField('template_type',$t_code);
			return true;
		}catch(Exception $e){
			return false;
		}
	}
}
?>