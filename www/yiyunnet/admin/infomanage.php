<?php
/*
 * �ļ������� 2008-11-22 �� PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
$action=filtrate(trim($_GET['action']));
$fid=abs((int)$_GET['fid']);
$page=abs((int)$_GET['page']);
$listrows=20;
$showpage="";
//========================================================����Ϊ���ݸ��´���
if($action=="work"){		//������������
	$ids="";
	for($i=0;$i<$listrows;$i++){
		$id=(int)$_POST['list'.$i];
		if($id>0)$ids.=",".$id;
	}
	$ids=substr($ids,1);
	if($ids==""){
		die("<script LANGUAGE='javascript'>alert('����û�м�¼�ɸ��ģ�');history.go(-1);</script>");
	}
	switch($work){
		case "del":
			$del2=(int)$_POST['del2'];
			if($del2!=1)die("<script LANGUAGE='javascript'>alert('����ɾ������ͬʱѡ��ȷ��ɾ����');history.go(-1);</script>");
			if($adminlevel<8){
				die("<script LANGUAGE='javascript'>alert('�Բ�������Ȩɾ����վ���ݣ�');history.go(-1);</script>");
			}
			$conn->query("delete from {$pre}article where aid in({$ids})");
			$conn->query("delete from {$pre}reply where aid in({$ids})");
			break;
		case "vouch":
			$conn->query("update {$pre}article set vouch=1 where aid in({$ids})");
			break;
		case "notvouch":
			$conn->query("update {$pre}article set vouch=0 where aid in({$ids})");
			break;
		case "yz":
			$conn->query("update {$pre}article set yz=1 where aid in({$ids})");
			break;
		case "notyz":
			$conn->query("update {$pre}article set yz=0 where aid in({$ids})");
			break;
		case "openblank":
			$conn->query("update {$pre}article set openblank=1 where aid in({$ids})");
			break;
		case "notopenblank":
			$conn->query("update {$pre}article set openblank=0 where aid in({$ids})");
			break;
		default:
			die("<script LANGUAGE='javascript'>alert('û�в���Ҫ���У���ȷ��ѡ���˲���������');history.go(-1);</script>");
			break;
	}
	header("location:".$web['refpage']);exit;
}
if($action=="changeyz"||$action=="changevouch"||$action=="changeopenblank"){		//���ĵ�����Ϣ״̬����
	$id=(int)$_GET['id'];
	$sql="select * from {$pre}article where aid={$id}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	if($row['aid']!=$id)die("<script LANGUAGE='javascript'>alert('�Ƿ�������');history.go(-1);</script>");
	$row['yz']==1?$yz=0:$yz=1;
	$row['vouch']==1?$vouch=0:$vouch=1;
	$row['openblank']==1?$openblank=0:$openblank=1;
	if($action=="changeyz")$conn->query("update {$pre}article set yz={$yz} where aid={$id}");
	if($action=="changevouch")$conn->query("update {$pre}article set vouch={$vouch} where aid={$id}");
	if($action=="changeopenblank")$conn->query("update {$pre}article set openblank={$openblank} where aid={$id}");
	header("location:".$web['refpage']);exit;
}
if($action=="del"){				//ɾ��������Ϣ����
	if($adminlevel<8){
		die("<script LANGUAGE='javascript'>alert('�Բ�������Ȩɾ����վ���ݣ�');history.go(-1);</script>");
	}
	$id=(int)$_GET['id'];
	$conn->query("delete from {$pre}article where aid={$id}");
	$conn->query("delete from {$pre}reply where aid={$id}");
	header("location:".$web['refpage']);exit;
}
//=========================================================���ݸ��´������
if($fid>0){
	$query=$conn->query("select * from {$pre}sort where fid={$fid}");
	$row=$conn->fetch_array($query);
	if($row['fid']!=$fid){
		$fid=0;
	}
}
$vyz=(int)$_GET['vyz'];
$vvouch=(int)$_GET['vvouch'];
$vopenblank=(int)$_GET['vopenblank'];
//=========================================
findsonsarray(0,$fidsarray,0,1);		//�ҳ����з���
$classoption="";		//�����б����롣
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("��",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	if($fid==$fidsarray[$i]['fid']){
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\" selected>{$fidsarray[$i]['name']}</option>\n";
	}else{
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\">{$fidsarray[$i]['name']}</option>\n";
	}
}
//==========================================�����ǲ�ѯ������ش���
$sql="select * from {$pre}article";
if($fid>0){
	$sqlv=" and fid={$fid}";
}
if($vyz==1){
	$sqlv.=" and yz=1";$vyz1="selected";
}elseif($vyz==2){
	$sqlv.=" and yz=0";$vyz2="selected";
}
if($vvouch==1){
	$sqlv.=" and vouch=1";$vvouch1="selected";
}elseif($vvouch==2){
	$sqlv.=" and vouch=0";$vvouch2="selected";
}
if($vopenblank==1){
	$sqlv.=" and openblank=1";$vopenblank1="selected";
}elseif($vopenblank==2){
	$sqlv.=" and openblank=0";$vopenblank2="selected";
}
if($sqlv!="")$sql.=" where ".substr($sqlv,5);
//============================================��ѯ������ش������
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($page<1)$page=1;
if($maxpage>1) $showpage=showpage($records,$page,$listrows);
$limitlow=($page-1)*$listrows;
$sql.=" order by aid desc limit $limitlow,$listrows";
$query=$conn->query($sql);
$k=$conn->num_rows($query);
for($i=0;$i<$k;$i++){
	$infos[$i]=$conn->fetch_array($query);
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
		<div class="title">��վ��Ϣ����</div>
		<div style="padding:5px;"></div>
		<form name="formv" action="" method="get" style="margin:0px;">
			��Ŀ<select name="fid" id="fid"><option value="0">�鿴������Ŀ</option>{$classoption}</select>
			&nbsp;�����<select name="vyz" id="vyz"><option value="0">����</option><option value="1" {$vyz1}>�����</option><option value="2" {$vyz2}>δ���</option></select>
			&nbsp;���Ƽ�<select name="vvouch" id="vvouch"><option value="0">����</option><option value="1" {$vvouch1}>���Ƽ�</option><option value="2" {$vvouch2}>δ�Ƽ�</option></select>
			&nbsp;���򿪷�ʽ<select name="vopenblank" id="vopenblank"><option value="0">����</option><option value="1" {$vopenblank1}>�´���</option><option value="2" {$vopenblank2}>ԭ����</option></select>
			&nbsp;��<input type="submit" value="�鿴" />
		</form>
		<div style="padding:5px;"></div>
		<form name="form1" action="?action=work" method="post" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="#cccccc">
		<tr>
			<th width="6%">ID</th>
			<th width="46%">�� ��</th>
			<th width="5%">���</th>
			<th width="9%">��������</th>
			<th width="7%">���</th>
			<th width="7%">�Ƽ�</th>
			<th width="9%">�򿪷�ʽ</th>
			<th width="11%">�޸�/ɾ��</th>
		</tr>
EOT;
for($key=0;$key<count($infos);$key++){
$rs=$infos[$key];
//foreach($infos AS $key=>$rs){
$rs['posttime']=date("y-m-d H:i",$rs['posttime']);
if($rs['yz']==1)$rs['yz']="<span style=\"color:#046304;\">&nbsp; �� &nbsp;</span>";
else $rs['yz']="<span style=\"color:#f00;\">&nbsp; �w &nbsp;</span>";
if($rs['vouch']==1)$rs['vouch']="<span style=\"color:#046304;\">&nbsp; �� &nbsp;</span>";
else $rs['vouch']="<span style=\"color:#f00;\">&nbsp; �w &nbsp;</span>";
if($rs['openblank']==1)$rs['openblank']="<span style=\"color:#f00;\">�´�Ʒ</span>";
else $rs['openblank']="ԭ����";
echo <<<EOT
		<tr align="center">
			<td>{$rs['aid']}</td>
			<td align="left">
				<input type="checkbox" name="list{$key}" id="list{$key}" value="{$rs['aid']}" style="border:0px;">
				<a href="../bencandy.php?id={$rs[aid]}" target="_blank"><span style="color:{$rs['titlecolor']}">{$rs[title]}</span></a>
			</td>
			<td>{$rs['hits']}</td>
			<td>{$rs['posttime']}</td>
			<td><a href="?action=changeyz&id={$rs[aid]}">{$rs['yz']}</a></td>
			<td><a href="?action=changevouch&id={$rs[aid]}">{$rs['vouch']}</a></td>
			<td><a href="?action=changeopenblank&id={$rs[aid]}">{$rs['openblank']}</a></td>
			<td>
				<a href="infoedit.php?id={$rs['aid']}">�޸�</a>
				<a href="?action=del&id={$rs['aid']}" ONCLICK="javascript:return confirm('���Ҫɾ����ɾ���󽫲��ɻָ�����');">ɾ��</a>
			</td>
		</tr>
EOT;
}
if($key==0)echo "<tr><td colspan=\"8\" height=\"40\">û�ҵ��κ�����</td></tr>";
echo <<<EOT
		<tr>
			<td colspan="8">
				[<a href="javascript:" onClick="CheckAll('all')">ȫѡ</a>/<a href="javascript:" onClick='CheckAll()'>��ѡ</a>/<a href="javascript:" onClick="CheckAll('no')">��ѡ</a>]
				<input type="radio" name="work" id="work" value="yz" style="border:0px;" />���
				<input type="radio" name="work" id="work" value="notyz" style="border:0px;" />ȡ�����
				<input type="radio" name="work" id="work" value="vouch" style="border:0px;" />�Ƽ�
				<input type="radio" name="work" id="work" value="notvouch" style="border:0px;" />ȡ���Ƽ�
				<input type="radio" name="work" id="work" value="notopenblank" style="border:0px;" />ԭ���ڴ�
				<input type="radio" name="work" id="work" value="openblank" style="border:0px;" />�´��ڴ�
				<input type="radio" name="work" id="work" value="del" style="border:0px;" />ɾ��
				<input type="checkbox" name="del2" id="del2" value="1" style="border:0px;" />ȷ��ɾ��
				<input type="submit" value="ִ��" />
			</td>
		</tr>
		</table>
		</form>
		<div class="showpage">{$showpage}</div>
	</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
function CheckAll(va){
	form=document.form1
	for (var i=0;i<form.elements.length-9;i++){
		var e = form.elements[i];
		if(va=='all'){
			e.checked = true;
		}else{
			if(va=='no'){
				e.checked = false;
			}else{
				e.checked == true ? e.checked = false : e.checked = true;
			}
		}
	}
}
function checkform() {
	form=document.form1
	var checko=false;
	for(var i=0;i<form.elements.length-9;i++){
		var e = form.elements[i];
		if(e.checked == true){
			checko=true;
			break;
		}
	}
	if(checko==false){
		alert( '��û��ѡ��Ҫ��������Ϣ!');
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ��վ���ݹ���";
//-->
</SCRIPT>
EOT;
require("foot.htm");
?>
</body>
</html>