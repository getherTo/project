<?php
/*
 * 文件创建于 2008-11-15 日 PHPeclipse - PHP - Code Templates
 */
require("inc/head.php");
$web['title']="访客留言-".$web['title'];
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="save"){
	$gname=$_POST['gname'];
	$gmail=trim($_POST['gmail']);
	$gqq=trim($_POST['gqq']);
	$ghomepage=trim($_POST['ghomepage']);
	$gcontent=trim($_POST['gcontent']);
	if(!checkusername($gname)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的称呼错误！');history.go(-1);</script>");
	}
	if($gcontent==""){
		die("<script LANGUAGE='javascript'>alert('温馨提示！留言内容不能为空！');history.go(-1);</script>");
	}
	$gcontent=likepre($gcontent);
	if(!checkemail($gmail)){
		$gmail="";
	}
	if(!preg_match("/^[1-9][\d]{5,8}$/",$gqq)){
		$gqq="";
	}
	if(!checkurl($ghomepage)){
		$ghomepage="";
	}
	$sql="insert into {$pre}guestbook (email,oicq,weburl,uid,username,ip,content,posttime) " .
			"VALUES ('{$gmail}','{$gqq}','{$ghomepage}','{$user['id']}','{$gname}','{$user['ip']}','{$gcontent}',{$web['today']})";
	$conn->query($sql);
	die("<script>alert(\"恭喜您！发表成功！！\");location.href=\"guestbook.php\";</script>");
}
$page=(int)$_GET['page'];
if($page<1)$page=1;
$listrows=5;
$sql="select id from {$pre}guestbook where yz=1";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records>0){
	$maxpage=ceil($records/$listrows);
	if($page>$maxpage)$page=$maxpage;
	if($maxpage>1)$showpage=showpage($records,$page,$listrows);
	$limitlower=($page-1)*$listrows;
	$sql="select * from {$pre}guestbook where yz=1 limit {$limitlower},$listrows";
	$query=$conn->query($sql);
	$listmessage="";
	while($row=$conn->fetch_array($query)){
		$row['posttime']=date("y-m-d H:i:s",$row['posttime']);
		$listmessage.="<div class=\"glistinfo\"><span>留言者：{$row['username']}</span><span>E_Mail：{$row['email']}</span><span>主页：{$row['weburl']}</span><span>留言时间：{$row['posttime']}</span></div>\n" .
				"<div class=\"glistcontent\">{$row['content']}</div>\n" .
				"<div class=\"glistreply\">回复：{$row['reply']}</div>\n";
	}
}
require("template/head.htm");
require("template/guestbook.htm");
require("inc/foot.php");
?>
