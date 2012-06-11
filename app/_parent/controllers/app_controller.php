<?php
/* SVN FILE: $Id: app_controller.php 7296 2008-06-27 09:09:03Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.controller
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7296 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-27 05:09:03 -0400 (Fri, 27 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake.libs.controller
 */
class AppController extends Controller
{
	public $components = array('Session','RequestHandler','TokenUtil');
	public $helpers = array('Html', 'Form', 'Session', 'Javascript');
	
	protected function _dieMsg($msg)
	{
		header('Content-Type:text/plain;charset=UTF-8');
		die($msg);
	}
	
	protected function _makeIniText($hash)
	{
		$ini_txt = '';
		foreach($hash as $ini_group => $subgroup){
			$ini_txt .= '['.$ini_group.']'."\n";
			foreach($subgroup as $key => $val){
				$ini_txt .= $key.' = '.$val."\n";
			}
			$ini_txt .= "\n";
		}
		return $ini_txt;
	}
	
	protected function _httpsRedirectByUA()
	{
		
	}
	
	protected function _judgeMypageSpace()
	{
		if($this->params['controller']=='programs'
		 && in_array($this->params['action'],array(
			
		))) return;
		
		if(in_array($this->params['controller'],array('mypages'))
			&& !$this->Session->check('AdminLogonFlg')
		){//ユーザーマイページ領域
			$sess = $this->Session->read('LogonFlg');
			if(!isset($sess) && !$sess){
				$this->Session->setFlash('セッションがタイムアウトしました。');
				$this->redirect('/auths');
			}
		}
	}
	
	protected function _judgeAdminSpace()
	{
		if($this->params['controller'] == 'admins'){
			$sess = $this->Session->read('AdminLogonFlg');
			if(!isset($sess['flg'])) $this->redirect('/admin_auths');
		}
	}
	
	protected function _validSession()
	{
		if(!preg_match('/\/admins\/(make_tex_file|generate_texs|generate_start)/',$_SERVER['REQUEST_URI']) && !$this->Session->valid()){
			e('セッションが切れているか不正です。自動的にトップページへリダイレクトします。');
			$this->redirect('/');
		}
	}
	
	protected function _setUserInfo()
	{
		if(!in_array($this->params['controller'],array('mypages','batches'))) return;
		$this->_u_info = $this->Session->read('UserInfo.User');
		foreach($this->uses as $model){
			$this->$model->setUserId($this->_u_info['id']);
			$this->$model->setUserInfo($this->_u_info);
		}
		return;
	}
	
	protected function _globalAssign()
	{
		$this->set('whose_map',Configure::read('whose_map'));
	}
	
	public function beforeFilter()
	{
		$_GET    = _protector_sanitize( $_GET ) ;
		$_POST   = _protector_sanitize( $_POST ) ;
		$_COOKIE = _protector_sanitize( $_COOKIE ) ;
		
		// セッション鍵を利用したXSS, HTTPレスポンス分割対策
		// POST や URIに埋め込まれたセッション鍵はあえて無視する
		//ini_set( 'session.use_only_cookies' , 1 ) ;
		// セッション固定攻撃を避けるためには、ここより下の３行をコメントアウトする。
		//if ( ! empty( $_GET[ session_name() ] ) && empty( $_COOKIE[ session_name() ] ) && ! preg_match( '/[^0-9A-Za-z,-]/' , $_GET[ session_name() ] ) ) {
		//    $_COOKIE[ session_name() ] = $_GET[ session_name() ] ;
		//}
		
		// PHP_SELFを利用したXSSおよびHTTPレスポンス分割攻撃への対策
		$_SERVER['PHP_SELF'] = strtr( @$_SERVER['PHP_SELF'] , array('<'=>'%3C','>'=>'%3E',"'"=>'%27','"'=>'%22' , "\r" => '' , "\n" => '' ) ) ;
		$_SERVER['PATH_INFO'] = strtr( @$_SERVER['PATH_INFO'] , array('<'=>'%3C','>'=>'%3E',"'"=>'%27','"'=>'%22' , "\r" => '' , "\n" => '' ) ) ;
		
		$this->viewPath = str_replace('parent_','',$this->viewPath);
		
		$this->_httpsRedirectByUA();//携帯端末以外からのアクセスはHTTPSに束縛
		$this->_judgeAdminSpace();//管理者ログオンを要するページのチェック
		$this->_judgeMypageSpace();//一般ユーザーのログオンを要するページ（マイページ）のチェック
		$this->_validSession();//CSRF対策？
		
		$this->_setUserInfo();
		
		if(strpos($this->params['action'],'ajax')){
			$this->laytout = 'ajax';
			$this->autoRender = false;
		}
		if(isset($this->passedArgs['disp']) && $this->passedArgs['disp']=='thickbox'){
			$this->layout = 'thickbox';
		}
		$this->_globalAssign();
		$this->set('is_logon',$this->Session->check('LogonFlg')/* || $this->Session->check('AdminLogonFlg')*/);
		$this->TokenUtil->setToken($this);
	}
}



	function _protector_sanitize( $arr ){
		if ( is_array( $arr ) ) {
			// 変数汚染攻撃対策
			if ( ! empty( $arr['_SESSION'] ) || ! empty( $arr['_COOKIE'] ) || ! empty( $arr['_SERVER'] ) || ! empty( $arr['_ENV'] ) || ! empty( $arr['_FILES'] ) || ! empty( $arr['GLOBALS'] ) ) exit ;
			return array_map( '_protector_sanitize', $arr ) ;
		}
		
		// ヌルバイト攻撃対策
		return str_replace( "\0", "", $arr ) ;
	}

?>