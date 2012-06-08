<?php 
class ParentTexComponent extends Object
{
	// TeX文字変換テーブル
	protected $tex_moji = array();
	
	public function startup()
	{
		require dirname(__FILE__).'/tex_map.php';
		$this->tex_moji = TexMap::getTexMap();
	}
	
	/**
	 * DBからの抄録本文の文字列を適切な実態参照もしくはTeX文字に置換可能な文字に置き換える
	 * @param string $html HTML文字列
	 * @return string
	 */
	public function html2tex($html)
	{
		$html = mb_convert_kana($html,'KV','UTF-8');
		
		// 先頭の改行タグは無し
		$html = preg_replace('/^(<br\s?\/?>)+/i', '', $html);
		
		/* TeX文字変換テーブルによるTeXソース変換 */
		$html = strtr($html, $this->tex_moji);
		
		//==============================================================
		/* 以降はTeXソースに変換されたものの修正 */
		// 肩付きのハイフンをそのまま使用する為の前処理（四苦八苦やね）
		$html = preg_replace('/<SUP>\-(\d)<\/SUP>/i', '###^{◎'."$1".'}###', $html);
		$html = preg_replace('/<B>(.+?)<\/B>/i', '{\textbf{'."$1".'}}', $html);
		$html = preg_replace('/<SUP>(.+?)<\/SUP>/i', '###^{'."$1".'}###', $html);
		$html = preg_replace('/<SUB>(.+?)<\/SUB>/i', '###_{'."$1".'}###', $html);
		$html = preg_replace('/<I>(.+?)<\/I>/i', '{\textit{'."$1".'}}', $html);
		
		// 行頭禁則対応（くくりとしてのダブルクォーテーション直前の文字やスペースをグループ化）
		$html = preg_replace('/([0-9A-Za-z\s]\")/i', '\mbox{'."$1".'}', $html);
		// 数字直前のマイナス記号の置換
		//$html = preg_replace('/-([0-9]+)/i', '{\textminus{'."$1".'}}', $html);
		// 数字直前の全角￥記号の分離禁止
		$html = preg_replace('/￥([0-9\.]+)/', '\mbox{￥{'."$1".'}}', $html);
		// ハイフン直後に生じる開き括弧行頭禁則
		$html = str_replace('-/-)','\mbox{-/-)}',$html);
		// ハイフン直後に生じる開き括弧行頭禁則
		$html = str_replace('-)','\mbox{-)}',$html);
		// 肩付きのマイナスはハイフンに戻す
		$html = str_replace('◎','-',$html);
		// 行頭禁則体操（直前にスペースのあるパーセント記号は行頭に来る可能性がある為）
		$html = str_replace(' {\%}', '~{\%}', $html);
		// 行末禁則（不等号記号直後のスペースが原因で行末に来ることを回避）
		$html = str_replace('{\textgreater} ', '{\textgreater}~', $html);
		
		// ギリシャ文字が下付文字で数式モードに挟まれた場合の対処
		$html_arr = explode('###',$html);
		
		foreach($html_arr as $k=>$v){
				if(preg_match('/^[_\^]/',$v)){
						$html_arr[$k] = str_replace('$','',$v);
				}
		}
		$html = implode('$',$html_arr);
		
		return $html;
	}
	/**
	 * Tex文字への変換（再帰呼び出し）
	 */
	public function __filteringTex($arr)
	{
		foreach($arr as $k => $v){
			if(is_array($v)){
				if($k=='session_info' && preg_match('/[0-9]+/',key($v))){
					$this->presen_cnt += count($v);
				}
				$arr[$k] = $this->__filteringTex($v);
			}else{
				if($k=='img_filename') continue;
				if($k=='sentence'){
					$v = preg_replace('/(\s*?<br>)+?$/i','',trim($v));
				}
				$arr[$k] = $this->html2tex($v);
			}
		}
		return $arr;
	}
	
	/**
	 * テンプレートにより整形されたTeXソースの編集
	 * @param string $html TeXソース文字列
	 * @return string
	 */ 
	public function PinpointReplace($html)
	{
		//目次中のダブル改行を一つに置き換え
		$ptn = '({section}).*?\s.*?(\\\\\\\\\\\\\\\\)';
		if(preg_match('/'.$ptn.'/i', $html, $match)){
			$html = str_replace($match[2],'\\\\',$html);
		}
		
		//windows7で辻（二点しんにょう）だが通常のTeX文字は（一点しんにょう）となる
		//二点しんにょうの辻は二点のままで表示させるためコードに変換して出力
		$ptn  = '辻';
		$_ptn = '{\CID{8267}}';
		$html = str_replace($ptn, $_ptn, $html);

		return $html;
	}
}
?>