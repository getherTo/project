<?php
/*
 * �ļ������� 2008-11-13 �� PHPeclipse - PHP - Code Templates
 */
require("inc/config.php");
require_once("inc/checkfun.php");
setcookie("username","",0);
setcookie("password","",0);
if(isoutlink()){
	@header("location:index.php");
}else{
	@header("location:{$web['refpage']}");
}
?>
