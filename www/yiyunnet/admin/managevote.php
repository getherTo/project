<?php
/*
 * �ļ������� 2008-11-19 �� PHPeclipse - PHP - Code Templates
 */



require("adminhead.php");
$now=time();
$error="";
$votetype1="checked";$votetype2="";
$enableguestvote0="";$enableguestvote1="checked";
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="del"){
	$cid=(int)$_GET['cid'];
	$conn->query("delete from {$pre}vote_config where cid={$cid}");
	$conn->query("delete from {$pre}vote where cid={$cid}");
	$action="ok";
}
if($action=="add"||$action=="editsave"){
	$voetname=no_special_char($_POST['voetname']);
	$voteabout=no_special_char($_POST['voteabout']);
	$votetype=(int)$_POST['votetype'];
	$limittime=(int)$_POST['limittime'];
	$enableguestvote=(int)$_POST['enableguestvote'];
	$begintime=$_POST['begintime'];
	$endtime=$_POST['endtime'];
	$option1=no_special_char($_POST['option1']);
	$option2=no_special_char($_POST['option2']);
	$option3=no_special_char($_POST['option3']);
	$option4=no_special_char($_POST['option4']);
	$option5=no_special_char($_POST['option5']);
	$option6=no_special_char($_POST['option6']);
	$option7=no_special_char($_POST['option7']);
	$option8=no_special_char($_POST['option8']);
	$votenum1=(int)$_POST['votenum1'];
	$votenum2=(int)$_POST['votenum2'];
	$votenum3=(int)$_POST['votenum3'];
	$votenum4=(int)$_POST['votenum4'];
	$votenum5=(int)$_POST['votenum5'];
	$votenum6=(int)$_POST['votenum6'];
	$votenum7=(int)$_POST['votenum7'];
	$votenum8=(int)$_POST['votenum8'];
	if($voetname==""||$voteabout==""||$option1==""||$option2==""||$option3==""){
		die("<script LANGUAGE='javascript'>alert('������Ŀ���ƣ�ͶƱ����������ǰ����������������һ����������');history.go(-1);</script>");
	}
	if($votetype<1||$votetype>2)$votetype=1;
	if($limittime<0)$limittime=0;
	//=========================================
	if(!preg_match("/\A[\d]{4}-[\d]{2}-[\d]{2} (([01][0-9])|(2[0-3]))\:[0-5][0-9]\:[0-5][0-9]\Z/",$begintime)){
		$begintime=0;
	}else{
		$begintime=str_replace("-"," ",$begintime);
		$begintime=str_replace(":"," ",$begintime);
		$temp=explode(" ",$begintime);
		if(checkdate($temp['1'],$temp['2'],$temp['0'])){
			$begintime=mktime($temp['3'],$temp['4'],$temp['5'],$temp['1'],$temp['2'],$temp['0']);
		}else{
			$begintime=0;
		}
	}
	if(!preg_match("/\A[\d]{4}-[\d]{2}-[\d]{2} (([01][0-9])|(2[0-3]))\:[0-5][0-9]\:[0-5][0-9]\Z/",$endtime)){
		$endtime=0;
	}else{
		$endtime=str_replace("-"," ",$endtime);
		$endtime=str_replace(":"," ",$endtime);
		$temp=explode(" ",$endtime);
		if(checkdate($temp['1'],$temp['2'],$temp['0'])){
			$endtime=mktime($temp['3'],$temp['4'],$temp['5'],$temp['1'],$temp['2'],$temp['0']);
		}else{
			$endtime=0;
		}
	}
	//=========================================
	//=============================================ȡֵ����ʼ����ɡ�
	if($action=="add"){
		$sql="insert into {$pre}vote_config (name,about,type,limittime,posttime,begintime,endtime,enableguestvote) " .
				"VALUES('{$voetname}','{$voteabout}',{$votetype},{$limittime},{$now},{$begintime},{$endtime},{$enableguestvote})";
		$conn->query($sql);
		$insertid=$conn->insert_id();

	}
	if($action=="editsave"){
		$cid=(int)$_GET['cid'];
		$sql="update {$pre}vote_config set name='{$voetname}',about='{$voteabout}',type={$votetype},limittime={$limittime}," .
				"begintime={$begintime},endtime={$endtime},enableguestvote={$enableguestvote} where cid=$cid";
		$conn->query($sql);
		$conn->query("delete from {$pre}vote where cid={$cid}");
		$insertid=$cid;
	}
	//**********************************************�޸������ӵĹ��ø������ݿ����
	$sql2="insert into {$pre}vote (cid,voteoption,votenum) " .
		"VALUES ({$insertid},'{$option1}',{$votenum1})," .
		"({$insertid},'{$option2}',{$votenum2})," .
		"({$insertid},'{$option3}',{$votenum3})";
	if($option4!="")$sql2.=",({$insertid},'{$option4}',{$votenum4})";
	if($option5!="")$sql2.=",({$insertid},'{$option5}',{$votenum5})";
	if($option6!="")$sql2.=",({$insertid},'{$option6}',{$votenum6})";
	if($option7!="")$sql2.=",({$insertid},'{$option7}',{$votenum7})";
	if($option8!="")$sql2.=",({$insertid},'{$option8}',{$votenum8})";
	$conn->query($sql2);
	//**********************************************
	$action="ok";
}
if($action=="edit"){
	$cid=(int)$_GET['cid'];
	$query=$conn->query("select * from {$pre}vote_config where cid={$cid}");
	$records=$conn->num_rows($query);
	if($records!=1)$action="";
	else{
		$voteconfig=$conn->fetch_array($query);
		if($voteconfig['begintime']!=0){
			$voteconfig['begintime']=date("Y-m-d H:i:s",$voteconfig['begintime']);
		}else{
			$voteconfig['begintime']="";
		}
		if($voteconfig['endtime']!=0){
			$voteconfig['endtime']=date("Y-m-d H:i:s",$voteconfig['endtime']);
		}else{
			$voteconfig['endtime']="";
		}
		if($voteconfig['enableguestvote']==0){
			$enableguestvote0="checked";$enableguestvote1="";
		}
		if($voteconfig['type']==2){
			$votetype1="";$votetype2="checked";
		}
		$query=$conn->query("select * from {$pre}vote where cid={$cid} order by id");
		$records=$conn->num_rows($query);
		for($i=0;$i<$records;$i++){
			$optionarr[$i]=$conn->fetch_array($query);
		}
	}

}



