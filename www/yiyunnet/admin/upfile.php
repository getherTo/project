<?php
error_reporting(0);
require("adminhead.php");
?>
<html>
<head>
<title>��������</title>
<meta name='keywords' content='��̨�ļ��ϴ�'>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="images/css.css" />
</head>
<body>
<?php
$action=filtrate(trim($_POST['action']));
if(isoutlink())$action="";
if($action=="uploadfile"){
	$dir=no_special_char($_GET['dir']);
	mkuploaddir($dir);		//����һ��Ŀ¼
	$formname=no_special_char($_GET['formname']);
	$editname=no_special_char($_GET['editname']);
	$upfileinfo=upfile("postfile","../uploadfile/{$dir}");
	if(!is_array($upfileinfo)){
		die("<CENTER>�ļ��ϴ�ʧ��,{$upfileinfo}<a href=\"javascript:history.go(-1)\"> �������</a></CENTER>");
	}else{
		$newfile="/".$web['dirname'].substr($upfileinfo['name'],3);
		echo "�ϴ��ɹ������������ͼƬ�����������б�򡡡���<a href=\"?dir={$dir}&formname={$formname}&editname={$editname}\">�����ϴ�</a>";
		echo "
			<script>
				if(self==top){
					window.opener.document.{$formname}.{$editname}.value=window.opener.document.{$formname}.{$editname}.value+'{$newfile}|';
					window.self.close();
				}else{
					window.parent.document.{$formname}.{$editname}.value=window.parent.document.{$formname}.{$editname}.value+'{$newfile}|';
				}
			</script>
			";
		exit;
	}
}
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
  <input  type="file" name="postfile" style="height:20px;" />
  <input  type="submit" name="Submit" value="�ϴ��ļ�" style="height:20px;" />
  <input type="hidden" name="action" value="uploadfile" />
</form>
</body>
</html>