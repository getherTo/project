<?php
/*
 * 文件创建于 2008-11-17 日 PHPeclipse - PHP - Code Templates
 * 对此文件更改请先备份好../inc/config.php文件，以免造成严重后果。
 */


require("adminhead.php");
require(WEBROOT."images/style.php");
$action=filtrate(trim($_GET['action']));
if($action=="save"){
	if($adminlevel<8)die("<script LANGUAGE='javascript'>alert('错误，您无权更改整站设置！');history.go(-1);</script>");
	$webname=no_special_char($_POST['webname']);
	$styledir=no_special_char($_POST['styledir']);

	$logo=no_special_char($_POST['logo']);
	$dirname=no_special_char($_POST['dirname']);
	$keywords=no_special_char($_POST['keywords']);

	$description=no_special_char($_POST['description']);
	$webmaster=no_special_char($_POST['webmaster']);
	$email=no_special_char($_POST['email']);

	$close=(int)$_POST['close'];
	$whyclose=no_special_char($_POST['whyclose']);
	$linkreg=(int)$_POST['linkreg'];

	$listdate=no_special_char($_POST['listdate']);
	$classlever=(int)$_POST['classlever'];
	$hitsofhot=(int)$_POST['hitsofhot'];

	$enableuserreg=(int)$_POST['enableuserreg'];
	$beian=no_special_char($_POST['beian']);
	$copyright=stripslashes($_POST['copyright']);		//去掉反斜线
	$copyright=tosafehtml($copyright,1);					//去掉危险的脚本。以防管理员误操作告成网站不安全。
	$copyright=addslashes($copyright);					//加上反斜线
	$copyright=str_replace(";","；",$copyright);

	$filecontent=read_file("../inc/config.php");
	$filecontent=preg_replace("/(web\['name'\])[\s]*\=[^;]*/","\\1=\"$webname\"",$filecontent);
	$filecontent=preg_replace("/(web\['styledir'\])[\s]*\=[^;]*/","\\1=\"$styledir\"",$filecontent);

	$filecontent=preg_replace("/(web\['logo'\])[\s]*\=[^;]*/","\\1=\"$logo\"",$filecontent);
	$filecontent=preg_replace("/(web\['dirname'\])[\s]*\=[^;]*/","\\1=\"$dirname\"",$filecontent);
	$filecontent=preg_replace("/(web\['keywords'\])[\s]*\=[^;]*/","\\1=\"$keywords\"",$filecontent);

	$filecontent=preg_replace("/(web\['description'\])[\s]*\=[^;]*/","\\1=\"$description\"",$filecontent);
	$filecontent=preg_replace("/(web\['webmaster'\])[\s]*\=[^;]*/","\\1=\"$webmaster\"",$filecontent);
	$filecontent=preg_replace("/(web\['email'\])[\s]*\=[^;]*/","\\1=\"$email\"",$filecontent);

	$filecontent=preg_replace("/(web\['close'\])[\s]*\=[^;]*/","\\1=$close",$filecontent);		//数字，不带引号
	$filecontent=preg_replace("/(web\['whyclose'\])[\s]*\=[^;]*/","\\1=\"$whyclose\"",$filecontent);
	$filecontent=preg_replace("/(web\['linkreg'\])[\s]*\=[^;]*/","\\1=$linkreg",$filecontent);

	$filecontent=preg_replace("/(web\['listdate'\])[\s]*\=[^;]*/","\\1=\"$listdate\"",$filecontent);
	$filecontent=preg_replace("/(web\['classlever'\])[\s]*\=[^;]*/","\\1=$classlever",$filecontent);
	$filecontent=preg_replace("/(web\['hitsofhot'\])[\s]*\=[^;]*/","\\1=$hitsofhot",$filecontent);

	$filecontent=preg_replace("/(web\['enableuserreg'\])[\s]*\=[^;]*/","\\1=$enableuserreg",$filecontent);
	$filecontent=preg_replace("/(web\['beian'\])[\s]*\=[^;]*/","\\1=\"$beian\"",$filecontent);
	$filecontent=preg_replace("/(web\['copyright'\])[\s]*\=[^;]*/","\\1=\"$copyright\"",$filecontent);
	write_file("../inc/config.php",$filecontent);
	header("location:webset.php?action=ok");
	die();
}

