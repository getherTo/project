<?php
/*
 * �ļ������� 2008-11-16 �� PHPeclipse - PHP - Code Templates
 * ���ã�������ԱȨ�ޣ����ϸ񷵻ص���ҳ���½ҳ��
 * �÷��������ں����ÿһ���ɶ������е��ļ��С�
 */

require("../inc/config.php");
require("../inc/conn.php");
require("../inc/fun.php");
require("../inc/checkfun.php");

$adminname=$_COOKIE['adminname'];
$adminpassword=$_COOKIE['adminpassword'];
$adminlogintime=(int)$_COOKIE['adminlogintime'];
if(!checkusername($adminname)){
	die("<script>alert(\"��ܰ��ʾ���û�������\");location.href=\"../index.php\";</script>");
}
if(!checkpassword($adminpassword)){
	die("<script>alert(\"��ܰ��ʾ���������\");location.href=\"../index.php\";</script>");
}
$sql="select * from {$pre}userdata where uname='{$adminname}' and password='$adminpassword' and logintime=$adminlogintime and adminlevel>3";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records!=1){
	setcookie("adminname","");
	setcookie("adminpassword","");
	setcookie("adminlogintime","");
	die("<script LANGUAGE='javascript'>alert('���棡���������뱻�޸Ļ���������һ���ط��ô��ʺŵ�½��');history.go(-1);</script>");
}
$row=$conn->fetch_array($query);

if($row['lasttime']<(time()-20*60)){
	setcookie("adminname","");
	setcookie("adminpassword","");
	setcookie("adminlogintime","");
	die("<script>alert(\"��ܰ��ʾ��������20����û�н����κβ�����ϵͳ�Զ��˳��������µ�½��\");location.href=\"login.php\";</script>");
}
$adminlevel=$row['adminlevel'];
$adminuid=$row['uid'];
$now=time();
$sql="update {$pre}userdata set lasttime={$now} where uname='{$adminname}' and adminlevel>0";
$conn->query($sql);
$sql="select * from {$pre}adminlogo where uid={$adminuid} order by id desc limit 0,1";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
$sql="update {$pre}adminlogo set lasttime={$now} where id={$row['id']}";
$conn->query($sql);
?>
