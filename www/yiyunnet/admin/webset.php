<?php
/*
 * �ļ������� 2008-11-17 �� PHPeclipse - PHP - Code Templates
 * �Դ��ļ��������ȱ��ݺ�../inc/config.php�ļ�������������غ����
 */


require("adminhead.php");
require(WEBROOT."images/style.php");
$action=filtrate(trim($_GET['action']));
if($action=="save"){
	if($adminlevel<8)die("<script LANGUAGE='javascript'>alert('��������Ȩ������վ���ã�');history.go(-1);</script>");
	$webname=no_special_char($_POST['webname']);
	$styledir=no_special_char($_POST['styledir']);

	$logo=no_special_char($_POST['logo']);
	$dirname=no_special_char($_POST['dirname']);
	$keywords=no_special_char($_POST['keywords']);

	$description=no_special_char($_POST['description']);
	$webmaster=no_special_char($_POST['webmaster']);
	$email=no_special_char($_POST['email']);

	$close=(int)$_POST['close'];
	$whyclose=no_special_char($_POST['whyclose']);
	$linkreg=(int)$_POST['linkreg'];

	$listdate=no_special_char($_POST['listdate']);
	$classlever=(int)$_POST['classlever'];
	$hitsofhot=(int)$_POST['hitsofhot'];

	$enableuserreg=(int)$_POST['enableuserreg'];
	$beian=no_special_char($_POST['beian']);
	$copyright=stripslashes($_POST['copyright']);		//ȥ����б��
	$copyright=tosafehtml($copyright,1);					//ȥ��Σ�յĽű����Է�����Ա����������վ����ȫ��
	$copyright=addslashes($copyright);					//���Ϸ�б��
	$copyright=str_replace(";","��",$copyright);

	$filecontent=read_file("../inc/config.php");
	$filecontent=preg_replace("/(web\['name'\])[\s]*\=[^;]*/","\\1=\"$webname\"",$filecontent);
	$filecontent=preg_replace("/(web\['styledir'\])[\s]*\=[^;]*/","\\1=\"$styledir\"",$filecontent);

	$filecontent=preg_replace("/(web\['logo'\])[\s]*\=[^;]*/","\\1=\"$logo\"",$filecontent);
	$filecontent=preg_replace("/(web\['dirname'\])[\s]*\=[^;]*/","\\1=\"$dirname\"",$filecontent);
	$filecontent=preg_replace("/(web\['keywords'\])[\s]*\=[^;]*/","\\1=\"$keywords\"",$filecontent);

	$filecontent=preg_replace("/(web\['description'\])[\s]*\=[^;]*/","\\1=\"$description\"",$filecontent);
	$filecontent=preg_replace("/(web\['webmaster'\])[\s]*\=[^;]*/","\\1=\"$webmaster\"",$filecontent);
	$filecontent=preg_replace("/(web\['email'\])[\s]*\=[^;]*/","\\1=\"$email\"",$filecontent);

	$filecontent=preg_replace("/(web\['close'\])[\s]*\=[^;]*/","\\1=$close",$filecontent);		//���֣���������
	$filecontent=preg_replace("/(web\['whyclose'\])[\s]*\=[^;]*/","\\1=\"$whyclose\"",$filecontent);
	$filecontent=preg_replace("/(web\['linkreg'\])[\s]*\=[^;]*/","\\1=$linkreg",$filecontent);

	$filecontent=preg_replace("/(web\['listdate'\])[\s]*\=[^;]*/","\\1=\"$listdate\"",$filecontent);
	$filecontent=preg_replace("/(web\['classlever'\])[\s]*\=[^;]*/","\\1=$classlever",$filecontent);
	$filecontent=preg_replace("/(web\['hitsofhot'\])[\s]*\=[^;]*/","\\1=$hitsofhot",$filecontent);

	$filecontent=preg_replace("/(web\['enableuserreg'\])[\s]*\=[^;]*/","\\1=$enableuserreg",$filecontent);
	$filecontent=preg_replace("/(web\['beian'\])[\s]*\=[^;]*/","\\1=\"$beian\"",$filecontent);
	$filecontent=preg_replace("/(web\['copyright'\])[\s]*\=[^;]*/","\\1=\"$copyright\"",$filecontent);
	write_file("../inc/config.php",$filecontent);
	header("location:webset.php?action=ok");
	die();
}

