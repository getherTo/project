<?php
/*
 * 文件创建于 2008-11-4 日 PHPeclipse - PHP - Code Templates
 */


/**
*删除字符串空格,返回删除空格后的字符串
**/
function delblank($string){
	$string=str_replace("&nbsp;","",$string);
//	$string=str_replace("　","",$string);	中文标点符号会受影响
	$string=preg_replace("/[\s\v]/","",$string);
    return $string;
}

/**
 * 去掉特殊字符，把分号转分全角分号，空格全部册除。
 */
function no_special_char ($str) {
	$str=trim($str);
	$str=str_replace("'","",$str);
	$str=str_replace('"',"",$str);
	$str=str_replace('\\',"",$str);
	$str=str_replace("<","＜",$str);
	$str=str_replace(">","＞",$str);
	$str=str_replace(";","；",$str);
	$str=preg_replace("/[\s\v]+/"," ",$str);
	return $str;
}

/**
*过滤安全字符
**/
function filtrate($msg){
//	$msg = str_replace('&amp;','&',$msg);
//	$msg = str_replace('&nbsp;',' ',$msg);
	$msg = str_replace('"','&quot;',$msg);
	$msg = str_replace("'",'&#39;',$msg);
	$msg = str_replace("<","&lt;",$msg);
	$msg = str_replace(">","&gt;",$msg);
	$msg = str_replace("\t"," ",$msg);
	$msg = str_replace("\r","",$msg);
	$msg = preg_replace("/[\s\v]+/"," ",$msg);
	return $msg;
}


/**
 * 将字符串转换成像<pre>标签的样式
 */
function likepre ($string) {
	$string = str_replace('"','&quot;',$string);
	$string = str_replace("'",'&#39;',$string);
	$string = str_replace("<","&lt;",$string);
	$string = str_replace(">","&gt;",$string);
	$string = str_replace("\t","　",$string);		//换为全角空格
	$string = str_replace("  ","　",$string);		//两个半角空格换为全角空格
	$string = str_replace("\n","<br/>",$string);
	return $string;
}


/**
 * 去掉成对的尖括号及里面的HTML内容.&lt;表示的不会被操作
 * 系统函数strip_tags去除尖括号及里面的 所有 内容。
 * 参数与系统函数一样，可先参数$oktages是要保留的tags，$filt是要替换成的内容。
 * tage定义：在一对尖括号中间，第一个字符必须是字母或 / 。
 */
function filttags ($content,$oktages='',$filt='') {
	$content=str_replace("&nbsp;"," ",$content);
	$content=preg_replace("/[\s\v]+/",' ',$content);
	$preg="/<[a-zA-Z\/][^>]*>/";									//tages的正则表达式。
	$pregoktages="/([^a-z]*)([a-z][a-z0-9]*)([^a-z]*)/i";			//将tages的内容分离出来的正则式
	if(preg_match("/[a-zA-Z]+/",$oktages)){							//如果有要保留的tages。
		$oktages=preg_replace($pregoktages,"|\\2\b",$oktages);		//将各个tage用竖线隔开
		$oktages=substr($oktages,1);								//去掉第一个竖线。
		$content=preg_replace("/<(\/?)($oktages)([^>]*)>/isU","<宜\n云LIN\\1\\2\\3>",$content);    //在要保护的tage中加上  宜\n云LIN
		$content=preg_replace($preg,$filt,$content);	//替换合法的tages
		$content=preg_replace("/<宜\n云LIN(\/?)($oktages)([^>]*?)>/isU","<\\1\\2\\3>",$content);   //在要保护的tage中解除  宜\n云LIN
	}else{				//否则没有要保留的tage，把所有tage除掉
		$content=preg_replace($preg,$filt,$content);	//将尖括号及里面的字符替换成指定字符.
	}
	return $content;
}


/**
 * 去除tage里的 < ，防止通过嵌套的方式写入html代码。
 */
