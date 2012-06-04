<?php
class TexMap
{
	public static $tex_moji = array(
	
		'LaTeX'=>'{\LaTeX}', 'TeX'=>'{\TeX}', 'LaTeXe'=>'{\LaTeXe}',
		'&#39;'=>'{\textquotesingle}','&#039;'=>'{\textquotesingle}',
		'&amp;quot;'=>'"',
	
		//区点コード系外字
		// ローマ数字
		'Ⅰ'=>'{\UTF{2160}}', 'Ⅱ'=>'{\UTF{2161}}', 'Ⅲ'=>'{\UTF{2162}}', 'Ⅳ'=>'{\UTF{2163}}', 'Ⅴ'=>'{\UTF{2164}}', 
		'Ⅵ'=>'{\UTF{2165}}', 'Ⅶ'=>'{\UTF{2166}}', 'Ⅷ'=>'{\UTF{2167}}', 'Ⅸ'=>'{\UTF{2168}}', 'Ⅹ'=>'{\UTF{2169}}', 
		'ⅰ'=>'{\UTF{2170}}', 'ⅱ'=>'{\UTF{2171}}', 'ⅲ'=>'{\UTF{2172}}', 'ⅳ'=>'{\UTF{2173}}', 'ⅴ'=>'{\UTF{2174}}', 
		'ⅵ'=>'{\UTF{2175}}', 'ⅶ'=>'{\UTF{2176}}', 'ⅷ'=>'{\UTF{2177}}', 'ⅸ'=>'{\UTF{2178}}', 'ⅹ'=>'{\UTF{2179}}', 
	
		'゛'=>'{\CID{643}}','゜'=>'{\CID{644}}','´'=>'{\CID{645}}','`'=>'{\CID{646}}','¨'=>'{\CID{647}}','^'=>'{\CID{648}}',
		'ヽ'=>'{\CID{651}}','ヾ'=>'{\CID{652}}','ゝ'=>'{\CID{653}}','ゞ'=>'{\CID{654}}','〃'=>'{\CID{655}}','仝'=>'{\CID{656}}',
		'々'=>'{\CID{657}}','〆'=>'{\CID{658}}','‥'=>'{\CID{669}}','‘'=>'{\CID{670}}','’'=>'{\CID{671}}','“'=>'{\CID{672}}',
		'”'=>'{\CID{673}}','±'=>'{\CID{694}}','÷'=>'{\CID{696}}','≠'=>'{\CID{698}}',
		//'='=>'{\CID{697}}','<'=>'{\CID{699}}','>'=>'{\CID{700}}',
		'≦'=>'{\CID{701}}','≧'=>'{\CID{702}}','∞'=>'{\CID{703}}','∴'=>'{\CID{704}}','♂'=>'{\CID{705}}',
		'♀'=>'{\CID{706}}','°'=>'{\CID{707}}','′'=>'{\CID{708}}','″'=>'{\CID{708}}','℃'=>'{\CID{710}}',
		"\\"=>'{\CID{711}}',//大丈夫？大丈夫みたい
		'$'=>'{\CID{712}}','￠'=>'{\CID{713}}','￡'=>'{\CID{714}}','§'=>'{\CID{720}}','〓'=>'{\CID{740}}','∈'=>'{\CID{741}}',
		'∋'=>'{\CID{742}}','⊆'=>'{\CID{743}}','⊇'=>'{\CID{744}}','⊂'=>'{\CID{745}}','⊃'=>'{\CID{746}}','∪'=>'{\CID{747}}',
		'∩'=>'{\CID{748}}','∧'=>'{\CID{749}}','∨'=>'{\CID{750}}','⇒'=>'{\CID{752}}','⇔'=>'{\CID{753}}','∀'=>'{\CID{754}}',
		'∃'=>'{\CID{755}}','∥'=>'{\CID{666}}','∠'=>'{\CID{756}}','⊥'=>'{\CID{757}}','⌒'=>'{\CID{758}}','∂'=>'{\CID{759}}',
		'∇'=>'{\CID{760}}','≡'=>'{\CID{761}}','≒'=>'{\CID{762}}','≪'=>'{\CID{763}}','≫'=>'{\CID{764}}','√'=>'{\CID{765}}',
		'∽'=>'{\CID{766}}','∝'=>'{\CID{767}}','∵'=>'{\CID{768}}','∫'=>'{\CID{769}}','∬'=>'{\CID{770}}','Å'=>'{\CID{771}}',
		'‰'=>'{\CID{772}}','♯'=>'{\CID{773}}','♭'=>'{\CID{774}}','♪'=>'{\CID{775}}','†'=>'{\CID{776}}','‡'=>'{\CID{777}}',
		'¶'=>'{\CID{778}}',
	
		//区点コード（実体参照対応）
		'&acute;'=>'{\textasciiacute}','&uml;'=>'{\textasciidieresis}',
		'&lsquo;'=>'{\CID{670}}','&rsquo;'=>'{\CID{671}}','&ldquo;'=>'{\CID{672}}','&rdquo;'=>'{\CID{673}}',
		'&plusmn;'=>'{\CID{694}}','&divide;'=>'{\CID{696}}','&ne;'=>'{\CID{698}}',
		'&infin;'=>'{\CID{703}}','&there4;'=>'{\CID{704}}','&deg;'=>'{\CID{707}}','&prime;'=>'{\CID{708}}','&Prime;'=>'{\CID{708}}',
		'&sect;'=>'{\CID{720}}','&isin;'=>'{\CID{741}}',
		'&ni;'=>'{\CID{742}}','&sube;'=>'{\CID{743}}','&supe;'=>'{\CID{744}}','&sub;'=>'{\CID{745}}','&sup;'=>'{\CID{746}}','&cup;'=>'{\CID{747}}',
		'&cap;'=>'{\CID{748}}','&and;'=>'{\CID{749}}','&or;'=>'{\CID{750}}','&rArr;'=>'{\CID{752}}','&hArr;'=>'{\CID{753}}','&forall;'=>'{\CID{754}}',
		'&exist;'=>'{\CID{755}}','&ang;'=>'{\CID{756}}','&perp;'=>'{\CID{757}}','&part;'=>'{\CID{759}}',
		'&nabla;'=>'{\CID{760}}','&equiv;'=>'{\CID{761}}','&radic;'=>'{\CID{765}}',
		'&prop;'=>'{\CID{767}}','&int;'=>'{\CID{769}}',
		'&permil;'=>'{\CID{772}}','&dagger;'=>'{\CID{776}}','&Dagger;'=>'{\CID{777}}',
		'&para;'=>'{\CID{778}}',
	
		//区点コード
		'Α'=>'{\CID{1011}}','Β'=>'{\CID{1012}}','Γ'=>'{\CID{1013}}','Δ'=>'{\CID{1014}}','Ε'=>'{\CID{1015}}',
		'Ζ'=>'{\CID{1016}}','Η'=>'{\CID{1017}}','Θ'=>'{\CID{1018}}','Ι'=>'{\CID{1019}}','Κ'=>'{\CID{1020}}','Λ'=>'{\CID{1021}}',
		'Μ'=>'{\CID{1022}}','Ν'=>'{\CID{1023}}','Ξ'=>'{\CID{1024}}','Ο'=>'{\CID{1025}}','Π'=>'{\CID{1026}}','Ρ'=>'{\CID{1027}}',
		'Σ'=>'{\CID{1028}}','Τ'=>'{\CID{1029}}','Υ'=>'{\CID{1030}}','Φ'=>'{\CID{1031}}','Χ'=>'{\CID{1032}}','Ψ'=>'{\CID{1033}}',
		'Ω'=>'{\CID{1034}}','α'=>'{\CID{1035}}','β'=>'{\CID{1036}}','γ'=>'{\CID{1037}}','δ'=>'{\CID{1038}}','ε'=>'{\CID{1039}}',
		'ζ'=>'{\CID{1040}}','η'=>'{\CID{1041}}','θ'=>'{\CID{1042}}','ι'=>'{\CID{1043}}','κ'=>'{\CID{1044}}','λ'=>'{\CID{1045}}',
		'μ'=>'{\CID{1046}}','ν'=>'{\CID{1047}}','ξ'=>'{\CID{1048}}','ο'=>'{\CID{1049}}','π'=>'{\CID{1050}}','ρ'=>'{\CID{1051}}',
		'σ'=>'{\CID{1052}}','τ'=>'{\CID{1053}}','υ'=>'{\CID{1054}}','φ'=>'{\CID{1055}}','χ'=>'{\CID{1056}}','ψ'=>'{\CID{1057}}',
		'ω'=>'{\CID{1058}}','А'=>'{\CID{1059}}','Б'=>'{\CID{1060}}','В'=>'{\CID{1061}}','Г'=>'{\CID{1062}}','Д'=>'{\CID{1063}}',
		'Е'=>'{\CID{1064}}','Ё'=>'{\CID{1065}}','Ж'=>'{\CID{1066}}','З'=>'{\CID{1067}}','И'=>'{\CID{1068}}','Й'=>'{\CID{1069}}',
		'К'=>'{\CID{1070}}','Л'=>'{\CID{1071}}','М'=>'{\CID{1072}}','Н'=>'{\CID{1073}}','О'=>'{\CID{1074}}','П'=>'{\CID{1075}}',
	
		//区点コード（実体参照対応）
		'&Alpha;'=>'{\CID{1011}}','&Beta;'=>'{\CID{1012}}','&Gamma;'=>'{\CID{1013}}','&Delta;'=>'{\CID{1014}}','&Epsilon;'=>'{\CID{1015}}',
		'&Zeta;'=>'{\CID{1016}}','&Eta;'=>'{\CID{1017}}','&Theta;'=>'{\CID{1018}}','&Iota;'=>'{\CID{1019}}','&Kappa;'=>'{\CID{1020}}','&Lambda;'=>'{\CID{1021}}',
		'&Mu;'=>'{\CID{1022}}','&Nu;'=>'{\CID{1023}}','&Xi;'=>'{\CID{1024}}','&Omicron;'=>'{\CID{1025}}','&Pi;'=>'{\CID{1026}}','&Rho;'=>'{\CID{1027}}',
		'&Sigma;'=>'{\CID{1028}}','&Tau;'=>'{\CID{1029}}','&Upsilon;'=>'{\CID{1030}}','&Phi;'=>'{\CID{1031}}','&Chi;'=>'{\CID{1032}}','&Psi;'=>'{\CID{1033}}',
		'&Omega;'=>'{\CID{1034}}','&alpha;'=>'{\CID{1035}}','&beta;'=>'{\CID{1036}}','&gamma;'=>'{\CID{1037}}','&delta;'=>'{\CID{1038}}','&epsilon;'=>'{\CID{1039}}',
		'&zeta;'=>'{\CID{1040}}','&eta;'=>'{\CID{1041}}','&theta;'=>'{\CID{1042}}','&iota;'=>'{\CID{1043}}','&kappa;'=>'{\CID{1044}}','&lambda;'=>'{\CID{1045}}',
	
		'&mu;'=>'{\CID{1046}}','&nu;'=>'{\CID{1047}}','&xi;'=>'{\CID{1048}}','&omicron;'=>'{\CID{1049}}','&pi;'=>'{\CID{1050}}','&rho;'=>'{\CID{1051}}',
		'&sigma;'=>'{\CID{1052}}','&tau;'=>'{\CID{1053}}','&upsilon;'=>'{\CID{1054}}','&phi;'=>'{\CID{1055}}','&chi;'=>'{\CID{1056}}','&psi;'=>'{\CID{1057}}',
		'&omega;'=>'{\CID{1058}}',
	
		'Р'=>'{\CID{1076}}','С'=>'{\CID{1077}}','Т'=>'{\CID{1078}}','У'=>'{\CID{1079}}','Ф'=>'{\CID{1080}}','Х'=>'{\CID{1081}}',
		'Ц'=>'{\CID{1082}}','Ч'=>'{\CID{1083}}','Ш'=>'{\CID{1084}}','Щ'=>'{\CID{1085}}','Ъ'=>'{\CID{1086}}','Ы'=>'{\CID{1087}}',
		'Ь'=>'{\CID{1088}}','Э'=>'{\CID{1089}}','Ю'=>'{\CID{1090}}','Я'=>'{\CID{1091}}','а'=>'{\CID{1092}}','б'=>'{\CID{1093}}',
		'в'=>'{\CID{1094}}','г'=>'{\CID{1095}}','д'=>'{\CID{1096}}','е'=>'{\CID{1097}}','ё'=>'{\CID{1098}}','ж'=>'{\CID{1099}}',
		'з'=>'{\CID{1100}}','и'=>'{\CID{1101}}','й'=>'{\CID{1102}}','к'=>'{\CID{1103}}','л'=>'{\CID{1104}}','м'=>'{\CID{1105}}',
		'н'=>'{\CID{1106}}','о'=>'{\CID{1107}}','п'=>'{\CID{1108}}','р'=>'{\CID{1109}}','с'=>'{\CID{1110}}','т'=>'{\CID{1111}}',
		'у'=>'{\CID{1112}}','ф'=>'{\CID{1113}}','х'=>'{\CID{1114}}','ц'=>'{\CID{1115}}','ч'=>'{\CID{1116}}','ш'=>'{\CID{1117}}',
		'щ'=>'{\CID{1118}}','ъ'=>'{\CID{1119}}','ы'=>'{\CID{1120}}','ь'=>'{\CID{1121}}','э'=>'{\CID{1122}}','ю'=>'{\CID{1123}}',
		'я'=>'{\CID{1124}}',
	
		'㍉'=>'{\CID{7585}}','㌔'=>'{\CID{7586}}','㌢'=>'{\CID{7587}}','㍍'=>'{\CID{7588}}','㌘'=>'{\CID{7589}}','㌧'=>'{\CID{7590}}',
		'㌃'=>'{\CID{7591}}','㌶'=>'{\CID{7592}}','㍑'=>'{\CID{7593}}','㍗'=>'{\CID{7594}}','㌍'=>'{\CID{7595}}','㌦'=>'{\CID{7596}}',
		'㌣'=>'{\CID{7597}}','㌫'=>'{\CID{7598}}','㍊'=>'{\CID{7599}}','㌻'=>'{\CID{7600}}',
		'㎜'=>'{\CID{7601}}','㎝'=>'{\CID{7602}}','㎞'=>'{\CID{7603}}','㎎'=>'{\CID{7604}}','㎏'=>'{\CID{7605}}','㏄'=>'{\CID{7606}}',
		'㎡'=>'{\CID{7607}}','〝'=>'{\CID{7608}}','〟'=>'{\CID{7609}}','№'=>'{\CID{7610}}','㏍'=>'{\CID{7611}}','℡'=>'{\CID{7612}}',
		'㊤'=>'{\CID{7613}}','㊥'=>'{\CID{7614}}','㊦'=>'{\CID{7615}}','㊧'=>'{\CID{7616}}','㊨'=>'{\CID{7617}}','㈱'=>'{\CID{7618}}',
		'㈲'=>'{\CID{7619}}','㈹'=>'{\CID{7620}}','㍾'=>'{\CID{7621}}','㍽'=>'{\CID{7622}}','㍼'=>'{\CID{7623}}','∮'=>'{\CID{7624}}',
		'∟'=>'{\CID{7629}}','⊿'=>'{\CID{7630}}','㍻'=>'{\CID{8323}}',
	
		//区点コード（数値実体参照対応一部）
		'&#13199;'=>'{\CID{7605}}','&#8470;'=>'{\CID{7610}}','&#8895;'=>'{\CID{7630}}',
	
		'①'=>'{\CID{7555}}','②'=>'{\CID{7556}}','③'=>'{\CID{7557}}','④'=>'{\CID{7558}}','⑤'=>'{\CID{7559}}','⑥'=>'{\CID{7560}}',
		'⑦'=>'{\CID{7561}}','⑧'=>'{\CID{7562}}','⑨'=>'{\CID{7563}}','⑩'=>'{\CID{7564}}','⑪'=>'{\CID{7565}}','⑫'=>'{\CID{7565}}',
		'⑬'=>'{\CID{7567}}','⑭'=>'{\CID{7568}}','⑮'=>'{\CID{7569}}','⑯'=>'{\CID{7570}}','⑰'=>'{\CID{7571}}','⑱'=>'{\CID{7572}}',
		'⑲'=>'{\CID{7573}}','⑳'=>'{\CID{7574}}',
	
		// 異体字
		//'つち吉'=>'{\CID{13706}}',
		'髙'=>'{\CID{8705}}',
		'﨑'=>'{\CID{8443}}',
		'濵'=>'{\CID{8531}}',
		'㈱'=>'{\CID{7618}}',
		'㈲'=>'{\CID{7619}}',
		'&#x9ad9;'=>'{\CID{8705}}',//はしごだか
		'&#30233;'=>'{\CID{14857}}',
		'德'=>'{\CID{8452}}','&#24503;'=>'{\CID{8452}}',
		'隆'=>'{\CID{13393}}',
		'祥'=>'{\CID{8581}}',
		'桒'=>'{\CID{8492}}',
		'寬'=>'{\CID{8436}}','&#23532;'=>'{\CID{8436}}',
		'淸'=>'{\CID{8521}}','&#28152;'=>'{\CID{8521}}',
		
		// ギリシャ文字（大文字）
		'&Alpha;'=>'A', 	'&Beta;'=>'B',			'&Gamma;'=>'{$\Gamma$}',
		'&Delta;'=>'{$\Delta$}', '&Epsilon;'=>'E',		'&Zeta;'=>'Z',
		'&Eta;'=>'H',		'&Theta;'=>'{$\Theta$}',	'&Iota;'=>'I',
		'&Kappa;'=>'K',		'&Lamdba;'=>'{$\Lambda$}',	'&Mu;'=>'M',
		'&Nu;'=>'N',		'&Xi;'=>'{$\Xi$}',		'&Omicron'=>'O',
		'&Pi;'=>'{$\Pi$}',	'&Rho;'=>'P',			'&Sigma;'=>'{$\Sigma$}',
		'&Tau;'=>'T',		'&Upsilon;'=>'{$\Upsilon$}',	'&Phi;'=>'{$\Phi$}',
		'&Chi;'=>'X',		'&Psi;'=>'{$\Psi$}',		'&Omega;'=>'{$\Omega$}',
	
		// ギリシャ文字（小文字）
		'&alpha;'=>'{$\alpha$}','&beta;'=>'{$\beta$}',		'&gamma;'=>'{$\gamma$}',
		'&delta;'=>'{$\delta$}','&epsilon;'=>'{$\epsilon$}',	'&zeta;'=>'{$\zeta$}',
		'&eta;'=>'{$\eta$}',	'&theta;'=>'{$\theta$}',	'&iota;'=>'{$\iota$}',
		'&kappa;'=>'{$\kappa$}','&lamdba;'=>'{$\lambda$}',	/*'&mu;'=>'{$\mu$}',*/
		'&mu;'=>'{\textmu}',
		'&nu;'=>'{$\nu$}',	'&xi;'=>'{$\xi$}',		'&omicron;'=>'o',
		'&pi;'=>'{$\pi$}',	'&rho;'=>'{$\rho$}',		'&sigma;'=>'{$\sigma$}',
		'&tau;'=>'{$\tau$}',	'&upsilon;'=>'{$\upsilon$}',	'&phi;'=>'{$\phi$}',
		'&chi;'=>'{$\chi$}',	'&psi;'=>'{$\psi$}',		'&omega;'=>'{$\omega$}',
	
		// ギリシャ文字(一部のみ）ヒューマンエラー対応
		'&Alpha'=>'A', 	'&Beta'=>'B',			'&Gamma'=>'{$\Gamma$}',
		'&Alpha:'=>'A', 	'&Beta:'=>'B',			'&Gamma:'=>'{$\Gamma$}',
		'&Delta'=>'{$\Delta$}', '&Epsilon'=>'E',		'&Zeta'=>'Z',
		'&Delta:'=>'{$\Delta$}', '&Epsilon:'=>'E',		'&Zeta:'=>'Z',
		'&alpha'=>'{$\alpha$}','&beta'=>'{$\beta$}',		'&gamma'=>'{$\gamma$}',
		'&alpha:'=>'{$\alpha$}','&beta:'=>'{$\beta$}',		'&gamma:'=>'{$\gamma$}',
		'&delta'=>'{$\delta$}','&epsilon'=>'{$\epsilon$}',	'&zeta'=>'{$\zeta$}',
		'&delta:'=>'{$\delta$}','&epsilon:'=>'{$\epsilon$}',	'&zeta:'=>'{$\zeta$}',
	
		//Latin-1実体
		//8ビットのラテン－1文字セット用の文字実体参照・十進法参照・十六進法参照
		//no-break space = non-breaking space
		'&nbsp;'=>'{\enspace}','&#160;'=>'{\enspace}','&#xA0;'=>'{\enspace}',
		//inverted question mark = turned question mark
		'&iexcl;'=>'{!`}','&#161;'=>'{!`}','&#xA1;'=>'{!`}',
		//cent sign
		'&cent;'=>'{\textcentoldstyle}','&#162;'=>'{\textcentoldstyle}','&#xA2;'=>'{\textcentoldstyle}',
		//pound sign
		'&pound;'=>'{\textsterling}','&#163;'=>'{\textsterling}','&#xA3;'=>'{\textsterling}',
		//currency sign
		'&curren;'=>'{\textcurrency}','&#164;'=>'{\textcurrency}','&#xA4;'=>'{\textcurrency}',
		//yen sign = yuan sign
		'&yen;'=>'{\textyen}','&#165;'=>'{\textyen}','&#xA5;'=>'{\textyen}',
		//broken bar = broken vertical bar
		'&brvbar;'=>'{\textbrokenbar}','&#166;'=>'{\textbrokenbar}','&#xA6;'=>'{\textbrokenbar}',
		//section sign
		'&sect;'=>'{\textsection}','&#167;'=>'{\textsection}','&#xA7;'=>'{\textsection}',
		//diaeresis = spacing diaeresis
		'&uml;'=>'{\textasciidieresis}','&#168;'=>'{\textasciidieresis}','&#xA8;'=>'{\textasciidieresis}',
		//copyright sign
		'&copy;'=>'{\textcopyright}','&#169;'=>'{\textcopyright}','&#xA9;'=>'{\textcopyright}',
		//feminine ordinal indicator
		'&ordf;'=>'{\textordfeminine}','&#170;'=>'{\textordfeminine}','&#xAA;'=>'{\textordfeminine}',
		//left-pointing double angle quotation mark = left pointing guillemet
		//'&laquo;'=>'\text','&#171;'=>'\text','&#xAB;'=>'\text',
		//not sign = discretionary hyphen
		'&not;'=>'{\textlnot}','&#172;'=>'{\textlnot}','&#xAC;'=>'{\textlnot}',
		//soft hyphen = discretionary hyphen
		//'&shy;'=>'\text','&#173;'=>'\text','&#xAD;'=>'\text',
		//registered sign = registered trade mark sign
		'&reg;'=>'{\textregistered}','&#174;'=>'{\textregistered}','&#xAE;'=>'{\textregistered}',
		//macron = spacing macron = overline = APL overbar
		'&macr;'=>'{\textasciimacron}','&#175;'=>'{\textasciimacron}','&#xAF;'=>'{\textasciimacron}',
		//degree sign
		'&deg;'=>'{\textdegree}','&#176;'=>'{\textdegree}','&#xB0;'=>'{\textdegree}',
		//plus-minus sign = plus-or-minus sign
		'&plusmn;'=>'{\textpm}','&#177;'=>'{\textpm}','&#xB1;'=>'{\textpm}',
		//superscript two = superscript digit two = squared
		'&sup2;'=>'{\texttwosuperior}','&#178;'=>'{\texttwosuperior}','&#xB2;'=>'{\texttwosuperior}',
		//superscript three = superscript digit three = cubed
		'&sup3;'=>'{\textthreesuperior}','&#179;'=>'{\textthreesuperior}','&#xB3;'=>'{\textthreesuperior}',
		//acute accent = spacing acute
		'&acute;'=>'{\textasciiacute}','&#180;'=>'{\textasciiacute}','&#xB4;'=>'{\textasciiacute}',
		//micro sign
		'&micro;'=>'{\textmu}','&#181;'=>'{\textmu}','&#xB5;'=>'{\textmu}',
		//pilcrow sign = paragraph sign
		'&para;'=>'{\textparagraph}','&#182;'=>'{\textparagraph}','&#xB6;'=>'{\textparagraph}',
		//middle dot = Georgian comma = Greek middle dot
		'&middot;'=>'{\textperiodcentered}','&#183;'=>'{\textperiodcentered}','&#xB7;'=>'{\textperiodcentered}',
		//cedilla = spacing cedilla
		//'&cedil;'=>'\text','&#184;'=>'\text','&#xB8;'=>'\text',
		//superscript one = superscript digit one
		'&sup1;'=>'{\textonesuperior}','&#185;'=>'{\textonesuperior}','&#xB9;'=>'{\textonesuperior}',
		//masculine ordinal indicator
		'&ordm;'=>'{\textordmasculine}','&#186;'=>'{\textordmasculine}','&#xBA;'=>'{\textordmasculine}',
		//right-pointing double angle quotation mark = right pointing guillemet
		//'&raquo;'=>'\text','&#187;'=>'\text','&#xBB;'=>'\text',
		//vulgar fraction one quarter = fraction one quarter
		'&frac14;'=>'{\textonequarter}','&#188;'=>'{\textonequarter}','&#xBC;'=>'{\textonequarter}',
		//vulgar fraction one half = fraction one half
		'&frac12;'=>'{\textonehalf}','&#189;'=>'{\textonehalf}','&#xBD;'=>'{\textonehalf}',
		//vulgar fraction three quarters = fraction three quarters
		'&frac34;'=>'{\textthreequarters}','&#190;'=>'{\textthreequarters}','&#xBE;'=>'{\textthreequarters}',
		//inverted question mark = turned question mark
		'&iquest;'=>'{?`}','&#191;'=>'{?`}','&#xBF;'=>'{?`}',
	
		//Latin capital letter A with grave = Latin capital letter A grave
		'&Agrave;'=>'{\`{A}}','&#192;'=>'{\`{A}}','&#xC0;'=>'{\`{A}}',
		//Latin capital letter A with acute
		'&Aacute;'=>'{\\\'{A}}','&#193;'=>'{\\\'{A}}','&#xC1;'=>'{\\\'{A}}',
		//Latin capital letter A with circumflex
		'&Acirc;'=>'{\^{A}}','&#194;'=>'{\^{A}}','&#xC2;'=>'{\^{A}}',
		//Latin capital letter A with tilde
		'&Atilde;'=>'{\~{A}}','&#195;'=>'{\~{A}}','&#xC3;'=>'{\~{A}}',
		//Latin capital letter A with diaeresis
		'&Auml;'=>'{\\"{A}}','&#196;'=>'{\\"{A}}','&#xC4;'=>'{\\"{A}}',
		//Latin capital letter A with ring above = Latin capital letter A ring
		'&Aring;'=>'{\r{A}}','&#197;'=>'{\r{A}}','&#xC5;'=>'{\r{A}}',
		//Latin capital letter AE = Latin capital ligature AE
		'&AElig;'=>'{\AE}','&#198;'=>'{\AE}','&#xC6;'=>'{\AE}',
		//Latin capital letter C with cedilla
		'&Ccedil;'=>'{\c{C}}','&#199;'=>'{\c{C}}','&#xC7;'=>'{\c{C}}',
	
		//Latin capital letter E with grave
		'&Egrave;'=>'{\`{E}}','&#200;'=>'{\`{E}}','&#xC8;'=>'{\`{E}}',
		//Latin capital letter E with acute
		'&Eacute;'=>'{\\\'{E}}','&#201;'=>'{\\\'{E}}','&#xC9;'=>'{\\\'{E}}',
		//Latin capital letter E with circumflex
		'&Ecirc;'=>'{\^{E}}','&#202;'=>'{\^{E}}','&#xCA;'=>'{\^{E}}',
		//Latin capital letter E with diaeresis
		'&Euml;'=>'{\\"{E}}','&#203;'=>'{\\"{E}}','&#xCB;'=>'{\\"{E}}',
		//Latin capital letter I with grave
		'&Igrave;'=>'{\`{I}}','&#204;'=>'{\`{I}}','&#xCC;'=>'{\`{I}}',
		//Latin capital letter I with acute
		'&Iacute;'=>'{\\\'{I}}','&#205;'=>'{\\\'{I}}','&#xCD;'=>'{\\\'{I}}',
		//Latin capital letter I with circumflex
		'&Icirc;'=>'{\^{I}}','&#206;'=>'{\^{I}}','&#xCE;'=>'{\^{I}}',
		//Latin capital letter I with diaeresis
		'&Iuml;'=>'{\"{I}}','{\&}{\#}207;'=>'{\"{I}}','&#xCF;'=>'{\"{I}}',
		//Latin capital letter ETH (※T1 encoding)
		'&ETH;'=>'{\DH}','&#208;'=>'{\DH}','&#xD0;'=>'{\DH}',
		//Latin capital letter N with tilde
		'&Ntilde;'=>'{\~{N}}','&#209;'=>'{\~{N}}','&#xD1;'=>'{\~{N}}',
		//Latin capital letter O with grave
		'&Ograve;'=>'{\`{O}}','&#210;'=>'{\`{O}}','&#xD2;'=>'{\`{O}}',
		//Latin capital letter O with acute
		'&Oacute;'=>'{\\\'{O}}','&#211;'=>'{\\\'{O}}','&#xD3;'=>'{\\\'{O}}',
		//Latin capital letter O with circumflex
		'&Ocirc;'=>'{\^{O}}','&#212;'=>'{\^{O}}','&#xD4;'=>'{\^{O}}',
		//Latin capital letter O with tilde
		'&Otilde;'=>'{\~{O}}','&#213;'=>'{\~{O}}','&#xD5;'=>'{\~{O}}',
		//Latin capital letter O with diaeresis
		'&Ouml;'=>'{\\"{O}}','&#214;'=>'{\\"{O}}','&#xD6;'=>'{\\"{O}}',
		//multiplication sign
		'&times;'=>'{\texttimes}','&#215;'=>'{\texttimes}','&#xD7;'=>'{\texttimes}',//かけ算
		//Latin capital letter O with stroke = Latin capital letter O slash
		'&Oslash;'=>'{\O}','&#216;'=>'{\O}','&#xD8;'=>'{\O}',
	
		//Latin capital letter U with grave
		'&Ugrave;'=>'{\`{U}}','&#217;'=>'{\`{U}}','&#xD9;'=>'{\`{U}}',
		//Latin capital letter U with acute
		'&Uacute;'=>'{\\\'{U}}','&#218;'=>'{\\\'{U}}','&#xDA;'=>'{\\\'{U}}',
		//Latin capital letter U with circumflex
		'&Ucirc;'=>'{\^{U}}','&#219;'=>'{\^{U}}','&#xDB;'=>'{\^{U}}',
		//Latin capital letter U with diaeresis
		'&Uuml;'=>'{\\"{U}}','&#220;'=>'{\\"{U}}','&#xDC;'=>'{\\"{U}}',
		//Latin capital letter Y with acute
		'&Yacute;'=>'{\\\'{U}}','&#221;'=>'{\\\'{U}}','&#xDD;'=>'{\\\'{U}}',
		//Latin capital letter THORN
		'&THORN;'=>'{\th}','&#222;'=>'{\th}','&#xDE;'=>'{\th}',
		//Latin small letter sharp s = ess-zed
		'&szlig;'=>'{\ss}','&#223;'=>'{\ss}','&#xDF;'=>'{\ss}',
		//Latin small letter a with grave = Latin small letter a grave
		'&agrave;'=>'{\`{a}}','&#224;'=>'{\`{a}}','&#xE0;'=>'{\`{a}}',
		//Latin small letter a with acute
		'&aacute;'=>'{\\\'{a}}','&#225;'=>'{\\\'{a}}','&#xE1;'=>'{\\\'{a}}',
		//Latin small letter a with circumflex
		'&acirc;'=>'{\^{a}}','&#226;'=>'{\^{a}}','&#xE2;'=>'{\^{a}}',
		//Latin small letter a with tilde
		'&atilde;'=>'{\~{a}}','&#227;'=>'{\~{a}}','&#xE3;'=>'{\~{a}}',
		//Latin small letter a with diaeresis
		'&auml;'=>'{\\"{a}}','&#228;'=>'{\\"{a}}','&#xE4;'=>'{\\"{a}}',
		//Latin small letter a with ring above = Latin small letter a ring
		'&aring;'=>'{\r{a}}','&#229;'=>'{\r{a}}','&#xE5;'=>'{\r{a}}',
		//Latin small letter ae = Latin small ligature ae
		'&aelig;'=>'{\ae}','&#230;'=>'{\ae}','&#xE6;'=>'{\ae}',
		//Latin small letter c with cedilla
		'&ccedil;'=>'{\c{c}}','&#231;'=>'{\c{c}}','&#xE7;'=>'{\c{c}}',
		//Latin small letter e with grave
		'&egrave;'=>'{\`{e}}','&#232;'=>'{\`{e}}','&#xE8;'=>'{\`{e}}',
		//Latin small letter e with acute
		'&eacute;'=>'{\\\'{e}}','&#233;'=>'{\\\'{e}}','&#xE9;'=>'{\\\'{e}}',
		//Latin small letter e with circumflex
		'&ecirc;'=>'{\^{e}}','&#234;'=>'{\^{e}}','&#xEA;'=>'{\^{e}}',
		//Latin small letter e with diaeresis
		'&euml;'=>'{\\"{e}}','&#235;'=>'{\\"{e}}','&#xEB;'=>'{\\"{e}}',
		//Latin small letter i with grave
		'&igrave;'=>'{\`{i}}','&#236;'=>'{\`{i}}','&#xEC;'=>'{\`{i}}',
		//Latin small letter i with acute
		'&iacute;'=>'{\\\'{i}}','&#237;'=>'{\\\'{i}}','&#xED;'=>'{\\\'{i}}',
		//Latin small letter i with circumflex
		'&icirc;'=>'{\^{i}}','&#238;'=>'{\^{i}}','&#xEE;'=>'{\^{i}}',
		//Latin small letter i with diaeresis
		'&iuml;'=>'{\\"{i}}','&#239;'=>'{\\"{i}}','&#xEF;'=>'{\\"{i}}',
		//Latin small letter eth
		'&eth;'=>'{\dh}','&#240;'=>'{\dh}','&#xF0;'=>'{\dh}',
		//Latin small letter n with tilde
		'&ntilde;'=>'{\~{n}}','&#241;'=>'{\~{n}}','&#xF1;'=>'{\~{n}}',
		//Latin small letter o with grave
		'&oacute;'=>'{\\\'{o}}','&#243;'=>'{\\\'{o}}','&#xF3;'=>'{\\\'{o}}',
		//Latin small letter o with circumflex
		'&ocirc;'=>'{\^{o}}','&#244;'=>'{\^{o}}','&#xF4;'=>'{\^{o}}',
		//Latin small letter o with tilde
		'&otilde;'=>'{\~{o}}','&#245;'=>'{\~{o}}','&#xF5;'=>'{\~{o}}',
		//Latin small letter o with diaeresis
		'&ouml;'=>'{\\"{o}}','&#246;'=>'{\\"{o}}','&#xF6;'=>'{\\"{o}}',
		//division sign 
		'&divide;'=>'{\textdiv}','&#247;'=>'{\textdiv}','&#xF7;'=>'{\textdiv}',
		//Latin small letter o with stroke = Latin small letter o slash
		'&oslash;'=>'\o','&#248;'=>'\o','&#xF8;'=>'\o',
		//Latin small letter u with grave
		'&ugrave;'=>'\`{u}','&#249;'=>'\`{u}','&#xF9;'=>'\`{u}',
		//Latin small letter u with acute
		'&uacute;'=>'{\\\'{u}}','&#250;'=>'{\\\'{u}}','&#xFA;'=>'{\\\'{u}}',
		//Latin small letter u with circumflex
		'&ucirc;'=>'{\^{u}}','&#251;'=>'{\^{u}}','&#xFB;'=>'{\^{u}}',
		//Latin small letter u with diaeresis
		'&uuml;'=>'{\\"{u}}','&#252;'=>'{\\"{u}}','&#xFC;'=>'{\\"{u}}',
		//Latin small letter y with acute
		'&yacute;'=>'{\\\'{y}}','&#253;'=>'{\\\'{y}}','&#xFD;'=>'{\\\'{y}}',
		//Latin small letter thorn
		'&thorn;'=>'{\\\'{y}}','&#254;'=>'{\\\'{y}}','&#xFE;'=>'{\\\'{y}}',
		//Latin small letter y with diaeresis
		'&yuml;'=>'{\\"{y}}','&#255;'=>'{\\"{y}}','&#xFF;'=>'{\\"{y}}',
		//Euro sign
		'&euro;'=>'{\texteuro}','&#8364;'=>'{\texteuro}','&#x20AC;'=>'{\texteuro}',
		//'W^'=>'{\^{W}}','w^'=>'{\^{w}}','y^'=>'{\^{y}}',
		'&#372;'=>'{\^{W}}','&#374'=>'{\^{Y}}','&#373'=>'{\^{w}}','&#375'=>'{\^{y}}',
		//Latin capital ligature OE
		'&OElig;'=>'{\OE}','&#338;'=>'{\OE}','&#x152;'=>'{\OE}',
		//Latin small ligature oe
		'&oelig;'=>'{\oe}','&#338;'=>'{\oe}','&#x152;'=>'{\oe}',
		//Single low-9 quotation mark
		'&sbquo;'=>'{\quotesinglbase}','&#8218;'=>'{\quotesinglbase}','&#x201A;'=>'{\quotesinglbase}',
		//double low-9 quotation mark
		'&bdquo;'=>'{\quotedblbase}','&#8218;'=>'{\quotedblbase}','&#x201A;'=>'{\quotedblbase}',
		//Left-pointing double angle quotation mark
		'&laquo;'=>'{\guillemotleft}','&#171;'=>'{\guillemotleft}','&#xAB;'=>'{\guillemotleft}',
		//Right-pointing double angle quotation mark
		'&raquo;'=>'{\guillemotright}','&#187;'=>'{\guillemotright}','&#xBB;'=>'{\guillemotright}',
		//Almost equal to
		'&asymp;'=>'{\Pisymbol{psy}{"BB}}','&#8776;'=>'{\Pisymbol{psy}{"BB}}','&#x2248;'=>'{\Pisymbol{psy}{"BB}}',
		//en size dash
		'&ndash;'=>'--','&#8211;'=>'--','&#x2013;'=>'--',
		//em size dash
		'&mdash;'=>'---','&#8212;'=>'---','&#x2014;'=>'---',
		
		//jcs2012
		//single left-pointing angle quotation mark
		'&#8249;'=>'{\CID{682}}','&lsaquo;'=>'{\CID{682}}',
		//	single right-pointing angle quotation mark
		'&#8250;'=>'{\CID{683}}','&rsaquo;'=>'{\CID{683}}',
	
		// 分離禁止として処理
		'(-)'=>'{\mbox{(-)}}',
		'(+)'=>'{\mbox{(+)}}',
		// 行頭行末禁則として（スペースの後の開きまたは閉じ括弧直前直後にスペースがあった場合）
		'( '=>'(~',
		// 行頭行末禁則として（スペースで改行された場合約物が行頭に来ることを禁止）
		// ちなみに、~はTeX上では改行できないスペースとして解釈される
		' )'=>'~)',
		' ,'=>', ',
		' - '=>'~-~',
		' ;'=>'~;',
		' : '=>'~:~',
		' :'=>'~:',
		' = '=>'~=~',
		' ='=>'~=',
		' .'=>'~.',
		// 分離禁止として処理（TeXが-で改行しようとするため）
		'-,'=>'{\mbox{-,}}',
		//制御文字(制御文字が混入するとTEXが止まってしまう為空白に置換)
		"\x00"=>'',"\x01"=>'',"\x02"=>'',"\x03"=>'',"\x04"=>'',
		"\x05"=>'',"\x06"=>'',"\x07"=>'',"\x08"=>'',"\x09"=>'',
		"\x0a"=>'',"\x0b"=>'',"\x0c"=>'',"\x0d"=>'',"\x0e"=>'',
		"\x0f"=>'',"\x10"=>'',"\x11"=>'',"\x12"=>'',"\x13"=>'',
		"\x14"=>'',"\x15"=>'',"\x16"=>'',"\x17"=>'',"\x18"=>'',
		"\x19"=>'',"\x1a"=>'',"\x1b"=>'',"\x1c"=>'',"\x1d"=>'',
		"\x1e"=>'',"\x1f"=>'',"\x7f"=>'',
		
		// ギリシャ文字（大文字）
		'&Alpha;'=>'A', 	'&Beta;'=>'B',			'&Gamma;'=>'{$\Gamma$}',
		'&Delta;'=>'{$\Delta$}', '&Epsilon;'=>'E',		'&Zeta;'=>'Z',
		'&Eta;'=>'H',		'&Theta;'=>'{$\Theta$}',	'&Iota;'=>'I',
		'&Kappa;'=>'K',		'&Lamdba;'=>'{$\Lambda$}',	'&Mu;'=>'M',
		'&Nu;'=>'N',		'&Xi;'=>'{$\Xi$}',		'&Omicron'=>'O',
		'&Pi;'=>'{$\Pi$}',	'&Rho;'=>'P',			'&Sigma;'=>'{$\Sigma$}',
		'&Tau;'=>'T',		'&Upsilon;'=>'{$\Upsilon$}',	'&Phi;'=>'{$\Phi$}',
		'&Chi;'=>'X',		'&Psi;'=>'{$\Psi$}',		'&Omega;'=>'{$\Omega$}',
		
		// ギリシャ文字（小文字）
		'&alpha;'=>'{$\alpha$}','&beta;'=>'{$\beta$}',		'&gamma;'=>'{$\gamma$}',
		'&delta;'=>'{$\delta$}','&epsilon;'=>'{$\epsilon$}',	'&zeta;'=>'{$\zeta$}',
		'&eta;'=>'{$\eta$}',	'&theta;'=>'{$\theta$}',	'&iota;'=>'{$\iota$}',
		'&kappa;'=>'{$\kappa$}','&lamdba;'=>'{$\lambda$}',	/*'&mu;'=>'{$\mu$}',*/
		'&mu;'=>'{\textmu}',
		'&nu;'=>'{$\nu$}',	'&xi;'=>'{$\xi$}',		'&omicron;'=>'o',
		'&pi;'=>'{$\pi$}',	'&rho;'=>'{$\rho$}',		'&sigma;'=>'{$\sigma$}',
		'&tau;'=>'{$\tau$}',	'&upsilon;'=>'{$\upsilon$}',	'&phi;'=>'{$\phi$}',
		'&chi;'=>'{$\chi$}',	'&psi;'=>'{$\psi$}',		'&omega;'=>'{$\omega$}',
		
		// ギリシャ文字(一部のみ）ヒューマンエラー対応
		'&Alpha'=>'A', 	'&Beta'=>'B',			'&Gamma'=>'{$\Gamma$}',
		'&Alpha:'=>'A', 	'&Beta:'=>'B',			'&Gamma:'=>'{$\Gamma$}',
		'&Delta'=>'{$\Delta$}', '&Epsilon'=>'E',		'&Zeta'=>'Z',
		'&Delta:'=>'{$\Delta$}', '&Epsilon:'=>'E',		'&Zeta:'=>'Z',
		'&alpha'=>'{$\alpha$}','&beta'=>'{$\beta$}',		'&gamma'=>'{$\gamma$}',
		'&alpha:'=>'{$\alpha$}','&beta:'=>'{$\beta$}',		'&gamma:'=>'{$\gamma$}',
		'&delta'=>'{$\delta$}','&epsilon'=>'{$\epsilon$}',	'&zeta'=>'{$\zeta$}',
		'&delta:'=>'{$\delta$}','&epsilon:'=>'{$\epsilon$}',	'&zeta:'=>'{$\zeta$}',
		
		// 追加記号
		'&nbsp;'=>'~',
		'&micro;'=>'{\textmu}',
		'&rdquo;'=>'"',
		'&aacute;'=>"{\'{a}}",
		'&eacute;'=>"{\'{e}}",
		'&auml;'=>'{\"{a}}',
		'&euml;'=>'{\"{e}}',
		'&iuml;'=>'{\"{i}}',
		'&uuml;'=>'{\"{u}}','&#252;'=>'{\"{u}}',
		'&aring;'=>'{\r{a}}',
		'&ecirc;'=>'{\^{e}}',
		'&Ouml;'=>'{\"{O}}','&ouml;'=>'{\"{o}}',
		'&ocirc;'=>'{\^{o}}',
		'&egrave;'=>'{\`{e}}',
		'&Eacute;'=>"{\'{E}}",
		
		
		'&middot;'=>'{\textperiodcentered}',
		'&#246;'=>'{\"{o}}',
		'|'=>'{\Pisymbol{psy}{"BD}}',
		
		
		// 記号類
		'&lt;'=>'{\textless}',
		'&gt;'=>'{\textgreater}',
		'&amp;'=>'\&',
		'&quot;'=>'"',
		'&deg;'=>'{\textdegree}',
		'°'=>'{\textdegree}',
		'&plusmn;'=>'{$\pm$}','&#177;'=>'{$\pm$}',
		'&minus;'=>'{\textminus}',
		'&times;'=>'{$\times$}',
		'&ge;'=>'{$\ge$}',
		'&le;'=>'{$\le$}',
		'&bull;'=>'{\textbullet}','&#8226;'=>'{\textbullet}','&#8729;'=>'{\textbullet}',
		
		'&#12316;'=>'～',
		'&#08451;'=>'{\textcelsius}',//度C
		'&sup1;'=>'<SUP>1</SUP>',//肩付きの1
		'&sup2;'=>'<SUP>2</SUP>',//肩付きの2
		'&#8318;'=>'<SUP>)</SUP>',//肩付きの)閉じ括弧
		
		'<SUP>&reg;</SUP>'=>'{\kern0.1em \textsuperscript{\Pisymbol{psy}{210}}}',// fixltx2eパッケージ
		//小文字追加
		'<sup>&reg;</sup>'=>'{\kern0.1em \textsuperscript{\Pisymbol{psy}{210}}}',// fixltx2eパッケージ
		'&reg;'=>'{\Pisymbol{psy}{210}}',
		'&copy;'=>'{\textcopyright}',
		'&'=>'\&',
		'<SUP>TM</SUP>'=>'{\texttrademark} ',
		' cm<SUP>2</SUP>'=>'~cm<SUP>2</SUP>',
		' cm<SUP>3</SUP>'=>'~cm<SUP>3</SUP>',
		' mm<SUP>2</SUP>'=>'~mm<SUP>2</SUP>',
		' mm<SUP>3</SUP>'=>'~mm<SUP>3</SUP>',
		' m<SUP>2</SUP>'=>'~m<SUP>2</SUP>',
		//小文字追加
		'<sup>TM</sup>'=>'{\texttrademark} ',
		' cm<sup>2</sup>'=>'~cm<SUP>2</SUP>',
		' cm<sup>3</sup>'=>'~cm<SUP>3</SUP>',
		' mm<sup>2</sup>'=>'~mm<SUP>2</SUP>',
		' mm<sup>3</sup>'=>'~mm<SUP>3</SUP>',
		' m<sup>2</sup>'=>'~m<SUP>2</SUP>',
		' kg,'=>'~kg,',
		' cm,'=>'~cm,',
		
		//&#8211を\textminusに置換した際上付文字にしたときに具合が悪かった
		'&#8211;'=>'{\Pisymbol{psy}{"2D}}','&ordm;'=>'{\textdegree}',
		'&#8804;'=>'{$\le$}','&#8805;'=>'{$\ge$}',
		
		//新たに追加する実態参照
		'&#8722;'=>'{\textminus}',
		'&#8210;'=>'{\textminus}',
		'&ndash;'=>'-',
		//謎文字削除
		'&#61472;'=>'',
		//中黒点
		'&#183;'=>'{\textperiodcentered}',
		'&#181;'=>'{\textmu}',
		'&#239;'=>'{\"{i}}',
		//TM
		'&#8482;'=>'{\texttrademark}',
		'&#174;'=>'{\textregistered}',
		//エスツェット(後の文字が詰まるため半角スペース追加)
		'&szlig;'=>'\ss\ ',
		'&#223;'=>'\ss\ ',
		//エスツェット(ピリオド付き）
		'&szlig;.'=>'\ss.\ ',
		'&#223;.'=>'\ss.\ ',
		'&#730;'=>'{\textdegree}',
		'&#945;'=>'{$\alpha$}',
		'&#946;'=>'{$\beta$}',
		'&acute;'=>'{\textasciiacute}',
		//謎文字(PJ-210)
		'&#61617;'=>' ',
		//謎文字(PJ-313)
		'&#61472'=>' ',
		'&#61472'=>' ',
		'&prime;'=>'{\Pisymbol{psy}{"A2}}',
		//'&frac12;'=>'{\textonehalf}',
		'&frac12;'=>'1/2',
		'&#8710;'=>'{$\Delta$}',
		//幅広ダッシュ
		'&#8212;'=>'{\Pisymbol{psy}{"BE}}',
		'&#8213;'=>'{\textthreequartersemdash}',
		'&#178;'=>'{\texttwosuperior}',
		'&lambda;'=>'{$\lambda$}',
		//カンマらしき…
		'&cedil;'=>'{\Pisymbol{psy}{"2C}}',
		//ファィ
		'&#934;'=>'{$\Phi$}',
		
		//アポストロフィ（シングルクォーテーション）
		//'&#039;'=>'{\Pisymbol{psy}{"A2}}',
		//' pg/mL,'=>'~pg/mL,',
		/* 'cm<SUP>2</SUP>'=>'{\ajLig{cm2}}',// 日本語フォントを使った単位の外字
		'cm<SUP>3</SUP>'=>'{\ajLig{cm3}}',   // １バイトとの外字(２バイトフォント)の混在は
		'mm<SUP>2</SUP>'=>'{\ajLig{mm2}}',   // 禁則処理を伴う無駄な改行を招くため封印
		'mm<SUP>3</SUP>'=>'{\ajLig{mm3}}',   // 
		'm<SUP>2</SUP>'=>'{\ajLig{m2}}',
		'cm<SUP>2</SUP>,'=>'\mbox{\ajLig{cm2},}',
		'cm<SUP>3</SUP>,'=>'\mbox{\ajLig{cm3},}',
		'mm<SUP>2</SUP>,'=>'\mbox{\ajLig{mm2},}',
		'mm<SUP>3</SUP,'=>'\mbox{\ajLig{mm3},}',
		'm<SUP>2</SUP>,'=>'\mbox{\ajLig{m2},}', */
		// 記号類ヒューマンエラー対応
		'& lt;'=>'{\textless}','&lt'=>'{\textless}','&lt:'=>'{\textless}','&lt;;'=>'{\textless}','&LT;'=>'{\textless}',
		'& gt;'=>'{\textgreater}','&gt'=>'{\textgreater}','&gt:'=>'{\textgreater}','&gt;;'=>'{\textgreater}',
		'& amp;'=>'\&','&amp'=>'\&','&amp:'=>'\&',
		'& quot;'=>'"','&quot'=>'"','&quot:'=>'"',
		'& deg;'=>'{\textdegree}','&deg'=>'{\textdegree}','&deg:'=>'{\textdegree}',
		'& plusmn;'=>'{$\pm$}','&plusmn'=>'{$\pm$}','&plusmn:'=>'{$\pm$}',
		'&amp;plusmn;'=>'{$\pm$}', '&pulusmn;'=>'{$\pm$}', '&plsmn;'=>'{$\pm$}',
		'&plusm;'=>'{$\pm$}',
		'& times;'=>'{$\times$}','&times'=>'{$\times$}','&times:'=>'{$\times$}',
		'& ge;'=>'{$\ge$}','&ge'=>'{$\ge$}','&ge:'=>'{$\ge$}',
		'& le;'=>'{$\le$}','&le'=>'{$\le$}','&le:'=>'{$\le$}',
		'&acute'=>'{\textasciiacute}',
		// SY-11 3（謎のタグは消去）
		'<cnb:1>'=>'','<cnb:>'=>'',
		
		// 分離禁止として処理
		'(-)'=>'{\mbox{(-)}}',
		'(+)'=>'{\mbox{(+)}}',
		// 行頭行末禁則として（スペースの後の開きまたは閉じ括弧直前直後にスペースがあった場合）
		'( '=>'(~',
		// 行頭行末禁則として（スペースで改行された場合約物が行頭に来ることを禁止）
		// ちなみに、~はTeX上では改行できないスペースとして解釈される
		' )'=>'~)',
		' ,'=>', ',
		' - '=>'~-~',
		' ;'=>'~;',
		' : '=>'~:~',
		' :'=>'~:',
		' = '=>'~=~',
		' ='=>'~=',
		' .'=>'~.',
		// 分離禁止として処理（TeXが-で改行しようとするため）
		'-,'=>'{\mbox{-,}}',
		//制御文字(制御文字が混入するとTEXが止まってしまう為空白に置換)
		"\x00"=>'',"\x01"=>'',"\x02"=>'',"\x03"=>'',"\x04"=>'',
		"\x05"=>'',"\x06"=>'',"\x07"=>'',"\x08"=>'',"\x09"=>'',
		"\x0a"=>'',"\x0b"=>'',"\x0c"=>'',"\x0d"=>'',"\x0e"=>'',
		"\x0f"=>'',"\x10"=>'',"\x11"=>'',"\x12"=>'',"\x13"=>'',
		"\x14"=>'',"\x15"=>'',"\x16"=>'',"\x17"=>'',"\x18"=>'',
		"\x19"=>'',"\x1a"=>'',"\x1b"=>'',"\x1c"=>'',"\x1d"=>'',
		"\x1e"=>'',"\x1f"=>'',"\x7f"=>'',
		
		//2011 JSGS66(漢字6種 XPでは表示不可)
		'&#22625;' => '{\CID{7751}}',
		'&#21702;' => '{\CID{14386}}',
		'&#32363;' => '{\CID{1832}}',
		'&#30317;' => '{\CID{14864}}',
		'&#31304;' => '{\CID{22133}}',
		'&#27243;' => '{\CID{8503}}',
		'&#63964;' => '{\CID{13393}}',
		
		//2011 JSGS66(記号 XPでは表示不可)
		'&#8470;'  => '{\CID{7610}}',
		'&#13199;' => '{\CID{7605}}',
		'&#8895;'  => '{\CID{7630}}',
		'&shy;' => ' ',
		
		//2010 JSGS65
		'&#126;' => '{\CID{95}}',
		'&#8451;' => '{\CID{710}}',
		'&#8544;' => '{\CID{7575}}',
		'&#8545;' => '{\CID{7576}}',
		'&#8546;' => '{\CID{7577}}',
		'&#8547;' => '{\CID{7578}}',
		'&#8552;' => '{\CID{7583}}',
		'&#8560;' => '{\CID{8092}}',
		'&#8561;' => '{\CID{8093}}',
		'&#8562;' => '{\CID{8094}}',
		'&#8806;' => '{\CID{702}}',
		'&#8807;' => '{\CID{703}}',
		'&#9312;' => '{\CID{7555}}',
		'&#9313;' => '{\CID{7556}}',
		'&#9314;' => '{\CID{7557}}',
		'&#9315;' => '{\CID{7558}}',
		'&#9316;' => '{\CID{7559}}',
		'&#13198;' => '{\CID{7604}}',
		'&#13212;' => '{\CID{7601}}',
		'&#13213;' => '{\CID{7602}}',
		'&#20893;' => '{\CID{8395}}',
		'&#22218;' => '{\CID{7770}}',
		'&#26625;' => '{\CID{8494}}',
		'&#27123;' => '{\CID{17847}}',
		'&#28661;' => '{\CID{8531}}',
		'&#28712;' => '{\CID{8534}}',
		'&#32214;' => '{\CID{8595}}',
		'&#33449;' => '{\CID{17067}}',
		'&#34095;' => '{\CID{17092}}',
		'&#39641;' => '{\CID{8705}}',
		'&#63785;' => '{\CID{20305}}',
		'&#64017;' => '{\CID{8443}}',
		'&#64026;' => '{\CID{8581}}',
		'&#65285;' => '{\CID{715}}',
		'&#65291;' => '{\CID{692}}',
		'&#65293;' => '{\CID{693}}',
		'&#65309;' => '{\CID{697}}',
		'&#65374;' => '{\CID{665}}',
		'&trade;' => '{\kern0.1em \CID{228}}',
		'&rarr;' => '{\CID{736}}',
		'&#13217;' => '{\CID{7607}}',
		'&#9317;' => '{\CID{7560}}',
		'&#9318;' => '{\CID{7561}}',
		'&#9319;' => '{\CID{7562}}',
		'&#9320;' => '{\CID{7563}}',
		'&#9321;' => '{\CID{7564}}',
		'&#8548;' => '{\CID{7579}}',
		'&#8549;' => '{\CID{7580}}',
		'&#8550;' => '{\CID{7581}}',
		'&#8551;' => '{\CID{7582}}',
		'&#8552;' => '{\CID{7583}}',
		'&#8553;' => '{\CID{7584}}',
		'&#35061;' => '{\CID{8615}}',
		'&#12849;' => '{\CID{7618}}',
		'&#24276;' =>'{\CID{19352}}',
		'&#26706;' =>'{\CID{8492}}',
		'&#37086;' =>'{\CID{8635}}',
		'&#37854;' =>'{\CID{8680}}',
		'&#38960;' =>'{\CID{7795}}',
		'&#8786;' =>'{\CID{762}}',
		'&#23874;' =>'{\CID{8444}}',
		
		'土`橋　卓也' => '{\CID{13953}}橋　卓也',
		'土橋　卓也' => '{\CID{13953}}橋　卓也',
		
		'<I></I>' => '',//**tk追加
		//'?' => '-',//**tk追加
		'&#8211;' =>'--',//en-dash(使い分けが微妙)
		'&#8212;' =>'---',//em-dash(使い分けが微妙)
		'&clubs;'=>'{\Pisymbol{psy}{"A7}}',
		'&diams;'=>'{\Pisymbol{psy}{"A8}}',
		'&hearts;;'=>'{\Pisymbol{psy}{"A9}}',
		'&spades;'=>'{\Pisymbol{psy}{"AA}}',
		
		// TeX用エスケープ(必須)
		'%'=>'{\%}',	'#'=>'{\#}',	'{'=>'{\{}',	'}'=>'{\}}', 
		'&'=>'{\&}',	'_'=>'{\_}',	/*'\\'=>'{\yen}',	'$'=>'{\$}',*/
	);
	
	public static function getTexMap()
	{
		return self::$tex_moji;
	}
}