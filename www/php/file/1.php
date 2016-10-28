<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/25
 * Time: 11:04
 */
header("Content-type:text/html;charset=utf-8");
$fp = fopen('file.txt', 'a');
fwrite($fp,'IP：'. $_SERVER['REMOTE_ADDR']."  ");
fwrite($fp,'访问时间：'.date("Y-m-d H:i:s"));
fwrite($fp,"\r\n");
fclose($fp);
echo "<br>写入文件成功";