<?php
/*
 * �ļ������� 2008-11-17 �� PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$error="";
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";

findsonsarray(0,$fidsarray,0);		//�ҳ�����û���õķ���
for($i=0;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("��",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
}

if($action=="del"){
	$menuid=(int)$_GET['menuid'];
	$sql="delete from {$pre}menu where id={$menuid}";
	$conn->query($sql);
	$action="ok";
}
if($action=="editsave"){
	$menuid=(int)$_GET['menuid'];
	$menuname=no_special_char($_POST['menuname']);
	$menulinkurl=no_special_char($_POST['menulinkurl']);
	$menulist=(int)$_POST['menulist'];
	$menutarget=(int)$_POST['menutarget'];
	$menuhide=(int)$_POST['menuhide'];
	if($menuname==""||$menulinkurl==""){
		$error="����ʧ�ܣ��˵�����������ַΪ��";
	}else{
		$sql="update {$pre}menu set name='{$menuname}',linkurl='{$menulinkurl}',list={$menulist},target={$menutarget}," .
				"hide={$menuhide} where id={$menuid}";
		$conn->query($sql);
		$action="ok";
	}
}
if($action=="add"){
	$menuname=no_special_char($_POST['menuname']);
	$menulinkurl=no_special_char($_POST['menulinkurl']);
	$menulist=(int)$_POST['menulist'];
	$menutarget=(int)$_POST['menutarget'];
	$menuhide=(int)$_POST['menuhide'];
	if($menuname==""||$menulinkurl==""){
		$error="����ʧ�ܣ��˵�����������ַΪ��";
	}else{
		$sql="insert into {$pre}menu (name,linkurl,list,target,hide) " .
				"VALUES('{$menuname}','{$menulinkurl}',{$menulist},{$menutarget},{$menuhide})";
		$conn->query($sql);
		$action="ok";
	}
}
if($action=="fidadd"){
	$fid=(int)$_GET['fid'];
	if($fidsarray[0][$fid]==""){
		$error="�������������";
	}else{
		$sql="insert into {$pre}menu (name,linkurl) VALUES('{$fidsarray[0][$fid]}','list.php?fid={$fid}')";
		$conn->query($sql);
		$action="ok";
	}
}


$sql="select * from {$pre}menu order by list desc";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$menus[$i]=$conn->fetch_array($query);
}

;echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>��̨�˵�</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
		<div class="title">��վ�˵�����</div>
		<div id="help1" class="help" style="display:none;">�˵����ƣ��˵������֣���ʾ�������߿��Կ��������֣����硡��ҳ���ͻ����Եȡ�</div>
		<div id="help2" class="help" style="display:none;">���ӵ�ַ:�ͻ������Ӧ�˵���Ҫȥ����ַ��</div>
		<div id="help3" class="help" style="display:none;">����:����Խ�󣬲˵�����ʾԽ��ǰ��</div>
		<div id="help4" class="help" style="display:none;">�´��ڴ�:��ǰ�˵���Ĵ򿪷�ʽ��ѡ�к�Ŀ��ҳ�潫���¿�һ�����ڴ�</div>
		<div id="help5" class="help" style="display:none;">����:��ǰ�˵����״̬��ѡ�к󲻻�Ҫ�˵�������ʾ�ò˵�</div>
		<div id="help6" class="help" style="display:none;">�޸�:�����ʹ�޸���Ч</div>
		<div id="help7" class="help" style="display:none;">ɾ��:����ɾ������˵�</div>
		<table border="0" cellpadding="1">
			<tr align="center">
				<td width="100">�˵�����<img src="images/help_icon.gif" onClick="showhelp(1)"></td>
				<td width="300">���ӵ�ַ<img src="images/help_icon.gif" onClick="showhelp(2)"></td>
				<td width="60">����<img src="images/help_icon.gif" onClick="showhelp(3)"></td>
				<td width="100">�´��ڴ�<img src="images/help_icon.gif" onClick="showhelp(4)"></td>
				<td width="60">����<img src="images/help_icon.gif" onClick="showhelp(5)"></td>
				<td width="60">�޸�<img src="images/help_icon.gif" onClick="showhelp(6)"></td>
				<td width="60">ɾ��<img src="images/help_icon.gif" onClick="showhelp(7)"></td>
			</tr>
EOT;
foreach($menus as $menu){
	$target_blank="";$hide_true="";
	if($menu['target']!=0)$target_blank="checked";
	if($menu['hide']!=0)$hide_true="checked";
echo <<<EOT
		<form method="post" action="?action=editsave&menuid={$menu['id']}" name="menuset" style="margin:0px;">
			<tr align="center">
				<td><input type="text" name="menuname" id="menuname" value="{$menu['name']}" size="10"/></td>
				<td><input type="text" name="menulinkurl" id="menulinkurl" value="{$menu['linkurl']}" size="30"/></td>
				<td><input type="text" name="menulist" id="menulist" value="{$menu['list']}" size="4"/></td>
				<td><input type="checkbox" name="menutarget" id="menutarget" value="1" {$target_blank}/></td>
				<td><input type="checkbox" name="menuhide" id="menuhide" value="1" {$hide_true}/></td>
				<td><input type="submit" value="�޸�"/></td>
				<td><a href="?action=del&menuid={$menu['id']}">ɾ��</a></td>
			</tr>
		</form>
EOT;
}
echo <<<EOT
		<form method="post" action="?action=add" name="menuset" style="margin:0px;">
			<tr align="center">
				<td><input type="text" name="menuname" id="menuname" value="" size="10"/></td>
				<td><input type="text" name="menulinkurl" id="menulinkurl" value="" size="30"/></td>
				<td><input type="text" name="menulist" id="menulist" value="0" size="4"/></td>
				<td><input type="checkbox" name="menutarget" id="menutarget" value="1"/></td>
				<td><input type="checkbox" name="menuhide" id="menuhide" value="1"/></td>
				<td colspan="2"><input type="submit" value="����"/></td>
			</tr>
		</form>
		</table>
		<div style="font-size:9pt;">������������Ϣһ��ֻ�ܲ���һ�У����ĺ󰴻س��Ϳɱ����޸ġ�</div>
	</div><div style="height:20"></div>
	<div id="body" style="text-align:center">
		<div class="title">�ӷ�����ѡ����Ŀ��ӵ��˵���</div>
		<table border="0" cellpadding="1">
		<tr>
			<th width="150">������</th>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(8)">
			<div id="help8" class="help" style="display:none;">�����ӵ��˵����������Զ��������׷�ӵ��˵����У�ʡȥ�ֹ�������鷳��</div>
			</th>
		</tr>
EOT;
for($i=1;$i<count($fidsarray);$i++){
echo <<<EOT
		<tr>
			<td>{$fidsarray[$i]['name']}</td>
			<td><a href="?action=fidadd&fid={$fidsarray[$i]['fid']}">��ӵ��˵���</a></td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
	</div>
EOT;
if($action=="ok"){
	echo "<script LANGUAGE='javascript'>alert('�����ɹ���');</script>";
}
if($error!=""){
	echo "<script LANGUAGE='javascript'>alert('{$error}��');</script>";
}
echo <<<EOT
<script LANGUAGE='javascript'>
function showhelp(sid){
	if(sid < 8){
		for(temp=1;temp<8;temp++){
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
top.document.title="{$web['name']} - ��̨����ϵͳ - ��վ�˵�����";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>