function tosafehtmlcallback ($content) {
	$okcontent=substr($content[0],1);		//参数里是个完整的tage ，先把第一个“<”去掉。
	$okcontent=str_replace("<","&lt;",$okcontent);
//	$okcontent=preg_replace("/(<)([a-zA-Z\/])/","&lt;\\2",$okcontent);		//找到后面是字母或/的尖括号，换成"&lt;"
	return "<".$okcontent;
}

/**
 * 去除内容中危险的HTML代码
 */
function tosafehtml($content,$strict=0){
	$preg = array(
		"/[\s\v]+/",																		//过滤多余的空白
		"/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU",  //过滤 <script 等可能引入恶意内容或恶意改变显示布局的代码,如果不需要插入flash等,还可以加入<object的过滤
		"/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",                                      //过滤javascript的on事件
	);
	if($strict==0){
	$preg2 = array(
		" ",
		"&lt;\\1\\2\\3&gt;",           //如果要直接清除不安全的标签，这里可以留空
		"\\1\\2",
	);
	}else{		//严格过滤。
	$preg2 = array(
		" ",
		"",
		"\\1\\2",
	);
	}
	$prgecallback="/<[a-zA-Z\/][^>]*>/";
	$content = preg_replace_callback($prgecallback,tosafehtmlcallback,$content);
	$content = preg_replace( $preg,$preg2,$content);
	return $content;
}


/**
 * 截取字符串含数，对系统函数的改进，不会将中文变乱。
 */
function mysubstr ($str,$start,$len=0) {
	$tolen=strlen($str);
	//为方便操作，先将起始值和长度值转换为正数
	if($start<0)$start=$tolen+$start;
	if($start>$tolen)return "";
	if($len<=0)$len=($tolen+$len)-$start;
	if($len<1)return "";
	if($len>$tolen)$len=$tolen;
	for($i=0;$i<$start;$i++){
		if(ord(substr($str,$i,1))>127){$i++;}
	}
	$start=$i;			//起始位置计算完成
	for($k=0;$k<$len;$k++,$i++){
		if(ord(substr($str,$i,1))>127){$i++;$k++;}
	}
	$len=$k;			//长度计算完成
	return substr($str,$start,$len);
}


/**
 * 找出文本中的URL,成功返回找到的URL数组.失败返回 false。对中文网址无效
 * mod为辨认方式，缺省以http://为标准，还可以以www为标记，其它任何值为混合模式。
 */
function findurl ($content,$mod='http') {
	$mod=strtolower($mod);
	if($mod=='http')
		$preg="/(http:\/\/[-\w]{1,12})(\.[-\w]{1,12}){1,3}\/?([-\w]{1,12}\/){0,3}([-\w]{1,15}\.?[-\w]{1,4})?(\?[-\w\=\&\%\:\/\.]{0,70})?/i";
	elseif($mod=='www')
		$preg="/(http:\/\/)?www(\.[-\w]{1,12}){1,3}\/?([-\w]{1,12}\/){0,3}([-\w]{1,15}\.?[-\w]{1,4})?(\?[-\w\=\&\%\:\/\.]{0,70})?/i";
	else
		$preg="/((http:\/\/[-\w]{1,12})|((http:\/\/)?www))(\.[-\w]{1,12}){1,3}\/?([-\w]{1,12}\/){0,3}([-\w]{1,15}\.?[-\w]{1,4})?(\?[-\w\=\&\%\:\/\.]{0,70})?/i";
	@preg_match_all($preg,$content,$arrurl,PREG_PATTERN_ORDER);
	if($arrurl[0]){
		return $arrurl[0];
	}else{
		return false;
	}
}


/**
 *找出内容中的E-Mail地址，成功返回一个数组，失败返回false。
 */
function findemail ($content) {
	$preg="/[-\w]{1,20}@[-\w]{1,12}(\.[-\w]{1,12}){1,2}/";
	preg_match_all($preg,$content,$arrurl,PREG_PATTERN_ORDER);
	if($arrurl[0]){
		return $arrurl[0];
	}else{
		return false;
	}
}


/**
 * 主要是为contentaddlink,contentaddmailto函数准备
 * 也可单独使用（参数为URL），给URL加上超链接
 */
