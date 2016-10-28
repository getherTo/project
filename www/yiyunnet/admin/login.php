<?php
/*
 * 文件创建于 2008-11-16 日 PHPeclipse - PHP - Code Templates
 */
date_default_timezone_set('Hongkong');
require("../inc/conn.php");
require("../inc/checkfun.php");
$action=substr(trim($_GET['action']),0,3);
if(isoutlink())$action="";

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

if($action=="che"){
	$now=time();
	$ip=fkip();
	$username=$_POST['username'];
	$password=$_POST['password'];
	$yzm=trim($_POST['yzm']);
	if(!checkusername($username)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的用户名错误！');history.go(-1);</script>");
	}
	if(!checkpassword($password)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的密码错误！');history.go(-1);</script>");
	}
	if(!preg_match("/\A[A-Za-z0-9]{4}\Z/",$yzm)){
		$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES (0,'{$username}',{$now},{$now},'{$ip}',0,'验证码格式错误')";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的验证码错误！');history.go(-1);</script>");
	}
	$cookieyzm=$_COOKIE['verifycode'];
	setcookie("verifycode","",time()+10*60);
	if(strcasecmp($yzm,$cookieyzm)!=0){
		$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES (0,'{$username}',{$now},{$now},'{$ip}',0,'验证码输入错误')";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('温馨提示！请输入正确的验证码！');history.go(-1);</script>");
	}

	$password=md5($password);
	$sql="select * from {$pre}userdata where uname='{$username}' and password='$password' and adminlevel>3";
	$query=$conn->query($sql);
	$records=$conn->num_rows($query);
	if($records!=1){
		$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES (0,'{$username}',{$now},{$now},'{$ip}',0,'用户名或密码错误')";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的用户名或密码错误！');history.go(-1);</script>");
	}
	$row=$conn->fetch_array($query);
	setcookie("adminname",$username);
	setcookie("adminpassword",$password);
	setcookie("adminlogintime",$now);
	$sql="update {$pre}userdata set logintime={$now}, lasttime={$now},lastip='{$ip}' " .
			"where uname='{$username}' and adminlevel>0";
	$conn->query($sql);
	$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES ({$row['uid']},'{$username}',{$now},{$now},'{$ip}',{$row['adminlevel']},'成功')";
	$conn->query($sql);
	header("location:index.php");
}



?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>管理员登陆</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body style="background:url(images/loginbg.jpg) repeat-x;text-align:center;">
	<div style="padding:120 0 0 0; width:601;margin:0 auto 0 auto;">
		<div style="background:url(images/login_01.gif) no-repeat; height:198px;"></div>
		<div style="background:url(images/login_02.gif) no-repeat; height:147px;text-align:left;padding:5 150;">
			<form name="loginform" method="post" action="login.php?action=check" target="_top" onsubmit="return Checkuser();">
				<div style="color:fff;padding:3;">用户名：<input type="text" name="username" size="12"/></div>
				<div style="color:fff;padding:3;">密　码：<input type="password" name="password" size="24"/></div>
				<div style="color:fff;padding:3 3 10;">验证码：<input type="text" name="yzm" size="4"/>
					<img src="yzimg.php" align="absmiddle" title="看不清楚，换一张" onClick="this.src='yzimg.php?n='+ Math.random();">
					<span style="font-size:9pt;">验证码不区分大小写</span>
				</div>
				<div style="color:fff;padding:3;text-align:center;"><input type="submit" value="提交"/> <input type="reset" value="重填"/></div>
			</form>
		</div>
	</div>
	<script language='JavaScript' type='text/JavaScript'>
	function Checkuser(){
		if (document.loginform.username.value==''){
			alert('！！！用户名不能为空！');
			document.loginform.username.focus();
			return false;
		}
		if (document.loginform.password.value==''){
			alert('请输入密码！');
			document.loginform.password.focus();
			return false;
		}
		if (document.loginform.yzm.value==''){
			alert('请输入验证码，点击验证码图片可更换验证码！');
			document.loginform.yzm.focus();
		return false;
		}
		return true;
	}
	</script>
</body>
</html>