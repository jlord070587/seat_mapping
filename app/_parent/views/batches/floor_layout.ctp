<?php //prx($list);
define('BLOCK_WIDTH',69);
define('BLOCK_HEIGHT',47);
define('MAX_X',BLOCK_WIDTH * 3);
define('MAX_Y',BLOCK_HEIGHT * 2);
$block_pos = array();
for($y=MAX_Y; $y>=0; $y-=BLOCK_HEIGHT){
	for($x=0; $x<=MAX_X; $x+=BLOCK_WIDTH){
		$block_pos[] = sprintf('%s,%s',$x,$y);
	}
}
?>
\documentclass[a4j,10pt,oneside]{jsbook}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%用紙サイズが規定外の場合以下で直接指定可
%\special{papersize=125mm,200mm}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\usepackage[dvipdfmx]{graphicx,pict2e}
\def\pdfliteral#1{\special{pdf:content #1}}
\usepackage[dvipdfmx]{graphicx,color}
\usepackage{otf}
\setlength{\unitlength}{1mm}
%\setlength{\voffset}{0mm}
%\setlength{\hoffset}{0mm}
\setlength{\topmargin}{-1in}
\addtolength{\topmargin}{19mm}
\setlength{\oddsidemargin}{-1in}
\addtolength{\oddsidemargin}{10.5mm}
\setlength{\evensidemargin}{-1in}
\addtolength{\evensidemargin}{10.5mm}
\setlength{\textwidth}{276mm}
\setlength{\textheight}{171mm}
\setlength{\headsep}{0mm}
\setlength{\headheight}{0mm}
\setlength{\footskip}{19mm}
\setlength{\fboxsep}{0mm}
\setlength{\parindent}{0pt}
\setlength{\baselineskip}{0pt}
\linethickness{1pt}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newdimen\parsonNameFSize
\parsonNameFSize=8.8pt
\newdimen\parsonKatagakiFSize
\parsonKatagakiFSize=5pt
\newdimen\parsonWidth
\newdimen\parsonHeight
\parsonWidth=21mm
\parsonHeight=8mm
\newdimen\personsUnitWidth
\newdimen\personsUnitHeight
\personsUnitWidth=21mm
\personsUnitHeight=40mm
\newdimen\seatWidth
\newdimen\seaHeight
\seatWidth=54mm
\seaHeight=40mm
\newdimen\seatUnitWidth
\newdimen\seatUnitHeight
\seatUnitWidth=69mm
\seatUnitHeight=47mm