$sql="select * from {$pre}vote_config";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$votearr[$i]=$conn->fetch_array($query);
	if($votearr[$i]['begintime']==0){
		$votearr[$i]['begintime']="δָ��";
	}else{
		$votearr[$i]['begintime']=date("y-m-d H:i:s",$votearr[$i]['begintime']);
	}
	if($votearr[$i]['endtime']==0){
		$votearr[$i]['endtime']="δָ��";
	}else{
		$votearr[$i]['endtime']=date("y-m-d H:i:s",$votearr[$i]['endtime']);
	}
}
$nowstr=date("Y-m-d H:i:s",time());
$nextmonthnow=date("Y-m-d H:i:s",time()+90*24*60*60);
//===================����Ϊģ��
;echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>��̨����</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
		<div class="title">����ͶƱ����</div>
		<div id="help1" class="help" style="display:none;">��Ŀ�������ͶƱ����Ŀ���ƣ�����˵����Ʒ�������顱��</div>
		<div id="help2" class="help" style="display:none;">������������Ŀ����ز��䣬����˵���������ҹ�˾��Ʒ���ﻹҪ�Ľ�����</div>
		<div id="help3" class="help" style="display:none;">��ʼʱ�䣺���û����ʼʱ�䣬���鲻����ʾ�����δָ������ʱ����Ч��</div>
		<div id="help4" class="help" style="display:none;">��ֹʱ�䣺���������ָ��ʱ�䣬���齫������ʾ�������ָ������һֱ��Ч��</div>
		<div id="help5" class="help" style="display:none;">�����������Ӧ�����ֶԱ��н��в�����</div>
		<div style="padding:3"></div>
		<table width="100%" border="1" bordercolor="888888" cellspacing="0" cellpadding="2">
		<tr>
			<th>���</th>
			<th>��Ŀ<img src="images/help_icon.gif" onClick="showhelp(1)"></th>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(2)"></th>
			<th>��ʼʱ��<img src="images/help_icon.gif" onClick="showhelp(3)"></th>
			<th>��ֹʱ��<img src="images/help_icon.gif" onClick="showhelp(4)"></th>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(5)"></th>
		</tr>
