<?php
/*
 * 文件创建于 2008-12-1 日 PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
include('../fckeditor/fckeditor.php') ;
$action=filtrate(trim($_GET['action']));
if($action=="del"){
	$id=(int)$_GET['id'];
	$conn->query("delete from {$pre}placard where id={$id}");
	header("location:manageplacard.php?action=ok");exit;
}
if($action=="add"){
	$placardtitle=trim(filtrate(mysubstr($_POST['placardtitle'],0,50)));
	$placardcontent=tosafehtml($_POST['myeditor'],1);
	if($placardtitle=="" or $placardcontent==""){
		die("<script LANGUAGE='javascript'>alert('错误，标题或内容为空！');history.go(-1);</script>");
	}
	$sql="insert into {$pre}placard (title,content,posttime) VALUES ('{$placardtitle}','{$placardcontent}',{$web['today']})";
	$conn->query($sql);
	header("location:manageplacard.php?action=ok");exit;
}
if($action=="editsave"){
	$id=(int)$_GET['id'];
	$placardtitle=trim(filtrate(mysubstr($_POST['placardtitle'],0,50)));
	$placardcontent=tosafehtml($_POST['myeditor'],1);
	if($placardtitle=="" or $placardcontent==""){
		die("<script LANGUAGE='javascript'>alert('错误，标题或内容为空！');history.go(-1);</script>");
	}
	$sql="update {$pre}placard set title='{$placardtitle}',content='{$placardcontent}' where id={$id}";
	$conn->query($sql);
	header("location:manageplacard.php?action=ok");exit;
}
if($action=="edit"){
	$id=(int)$_GET['id'];
	$sql="select * from {$pre}placard where id={$id}";
	$query=$conn->query($sql);
	$placardconfig=$conn->fetch_array($query);
	if($placardconfig['id']!=$id){
		die("<script LANGUAGE='javascript'>alert('错误，公告不存在！');history.go(-1);</script>");
	}
}

$sql="select * from {$pre}placard";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$placardarr[$i]=$conn->fetch_array($query);
}
//==========================================================编辑器实例化
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Simple";
$oFCKeditor->Height='180px';
$oFCKeditor->Width='600px';
$oFCKeditor->Value=$placardconfig['content'];
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
		<div class="title">网站公告管理</div>
		<div style="padding:5"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>标题</th>
			<th>内容</th>
			<th>发布时间</th>
			<th>操作</th>
		</tr>
EOT;
for($i=0;$i<count($placardarr);$i++){
$rs=$placardarr[$i];
$rs['posttime']=date("Y-m-d H:i:s",$rs['posttime']);
echo <<<EOT
		<tr>
			<td>{$rs['title']}</td>
			<td>{$rs['content']}</td>
			<td align="center">{$rs['posttime']}</td>
			<td align="center">
				<a href="?action=edit&id={$rs['id']}">修改</a>
				<a href="?action=del&id={$rs['id']}">删除</a>
			</td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
		<div style="padding:5"></div>
EOT;
if($action=="edit"){
echo <<<EOT
		<div class="title">修改已有公告</div>
		<div style="padding:5"></div>
		<form method="post" action="?action=editsave&id={$id}" name="placard" onsubmit="return checkform();" style="margin:0">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="200">标题</td>
			<td><input type="text" name="placardtitle" id="placardtitle" value="{$placardconfig['title']}"></td>
		</tr>
		<tr>
			<td>公告内容</td>
			<td>{$myeditor}</td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" value="提交"></td></tr>
		</table>
		</form>
EOT;
}else{
echo <<<EOT
		<div class="title">添加公告</div>
		<div style="padding:5"></div>
		<form method="post" action="?action=add" name="placard" onsubmit="return checkform();" style="margin:0">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="200">标题</td>
			<td><input type="text" name="placardtitle" id="placardtitle"></td>
		</tr>
		<tr>
			<td>公告内容</td>
			<td>{$myeditor}</td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" value="提交"></td></tr>
		</table>
		</form>
EOT;
}
echo <<<EOT
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
function checkform(){
	if (document.placard.placardtitle.value==''){
		alert('！！！标题不能为空！');
		document.placard.placardtitle.focus();
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
top.document.title="{$web['name']} - 后台管理系统 - 网站公告管理";
</script>
EOT;
if($action=="ok")echo "<script LANGUAGE='javascript'>alert('数据更新成功！');</script>";
?>
</body>
</html>