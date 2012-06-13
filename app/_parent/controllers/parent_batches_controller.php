<?php
App::import('Controller','AppSub');
class ParentBatchesController extends AppSubController
{
	public $name = 'ParentBatches';
	public $uses = array('Guest','Group');
	public $components = array('Tex','Batch');
	
	protected function _cleaning()
	{
		$del_list = glob(TEX_SOURCE_DIR.'/*{.log,.dvi,.aux,.toc,.idx,.aidx,.bidx,.ilg,.ind,.aind,.bind,.out}',GLOB_BRACE);
		if($del_list){
			foreach($del_list as $item){
				if(file_exists($item)) unlink($item);
			}
		}
		return;
	}
	
	/**
	 * 取得Texソースの微調整とファイル出力
	 * @access private
	 * @param array $result Texソース
	 * @return void
	 */
	protected function __requestActionAfterOperation($result)
	{
		//余分な0D（改行コード）の処置
		$result = str_replace("\x0D","\x0D\x0A",$result);
		$result = str_replace("\x0A\x0A","\x0A",$result);
		
		//目視でおかしいところを置き換える
		$result = $this->Tex->PinpointReplace($result);
		
		return $result;
	}
	
	/**
	 * ソース生成
	 */
	public function index()
	{
		ini_set('memory_limit','512M');
		App::import('Lib','Progress');
		$this->progress = new Progress();
		$this->progress->_init_progress();
		$this->progress->setLoopTotalCount($progress_loop = 5);
		//prx($type,$this->params);
		$i = 0;
		$this->output = '';
		$this->layout = null;
		$this->autoRender =false;
		
		$this->progress->_progressBar->update($this->progress->_get_percentage($i++), '処理を開始しました');
		$this->progress->_progressBar->update($this->progress->_get_percentage($i++), 'リストをロード中');
		$list = $this->Group->getGroupList($cond = array());
		$this->progress->_progressBar->update($this->progress->_get_percentage($i++), 'ソースを生成中');
		
		$this->set('list',$this->Tex->__filteringTex($list));
		
		$source = $this->render('floor_layout-'.$this->_u_info['template_type']);
		//prx($source);
		$source = $this->__requestActionAfterOperation($source);
		$this->progress->_progressBar->update($this->progress->_get_percentage($i++), 'ファイル出力中');
		file_put_contents(
			sprintf('%s/%03d.tex',TEX_SOURCE_DIR,$this->Session->read('UserInfo.User.id')),
			$source
		);
		
		$this->progress->_progressBar->update(100, 'ソースを取得完了');
		$this->progress->_progressBar->finish();
		ob_end_clean();
		die('complete');
	}
	
	public function batch()
	{
		$this->layout = false;
		$token = h($this->passedArgs['token']);
		//トークン照合
		if(!isset($token)){die('token_error:不正なアクセスです。');}
		//prx($this->passedArgs);
		
		$this->Batch->setUserId(sprintf('%03d',$this->_u_info['id']));
		$this->Batch->mainRoutin();
		
		exit;
	}
	
	public function download()
	{
		//トークン照合
//		if(!isset($this->params['named']['token'])){die('token_error:不正なアクセスです。');}
//		$this->TokenUtil->checkToken($this, h($this->params['named']['token']));
		
		$file_name = h($this->passedArgs['file']);
		$pdf_type = h($this->passedArgs['pdf_type']);
		if(in_array($pdf_type,array('sess_unit','prog_unit'))){
			$pdf_path = sprintf('%s/%s/%s.pdf',PDF_OUTPUT_DIR,$pdf_type,$file_name);
		}else{
			$pdf_path = PDF_OUTPUT_DIR.'/'.$file_name.'.pdf';
		}
		if(!file_exists($pdf_path)) die('PDFファイルが特定できません。');
		
		$buf = '';
		$buf = file_get_contents($pdf_path);
		header ("Content-disposition: attachment; filename=" . $file_name.'.pdf');
		header ("Content-type: application/octet-stream; name=" . $file_name);
		
		print($buf);
		exit;
	}
	/**
	 * 選択セッションIDまたは選択演題IDをセッションに登録（非同期）
	 * @param 
	 */
	public function ajax_regist_ids($type)
	{
		$this->laytout = 'ajax';
		$this->autoRender = false;
		if(!(isset($this->params['form']['mode'])
			&& $this->params['form']['mode']
			&& isset($this->params['form']['ids_str'])
			//&& $this->params['form']['ids_str']//0件に戻す場合はid_strはnull状態
			&& isset($this->params['form']['after_label'])
			&& $this->params['form']['after_label'])) die('missing param');
		
		$ids_on_session = $this->Session->read('selected_'.$type.'_ids');
		$posted_ids = explode('_',$this->params['form']['ids_str']);
		$ids_arr = array();
		if(!($this->params['form']['mode']=='all')){
			if($this->params['form']['after_label'] == '選択済'){
				foreach($posted_ids as $id){
					$ids_on_session[] = $id;
				}
				$ids_arr = array_unique($ids_on_session);
			}else{
				$ids_arr = array_diff($ids_on_session,$posted_ids);
			}
		}
		sort($ids_arr);
		$this->Session->write('selected_'.$type.'_ids',$ids_arr);
		echo count($ids_arr);exit;
	}
	
}
?>