<?php
/*
 * �ļ������� 2008-11-16 �� PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");



$query=$conn->query("select aid from {$pre}article");
$total=$conn->num_rows($query);
$query=$conn->query("select aid from {$pre}article where yz=0");
$notyz=$conn->num_rows($query);
$query=$conn->query("select aid from {$pre}article where vouch=1");
$vouch=$conn->num_rows($query);

//===================����Ϊģ��
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>��̨����</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div style="width:800px;">�ٷ����棺
		<iframe name="mainFrame2" frameborder="0" height="20" scrolling="no" src="http://www.yiyunnet.cn/official.php" width='700'></iframe>
	</div>
	<div style="padding-top:5px;">���ã�{$adminname}����ӭ����½��
		����IP�ǣ�{$user['ip']}
		Ŀǰ������Ϣ�� {$total} �������У������{$notyz}�����Ƽ���{$vouch}����
	</div>
EOT;

?>
</body>
</html>