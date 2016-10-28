<?php
/*
 * 文件创建于 2008-11-28 日 PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
$listrows=4;
$page=abs((int)$_GET['page']);
$action=filtrate(trim($_GET['action']));
$id=(int)$_GET['id'];
if(isoutlink())$action="";
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
		<div class="title">留言查看</div>
		<div style="padding:5px;"></div>
EOT;
for($i=0;$i<count($messagearr);$i++){
$rs=$messagearr[$i];
$rs['posttime']=date("y-m-d H:i",$rs['posttime']);
$rs['yz']==1?$rs['yz']="已审核":$rs['yz']="未审核";
echo <<<EOT
		<div class="glistinfo">
			<span>留言者：{$rs['username']}</span>
			<span>E_Mail：{$rs['email']}</span>
			<span>主页：{$rs['weburl']}</span>
			<span>留言时间：{$rs['posttime']}</span>
			<span>{$rs['yz']}</span>
		</div>
		<div class="glistcontent">{$rs['content']}</div>
		<div class="glistreply">回复：{$rs['reply']}</div>
		<div style="padding-bottom:10px;text-align:right;">
			<a href="guestbookmanage.php?action=del&id={$rs['id']}&page={$page}">删除</a>
			<a href="guestbookmanage.php?action=writeback&id={$rs['id']}&page={$page}">回复</a>
		</div>
EOT;
}
echo <<<EOT
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
function checkform(){
	if (document.addclass.classname.value==''){
		alert('！！！分类名不能为空！');
		document.addclass.classname.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - 后台管理系统 - 网站留言查看";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>