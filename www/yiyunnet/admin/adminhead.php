<?php
/*
 * 文件创建于 2008-11-16 日 PHPeclipse - PHP - Code Templates
 * 作用：检查管理员权限，不合格返回到首页或登陆页。
 * 用法：包含在后如的每一个可独立运行的文件中。
 */

require("../inc/config.php");
require("../inc/conn.php");
require("../inc/fun.php");
require("../inc/checkfun.php");

$adminname=$_COOKIE['adminname'];
$adminpassword=$_COOKIE['adminpassword'];
$adminlogintime=(int)$_COOKIE['adminlogintime'];
if(!checkusername($adminname)){
	die("<script>alert(\"温馨提示！用户名错误！\");location.href=\"../index.php\";</script>");
}
if(!checkpassword($adminpassword)){
	die("<script>alert(\"温馨提示！密码错误！\");location.href=\"../index.php\";</script>");
}
$sql="select * from {$pre}userdata where uname='{$adminname}' and password='$adminpassword' and logintime=$adminlogintime and adminlevel>3";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records!=1){
	setcookie("adminname","");
	setcookie("adminpassword","");
	setcookie("adminlogintime","");
	die("<script LANGUAGE='javascript'>alert('警告！！可能密码被修改或有人在另一个地方用此帐号登陆！');history.go(-1);</script>");
}
$row=$conn->fetch_array($query);

if($row['lasttime']<(time()-20*60)){
	setcookie("adminname","");
	setcookie("adminpassword","");
	setcookie("adminlogintime","");
	die("<script>alert(\"温馨提示！！您有20分钟没有进行任何操作，系统自动退出，请重新登陆！\");location.href=\"login.php\";</script>");
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
