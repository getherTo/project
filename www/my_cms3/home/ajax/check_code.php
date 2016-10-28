<?php


// 开启session
session_start();

// 1. 检查验证码
$code = $_GET['code'];
if( $code != "" && $code == $_SESSION['session_code']){ // 通过检查
  echo "ok";
  unset($_SESSION['session_code']);
}else {
  echo "error";
}


