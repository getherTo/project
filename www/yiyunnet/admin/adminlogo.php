<?php
/*
 * �ļ������� 2008-11-28 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$page=(int)$_GET['page'];
$listrows=20;
$sql="select id from {$pre}adminlogo";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($page<1)$page=1;
if($maxpage>1)$showpage=showpage($records,$page,$listrows);
$limitlow=($page-1)*$listrows;
$logorder=$records-$limitlow+1;
$sql="select * from {$pre}adminlogo order by id desc limit {$limitlow},{$listrows}";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$logarr[$i]=$conn->fetch_array($query);
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
		<div class="title">����Ա��½��־</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>���</th>
			<th>UID</th>
			<th>�û���</th>
			<th>����</th>
			<th>��½ʱ��</th>
			<th>���</th>
			<th>����ʱ��</th>
			<th>IP��ַ</th>
			<th>����</th>
			<th>�����Ϣ</th>
		</tr>
EOT;
for($i=0;$i<count($logarr);$i++){
$rs=$logarr[$i];
$logorder--;
$onlinetime=date("H : i : s",$rs['lasttime']-$rs['logintime']-8*3600);
$logindate=date("y-m-d",$rs['logintime']);
$rs['logintime']=date("H:i:s",$rs['logintime']);
$rs['lasttime']=date("H:i:s",$rs['lasttime']);
if($rs['adminlevel']<4)$rs['adminlevel']="<span style=\"color:red;\">δ֪</span>";
elseif($rs['adminlevel']<8)$rs['adminlevel']="����Ա";
else $rs['adminlevel']="��������Ա";
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