<?php
/*
 * 文件创建于 2008-11-16 日 PHPeclipse - PHP - Code Templates
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
$allow_url_fopen = (ini_get('allow_url_fopen') ? '允许' : '不允许');
$safe_mode = (ini_get('safe_mode') ? '是' : '否');
$register_globals=(ini_get('register_globals')?'打开':'关闭');
$upload_max_filesize=ini_get('upload_max_filesize');
$filename=__FILE__;
//===================以下为模版
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
		<div class="title">服务器信息</div>
		<div style="padding:5px"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="6">
		<tr>
			<td width="18%">服务器域名：</td><td width="32%">{$_SERVER['HTTP_HOST']}</td>
			<td width="18%">服务器IP：</td><td>{$_SERVER["REMOTE_ADDR"]}</td>
		</tr>
		<tr>
			<td>服务器解译引擎：</td><td>{$_SERVER["SERVER_SOFTWARE"]}</td>
			<td>服务器操作系统：</td><td>{$_ENV['OS']}</td>
		</tr>
		<tr>
			<td>PHP版本:</td><td>{$phpv}</td>
			<td>网站物理路径：</td><td>{$webpath}</td>
		</tr>
		<tr>
			<td>脚本超时时间：</td><td>{$maxtime} 秒</td>
			<td>GD库版本：</td><td>{$gdv}</td>
		</tr>
		<tr>
			<td>打开远程文件：</td><td>{$allow_url_fopen}</td>
			<td>安全模式：</td><td>{$safe_mode}</td>
		</tr>
		<tr>
			<td>自动全局变量：</td><td>{$register_globals}</td>
			<td>最大上传限制：</td><td>{$upload_max_filesize}</td>
		</tr>
		<tr>
			<td>服务器端口：</td><td>{$_SERVER["SERVER_PORT"]}</td>
			<td>当前文件名：</td><td>{$filename}</td>
		</tr>
		</table>
		<div style="padding:10px;"></div>
		<div class="title">提醒事件</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="4">
		<tr>
			<td width="18%">待审核留言：</td><td></td>
		</tr>
		<tr>
			<td>未验证用户：</td><td></td>
		</tr>
		</table>
	</div>
EOT;

require("foot.htm");
?>
</body>
</html>