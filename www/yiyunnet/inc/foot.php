<?php
/*
 * 文件创建于 2008-11-4 日 PHPeclipse - PHP - Code Templates
 */


if(!defined("WEBROOT"))define('WEBROOT', substr(dirname(__FILE__), 0, -4).'\\');
$time=explode(' ',microtime());
$web['endtime']=$time[0]+$time[1];
$web['time']=round($web['endtime']-$web['starttime'],3);

require(WEBROOT."/template/foot.htm");
?>