function addlink ($url) {
	if(is_array($url)){
		if(strstr($url[0],'@')){
			return "<a href='mailto:".$url[0]."'>".$url[0]."</a>";
		}else{
			if(preg_match("/http/i",$url[0])){
				return "<a href='$url[0]' target='_blank'>$url[0]</a>";
			}else{
				return "<a href='http://$url[0]' target='_blank'>$url[0]</a>";
			}
		}
	}else{
		if(strstr($url,'@')){
			return "<a href=mailto:'".$url."'>".$url."</a>";
		}else{
			return "<a href='".$url."' target='_blank'>".$url."</a>";
		}
	}
}


/**
 * 先从文本中找出相关URL,然后加上超链接。返回处理后的字符串。
 */
function contentaddlink ($content,$mod='http') {
	$mod=strtolower($mod);
	if($mod=='http')
		$preg="/(http:\/\/[-\w]{1,12})(\.[-\w]{1,12}){1,3}\/?([-\w]{1,12}\/){0,3}([-\w]{1,15}\.?[-\w]{1,4})?(\?[-\w\=\&\%\:\/\.]{0,70})?/i";
	elseif($mod=='www')
		$preg="/(http:\/\/)?www(\.[-\w]{1,12}){1,3}\/?([-\w]{1,12}\/){0,3}([-\w]{1,15}\.?[-\w]{1,4})?(\?[-\w\=\&\%\:\/\.]{0,70})?/i";
	else
		$preg="/((http:\/\/[-\w]{1,12})|((http:\/\/)?www))(\.[-\w]{1,12}){1,3}\/?([-\w]{1,12}\/){0,3}([-\w]{1,15}\.?[-\w]{1,4})?(\?[-\w\=\&\%\:\/\.]{0,70})?/i";
	$okcontent=preg_replace_callback($preg,addlink,$content);
	return $okcontent;
}


/**
 *  先从文本中找出相关E-Mail,然后加上超链接。返回处理后的字符串。
 */
function contentaddmailto ($content) {
	$preg="/[-\w]{1,20}@[-\w]{1,12}(\.[-\w]{1,12}){1,2}/";
	$okcontent=preg_replace_callback($preg,addlink,$content);
	return $okcontent;
}


/**
 * 格式化时间输出
 */
function formatdate ($timestamp=0,$format='y-m-d') {
	if($format=="")$format="y-m-d";
	if(trim($format)=="不显示")return "";
	$timestamp||$timestamp=mktime();
	$format=str_replace('h','H',$format);
	$format=str_replace('年','y',$format);
	$format=str_replace('月','m',$format);
	$format=str_replace('日','d',$format);
	$format=str_replace('时','H',$format);
	$format=str_replace('分','i',$format);
	$format=str_replace('秒','s',$format);
	$format=str_replace('星期','星期w',$format);
	$str=date($format,$timestamp);
	$arr1=array("星期0","星期1","星期2","星期3","星期4","星期5","星期6");
	$arr2=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	return $str=str_replace($arr1,$arr2,$str);
}


/**
 * 显示分页函数
 * records总记录数，currentpage当前页数，rows每页记录数，listpage页号列表长度。
 */
