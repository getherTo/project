<?php
/*
 * 文件创建于 2008-11-13 日 PHPeclipse - PHP - Code Templates
 */
require("inc/head.php");
if($user['name']!=""){
	header("location:user.php");
	die();
}
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";


if($action=="check"){
	$username=$_POST['username'];
	$password=$_POST['userpassword'];
	$expire=(int)$_POST['time'];
	if(!checkusername($username)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的用户名格式错误！');history.go(-1);</script>");
	}
	if(!checkpassword($password)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的密码格式错误！');history.go(-1);</script>");
	}
	$password=md5($password);
	$sql="select * from {$pre}userdata where uname='{$username}' and password='$password'";
	$query=$conn->query($sql);
	$records=$conn->num_rows($query);
	if($records!=1){
		$sql="insert into {$pre}userlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES (0,'{$username}',{$web['today']},{$web['today']},'{$user['ip']}',0,'用户名或密码错误')";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的用户名或密码错误！');history.go(-1);</script>");
	}
	$row=$conn->fetch_array($query);
	$sql="update {$pre}userdata set logintime={$web['today']}, lasttime={$web['today']},lastip='{$user['ip']}' " .
			"where uid={$row['uid']}";
	$conn->query($sql);
	if($expire>0){
		$expire=$expire*24*60*60;
		@setcookie("username",$username,time()+$expire);
		@setcookie("password",$password,time()+$expire);
		@setcookie("logintime",$web['today'],time()+$expire);
	}else{
		@setcookie("logintime",$web['today']);
		@setcookie("username",$username);
		@setcookie("password",$password);
	}
	$sql="insert into {$pre}userlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES ({$row['uid']},'{$username}',{$web['today']},{$web['today']},'{$user['ip']}',{$row['adminlevel']},'成功')";
	$conn->query($sql);
	die("<script>alert(\"恭喜您！登陆成功，点击确定进入登陆前的页面！！\");location.href=\"{$web['refpage']}\";</script>");
}

if($action=="find1"){
	$web['title']=$web['title']."-找回密码-输入帐号";
}
if($action=="find2"){
	$web['title']=$web['title']."-找回密码-回答问题";
	$uname=trim($_POST['uname']);
	if(!checkusername($uname)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的用户名格式错误！');history.go(-1);</script>");
	}
	$sql="select * from {$pre}userdata where uname='{$uname}'";
	$query=$conn->query($sql);
	if($conn->num_rows($query)!=1){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的用户名不存在！');history.go(-1);</script>");
	}
	$row=$conn->fetch_array($query);
	if($row['answer']==""||$row['question']==""){
		die("<script>alert(\"对不起，您没有提供找回密码的问题和答案，请与管理员联系，将新密码发到您的邮箱中去！！\");location.href=\"login.php\";</script>");
	}
	if($row['seekpasswords']>4){
		die("<script>alert(\"对不起，您已用过此功能五次，请与管理员联系把密码找回！！\");location.href=\"login.php\";</script>");
	}
	$findnum=$row['seekpasswords']+1;
	$question=$row['question'];
}
if($action=="find3"){
	$web['title']=$web['title']."-找回密码-请记住新密码";
	$uname=$_POST['uname'];
	$answer=filtrate(trim($_POST['answer']));
	if(!checkusername($uname)){
		die("<script>alert(\"对不起，你的回答错误！！\");location.href=\"login.php\";</script>");//实际用户名错，这样显示是防止别人破解的难度。
	}
	if($answer==""){
		die("<script LANGUAGE='javascript'>alert('对不起，你的回答错误！');history.go(-1);</script>");
	}
	$answer=md5($answer);
	$sql="select * from {$pre}userdata where uname='{$uname}'";
	$query=$conn->query($sql);
	if($conn->num_rows($query)!=1){
		die("<script LANGUAGE='javascript'>alert('对不起，你的回答错误！');history.go(-1);</script>");//用户找不到。
	}
	$row=$conn->fetch_array($query);
	if($row['seekpasswords']>4){
		die("<script>alert(\"对不起，您已用过此功能五次，请与管理员联系把密码找回！！\");location.href=\"login.php\";</script>");
	}
	$findnum=$row['seekpasswords']+1;
	$conn->query("update {$pre}userdata set seekpasswords={$findnum} where uname='{$uname}'");
	if($row['answer']!=$answer){
		die("<script LANGUAGE='javascript'>alert('对不起，你的回答错误！');history.go(-1);</script>");
	}
	$temp='abcdefghijklmnopqrstuvwxyz0123456789+-*/;:!@#$%^&()';
	$newpassword="";
	$temlen=rand(10,16);
	for($i=0;$i<$temlen;$i++){
		$newpassword.=substr($temp,rand(0,50),1);
	}
	$newmd5=md5($newpassword);
	$conn->query("update {$pre}userdata set password='{$newmd5}' where uname='{$uname}'");
}
require("template/head.htm");
require("template/login.htm");
require("inc/foot.php");
?>
