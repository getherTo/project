<?php
/*
 * �ļ������� 2008-11-21 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="del"){
	$id=abs((int)$_GET['id']);
	$conn->query("delete from {$pre}stencil where id={$id}");
	$action="ok";
}
if($action=="add"||$action=="editsave"){
	$name=str_replace(" ","",mysubstr(no_special_char($_POST['name']),0,18));
	$isdefault=abs((int)$_POST['isdefault']);
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property1']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property2']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property3']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property4']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property5']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property6']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property7']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property8']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property9']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property10']),0,18));
	if($name==""||$property1==""||$property2==""||$property3==""){
		die("<script language='javascript'>alert('�������ƻ�ǰ����������������');history.go(-1);</script>");
	}
	for($i=0;$i<10;$i++){
		if($property[$i]!=""){
			$content.=" ".$property[$i];
		}
	}
	$content=trim($content);
	if($action=="add"){
		$conn->query("insert into {$pre}stencil (name,isdefault,property,posttime) VALUES('{$name}',{$isdefault},'{$content}',{$web['today']})");
	}else{
		$id=abs((int)$_GET['id']);
		$sql="update {$pre}stencil set name='{$name}',isdefault={$isdefault},property='{$content}' where id={$id}";
		$conn->query($sql);
	}

	$action="ok";
	unset($property);unset($content);
}

if($action=="edit"){
	$id=abs((int)$_GET['id']);
	$sql="select * from {$pre}stencil where id={$id}";
	$query=$conn->query($sql);
	if($conn->num_rows($query)<1)die("<script language='javascript'>alert('����');location.href=\"class_stencil.php\";</script>");
	$stencilconfig=$conn->fetch_array($query);
	if($stencilconfig['isdefault'])$isdefault1="checked";
	else $isdefault0="checked";
	$editpro=explode(" ",$stencilconfig['property']);
}

$sql="select * from {$pre}stencil";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$max=0;
for($i=0;$i<$records;$i++){
	$stencil[$i]=$conn->fetch_array($query);
	$propertys[$i]=explode(" ",$stencil[$i]['property']);
	if($stencil[$i]['isdefault']==0)$stencil[$i]['isdefault']="��";
	else $stencil[$i]['isdefault']="��";
	$stencil[$i]['posttime']=date("y-m-d",$stencil[$i]['posttime']);
	if(count($propertys[$i])>$max)$max=count($propertys[$i]);		//�������ֶ���
}
if($max>8)$max=8;
for($i=0;$i<$records;$i++){
	$k=count($propertys[$i]);
	for($j=0;$j<$k;$j++){
		if($j==$max-1&&$max!=$k){
			$content[$i].="<td>...</td>";$j++;break;
		}
		$content[$i].="<td>{$propertys[$i][$j]}</td>";
	}
	for(;$j<$max;$j++){
		$content[$i].="<td>��</td>";
	}
}

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
		<div class="title">ģ�͹���</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="888888" cellspacing="0" cellpadding="1">
		<tr>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(1)"></th>
			<th>Ĭ��<img src="images/help_icon.gif" onClick="showhelp(2)"></th>
			<th colspan="{$max}">����<img src="images/help_icon.gif" onClick="showhelp(3)"></th>
			<th>����ʱ��</th>
			<th>����</th>
		</tr>
EOT;
for($i=0;$i<$records;$i++){
echo <<<EOT
		<tr align="center">
			<td>{$stencil[$i]['name']}</td>
			<td>{$stencil[$i]['isdefault']}</td>
			{$content[$i]}
			<td>{$stencil[$i]['posttime']}</td>
			<td><a href="?action=edit&id={$stencil[$i]['id']}">�޸�</a>
				<a href="?action=del&id={$stencil[$i]['id']}" ONCLICK="javascript:return confirm('���Ҫɾ����ɾ���󽫲��ɻָ���Ӧ�ø�ģ�͵���Ŀ������ָ����������Ӱ����������');">ɾ��</a>
			</td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
		<div style="padding:15px;"></div>
EOT;
if($action!="edit")
echo <<<EOT
		<div class="title">����ģ��</div>
		<div style="padding:5px;"></div>
		<form method="post" action="?action=add" name="form" onsubmit="return checkform();" style="margin:0px;">
EOT;
else
echo <<<EOT
		<div class="title">�޸�ģ��</div>
		<div style="padding:5px;"></div>
		<form method="post" action="?action=editsave&id={$stencilconfig['id']}" name="form" onsubmit="return checkform();" style="margin:0px;">
EOT;
echo <<<EOT
		<table width="100%" border="1" bordercolor="888888" cellspacing="0" cellpadding="1">
		<tr>
			<td>ģ�����ƣ�<img src="images/help_icon.gif" onClick="showhelp(1)">
				<div id="help1" class="help" style="display:none;">ģ�͵ı�ʶ��������Ŀָ��ģ��ʱ����ʾ�������</div>
			</td>
			<td width="550"><input type="text" name="name" id="name" value="{$stencilconfig['name']}"/>*</td>
		</tr>
		<tr>
			<td>�Ƿ���ΪĬ��ģ�ͣ�<img src="images/help_icon.gif" onClick="showhelp(2)">
				<div id="help2" class="help" style="display:none;">����Ӧ����Ŀû��ָ��Ӧ�õ�ģ��ʱ�����Զ�����Ĭ��ģ����Ϊ����ģ��</div>
			</td>
			<td><input type="radio" name="isdefault" id="isdefault" value="0" {$isdefault0} style="border:0px;"/>������ͨģ��
				<input type="radio" name="isdefault" id="isdefault" value="1" {$isdefault1} style="border:0px;"/>��ΪĬ��
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="float:left;"><img src="images/help_icon.gif" onClick="showhelp(3)"></div>
				<div id="help3" class="help" style="display:none;">Ϊ��Ӧ˲Ϣ���Ļ��������̶��Ĳ�Ʒ˵���Ѳ�����ӦԽ��Խ���Ҫ�����Ծ����Ƴ����Զ��Ƶ�ģ�͡�<br/>
					���÷�<br/>1��������ʵ�ʵĲ�Ʒ�������������ֵ�����ֻ���ҵ�������룺Ʒ�ơ��ͺš����ء���Ļ����С����ɫ����Ҫ���㡡�ȡ���ȫ�����Լ�����Ҫ�Լ����ơ�<br/>
					2����һ������һ������ֵ�������пո�(�����У�Ҳ�ᱻ�Զ�ȡ��)<br/>
					3��������Ӧ�ķ����У�ָ�����õ�ģ�ͣ�Ȼ������Ӳ�Ʒʱ���ͻ������Ӧ��ģ���������Լ��Ĳ�Ʒ��
				</div>
			</td>
		</tr>
		<tr>
			<td>����һ��</td>
			<td><input type="text" name="property1" id="property1" value="{$editpro['0']}"/>(��������ǰ����)</td>
		</tr>
		<tr>
			<td>���Զ���</td>
			<td><input type="text" name="property2" id="property2" value="{$editpro['1']}"/>(��������ǰ����)</td>
		</tr>
		<tr>
			<td>��������</td>
			<td><input type="text" name="property3" id="property3" value="{$editpro['2']}"/>(��������ǰ����)</td>
		</tr>
		<tr>
			<td>�����ģ�</td>
			<td><input type="text" name="property4" id="property4" value="{$editpro['3']}"/></td>
		</tr>
		<tr>
			<td>�����壺</td>
			<td><input type="text" name="property5" id="property5" value="{$editpro['4']}"/></td>
		</tr>
		<tr>
			<td>��������</td>
			<td><input type="text" name="property6" id="property6" value="{$editpro['5']}"/></td>
		</tr>
		<tr>
			<td>�����ߣ�</td>
			<td><input type="text" name="property7" id="property7" value="{$editpro['6']}"/></td>
		</tr>
		<tr>
			<td>���԰ˣ�</td>
			<td><input type="text" name="property8" id="property8" value="{$editpro['7']}"/></td>
		</tr>
		<tr>
			<td>���Ծţ�</td>
			<td><input type="text" name="property9" id="property9" value="{$editpro['8']}"/></td>
		</tr>
		<tr>
			<td>����ʮ��</td>
			<td><input type="text" name="property10" id="property10" value="{$editpro['9']}"/></td>
		</tr>
		<tr><td align="center" colspan="2"><input type="submit" value="�ύ"></td></tr>
		</table>
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
function checkform(){
	if (document.form.name.value==''){
		alert('������������ģ������');
		document.form.name.focus();
		return false;
	}
	if (document.form.property1.value==''){
		alert('����������������ǰ��������');
		document.form.property1.focus();
		return false;
	}
	if (document.form.property2.value==''){
		alert('����������������ǰ��������');
		document.form.property2.focus();
		return false;
	}
	if (document.form.property3.value==''){
		alert('����������������ǰ��������');
		document.form.property3.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ��Ʒģ�͹���";
</script>
EOT;
require("foot.htm");
if($action=="ok")echo "<script language='javascript'>alert('�����ɹ�');</script>";
?>
</body>
</html>
