<?php
/*
 * 文件创建于 2008-12-9 日 PHPeclipse - PHP - Code Templates
 */
date_default_timezone_set('Hongkong');
require("../inc/checkfun.php");
require("../inc/publicfun.php");
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
function TestWrite($d){
	$tfile = '_dedet.txt';
	$fp = @fopen($d.'/'.$tfile,'w');
	if(!$fp) return false;
	else{
		fclose($fp);
		$rs = @unlink($d.'/'.$tfile);
		if($rs) return true;
		else return false;
	}
}



if(file_exists('install.lock')) {
		echo '你已经安装过该系统，如果想重新安装，请先删除install目录的 install.lock 文件，然后再次运行该程序<br />警告：重新安装会把已有的数据清空，请慎重操作。如要保留以前数据，安装时可以将表的前辍改成其它。';
		exit;
}
define('WEBROOT', str_replace('\\','/',substr(dirname(__FILE__), 0, -8))) ;
$step=(int)$_GET['step'];
if($step<1||$step>4)$step=1;
if($step==1){
	include_once("./template/s1.htm");
	exit;
}elseif($step==2){
	$phpv = @phpversion();
	$path=WEBROOT;
	$maxtime=ini_get('max_execution_time');
	$allow_url_fopen = (ini_get('allow_url_fopen') ? '允许' : '不允许');
	$safemode = (ini_get('safe_mode') ? '<span style="color:red">[×]On</span>' : '<span style="color:green">[√]Off</span>');
	$gdver = @gdversion();
	$gdver = ($gdver>0 ? '<span style="color:green">[√]On</span>' : '<span style="color:red">[×]Off</span>');
	$ismysql = (function_exists('mysql_connect') ? '<span style="color:green">[√]On</span>' : '<span style="color:red">[×]Off</span>');
	if($ismysql=='<span style="color:red">[×]Off</span>') $sp_mysql_err = true;
	else $sp_mysql_err = false;
  $sp_testdirs = array(
        '/',
        '/inc',
        '/uploadfile',
        '/install'
  );
	include_once("./template/s2.htm");
	exit();
}elseif($step==3){
	if(!empty($_SERVER["REQUEST_URI"])){$scriptName = $_SERVER["REQUEST_URI"]; }
	else{ $scriptName = $_SERVER["PHP_SELF"]; }
	$scriptName=substr($scriptName,1);
	$cmspath = ereg_replace("install/index\.php(.*)$","",$scriptName);
	include_once("./template/s3.htm");
	exit();
}else{
	$dbhost=str_replace(" ","",no_special_char($_POST['dbhost']));
	$dbname=str_replace(" ","",no_special_char($_POST['dbname']));
	$dbuser=str_replace(" ","",no_special_char($_POST['dbuser']));
	$dbpw=str_replace(" ","",no_special_char($_POST['dbpwd']));
	$pre=str_replace(" ","",no_special_char($_POST['dbpre']));
	$dbcharset=str_replace(" ","",no_special_char($_POST['dblang']));

	$adminuser=$_POST['adminuser'];
	$adminpwd=$_POST['adminpwd'];

	$webname=str_replace(" ","",no_special_char($_POST['webname']));
	$adminmail=$_POST['adminmail'];
	$cmspath=str_replace(" ","",no_special_char($_POST['cmspath']));

	if(!checkusername($adminuser)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的管理员用户名 格式 错误！');history.go(-1);</script>");
	}
	if(!checkpassword($adminpwd)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的管理员密码 格式 错误！');history.go(-1);</script>");
	}
	if(!checkemail($adminmail)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的邮箱 格式 错误！');history.go(-1);</script>");
	}
	if($cmspath!=""){
		$pathlastchar=substr($cmspath,-1);
		if($pathlastchar!="/")$cmspath.="/";
	}


	if(!@mysql_connect($dbhost, $dbuser, $dbpw)) {
		die("<script LANGUAGE='javascript'>alert('数据库信息配置不正确，请返回修改');history.go(-1);</script>");
	}
	if($dbcharset){
		mysql_query("SET NAMES '$dbcharset'");
	}
	if( mysql_get_server_info() > '5.0' ){
		mysql_query("SET sql_mode=''");
	}
	if(!@mysql_select_db($dbname)){
		$creat_database = @mysql_query("CREATE DATABASE ".$dbname);
		if(!$creat_database){
			die("<script LANGUAGE='javascript'>alert('MYSQL 连接成功,但当前使用的数据库 {$dbname} 不存在,也无法被创建，请联系统空间供应商。');history.go(-1);</script>");
		}
	}


	$filecontent=read_file("../inc/conn.php");
	$filecontent=preg_replace("/([$]dbhost)[\s]*\=[^;]*/","\\1=\"$dbhost\"",$filecontent);
	$filecontent=preg_replace("/([$]dbuser)[\s]*\=[^;]*/","\\1=\"$dbuser\"",$filecontent);
	$filecontent=preg_replace("/([$]dbpw)[\s]*\=[^;]*/","\\1=\"$dbpw\"",$filecontent);

	$filecontent=preg_replace("/([$]dbname)[\s]*\=[^;]*/","\\1=\"$dbname\"",$filecontent);
	$filecontent=preg_replace("/([$]pre)[\s]*\=[^;]*/","\\1=\"$pre\"",$filecontent);
	$filecontent=preg_replace("/([$]dbcharset)[\s]*\=[^;]*/","\\1=\"$dbcharset\"",$filecontent);
	write_file("../inc/conn.php",$filecontent);
	//===========================================数据库配置文件写入成功。
	$filecontent=read_file("../inc/config.php");
	$filecontent=preg_replace("/(web\['name'\])[\s]*\=[^;]*/","\\1=\"$webname\"",$filecontent);
	$filecontent=preg_replace("/(web\['email'\])[\s]*\=[^;]*/","\\1=\"$adminmail\"",$filecontent);
	$filecontent=preg_replace("/(web\['dirname'\])[\s]*\=[^;]*/","\\1=\"$cmspath\"",$filecontent);
	write_file("../inc/config.php",$filecontent);
	//===========================================网站配置文件写入成功。
	include_once("../inc/conn.php");
	$conn->insert_file("setup.sql");
	//===========================================数据库更新成功。
	$adminpwd=md5($adminpwd);
	$conn->query("insert into {$pre}userdata (uname,password,adminlevel)VALUES ('{$adminuser}','{$adminpwd}',8)");
	//===========================================添加管理员数据。
	write_file("install.lock",date("Y-m-d H:i:s",time()));		//锁定安全文件，防止被再次安装。
	include_once("./template/s4.htm");
	exit();
}



?>
