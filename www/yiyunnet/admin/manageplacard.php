<?php
/*
 * �ļ������� 2008-12-1 �� PHPeclipse - PHP - Code Templates
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
		die("<script LANGUAGE='javascript'>alert('���󣬱��������Ϊ�գ�');history.go(-1);</script>");
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
		die("<script LANGUAGE='javascript'>alert('���󣬱��������Ϊ�գ�');history.go(-1);</script>");
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
		die("<script LANGUAGE='javascript'>alert('���󣬹��治���ڣ�');history.go(-1);</script>");
	}
}

$sql="select * from {$pre}placard";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$placardarr[$i]=$conn->fetch_array($query);
}
//==========================================================�༭��ʵ����
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Simple";
$oFCKeditor->Height='180px';
$oFCKeditor->Width='600px';
$oFCKeditor->Value=$placardconfig['content'];
$myeditor=$oFCKeditor->CreateHtml();
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
		<div class="title">��վ�������</div>
		<div style="padding:5"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>����</th>
			<th>����</th>
			<th>����ʱ��</th>
			<th>����</th>
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
				<a href="?action=edit&id={$rs['id']}">�޸�</a>
				<a href="?action=del&id={$rs['id']}">ɾ��</a>
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
		<div class="title">�޸����й���</div>
		<div style="padding:5"></div>
		<form method="post" action="?action=editsave&id={$id}" name="placard" onsubmit="return checkform();" style="margin:0">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="200">����</td>
			<td><input type="text" name="placardtitle" id="placardtitle" value="{$placardconfig['title']}"></td>
		</tr>
		<tr>
			<td>��������</td>
			<td>{$myeditor}</td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" value="�ύ"></td></tr>
		</table>
		</form>
EOT;
}else{
echo <<<EOT
		<div class="title">��ӹ���</div>
		<div style="padding:5"></div>
		<form method="post" action="?action=add" name="placard" onsubmit="return checkform();" style="margin:0">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="200">����</td>
			<td><input type="text" name="placardtitle" id="placardtitle"></td>
		</tr>
		<tr>
			<td>��������</td>
			<td>{$myeditor}</td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" value="�ύ"></td></tr>
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
		alert('���������ⲻ��Ϊ�գ�');
		document.placard.placardtitle.focus();
		return false;
	}
	var oEditor = FCKeditorAPI.GetInstance('myeditor');
	//�����жϱ༭����ģʽ���༭ģʽ�����ģʽ��
	if ( oEditor.EditMode != FCK_EDITMODE_WYSIWYG ){
		alert( '�뽫�༭���л�������������ģʽ���ύ!' );
		return false;
	}
	//����ȡ�ñ༭�������ݳ���
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
		alert( '���ݲ�������4���֣���ֻ������'+iLength+'����' ) ;
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ��վ�������";
</script>
EOT;
if($action=="ok")echo "<script LANGUAGE='javascript'>alert('���ݸ��³ɹ���');</script>";
?>
</body>
</html>