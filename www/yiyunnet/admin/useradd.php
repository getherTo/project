<?php
/*
 * �ļ������� 2008-11-28 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if($action=="addsave"){
	if($adminlevel<8){
		die("<script LANGUAGE='javascript'>alert('����ֻ�г�������Ա����Ȩ����û���');history.go(-1);</script>");
	}
	$name=$_POST['uname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$level=(int)$_POST['adminlevel'];
	$clue=filtrate(trim($_POST['clue']));
	$answer=filtrate(trim($_POST['answer']));
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
	$sql="select uname from {$pre}userdata where uname='{$name}'";
	$query=$conn->query($sql);
	if($conn->num_rows($query)>0){
		die("<script LANGUAGE='javascript'>alert('�Բ�������û����ѱ�ע�ᣬ�����һ���û�����лл��');history.go(-1);</script>");
	}
	$sql="insert into {$pre}userdata (uname,password,email,question,answer,regdate,regip,yz) " .
			"VALUES ('$name','$password','$email','$clue','$answer',{$web['today']},'{$user['ip']}',1)";
	$conn->query($sql);
	die("<script>alert(\"��ϲ������ӳɹ�����\");location.href=\"{$web['refpage']}\";</script>");
}






//===================����Ϊģ��
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>��̨����</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
		<div class="title">������û�</div>
		<div style="padding:5"></div>
		<form method="post" action="?action=addsave" name="add" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="4">
		<tr>
			<td width="120">�� �� ����</td>
			<td><input type="text" name="uname" id="uname" /></td>
		</tr>
		<tr>
			<td>Ȩ�����ޣ�</td>
			<td><input type="radio" name="adminlevel" id="adminlevel" value="0" checked style="border:0px;" />��ͨ�û�
				<input type="radio" name="adminlevel" id="adminlevel" value="4" style="border:0px;" /><span style="color:ff33ff;">����Ա</span>
				<input type="radio" name="adminlevel" id="adminlevel" value="8" style="border:0px;" /><span style="color:ff3333;">��������Ա</span>
			</td>
		</tr>
		<tr>
			<td>�ʡ����䣺</td>
			<td><input type="text" name="email" id="email" /></td>
		</tr>
		<tr>
			<td>�ܡ����룺</td>
			<td><input type="password" name="password" id="password"/></td>
		</tr>
		<tr>
			<td>�ظ����룺</td>
			<td><input type="password" name="password2" id="password2"/></td>
		</tr>
		<tr>
			<td>�ʡ����⣺</td>
			<td><input type="text" name="clue" id="clue" /> ��������ʱ���Իش������һ�����</td>
		</tr>
		<tr>
			<td>�𡡡�����</td>
			<td><input type="text" name="answer" id="answer"/></td>
		</tr>
		</table>
		<div style="text-align:center;padding:5;">
			<input type="submit" value="�ύ"/> ��
			<input type="reset" value="����"/>
		</div>
		</form>
	</div>
<script LANGUAGE='javascript'>
function showhelp(sid){
	whichEl = eval("help" + sid);
	if (whichEl.style.display == "none"){
		eval("help" + sid + ".style.display=\"\";");
	}else{
		eval("help" + sid + ".style.display=\"none\";");
	}
}
function checkform(){
	if (document.add.uname.value==''){
		alert('�������û�������Ϊ�գ�');
		document.add.uname.focus();
		return false;
	}
	if (document.add.email.value==''){
		alert('���������䲻��Ϊ�գ�');
		document.add.email.focus();
		return false;
	}
	var str_reg=/^\w+((-\w+)|(\.\w+))*\@{1}\w+\.{1}\w{2,4}(\.{0,1}\w{2}){0,1}/ig;
	if (document.add.email.value.search(str_reg) == -1)
	{
		alert("��ܰ��ʾ�������ʽ����");
		document.add.email.value = "";
		document.add.email.focus();
		return false;
	}
	if (document.add.password.value==''){
		alert('���������벻��Ϊ�գ�');
		document.add.password.focus();
		return false;
	}
	if (document.add.password2.value==''){
		alert('�������������������룡');
		document.add.password2.focus();
		return false;
	}
	if(document.add.password.value!=document.add.password2.value){
		alert("��ܰ��ʾ��������������벻һ�������������룡");
		document.add.password.value = "";
		document.add.password2.value = "";
		document.add.password.focus();
		return false;
	}
	if(document.add.password.value.length<6 || document.add.password.value.length>32){
		alert("��ܰ��ʾ������Ҫ�� 6-32 ���ֽڣ����������� "+document.add.password.value.length+" ���ֽ�");
		document.add.password.value = "";
		document.add.password2.value = "";
		document.add.password.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ������û�";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>