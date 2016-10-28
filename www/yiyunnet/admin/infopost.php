<?php
/*
 * 文件创建于 2008-11-22 日 PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
include('../fckeditor/fckeditor.php') ;
$action=filtrate(trim($_GET['action']));
$fid=abs((int)$_GET['fid']);
if($fid>0){
	$sql="select * from {$pre}sort where fid={$fid}";
	$query=$conn->query($sql);
	$fidconfig=$conn->fetch_array($query);
	if($fidconfig['fid']!=$fid){
		$fid=0;$stencilarr="";
	}else{
		$stencil=$fidconfig['classmod'];
		if($stencil==-1){
			$stencilarr="";
		}elseif($stencil==0){
			$sql="select * from {$pre}stencil where isdefault=1";
			$query=$conn->query($sql);
			$row=$conn->fetch_array($query);
			if($row['property']==""){
				$stencilarr="";
			}else{
				$stencilarr=explode(" ",$row['property']);
				$stencilname=$row['name'];
			}
		}else{
			$sql="select * from {$pre}stencil where id={$fidconfig['classmod']}";
			$query=$conn->query($sql);
			$row=$conn->fetch_array($query);
			if($row['property']==""){
				$stencilarr="";
			}else{
				$stencilarr=explode(" ",$row['property']);
				$stencilname=$row['name'];
			}
		}
	}
}
if($action=="add1"&&$fid>0){
	$titlename=trim(filtrate(mysubstr($_POST['titlename'],0,100)));
	$picurl=mysubstr(no_special_char($_POST['picurl']),0,500);
	$d_picture=mysubstr(no_special_char($_POST['d_picture']),0,100);
	$keywords=mysubstr(no_special_char($_POST['keywords']),0,255);
	$yz=abs((int)$_POST['yz']);
	$vouch=abs((int)$_POST['vouch']);
	$openblank=abs((int)$_POST['openblank']);
	$content=tosafehtml($_POST['myeditor'],1);
	$pronum=abs((int)$_POST['pronum']);
	for($i=0;$i<$pronum;$i++){
		$property[$i]=str_replace(" ","",mysubstr(no_special_char($_POST["property$i"]),0,20));
		if($property[$i]!=""){
			$projoin.=" ".$property[$i];
			$contentpre.=" ".str_replace(" ","",mysubstr(no_special_char($_POST["provalue$i"]),0,20));
		}
	}
	$projoin=trim($projoin);
	$contentpre=trim($contentpre);
	if($titlename==""||$content==""){
		die("<script LANGUAGE='javascript'>alert('错误，标题或内容为空！');history.go(-1);</script>");
	}
	$content=$contentpre."&nbsp;".$content;
	$sql="insert into {$pre}article (fid,title,picurl,titlepic,keywords,yz,vouch,openblank,uid,posttime) " .
			"VALUES({$fid},'{$titlename}','{$picurl}'," .
			"'{$d_picture}','{$keywords}',{$yz},{$vouch},{$openblank},{$adminuid},{$web['today']})";
	$conn->query($sql);
	$aid=$conn->insert_id();
	$sql="insert into {$pre}reply (aid,fid,topic,property,content,uid) " .
			"VALUES({$aid},{$fid},1,'{$projoin}','{$content}',{$adminuid})";
	$conn->query($sql);
}
if($action=="add2"&&$fid>0){
	$titlename=filtrate(mysubstr($_POST['titlename'],0,100));
	$titlecolor=$_POST['titlecolor'];
	$author=mysubstr(no_special_char($_POST['author']),0,20);
	$copyfrom=mysubstr(no_special_char($_POST['copyfrom']),0,20);
	$copyfromurl=$_POST['copyfromurl'];
	$picurl=mysubstr(no_special_char($_POST['picurl']),0,500);
	$d_picture=mysubstr(no_special_char($_POST['d_picture']),0,100);
	$keywords=mysubstr(no_special_char($_POST['keywords']),0,255);
	$yz=abs((int)$_POST['yz']);
	$vouch=abs((int)$_POST['vouch']);
	$openblank=abs((int)$_POST['openblank']);
	$content=tosafehtml($_POST['myeditor'],1);
	$titlename=trim($titlename);
	if(!preg_match("/\A#[\da-fA-F]{6}\Z/",$titlecolor))$titlecolor="";
	if(!checkurl($copyfromurl))$copyfromurl="";
	if($titlename==""||$content==""){
		die("<script LANGUAGE='javascript'>alert('错误，标题或内容为空！');history.go(-1);</script>");
	}
	$sql="insert into {$pre}article (fid,title,titlecolor,author,copyfrom,copyfromurl,picurl,titlepic,keywords,yz,vouch,openblank,uid,posttime) " .
			"VALUES({$fid},'{$titlename}','{$titlecolor}','{$author}','{$copyfrom}','{$copyfromurl}','{$picurl}'," .
			"'{$d_picture}','{$keywords}',{$yz},{$vouch},{$openblank},{$adminuid},{$web['today']})";
	$conn->query($sql);
	$aid=$conn->insert_id();
	$sql="insert into {$pre}reply (aid,fid,topic,content,uid) " .
			"VALUES({$aid},{$fid},1,'{$content}',{$adminuid})";
	$conn->query($sql);
}

findsonsarray(0,$fidsarray,0,1);		//找出所有分类
$disclass=65535;
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("　　",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	//==============下面算那些栏目被禁用，易弄错逻辑
	if($fidsarray[$i]['disable']){
		$fidsarray[$i]['disable']="<span style=\"color:red\">禁用</span>";
		if($fidsarray[$i]['class']<$disclass)$disclass=$fidsarray[$i]['class'];
	}else{
		if($fidsarray[$i]['class']>$disclass){
			$fidsarray[$i]['disable']="<span style=\"color:red\">连带禁用</span>";
		}else{
			$fidsarray[$i]['disable']="正常";
			$disclass=65535;
		}
	}
	$sql="select aid from {$pre}article where fid={$fidsarray[$i]['fid']}";
	$query=$conn->query($sql);
	$fidsarray[$i]['infos']=$conn->num_rows($query);
}
//==========================================================编辑器实例化
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Yiyunnet";
$oFCKeditor->Height='350px';
$oFCKeditor->Width='630px';
$oFCKeditor->Value="";
$myeditor=$oFCKeditor->CreateHtml();
//====================================================================以下为模版
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
EOT;
if($fid==0){
echo <<<EOT
		<div class="title">请选择栏目</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<th>FID</th>
			<th width="400">栏目名</th>
			<th>发　表</th>
			<th>管理已有内容</th>
			<th>已有内容</th>
			<th>状态</th>
		</tr>
EOT;
for($i=1;$i	<count($fidsarray);$i++){
echo <<<EOT
		<tr align="center">
			<td>{$fidsarray[$i]['fid']}</td>
			<td align="left">　{$fidsarray[$i]['name']}</td>
			<td><a href="?fid={$fidsarray[$i]['fid']}">发表</a></td>
			<td><a href="infomanage.php?fid={$fidsarray[$i]['fid']}">管理</a></td>
			<td>{$fidsarray[$i]['infos']} 条</td>
			<td>{$fidsarray[$i]['disable']}</td>
		</tr>
EOT;
}
echo "		</table>";
}
if(($action=="add2"||$action=="add1")&&$fid>0){
echo <<<EOT
		<div style="padding:100;">
			数据添加完成，请选择相应的操作：<br />
			<a href="infopost.php?fid={$fid}">继续添加本栏目内容</a><br />
			<a href="infopost.php">返回栏目列表</a><br />
			<a href="bencandy.php?id={$aid}">前台查看</a>
		</div>
EOT;
}elseif($fid!=0){
if(is_array($stencilarr)){			//有模版存在时，应用模版，省去文章的一些表单项。
echo <<<EOT
		<div class="title">发表新内容</div>
		<div style="padding:5px;"></div>
		<form method="post" name="info" action="?action=add1&fid={$fid}" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<td width="120">栏目名：</td>
			<td>{$fidconfig['name']}　　　模版名：{$stencilname}</td>
		</tr>
		<tr>
			<td>标题(产品名)：</td>
			<td><input type="text" name="titlename" id="titlename" size="50"/></td>
		</tr>
EOT;
for($i=0;$i<count($stencilarr);$i++){
echo <<<EOT
		<tr>
			<td><input type="text" name="property{$i}" id="property{$i}" value="{$stencilarr[$i]}" size="14" /></td>
			<td><input type="text" name="provalue{$i}" name="provalue{$i}"></td>
		</tr>
EOT;
}
echo <<<EOT
		<tr>
			<td>图片：<input type="hidden" name="pronum" id="pronum" value="{$i}" /></td>
			<td><input type="hidden" name="picurl" id="picurl">
				<select name="d_picture" size="1" onChange="showpreview()"/>
					<option value=''>========无标题图片========</option>
				</select>
				<input type="button" onclick="doChange(document.info.picurl,document.info.d_picture);" value="更新图片" style="height:20px;width: 60px;" />　&nbsp;
				<input type="button" onclick="insertimage(document.info.d_picture.value)" value="将图片插入到当前内容中" style="height:20px;width:160px;" />
				<br />
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfile.php?dir={$fid}&formname=info&editname=picurl" width='500'></iframe>
				<div id="previewdiv" style="display:none;border:1px solid #aaa;position:absolute;top:10px;left:580px;background-color:#fff;width:160;">
					图片预览<br />
					<img src="images/blank.jpg" name="previewimg" id="previewimg" width="160" height="160">
				</div>
			</td>
		</tr>
		<tr>
			<td>关键字：</td>
			<td><input type="text" name="keywords" id="keywords" size="50"/></td>
		</tr>
		<tr>
			<td>设置：</td>
			<td>
				<input type="checkbox" name="yz" id="yz" value="1" checked style="border:0px;">审核　
				<input type="checkbox" name="vouch" id="vouch" value="1" style="border:0px;">推荐　
				<input type="checkbox" name="openblank" id="openblank" value="1" style="border:0px;">新窗口打开
			</td>
		</tr>
		<tr>
			<td>内容：</td>
			<td>
				{$myeditor}
			</td>
		</tr>
		</table>
		<div style="text-align:center"><input type="submit" value="提交"/>
			&nbsp;　　　<input type="reset" value="重填"/>
		</div>
		</form>
EOT;
}else{
echo <<<EOT
		<div class="title">发表新内容</div>
		<div style="padding:5px;"></div>
		<form method="post" name="info" action="?action=add2&fid={$fid}" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<td width="120">栏目名：</td>
			<td>{$fidconfig['name']}</td>
		</tr>
		<tr>
			<td>标题：</td>
			<td><input type="text" name="titlename" id="titlename" size="50"/></td>
		</tr>
		<tr>
			<td>标题颜色：</td>
			<td><input type="text" name="titlecolor" size="7" value="" id="titlecolor" onclick="foreColor_font();"/>点击输入框选择颜色</td>
		</tr>
		<tr>
			<td>作者：</td>
			<td><input type="text" name="author" id="author"/></td>
		</tr>
		<tr>
			<td>来源：</td>
			<td><input type="text" name="copyfrom" id="copyfrom"/></td>
		</tr>
		<tr>
			<td>来源网址：</td>
			<td><input type="text" name="copyfromurl" id="copyfromurl"/></td>
		</tr>
		<tr>
			<td>标题图片：</td>
			<td><input type="hidden" name="picurl" id="picurl">
				<select name="d_picture" size="1" onChange="showpreview()"/>
					<option value=''>========无标题图片========</option>
				</select>
				<input type="button" onclick="doChange(document.info.picurl,document.info.d_picture);" value="更新图片" style="height:20px;width: 60px;" />　&nbsp;
				<input type="button" onclick="insertimage(document.info.d_picture.value)" value="将图片插入到当前内容中" style="height:20px;width:160px;" />
				<br />
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfile.php?dir={$fid}&formname=info&editname=picurl" width='500'></iframe>
				<div id="previewdiv" style="display:none;border:1px solid #aaa;position:absolute;top:10px;left:580px;background-color:#fff;width:160;">
					标题图片预览<br />
					<img src="images/blank.jpg" name="previewimg" id="previewimg" width="160" height="160">
				</div>
			</td>
		</tr>
		<tr>
			<td>关键字：</td>
			<td><input type="text" name="keywords" id="keywords" size="50"/></td>
		</tr>
		<tr>
			<td>设置：</td>
			<td>
				<input type="checkbox" name="yz" id="yz" value="1" checked style="border:0px;">审核　
				<input type="checkbox" name="vouch" id="vouch" value="1" style="border:0px;">推荐　
				<input type="checkbox" name="openblank" id="openblank" value="1" style="border:0px;">新窗口打开
			</td>
		</tr>
		<tr>
			<td>内容：</td>
			<td>
				{$myeditor}
			</td>
		</tr>
		</table>
		<div style="text-align:center"><input type="submit" value="提交"/>
			&nbsp;　　　<input type="reset" value="重填"/>
		</div>
		</form>
EOT;
}
echo <<<EOT
		<img src="images/help_icon.gif" onClick="showhelp(1)">
		<div id="help1" class="help" style="display:none;">标题(产品名)：文章的标题或产品的名称，如果运用了产品模版，系统会自动识别并以产品的方式显示。<br />
			标题颜色：如果选择颜色，将以选定的颜色显示给用户。<br />
			标题图片：文章的标题图片，将单独放在内容的显要位置，可以上传图片，上传图片后会自动保存到图片选择框中，可供选择。如果正文中要上传图片，可先到标题图片这里上传，选定后点击&ldquo;将图片插入到当前内容中&rdquo;就可以把图片加到正文中，没果没应用产品模型，标题图片在显示正文时不会显示。<br />
			正文中图片编辑：先选择图片，再点击图片编辑按扭。源文件：图片的地址，替换文字：图片还没下载完时或鼠标放到图片上时显示的文字；URL：点击图片打开的页面。<br />
			关键字：可以多个关键字，用英文空格隔开。<br />
			编辑器的用法：和用WORD一样，系统设置的工具栏位置也尽量的和WORD一样，方便大家容易上手。
		</div>
EOT;
}
echo <<<EOT
	</div>

<script LANGUAGE='javascript'>
//显示帮助函数
function showhelp(sid){
	whichEl = eval("help" + sid);
	if (whichEl.style.display == "none"){
		eval("help" + sid + ".style.display=\"\";");
	}else{
		eval("help" + sid + ".style.display=\"none\";");
	}
}
//提交检查函数
function checkform(){
	if (document.info.titlename.value==''){
		alert('！！！标题不能为空！');
		document.info.titlename.focus();
		return false;
	}

	var oEditor = FCKeditorAPI.GetInstance('myeditor');
	//以下判断编辑器的模式（编辑模式与代码模式）
	if ( oEditor.EditMode != FCK_EDITMODE_WYSIWYG ){
		alert( '请将编辑器切换到所见即所得模式再提交!' );
		return false;
	}
	//以下取得编辑器里内容长度
	var oDOM = oEditor.EditorDocument;
	var iLength;
	if ( document.all ){
		iLength = oDOM.body.innerText.length;
	}else{
		var r = oDOM.createRange();
		r.selectNodeContents( oDOM.body );
		iLength = r.toString().length;
	}
	if(iLength<4){
		alert( '内容不能少于4个字，您只输入了'+iLength+'个字' ) ;
		return false;
	}

	return true;
}
//选择颜色函数
function foreColor_font()
{
	var arr = showModalDialog('images/selcolor.htm', '', 'dialogWidth:18.5em; dialogHeight:17.5em; status:0');
	if (arr != null)  document.info.titlecolor.value=arr;
	else  document.info.titlecolor.focus();
	document.info.titlecolor.style.color=arr;
}
// 当上传图片等文件时，往下拉框中填入图片路径，可根据实际需要更改此函数
function doChange(objText, objDrop){
	if (!objDrop) return;
	var str = objText.value;
	if(str==""){
		alert("您还没有上传图片，请上传！！");
	}
	var arr = str.split("|");
	var nIndex = objDrop.selectedIndex;
	objDrop.length=1;
	for (var i=0; i<arr.length-1; i++){
		objDrop.options[objDrop.length] = new Option(arr[i], arr[i]);
	}
	objDrop.selectedIndex = nIndex;
}
//往编辑器中加入图片
function insertimage(imageurl){
	var oEditor = FCKeditorAPI.GetInstance('myeditor');
	if ( oEditor.EditMode == FCK_EDITMODE_WYSIWYG ){
		if(imageurl==""){
			alert( '您没有选择图片，操作取消!' ) ;
		}else{
			oEditor.InsertHtml( '<img src="'+imageurl+'" />' ) ;
		}
	}else{
		alert( '需切换到所见即所得模式下才能完成!' ) ;
	}
}
//标题图片预览
function showpreview(){
	url=document.info.d_picture.options[document.info.d_picture.selectedIndex].value;
	if(url==""){
		eval("previewdiv.style.display=\"none\";");
	}else{
		document.images.previewimg.src=url;
		eval("previewdiv.style.display=\"\";");
	}
}

top.document.title="{$web['name']} - 后台管理系统 - 添加新内容";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>