function showpage ($records,$currentpage,$rows=20,$listpages=7) {
	if($records<1)return '';
	if($rows<1)$rows=20;
	if($listpages<3)$listpages=7;
	$action=$_SERVER['QUERY_STRING'];		//得到地址栏中？后的内容
	if($action){							//将page=...的内容去掉
		$action=preg_replace("/&page\b[^\&]*/","",$action);
		$action=preg_replace("/\bpage\b[^\&]*\&*/","",$action);
	}
	if($action)$action.='&';
	$maxpage=ceil($records/$rows);		//进一法取整得到最大页数。
	$middlepage=floor($listpages/2);	//舍去法取整得到要显示的页数的一半。
	if($currentpage<1||$currentpage>$maxpage)$currentpage=1;
	$startpage=$currentpage-$middlepage;
	if($maxpage-$currentpage<=$middlepage)$startpage=$maxpage-$listpages;
	if($startpage<2)$startpage=2;				//开始页计算完成
	$endpage=$startpage+$listpages;
	if($endpage>$maxpage)$endpage=$maxpage;		//结束页计算完成
	if($currentpage!=1){
		$pagestr="<a href='?{$action}page=1'><span>1</span></a> ";
	}else{
		$pagestr="<span>1</span> ";
	}
	if($maxpage==1)return $pagestr."&nbsp;&nbsp;<span>{$currentpage}/{$maxpage}</span>";
	if($startpage!=2)$pagestr.="&lt; ";
	for($i=$startpage;$i<$endpage;$i++){
		if($i==$currentpage){
			$pagestr.="<span>$i</span> ";
		}else{
			$pagestr.="<a href='?{$action}page=$i'><span>$i</span></a> ";
		}
	}
	if($endpage!=$maxpage)$pagestr.="&gt; ";
	if($currentpage>=$maxpage){
		$pagestr.="<span>$maxpage</span>";
	}else{
		$pagestr.="<a href='?{$action}page=$maxpage'><span>$maxpage</span></a>";
	}
	$pagestr.="&nbsp;&nbsp;<span>{$currentpage}/{$maxpage}</span>";
	return $pagestr;
}


/**
 * 将汉字转换为拼音，只能是简体汉字
 * 使用分段法查找，用过二分法查找，最内层循环减到分段法的一半，但时间反而是分段查找的1.5倍
 * 可能是二分法的条件判断太多造成的吧。因为分段法循环内只有一个条件判断。
 */
