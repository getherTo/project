<?php
/*
 * �ļ������� 2008-11-12 �� PHPeclipse - PHP - Code Templates
 */
require("inc/head.php");
if($web['enableuserreg']==0){
	die("<script LANGUAGE='javascript'>alert('��Ǹ����վ�ݲ�����ע�����û���');history.go(-1);</script>");
}
$action=trim($_GET['action']);
$action=filtrate($action);
if(isoutlink($web['dirname']."reg.php"))$action="";
if($action=="save"){
	$yzm=filtrate(trim($_POST['yzm']));
	if($yzm==""){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������֤�룡');history.go(-1);</script>");
	}
	$cookieyzm=filtrate(trim($_COOKIE['verifycode']));
	setcookie("verifycode","",time()+10*60);
	if(strcasecmp($yzm,$cookieyzm)!=0){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������ȷ����֤�룡');history.go(-1);</script>");
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
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������û�����ʽ����');history.go(-1);</script>");
	}
	if(!checkemail($email)){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������������ʽ����');history.go(-1);</script>");
	}
	if(!checkpassword($password)){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������������ʽ����');history.go(-1);</script>");
	}
	if(!checkpassword($password2)){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������������ʽ����');history.go(-1);</script>");
	}
	if($password!=$password2){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������������벻һ����');history.go(-1);</script>");
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
		die("<script LANGUAGE='javascript'>alert('�Բ�������û����ѱ�ע�ᣬ�����һ���û�����лл��');history.go(-1);</script>");
	}
	$sql="insert into {$pre}userdata (uname,password,email,question,answer,birthday,sex,oicq,homepage,regdate,regip,lasttime,lastip,logintime) " .
			"VALUES ('$name','$password','$email','$clue','$answer',$birthday,$sex,'$oicq','$homepage',{$web['today']},'{$user['ip']}',{$web['today']},'{$user['ip']}',{$web['today']})";
	@$conn->query($sql)||die("<script>alert(\"�Բ���ע��ʧ�ܣ�����\");location.href=\"{$frompage}\";</script>");
	setcookie("logintime",$web['today']);
	setcookie("username",$name);
	setcookie("password",$password);
	$uid=$conn->insert_id();
	$sql="insert into {$pre}userlogo (uid,uname,logintime,lasttime,ip,adminlevel,remark) " .
			"VALUES ({$uid},'{$name}',{$web['today']},{$web['today']},'{$user['ip']}',0,'��ע��ɹ��Զ���½')";
	$conn->query($sql);
	die("<script>alert(\"��ϲ����ע��ɹ������ȷ������ע��ǰ��ҳ�棡��\");location.href=\"{$frompage}\";</script>");
}



if($action=="agree"){
	$web['title']="��дע������";
	$frompage=$_GET['frompage'];
}else{
	if(isoutlink()){
		$frompage="index.php";
	}else{
		$frompage=$web['refpage'];
	}
	$web['title']="�Ķ�ע��Э��";
}


require("template/head.htm");
require("template/reg.htm");
require("inc/foot.php");
?>
