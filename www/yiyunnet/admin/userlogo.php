<?php
/*
 * 文件创建于 2008-11-29 日 PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$page=(int)$_GET['page'];
$listrows=20;
$sql="select id from {$pre}userlogo";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($page<1)$page=1;
if($maxpage>1)$showpage=showpage($records,$page,$listrows);
$limitlow=($page-1)*$listrows;
$logorder=$records-$limitlow+1;
$sql="select * from {$pre}userlogo order by id desc limit {$limitlow},{$listrows}";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$logarr[$i]=$conn->fetch_array($query);
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
		<div class="title">前台用户登陆日志</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>序号</th>
			<th>UID</th>
			<th>用户名</th>
			<th>日期</th>
			<th>登陆时间</th>
			<th>最后活动</th>
			<th>在线时长</th>
			<th>IP地址</th>
			<th>级别</th>
			<th>相关信息</th>
		</tr>
EOT;
for($i=0;$i<count($logarr);$i++){
$rs=$logarr[$i];
$logorder--;
$onlinetime=date("H : i : s",$rs['lasttime']-$rs['logintime']-8*3600);
$logindate=date("y-m-d",$rs['logintime']);
$rs['logintime']=date("H:i:s",$rs['logintime']);
$rs['lasttime']=date("H:i:s",$rs['lasttime']);
if($rs['adminlevel']<4)$rs['adminlevel']="普通用户";
elseif($rs['adminlevel']<8)$rs['adminlevel']="管理员";
else $rs['adminlevel']="<span style=\"color:red;\">超级管理员</span>";
if($rs['uid']==0)$rs['uid']="";
echo <<<EOT
		<tr align="center">
			<td>{$logorder}</td>
			<td>{$rs['uid']}</td>
			<td>{$rs['uname']}</td>
			<td>{$logindate}</td>
			<td>{$rs['logintime']}</td>
			<td>{$rs['lasttime']}</td>
			<td>{$onlinetime}</td>
			<td>{$rs['ip']}</td>
			<td>{$rs['adminlevel']}</td>
			<td>{$rs['remark']}</td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
		<div class="showpage">{$showpage}</div>
	</div>
EOT;
require("foot.htm");
?>
</body>
</html>