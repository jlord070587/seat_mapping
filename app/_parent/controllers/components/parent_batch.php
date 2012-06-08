<?php
class ParentBatchComponent extends Object
{
	/**
	 * ユーザーID
	 */
	var $_user_id = null;
	/**
	 * 生成PDFの種類（スケジュール：schedule／抄録：program）
	 */
	var $_pdf_type = null;
	var $_comp_array = array();
	var $_with_idx = false;
	
	/**
	 * 処理ソースファイル名配列
	 */
	var $_files = array();
	/**
	 * 処理ソースファイル数
	 */
	var $_num = 0;
	/**
	 * エラーの有無
	 */
	var $_error_flag = false;
	/**
	 * エラー内容格納配列
	 */
	var $_error_array = array();
	/**
	 * コマンドの実行回数
	 */
	var $_cmd_cnt = 0;
	/**
	 * Texコマンドの返り値
	 */
	var $_cmd_result = '';
	
	function startup()
	{
	}
	/**
	 * ユーザーIDをセット
	 * @access public
	 * @param integer $uid ユーザーID
	 * @return void
	 */
	function setUserId($uid)
	{
		$this->_user_id = $uid;
	}
	/**
	 * 生成PDFの種類をセット（スケジュール／抄録）
	 */
	function setPdfType($type)
	{
		$this->_pdf_type = $type;
	}
	/**
	 * 演者索引出力フラグをセット
	 */
	function setWithIdx($with_idx)
	{
		$this->_with_idx = $with_idx;
	}
	/**
	 * メインルーチン
	 * @access public
	 * @return void
	 */
	function mainRoutin()
	{
		$this->__setProgressHTML();
		ob_start();
		$this->__getSourceFile();//Texソースファイルのパス一覧を取得
		$this->__assemblePDF();//ソース処理ルーチン
		ob_clean();
		ob_end_clean();
		
	}
	/**
	 * Texソースファイルのパス一覧を取得
	 * @access private
	 * @return void
	 */
	function __getSourceFile()
	{
		//ユーザーに関係なくまとめて処理したい場合に使用（この場合、拡張子「tex」のファイルをすべて処理する）
		//$this->_files = glob (TEX_SOURCE_DIR."/{*.tex}",  GLOB_BRACE);
		$name_part = (in_array($this->_pdf_type,array('sess_set','prog_set'))) ? session_id() : $this->_user_id;
		$source_path = sprintf('%s/%s_%s.tex',TEX_SOURCE_DIR,$this->_pdf_type,$name_part);
		if(file_exists($source_path)) $this->_files[] = $source_path;
		$this->_num = count($this->_files);
		if($this->_num == 0) die('<p>処理するTexソースがありません。TeXソース生成に失敗しているかもしれません。</p>'."\n");
		
	}
	/**
	 * ソース処理ルーチン
	 * @access private
	 * @return void
	 */
	function __assemblePDF()
	{
		//$this->__dispMessage("<p>".$this->_num."件の組版処理を開始します</p>\n");
		
		foreach($this->_files as $k => $filepath){
			$info = pathinfo(basename($filepath));
			// 拡張子を除くファイル名の取得
			//$file_name = $info['filename'];php5.02以降でないと取得できない
			$file_name = str_replace('.'.$info['extension'],'',$info['basename']);
			
			if(!file_exists($filepath)){
				die("指定されたTeXソースファイルが存在しません（".$file_name.".tex）");
			}
			
			//事前ごみ処理
			$this->__eraseDustFiles($file_name,'before');
			
			// platexコマンド（2回実施）
			$this->__texCmdExec($file_name,'platex');
			$this->_cmd_result = $this->__texCmdExec($file_name,'platex');
			
			//演者索引作成
			if($this->_with_idx){
				// mendexコマンド（2回実施）
				$this->__texCmdExec($file_name,'mendex');
				$this->_cmd_result = $this->__texCmdExec($file_name,'platex');
			}
			
			// PDF生成コマンド
			$this->__texCmdExec($file_name,'dvipdfmx');
			
			// エラー確認
			$this->__errorLogCheck($file_name);
			
			// 各種ファイル移動
			$this->__moveFiles($file_name);
			
			//締めのメッセージ
			$this->__closeMessage();
		}
	}
	/**
	 * Texコマンド実行
	 * @access private
	 * @param string $file_name ソースファイル名（拡張子なし）
	 * @param string $cmd_type コマンド名
	 * @return string コマンド実行結果
	 */
	function __texCmdExec($file_name,$cmd_type)
	{
		switch($cmd_type){
			case 'platex':// Texコンパイル
				$cmd = sprintf("platex --kanji=utf8 %s", $file_name.".tex");
				if($this->_cmd_cnt == 0) $opt = array('width'=>array(0,100),'stat'=>'パーシング');
				if($this->_with_idx){
					if($this->_cmd_cnt == 1) $opt = array('width'=>array(100,140),'stat'=>'目次生成');
					if($this->_cmd_cnt == 2) $opt = array('width'=>array(160,180),'stat'=>'索引生成');
				}else{
					if($this->_cmd_cnt == 1) $opt = array('width'=>array(100,180),'stat'=>'目次生成');
				}
				$this->_cmd_cnt++;
				break;
			case 'mendex':
				$cmd = sprintf("mendex -U %s", $file_name.'.idx');
				$opt = array('width'=>array(140,160),'stat'=>'索引抽出');
				break;
			case 'dvipdfmx':// PDF生成
				if($this->_pdf_type=='schedule'){
					$cmd= sprintf("dvipdfmx -l %s ", TEX_SOURCE_DIR.'/'.$file_name);
				}else{
					$cmd= sprintf("dvipdfmx -V 5 %s ", TEX_SOURCE_DIR.'/'.$file_name);
				}
				$opt = array('width'=>array(180,190),'stat'=>'ファイル書出');
				break;
		}
		$this->__dispStatusMessage('PDF生成コマンド実行中..'.$opt['stat'],$opt['width']);
		
		// 作業ディレクトリへ移動（chdirとexec両方必要）
		chdir(TEX_SOURCE_DIR);
		
		if(!IS_WINDOWS){
			$cd_cmd = 'cd '.TEX_SOURCE_DIR;
			exec($cd_cmd);
			// コマンドのパスの通し方がわからないため、愚直にフルパスで指定している...orz
			exec('export CMAPFONTS=/usr/share/ghostscript/8.15/Resource/CMap/');
			$cmd = '/usr/local/texlive/p2009/bin/i686-pc-linux-gnu/'.$cmd;
		}
		
		$cmd_result = exec($cmd);
		return $cmd_result;
	}
	/**
	 * エラー確認
	 * @access private
	 * @param string $file_name ソースファイル名（拡張子なし）
	 * @return void;
	 */
	function __errorLogCheck($file_name)
	{
		if(!file_exists(TEX_SOURCE_DIR.'/'.$file_name.".log")) return;
		
		$logfile = file(TEX_SOURCE_DIR.'/'.$file_name.".log");
		
		$error = '';$error_log = '';
		for($j=0;$j<count($logfile);$j++){
			if(preg_match('/^\!\s/i', $logfile[$j])){
				$this->_error_flag = true;
				$this->_comp_flag = false;
				$no = $j+1;
				$error = "エラー文書名({$file_name}.tex):";
				$error_log = "<a href=\"".PDF_OUT_URL."log/{$file_name}.log\" target=\"_blank\">";
				$error_log .= "{$file_name}.log</a>:line[{$no}]";
				$this->_error_array[] = $error.$error_log."<br />\n";
				$this->__dispMessage('<span style="color:red;" title="エラー発生:'.$logfile[$j].'">■</span>');
			}
		}
		return;
	}
	/**
	 * 各種ファイル移動
	 * @access private
	 * @param string $file_name ソースファイル名（拡張子なし）
	 * @return void
	 */
	function __moveFiles($file_name)
	{
		//PDFディレクトリへファイルコピー
		if(file_exists(TEX_SOURCE_DIR.'/'.$file_name.".pdf") && $this->_error_flag === false){
			
			$this->__dispStatusMessage('ファイル移動中..',100);
			$is_unit_pdf = in_array($this->_pdf_type,array('sess_unit','prog_unit'));
			//PDFをコピー
			if($is_unit_pdf){
				$dest_pdf_path = sprintf('%s/%s/%s.pdf',PDF_OUTPUT_DIR,$this->_pdf_type,$file_name);
			}else{
				$dest_pdf_path = sprintf('%s/%s.pdf',PDF_OUTPUT_DIR,$file_name);
			}
			copy(TEX_SOURCE_DIR.'/'.$file_name.".pdf", $dest_pdf_path);
			//ログファイルをコピー
			copy(TEX_SOURCE_DIR.'/'.$file_name.".log", TEX_LOG_DIR.'/'.$file_name.".log");
			//TeXソースをバックアップ
			copy(TEX_SOURCE_DIR.'/'.$file_name.".tex", FINISHED_TEX_SOURCE_DIR.'/'.$file_name.".tex");
			
			if($is_unit_pdf){
				$pdf_link = sprintf('%s%s/%s.pdf',PDF_OUT_URL,$this->_pdf_type,$file_name);
			}else{
				$pdf_link = sprintf('%s%s.pdf',PDF_OUT_URL,$file_name);
			}
			$pdf_dl_link = sprintf('%s/batches/download/pdf_type:%s/file:%s',ROOT_URL,$this->_pdf_type,$file_name);
			
			$closer = '<p style="text-align:center;margin-bottom:0;">' .
					'<a href="'.$pdf_link.'" target="_blank">' .
					'<img src="'.ROOT_URL.'/img/preview_bnr.png" alt="プレビュー" border="0" />' .
					'</a>　' .
					'<a href="'.$pdf_dl_link.'">' .
					'<img src="'.ROOT_URL.'/img/dl_bnr.png" alt="ダウンロード" border="0" />' .
					'</a>' .
					'</p>' .
					'</body>' .
					'</html>';
			//$closer .= '　<a href="'.TICKET_PRINT_URL.$this->_user_id.'">半券発行</a><br>';
			$this->__dispMessage(/*$js.*/$closer);
			
			
		}else{
			if(file_exists(TEX_SOURCE_DIR.'/'.$file_name.".log")){
				copy(TEX_SOURCE_DIR.'/'.$file_name.".log", TEX_LOG_DIR.'/'.$file_name.".log");
			
				$closer = '<p><pan style="color:red;">エラーが発生しました！' .
						'ログを確認してください(別ウィンドウ)</pan><br>' .
						'<a href="'.TEX_ROOT_URL.'pdf/log/'.$file_name.'.log" target="_blank">'.$this->_cmd_result.'</a></p>';
				$this->__dispMessage($closer);
			}
			$this->_comp_flag = false;
			$this->_error_flag = true;
		}
		
		//ごみ処理
		$this->__eraseDustFiles($file_name,'after');
		
		return;
	}
	/**
	 * エラー発生時は、ソース・ログなどをエラー専用ディレクトリにアーカイブする
	 * @return void
	 */
	function _makeErrorArchive()
	{
		if(in_array($this->_pdf_type,array('sess_unit','prog_unit'))){
			$filename_part = sprintf('%s/%s_%s',$this->_pdf_type,$this->_pdf_type,$this->_user_id);
		}else{
			$filename_part = sprintf('%s_%s',$this->_pdf_type,session_id());
		}
		$list = glob(TEX_SOURCE_DIR.'/'.$filename_part.'.{tex,log,ids}',GLOB_BRACE);
		$to_dir = sprintf('%s/error/%s',TEX_ROOT_DIR,date('YmdHis'));
		mkdir($to_dir,0777);
		foreach($list as $from_path){
			$to_path = sprintf('%s/%s',$to_dir,basename($from_path));
			if(copy($from_path,$to_path)) unlink($from_path);
		}
		return;
	}
	
