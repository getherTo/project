<?php
/*
 * �ļ������� 2008-11-20 �� PHPeclipse - PHP - Code Templates
 */
require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="add"){
	$classname=mysubstr(no_special_char($_POST['classname']),0,18);
	$fupclass=(int)$_POST['fupclass'];
	$classmod=(int)$_POST['classmod'];
	if($classname=="")die("<script LANGUAGE='javascript'>alert('���󣬷���������Ч��');location.href=\"classmanage.php\";</script>");
	if($fupclass!=0){
		$sql="select * from {$pre}sort where fid={$fupclass}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$fupclass=0;
	}
	$sql="insert into {$pre}sort (name,fup,classmod) VALUES('{$classname}',{$fupclass},{$classmod})";
	$conn->query($sql);
	$action="ok";
}
if($action=="del"){
	if($adminlevel<8)die("<script LANGUAGE='javascript'>alert('��������Ȩɾ����վ���ݣ�');location.href=\"classmanage.php\";</script>");
	$fid=(int)$_GET['fid'];
	$fids=$fid.findsonsfid($fid);
	if(strstr($fids,",")){
		$fids="fid in({$fids})";
	}else{
		$fids="fid={$fids}";
	}
	$conn->query("delete from {$pre}reply where {$fids}");		//ɾ������
	$conn->query("delete from {$pre}article where {$fids}");	//ɾ�����ݱ���
	$conn->query("delete from {$pre}sort where {$fids}");		//ɾ������
	$action="ok";
}
if($action=="editsave"){
	$fid=(int)$_GET['fid'];

	$fupclass=abs((int)$_POST['fupclass']);
	$name=no_special_char($_POST['name']);
	$disable=abs((int)$_POST['disable']);
	$classmod=(int)$_POST['classmod'];
	$indexlist=abs((int)$_POST['indexlist']);
	$hitsofhot=abs((int)$_POST['hitsofhot']);
	$listtitlechars=abs((int)$_POST['listtitlechars']);
	$dateformat=no_special_char($_POST['dateformat']);
	$fatherlist=abs((int)$_POST['fatherlist']);
	$listsons=abs((int)$_POST['listsons']);
	$listsortlen=abs((int)$_POST['listsortlen']);
	$listrows=abs((int)$_POST['listrows']);
	$listcontentchars=abs((int)$_POST['listcontentchars']);
	$keyword=no_special_char($_POST['keyword']);
	$descrip=no_special_char($_POST['descrip']);
	if($name==""){
		die("<script LANGUAGE='javascript'>alert('������Ŀ���Ʋ���Ϊ�գ�');history.go(-1);</script>");
	}
	if($fupclass==$fid){
		die("<script LANGUAGE='javascript'>alert('���󣬲���ָ������Ϊ�Լ����ϼ���Ŀ��');history.go(-1);</script>");
	}
	$sonsfids=findsonsfid($fid);		//�ҵ�����Ŀ�б�
	if($sonsfids!=""){
		if(preg_match("/\b{$fupclass}\b/",$sonsfids)){
			die("<script LANGUAGE='javascript'>alert('���󣬲���ָ�����ѵ�����ĿΪ�Լ����ϼ���Ŀ������ָ����������ĿΪ�Լ����ϼ���Ŀ����');history.go(-1);</script>");
		}
	}
	if($fupclass!=0){
		$sql="select * from {$pre}sort where fid={$fupclass}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$fupclass=0;		//���ָ�����ϼ���Ŀ�����ڣ���Ϊ������Ŀ
	}
	$sql="update {$pre}sort set fup={$fupclass}, name='{$name}', disable={$disable}, classmod={$classmod}," .
			" indexlist={$indexlist}, listtitlechars={$listtitlechars}, dateformat='{$dateformat}', fatherlist={$fatherlist}," .
			" listsons={$listsons}, listsortlen={$listsortlen}, listrows={$listrows}, listcontentchars={$listcontentchars}," .
			" keyword='{$keyword}', descrip='{$descrip}',hitsofhot={$hitsofhot} where fid={$fid}";
	$conn->query($sql);
	$action="ok";
}
if($action=="edit"){
	$fid=(int)$_GET['fid'];
	$sql="select * from {$pre}sort where fid={$fid}";
	$query=$conn->query($sql);
	if($conn->num_rows($query)!=1)die("<script LANGUAGE='javascript'>alert('����Ŀ�겻���ڣ�');history.go(-1);</script>");
	$fidconfig=$conn->fetch_array($query);
	if($fidconfig['disable'])$disable1="checked";
	else $disable0="checked";
	if($fidconfig['classmod']==2)$classmod2="selected";
	else $classmod1="selected";
	if($fidconfig['indexlist'])$indexlist1="checked";
	else $indexlist0="checked";
	if($fidconfig['fatherlist'])$fatherlist1="checked";
	else $fatherlist0="checked";
	if($fidconfig['listsons'])$listsons1="checked";
	else $listsons0="checked";

}

