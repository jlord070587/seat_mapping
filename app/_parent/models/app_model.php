<?php
/* SVN FILE: $Id: app_model.php 7296 2008-06-27 09:09:03Z gwoo $ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage		cake.cake.libs.model
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7296 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-27 05:09:03 -0400 (Fri, 27 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake.libs.model
 */
App::import('Lib', 'LazyModel');
class AppModel extends LazyModel
{
	protected $_user_id = null;
	protected $_u_info = null;
	
	public function setUserId($id)
	{
		$this->_user_id = $id;
	}
	public function setUserInfo($u_info)
	{
		$this->_u_info = $u_info;
	}
	protected $_progressBar;
	protected $_loop_total_count = 0;
	protected $_status_name = null;
	
	/**
	 * プログレスバーの総ステップ数をセット
	 * @access public
	 * @param integer $cnt プログレスバーの総ステップ数
	 * @return void
	 */
	public function setLoopTotalCount($cnt)
	{
		$this->_loop_total_count = $cnt;
	}
	/**
	 * 進捗監視対象の名称をセット
	 * @access public
	 * @param string $str 進捗監視対象の名称
	 * @return void
	 */
	public function set_status_name($str)
	{
		$this->_status_name = $str;
	}
	/**
	 * プログレスバー制御インスタンスを生成
	 * @access protected
	 * @return void
	 */
	protected function _init_progress()
	{
		App::import('Vendor','zend_init');
		App::import('Vendor','ProgressBar',array('file' => 'Zend'.DS.'ProgressBar.php'));
		App::import('Vendor','JsPush',array('file' => 'Zend'.DS.'ProgressBar'.DS.'Adapter'.DS.'JsPush.php'));
		
		$adapter = new Zend_ProgressBar_Adapter_JsPush();
		$adapter->setUpdateMethodName('Zend_ProgressBar_Update');
		$adapter->setFinishMethodName('Zend_ProgressBar_Finish');
		$this->_progressBar = new Zend_ProgressBar($adapter/*, 0, 100*/);
	}
	/**
	 * 現在ステップ数からパーセンテージ算出して返す
	 * @access protected
	 * @param integer $counter 現在ステップ数
	 * @return integer 進捗パーセンテージ
	 */
	protected function _get_percentage($counter)
	{
		$percentage = floor($counter * 100 / $this->_loop_total_count);
		return $percentage;
	}
	/**
	 * 指定モデルからレコード総数を返す
	 * @return integer
	 */
	public function getTotalCount()
	{
		$useModel = str_replace('Parent','',$this->name);
		if(!$count = Cache::read($useModel.'_total_count')){
			$conditions = array($useModel.'.session_category !=' => '固定イベント');
			$count = $this->find('count',compact('conditions'));
			Cache::write($useModel.'_total_count',$count);
		}
		return $count;
	}
	/**
	 * オーバーライド::DBレベルでのエラー発生時に呼ばれ、自前で例外を投げる
	 * @return void
	 */
	public function onError()
	{
		throw new Exception('exception!');
	}
	/**
	 * DBフィールド=>null...の配列を返す
	 * @return array
	 */
	public function getEmptyFieldArr()
	{
		$field_list = array_keys($this->schema());
		return array_combine(
			$field_list,
			array_pad(array(),count($field_list),null)
		);
	}
	/**
	 * ソート順を更新
	 * @param array $sort_ids IDの配列
	 * @return boolean
	 */
	public function updateSort($post)
	{
		$sort_ids = explode('#',$post['sort_str']);
		try{
			$this->begin();
			if($this->name=='Group'){
				foreach($sort_ids as $num => $g_id){
					$this->set('id',$g_id);
					$this->saveField('sort',$num+1);
				}
			}
			if($this->name=='GroupGuest'){
				$conditions = array(
					'GroupGuest.guest_id' => $sort_ids,
					'GroupGuest.user_id =' => $this->_user_id,
					'GroupGuest.template_type =' => $this->_u_info['template_type'],
				);
				$this->deleteAll($conditions,$cascade = false);
				foreach($sort_ids as $guest_id){
					$this->create($regist['GroupGuest'] = array(
						'user_id' => $this->_user_id,
						'guest_id' => $guest_id,
						'group_id' => $post['gid'],
						'template_type' => $this->_u_info['template_type'],
					));
					$this->save();
				}
			}
			$this->commit();
			return true;
		}catch(Exception $e){
			$this->rollback();
			return false;
		}
	}
	/**
	 * テンポラリ
	 */
	public function moveFile($path_set)
	{
		$bool_all = true;
		foreach($path_set as $path){
			if(!file_exists($path['from'])) continue;
			if($bool = copy($path['from'],$path['to'])) unlink($path['from']);
			$bool_all = $bool_all && $bool;
		}
		return $bool_all;
	}
	/**
	 * 独自SQLに組込む変数のMySQL用エスケープ処理
	 * @access public
	 * @param SQLに組込む対象となる変数
	 * @return MySQL用にエスケープした変数
	 */
	public function sql($data)
	{
		return mysql_real_escape_string($data);
	}
	
	/**
	 * カスタムバリデーション：文字数チェック
	 * @access public
	 * @param array $arg バリデーション対照値
	 * @return boolean
	 */
	public function check_length($arg,$max)
	{
		$message = strip_tags(current($arg));
		$len = mb_strlen($message, 'UTF-8');

		return ($len<=$max);
	}
	
	/**
	 * カスタムバリデーション：日付の妥当性チェック
	 * @access public
	 * @param array $arg バリデーション対照値
	 * @return boolean
	 */
	public function isDate($arg)
	{
		$v = current($arg);
		$date_arr = explode('-',$v);
		
		$year = (int)$date_arr[0];
		$month = (int)$date_arr[1];
		$day = (int)substr($date_arr[2],0,2);
		
		return checkdate($month,$day,$year);
	}
	
	/**
	 * カスタムバリデーション：同名登録ユーザーの存在チェック
	 * @access public
	 * @param string $arg バリデーション対象値
	 * @return $boolean
	 */
	public function isSameExistedName($arg)
	{
		if(isset($this->data['User']['id'])){return true;}
		$v = current($arg);
		$bool = $this->hasAny(array('user_name =' => $v));
		return !$bool;//存在したらNG
	}
}
?>