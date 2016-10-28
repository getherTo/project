<?php
/*
 * 文件创建于 2008-11-16 日 PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");		//检查权限及加载相关设置

echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台菜单</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body style="background:#9ad9fc url(images/bg_left.gif) repeat;">

<div style="width:158;">
	<div style="height:38;">
		<img height="38" src="images/title.gif" width="158" border="0">
	<div>
	<div style="background:url(images/admin_left_10.gif);" class="lefttitle">
		<span style="color:215DC6;font-weight:bold;"><a target="_top" href="index.php" style="color:215dc6;">管理首页</a>
		| <a target="_top" href="Logout.php" style="color:215dc6;">退出</a></span>
	</div>

	<div id="imgmenu1" onClick="showsubmenu(1)" style="background:url(images/admin_left_1.gif)" class="lefttitle">
		<span>网站设置 </span>
	</div>
	<div id="submenu1" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="webset.php" target="main">网站核心设置</a></div>
		<div class="subdiv"><a href="menuset.php" target="main">网站菜单设置</a></div>
		<div class="subdiv"><a href="indexfrontset.php" target="main">主页头条内容设置</a></div>
		<div class="subdiv"><a href="indexset.php" target="main">主页基本显示设置</a></div>
		<div class="lastsubdiv"><a href="managefriendlink.php" target="main">友情链接管理</a></div>
	</div>

	<div id="imgmenu2"  onClick="showsubmenu(2)" style="background:url(images/admin_left_2.gif)" class="lefttitle">
		<span>分类管理 </span>
	</div>
	<div id="submenu2" style="display: " class="leftsub">
		<div class="firstsubdiv"><a href="classmanage.php" target="main">分类（栏目）管理</a></div>
		<div class="subdiv"><a href="classmanage2.php" target="main">分类(栏目)常用操作</a></div>
		<div class="lastsubdiv"><a href="class_stencil.php" target="main">模型管理</a></div>
	</div>

	<div id="imgmenu3"  onClick="showsubmenu(3)" style="background:url(images/admin_left_3.gif)" class="lefttitle">
		<span>内容管理 </span>
	</div>
	<div id="submenu3" style="display: " class="leftsub">
		<div class="firstsubdiv"><a href="infopost.php" target="main">发布内容</a></div>
		<div class="subdiv"><a href="infomanage.php" target="main">内容管理与修改</a></div>
		<div class="subdiv"><a href="managevote.php" target="main">调查投票管理</a></div>
		<div class="lastsubdiv"><a href="manageplacard.php" target="main">网站公告管理</a></div>
	</div>

	<div id="imgmenu4"  onClick="showsubmenu(4)" style="background:url(images/admin_left_4.gif)" class="lefttitle">
		用户管理
	</div>
	<div id="submenu4" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="usermanage.php" target="main">用户资料管理</a></div>
		<div class="lastsubdiv"><a href="useradd.php" target="main">添加新用户</a></div>
	</div>

	<div id="imgmenu5"  onClick="showsubmenu(5)" style="background:url(images/admin_left_5.gif)" class="lefttitle">
		<span>留言管理 </span>
	</div>
	<div id="submenu5" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="guestbookmanage.php" target="main">访客留言管理</a></div>
		<div class="lastsubdiv"><a href="guestbookview.php" target="main">查看访客留言</a></div>
	</div>

	<div id="imgmenu9"  onClick="showsubmenu(9)" style="background:url(images/admin_left_9.gif)" class="lefttitle">
		<span>日志管理 </span>
	</div>
	<div id="submenu9" style="display: none" class="leftsub">
		<div class="firstsubdiv"><a href="adminlogo.php" target="main">后台登陆日志</a></div>
		<div class="lastsubdiv"><a href="userlogo.php" target="main">会员登陆日志</a></div>
	</div>

	<div style="background:url(images/admin_left_7.gif)" class="lefttitle">
		<span>版权信息 </span>
	</div>
	<div class="leftsub" style="padding:3 1;line-height:1.6em;">
		程序制作：<a href="http://www.yiyunnet.cn">宜云网络</a><br/>
		网址：www.yiyunnet.cn<br/>
		QQ：182824196
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
top.document.title="{$web['name']}--后台管理系统";
</script>
</body>
</html>
EOT;
?>