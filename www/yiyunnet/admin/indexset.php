<?php
/*
 * �ļ������� 2008-11-18 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
include('../fckeditor/fckeditor.php') ;
$action=filtrate(trim($_GET['action']));
$id=(int)$_GET['id'];
if(isoutlink())$action="";
//========================================��Ŀ�������
if($action=="spryadd"||$action=="spryedit"||$action=="rangeadd"||$action=="rangeedit"){
	$title=trim(filtrate($_POST['title']));
	$fids=no_special_char($_POST['fids']);
	$listmod=(int)$_POST['listmod'];
	$list=(int)$_POST['list'];
	if($title==""){
		die("<script LANGUAGE='javascript'>alert('���󣬱��ⲻ��Ϊ�գ�');history.go(-1);</script>");
	}
	if($fids!=""){
		$fids=str_replace("��",",",$fids);
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
	die("<script LANGUAGE='javascript'>alert('�����ɹ���');location.href=\"indexset.php\";</script>");
}
//========================================��Ŀ����������



if($action=="del"){
	$conn->query("delete from {$pre}indexconfig where id={$id}");
	die("<script LANGUAGE='javascript'>alert('ѡ���Ŀɾ���ɹ���');location.href=\"indexset.php\";</script>");
}
if($action=="contentsave"){
	$content=tosafehtml($_POST['myeditor'],1);
	$conn->query("update {$pre}indexconfig set content='{$content}' where id={$id}");
	die("<script LANGUAGE='javascript'>alert('���ݱ���ɹ���');location.href=\"indexset.php\";</script>");
}
if($action=="editcontent"){
	$sql="select * from {$pre}indexconfig where id={$id}";
	$query=$conn->query($sql);
	$wantedit=$conn->fetch_array($query);
	if($wantedit['id']!=$id){
		die("<script LANGUAGE='javascript'>alert('������Ŀ�����ڣ�');location.href=\"indexset.php\";</script>");
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
findsonsarray(0,$fidsarray,0,1);		//�ҳ����з���
$classoption="<option>���Ҫ�ֹ�������ʾ���ݣ�FID�������ա�</option>\n";
$disclass=65535;
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1)$fidsarray[$i]['name']=str_repeat("����",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	$classoption.="<option>{$fidsarray[$i]['name']}��&gt;FID�ţ�{$fidsarray[$i]['fid']}</option>\n";
}
//==========================================================�༭��ʵ����
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Yiyunnet";
$oFCKeditor->Height='200px';
$oFCKeditor->Width='630px';
$oFCKeditor->Value=$wantedit['content'];
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
EOT;
if($action=="editcontent"){
echo <<<EOT
		<div class="title">��ʾ���ݱ༭</div>
		<div style="padding:5px;"></div>
		<form name="spry" action="?action=contentsave&id={$wantedit['id']}" method="post" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td width="150">���⣺</td>
			<td>{$wantedit['title']}</td>
		</tr>
		<tr>
			<td width="150">��ʾ���ݣ�</td>
			<td>{$myeditor}</td>
		</tr>
		</table>
		<div style="text-align:center;padding:5px">
			<input type="submit" value="�ύ">	<input type="reset" value="����">
		</div>
		</form>
EOT;
}else{
echo <<<EOT
		<div class="title">ѡ�<img src="images/help_icon.gif" onClick="showhelp(1)">��ʽ��ʾ����Ŀ����</div>
		<div style="padding:5px;"></div>
		<div id="help1" class="help" style="display:none;">����ҳ���岿����ѡ���ʽ��ʾ�����ݿ飬����ҳ����ʾ��λ����������Ŀ������ֵ����Ϊ��׼��</div>
		<div id="help2" class="help" style="display:none;">��ʾ�����ݿ鶥����λ�ã�һ��Ϊ��Ŀ�������鲻Ҫ̫��������Ӱ�������Ű档</div>
		<div id="help3" class="help" style="display:none;">������ʾ�����ݣ�Ҳ����˵���ݽ���ָ���ķ�������ȡ���������Զ����Ŀ��������Ŀ���м��ö��Ÿ���������������Ŀ��<br />����Ϊ�գ����Ϊ�գ���Ҫ�ֹ��༭��ʾ�����ݣ�������ʾ�����ݡ�</div>
		<div id="help4" class="help" style="display:none;">��ʾ��ʽ��������ʲô���ķ�ʽ��ʾ���ͻ���<br />
			��ͨ�б��������ݱ����ʱ��ķ�ʽ��ʾ��ʱ���ʽ���ԡ�-���ֿ���������<br />
			ͼƬ�б���ָ������Ŀ�в��ҵ��б���ͼƬ�����ݣ���ͼƬ�ӱ���ķ�ʽ��ʾ������ʾ����Ŀ��ǰ���١�<br />
			һͼƬ���б�����ͨ�б�Ļ���������ʾһ��ͼƬ��ûͼƬʱ����ͨ�б�ʽ��ʾ<br />
			��Ʒ��ʽ��������Ŀ��Ҫ����˲�Ʒ���в�Ʒ��ʽ��������ʾ���������û�У�����ʾ���༭�����С�����Ϣ��ֻ����ʾ2����Ʒ�����Ƽ�����Ϣ������ʾ��<br />
		</div>
		<div id="help5" class="help" style="display:none;">������ֵԽ������Խǰ����ҳĬ����ʾ���ڵ�һ��ѡ����ݣ�������Ҫ�����Ӧ���������ʾ��</div>
		<div id="help6" class="help" style="display:none;">�޸ģ����ʹ�Ա����޸���Ч��һ��ֻ���޸�һ�С�<br />�༭���ݣ��������ĿFID��Ϊ�գ������༭�����ֹ��༭��ʾ�����ݣ������Ϊ�գ�������ʾ��Ŀ���ݣ�����Ŀ����Ϊ��ʱ���༭�����ݲŻ���ʾ������</div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(2)"></th>
			<th>��ĿFID<img src="images/help_icon.gif" onClick="showhelp(3)"></th>
			<th>��ʾ��ʽ<img src="images/help_icon.gif" onClick="showhelp(4)"></th>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(5)"></th>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(6)"></th>
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
			<td><input type="radio" name="listmod" id="listmod" value="0" {$listmod0} style="border:0px;">��ͨ�б�
				<input type="radio" name="listmod" id="listmod" value="1" {$listmod1} style="border:0px;">ͼƬ�б�
				<input type="radio" name="listmod" id="listmod" value="2" {$listmod2} style="border:0px;">һͼƬ���б�
				<input type="radio" name="listmod" id="listmod" value="3" {$listmod3} style="border:0px;">��Ʒ��ʽ
			</td>
			<td><input type="text" name="list" id="list" value="{$rs['list']}" size="2"/></td>
			<td><input type="submit" value="�޸�"> <a href="?action=editcontent&id={$rs['id']}">�༭����</a> <a href="?action=del&id={$rs['id']}">ɾ��</a></td>
		</tr>
		</form>
EOT;
}
echo <<<EOT
		<form name="spry" action="?action=spryadd" method="post" style="margin:0px;">
		<tr align="center">
			<td><input type="text" name="title" id="title" size="8"/></td>
			<td><input type="text" name="fids" id="fids" size="5"/></td>
			<td><input type="radio" name="listmod" id="listmod" value="0" style="border:0px;">��ͨ�б�
				<input type="radio" name="listmod" id="listmod" value="1" style="border:0px;">ͼƬ�б�
				<input type="radio" name="listmod" id="listmod" value="2" checked style="border:0px;">һͼƬ���б�
				<input type="radio" name="listmod" id="listmod" value="3" style="border:0px;">��Ʒ��ʽ
			</td>
			<td><input type="text" name="list" id="list" size="2"/></td>
			<td><input type="submit" value="����"></td>
		</tr>
		</form>
		</table>
		<div style="padding:10px;"></div>
		<table border="0"><tr><td>
		����Ŀ����FID��Ӧ��ϵ���ձ�</td><td><select size="8">{$classoption}</select>
		</td></tr></table>
		<div style="padding:10px;"></div>
		<div class="title">ƽ������<img src="images/help_icon.gif" onClick="showhelp(7)">��ʽ��ʾ����Ŀ����</div>
		<div style="padding:5px;"></div>
		<div id="help7" class="help" style="display:none;">����ҳ���岿�������з�ʽ��ʾ�����ݿ飬ÿ����һ�У���ϸ���������ѡ���ʽ������Ϣ��<br />
			�ر�˵��������������е����ֵ������ѡ���Ŀ�е��������ֵ������Ӧ��Ŀ����ҳ��ʾʱ����ѡ�ǰ�棬ѡ�����������ֵ���������ֵΪ��׼����ƽ���������Ե������У���Ӱ�����塣
		</div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>����</th>
			<th>��ĿFID</th>
			<th>��ʾ��ʽ</th>
			<th>����</th>
			<th>����</th>
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
			<td><input type="radio" name="listmod" id="listmod" value="0" {$listmod0} style="border:0px;">��ͨ�б�
				<input type="radio" name="listmod" id="listmod" value="2" {$listmod2} style="border:0px;">һͼƬ���б�
			</td>
			<td><input type="text" name="list" id="list" value="{$rs['list']}" size="2"/></td>
			<td><input type="submit" value="�޸�"> <a href="?action=editcontent&id={$rs['id']}">�༭����</a> <a href="?action=del&id={$rs['id']}">ɾ��</a></td>
		</tr>
		</form>
EOT;
}
echo <<<EOT
		<form name="range" action="?action=rangeadd" method="post" style="margin:0px;">
		<tr align="center">
			<td><input type="text" name="title" id="title" size="8"/></td>
			<td><input type="text" name="fids" id="fids" size="5"/></td>
			<td><input type="radio" name="listmod" id="listmod" value="0" style="border:0px;">��ͨ�б�
				<input type="radio" name="listmod" id="listmod" value="2" checked style="border:0px;">һͼƬ���б�
			</td>
			<td><input type="text" name="list" id="list" size="2"/></td>
			<td><input type="submit" value="����"></td>
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
top.document.title="{$web['name']} - ��̨����ϵͳ - ��ҳ��������";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>