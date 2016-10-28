<?php
/*
 * 文件创建于 2008-11-18 日 PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
include('../fckeditor/fckeditor.php') ;
$action=filtrate(trim($_GET['action']));
$id=(int)$_GET['id'];
if(isoutlink())$action="";
//========================================项目保存代码
if($action=="spryadd"||$action=="spryedit"||$action=="rangeadd"||$action=="rangeedit"){
	$title=trim(filtrate($_POST['title']));
	$fids=no_special_char($_POST['fids']);
	$listmod=(int)$_POST['listmod'];
	$list=(int)$_POST['list'];
	if($title==""){
		die("<script LANGUAGE='javascript'>alert('错误，标题不能为空！');history.go(-1);</script>");
	}
	if($fids!=""){
		$fids=str_replace("，",",",$fids);
		if(!preg_match("/\A[1-9][\d]*+(,[1-9][\d]*)*\Z/",$fids))$fids="";
	}
	if($action=="spryadd"){
		$sql="insert into {$pre}indexconfig (keytags,title,fids,listmod,list) VALUES ('spry','{$title}','{$fids}',{$listmod},{$list})";
		$conn->query($sql);
	}elseif($action=="spryedit"){
		$sql="update {$pre}indexconfig set keytags='spry',title='{$title}',fids='{$fids}',listmod={$listmod},list={$list} where id={$id}";
		$conn->query($sql);
	}elseif($action=="rangeadd"){
		$sql="insert into {$pre}indexconfig (keytags,title,fids,listmod,list) VALUES ('range','{$title}','{$fids}',{$listmod},{$list})";
		$conn->query($sql);
	}elseif($action=="rangeedit"){
		$sql="update {$pre}indexconfig set keytags='range',title='{$title}',fids='{$fids}',listmod={$listmod},list={$list} where id={$id}";
		$conn->query($sql);
	}
	die("<script LANGUAGE='javascript'>alert('操作成功！');location.href=\"indexset.php\";</script>");
}
//========================================项目保存代码结束



if($action=="del"){
	$conn->query("delete from {$pre}indexconfig where id={$id}");
	die("<script LANGUAGE='javascript'>alert('选项卡项目删除成功！');location.href=\"indexset.php\";</script>");
}
if($action=="contentsave"){
	$content=tosafehtml($_POST['myeditor'],1);
	$conn->query("update {$pre}indexconfig set content='{$content}' where id={$id}");
	die("<script LANGUAGE='javascript'>alert('内容保存成功！');location.href=\"indexset.php\";</script>");
}
if($action=="editcontent"){
	$sql="select * from {$pre}indexconfig where id={$id}";
	$query=$conn->query($sql);
	$wantedit=$conn->fetch_array($query);
	if($wantedit['id']!=$id){
		die("<script LANGUAGE='javascript'>alert('错误，项目不存在！');location.href=\"indexset.php\";</script>");
	}
}
$sql="select * from {$pre}indexconfig order by list desc";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$row=$conn->fetch_array($query);
	if($row['keytags']=="spry"){
		$spryarr[]=$row;
		continue;
	}
	if($row['keytags']=="range"){
		$rangearr[]=$row;
	}
}
$sprynum=count($spryarr);
$rangenum=count($rangearr);
findsonsarray(0,$fidsarray,0,1);		//找出所有分类
$classoption="<option>如果要手工输入显示内容，FID栏请留空　</option>\n";
$disclass=65535;
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1)$fidsarray[$i]['name']=str_repeat("　　",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	$classoption.="<option>{$fidsarray[$i]['name']}－&gt;FID号：{$fidsarray[$i]['fid']}</option>\n";
}
//==========================================================编辑器实例化
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Yiyunnet";
$oFCKeditor->Height='200px';
$oFCKeditor->Width='630px';
$oFCKeditor->Value=$wantedit['content'];
$myeditor=$oFCKeditor->CreateHtml();
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
EOT;
if($action=="editcontent"){
echo <<<EOT
		<div class="title">显示内容编辑</div>
		<div style="padding:5px;"></div>
		<form name="spry" action="?action=contentsave&id={$wantedit['id']}" method="post" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="150">标题：</td>
			<td>{$wantedit['title']}</td>
		</tr>
		<tr>
			<td width="150">显示内容：</td>
			<td>{$myeditor}</td>
		</tr>
		</table>
		<div style="text-align:center;padding:5px">
			<input type="submit" value="提交">	<input type="reset" value="重填">
		</div>
		</form>
EOT;
}else{
echo <<<EOT
		<div class="title">选项卡<img src="images/help_icon.gif" onClick="showhelp(1)">方式显示的栏目设置</div>
		<div style="padding:5px;"></div>
		<div id="help1" class="help" style="display:none;">在首页主体部分以选项卡方式显示的内容块，在首页中显示的位置以所有项目中排序值最大的为标准。</div>
		<div id="help2" class="help" style="display:none;">显示在内容块顶部的位置，一般为栏目名，建议不要太长，以免影响整体排版。</div>
		<div id="help3" class="help" style="display:none;">决定显示的内容，也就是说内容将从指定的分类中提取出来，可以多个栏目，各个栏目号中间用逗号隔开，不包含子栏目。<br />可以为空，如果为空，则要手工编辑显示的内容，否则显示空内容。</div>
		<div id="help4" class="help" style="display:none;">显示方式：内容以什么样的方式显示给客户。<br />
			普通列表：将以内容标题加时间的方式显示，时间格式是以“-”分开的年月日<br />
			图片列表：在指定的栏目中查找到有标题图片的内容，以图片加标题的方式显示，能显示的条目较前者少。<br />
			一图片加列表：在普通列表的基础上再显示一幅图片，没图片时以普通列表方式显示<br />
			产品方式：首先栏目中要添加了产品，有产品格式的内容显示出来，如果没有，将显示“编辑内容中”的信息。只能显示2个产品，以推荐的信息优先显示。<br />
		</div>
		<div id="help5" class="help" style="display:none;">排序：数值越大，排在越前，首页默认显示排在第一的选项卡内容，其它的要点击相应标题才能显示。</div>
		<div id="help6" class="help" style="display:none;">修改：点击使对表单的修改生效，一次只能修改一行。<br />编辑内容：如果　栏目FID　为空，则点击编辑内容手工编辑显示的内容，如果不为空，优先显示栏目内容，当栏目内容为空时，编辑的内容才会显示出来。</div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>标题<img src="images/help_icon.gif" onClick="showhelp(2)"></th>
			<th>栏目FID<img src="images/help_icon.gif" onClick="showhelp(3)"></th>
			<th>显示方式<img src="images/help_icon.gif" onClick="showhelp(4)"></th>
			<th>排序<img src="images/help_icon.gif" onClick="showhelp(5)"></th>
			<th>操作<img src="images/help_icon.gif" onClick="showhelp(6)"></th>
		</tr>
EOT;
for($i=0;$i<$sprynum;$i++){
$rs=$spryarr[$i];
$listmod0="";$listmod1="";$listmod2="";$listmod3="";
if($rs['listmod']==0)$listmod0="checked";
if($rs['listmod']==1)$listmod1="checked";
if($rs['listmod']==2)$listmod2="checked";
if($rs['listmod']==3)$listmod3="checked";
echo <<<EOT
		<form name="spry" action="?action=spryedit&id={$rs['id']}" method="post" style="margin:0px;">
		<tr align="center">
			<td><input type="text" name="title" id="title" value="{$rs['title']}" size="8"/></td>
			<td><input type="text" name="fids" id="fids" value="{$rs['fids']}" size="5"/></td>
			<td><input type="radio" name="listmod" id="listmod" value="0" {$listmod0} style="border:0px;">普通列表
				<input type="radio" name="listmod" id="listmod" value="1" {$listmod1} style="border:0px;">图片列表
				<input type="radio" name="listmod" id="listmod" value="2" {$listmod2} style="border:0px;">一图片加列表
				<input type="radio" name="listmod" id="listmod" value="3" {$listmod3} style="border:0px;">产品方式
			</td>
			<td><input type="text" name="list" id="list" value="{$rs['list']}" size="2"/></td>
			<td><input type="submit" value="修改"> <a href="?action=editcontent&id={$rs['id']}">编辑内容</a> <a href="?action=del&id={$rs['id']}">删除</a></td>
		</tr>
		</form>
EOT;
}
echo <<<EOT
		<form name="spry" action="?action=spryadd" method="post" style="margin:0px;">
		<tr align="center">
			<td><input type="text" name="title" id="title" size="8"/></td>
			<td><input type="text" name="fids" id="fids" size="5"/></td>
			<td><input type="radio" name="listmod" id="listmod" value="0" style="border:0px;">普通列表
				<input type="radio" name="listmod" id="listmod" value="1" style="border:0px;">图片列表
				<input type="radio" name="listmod" id="listmod" value="2" checked style="border:0px;">一图片加列表
				<input type="radio" name="listmod" id="listmod" value="3" style="border:0px;">产品方式
			</td>
			<td><input type="text" name="list" id="list" size="2"/></td>
			<td><input type="submit" value="增加"></td>
		</tr>
		</form>
		</table>
		<div style="padding:10px;"></div>
		<table border="0"><tr><td>
		各栏目名与FID对应关系参照表：</td><td><select size="8">{$classoption}</select>
		</td></tr></table>
		<div style="padding:10px;"></div>
		<div class="title">平铺排列<img src="images/help_icon.gif" onClick="showhelp(7)">方式显示的栏目设置</div>
		<div style="padding:5px;"></div>
		<div id="help7" class="help" style="display:none;">在首页主体部分以阵列方式显示的内容块，每两个一行，详细参数请参照选项卡方式帮助信息。<br />
			特别说明：如果在排序中的最大值超过了选项卡项目中的最大排序值，则相应项目在首页显示时会在选项卡前面，选项卡的整体排序值是以其最大值为标准。而平铺排列则以单个进行，不影响整体。
		</div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>标题</th>
			<th>栏目FID</th>
			<th>显示方式</th>
			<th>排序</th>
			<th>操作</th>
		</tr>
EOT;
for($i=0;$i<$rangenum;$i++){
$rs=$rangearr[$i];
$listmod0="";$listmod1="";$listmod2="";$listmod3="";
if($rs['listmod']==0)$listmod0="checked";
if($rs['listmod']==1)$listmod1="checked";
if($rs['listmod']==2)$listmod2="checked";
if($rs['listmod']==3)$listmod3="checked";
echo <<<EOT
		<form name="range" action="?action=rangeedit&id={$rs['id']}" method="post" style="margin:0px;">
		<tr align="center">
			<td><input type="text" name="title" id="title" value="{$rs['title']}" size="8"/></td>
			<td><input type="text" name="fids" id="fids" value="{$rs['fids']}" size="5"/></td>
			<td><input type="radio" name="listmod" id="listmod" value="0" {$listmod0} style="border:0px;">普通列表
				<input type="radio" name="listmod" id="listmod" value="2" {$listmod2} style="border:0px;">一图片加列表
			</td>
			<td><input type="text" name="list" id="list" value="{$rs['list']}" size="2"/></td>
			<td><input type="submit" value="修改"> <a href="?action=editcontent&id={$rs['id']}">编辑内容</a> <a href="?action=del&id={$rs['id']}">删除</a></td>
		</tr>
		</form>
EOT;
}
echo <<<EOT
		<form name="range" action="?action=rangeadd" method="post" style="margin:0px;">
		<tr align="center">
			<td><input type="text" name="title" id="title" size="8"/></td>
			<td><input type="text" name="fids" id="fids" size="5"/></td>
			<td><input type="radio" name="listmod" id="listmod" value="0" style="border:0px;">普通列表
				<input type="radio" name="listmod" id="listmod" value="2" checked style="border:0px;">一图片加列表
			</td>
			<td><input type="text" name="list" id="list" size="2"/></td>
			<td><input type="submit" value="增加"></td>
		</tr>
		</form>
		</table>
EOT;
}
echo <<<EOT
	</div>
<script LANGUAGE='javascript'>
function showhelp(sid){
	if(sid < 7){
		for(temp=1;temp<7;temp++){
			if(temp!=sid)eval("help" + temp + ".style.display=\"none\";");
		}
	}
	whichEl = eval("help" + sid);
	if (whichEl.style.display == "none"){
		eval("help" + sid + ".style.display=\"\";");
	}else{
		eval("help" + sid + ".style.display=\"none\";");
	}
}
function checkform(){
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
top.document.title="{$web['name']} - 后台管理系统 - 主页基本设置";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>