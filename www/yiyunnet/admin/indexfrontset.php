<?php
/*
 * �ļ������� 2008-12-2 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
include('../fckeditor/fckeditor.php') ;
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="save"){
	$listfront=(int)$_POST['listfront'];
	$fronttitle=trim(filtrate(mysubstr($_POST['fronttitle'],0,100)));
	$frontcontent=tosafehtml($_POST['myeditor'],1);
	if($listfront==0){
		$sql="update {$pre}indexconfig set list=0 where keytags like '%front%'";
		$conn->query($sql);
		die("<script LANGUAGE='javascript'>alert('�����ѱ��棡');location.href=\"indexfrontset.php\";</script>");
	}
	if($frontcontent==""||$fronttitle==""){
		die("<script LANGUAGE='javascript'>alert('���󣬱��������Ϊ�գ�');history.go(-1);</script>");
	}
	$frontpic1=no_special_char($_POST['frontpic1']);
	$frontpic2=no_special_char($_POST['frontpic2']);
	$frontpic3=no_special_char($_POST['frontpic3']);
	$frontpic4=no_special_char($_POST['frontpic4']);
	$frontpic5=no_special_char($_POST['frontpic5']);
	$fronturl1=no_special_char($_POST['fronturl1']);
	$fronturl2=no_special_char($_POST['fronturl2']);
	$fronturl3=no_special_char($_POST['fronturl3']);
	$fronturl4=no_special_char($_POST['fronturl4']);
	$fronturl5=no_special_char($_POST['fronturl5']);
	$conn->query("delete from {$pre}indexconfig where keytags='frontnews'");
	$conn->query("insert into {$pre}indexconfig (keytags,list,title,content) VALUES ('frontnews',1,'{$fronttitle}','{$frontcontent}')");
	$sql="insert into {$pre}indexconfig (keytags,list,pic,url) VALUES ";
	$sql2="";
	if($frontpic1!="")$sql2=",('frontpic',1,'{$frontpic1}','{$fronturl1}')";
	if($frontpic2!="")$sql2.=",('frontpic',1,'{$frontpic2}','{$fronturl2}')";
	if($frontpic3!="")$sql2.=",('frontpic',1,'{$frontpic3}','{$fronturl3}')";
	if($frontpic4!="")$sql2.=",('frontpic',1,'{$frontpic4}','{$fronturl4}')";
	if($frontpic5!="")$sql2.=",('frontpic',1,'{$frontpic5}','{$fronturl5}')";
	if($sql2!="")$sql.=substr($sql2,1);
	$conn->query("delete from {$pre}indexconfig where keytags='frontpic'");
	$conn->query($sql);
	die("<script LANGUAGE='javascript'>alert('�����ѱ��棡');location.href=\"indexfrontset.php\";</script>");

}

$sql="select * from {$pre}indexconfig where keytags like '%front%'";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$row=$conn->fetch_array($query);
	if($row['keytags']=="frontnews"){
		$newsconfig=$row;
		$row['list']==1?$list1="checked":$list0="checked";
		$row=$conn->fetch_array($query);
	}
	$picarr[$i]=$row;
}


//==========================================================�༭��ʵ����
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Simple";
$oFCKeditor->Height='150px';
$oFCKeditor->Width='600px';
$oFCKeditor->Value=$newsconfig['content'];
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
		<div class="title">��ҳͷ����������</div>
		<div style="padding:5px;"></div>
		<form method="post" name="info" action="?action=save" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="200">�Ƿ���ʾͷ�����ݣ�</td>
			<td><input type="radio" name="listfront" id="listfront" value="1" {$list1} style="border:0px;"/>��ʾ
				<input type="radio" name="listfront" id="listfront" value="0" {$list0} style="border:0px;"/>����ʾ
			</td>
		</tr>
		<tr>
			<td>ͷ�����⣺</td>
			<td><input type="text" name="fronttitle" id="fronttitle" value="{$newsconfig['title']}"></td>
		</tr>
		<tr>
			<td>ͷ�����ݣ�</td>
			<td>{$myeditor}</td>
		</tr>
		<tr>
			<td>ͷ��ͼƬһ��</td>
			<td>ͼƬ��ַ��<input type="text" name="frontpic1" id="frontpic1" value="{$picarr['0']['pic']}" size="60"/>
				<input type="button" value="Ԥ��" onclick="showpreview(1)"/><br/>
				���ӵ�ַ��<input type="text" name="fronturl1" id="fronturl1" value="{$picarr['0']['url']}" size="60"/><br/>
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfileone.php?dir=0&formname=info&editname=frontpic1" width='500'></iframe>
			</td>
		</tr>
		<tr>
			<td>ͷ��ͼƬ����</td>
			<td>ͼƬ��ַ��<input type="text" name="frontpic2" id="frontpic2" value="{$picarr['1']['pic']}" size="60"/>
				<input type="button" value="Ԥ��" onclick="showpreview(2)"/><br/>
				���ӵ�ַ��<input type="text" name="fronturl2" id="fronturl2" value="{$picarr['1']['url']}" size="60"/><br/>
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfileone.php?dir=0&formname=info&editname=frontpic2" width='500'></iframe>
			</td>
		</tr>
		<tr>
			<td>ͷ��ͼƬ����</td>
			<td>ͼƬ��ַ��<input type="text" name="frontpic3" id="frontpic3" value="{$picarr['2']['pic']}" size="60"/>
				<input type="button" value="Ԥ��" onclick="showpreview(3)"/><br/>
				���ӵ�ַ��<input type="text" name="fronturl3" id="fronturl3" value="{$picarr['2']['url']}" size="60"/><br/>
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfileone.php?dir=0&formname=info&editname=frontpic3" width='500'></iframe>
			</td>
		</tr>
		<tr>
			<td>ͷ��ͼƬ�ģ�</td>
			<td>ͼƬ��ַ��<input type="text" name="frontpic4" id="frontpic4" value="{$picarr['3']['pic']}" size="60"/>
				<input type="button" value="Ԥ��" onclick="showpreview(4)"/><br/>
				���ӵ�ַ��<input type="text" name="fronturl4" id="fronturl4" value="{$picarr['3']['url']}" size="60"/><br/>
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfileone.php?dir=0&formname=info&editname=frontpic4" width='500'></iframe>
			</td>
		</tr>
		<tr>
			<td>ͷ��ͼƬ�壺</td>
			<td>ͼƬ��ַ��<input type="text" name="frontpic5" id="frontpic5" value="{$picarr['4']['pic']}" size="60"/>
				<input type="button" value="Ԥ��" onclick="showpreview(5)"/><br/>
				���ӵ�ַ��<input type="text" name="fronturl5" id="fronturl5" value="{$picarr['4']['url']}" size="60"/><br/>
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfileone.php?dir=0&formname=info&editname=frontpic5" width='500'></iframe>
			</td>
		</tr>
		</table>
		<div style="text-align:center;padding:5px">
			<input type="submit" value="�ύ">	<input type="reset" value="����">
		</div>
		</form>
		<div id="previewdiv" style="display:none;border:1px solid #aaa;">
			ͼƬԤ������<input type="button" value="�ر�ͼƬ" onclick="showpreview(0)"/><br />
			<img src="images/blank.jpg" name="previewimg" id="previewimg">
		</div>
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
	if (document.info.fronttitle.value==''){
		alert('���������ⲻ��Ϊ�գ�');
		document.info.fronttitle.focus();
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
//ͼƬԤ��
function showpreview(sid){
	url="";
	if(sid==1)url=document.info.frontpic1.value;
	if(sid==2)url=document.info.frontpic2.value;
	if(sid==3)url=document.info.frontpic3.value;
	if(sid==4)url=document.info.frontpic4.value;
	if(sid==5)url=document.info.frontpic5.value;
	if(url==""){
		eval("previewdiv.style.display=\"none\";");
	}else{
		document.images.previewimg.src=url;
		eval("previewdiv.style.display=\"\";");
	}
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ��ҳͷ�����ݹ���";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>