<?php
/*
 * �ļ������� 2008-12-7 �� PHPeclipse - PHP - Code Templates
 */
require("inc/checkfun.php");
$dir=trim($_GET['styledir']);
if(preg_match("/\A[a-z0-9_-]+\Z/",$dir)){
		@setcookie("styledir",$dir,time()+365*24*60*60);
}else{
	;		//�������Ϸ����������κβ�����
}
if(isoutlink()){
	header("location:index.php");
}else{
	header("location:{$_SERVER[HTTP_REFERER]}");
}
?>
