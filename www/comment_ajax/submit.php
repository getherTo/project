<?php
/**
 * 处理表单提交数据
 *
 */

include_once 'db.php';
include_once 'function.php';

$txt =  $_POST['saytxt'] ;
$user_name =  $_POST['user_name'] ;
if(!$user_name) $user_name = '访客';
if (mb_strlen($txt,"UTF8") < 1 || mb_strlen($txt,"UTF8") > 140 ){
  echo "";
  exit;
}

$time = date("Y-m-d H:i:s");
$userid = 0; // 可以送session中取，如果要做登录判断的花
$ip = $_SERVER["REMOTE_ADDR"];
$insert_sql = "insert into comment(user_id, user_name, content, created_at, ip) values ('$userid','$user_name','$txt','$time', '$ip')";
mysqli_query( $link, $insert_sql);

echo formatSay($txt, $time, $user_name);