function hanzitopinyin ($content) {
	$d=array(
		array("a",-20319),array("ai",-20317),array("an",-20304),array("ang",-20295),array("ao",-20292),
		array("ba",-20283),array("bai",-20265),array("ban",-20257),array("bang",-20242),array("bao",-20230),
		array("bei",-20051),array("ben",-20036),array("beng",-20032),array("bi",-20026),array("bian",-20002),
		array("biao",-19990),array("bie",-19986),array("bin",-19982),array("bing",-19976),array("bo",-19805),
		array("bu",-19784),array("ca",-19775),array("cai",-19774),array("can",-19763),array("cang",-19756),
		array("cao",-19751),array("ce",-19746),array("ceng",-19741),array("cha",-19739),array("chai",-19728),
		array("chan",-19725),array("chang",-19715),array("chao",-19540),array("che",-19531),array("chen",-19525),
		array("cheng",-19515),array("chi",-19500),array("chong",-19484),array("chou",-19479),array("chu",-19467),
		array("chuai",-19289),array("chuan",-19288),array("chuang",-19281),array("chui",-19275),array("chun",-19270),
		array("chuo",-19263),array("ci",-19261),array("cong",-19249),array("cou",-19243),array("cu",-19242),
		array("cuan",-19238),array("cui",-19235),array("cun",-19227),array("cuo",-19224),array("da",-19218),
		array("dai",-19212),array("dan",-19038),array("dang",-19023),array("dao",-19018),array("de",-19006),
		array("deng",-19003),array("di",-18996),array("dian",-18977),array("diao",-18961),array("die",-18952),
		array("ding",-18783),array("diu",-18774),array("dong",-18773),array("dou",-18763),array("du",-18756),
		array("duan",-18741),array("dui",-18735),array("dun",-18731),array("duo",-18722),array("e",-18710),
		array("en",-18697),array("er",-18696),array("fa",-18526),array("fan",-18518),array("fang",-18501),
		array("fei",-18490),array("fen",-18478),array("feng",-18463),array("fo",-18448),array("fou",-18447),
		array("fu",-18446),array("ga",-18239),array("gai",-18237),array("gan",-18231),array("gang",-18220),
		array("gao",-18211),array("ge",-18201),array("gei",-18184),array("gen",-18183),array("geng",-18181),
		array("gong",-18012),array("gou",-17997),array("gu",-17988),array("gua",-17970),array("guai",-17964),
		array("guan",-17961),array("guang",-17950),array("gui",-17947),array("gun",-17931),array("guo",-17928),
		array("ha",-17922),array("hai",-17759),array("han",-17752),array("hang",-17733),array("hao",-17730),
		array("he",-17721),array("hei",-17703),array("hen",-17701),array("heng",-17697),array("hong",-17692),
		array("hou",-17683),array("hu",-17676),array("hua",-17496),array("huai",-17487),array("huan",-17482),
		array("huang",-17468),array("hui",-17454),array("hun",-17433),array("huo",-17427),array("ji",-17417),
		array("jia",-17202),array("jian",-17185),array("jiang",-16983),array("jiao",-16970),array("jie",-16942),
		array("jin",-16915),array("jing",-16733),array("jiong",-16708),array("jiu",-16706),array("ju",-16689),
		array("juan",-16664),array("jue",-16657),array("jun",-16647),array("ka",-16474),array("kai",-16470),
		array("kan",-16465),array("kang",-16459),array("kao",-16452),array("ke",-16448),array("ken",-16433),
		array("keng",-16429),array("kong",-16427),array("kou",-16423),array("ku",-16419),array("kua",-16412),
		array("kuai",-16407),array("kuan",-16403),array("kuang",-16401),array("kui",-16393),array("kun",-16220),
		array("kuo",-16216),array("la",-16212),array("lai",-16205),array("lan",-16202),array("lang",-16187),
		array("lao",-16180),array("le",-16171),array("lei",-16169),array("leng",-16158),array("li",-16155),
		array("lia",-15959),array("lian",-15958),array("liang",-15944),array("liao",-15933),array("lie",-15920),
		array("lin",-15915),array("ling",-15903),array("liu",-15889),array("long",-15878),array("lou",-15707),
		array("lu",-15701),array("lv",-15681),array("luan",-15667),array("lue",-15661),array("lun",-15659),
		array("luo",-15652),array("ma",-15640),array("mai",-15631),array("man",-15625),array("mang",-15454),
		array("mao",-15448),array("me",-15436),array("mei",-15435),array("men",-15419),array("meng",-15416),
		array("mi",-15408),array("mian",-15394),array("miao",-15385),array("mie",-15377),array("min",-15375),
		array("ming",-15369),array("miu",-15363),array("mo",-15362),array("mou",-15183),array("mu",-15180),
		array("na",-15165),array("nai",-15158),array("nan",-15153),array("nang",-15150),array("nao",-15149),
		array("ne",-15144),array("nei",-15143),array("nen",-15141),array("neng",-15140),array("ni",-15139),
		array("nian",-15128),array("niang",-15121),array("niao",-15119),array("nie",-15117),array("nin",-15110),
		array("ning",-15109),array("niu",-14941),array("nong",-14937),array("nu",-14933),array("nv",-14930),
		array("nuan",-14929),array("nue",-14928),array("nuo",-14926),array("o",-14922),array("ou",-14921),
		array("pa",-14914),array("pai",-14908),array("pan",-14902),array("pang",-14894),array("pao",-14889),
		array("pei",-14882),array("pen",-14873),array("peng",-14871),array("pi",-14857),array("pian",-14678),
		array("piao",-14674),array("pie",-14670),array("pin",-14668),array("ping",-14663),array("po",-14654),
		array("pu",-14645),array("qi",-14630),array("qia",-14594),array("qian",-14429),array("qiang",-14407),
		array("qiao",-14399),array("qie",-14384),array("qin",-14379),array("qing",-14368),array("qiong",-14355),
		array("qiu",-14353),array("qu",-14345),array("quan",-14170),array("que",-14159),array("qun",-14151),
		array("ran",-14149),array("rang",-14145),array("rao",-14140),array("re",-14137),array("ren",-14135),
		array("reng",-14125),array("ri",-14123),array("rong",-14122),array("rou",-14112),array("ru",-14109),
		array("ruan",-14099),array("rui",-14097),array("run",-14094),array("ruo",-14092),array("sa",-14090),
		array("sai",-14087),array("san",-14083),array("sang",-13917),array("sao",-13914),array("se",-13910),
		array("sen",-13907),array("seng",-13906),array("sha",-13905),array("shai",-13896),array("shan",-13894),
		array("shang",-13878),array("shao",-13870),array("she",-13859),array("shen",-13847),array("sheng",-13831),
		array("shi",-13658),array("shou",-13611),array("shu",-13601),array("shua",-13406),array("shuai",-13404),
		array("shuan",-13400),array("shuang",-13398),array("shui",-13395),array("shun",-13391),array("shuo",-13387),
		array("si",-13383),array("song",-13367),array("sou",-13359),array("su",-13356),array("suan",-13343),
		array("sui",-13340),array("sun",-13329),array("suo",-13326),array("ta",-13318),array("tai",-13147),
		array("tan",-13138),array("tang",-13120),array("tao",-13107),array("te",-13096),array("teng",-13095),
		array("ti",-13091),array("tian",-13076),array("tiao",-13068),array("tie",-13063),array("ting",-13060),
		array("tong",-12888),array("tou",-12875),array("tu",-12871),array("tuan",-12860),array("tui",-12858),
		array("tun",-12852),array("tuo",-12849),array("wa",-12838),array("wai",-12831),array("wan",-12829),
		array("wang",-12812),array("wei",-12802),array("wen",-12607),array("weng",-12597),array("wo",-12594),
		array("wu",-12585),array("xi",-12556),array("xia",-12359),array("xian",-12346),array("xiang",-12320),
		array("xiao",-12300),array("xie",-12120),array("xin",-12099),array("xing",-12089),array("xiong",-12074),
		array("xiu",-12067),array("xu",-12058),array("xuan",-12039),array("xue",-11867),array("xun",-11861),
		array("ya",-11847),array("yan",-11831),array("yang",-11798),array("yao",-11781),array("ye",-11604),
		array("yi",-11589),array("yin",-11536),array("ying",-11358),array("yo",-11340),array("yong",-11339),
		array("you",-11324),array("yu",-11303),array("yuan",-11097),array("yue",-11077),array("yun",-11067),
		array("za",-11055),array("zai",-11052),array("zan",-11045),array("zang",-11041),array("zao",-11038),
		array("ze",-11024),array("zei",-11020),array("zen",-11019),array("zeng",-11018),array("zha",-11014),
		array("zhai",-10838),array("zhan",-10832),array("zhang",-10815),array("zhao",-10800),array("zhe",-10790),
		array("zhen",-10780),array("zheng",-10764),array("zhi",-10587),array("zhong",-10544),array("zhou",-10533),
		array("zhu",-10519),array("zhua",-10331),array("zhuai",-10329),array("zhuan",-10328),array("zhuang",-10322),
		array("zhui",-10315),array("zhun",-10309),array("zhuo",-10307),array("zi",-10296),array("zong",-10281),
		array("zou",-10274),array("zu",-10270),array("zuan",-10262),array("zui",-10260),array("zun",-10256),
		array("zuo",-10254)
	);
	$sumpy=count($d)-1;
	$pingyin="";
	for($i=0;$i<strlen($content);$i++){		//循环一
		$p=ord(substr($content,$i,1));
		if($p>160){
			$q=ord(substr($content,++$i,1));
			$p=$p*256+$q-65536;
		}								//完成取字操作
		if($p>0&&$p<160){
			$pingyin.=chr($p);
		}elseif($p>-20320&&$p<-10246){			//查找拼音段开始
			for($jump=$sumpy;$jump>18;){
				$jump-=18;
				if($d[$jump][1]<$p){		//跳跃式查找。
					$jump+=18;
					break;
				}
			}
			for($j=$jump;$j>=0;$j--){		//详细查找。
				if($d[$j][1]<=$p)break;
			}
			$pingyin.=$d[$j][0];
		}		//查找拼音段结束
	}		//循环一结束
	return $pingyin;
}