$styleoption="";
for($i=0;$i<count($stylearr);$i++){
	if($web['styledir']==$stylearr[$i]['dir']){
		$styleoption.="<option value=\"{$stylearr[$i]['dir']}\" selected>{$stylearr[$i]['name']}</option>\n";
	}else{
		$styleoption.="<option value=\"{$stylearr[$i]['dir']}\">{$stylearr[$i]['name']}</option>\n";
	}
}
$webopend="";$webclosed="";
if($web['close']==0){
	$webopend="checked";
}else{
	$webclosed="checked";
}
$enablereged="";$disablereged="";
if($web['enableuserreg']){
	$enablereged="checked";
}else{
	$disablereged="checked";
}
if($web['linkreg']==0){
	$linkreg0="checked";
}else{
	$linkreg1="checked";
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
		<div class="title">��վ��������</div>
		<div style="padding:5px;"></div>
<form method="post" action="?action=save" name="webset" style="margin:0px;">
		<table cellpadding="5" border="1" bordercolor="cccccc" width="100%">
		<tr>
			<td width="200">��վ���ƣ�<img src="images/help_icon.gif" onClick="showhelp(0)"></td>
			<td><input type="text" name="webname" id="webname" value="{$web['name']}"/>
			<div id="help0" class="help" style="display:none;">�����վ�����֣����������������ʾ�����֣����Ͻǣ�</div>
			</td>
		</tr>
		<tr>
			<td>��վĬ�Ϸ��<img src="images/help_icon.gif" onClick="showhelp(1)"></td>
			<td><select name="styledir" id="styledir">{$styleoption}</select>
			<div id="help1" class="help" style="display:none;">��վĬ�ϵ���ʾ��ʽ���û�Ҳ�����Լ�ѡ�񣬵�����ߵ�һ�������վʱ����Ӧ��������ʽ��ֱ���Լ�����ѡ�����������ʱ����������Լ�ѡ���ķ��������</div>
			</td>
		</tr>
		<tr>
			<td>��վͷ��LOGO��ַ��<img src="images/help_icon.gif" onClick="showhelp(2)"></td>
			<td><input type="text" name="logo" id="logo" value="{$web['logo']}"/>��һ�㲻�ø�
			<div id="help2" class="help" style="display:none;">��վ�ı��ͼƬ��һ����ҳ������Ͻǵ�ͼƬ</div>
			</td>
		</tr>
		<tr>
			<td>��վĿ¼��<img src="images/help_icon.gif" onClick="showhelp(3)"></td>
			<td><input type="text" name="dirname" id="dirname" value="{$web['dirname']}"/>��һ�㲻�ø�
			<div id="help3" class="help" style="display:none;">�����վ�İ�װ��Ŀ¼����������վ���ʵ�ַΪhttp://www.wangzhi.com/mulu/�Ļ�������дmulu/�������д����ȷ�����в��ֹ���ʹ�ò�������	�������ǵú���Ҫ�ӡ�"/"</div>
			</td>
		</tr>
		<tr>
			<td>��վ�ȵ�ؼ��ʣ�<img src="images/help_icon.gif" onClick="showhelp(4)"></td>
			<td><input type="text" name="keywords" id="keywords" value="{$web['keywords']}" size="60"/>
			<div id="help4" class="help" style="display:none;">�����վ�Ĺؼ��ʣ�����ٶȣ�GOOGLE�ȵ���¼��</div>
			</td>
		</tr>
		<tr>
			<td>��վ������<img src="images/help_icon.gif" onClick="showhelp(5)"></td>
			<td><input type="text" name="description" id="description" value="{$web['description']}" size="60"/>
			<div id="help5" class="help" style="display:none;">��վ���ݵ��������������ٶȣ�GOOGLE�ȵ���¼��</div>
			</td>
		</tr>
		<tr>
			<td>��վ������������<img src="images/help_icon.gif" onClick="showhelp(6)"></td>
			<td><input type="text" name="webmaster" id="webmaster" value="{$web['webmaster']}"/>
			<div id="help6" class="help" style="display:none;">������������ƺ�������ͻ���ϵ</div>
			</td>
		</tr>
		<tr>
			<td>����Ա���䣺<img src="images/help_icon.gif" onClick="showhelp(7)"></td>
			<td><input type="text" name="email" id="email" value="{$web['email']}"/>
			<div id="help7" class="help" style="display:none;">����Ա���䣬����д��ȷ�����䡣</div>
			</td>
		</tr>
		<tr>
			<td>��վ�򿪻��ǹرգ�<img src="images/help_icon.gif" onClick="showhelp(8)"></td>
			<td><input type="radio" name="close" id="close" value="0" {$webopend} style="border:none"/>��
				<input type="radio" name="close" id="close" value="1" {$webclosed} style="border:none"/>�ر�
			<div id="help8" class="help" style="display:none;">����ر���վ���û�����վʱ������ʾ���������</div>
			</td>
		</tr>
		<tr>
			<td>��վ�ر�ԭ��<img src="images/help_icon.gif" onClick="showhelp(9)"></td>
			<td><input type="text" name="whyclose" id="whyclose" value="{$web['whyclose']}" size="50"/>
			<div id="help9" class="help" style="display:none;">��վ�رյ�ԭ��û�ر���վ����Ϣ��Ч</div>
			</td>
		</tr>
		<tr>
			<td>�Ƿ������û������������ӣ�<img src="images/help_icon.gif" onClick="showhelp(10)"></td>
			<td><input type="radio" name="linkreg" id="linkreg" value="0" {$linkreg0} style="border:none"/>������
				<input type="radio" name="linkreg" id="linkreg" value="1" {$linkreg1} style="border:none"/>����
			<div id="help10" class="help" style="display:none;">�������ӣ��������Լ�����վ�Ϸ��öԷ���վ�����ӣ��������ͻ����ʶԷ���վʱҲ�п���ͨ��������ӷ��ʵ��Լ�����վ��</div>
			</td>
		</tr>
		<tr>
			<td>�б�ҳʱ����ʾ��ʽ��<img src="images/help_icon.gif" onClick="showhelp(11)"></td>
			<td><input type="text" name="listdate" id="listdate" value="{$web['listdate']}"/>
			<div id="help11" class="help" style="display:none;">����ʾ�嵥ʱ��ʱ����ʾ�ĸ�ʽ������Ϊ���ꡡ�¡��ա�ʱ���֡��롡���������ֵ���ϣ����������롡����ʾ�����ر�ʱ�����ʾ�����Ǳ����Ա��������ò�Ҫ��Ӣ����ĸ��</div>
			</td>
		</tr>
		<tr>
			<td>�������������<img src="images/help_icon.gif" onClick="showhelp(12)"></td>
			<td><input type="text" name="classlever" id="classlever" value="{$web['classlever']}"/>
			<div id="help12" class="help" style="display:none;">��ϵͳ֧�����޼���ķ��࣬��һ����಻�����5�㣬���鲻Ҫ�������������̫��</div>
			</td>
		</tr>
		<tr>
			<td>������Ϣ�����ٵ������<img src="images/help_icon.gif" onClick="showhelp(13)"></td>
			<td><input type="text" name="hitsofhot" id="hitsofhot" value="{$web['hitsofhot']}"/>
			<div id="help13" class="help" style="display:none;">���ٱ�������ٴε���ϢΪ������Ϣ����������������ã�����ط�������Ϊ��</div>
			</td>
		</tr>
		<tr>
			<td>�Ƿ��������û�ע�᣺<img src="images/help_icon.gif" onClick="showhelp(14)"></td>
			<td><input type="radio" name="enableuserreg" id="enableuserreg" value="1" {$enablereged} style="border:none"/>����
				<input type="radio" name="enableuserreg" id="enableuserreg" value="0" {$disablereged} style="border:none"/>������
			<div id="help14" class="help" style="display:none;">���ѡ���������ر��û�ע�Ṧ��</div>
			</td>
		</tr>
		<tr>
			<td>��վ������ţ�<img src="images/help_icon.gif" onClick="showhelp(15)"></td>
			<td><input type="text" name="beian" id="beian" value="{$web['beian']}"/>
			<div id="help15" class="help" style="display:none;">��վ���Ų����ı�����</div>
			</td>
		</tr>
		<tr>
			<td>��վ�ײ���Ȩ��Ϣ��<img src="images/help_icon.gif" onClick="showhelp(16)"></td>
			<td><textarea name="copyright" id="copyright" cols="70" rows="6">{$web['copyright']}</textarea>
			<div id="help16" class="help" style="display:none;">��ʾҪ��ҳ��ײ�����Ϣ��֧�֡�HTML����ʽ���粻��д��HTML�����룬���Ե���ҳ�༭���б༭�ã����л���������ͼ�������븴�ƹ������й���ҳ�༭����ʹ�ã��������ؽ̡̳�</div>
			</td>
		</tr>
		</table>
		<div style="padding:10;text-align:center;">
			<input type="submit" value="�ύ">����<input type="reset" value="����">
		</div>
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
top.document.title="{$web['name']} - ��̨����ϵͳ - ��վ��������";
</script>
EOT;
if($action=="ok"){
	echo "<script LANGUAGE='javascript'>alert('���ݱ���ɹ���');</script>";
}
require("foot.htm");
?>
</body>
</html>
