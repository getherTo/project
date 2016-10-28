<?php
/*
 * 文件创建于 2008-11-12 日 PHPeclipse - PHP - Code Templates
 */
require("inc/head.php");
if($web['enableuserreg']==0){
	die("<script LANGUAGE='javascript'>alert('抱歉！本站暂不允许注册新用户！');history.go(-1);</script>");
}
$action=trim($_GET['action']);
$action=filtrate($action);
if(isoutlink($web['dirname']."reg.php"))$action="";
if($action=="save"){
	$yzm=filtrate(trim($_POST['yzm']));
	if($yzm==""){
		die("<script LANGUAGE='javascript'>alert('温馨提示！请输入验证码！');history.go(-1);</script>");
	}
	$cookieyzm=filtrate(trim($_COOKIE['verifycode']));
	setcookie("verifycode","",time()+10*60);
	if(strcasecmp($yzm,$cookieyzm)!=0){
		die("<script LANGUAGE='javascript'>alert('温馨提示！请输入正确的验证码！');history.go(-1);</script>");
	}
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];

	$clue=filtrate(trim($_POST['clue']));
	$answer=filtrate(trim($_POST['answer']));
	$uyear=(int)$_POST['uyear'];
	$umonth=(int)$_POST['umonth'];
	$uday=(int)$_POST['uday'];
	$sex=(int)$_POST['sex'];
	$oicq=$_POST['oicq'];
	$homepage=$_POST['homepage'];
	$frompage=filtrate($_POST['frompage']);
	if(!checkusername($name)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的用户名格式错误！');history.go(-1);</script>");
	}
	if(!checkemail($email)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的邮箱格式错误！');history.go(-1);</script>");
	}
	if(!checkpassword($password)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的密码格式错误！');history.go(-1);</script>");
	}
	if(!checkpassword($password2)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的密码格式错误！');history.go(-1);</script>");
	}
	if($password!=$password2){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您两次输入的密码不一样！');history.go(-1);</script>");
	}
	$password=md5($password);
	if($answer!=""){
		$answer=md5($answer);
	}
	if($homepage!=""){
		if(!checkurl($homepage)){
			$homepage="";
		}
	}
	$birthday=0;
	if($uday>0 && $umonth>0 && $uyear>0 ){
		if(checkdate($umonth,$uday,$uyear)){
			if($uyear>1910&&$uyear<2008){
				$birthday=mktime(8,1,1,$umonth,$uday,$uyear);
			}
		}
	}
	if($sex>2||$sex<0)$sex=0;
	if($oicq!=""){
		if(!preg_match("/^[1-9][\d]{5,8}$/",$oicq)){
			$oicq="";
		}
	}


	$sql="select uname from {$pre}userdata where uname='{$name}'";
	$query=$conn->query($sql);
	if($conn->num_rows($query)>0){
		die("<script LANGUAGE='javascript'>alert('对不起，这个用户名已被注册，请更换一个用户名，谢谢！');history.go(-1);</script>");
	}
	$sql="insert into {$pre}userdata (uname,password,email,question,answer,birthday,sex,oicq,homepage,regdate,regip,lasttime,lastip,logintime) " .
			"VALUES ('$name','$password','$email','$clue','$answer',$birthday,$sex,'$oicq','$homepage',{$web['today']},'{$user['ip']}',{$web['today']},'{$user['ip']}',{$web['today']})";
	@$conn->query($sql)||die("<script>alert(\"对不起，注册失败！！！\");location.href=\"{$frompage}\";</script>");
	setcookie("logintime",$web['today']);
	setcookie("username",$name);
	setcookie("password",$password);
	$uid=$conn->insert_id();
	$sql="insert into {$pre}userlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES ({$uid},'{$name}',{$web['today']},{$web['today']},'{$user['ip']}',0,'因注册成功自动登陆')";
	$conn->query($sql);
	die("<script>alert(\"恭喜您！注册成功，点击确定进入注册前的页面！！\");location.href=\"{$frompage}\";</script>");
}



if($action=="agree"){
	$web['title']="填写注册资料";
	$frompage=$_GET['frompage'];
}else{
	if(isoutlink()){
		$frompage="index.php";
	}else{
		$frompage=$web['refpage'];
	}
	$web['title']="阅读注册协议";
}


require("template/head.htm");
require("template/reg.htm");
require("inc/foot.php");
?>
