<?php
/*
 * �ļ������� 2008-11-20 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
$page=(int)$_GET['page'];
$id=(int)$_GET['id'];
$listrows=12;

if($action=="changeyz"){
	$sql="select yz,id from {$pre}friendlink where id={$id}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	if($row['id']!=$id){
		die("<script LANGUAGE='javascript'>alert('����');location.href=\"managefriendlink.php\";</script>");
	}
	$row['yz']==1?$yz=0:$yz=1;
	$conn->query("update {$pre}friendlink set yz={$yz} where id={$id}");
	die("<script LANGUAGE='javascript'>alert('���ĳɹ�');location.href=\"managefriendlink.php?page={$page}\";</script>");
}
if($action=="del"){
	$conn->query("delete from {$pre}friendlink where id={$id}");
	die("<script LANGUAGE='javascript'>alert('ɾ���ɹ�');location.href=\"managefriendlink.php?page={$page}\";</script>");
}
if($action=="save"||$action=="add"){
	$siteurl=$_POST['siteurl'];
	$sitename=$_POST['sitename'];
	$sitelogo=$_POST['sitelogo'];
	$descrip=$_POST['descrip'];
	$list=(int)$_POST['list'];
	if(!checkusername($sitename)){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ�����������վ�����ûͨ����');history.go(-1);</script>");
	}
	if(!checkurl($siteurl)){
		die("<script LANGUAGE='javascript'>alert('��ܰ��ʾ�����������ַ����ͨ���������ˣ�');history.go(-1);</script>");
	}
	if(!checkurl($sitelogo)){
		$sitelogo="";
	}
	$descrip=mysubstr(strip_tags($descrip),0,50);
	if($action=="save"){
		$sql="update {$pre}friendlink set name='{$sitename}',url='{$siteurl}',logo='{$sitelogo}',descrip='{$descrip}',list={$list} where id={$id}";
		$conn->query($sql);
	}else{
		$sql="insert into {$pre}friendlink (name,url,logo,descrip,list,posttime,uid,username,yz) " .
			"VALUES ('{$sitename}','{$siteurl}','{$sitelogo}','{$descrip}',{$list},{$web['today']},{$adminuid},'{$adminname}',1)";
		$conn->query($sql);
	}
	die("<script LANGUAGE='javascript'>alert('���ĳɹ�');location.href=\"managefriendlink.php?page={$page}\";</script>");
}
$sql="select id from {$pre}friendlink";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($page<1)$page=1;
if($maxpage>1)$showpage=showpage($records,$page,$listrows);
$limitlow=($page-1)*$listrows;
$sql="select * from {$pre}friendlink order by list desc limit {$limitlow},{$listrows}";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$linkarr[$i]=$conn->fetch_array($query);
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
		<div class="title">�������ӹ���</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>��վ��</th>
			<th>��ַ</th>
			<th>LOGOͼƬ</th>
			<th>˵��</th>
			<th>����</th>
			<th>����ʱ��</th>
			<th>���</th>
			<th>������</th>
			<th>����</th>
		</tr>
EOT;
for($i=0;$i<count($linkarr);$i++){
$rs=$linkarr[$i];
if($rs['posttime']!=0)$rs['posttime']=date("y-m-d",$rs['posttime']);
else $rs['posttime']="";
if($rs['yz']==1)$rs['yz']="��";
else $rs['yz']="�w";
if($rs['logo']!="")$listimage="<img src=\"{$rs['logo']}\" width=\"88\" height=\"31\"/><br/>";
else $listimage="<div style=\"padding:15px;\"></div>";
echo <<<EOT
		<form name="myfrom" method="post" action="?action=save&id={$rs['id']}&page={$page}" style="margin:0px;">
		<tr align="center">
			<td><input type="text" name="sitename" id="sitename" value="{$rs['name']}" size="6"/></td>
			<td><input type="text" name="siteurl" id="siteurl" value="{$rs['url']}" size="16"/></td>
			<td>{$listimage}<input type="text" name="sitelogo" id="sitelogo" value="{$rs['logo']}" size="16"/></td>
			<td><input type="text" name="descrip" id="descrip" value="{$rs['descrip']}" size="16"/></td>
			<td><input type="text" name="list" id="list" value="{$rs['list']}" size="1"/></td>
			<td>{$rs['posttime']}</td>
			<td><a href="?action=changeyz&id={$rs['id']}&page={$page}"><div>{$rs['yz']}</div></a></td>
			<td>{$rs['username']}</td>
			<td><input type="submit" value="����">
				<a href="?action=del&id={$rs['id']}&page={$page}">ɾ��</a>
			</td>
		</tr>
		</form>
EOT;
}
echo <<<EOT
		<form name="myfrom" method="post" action="?action=add&page={$page}" style="margin:0px;">
		<tr align="center" height="50">
			<td><input type="text" name="sitename" id="sitename" size="6"/></td>
			<td><input type="text" name="siteurl" id="siteurl" size="16"/></td>
			<td><input type="text" name="sitelogo" id="sitelogo" size="16"/></td>
			<td><input type="text" name="descrip" id="descrip" size="16"/></td>
			<td><input type="text" name="list" id="list" value="{$rs['list']}" size="1"/></td>
			<td colspan="3">��վ������ַ����</td>
			<td><input type="submit" value="����"/></td>
		</tr>
		</form>
		</table>
		<div class="showpage">{$showpage}</div>
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
top.document.title="{$web['name']} - ��̨����ϵͳ - �������ӹ���";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>