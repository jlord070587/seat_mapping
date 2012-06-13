<?php //prx($list);
$block_pos = array(
	'99,74','99,30',
	'5,94','193,94','5,50','193,50','5,6','193,6',
);
?>
\documentclass[a4j,10pt,oneside]{jsbook}
%外部ファイルパス
\newcommand\includePath{<?php echo TEX_SOURCE_DIR;?>/inc}
\newcommand\imagePath{<?php echo TEX_SOURCE_DIR;?>/img}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%レイアウトを確定する要素
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newdimen\parsonNameFSize
\newdimen\parsonKeisyouFSize
\newdimen\parsonKeisyouResetFSize
\newdimen\parsonKatagakiFSize
\newdimen\parsonKatagakiResetFSize
\newdimen\katagakiHeight
\newdimen\parsonWidth
\newdimen\parsonResetWidth
\newdimen\parsonHeight
\newdimen\nameKatagakiVspace
\newdimen\personsUnitWidth
\newdimen\personsUnitHeight
\newdimen\personVspace
\newdimen\tableHspace
\newdimen\seatWidth
\newdimen\seatHeight
\newdimen\seatUnitWidth
\newdimen\seatUnitHeight
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%名前フォントサイズ
\parsonNameFSize=9.5pt
%敬称フォントサイズ
\parsonKeisyouFSize=9.5pt
\parsonKeisyouResetFSize=9.5pt
%肩書きフォントサイズ
%肩書きの長さによってはかなり詰まったレイアウトに見える場合がある
\parsonKatagakiFSize=8pt
\parsonKatagakiResetFSize=8pt
%肩書き枠の高さ（10.85979pt）
\katagakiHeight=10.85979pt
%個人（名前と肩書きを括る）枠のサイズ
\parsonWidth=23mm%名前のフォントサイズが影響する為迂闊に変更しないこと
\parsonResetWidth=23mm
\parsonHeight=10.5mm%出来れば11～12mm%4人含める場合フォントサイズと共に絞ること4人の場合10.5mmか11mm程度
%名前と肩書きの間隔
\nameKatagakiVspace=.5mm%ベタの場合0mm
%個人枠と個人枠の縦方向の間隔
\personVspace=0mm
%各座席の左右それぞれの集合枠（個人枠を括る）サイズ
\personsUnitWidth=\parsonWidth
\personsUnitHeight=40mm
%テーブル幅（集合枠の横方向間隔＝テーブルをまたぐサイズが必要）
\tableHspace=15mm
%左集合枠+右集合枠+テーブル幅
\seatWidth=\parsonWidth
\advance\seatWidth by \parsonWidth
\advance\seatWidth by \tableHspace
\seatHeight=40mm
%座席のユニットサイズ
\seatUnitWidth=78mm
\seatUnitHeight=44mm
%%%%%テーブルカラー%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand\tableColor{purple}
%%%%%プリアンプル%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\input{\includePath/preamble.tex}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%用紙サイズが規定外の場合以下で直接指定可
%\special{papersize=125mm,200mm}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%
%
\pagestyle{empty}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%本文開始
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\begin{document}
\setlength\unitlength{1mm}
\setlength{\parindent}{0pt}
\begin{picture}(276,171)(0,0)%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%ヘッダ情報および上座情報
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\headUnit{0,141}%
{山口}{広島}{大樹}{桃華}{2012年6月30日 リストランテCREOに於いて}%
<?php if($list):foreach($list as $num => $block):?>%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\seatUnit{<?php echo $block_pos[$num];?>}{松}{
\seat{
\personsUnit{
<?php
$left = array();
foreach($block['Guest'] as $idx => $guest){
	if($idx % 2 != 0) continue;
	$left[] = sprintf('\person{%s%s%s}{%s%s}{%s}',
		$guest['affiliation1'],
		$guest['affiliation1'] && $guest['affiliation2'] ? '\\\\' : '',
		$guest['affiliation2'],
		$guest['name_sei'],$guest['name_mei'],
		$guest['proper_title']
	);
}
echo implode("\x0D\x0A",$left);?>}
\hspace{12mm}%
\personsUnit{
<?php
$right = array();
foreach($block['Guest'] as $idx => $guest){
	if($idx % 2 == 0) continue;
	$right[] = sprintf('\person{%s%s%s}{%s%s}{%s}',
		$guest['affiliation1'],
		$guest['affiliation1'] && $guest['affiliation2'] ? '\\\\' : '',
		$guest['affiliation2'],
		$guest['name_sei'],$guest['name_mei'],
		$guest['proper_title']
	);
}
echo implode("\x0D\x0A",$right);?>}}
}
<?php endforeach;endif;?>
\warning{ご芳名お席順に失礼な点がございましら慶事に免じご寛容の程お願い申し上げます}%
%
\end{picture}%
%%%%%本文終了
\end{document}