/**
 * 获取浏览器类型,返回字符串。
 */
function browseinfo() {
	$browser="";
	$browserver="";
	$Browsers =array("Lynx","MOSAIC","AOL","Opera","JAVA","MacWeb","WebExplorer","OmniWeb");
	$Agent = $_SERVER["HTTP_USER_AGENT"];
	for ($i=0; $i<=7; $i++) {
		if (strpos($Agent,$Browsers[$i])) {
			$browser = $Browsers[$i];
			$browserver ="";
		}
	}
	if (ereg("Mozilla",$Agent) && !ereg("MSIE",$Agent)) {
		if(ereg("Firefox",$Agent)){
			$browserver="";
			preg_match("/Firefox\/([\d\.]+)/",$Agent,$browser);
			$browser = "火狐 ".$browser[1];
		}else{
			$temp =explode("(", $Agent); $Part=$temp[0];
			$temp =explode("/", $Part); $browserver=$temp[1];
			$temp =explode(" ",$browserver); $browserver=$temp[0];
			$browserver =preg_replace("/([\d\.]+)/","\\1",$browserver);
			$browserver = " $browserver";
			$browser = "Netscape Navigator";
		}

	}
	if (ereg("Mozilla",$Agent) && ereg("Opera",$Agent)) {
		$temp =explode("(", $Agent); $Part=$temp[1];
		$temp =explode(")", $Part); $browserver=$temp[1];
		$temp =explode(" ",$browserver);$browserver=$temp[2];
		$browserver =preg_replace("/([\d\.]+)/","\\1",$browserver);
		$browserver = " $browserver";
		$browser = "Opera";
	}
	if (ereg("Mozilla",$Agent) && ereg("MSIE",$Agent)) {
		if(ereg("MAXTHON",$Agent)){
			$browserver="";
			preg_match("/MAXTHON\s([\d\.]+)/",$Agent,$browser);
			$browser="傲游 ".$browser[1];
		}else{
			$temp = explode("(", $Agent); $Part=$temp[1];
			$temp = explode(";",$Part); $Part=$temp[1];
			$temp = explode(" ",$Part);$browserver=$temp[2];
			$browserver =preg_replace("/([\d\.]+)/","\\1",$browserver);
			$browserver = " $browserver";
			$browser = "IE";
		}
	}
	if ($browser!="") {
		$browseinfo = "$browser$browserver";
	}else {
		$browseinfo = "未知的浏览器";
	}
	return $browseinfo;
}