$styleoption="";
for($i=0;$i<count($stylearr);$i++){
	if($web['styledir']==$stylearr[$i]['dir']){
		$styleoption.="<option value=\"{$stylearr[$i]['dir']}\" selected>{$stylearr[$i]['name']}</option>\n";
	}else{
		$styleoption.="<option value=\"{$stylearr[$i]['dir']}\">{$stylearr[$i]['name']}</option>\n";
	}
}
$webopend="";$webclosed="";
if($web['close']==0){
	$webopend="checked";
}else{
	$webclosed="checked";
}
$enablereged="";$disablereged="";
if($web['enableuserreg']){
	$enablereged="checked";
}else{
	$disablereged="checked";
}
if($web['linkreg']==0){
	$linkreg0="checked";
}else{
	$linkreg1="checked";
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
		<div class="title">网站核心设置</div>
		<div style="padding:5px;"></div>
<form method="post" action="?action=save" name="webset" style="margin:0px;">
		<table cellpadding="5" border="1" bordercolor="cccccc" width="100%">
		<tr>
			<td width="200">网站名称：<img src="images/help_icon.gif" onClick="showhelp(0)"></td>
			<td><input type="text" name="webname" id="webname" value="{$web['name']}"/>
			<div id="help0" class="help" style="display:none;">你的网站的名字，在浏览器标题栏显示的文字（左上角）</div>
			</td>
		</tr>
		<tr>
			<td>网站默认风格：<img src="images/help_icon.gif" onClick="showhelp(1)"></td>
			<td><select name="styledir" id="styledir">{$styleoption}</select>
			<div id="help1" class="help" style="display:none;">网站默认的显示样式，用户也可以自己选择，当浏览者第一次浏览网站时，将应用这种样式，直到自己另外选择了其它风格时，以浏览者自己选定的风格这主。</div>
			</td>
		</tr>
		<tr>
			<td>网站头部LOGO地址：<img src="images/help_icon.gif" onClick="showhelp(2)"></td>
			<td><input type="text" name="logo" id="logo" value="{$web['logo']}"/>　一般不用改
			<div id="help2" class="help" style="display:none;">网站的标记图片，一般在页面的左上角的图片</div>
			</td>
		</tr>
		<tr>
			<td>网站目录：<img src="images/help_icon.gif" onClick="showhelp(3)"></td>
			<td><input type="text" name="dirname" id="dirname" value="{$web['dirname']}"/>　一般不用改
			<div id="help3" class="help" style="display:none;">你的网站的安装的目录，如果你的网站访问地址为http://www.wangzhi.com/mulu/的话，就填写mulu/。如果填写不正确，会有部分功能使用不正常。	　　　记得后面要加　"/"</div>
			</td>
		</tr>
		<tr>
			<td>网站热点关键词：<img src="images/help_icon.gif" onClick="showhelp(4)"></td>
			<td><input type="text" name="keywords" id="keywords" value="{$web['keywords']}" size="60"/>
			<div id="help4" class="help" style="display:none;">你的网站的关键词，方便百度，GOOGLE等的收录。</div>
			</td>
		</tr>
		<tr>
			<td>网站描述：<img src="images/help_icon.gif" onClick="showhelp(5)"></td>
			<td><input type="text" name="description" id="description" value="{$web['description']}" size="60"/>
			<div id="help5" class="help" style="display:none;">网站内容的相关描述，方便百度，GOOGLE等的收录。</div>
			</td>
		</tr>
		<tr>
			<td>网站管理者姓名：<img src="images/help_icon.gif" onClick="showhelp(6)"></td>
			<td><input type="text" name="webmaster" id="webmaster" value="{$web['webmaster']}"/>
			<div id="help6" class="help" style="display:none;">管理者姓名或称呼，方便客户联系</div>
			</td>
		</tr>
		<tr>
			<td>管理员邮箱：<img src="images/help_icon.gif" onClick="showhelp(7)"></td>
			<td><input type="text" name="email" id="email" value="{$web['email']}"/>
			<div id="help7" class="help" style="display:none;">管理员邮箱，请填写正确的邮箱。</div>
			</td>
		</tr>
		<tr>
			<td>网站打开还是关闭：<img src="images/help_icon.gif" onClick="showhelp(8)"></td>
			<td><input type="radio" name="close" id="close" value="0" {$webopend} style="border:none"/>打开
				<input type="radio" name="close" id="close" value="1" {$webclosed} style="border:none"/>关闭
			<div id="help8" class="help" style="display:none;">如果关闭网站，用户打开网站时，将显示下面的文字</div>
			</td>
		</tr>
		<tr>
			<td>网站关闭原因：<img src="images/help_icon.gif" onClick="showhelp(9)"></td>
			<td><input type="text" name="whyclose" id="whyclose" value="{$web['whyclose']}" size="50"/>
			<div id="help9" class="help" style="display:none;">网站关闭的原因，没关闭网站此信息无效</div>
			</td>
		</tr>
		<tr>
			<td>是否允许用户申请友情链接：<img src="images/help_icon.gif" onClick="showhelp(10)"></td>
			<td><input type="radio" name="linkreg" id="linkreg" value="0" {$linkreg0} style="border:none"/>不允许
				<input type="radio" name="linkreg" id="linkreg" value="1" {$linkreg1} style="border:none"/>允许
			<div id="help10" class="help" style="display:none;">友情链接：互相在自己的网站上放置对方网站的链接，这样当客户访问对方网站时也有可能通过点击链接访问到自己的网站。</div>
			</td>
		</tr>
		<tr>
			<td>列表页时间显示样式：<img src="images/help_icon.gif" onClick="showhelp(11)"></td>
			<td><input type="text" name="listdate" id="listdate" value="{$web['listdate']}"/>
			<div id="help11" class="help" style="display:none;">在显示清单时，时间显示的格式，可以为　年　月　日　时　分　秒　及各种文字的组合，还可以输入　不显示　来关闭时间的显示。除非编程人员，否则最好不要有英文字母。</div>
			</td>
		</tr>
		<tr>
			<td>分类的最大层数：<img src="images/help_icon.gif" onClick="showhelp(12)"></td>
			<td><input type="text" name="classlever" id="classlever" value="{$web['classlever']}"/>
			<div id="help12" class="help" style="display:none;">本系统支持无限级别的分类，但一般分类不会多于5层，建议不要将这个数字设置太大。</div>
			</td>
		</tr>
		<tr>
			<td>热门信息的最少点击量：<img src="images/help_icon.gif" onClick="showhelp(13)"></td>
			<td><input type="text" name="hitsofhot" id="hitsofhot" value="{$web['hitsofhot']}"/>
			<div id="help13" class="help" style="display:none;">最少被点击多少次的信息为热门信息，如果具体分类的设置，以相关分类设置为主</div>
			</td>
		</tr>
		<tr>
			<td>是否允许新用户注册：<img src="images/help_icon.gif" onClick="showhelp(14)"></td>
			<td><input type="radio" name="enableuserreg" id="enableuserreg" value="1" {$enablereged} style="border:none"/>允许
				<input type="radio" name="enableuserreg" id="enableuserreg" value="0" {$disablereged} style="border:none"/>不允许
			<div id="help14" class="help" style="display:none;">如果选择不允许，将关闭用户注册功能</div>
			</td>
		</tr>
		<tr>
			<td>网站备案编号：<img src="images/help_icon.gif" onClick="showhelp(15)"></td>
			<td><input type="text" name="beian" id="beian" value="{$web['beian']}"/>
			<div id="help15" class="help" style="display:none;">网站在信产部的备案号</div>
			</td>
		</tr>
		<tr>
			<td>网站底部版权信息：<img src="images/help_icon.gif" onClick="showhelp(16)"></td>
			<td><textarea name="copyright" id="copyright" cols="70" rows="6">{$web['copyright']}</textarea>
			<div id="help16" class="help" style="display:none;">显示要网页最底部的信息，支持　HTML　格式，如不会写　HTML　代码，可以到网页编辑器中编辑好，再切换到代码视图，将代码复制过来，有关网页编辑器的使用，请参照相关教程。</div>
			</td>
		</tr>
		</table>
		<div style="padding:10;text-align:center;">
			<input type="submit" value="提交">　　<input type="reset" value="重置">
		</div>
</form>
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
top.document.title="{$web['name']} - 后台管理系统 - 网站核心设置";
</script>
EOT;
if($action=="ok"){
	echo "<script LANGUAGE='javascript'>alert('数据保存成功！');</script>";
}
require("foot.htm");
?>
</body>
</html>
