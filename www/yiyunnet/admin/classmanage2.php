<?php
/*
 * �ļ������� 2008-11-21 �� PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="joinsave"){
	$classa=abs((int)$_GET['classa']);
	$classb=abs((int)$_GET['classb']);
	if($classa==0||$classb==0){
		die("<script LANGUAGE='javascript'>alert('����');location.href=\"classmanage2.php\";</script>");
	}
	if($classa==$classb){
		die("<script LANGUAGE='javascript'>alert('���󣡲����Լ��ϲ��Լ�');location.href=\"classmanage2.php\";</script>");
	}

	$sql="select * from {$pre}sort where fid={$classa}";
	$query=$conn->query($sql);
	$aconfig=$conn->fetch_array($query);
	if($aconfig['fid']!=$classa)
		die("<script LANGUAGE='javascript'>alert('����');location.href=\"classmanage2.php\";</script>");

	$asonsfid=findsonsfid($classa);
	if(preg_match("/\b{$classb}\b/",$asonsfid))
		die("<script LANGUAGE='javascript'>alert('������Ŀ B ��������Ŀ A ������Ŀ��');location.href=\"classmanage2.php\";</script>");
	$sql="select * from {$pre}sort where fid={$classb}";
	$query=$conn->query($sql);
	$bconfig=$conn->fetch_array($query);
	if($bconfig['fid']!=$classb)
		die("<script LANGUAGE='javascript'>alert('����');location.href=\"classmanage2.php\";</script>");
	$conn->query("update {$pre}reply set fid={$classb} where fid={$classa}");		//��fidΪA��fid��ΪB
	$conn->query("update {$pre}article set fid={$classb} where fid={$classa}");		//��fidΪA��fid��ΪB
	$conn->query("update {$pre}sort set fup={$classb} where fup={$classa}");		//��fupΪA��fup��ΪB
	$conn->query("delete from {$pre}sort where fid={$classa}");		//ɾ��A
	$action="ok";
}
if($action=="restor"){
	$acceptclass=abs((int)$_GET['acceptclass']);
	if($acceptclass>0){
		$sql="select * from {$pre}sort where fid={$acceptclass}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$acceptclass=0;	//���������Ŀ�����ڣ���Ϊ������Ŀ
	}
	$okfids=substr(findsonsfid(0,0),1);
	$conn->query("update {$pre}sort set fup={$acceptclass} where fid not in ({$okfids})");
	$action="ok";
}
if($action=="move"){
	$movea=abs((int)$_GET['movea']);
	$moveb=abs((int)$_GET['moveb']);
	if($movea==0){
		die("<script LANGUAGE='javascript'>alert('����');location.href=\"classmanage2.php\";</script>");
	}
	if($movea==$moveb){
		die("<script LANGUAGE='javascript'>alert('���󣡲��������ƶ�');location.href=\"classmanage2.php\";</script>");
	}
	$asonsfid=findsonsfid($movea);
	if(preg_match("/\b{$moveb}\b/",$asonsfid))
		die("<script LANGUAGE='javascript'>alert('������Ŀ B ��������Ŀ A ������Ŀ��');location.href=\"classmanage2.php\";</script>");
	if($moveb>0){
		$sql="select * from {$pre}sort where fid={$moveb}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$moveb=0;
	}
	$conn->query("update {$pre}sort set fup={$moveb} where fid={$movea}");
	$action="ok";
}

$classoption="";		//�����б����롣���ϲ���Ŀ��Ŀ����Ŀʱ�õ���
findsonsarray(0,$fidsarray,0,1);		//�ҳ����з���
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("����",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	$classoption.="<option value=\"{$fidsarray[$i]['fid']}\">{$fidsarray[$i]['name']}</option>\n";
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
		<div class="title">��Ŀ�ϲ�����</div>
		<form method="get" action="" name="joinclass" onsubmit="return checkjoinform();" style="margin:0px;">
		<div style="padding:10px;">
			����ĿA
			<select name="classa" id="classa">
				<option value="">===��ѡ����Ŀ A ===</option>
				{$classoption}
			</select>
			�ϲ���B
			<select name="classb" id="classb">
				<option value="">===��ѡ����Ŀ B ===</option>
				{$classoption}
			</select>
			��Ŀ��
			<input type="hidden" name="action" id="action" value="joinsave"/>
			<input type="submit" value="ִ��">
		</div>
		</form>
		<div style="margin:0 0 0 30;">
			<li>���ܣ�����Ŀ A �ϲ�����Ŀ B �У���������Ŀ�ϲ���һ����Ŀ��</li>
			<li>�ϲ�����Ŀ A �����ٴ��ڣ�Ҳ�޷��ٴ�������һ������Ŀ</li>
			<li>ԭ�� A �е�����Ŀ�ᱻ���� B �е�����Ŀ�������ܵ�����Ӱ��</li>
			<li>�����Ŀ B ����Ŀ A ������Ŀ���ϲ����ܳɹ����������ܺϲ�������Ŀ�У�</li>
			<li>�����Ŀ A ����Ŀ B ������Ŀ�����Ժϲ����ϲ�����Ŀ A ������Ŀ����Ŀ B ��ֱ������Ŀ</li>
		</div>



		<div style="padding:20px;"></div>
		<div class="title">�޸�������Ŀ</div>
		<form method="get" action="" name="restoreclass" style="margin:0px;">
		<div style="padding:10px;">
			��������Ŀ�ŵ�
			<select name="acceptclass" id="acceptclass">
				<option value="0">==��==��==</option>
				{$classoption}
			</select>
			��Ŀ��
			<input type="hidden" name="action" id="action" value="restor"/>
			<input type="submit" value="�޸�������Ŀ">
		</div>
		</form>
		<div style="margin:0 0 0 30;">
			<li>���ܣ���������Ŀ�ŵ�ָ������Ŀ�С�</li>
			<li>����ÿ��һ��ʱ���޸�һ�Σ��������ʱ�����㹻��֤��Ŀ��������������δ֪ԭ�򣬻����޸�һ�º�һ�㡣</li>
			<li>�����򵥣�ֻҪ��һ�¡��޸�������Ŀ���Ϳɣ���û�г�����Ŀ���򲻻�����κβ�����</li>
		</div>



		<div style="padding:20px;"></div>
		<div class="title">��Ŀ�ƶ�����</div>
		<form method="get" action="" name="moveclass" onsubmit="return checkmoveform();" style="margin:0px;">
		<div style="padding:10px;">
			����ĿA
			<select name="movea" id="movea">
				<option value="">===��ѡ����Ŀ A ===</option>
				{$classoption}
			</select>
			�ƶ���B
			<select name="moveb" id="moveb">
				<option value="">===��ѡ����Ŀ B ===</option>
				<option value="0">==��==��==</option>
				{$classoption}
			</select>
			��Ŀ��
			<input type="hidden" name="action" id="action" value="move"/>
			<input type="submit" value="�� ��">
		</div>
		</form>
		<div style="margin:0 0 0 30;">
			<li>���ܣ�����Ŀ A �ƶ�����Ŀ B �в���Ϊ��������Ŀ</li>
			<li>ԭ�� A �е�����Ŀ�ᱻ��һ���ƶ�������Ȼ�� A ������Ŀ��</li>
			<li>�����ƶ�������Ŀ�У��������Ŀ B ����Ŀ A ������Ŀ�����Ƚ� B �ƶ������棬�ٰ� A �ƶ��� B ��</li>
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
function checkjoinform(){
	if (document.joinclass.classa.value==''){
		alert('��������ѡ����ĿA');
		document.joinclass.classa.focus();
		return false;
	}
	if (document.joinclass.classb.value==''){
		alert('��������ѡ����ĿB');
		document.joinclass.classb.focus();
		return false;
	}
	return true;
}
function checkmoveform(){
	if (document.moveclass.movea.value==''){
		alert('��������ѡ����ĿA');
		document.moveclass.movea.focus();
		return false;
	}
	if (document.moveclass.moveb.value==''){
		alert('��������ѡ����ĿB');
		document.moveclass.moveb.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ��վ������";
</script>
EOT;
if($action=="ok")echo "<script LANGUAGE='javascript'>alert('������ɣ�');</script>";
require("foot.htm");
?>
</body>
</html>