/**
 * 获取操作系统类型，返回字符串。
 */
function osinfo() {
	$os="";
	$Agent =$_SERVER["HTTP_USER_AGENT"];
	if (eregi('win',$Agent) && strpos($Agent, '95')) {
		$os="Windows 95";
	}elseif (eregi('win 9x',$Agent) && strpos($Agent, '4.90')) {
		$os="Windows ME";
	}elseif (eregi('win',$Agent) && ereg('98',$Agent)) {
		$os="Windows 98";
	}elseif (eregi('win',$Agent) && eregi('nt 5\.0',$Agent)) {
		$os="Windows 2000";
	}elseif (eregi('win',$Agent) && eregi('nt 5\.1',$Agent)) {
		$os="Windows XP";
	}elseif (eregi('win',$Agent) && eregi('nt',$Agent)) {
		$os="Windows NT";
	}elseif (eregi('win',$Agent) && ereg('32',$Agent)) {
		$os="Windows 32";
	}elseif (eregi('linux',$Agent)) {
		$os="Linux";
	}elseif (eregi('unix',$Agent)) {
		$os="Unix";
	}elseif (eregi('sun',$Agent) && eregi('os',$Agent)) {
		$os="SunOS";
	}elseif (eregi('ibm',$Agent) && eregi('os',$Agent)) {
		$os="IBM OS/2";
	}elseif (eregi('Mac',$Agent) && eregi('PC',$Agent)) {
		$os="Macintosh";
	}elseif (eregi('PowerPC',$Agent)) {
		$os="PowerPC";
	}elseif (eregi('AIX',$Agent)) {
		$os="AIX";
	}elseif (eregi('HPUX',$Agent)) {
		$os="HPUX";
	}elseif (eregi('NetBSD',$Agent)) {
		$os="NetBSD";
	}elseif (eregi('BSD',$Agent)) {
		$os="BSD";
	}elseif (ereg('OSF1',$Agent)) {
		$os="OSF1";
	}elseif (ereg('IRIX',$Agent)) {
		$os="IRIX";
	}elseif (eregi('FreeBSD',$Agent)) {
		$os="FreeBSD";
	}
	if ($os=='') $os = "Unknown";
	return $os;
}

