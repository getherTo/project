<?php
/*
 * �ļ������� 2008-11-16 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");		//���Ȩ�޼������������

echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>��̨�˵�</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body style="background:#9ad9fc url(images/bg_left.gif) repeat;">

<div style="width:158;">
	<div style="height:38;">
		<img height="38" src="images/title.gif" width="158" border="0">
	<div>
	<div style="background:url(images/admin_left_10.gif);" class="lefttitle">
		<span style="color:215DC6;font-weight:bold;"><a target="_top" href="index.php" style="color:215dc6;">������ҳ</a>
		| <a target="_top" href="Logout.php" style="color:215dc6;">�˳�</a></span>
	</div>

	<div id="imgmenu1" onClick="showsubmenu(1)" style="background:url(images/admin_left_1.gif)" class="lefttitle">
		<span>��վ���� </span>
	</div>
	<div id="submenu1" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="webset.php" target="main">��վ��������</a></div>
		<div class="subdiv"><a href="menuset.php" target="main">��վ�˵�����</a></div>
		<div class="subdiv"><a href="indexfrontset.php" target="main">��ҳͷ����������</a></div>
		<div class="subdiv"><a href="indexset.php" target="main">��ҳ������ʾ����</a></div>
		<div class="lastsubdiv"><a href="managefriendlink.php" target="main">�������ӹ���</a></div>
	</div>

	<div id="imgmenu2"  onClick="showsubmenu(2)" style="background:url(images/admin_left_2.gif)" class="lefttitle">
		<span>������� </span>
	</div>
	<div id="submenu2" style="display: " class="leftsub">
		<div class="firstsubdiv"><a href="classmanage.php" target="main">���ࣨ��Ŀ������</a></div>
		<div class="subdiv"><a href="classmanage2.php" target="main">����(��Ŀ)���ò���</a></div>
		<div class="lastsubdiv"><a href="class_stencil.php" target="main">ģ�͹���</a></div>
	</div>

	<div id="imgmenu3"  onClick="showsubmenu(3)" style="background:url(images/admin_left_3.gif)" class="lefttitle">
		<span>���ݹ��� </span>
	</div>
	<div id="submenu3" style="display: " class="leftsub">
		<div class="firstsubdiv"><a href="infopost.php" target="main">��������</a></div>
		<div class="subdiv"><a href="infomanage.php" target="main">���ݹ������޸�</a></div>
		<div class="subdiv"><a href="managevote.php" target="main">����ͶƱ����</a></div>
		<div class="lastsubdiv"><a href="manageplacard.php" target="main">��վ�������</a></div>
	</div>

	<div id="imgmenu4"  onClick="showsubmenu(4)" style="background:url(images/admin_left_4.gif)" class="lefttitle">
		�û�����
	</div>
	<div id="submenu4" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="usermanage.php" target="main">�û����Ϲ���</a></div>
		<div class="lastsubdiv"><a href="useradd.php" target="main">������û�</a></div>
	</div>

	<div id="imgmenu5"  onClick="showsubmenu(5)" style="background:url(images/admin_left_5.gif)" class="lefttitle">
		<span>���Թ��� </span>
	</div>
	<div id="submenu5" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="guestbookmanage.php" target="main">�ÿ����Թ���</a></div>
		<div class="lastsubdiv"><a href="guestbookview.php" target="main">�鿴�ÿ�����</a></div>
	</div>

	<div id="imgmenu9"  onClick="showsubmenu(9)" style="background:url(images/admin_left_9.gif)" class="lefttitle">
		<span>��־���� </span>
	</div>
	<div id="submenu9" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="adminlogo.php" target="main">��̨��½��־</a></div>
		<div class="lastsubdiv"><a href="userlogo.php" target="main">��Ա��½��־</a></div>
	</div>

	<div style="background:url(images/admin_left_7.gif)" class="lefttitle">
		<span>��Ȩ��Ϣ </span>
	</div>
	<div class="leftsub" style="padding:3 1;line-height:1.6em;">
		����������<a href="http://www.yiyunnet.cn">��������</a><br/>
		��ַ��www.yiyunnet.cn<br/>
		QQ��182824196
	</div>
</div>


<script>
function showsubmenu(sid){
	whichEl = eval("submenu" + sid);
	if (whichEl.style.display == "none"){
		eval("submenu" + sid + ".style.display=\"\";");
	}else{
		eval("submenu" + sid + ".style.display=\"none\";");
	}
}
top.document.title="{$web['name']}--��̨����ϵͳ";
</script>
</body>
</html>
EOT;
?>