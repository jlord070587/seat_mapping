<?php
/**
 * class TokenUtilComponent
 * トークン発行とチェック
 * @package cake
 * @copyright Copyright 2008 Yamaguchi prefecture 
 */
class ParentTokenUtilComponent extends Object
{
	/**
	* パブリックメソッド：フォーム認証のトークンを生成しセッションに登録
	* @access public
	* @param コントローラー(参照受け)
	*/
	public function setToken(&$controller)
	{
		if(!$controller->Session->check('token')) {
			$controller->Session->renew();
			$token = md5(uniqid(rand(),true));
			
			$controller->Session->write('token', $token);
		}else{
			$token = $controller->Session->read('token');
		}
		$controller->set('token',$token);
	}
	/**
	 * セッションのトークンとPostされてきたトークンの照合
	 * @access public
	 * @param mixed $controller コントローラー（参照受け）
	 * @param string $token ポストされてきたトークン
	 * @return string エラーページHTML（照合結果がfalseの場合）
	 */
	public function checkToken(&$controller, $token = null)
	{
		if($token == null){
			if(isset($controller->params['form']['token'])) $token = $controller->params['form']['token'];
		}
		if($controller->Session->check('token')) {
			if(!isset($token) || $controller->Session->read('token') !== $token) {
				$this->__print403ErrorPage();
			}
		}else{
			$this->__print403ErrorPage();
		}
		return;
	}

	/**
	* プライベートメソッド：403 Forbiddenエラーページ出力
	* @access private
	* @return string エラーページ
	*/
	protected function __print403ErrorPage()
	{
		header("HTTP/1.1 403 Forbidden");
		header("Content-Type:text/html;charset=utf-8");
		$error_page = '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">'."\n" .
				'<html>'."\n" .
				'<head>'."\n" .
				'<title>403 Forbidden</title>'."\n" .
				'</head>'."\n" .
				'<body>'."\n" .
				'<h1>Forbidden</h1>'."\n" .
				'<p>二重投稿もしくは不正な操作が検知されたので処理を停止しました。</p>'."\n" .
				'</body>'."\n" .
				'</html>';
		die($error_page);
	}
}
?>