<?php
/*
 * 文件创建于 2008-12-1 日 PHPeclipse - PHP - Code Templates
 */
require("inc/head.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="reg"){
	if($user['name']==""){
		$action="cannotreg";
	}
	if($web['linkreg']==0){
		$action="regclose";
	}
}elseif($action=="add"){
	if($user['name']==""||$web['linkreg']==0){
		header("location:index.php");exit;
	}
	$siteurl=$_POST['siteurl'];
	$sitename=$_POST['sitename'];
	$sitelogo=$_POST['sitelogo'];
	$descrip=$_POST['descrip'];
	if(!checkusername($sitename)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的网站名审核没通过！');history.go(-1);</script>");
	}
	if(!checkurl($siteurl)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的网址不能通过程序的审核！');history.go(-1);</script>");
	}
	if(!checkurl($sitelogo)){
		$sitelogo="";
	}
	$descrip=mysubstr(strip_tags($descrip),0,50);
	$sql="insert into {$pre}friendlink (name,url,logo,descrip,posttime,uid,username,yz) " .
			"VALUES ('{$sitename}','{$siteurl}','{$sitelogo}','{$descrip}',{$web['today']},{$user['id']},'{$user['name']}',0)";
	$conn->query($sql);
	die("<script LANGUAGE='javascript'>alert('您的申请已成功提交，等管理员审核！');location.href=\"index.php\";</script>");
}else{
	$action="";
	$sql="select * from {$pre}friendlink where yz=1 and logo=\"\" order by list desc";
	$query=$conn->query($sql);
	$textlink="<ul>";
	while($row=$conn->fetch_array($query)){
		$textlink.="<li><a href=\"{$row['url']}\">{$row['name']}</a></li>\n";
	}
	$textlink.="</ul>";

	$sql="select * from {$pre}friendlink where yz=1 and logo!=\"\" order by list desc";
	$query=$conn->query($sql);
	$imagelink="<ul>";
	while($row=$conn->fetch_array($query)){
		$imagelink.="<li><a href=\"{$row['url']}\"><img src=\"{$row['logo']}\" width=\"88\" height=\"31\" border=\"0\" title=\"{$row['name']}\"></a></li>\n";
	}
	$imagelink.="</ul>";

}

require("template/head.htm");
require("template/friendlink.htm");
require("inc/foot.php");

?>
