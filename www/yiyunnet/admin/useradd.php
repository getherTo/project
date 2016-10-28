<?php
/*
 * 文件创建于 2008-11-28 日 PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if($action=="addsave"){
	if($adminlevel<8){
		die("<script LANGUAGE='javascript'>alert('错误，只有超级管理员才有权添加用户！');history.go(-1);</script>");
	}
	$name=$_POST['uname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$level=(int)$_POST['adminlevel'];
	$clue=filtrate(trim($_POST['clue']));
	$answer=filtrate(trim($_POST['answer']));
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
	$sql="select uname from {$pre}userdata where uname='{$name}'";
	$query=$conn->query($sql);
	if($conn->num_rows($query)>0){
		die("<script LANGUAGE='javascript'>alert('对不起，这个用户名已被注册，请更换一个用户名，谢谢！');history.go(-1);</script>");
	}
	$sql="insert into {$pre}userdata (uname,password,email,question,answer,regdate,regip,yz) " .
			"VALUES ('$name','$password','$email','$clue','$answer',{$web['today']},'{$user['ip']}',1)";
	$conn->query($sql);
	die("<script>alert(\"恭喜您！添加成功！！\");location.href=\"{$web['refpage']}\";</script>");
}






//===================以下为模版
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
		<div class="title">添加新用户</div>
		<div style="padding:5"></div>
		<form method="post" action="?action=addsave" name="add" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="4">
		<tr>
			<td width="120">用 户 名：</td>
			<td><input type="text" name="uname" id="uname" /></td>
		</tr>
		<tr>
			<td>权　　限：</td>
			<td><input type="radio" name="adminlevel" id="adminlevel" value="0" checked style="border:0px;" />普通用户
				<input type="radio" name="adminlevel" id="adminlevel" value="4" style="border:0px;" /><span style="color:ff33ff;">管理员</span>
				<input type="radio" name="adminlevel" id="adminlevel" value="8" style="border:0px;" /><span style="color:ff3333;">超级管理员</span>
			</td>
		</tr>
		<tr>
			<td>邮　　箱：</td>
			<td><input type="text" name="email" id="email" /></td>
		</tr>
		<tr>
			<td>密　　码：</td>
			<td><input type="password" name="password" id="password"/></td>
		</tr>
		<tr>
			<td>重复密码：</td>
			<td><input type="password" name="password2" id="password2"/></td>
		</tr>
		<tr>
			<td>问　　题：</td>
			<td><input type="text" name="clue" id="clue" /> 忘记密码时可以回答问题找回密码</td>
		</tr>
		<tr>
			<td>答　　案：</td>
			<td><input type="text" name="answer" id="answer"/></td>
		</tr>
		</table>
		<div style="text-align:center;padding:5;">
			<input type="submit" value="提交"/> 　
			<input type="reset" value="重置"/>
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
		alert('！！！用户名不能为空！');
		document.add.uname.focus();
		return false;
	}
	if (document.add.email.value==''){
		alert('！！！邮箱不能为空！');
		document.add.email.focus();
		return false;
	}
	var str_reg=/^\w+((-\w+)|(\.\w+))*\@{1}\w+\.{1}\w{2,4}(\.{0,1}\w{2}){0,1}/ig;
	if (document.add.email.value.search(str_reg) == -1)
	{
		alert("温馨提示！邮箱格式错误！");
		document.add.email.value = "";
		document.add.email.focus();
		return false;
	}
	if (document.add.password.value==''){
		alert('！！！密码不能为空！');
		document.add.password.focus();
		return false;
	}
	if (document.add.password2.value==''){
		alert('！！！请输入两次密码！');
		document.add.password2.focus();
		return false;
	}
	if(document.add.password.value!=document.add.password2.value){
		alert("温馨提示！两次输入的密码不一样，请重新输入！");
		document.add.password.value = "";
		document.add.password2.value = "";
		document.add.password.focus();
		return false;
	}
	if(document.add.password.value.length<6 || document.add.password.value.length>32){
		alert("温馨提示！密码要在 6-32 个字节！而您输入了 "+document.add.password.value.length+" 个字节");
		document.add.password.value = "";
		document.add.password2.value = "";
		document.add.password.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - 后台管理系统 - 添加新用户";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>