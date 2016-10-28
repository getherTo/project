<?php
error_reporting(0);
require("adminhead.php");
?>
<html>
<head>
<title>宜云网络</title>
<meta name='keywords' content='后台文件上传'>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="images/css.css" />
</head>
<body>
<?php
$action=filtrate(trim($_POST['action']));
if(isoutlink())$action="";
if($action=="uploadfile"){
	$dir=no_special_char($_GET['dir']);
	mkuploaddir($dir);		//创建一个目录
	$formname=no_special_char($_GET['formname']);
	$editname=no_special_char($_GET['editname']);
	$upfileinfo=upfile("postfile","../uploadfile/{$dir}");
	if(!is_array($upfileinfo)){
		die("<CENTER>文件上传失败,{$upfileinfo}<a href=\"javascript:history.go(-1)\"> 点击返回</a></CENTER>");
	}else{
		$newfile="/".$web['dirname'].substr($upfileinfo['name'],3);
		echo "上传成功！请不要改动图片地址　　　<a href=\"?dir={$dir}&formname={$formname}&editname={$editname}\">重新上传</a>";
		echo "
			<script>
				if(self==top){
					window.opener.document.{$formname}.{$editname}.value='{$newfile}';
					window.self.close();
				}else{
					window.parent.document.{$formname}.{$editname}.value='{$newfile}';
				}
			</script>
			";
		exit;
	}
}
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
  <input  type="file" name="postfile" style="height:20px;" />
  <input  type="submit" name="Submit" value="上传文件" style="height:20px;" />
  <input type="hidden" name="action" value="uploadfile" />
</form>
</body>
</html>