<?php
/*
 * 文件创建于 2008-11-26 日 PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
include('../fckeditor/fckeditor.php') ;
$action=filtrate(trim($_GET['action']));
$id=abs((int)$_GET['id']);
if($id<1){
	header("location:".$web['refpage']);exit;
}
$sql="select * from {$pre}article where aid={$id}";
$query=$conn->query($sql);
$arconfig=$conn->fetch_array($query);
if($arconfig['aid']!=$id){
	header("location:".$web['refpage']);exit;
}
//==================================================数据保存代码
if($action=="save1"||$action=="save2"){
	$fid=(int)$_POST['fid'];
	$query=$conn->query("select * from {$pre}sort where fid={$fid}");
	if($conn->num_rows($query)!=1){
		die("指定的栏目不存在");
	}
}
if($action=="save1"){
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
	$sql="update {$pre}article set fid={$fid},title='{$titlename}',picurl='{$picurl}',titlepic='{$d_picture}'," .
			"keywords='{$keywords}',yz={$yz},vouch={$vouch},openblank={$openblank} where aid={$id}";
	$conn->query($sql);
	$sql="update {$pre}reply set fid={$fid},property='{$projoin}',content='{$content}' where aid={$id} and topic=1";
	$conn->query($sql);
	die("<script LANGUAGE='javascript'>alert('修改成功！');location.href=\"infomanage.php\";</script>");
}
if($action=="save2"){
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
	$sql="update {$pre}article set fid={$fid},title='{$titlename}',titlecolor='{$titlecolor}',author='{$author}',copyfrom='{$copyfrom}'," .
			"copyfromurl='{$copyfromurl}',picurl='{$picurl}',titlepic='{$d_picture}',keywords='{$keywords}'," .
			"yz={$yz},vouch={$vouch},openblank={$openblank} where aid={$id}";
	$conn->query($sql);
	$sql="update {$pre}reply set fid={$fid},content='{$content}' where aid={$id} and topic=1";
	$conn->query($sql);
	die("<script LANGUAGE='javascript'>alert('修改成功！');location.href=\"infomanage.php\";</script>");
}

//==================================================数据保存代码完成
$fid=$arconfig['fid'];
$arconfig['yz']==1?$yz1="checked":$yz1="";
$arconfig['vouch']==1?$vouch1="checked":$vouch1="";
$arconfig['openblank']==1?$openblank1="checked":$openblank1="";
$sql="select * from {$pre}reply where aid={$id}";
$query=$conn->query($sql);
$arreply=$conn->fetch_array($query);
if($arreply['aid']!=$id){				//希望这些代码永远不会被执行。
	$conn->query("delete from {$pre}article where aid={$id}");
	header("location:".$web['refpage']);exit;
}
unset($stencilarr,$provaluearr);
if($arreply['property']!=""){
	$stencilarr=explode(" ",$arreply['property']);
	if(count($stencilarr)<10)$stencilarr[]="";
	$preg="/\A(.+?)&nbsp;/";
	preg_match($preg,$arreply['content'],$provalue);
	$arreply['content']=preg_replace($preg,"",$arreply['content']);
	if(is_array($provalue['1'])){
		$provaluearr=split(" ",$provalue['1']['0']);
	}else{
		$provaluearr=split(" ",$provalue['1']);
	}
}
//=========================================
findsonsarray(0,$fidsarray,0,1);		//找出所有分类
$classoption="";		//下拉列表框代码。
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("　",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	if($fid==$fidsarray[$i]['fid']){
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\" selected>{$fidsarray[$i]['name']}</option>\n";
	}else{
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\">{$fidsarray[$i]['name']}</option>\n";
	}
}
$titlepicoption="";
if($arconfig['titlepic']!=""){
	$titlepicoption="<option value=\"{$arconfig['titlepic']}\" selected />{$arconfig['titlepic']}</option>";
}
//==========================================================编辑器实例化
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Yiyunnet";
$oFCKeditor->Height='350px';
$oFCKeditor->Width='630px';
$oFCKeditor->Value=$arreply['content'];
$myeditor=$oFCKeditor->CreateHtml();
//================================================以下为模版
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
		<div class="title">内容修改</div>
		<div style="padding:5px;"></div>
EOT;
if(is_array($stencilarr)){
echo <<<EOT
		<form method="post" name="info" action="?action=save1&id={$id}" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<td width="120">所属栏目：</td>
			<td><select name="fid" id="fid">{$classoption}</select></td>
		</tr>
		<tr>
			<td>标题(产品名)：</td>
			<td><input type="text" name="titlename" id="titlename" size="50" value="{$arconfig['title']}"/></td>
		</tr>
EOT;
for($i=0;$i<count($stencilarr);$i++){
echo <<<EOT
		<tr>
			<td><input type="text" name="property{$i}" id="property{$i}" value="{$stencilarr[$i]}" size="14" /></td>
			<td><input type="text" name="provalue{$i}" name="provalue{$i}" value="{$provaluearr[$i]}"></td>
		</tr>
EOT;
}
echo <<<EOT
		<tr>
			<td>图片：<input type="hidden" name="pronum" id="pronum" value="{$i}" /></td>
			<td><input type="hidden" name="picurl" id="picurl" value="{$arconfig['picurl']}" />
				<select name="d_picture" size="1" onChange="showpreview()"/>
					<option value=''>========无标题图片========</option>{$titlepicoption}
				</select>
				<input type="button" onclick="doChange(document.info.picurl,document.info.d_picture);" value="载入图片" style="height:20px;width: 60px;" />　&nbsp;
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
			<td><input type="text" name="keywords" id="keywords" size="50" value="{$arconfig['keywords']}"/></td>
		</tr>
		<tr>
			<td>设置：</td>
			<td>
				<input type="checkbox" name="yz" id="yz" value="1" {$yz1} style="border:0px;">审核　
				<input type="checkbox" name="vouch" id="vouch" value="1" {$vouch1} style="border:0px;">推荐　
				<input type="checkbox" name="openblank" id="openblank" value="1" {$openblank1} style="border:0px;">新窗口打开
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
		<form method="post" name="info" action="?action=save2&id={$id}" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<td width="120">所属栏目：</td>
			<td><select name="fid" id="fid">{$classoption}</select></td>
		</tr>
		<tr>
			<td>标题：</td>
			<td><input type="text" name="titlename" id="titlename" size="50" value="{$arconfig['title']}"/></td>
		</tr>
		<tr>
			<td>标题颜色：</td>
			<td><input type="text" name="titlecolor" size="7" value="{$arconfig['titlecolor']}" id="titlecolor" onclick="foreColor_font();"/>点击输入框选择颜色</td>
		</tr>
		<tr>
			<td>作者：</td>
			<td><input type="text" name="author" id="author" value="{$arconfig['author']}"/></td>
		</tr>
		<tr>
			<td>来源：</td>
			<td><input type="text" name="copyfrom" id="copyfrom" value="{$arconfig['copyfrom']}"/></td>
		</tr>
		<tr>
			<td>来源网址：</td>
			<td><input type="text" name="copyfromurl" id="copyfromurl" value="{$arconfig['copyfromurl']}"/></td>
		</tr>
		<tr>
			<td>标题图片：</td>
			<td><input type="hidden" name="picurl" id="picurl" value="{$arconfig['picurl']}">
				<select name="d_picture" size="1" onChange="showpreview()"/>
					<option value=''>========无标题图片========</option>{$titlepicoption}
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
			<td><input type="text" name="keywords" id="keywords" size="50" value="{$arconfig['keywords']}"/></td>
		</tr>
		<tr>
			<td>设置：</td>
			<td>
				<input type="checkbox" name="yz" id="yz" value="1" {$yz1} style="border:0px;">审核　
				<input type="checkbox" name="vouch" id="vouch" value="1" {$vouch1} style="border:0px;">推荐　
				<input type="checkbox" name="openblank" id="openblank" value="1" {$openblank1} style="border:0px;">新窗口打开
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
		alert("该信息中没有上传图片信息，请上传！！");
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

top.document.title="{$web['name']} - 后台管理系统 - 内容修改操作";
</script>
EOT;

?>
</body>
</html>