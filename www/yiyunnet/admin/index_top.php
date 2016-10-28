<?php
/*
 * 文件创建于 2008-11-16 日 PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");



$query=$conn->query("select aid from {$pre}article");
$total=$conn->num_rows($query);
$query=$conn->query("select aid from {$pre}article where yz=0");
$notyz=$conn->num_rows($query);
$query=$conn->query("select aid from {$pre}article where vouch=1");
$vouch=$conn->num_rows($query);

//===================以下为模版
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div style="width:800px;">官方公告：
		<iframe name="mainFrame2" frameborder="0" height="20" scrolling="no" src="http://www.yiyunnet.cn/official.php" width='700'></iframe>
	</div>
	<div style="padding-top:5px;">您好！{$adminname}，欢迎您登陆。
		您的IP是：{$user['ip']}
		目前共有信息数 {$total} 条，其中（待审的{$notyz}条，推荐的{$vouch}条）
	</div>
EOT;

?>
</body>
</html>