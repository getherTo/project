<?php
/*
 * �ļ������� 2008-11-28 �� PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
$listrows=10;
$page=abs((int)$_GET['page']);
$action=filtrate(trim($_GET['action']));
$id=(int)$_GET['id'];
if(isoutlink())$action="";
if($action=="writeback"){
	$sql="select * from {$pre}guestbook where id={$id}";
	$query=$conn->query($sql);
	$message=$conn->fetch_array($query);
	if($message['id']!=$id)exit;
}
if($action=="writesave"){
	$reply=likepre($_POST['review']);
	$conn->query("update {$pre}guestbook set yz=1,reply='{$reply}' where id={$id}");
	die("<script>alert(\"��ϲ�����ظ��ɹ�����\");location.href=\"guestbookmanage.php?page={$_GET['page']}\";</script>");
}
if($action=="del"){
	$conn->query("delete from {$pre}guestbook where id={$id}");
	die("<script>alert(\"����ɾ���ɹ�����\");location.href=\"guestbookmanage.php?page={$_GET['page']}\";</script>");
}



$sql="select id from {$pre}guestbook";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($maxpage>1)$showpage=showpage($records,$page,$listrows);
if($page<1)$page=1;
$limitlow=($page-1)*$listrows;
$sql="select * from {$pre}guestbook order by id desc limit {$limitlow},{$listrows}";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$messagearr[$i]=$conn->fetch_array($query);
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
		<div class="title">���Թ���</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>ID</th>
			<th>������</th>
			<th>��������</th>
			<th>�ظ�</th>
			<th>��֤</th>
			<th width="140">�ظ�/ɾ��</th>
		</tr>
EOT;
for($i=0;$i<count($messagearr);$i++){
$rs=$messagearr[$i];
$rs['content']=mysubstr(strip_tags($rs['content']),0,50);
$rs['reply']=mysubstr(strip_tags($rs['reply']),0,50);
$rs['yz']==1?$rs['yz']="��":$rs['yz']="�w";
echo <<<EOT
		<tr align="center">
			<td>{$rs['id']}</td>
			<td>{$rs['username']}</td>
			<td>{$rs['content']}..</td>
			<td>{$rs['reply']}..</td>
			<td>{$rs['yz']}</td>
			<td><a href="?action=writeback&id={$rs['id']}&page={$page}">�ظ�</a> /
				<a href="?action=del&id={$rs['id']}&page={$page}">ɾ��</a>
			</td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
		<div class="showpage">{$showpage}</div>
EOT;
if($action=="writeback"){
echo <<<EOT
		<div class="title">���Իظ�</div>
		<div style="padding:5px;"></div>
		<form name="review" action="?action=writesave&id={$id}&page={$page}" method="post" style="margin:0px;">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="100">�������ݣ�</td>
			<td><div style="padding:15px;">{$message['content']}</div></td>
		</tr>
		<tr>
			<td width="100">�ظ����ݣ�</td>
			<td><textarea name="review" id="review" rows="5" cols="70">{$message['reply']}</textarea></div></td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" value="�ظ�"></td></tr>
		</table>
		</form>
EOT;
}
echo <<<EOT
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
	if (document.addclass.classname.value==''){
		alert('����������������Ϊ�գ�');
		document.addclass.classname.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ��վ���Թ���";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>