<?php
/*
 * �ļ������� 2008-11-16 �� PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
ini_set("register_globals",0);

function gdversion()
{
  static $gd_version_number = null;
  if ($gd_version_number === null)
  {
    ob_start();
    phpinfo(8);
    $module_info = ob_get_contents();
    ob_end_clean();
    if(preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", $module_info,$matches))
    {   $gdversion_h = $matches[1];  }
    else
    {  $gdversion_h = 0; }
  }
  return $gdversion_h;
}

$phpv = @phpversion();
$webpath=WEBROOT;
$maxtime=ini_get('max_execution_time');
$gdv=@gdversion();
$allow_url_fopen = (ini_get('allow_url_fopen') ? '����' : '������');
$safe_mode = (ini_get('safe_mode') ? '��' : '��');
$register_globals=(ini_get('register_globals')?'��':'�ر�');
$upload_max_filesize=ini_get('upload_max_filesize');
$filename=__FILE__;
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
		<div class="title">��������Ϣ</div>
		<div style="padding:5px"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="6">
		<tr>
			<td width="18%">������������</td><td width="32%">{$_SERVER['HTTP_HOST']}</td>
			<td width="18%">������IP��</td><td>{$_SERVER["REMOTE_ADDR"]}</td>
		</tr>
		<tr>
			<td>�������������棺</td><td>{$_SERVER["SERVER_SOFTWARE"]}</td>
			<td>����������ϵͳ��</td><td>{$_ENV['OS']}</td>
		</tr>
		<tr>
			<td>PHP�汾:</td><td>{$phpv}</td>
			<td>��վ����·����</td><td>{$webpath}</td>
		</tr>
		<tr>
			<td>�ű���ʱʱ�䣺</td><td>{$maxtime} ��</td>
			<td>GD��汾��</td><td>{$gdv}</td>
		</tr>
		<tr>
			<td>��Զ���ļ���</td><td>{$allow_url_fopen}</td>
			<td>��ȫģʽ��</td><td>{$safe_mode}</td>
		</tr>
		<tr>
			<td>�Զ�ȫ�ֱ�����</td><td>{$register_globals}</td>
			<td>����ϴ����ƣ�</td><td>{$upload_max_filesize}</td>
		</tr>
		<tr>
			<td>�������˿ڣ�</td><td>{$_SERVER["SERVER_PORT"]}</td>
			<td>��ǰ�ļ�����</td><td>{$filename}</td>
		</tr>
		</table>
		<div style="padding:10px;"></div>
		<div class="title">�����¼�</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="4">
		<tr>
			<td width="18%">��������ԣ�</td><td></td>
		</tr>
		<tr>
			<td>δ��֤�û���</td><td></td>
		</tr>
		</table>
	</div>
EOT;

require("foot.htm");
?>
</body>
</html>