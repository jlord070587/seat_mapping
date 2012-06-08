<?php
class Progress extends Object
{
	public $_progressBar;
	public $_loop_total_count = 0;
	public $_status_name = null;
	
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
	public function _init_progress()
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
	public function _get_percentage($counter)
	{
		$percentage = floor($counter * 100 / $this->_loop_total_count);
		return $percentage;
	}
}
?>