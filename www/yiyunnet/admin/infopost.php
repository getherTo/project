<?php
/*
 * �ļ������� 2008-11-22 �� PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
include('../fckeditor/fckeditor.php') ;
$action=filtrate(trim($_GET['action']));
$fid=abs((int)$_GET['fid']);
if($fid>0){
	$sql="select * from {$pre}sort where fid={$fid}";
	$query=$conn->query($sql);
	$fidconfig=$conn->fetch_array($query);
	if($fidconfig['fid']!=$fid){
		$fid=0;$stencilarr="";
	}else{
		$stencil=$fidconfig['classmod'];
		if($stencil==-1){
			$stencilarr="";
		}elseif($stencil==0){
			$sql="select * from {$pre}stencil where isdefault=1";
			$query=$conn->query($sql);
			$row=$conn->fetch_array($query);
			if($row['property']==""){
				$stencilarr="";
			}else{
				$stencilarr=explode(" ",$row['property']);
				$stencilname=$row['name'];
			}
		}else{
			$sql="select * from {$pre}stencil where id={$fidconfig['classmod']}";
			$query=$conn->query($sql);
			$row=$conn->fetch_array($query);
			if($row['property']==""){
				$stencilarr="";
			}else{
				$stencilarr=explode(" ",$row['property']);
				$stencilname=$row['name'];
			}
		}
	}
}
if($action=="add1"&&$fid>0){
	$titlename=trim(filtrate(mysubstr($_POST['titlename'],0,100)));
	$picurl=mysubstr(no_special_char($_POST['picurl']),0,500);
	$d_picture=mysubstr(no_special_char($_POST['d_picture']),0,100);
	$keywords=mysubstr(no_special_char($_POST['keywords']),0,255);
	$yz=abs((int)$_POST['yz']);
	$vouch=abs((int)$_POST['vouch']);
	$openblank=abs((int)$_POST['openblank']);
	$content=tosafehtml($_POST['myeditor'],1);
	$pronum=abs((int)$_POST['pronum']);
	for($i=0;$i<$pronum;$i++){
		$property[$i]=str_replace(" ","",mysubstr(no_special_char($_POST["property$i"]),0,20));
		if($property[$i]!=""){
			$projoin.=" ".$property[$i];
			$contentpre.=" ".str_replace(" ","",mysubstr(no_special_char($_POST["provalue$i"]),0,20));
		}
	}
	$projoin=trim($projoin);
	$contentpre=trim($contentpre);
	if($titlename==""||$content==""){
		die("<script LANGUAGE='javascript'>alert('���󣬱��������Ϊ�գ�');history.go(-1);</script>");
	}
	$content=$contentpre."&nbsp;".$content;
	$sql="insert into {$pre}article (fid,title,picurl,titlepic,keywords,yz,vouch,openblank,uid,posttime) " .
			"VALUES({$fid},'{$titlename}','{$picurl}'," .
			"'{$d_picture}','{$keywords}',{$yz},{$vouch},{$openblank},{$adminuid},{$web['today']})";
	$conn->query($sql);
	$aid=$conn->insert_id();
	$sql="insert into {$pre}reply (aid,fid,topic,property,content,uid) " .
			"VALUES({$aid},{$fid},1,'{$projoin}','{$content}',{$adminuid})";
	$conn->query($sql);
}
if($action=="add2"&&$fid>0){
	$titlename=filtrate(mysubstr($_POST['titlename'],0,100));
	$titlecolor=$_POST['titlecolor'];
	$author=mysubstr(no_special_char($_POST['author']),0,20);
	$copyfrom=mysubstr(no_special_char($_POST['copyfrom']),0,20);
	$copyfromurl=$_POST['copyfromurl'];
	$picurl=mysubstr(no_special_char($_POST['picurl']),0,500);
	$d_picture=mysubstr(no_special_char($_POST['d_picture']),0,100);
	$keywords=mysubstr(no_special_char($_POST['keywords']),0,255);
	$yz=abs((int)$_POST['yz']);
	$vouch=abs((int)$_POST['vouch']);
	$openblank=abs((int)$_POST['openblank']);
	$content=tosafehtml($_POST['myeditor'],1);
	$titlename=trim($titlename);
	if(!preg_match("/\A#[\da-fA-F]{6}\Z/",$titlecolor))$titlecolor="";
	if(!checkurl($copyfromurl))$copyfromurl="";
	if($titlename==""||$content==""){
		die("<script LANGUAGE='javascript'>alert('���󣬱��������Ϊ�գ�');history.go(-1);</script>");
	}
	$sql="insert into {$pre}article (fid,title,titlecolor,author,copyfrom,copyfromurl,picurl,titlepic,keywords,yz,vouch,openblank,uid,posttime) " .
			"VALUES({$fid},'{$titlename}','{$titlecolor}','{$author}','{$copyfrom}','{$copyfromurl}','{$picurl}'," .
			"'{$d_picture}','{$keywords}',{$yz},{$vouch},{$openblank},{$adminuid},{$web['today']})";
	$conn->query($sql);
	$aid=$conn->insert_id();
	$sql="insert into {$pre}reply (aid,fid,topic,content,uid) " .
			"VALUES({$aid},{$fid},1,'{$content}',{$adminuid})";
	$conn->query($sql);
}

findsonsarray(0,$fidsarray,0,1);		//�ҳ����з���
$disclass=65535;
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("����",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
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
	$sql="select aid from {$pre}article where fid={$fidsarray[$i]['fid']}";
	$query=$conn->query($sql);
	$fidsarray[$i]['infos']=$conn->num_rows($query);
}
//==========================================================�༭��ʵ����
$oFCKeditor = new FCKeditor('myeditor') ;
$oFCKeditor->BasePath	="../fckeditor/";
$oFCKeditor->ToolbarSet="Yiyunnet";
$oFCKeditor->Height='350px';
$oFCKeditor->Width='630px';
$oFCKeditor->Value="";
$myeditor=$oFCKeditor->CreateHtml();
//====================================================================����Ϊģ��
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
if($fid==0){
echo <<<EOT
		<div class="title">��ѡ����Ŀ</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<th>FID</th>
			<th width="400">��Ŀ��</th>
			<th>������</th>
			<th>������������</th>
			<th>��������</th>
			<th>״̬</th>
		</tr>
EOT;
for($i=1;$i	<count($fidsarray);$i++){
echo <<<EOT
		<tr align="center">
			<td>{$fidsarray[$i]['fid']}</td>
			<td align="left">��{$fidsarray[$i]['name']}</td>
			<td><a href="?fid={$fidsarray[$i]['fid']}">����</a></td>
			<td><a href="infomanage.php?fid={$fidsarray[$i]['fid']}">����</a></td>
			<td>{$fidsarray[$i]['infos']} ��</td>
			<td>{$fidsarray[$i]['disable']}</td>
		</tr>
EOT;
}
echo "		</table>";
}
if(($action=="add2"||$action=="add1")&&$fid>0){
echo <<<EOT
		<div style="padding:100;">
			���������ɣ���ѡ����Ӧ�Ĳ�����<br />
			<a href="infopost.php?fid={$fid}">������ӱ���Ŀ����</a><br />
			<a href="infopost.php">������Ŀ�б�</a><br />
			<a href="bencandy.php?id={$aid}">ǰ̨�鿴</a>
		</div>
EOT;
}elseif($fid!=0){
if(is_array($stencilarr)){			//��ģ�����ʱ��Ӧ��ģ�棬ʡȥ���µ�һЩ���
echo <<<EOT
		<div class="title">����������</div>
		<div style="padding:5px;"></div>
		<form method="post" name="info" action="?action=add1&fid={$fid}" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<td width="120">��Ŀ����</td>
			<td>{$fidconfig['name']}������ģ������{$stencilname}</td>
		</tr>
		<tr>
			<td>����(��Ʒ��)��</td>
			<td><input type="text" name="titlename" id="titlename" size="50"/></td>
		</tr>
EOT;
for($i=0;$i<count($stencilarr);$i++){
echo <<<EOT
		<tr>
			<td><input type="text" name="property{$i}" id="property{$i}" value="{$stencilarr[$i]}" size="14" /></td>
			<td><input type="text" name="provalue{$i}" name="provalue{$i}"></td>
		</tr>
EOT;
}
echo <<<EOT
		<tr>
			<td>ͼƬ��<input type="hidden" name="pronum" id="pronum" value="{$i}" /></td>
			<td><input type="hidden" name="picurl" id="picurl">
				<select name="d_picture" size="1" onChange="showpreview()"/>
					<option value=''>========�ޱ���ͼƬ========</option>
				</select>
				<input type="button" onclick="doChange(document.info.picurl,document.info.d_picture);" value="����ͼƬ" style="height:20px;width: 60px;" />��&nbsp;
				<input type="button" onclick="insertimage(document.info.d_picture.value)" value="��ͼƬ���뵽��ǰ������" style="height:20px;width:160px;" />
				<br />
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfile.php?dir={$fid}&formname=info&editname=picurl" width='500'></iframe>
				<div id="previewdiv" style="display:none;border:1px solid #aaa;position:absolute;top:10px;left:580px;background-color:#fff;width:160;">
					ͼƬԤ��<br />
					<img src="images/blank.jpg" name="previewimg" id="previewimg" width="160" height="160">
				</div>
			</td>
		</tr>
		<tr>
			<td>�ؼ��֣�</td>
			<td><input type="text" name="keywords" id="keywords" size="50"/></td>
		</tr>
		<tr>
			<td>���ã�</td>
			<td>
				<input type="checkbox" name="yz" id="yz" value="1" checked style="border:0px;">��ˡ�
				<input type="checkbox" name="vouch" id="vouch" value="1" style="border:0px;">�Ƽ���
				<input type="checkbox" name="openblank" id="openblank" value="1" style="border:0px;">�´��ڴ�
			</td>
		</tr>
		<tr>
			<td>���ݣ�</td>
			<td>
				{$myeditor}
			</td>
		</tr>
		</table>
		<div style="text-align:center"><input type="submit" value="�ύ"/>
			&nbsp;������<input type="reset" value="����"/>
		</div>
		</form>
EOT;
}else{
echo <<<EOT
		<div class="title">����������</div>
		<div style="padding:5px;"></div>
		<form method="post" name="info" action="?action=add2&fid={$fid}" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="cccccc" cellspacing="0" cellpadding="2">
		<tr>
			<td width="120">��Ŀ����</td>
			<td>{$fidconfig['name']}</td>
		</tr>
		<tr>
			<td>���⣺</td>
			<td><input type="text" name="titlename" id="titlename" size="50"/></td>
		</tr>
		<tr>
			<td>������ɫ��</td>
			<td><input type="text" name="titlecolor" size="7" value="" id="titlecolor" onclick="foreColor_font();"/>��������ѡ����ɫ</td>
		</tr>
		<tr>
			<td>���ߣ�</td>
			<td><input type="text" name="author" id="author"/></td>
		</tr>
		<tr>
			<td>��Դ��</td>
			<td><input type="text" name="copyfrom" id="copyfrom"/></td>
		</tr>
		<tr>
			<td>��Դ��ַ��</td>
			<td><input type="text" name="copyfromurl" id="copyfromurl"/></td>
		</tr>
		<tr>
			<td>����ͼƬ��</td>
			<td><input type="hidden" name="picurl" id="picurl">
				<select name="d_picture" size="1" onChange="showpreview()"/>
					<option value=''>========�ޱ���ͼƬ========</option>
				</select>
				<input type="button" onclick="doChange(document.info.picurl,document.info.d_picture);" value="����ͼƬ" style="height:20px;width: 60px;" />��&nbsp;
				<input type="button" onclick="insertimage(document.info.d_picture.value)" value="��ͼƬ���뵽��ǰ������" style="height:20px;width:160px;" />
				<br />
				<iframe name="mainFrame2" frameborder="0" height="30" scrolling="no" src="upfile.php?dir={$fid}&formname=info&editname=picurl" width='500'></iframe>
				<div id="previewdiv" style="display:none;border:1px solid #aaa;position:absolute;top:10px;left:580px;background-color:#fff;width:160;">
					����ͼƬԤ��<br />
					<img src="images/blank.jpg" name="previewimg" id="previewimg" width="160" height="160">
				</div>
			</td>
		</tr>
		<tr>
			<td>�ؼ��֣�</td>
			<td><input type="text" name="keywords" id="keywords" size="50"/></td>
		</tr>
		<tr>
			<td>���ã�</td>
			<td>
				<input type="checkbox" name="yz" id="yz" value="1" checked style="border:0px;">��ˡ�
				<input type="checkbox" name="vouch" id="vouch" value="1" style="border:0px;">�Ƽ���
				<input type="checkbox" name="openblank" id="openblank" value="1" style="border:0px;">�´��ڴ�
			</td>
		</tr>
		<tr>
			<td>���ݣ�</td>
			<td>
				{$myeditor}
			</td>
		</tr>
		</table>
		<div style="text-align:center"><input type="submit" value="�ύ"/>
			&nbsp;������<input type="reset" value="����"/>
		</div>
		</form>
EOT;
}
echo <<<EOT
		<img src="images/help_icon.gif" onClick="showhelp(1)">
		<div id="help1" class="help" style="display:none;">����(��Ʒ��)�����µı�����Ʒ�����ƣ���������˲�Ʒģ�棬ϵͳ���Զ�ʶ���Բ�Ʒ�ķ�ʽ��ʾ��<br />
			������ɫ�����ѡ����ɫ������ѡ������ɫ��ʾ���û���<br />
			����ͼƬ�����µı���ͼƬ���������������ݵ���Ҫλ�ã������ϴ�ͼƬ���ϴ�ͼƬ����Զ����浽ͼƬѡ����У��ɹ�ѡ�����������Ҫ�ϴ�ͼƬ�����ȵ�����ͼƬ�����ϴ���ѡ������&ldquo;��ͼƬ���뵽��ǰ������&rdquo;�Ϳ��԰�ͼƬ�ӵ������У�û��ûӦ�ò�Ʒģ�ͣ�����ͼƬ����ʾ����ʱ������ʾ��<br />
			������ͼƬ�༭����ѡ��ͼƬ���ٵ��ͼƬ�༭��Ť��Դ�ļ���ͼƬ�ĵ�ַ���滻���֣�ͼƬ��û������ʱ�����ŵ�ͼƬ��ʱ��ʾ�����֣�URL�����ͼƬ�򿪵�ҳ�档<br />
			�ؼ��֣����Զ���ؼ��֣���Ӣ�Ŀո������<br />
			�༭�����÷�������WORDһ����ϵͳ���õĹ�����λ��Ҳ�����ĺ�WORDһ�����������������֡�
		</div>
EOT;
}
echo <<<EOT
	</div>

<script LANGUAGE='javascript'>
//��ʾ��������
function showhelp(sid){
	whichEl = eval("help" + sid);
	if (whichEl.style.display == "none"){
		eval("help" + sid + ".style.display=\"\";");
	}else{
		eval("help" + sid + ".style.display=\"none\";");
	}
}
//�ύ��麯��
function checkform(){
	if (document.info.titlename.value==''){
		alert('���������ⲻ��Ϊ�գ�');
		document.info.titlename.focus();
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
//ѡ����ɫ����
function foreColor_font()
{
	var arr = showModalDialog('images/selcolor.htm', '', 'dialogWidth:18.5em; dialogHeight:17.5em; status:0');
	if (arr != null)  document.info.titlecolor.value=arr;
	else  document.info.titlecolor.focus();
	document.info.titlecolor.style.color=arr;
}
// ���ϴ�ͼƬ���ļ�ʱ����������������ͼƬ·�����ɸ���ʵ����Ҫ���Ĵ˺���
function doChange(objText, objDrop){
	if (!objDrop) return;
	var str = objText.value;
	if(str==""){
		alert("����û���ϴ�ͼƬ�����ϴ�����");
	}
	var arr = str.split("|");
	var nIndex = objDrop.selectedIndex;
	objDrop.length=1;
	for (var i=0; i<arr.length-1; i++){
		objDrop.options[objDrop.length] = new Option(arr[i], arr[i]);
	}
	objDrop.selectedIndex = nIndex;
}
//���༭���м���ͼƬ
function insertimage(imageurl){
	var oEditor = FCKeditorAPI.GetInstance('myeditor');
	if ( oEditor.EditMode == FCK_EDITMODE_WYSIWYG ){
		if(imageurl==""){
			alert( '��û��ѡ��ͼƬ������ȡ��!' ) ;
		}else{
			oEditor.InsertHtml( '<img src="'+imageurl+'" />' ) ;
		}
	}else{
		alert( '���л�������������ģʽ�²������!' ) ;
	}
}
//����ͼƬԤ��
function showpreview(){
	url=document.info.d_picture.options[document.info.d_picture.selectedIndex].value;
	if(url==""){
		eval("previewdiv.style.display=\"none\";");
	}else{
		document.images.previewimg.src=url;
		eval("previewdiv.style.display=\"\";");
	}
}

top.document.title="{$web['name']} - ��̨����ϵͳ - ���������";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>