	/**
	 * ごみ処理
	 * @access private
	 * @param string $file_name ソースファイル名（拡張子なし）
	 * @param string $phase 処理前or処理後
	 * @return void
	 */
	function __eraseDustFiles($file_name,$phase)
	{
		// 当該Texソースファイルの始末
		if($phase == 'after'){
			if($this->_error_flag) $this->_makeErrorArchive();
			@unlink(TEX_SOURCE_DIR.'/'.$file_name.".tex");
			@unlink(TEX_SOURCE_DIR.'/'.$file_name.".ids");
		}
		
		$dust_files = glob (
			TEX_SOURCE_DIR."/*$file_name.{log,pdf,dvi,aux,toc,idx,ilg,ind,aind,bind,aidx,bidx,cind,cidx,out}",
			GLOB_BRACE
		);
		
		if(!$dust_files) return;
		
		foreach($dust_files as $dustfile) {
//			if(preg_match('/\.(aind|[bc]idx)$/',basename($dustfile))){
//				$filename = basename($dustfile);
//				list($name_body,$ext) = explode('.',$filename);
//				copy($dustfile,TEX_SOURCE_DIR.'/parts/integ.'.$ext);
//			}
			@unlink($dustfile);
		}
		
		return;
	}
	/**
	 * 締めのメッセージ表示
	 * @access private
	 * @return void
	 */
	function __closeMessage()
	{
		if($this->_error_flag === false) {
			//$end_msg = '<p style="clear:both;">全'.$this->_num .'件の処理が正常に終了しました</p>';
			//$this->__dispMessage($end_msg);
			//$this->__dispStatusMessage('全'.$this->_num .'件の処理が正常に終了しました',200);
			$this->__dispStatusMessage('処理が正常に終了しました',200);
		}else{
			$ecnt = count($this->_error_array);
			$end_msg = '<p style="clear:both;">全'.$this->_num .'件の文書中に、'.$ecnt.'個のエラーがありました</p>' .
					'ログでエラー箇所を確認して下さい<br>';
			$this->__dispMessage($end_msg);
			for($k=0;$k<count($this->_error_array);$k++){
				$e = $k+1;
				$this->__dispMessage($e.".".$this->_error_array[$k]);
			}
		}
		$this->_stopExecTime();
		return;
	}
	/**
	 * バッファにメッセージ出力
	 * @access private
	 * @param string $msg メッセージ
	 */
	function __dispMessage($msg)
	{
		echo $msg;
		ob_flush();flush();
	}
	/**
	 * バッファにメッセージ出力＋プレグレスバー幅変更
	 * @return void
	 */
	function __dispStatusMessage($msg,$width)
	{
		$js = '';
		if(is_array($width)){
			for($i = $width[0];$i<=$width[1];$i++){
				$this->__dispStatusMessage($msg,$i);
			}
		}else{
			$js = '<script type="text/javascript">' .
					'pg_obj.status_msg.innerHTML = "'.$msg.'";' .
					'pg_obj.progress_img.width = '.$width.';' .
					'</script>'."\n";
		}
		echo $js;
		usleep(500);
		ob_flush();flush();
	}
	/**
	 * コマンド実行時間表示を停止
	 * @return void
	 */
	function _stopExecTime()
	{
		$js = '<script type="text/javascript">'."\n" .
				'<!--'."\n" .
				'document.getElementById("batchProgress").style.display = "none";'."\n" .
				'document.getElementById("execTime").style.display = "none";'."\n" .
				'clearInterval(interval_id);'."\n" .
				//'window.parent.document.getElementById("exec").disabled = "";'."\n" .
				'//-->'."\n" .
				'</script>';
		$this->__dispMessage($js);
	}
	/**
	 * バッチ処理開始前処理
	 * @return void
	 */
	function __setProgressHTML()
	{
		header("Content-Type:text/html; charset=UTF-8");
		$head = '<html><head>' .
				'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' .
				'</head><body>'."\n";
		$style = '<style type="text/css"><!--' ."\n" .
				'#execTime,#statusMsg {text-align:center;}' ."\n" .
				'#batchProgressWrap {position:relative;text-align:center;border:0px solid red;}' ."\n" .
				'#batchProgress {width:200px;text-align:left;margin-left:auto;margin-right:auto;border:1px solid #ccc;}' .
				'* html p,' ."\n" .
				'* html #batchProgressWrap {width:80%;}' ."\n" .
				' --></style>'."\n";
		$html = '<p id="execTime">初期化中</p>' .
				'<p id="statusMsg">初期化中</p>' .
				'<div id="batchProgressWrap"><div id="batchProgress"><img src="'.ROOT_URL.'/css/cssimg/animation_half.gif" id="progressImg" width="0" height="10" /></div></div>'."\n";
		$js = '<script type="text/javascript">'."\n" .
				'var pg_obj = function(){};'."\n" .
				'pg_obj.status_msg = document.getElementById("statusMsg");'."\n" .
				'pg_obj.progress_img = document.getElementById("progressImg");'."\n" .
				'var timeCounter = function(){
					var now = new Date().getTime();
					var disp_time = now - start_time;
					document.getElementById("execTime").innerHTML = (now - start_time) / 1000 + "秒";
				};
				var start_time = new Date().getTime();
				interval_id = setInterval(timeCounter,10);'."\n" .
				'</script>'."\n";
		
		echo $head.$style.$html.$js;
	}
}
?>