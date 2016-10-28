<?php
/*
 * 文件创建于 2008-12-7 日 PHPeclipse - PHP - Code Templates
 */
require("inc/checkfun.php");
$dir=trim($_GET['styledir']);
if(preg_match("/\A[a-z0-9_-]+\Z/",$dir)){
		@setcookie("styledir",$dir,time()+365*24*60*60);
}else{
	;		//参数不合法，不进行任何操作。
}
if(isoutlink()){
	header("location:index.php");
}else{
	header("location:{$_SERVER[HTTP_REFERER]}");
}
?>