/**
 *返回浏览者的IP地址.
 */
function fkip () {
	if($_SERVER['HTTP_CLIENT_IP']){
		$onlineip=$_SERVER['HTTP_CLIENT_IP'];
	}elseif($_SERVER['HTTP_X_FORWARDED_FOR']){
		$onlineip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$onlineip=$_SERVER['REMOTE_ADDR'];
	}
	return $onlineip;
}
/**
 * 返回当前页面的地址.
 */
function selfurl () {
	$selfurl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$_SERVER['QUERY_STRING'] && $selfurl .= "?".$_SERVER['QUERY_STRING'];
	return $selfurl;
}


function read_file($filename,$method="rb"){
	if($handle=@fopen($filename,$method)){
		@flock($handle,LOCK_SH);
		$filedata=@fread($handle,@filesize($filename));
		@fclose($handle);
	}
	return $filedata;
}

/**
*写文件函数,如文件不存在将会被创建.
*返回 1 表示成功, 0 表示失败.
**/
function write_file($filename,$data,$method="rb+",$iflock=1){
	@touch($filename);
	$handle=@fopen($filename,$method);
	if($iflock){
		@flock($handle,LOCK_EX);
	}
	@fputs($handle,$data);
	if($method=="rb+") @ftruncate($handle,strlen($data));
	@fclose($handle);
	@chmod($filename,0777);
	if( is_writable($filename) ){
		return 1;
	}else{
		return 0;
	}
}

/**
*!!!!删除文件,值不为空，返回不能删除的文件名.如果是目录,将把整个目录删除
**/
function del_file($path){
	if (file_exists($path)){
		if(is_file($path)){
			if(	!@unlink($path)	){
				$show.="$path,";
			}
		} else{
			$handle = opendir($path);
			while (($file = readdir($handle))!='') {
				if (($file!=".") && ($file!="..") && ($file!="")){
					if (is_dir("$path/$file")){
						$show.=del_file("$path/$file");
					} else{
						if( !@unlink("$path/$file") ){
							$show.="$path/$file,";
						}
					}
				}
			}
			closedir($handle);
			if(!@rmdir($path)){
				$show.="$path,";
			}
		}
	}
	return $show;
}

/**
 * 上传文件函数
 * 参数：表单属性名，文件存储路径，文件最大尺寸，允许的类型。
 * 成功返回一个数组，['name']为上传后带路径文件名，[size]为文件大小，KB为单位。
 * 出错返回相关错误文字说明。
 */
function upfile ($file,$path,$maxsize=100,$type=".jpg .gif .bmp .png") {
//	$maxsize*=1024;
	if(!is_array($_FILES[$file]))return false;
	$yname=$_FILES[$file]['name'];
	$tmpname=$_FILES[$file]['tmp_name'];
	$filesize=abs($_FILES[$file]['size']);
	$fileerror=$_FILES[$file]['error'];
	$filetype=strtolower(strrchr($yname,"."));
	if(!is_dir($path))return "文件存储路径 \"{$path}\" 不存在";
	if(!is_writable($path))return "权限不足，无法写入文件";
	if(!$filetype)return "文件类型错误";
	if($filetype=='.php'||$filetype=='.asp'||$filetype=='.aspx'||$filetype=='.jsp'||$filetype=='.cgi')
		{return "为了大家的安全，请不要上传可执行文件";}
	if($fileerror)return "未知错误，上传失败";
	if($filesize<1||$filesize>$maxsize*1024)return "请不要上传超过 {$maxsize}K 的文件";
	if(!in_array($filetype,explode(" ",$type)))return "你能上传的文件类型为 $type";
	$prename="1";
	while(true){
		$newfilename=$path."/".date("ymdHis")."_".$prename.$filetype;
		if(!is_file($newfilename))break;
		$prename++;
	}
	if(@move_uploaded_file($tmpname,$newfilename)){
		@chmod($newfilename, 0777);
		$newfile['name']=$newfilename;
		$newfile['size']=round($filesize/1024,2);
		return $newfile;
	}else{
		return "未知错误2，上传失败";
	}
}


?>
