<?php

$db_server = "localhost"; // 数据库地址
$db_user = "root"; // mysql 用户名
$db_pwd = ""; // mysql 用户密码
$db_name = "my_db2"; // 数据库

// 连接 db
$link = mysqli_connect($db_server, $db_user, $db_pwd);

if (!$link) {
  echo "数据库连接失败!";
}

// 选择数据库
$db_selected = mysqli_select_db($link, $db_name);

if (!$db_selected) {
  echo "<br>数据库{$db_name}-选择失败!";
}

// 设置mysqli的连接字符集
$link->query("set names utf8");