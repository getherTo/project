<?php
/*
 * �ļ������� 2008-11-16 �� PHPeclipse - PHP - Code Templates
 */

require("../inc/conn.php");
require("../inc/checkfun.php");
$adminname=$_COOKIE['adminname'];
if($adminname==""){
	header("location:login.php");
	die();
}
if(isoutlink()){
	header("location:login.php");
	die();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��̨����</title>
</head>
<frameset rows="*" cols="185,*" framespacing="0" frameborder="0" border="false" id="frame" scrolling="yes">
  <frame name="left" scrolling="yes" marginwidth="0" marginheight="0" src="index_left.php">
  <frameset rows="50,*" cols="*" framespacing="0" border="false" rows="35,*" frameborder="0" scrolling="yes">
    <frame name="top" scrolling="no" src="index_top.php">
    <frame name="main" scrolling="auto" src="index_main.php">
  </frameset>
</frameset>
<noframes>
  <body leftmargin="2" topmargin="0" marginwidth="0" marginheight="0">
  <p>���������汾���ͣ�������ϵͳҪ��IE5�����ϰ汾����ʹ�ñ�ϵͳ��</p>
  </body>
</noframes>
</html>