findsonsarray(0,$fidsarray,0,1);		//�ҳ����з���
$classoption="";		//�����б����롣�����������޸����ʱ�õ���
$disclass=65535;
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("����",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	if($fidconfig['fup']==$fidsarray[$i]['fid']){
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\" selected>{$fidsarray[$i]['name']}</option>\n";
	}else{
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\">{$fidsarray[$i]['name']}</option>\n";
	}
	//==============��������Щ��Ŀ�����ã���Ū���߼�
	if($fidsarray[$i]['disable']){
		$fidsarray[$i]['disable']="<span style=\"color:red\">����</span>";
		if($fidsarray[$i]['class']<$disclass)$disclass=$fidsarray[$i]['class'];
	}else{
		if($fidsarray[$i]['class']>$disclass){
			$fidsarray[$i]['disable']="<span style=\"color:red\">��������</span>";
		}else{
			$fidsarray[$i]['disable']="����";
			$disclass=65535;
		}
	}

}
//����Ϊģ�������б�����
$spenciloption="";
if($fidconfig['classmod']==0){
	$spenciloption.="<option value=\"0\" selected>&lt;�� ָ ��&gt;</option>";
}else{
	$spenciloption.="<option value=\"0\">&lt;�� ָ ��&gt;</option>";
}
$query=$conn->query("select name,id from {$pre}stencil");
while($row=$conn->fetch_array($query)){
	if($fidconfig['classmod']==$row['id']){
		$spenciloption.="<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
	}else{
		$spenciloption.="<option value=\"{$row['id']}\">{$row['name']}</option>";
	}
}
if($fidconfig['classmod']==-1){
	$spenciloption.="<option value=\"-1\" selected>&lt;�� Ӧ ��&gt;</option>";
}else{
	$spenciloption.="<option value=\"-1\">&lt;�� Ӧ ��&gt;</option>";
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
EOT;
if($action!="edit"){
echo <<<EOT
		<div class="title">�����µķ���</div>
		<form method="post" action="?action=add" name="addclass" onsubmit="return checkaddclassform();" style="margin:0">
		<div style="padding:10">
			�������ƣ�<img src="images/help_icon.gif" onClick="showhelp(1)">
					<input type="text" name="classname" id="classname" size="12"/>
			�������ࣺ<img src="images/help_icon.gif" onClick="showhelp(2)">
					<select name="fupclass" id="fupclass">
						<option value="0" selected>��Ϊ��������</option>
						{$classoption}
					</select>
			ģ�ͣ�<img src="images/help_icon.gif" onClick="showhelp(3)">
					<select name="classmod" id="classmod">
						{$spenciloption}
					</select>
			<input type="submit" value="����">
		</div>
		<div id="help1" class="help" style="display:none;">�������ƣ��������֣���ʾ�������߿��Կ��������֣����硡��˾���š���Ʒ���ġ��ۺ����ȡ�</div>
		<div id="help2" class="help" style="display:none;">�������ࣺ���ѡ�����ӵ�������ཫ��Ϊ��ѡ��ķ�������ࡣ</div>
		<div id="help3" class="help" style="display:none;">Ӧ��ģ�ͣ��ڷ�����Ϣʱ�������Զ��������ģ�ͣ����Ե�ģ�͹��������ӣ��޸�ģ�͡�<br/>��ָ�������Զ�����Ĭ��ģ�Ͳ�Ӧ�ã���û��Ĭ�ϵģ�����Ӧ��ģ��<br/>��Ӧ�ã���Ӧ���κ�ģ�ͣ��ʺ��������£�������Ŀ��</div>
		</form>

		<div style="padding:5;border-top:1px solid #888;margin-top:10px"></div>
		<div class="title">�༭����</div>
		<div style="padding:5px"></div>
		<div id="help4" class="help" style="display:none;">FID����Ŀ��Ψһ��ʶ�ţ�����ʱϵͳ����ģ����ܸ��ġ�</div>
		<div id="help5" class="help" style="display:none;">��Ŀ������Ŀ���ƣ���������ϵͳ��ʾ��</div>
		<div id="help6" class="help" style="display:none;">״̬����������ã�������ã���ɾ����ֻ�к�̨����ɿ������������Ŀ��������Ŀ�����ɲ鿴�����Խ�����ûָ��鿴�����ȷ����Ҫ����ɾ����������</div>
		<div id="help7" class="help" style="display:none;">����������ǰ̨�鿴���½�һ����������ͨ����ߵ���ݲ鿴����Ŀ��</div>
		<div id="help8" class="help" style="display:none;">���ݣ��༭�������Ŀ�����ݡ�</div>
		<div id="help9" class="help" style="display:none;">���������޸Ļ�ɾ�����޸Ľ���ʾ��ϸ���޸�ѡ�</div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>FID<img src="images/help_icon.gif" onClick="showhelp(4)"></th>
			<th width="460">��Ŀ��<img src="images/help_icon.gif" onClick="showhelp(5)"></th>
			<th>״̬<img src="images/help_icon.gif" onClick="showhelp(6)"></th>
			<th>���<img src="images/help_icon.gif" onClick="showhelp(7)"></th>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(8)"></th>
			<th>����<img src="images/help_icon.gif" onClick="showhelp(9)"></th>
		</tr>
EOT;
for($i=1;$i	<count($fidsarray);$i++){
echo <<<EOT
		<tr align="center">
			<td>{$fidsarray[$i]['fid']}</td>
			<td align="left">��{$fidsarray[$i]['name']}</td>
			<td>{$fidsarray[$i]['disable']}</td>
			<td><a href="../list.php?fid={$fidsarray[$i]['fid']}" target="_blank">ǰ̨�鿴</a></td>
			<td><a href="infomanage.php?fid={$fidsarray[$i]['fid']}">����</a></td>
			<td><a href="?action=edit&fid={$fidsarray[$i]['fid']}">�޸�</a>
				<a href="?action=del&fid={$fidsarray[$i]['fid']}" ONCLICK="javascript:return confirm('���Ҫɾ����ɾ���󽫲��ɻָ������齫�����ã�ɾ����ɾ����������������Ŀ��ȫ�����ݣ�');">ɾ��</a>
			</td>
		</tr>
EOT;
}
echo "		</table>";
}else{
echo <<<EOT
		<div class="title">��Ŀ�޸�</div>
		<form method="post" action="?action=editsave&fid={$fid}" name="editclass" onsubmit="return checkeditclassform();" style="margin:0">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td>�ϼ���Ŀ��<img src="images/help_icon.gif" onClick="showhelp(10)">
			<div id="help10" class="help" style="display:none;">�ϼ���Ŀ������Ŀ������{$fidconfig['name']}����Ϊ��������Ŀ�����ѡ����Ϊ������Ŀ���򲻴������κ���Ŀ��</div>
			</td>
			<td><select name="fupclass" id="fupclass">
					<option value="0">��Ϊ������Ŀ</option>
					{$classoption}
				</select>
			</td>
		</tr>
		<tr>
			<td>��Ŀ���ƣ�<img src="images/help_icon.gif" onClick="showhelp(11)">
			<div id="help11" class="help" style="display:none;">����(��Ŀ)���ƣ��������֣���ʾ�������߿��Կ��������֣����硡��˾���š���Ʒ���ġ��ۺ����ȡ�</div>
			</td>
			<td><input type="text" name="name" id="name" value="{$fidconfig['name']}" /></td>
		</tr>
		<tr>
			<td>�Ƿ���ñ���Ŀ��<img src="images/help_icon.gif" onClick="showhelp(12)">
			<div id="help12" class="help" style="display:none;">������ã���ɾ����ֻ�к�̨����ɿ������������Ŀ��������Ŀ�����ɲ鿴�����Խ�����ûָ��鿴��</div>
			</td>
			<td><input type="radio" name="disable" id="disable" value="0" {$disable0} style="border:0px;"/>������
				<input type="radio" name="disable" id="disable" value="1" {$disable1} style="border:0px;"/>����
			</td>
		</tr>
		<tr>
			<td>��Ŀģ�ͣ�<img src="images/help_icon.gif" onClick="showhelp(13)">
			<div id="help13" class="help" style="display:none;">��Ŀģ�飺�ڷ�����Ϣʱ�������Զ��������ģ�ͣ����Ե�ģ�͹��������ӣ��޸�ģ�͡�<br/>��ָ�������Զ�����Ĭ��ģ�Ͳ�Ӧ�ã���û��Ĭ�ϵģ�����Ӧ��ģ��<br/>��Ӧ�ã���Ӧ���κ�ģ�ͣ��ʺ��������£�������Ŀ��</div>
			</td>
			<td><select name="classmod" id="classmod">
					{$spenciloption}
				</select>
			</td>
		</tr>
		<tr>
			<td>�Ƿ�����ҳ��ʾ����Ŀ���ݣ�<img src="images/help_icon.gif" onClick="showhelp(14)">
			<div id="help14" class="help" style="display:none;">���ް���˵����</div>
			</td>
			<td><input type="radio" name="indexlist" id="indexlist" value="0" {$indexlist0} style="border:0px;"/>����ʾ
				<input type="radio" name="indexlist" id="indexlist" value="1" {$indexlist1} style="border:0px;"/>��ʾ
			</td>
		</tr>
		<tr>
			<td>������Ϣ�����ٵ������<img src="images/help_icon.gif" onClick="showhelp(15)">
			<div id="help15" class="help" style="display:none;">����Ϊ������Ϣ����Ҫ������Ĵ�����Ϊ 0 ������վ��վ�Ķ���Ϊ׼</div>
			</td>
			<td><input type="text" name="hitsofhot" id="hitsofhot" value="{$fidconfig['hitsofhot']}"></td>
		</tr>
		<tr>
			<td>�б�ҳ�������󳤶ȣ��ֽڣ���<img src="images/help_icon.gif" onClick="showhelp(16)">
			<div id="help16" class="help" style="display:none;">�б�ҳ�������󳤶ȣ��б�ҳһ����һ����ʾһ�����⣬�������̫���������ռ���е���������Կ����趨��ʾ�ĳ��ȣ��������趨����ʱ������������������ű�ʾ��<br/>һ�������������ֽ�</div>
			</td>
			<td><input type="text" name="listtitlechars" id="listtitlechars" value="{$fidconfig['listtitlechars']}" />��Ϊ����ʾ������</td>
		</tr>
		<tr>
			<td>�б�ҳʱ�����ʾ��ʽ��<img src="images/help_icon.gif" onClick="showhelp(17)">
			<div id="help17" class="help" style="display:none;">�б�ҳʱ�����ʾ��ʽ��ʱ����ʾ����ʽ����ѡ��Ϊ:<br/>�꣺��λ�������<br/>�£���λ�����·�<br/>�գ���λ��������<br/>ʱ����λ����Сʱ<br/>�֣���λ���ķ���<br/>�룺��λ������<br/>���ڣ����ĵ�������ʾ��������һ<br/>����ʾ������ʾʱ��<br/>�м���԰����ָ���������Ԫ�طֿ�������ò�Ҫ����Ӣ����ĸ</div>
			</td>
			<td><input type="text" name="dateformat" id="dateformat" value="{$fidconfig['dateformat']}" />�����Զ��Ԫ�����ʹ��</td>
		</tr>
		<tr>
			<td>�Ƿ�������Ŀ��ʾ����Ŀ���ݣ�<img src="images/help_icon.gif" onClick="showhelp(18)">
			<div id="help18" class="help" style="display:none;">����˵�����Ŀ�ĸ���Ŀ�ǡ���Ŀ�������û�����Ŀ��ʱ�Ƿ�������ʾ�����Ŀ�����ݡ�</div>
			</td>
			<td><input type="radio" name="fatherlist" id="fatherlist" value="0" {$fatherlist0} style="border:0px;"/>������
				<input type="radio" name="fatherlist" id="fatherlist" value="1" {$fatherlist1} style="border:0px;"/>����
			</td>
		</tr>
		<tr>
			<td>�Ƿ�������ʾ����Ŀ���ݣ�<img src="images/help_icon.gif" onClick="showhelp(19)">
			<div id="help19" class="help" style="display:none;">��鿴��һ����������������û����ͻ���Է��ȨΪ����</div>
			</td>
			<td><input type="radio" name="listsons" id="listsons" value="0" {$listsons0} style="border:0px;"/>������
				<input type="radio" name="listsons" id="listsons" value="1" {$listsons1} style="border:0px;"/>����
			</td>
		</tr>
		<tr>
			<td>����ʾ������Ŀ����Ŀ���Ƶĳ��ȣ�<img src="images/help_icon.gif" onClick="showhelp(20)">
			<div id="help20" class="help" style="display:none;">�����ʾ������Ŀ�����ݣ�Ϊ�����ָ�����Ŀ�е����£���ǰ����ʾ��Ŀ�������û������Ŀ��ʾ����������Ч��Ϊ����ʾ����ʲô���������ʾ��<br/>һ�������������ֽ�</div>
			</td>
			<td><input type="text" name="listsortlen" id="listsortlen" value="{$fidconfig['listsortlen']}" />��Ϊ����ʾ����ʾ</td>
		</tr>
		<tr>
			<td>�б�ҳÿҳ��ʾ�����У�<img src="images/help_icon.gif" onClick="showhelp(21)">
			<div id="help21" class="help" style="display:none;">ÿҳ��ʾ��������Ϊ����ʾĬ�ϡ�</div>
			</td>
			<td><input type="text" name="listrows" id="listrows" value="{$fidconfig['listrows']}" />��Ϊ����ʾĬ��</td>
		</tr>
		<tr>
			<td>�б�ҳÿƪ������ʾǰ����ٸ��ֽڣ�<img src="images/help_icon.gif" onClick="showhelp(22)">
			<div id="help22" class="help" style="display:none;">���б�ҳ��ʾ���ݵ�ǰһ���֣���������Ԥ��һ���Ĺ��ܡ�</div>
			</td>
			<td><input type="text" name="listcontentchars" id="listcontentchars" value="{$fidconfig['listcontentchars']}" />��Ϊ����ʾ����ʾ</td>
		</tr>
		<tr>
			<td>��Ŀ�ؼ��֣�<img src="images/help_icon.gif" onClick="showhelp(23)">
			<div id="help23" class="help" style="display:none;">Ϊ�վ���������վ�Ĺؼ��֣����鲻Ϊ�գ��������������йص����֡�</div>
			</td>
			<td><input type="text" name="keyword" id="keyword" value="{$fidconfig['keyword']}" size="70"/></td>
		</tr>
		<tr>
			<td>��Ŀ������<img src="images/help_icon.gif" onClick="showhelp(24)">
			<div id="help24" class="help" style="display:none;">��Ŀ��˵������ؼ���һ�����ʵ������û������վ�ڰٶȣ�GOOGLE�ȵ���Ҫ�ԡ�</div>
			</td>
			<td><input type="text" name="descrip" id="descrip" value="{$fidconfig['descrip']}" size="70" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="�ύ"/>��<input type="reset" value="����"></td>
		</tr>
		</table>
		</form>
EOT;
}
echo <<<EOT
	</div>
<script LANGUAGE='javascript'>
function showhelp(sid){
	if(sid < 4){
		for(temp=1;temp<4;temp++){
			if(temp!=sid)eval("help" + temp + ".style.display=\"none\";");
		}
	}
	if(sid > 3 && sid < 9){
		for(temp=4;temp<9;temp++){
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
function checkaddclassform(){
	if (document.addclass.classname.value==''){
		alert('����������������Ϊ�գ�');
		document.addclass.classname.focus();
		return false;
	}
	return true;
}
function checkeditclassform(){
	if (document.editclass.name.value==''){
		alert('��������Ŀ������Ϊ�գ�');
		document.editclass.name.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - ��̨����ϵͳ - ��վ������";
</script>
EOT;
require("foot.htm");
if($action=="ok")echo "<script LANGUAGE='javascript'>alert('���ݸ��³ɹ���');</script>";
?>

</body>
</html>