EOT;
for($i=0;$i<count($votearr);$i++){
$vote=$votearr[$i];
//foreach($votearr as $vote)
echo <<<EOT
		<tr align="center">
			<td>{$vote['cid']}</td>
			<td>{$vote['name']}</td>
			<td>{$vote['about']}</td>
			<td>{$vote['begintime']}</td>
			<td>{$vote['endtime']}</td>
			<td><a href="?action=del&cid={$vote['cid']}">ɾ��</a>
				<a href="?action=edit&cid={$vote['cid']}">�޸�</a>
				<a href="../vote.php?id={$vote['cid']}" target="_blank">�鿴</a>
			</td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
		<div style="padding:5"></div>
EOT;
if($action=="edit")
echo <<<EOT
		<div class="title">�޸�ԭ��ͶƱ</div>
		<div style="padding:2"></div>
		<form name="voteform" method="post" action="?action=editsave&cid={$cid}" onsubmit="return checkvoteform();">
EOT;
else
echo <<<EOT
		<div class="title">������ͶƱ</div>
		<div style="padding:2"></div>
		<form name="voteform" method="post" action="?action=add" onsubmit="return checkvoteform();">
EOT;
echo <<<EOT
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="4">
		<tr>
			<td width="240">ͶƱ��Ŀ���ƣ�<img src="images/help_icon.gif" onClick="showhelp(1)"></td>
			<td><input type="text" name="voetname" id="votename" value="{$voteconfig['name']}"/>*</td>
		</tr>
		<tr>
			<td>ͶƱ����<img src="images/help_icon.gif" onClick="showhelp(2)"></td>
			<td><input type="text" name="voteabout" id="voteabout" size="70" value="{$voteconfig['about']}"/>*</td>
		</tr>
		<tr>
			<td>ͶƱ���ͣ�</td>
			<td><input type="radio" name="votetype" id="votetype" value="1" {$votetype1}/>��ѡ��<input type="radio" name="votetype" id="votetype" value="2" {$votetype2}/>��ѡ</td>
		</tr>
		<tr>
			<td>ͶƱʱ������<img src="images/help_icon.gif" onClick="showhelp(6)"><div id="help6" class="help" style="display:none;">���ã�����ͬһ��������ͶƱ��ʱ��������ͶƱ����ٷ����ڲ�����ͶƱ��<br/>�÷�����������������,��������������ÿ��ͶƱ��ʱ����</div></td>
			<td><input type="text" name="limittime" id="limittime"size="3" value="{$voteconfig['limittime']}"/>����</td>
		</tr>
		<tr>
			<td>�Ƿ��ֹ�ο�ͶƱ��<img src="images/help_icon.gif" onClick="showhelp(7)"><div id="help7" class="help" style="display:none;">��������ο�ͶƱ����ֻ��ע���Ա����ͶƱ</div></td>
			<td><input type="radio" name="enableguestvote" id="enableguestvote" value="0" {$enableguestvote0}/>��ֹ��<input type="radio" name="enableguestvote" id="enableguestvote" value="1" {$enableguestvote1}/>����</td>
		</tr>
		<tr>
			<td>ͶƱ�Ŀ�ʼʱ��<img src="images/help_icon.gif" onClick="showhelp(3)"></td>
			<td><input type="text" name="begintime" id="begintime" size="19" value="{$voteconfig['begintime']}"/>����ʽ��{$nowstr}</td>
		</tr>
		<tr>
			<td>ͶƱ����ֹʱ��<img src="images/help_icon.gif" onClick="showhelp(4)"></td>
			<td><input type="text" name="endtime" id="endtime" size="19" value="{$voteconfig['endtime']}"/>����ʽ��{$nextmonthnow}</td>
		</tr>
		<tr>
			<td>ͶƱѡ�<img src="images/help_icon.gif" onClick="showhelp(8)"><div id="help8" class="help" style="display:none;">ͶƱ�ľ���ѡ�Ʊ�������趨һ����ʼƱ����һ��Ϊ0</div></td>
			<td>
				ѡ��һ��<input type="text" name="option1" id="option1" size="20" value="{$optionarr[0]['voteoption']}"/>*��Ʊ��<input type="text" name="votenum1" size="4" value="{$optionarr[0]['votenum']}"/><br/>
				ѡ�����<input type="text" name="option2" id="option2" size="20" value="{$optionarr[1]['voteoption']}"/>*��Ʊ��<input type="text" name="votenum2" size="4" value="{$optionarr[1]['votenum']}"/><br/>
				ѡ������<input type="text" name="option3" id="option3" size="20" value="{$optionarr[2]['voteoption']}"/>*��Ʊ��<input type="text" name="votenum3" size="4" value="{$optionarr[2]['votenum']}"/><br/>
				ѡ���ģ�<input type="text" name="option4" id="option4" size="20" value="{$optionarr[3]['voteoption']}"/>��Ʊ��<input type="text" name="votenum4" size="4" value="{$optionarr[3]['votenum']}"/><br/>
				ѡ���壺<input type="text" name="option5" id="option5" size="20" value="{$optionarr[4]['voteoption']}"/>��Ʊ��<input type="text" name="votenum5" size="4" value="{$optionarr[4]['votenum']}"/><br/>
				ѡ������<input type="text" name="option6" id="option6" size="20" value="{$optionarr[6]['voteoption']}"/>��Ʊ��<input type="text" name="votenum6" size="4" value="{$optionarr[5]['votenum']}"/><br/>
				ѡ���ߣ�<input type="text" name="option7" id="option7" size="20" value="{$optionarr[6]['voteoption']}"/>��Ʊ��<input type="text" name="votenum7" size="4" value="{$optionarr[6]['votenum']}"/><br/>
				ѡ��ˣ�<input type="text" name="option8" id="option8" size="20" value="{$optionarr[7]['voteoption']}"/>��Ʊ��<input type="text" name="votenum8" size="4" value="{$optionarr[7]['votenum']}"/><br/>
			</td>
		</tr>
		<tr>
			<td colspan=2 align="center"><input type="submit" value="�ύ">��<input type="reset" value="����"></td>
		</tr>
		</table>
		</form>
EOT;
echo <<<EOT
	</div>
<script LANGUAGE='javascript'>
function showhelp(sid){
	if(sid < 6){
		for(temp=1;temp<6;temp++){
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
function checkvoteform(){
	if (document.voteform.voetname.value==''){
		alert('��������Ŀ������Ϊ�գ�');
		document.voteform.voetname.focus();
		return false;
	}
	if (document.voteform.voteabout.value==''){
		alert('������ͶƱ������');
		document.voteform.voteabout.focus();
		return false;
	}
	if (document.voteform.option1.value==''){
		alert('����������ǰ����ѡ�');
		document.voteform.option1.focus();
	return false;
	}
	if (document.voteform.option2.value==''){
		alert('����������ǰ����ѡ�');
		document.voteform.option2.focus();
	return false;
	}
	if (document.voteform.option3.value==''){
		alert('����������ǰ����ѡ�');
		document.voteform.option3.focus();
	return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ����ͶƱ����";
</script>
EOT;
if($action=="ok"){
	echo "<script LANGUAGE='javascript'>alert('���ݸ��³ɹ���');</script>";
}

require("foot.htm");
?>
</body>
</html>