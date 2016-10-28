<?php
/*
 * �ļ������� 2008-11-14 �� PHPeclipse - PHP - Code Templates
 */
header("Content-type:text/html;charset=utf-8");

require("inc/head.php");
//��֤�û��Ƿ�Ϸ��û���
if($user['name']==""||$user['password']==""){@header("location:login.php");die();}
$sql="select * from {$pre}userdata where uname='{$user['name']}' and password='{$user['password']}'";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records!=1){
	setcookie("username","");
	@header("location:login.php");
	die();
}
$row=$conn->fetch_array($query);
$uclue=$row['question'];
if($row['birthday']!=0){
	$uyear=date("Y",$row['birthday']);
	$umonth=date("m",$row['birthday']);
	$uday=date("d",$row['birthday']);
}
if($row['sex']==0)$usex0="checked";
elseif($row['sex']==1)$usex1="checked";
else $usex2="checked";

$web['title']="�û�����-{$web['title']}";
$web['daohang']="{$web['daohang']} &gt; <a href=\"user.php\">�û�����</a>";

$action=filtrate(trim($_GET['action']));
if(isoutlink($web['dirname']."user.php"))$action="";

switch($action){
	case "edit":
		$web['title']="�޸�����-{$web['title']}";
		$web['daohang']="{$web['daohang']} &gt; �޸�����";
		break;
	case "savechange1":
		$web['title']="���ϱ���ɹ�-{$web['title']}";
		$web['daohang']="{$web['daohang']} &gt; ���ϱ���ɹ�";
		$uyear=(int)$_POST['uyear'];
		$umonth=(int)$_POST['umonth'];
		$uday=(int)$_POST['uday'];
		$sex=(int)$_POST['sex'];
		$oicq=$_POST['oicq'];
		$homepage=$_POST['homepage'];
		//�����桡������ȡ��ɣ����¶Ա������д��?ȥ�����ϸ����Ϣ��
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
		if($homepage!=""){
			if(!checkurl($homepage)){
				$homepage="";
			}
		}
		$sql="update {$pre}userdata set birthday={$birthday},sex={$sex},oicq='{$oicq}',homepage='{$homepage}' where uid={$user['id']}";

		$oldpassword=$_POST['oldpassword'];
		if($oldpassword==""){		//���û�о����룬��ʹ˸�����ݿ⡣
			$conn->query($sql);
			break;
		}
		if(!checkpassword($oldpassword)){
			die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������ľ��������');history.go(-1);</script>");
		}
		$oldpassword=md5($oldpassword);
		if($oldpassword!=$user['password']){
			die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������ľ�������󣡣�');history.go(-1);</script>");
		}
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$email=$_POST['email'];
		$clue=filtrate(trim($_POST['clue']));
		$answer=filtrate(trim($_POST['answer']));
		if(!checkemail($email)){
			die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������������ʽ����');history.go(-1);</script>");
		}
		if($password!=""){
			if(!checkpassword($password)){
				die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������������ʽ����');history.go(-1);</script>");
			}
			if(!checkpassword($password2)){
				die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ��������������ʽ����');history.go(-1);</script>");
			}
			if($password!=$password2){
				die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ����������������벻һ��');history.go(-1);</script>");
			}
			$password=md5($password);
			setcookie("password",$password,time()+365*24*60*60);
			$conn->query("update {$pre}userdata set password='{$password}' where uid={$user['id']}");
		}
		if($answer!=""){
			$answer=md5($answer);
			$conn->query("update {$pre}userdata set answer='{$answer}' where uid={$user['id']}");
		}
		$conn->query($sql);
		$sql="update {$pre}userdata set question='{$clue}',email='{$email}' where uid={$user['id']}";
		$conn->query($sql);
		break;
	case "savechange2":
		$address=mysubstr(filtrate(trim($_POST['address'])),0,200);
		$postalcode=$_POST['postalcode'];
		$telephone=$_POST['telephone'];
		$mobphone=$_POST['mobphone'];
		$truename=mysubstr(filtrate(trim($_POST['truename'])),0,16);
		if(!checkpost($postalcode))$postalcode="";
		if(!checkphone($telephone))$telephone="";
		if(checkphone($mobphone)!=2)$mobphone="";
		$sql="update {$pre}userdata set address='{$address}',postalcode='{$postalcode}',telephone='{$telephone}'," .
				"mobphone='{$mobphone}',truename='{$truename}' where uid={$user['id']}";
		$conn->query($sql);
		die("<script>alert(\"��ϲ�������޸ĳɹ�����\");location.href=\"user.php\";</script>");
}





























require("template/head.htm");
require("template/user.htm");
require("inc/foot.php");
?>