\makeatletter
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%均等割
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\kintou}[2]{%
	\leavevmode
	\hbox to #1{%
		\kanjiskip=0pt plus 1fill minus 1fill
		\xkanjiskip=\kanjiskip
		#2}}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%個人枠
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\person}[2]{%
	%名前の基準長さ
	\setbox0=\hbox{{\fontsize{\parsonNameFSize}{\parsonNameFSize}\selectfont ○○○○○○ 様}}
	%実際の名前の長さ
	\setbox1=\hbox{{\fontsize{\parsonNameFSize}{\parsonNameFSize}\selectfont #2 様}}
	\dimen0=1pt
	\ifdim\wd1>\wd0%
		%\dimen0 = \wd0
		%以下で\strip@pt\wd1とすると小数点以下がなぜか表示されてしまう
		%\divide\dimen0 by \strip@pt\wd1%%単位と小数以下を取っ払うにはどうする？
		%\toks0{\scalebox{\strip@pt\dimen0}[1]{#2{\thinspace}様}}
		%そもそも\scalebox等使用する必要がなかったorz
		\toks0{\resizebox{\wd0}{\ht0}{#2{\thinspace}様}}
	\else
		\ifdim\wd1<\wd0%
			\toks0{\kintou{6zw}{#2} 様}
		\else
			\toks0{#2 様}
		\fi
	\fi
	
	\begin{minipage}[c][\parsonHeight][c]{\parsonWidth}%
	\setlength{\baselineskip}{0pt}
	{\fontsize{\parsonKatagakiFSize}{\parsonKatagakiFSize}\selectfont #1}\\[.1mm]
	{\fontsize{\parsonNameFSize}{\parsonNameFSize}\selectfont \the\toks0}\\[1mm]
	\end{minipage}\vskip-.5mm}%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%個人枠１列分の集合
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\personsUnit}[1]{%
	%\fbox{%
	\begin{minipage}[c][\personsUnitHeight][c]{\personsUnitWidth}%
	#1%
	\end{minipage}}%}%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%座席内側のグルーピング枠
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\seat}[1]{%
	\begin{minipage}[b][\seaHeight][t]{\seatWidth}%
	#1%
	\end{minipage}}%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%座席ユニット
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\seatUnit}[3]{%
	\put(#1){%
	\hskip-1.2mm%
	\tableUnit{34.5}{23.5}{#2}{0}%
	%\fbox{%
	\begin{minipage}[b][\seatUnitHeight][c]{\seatUnitWidth}%
	%%%%%%%%%%%%%%%%%%%%%%%%
	\hskip7.5mm%
	%%%%%%%%%%%%%%%%%%%%%%%%
	#3%
	\end{minipage}%}%
	}}%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%テーブルの描画ルーチン
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\tableUnit}[4]{%
	\newdimen\xLength
	\newdimen\yLength
	\xLength=#1 pt
	\yLength=#2 pt
	
	\ifnum#4=1
		%%長机
		\advance\xLength by -6.4pt
		\advance\yLength by -20pt%テーブルの長さの半分を引く
		\put(\strip@pt\xLength,\strip@pt\yLength){\framebox(11,40){%frameboxの第2引数がテーブルの長さ
		\fontsize{18pt}{18pt}\selectfont {\textsf{\textgt #3}}}}
	\else
		%%円卓
		\linethickness{0.3pt}
		\advance\xLength by -2.7pt
		\advance\yLength by -1.95pt
		\put(#1,#2){\circle{9}}
		\put(\strip@pt\xLength,\strip@pt\yLength){\fontsize{16pt}{16pt}\selectfont {\textsf{\textgt #3}}}
	\fi
	%%%\put(45.5,27){\fontsize{22pt}{22pt}\selectfont {\textsf{\textgt #3}}}
	}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%高砂を含むヘッダブロック
%
%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\headUnit}[6]{%
	\put(#1){%
	%ヘッダレイアウト枠
	%\fbox{%
	\begin{minipage}[b][30mm][c]{276mm}%
		\vskip-8mm%ヘッダ枠内の上アキの調整
		%席次表タイトルユニット
		\hskip25mm%
		\begin{minipage}[c][10mm][c]{60mm}%
		{\fontsize{11pt}{16pt}\selectfont %
		\parbox[c][10mm][c]{4.5zw}{%
		\kintou{4zw}{#2家}\\%
		\kintou{4zw}{#3家}%
		}結婚披露宴御席表}%
		\end{minipage}%
		%高砂ユニット
		\hskip25.5mm%
		%\fbox{%
		\begin{minipage}[c]{55mm}%
		\vskip1mm%
		\centering{%
		\parbox[c][11mm][c]{3zw}{\centering{%
		{\fontsize{9pt}{9pt}\selectfont 新郎}\\[1mm]%
		{\fontsize{11pt}{11pt}\selectfont \kintou{2.5zw}{#4}}%
		}}\hskip15mm%
		\parbox[c][11mm][c]{3zw}{\centering{%
		{\fontsize{9pt}{9pt}\selectfont 新婦}\\[1mm]
		{\fontsize{11pt}{11pt}\selectfont \kintou{2.5zw}{#5}}%
		}}}\leavevmode\\[2mm]%
		\framebox(55,5){\fontsize{10pt}{10pt}\selectfont 高　砂}%この席名は不要？
		\end{minipage}%}%
		\hskip10.5mm%
		\begin{minipage}[c]{100mm}%
		\centering{%
		\fontsize{10pt}{10pt}\selectfont #6}%
		\end{minipage}%
	\end{minipage}}%}%
}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%欄外備考
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\newcommand{\warning}[1]{%
\put(146,0){%
\begin{minipage}[t][8mm][c]{130mm}\centering{%
{\fontsize{7pt}{7pt}\selectfont #1}}%
\end{minipage}}}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\makeatother
\pagestyle{empty}
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
%本文開始
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\begin{document}
\setlength\unitlength{1mm}
\setlength{\parindent}{0pt}
\begin{picture}(276,171)(0,0)%
%
\headUnit{0,141}%
{呉尾}{筆田}{大樹}{桃華}{2012年6月30日 リストランテCREOに於いて}%
%
<?php if($list):foreach($list as $num => $block):?>%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\seatUnit{<?php echo $block_pos[$num];?>}{松}{
\seat{
\personsUnit{
<?php
$left = array();
foreach($block['Guest'] as $idx => $guest){
	if($idx % 2 != 0) continue;
	$left[] = sprintf('\person{%s%s%s}{%s%s}',
		$guest['affiliation1'],
		$guest['affiliation1'] && $guest['affiliation2'] ? '\\\\' : '',
		$guest['affiliation2'],
		$guest['name_sei'],$guest['name_mei']
	);
}
echo implode("\x0D\x0A",$left);?>}
\hspace{12mm}%
\personsUnit{
<?php
$right = array();
foreach($block['Guest'] as $idx => $guest){
	if($idx % 2 == 0) continue;
	$right[] = sprintf('\person{%s%s%s}{%s%s}',
		$guest['affiliation1'],
		$guest['affiliation1'] && $guest['affiliation2'] ? '\\\\' : '',
		$guest['affiliation2'],
		$guest['name_sei'],$guest['name_mei']
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
