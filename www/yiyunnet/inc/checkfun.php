<?php
/*
 * 文件创建于 2008-10-2 日 PHPeclipse - PHP - Code Templates
 */



/**
 * 检查是否有效的URL地址。返回逻辑值。
 */
function checkurl ($urladdr) {
	$urladdr=trim($urladdr);
	if(strlen($urladdr)<4 or strlen($urladdr)>100)return false;
	if(!strstr($urladdr,'.'))return false;   //如果不带　.　号为非法URL。
	$badchar=explode(" ","+ ' 　 ( ) < > [ ] { } \\ ; \" ".chr(0)." -- .. @@ @.");//定义不能有的字符。
	$count=count($badchar);
	for($i=0;$i<$count;$i++){
		if(strstr($urladdr,$badchar[$i]))return false;  //如果找到上述字符，定义为非法URL。
	}
	if(strstr($urladdr,' '))return false;  //如果找到半角空格，定义为非法URL。
	$urlchar=str_split($urladdr);  //将URL拆成每一个字节。
	$count=count($urlchar);
	if($urlchar[0]=='@' or $urlchar[0]=='.' or $urlchar[$count-1]=='@' or $urlchar[$count-1]=='.')return false;  //如果URL开始或结束找到 "@ ." 定义为非法URL。
	$echar=explode('@',$urladdr);
	if(count($echar)>2)return false;
	if(count($echar)==2){
		if(!strstr($echar[1],'.'))return false;
	}
	return true;
}
/**
 * 检查是否有效的E-Mail地址，返回逻辑值
 * 要用到checkurl函数。
 */
function checkemail ($emailaddr) {
	if(!checkurl($emailaddr))return false;
	if(!strstr($emailaddr,'@'))return false;
	return true;

}
/**
 * 检查是否外部链接。如果是外部链接返回 真。
 * 参数：路径（文件名）前不用斜杠，判断是否本域名该路径下链接而来。
 */
function isoutlink($path=''){
	$hostname=$_SERVER[SERVER_NAME];  //获取服务器名字
	if($path!='')$hostname=$hostname.'/'.$path;  //服务器名加上指定路径
	$lastpage=$_SERVER[HTTP_REFERER];   //获取来源页面(不一定真实)
	$lasthost=substr($lastpage,7,strlen($hostname));  //将来源页面去掉HTTP：//后取相同长度。
	if(strcmp($hostname,$lasthost)==0)return false; //内部链接
	return true; //是指定外的链接
}

/**
 * 检查用户名格式是否正确。4-16个中文，字母，数字，下划线，横线
 */
function checkusername ($name,$min=4,$max=16) {
	if(strlen($name)<$min or strlen($name)>$max)return false;
	$preg="/^[\w\\x80-\\xff-]+$/";  //定义字符范围。
//	echo "<textarea cols=80>$preg</textarea>";   //这行是调试用的。
	if(!preg_match($preg,$name))return false;
	if(strstr($name,'　'))return false;   //不允许有全角空格
	return true;
}


/**
 * 检查密码格式是否正确。
 */
function checkpassword($password,$min=6,$max=32){
	if(strlen($password)<$min or strlen($password)>$max)return false;
	$preg="/\A[\!#-&\(-\~]+\Z/";   //定义字符范围(ASCII 33-126中除掉两个引号)。
//	echo "<textarea cols=80>$preg</textarea>";   //这行是调试用的
	if(preg_match($preg,$password))return true;
	return false;
}

/**
 * 检查是否是合法的电话号码，固定电话号码返回1，手机号码返回2。
 * 不是电话号码返回false。
 */
function checkphone ($phone) {
	$preggh="/\A(0[0-9]{2,3}[- ]?)?[2-9][0-9]{6,7}([- ]\d{1,6})?\Z/";  //固定电话格式
	$pregsj="/\A0?1[53][0-9]{9}\Z/";              //手机号码格式
	if(preg_match($pregsj,$phone))return 2;
	if(preg_match($preggh,$phone))return 1;
	return false;
}

/**
 * 检查是否有效邮编
 */
function checkpost ($post) {
	$preg="/\A[0-9]{6}\Z/";
	if(preg_match($preg,$post))return true;
	return false;
}

/**
 * 检查IP地址是否正确。
 */
function checkipaddres ($ipaddres) {
	$preg="/\A((([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\.){3}(([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\Z/";
	if(preg_match($preg,$ipaddres))return true;
	return false;
}

/**
 * 检查身份证号码
 * 参数：15位或18位身份证号码，可选参数 $len 可以15位号码。
 * 返回值：失败返回FALSE，成功返回一个18位的身份证号
 */
function checksfznum ($sfznum,$len='both') {
	if(strlen($sfznum)==15&&$len=='both'){    //当$len不等于'both'时，15位号码无效
		$truenum=substr($sfznum,0,6).'19'.substr($sfznum,6);             //为返回18位号码作准备。
		$preg="/^[\d]{8}((0[1-9])|(1[0-2]))((0[1-9])|([12][\d])|(3[01]))[\d]{3}$/";
	}elseif(strlen($sfznum)==18){
		$truenum=substr($sfznum,0,17);
		$preg="/^[\d]{6}((19[\d]{2})|(200[0-8]))((0[1-9])|(1[0-2]))((0[1-9])|([12][\d])|(3[01]))[\d]{3}[0-9xX]$/";
	}else{
		return false;
	}
	if(!preg_match($preg,$sfznum))return false;   //完成正则表达式检测

	/*-----------以下计算第18位验证码-------------*/
	$nsum=      substr($truenum, 0,1)*7;
	$nsum=$nsum+substr($truenum, 1,1)*9;
	$nsum=$nsum+substr($truenum, 2,1)*10;
	$nsum=$nsum+substr($truenum, 3,1)*5;
	$nsum=$nsum+substr($truenum, 4,1)*8;
	$nsum=$nsum+substr($truenum, 5,1)*4;
	$nsum=$nsum+substr($truenum, 6,1)*2;
	$nsum=$nsum+substr($truenum, 7,1)*1;
	$nsum=$nsum+substr($truenum, 8,1)*6;
	$nsum=$nsum+substr($truenum, 9,1)*3;
	$nsum=$nsum+substr($truenum,10,1)*7;
	$nsum=$nsum+substr($truenum,11,1)*9;
	$nsum=$nsum+substr($truenum,12,1)*10;
	$nsum=$nsum+substr($truenum,13,1)*5;
	$nsum=$nsum+substr($truenum,14,1)*8;
	$nsum=$nsum+substr($truenum,15,1)*4;
	$nsum=$nsum+substr($truenum,16,1)*2;
	$yzm=12-$nsum%11;
	if($yzm==10)$yzm='x';
	elseif($yzm==12)$yzm='1';
	elseif($yzm==11)$yzm='0';
	/*----------18位验证码计算完成-------------*/
	if(strlen($sfznum)==18){
		if(substr($sfznum,17,1)!=$yzm)return false;
	}
	return $truenum.$yzm;
}
?>