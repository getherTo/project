<?php
/*
 * �ļ������� 2008-11-16 �� PHPeclipse - PHP - Code Templates
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
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������û�������');history.go(-1);</script>");
	}
	if(!checkpassword($password)){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������������');history.go(-1);</script>");
	}
	if(!preg_match("/\A[A-Za-z0-9]{4}\Z/",$yzm)){
		$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES (0,'{$username}',{$now},{$now},'{$ip}',0,'��֤���ʽ����')";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ�����������֤�����');history.go(-1);</script>");
	}
	$cookieyzm=$_COOKIE['verifycode'];
	setcookie("verifycode","",time()+10*60);
	if(strcasecmp($yzm,$cookieyzm)!=0){
		$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES (0,'{$username}',{$now},{$now},'{$ip}',0,'��֤���������')";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������ȷ����֤�룡');history.go(-1);</script>");
	}

	$password=md5($password);
	$sql="select * from {$pre}userdata where uname='{$username}' and password='$password' and adminlevel>3";
	$query=$conn->query($sql);
	$records=$conn->num_rows($query);
	if($records!=1){
		$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES (0,'{$username}',{$now},{$now},'{$ip}',0,'�û������������')";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������û������������');history.go(-1);</script>");
	}
	$row=$conn->fetch_array($query);
	setcookie("adminname",$username);
	setcookie("adminpassword",$password);
	setcookie("adminlogintime",$now);
	$sql="update {$pre}userdata set logintime={$now}, lasttime={$now},lastip='{$ip}' " .
			"where uname='{$username}' and adminlevel>0";
	$conn->query($sql);
	$sql="insert into {$pre}adminlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES ({$row['uid']},'{$username}',{$now},{$now},'{$ip}',{$row['adminlevel']},'�ɹ�')";
	$conn->query($sql);
	header("location:index.php");
}



?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>����Ա��½</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body style="background:url(images/loginbg.jpg) repeat-x;text-align:center;">
	<div style="padding:120 0 0 0; width:601;margin:0 auto 0 auto;">
		<div style="background:url(images/login_01.gif) no-repeat; height:198px;"></div>
		<div style="background:url(images/login_02.gif) no-repeat; height:147px;text-align:left;padding:5 150;">
			<form name="loginform" method="post" action="login.php?action=check" target="_top" onsubmit="return Checkuser();">
				<div style="color:fff;padding:3;">�û�����<input type="text" name="username" size="12"/></div>
				<div style="color:fff;padding:3;">�ܡ��룺<input type="password" name="password" size="24"/></div>
				<div style="color:fff;padding:3 3 10;">��֤�룺<input type="text" name="yzm" size="4"/>
					<img src="yzimg.php" align="absmiddle" title="�����������һ��" onClick="this.src='yzimg.php?n='+ Math.random();">
					<span style="font-size:9pt;">��֤�벻���ִ�Сд</span>
				</div>
				<div style="color:fff;padding:3;text-align:center;"><input type="submit" value="�ύ"/> <input type="reset" value="����"/></div>
			</form>
		</div>
	</div>
	<script language='JavaScript' type='text/JavaScript'>
	function Checkuser(){
		if (document.loginform.username.value==''){
			alert('�������û�������Ϊ�գ�');
			document.loginform.username.focus();
			return false;
		}
		if (document.loginform.password.value==''){
			alert('���������룡');
			document.loginform.password.focus();
			return false;
		}
		if (document.loginform.yzm.value==''){
			alert('��������֤�룬�����֤��ͼƬ�ɸ�����֤�룡');
			document.loginform.yzm.focus();
		return false;
		}
		return true;
	}
	</script>
</body>
</html>