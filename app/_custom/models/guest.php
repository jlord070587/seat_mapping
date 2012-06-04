<?php
App::import('Model','ParentGuest');
class Guest extends ParentGuest
{
	public $name = 'ParentGuest';
	public $useTable = 'guests';
}
?>