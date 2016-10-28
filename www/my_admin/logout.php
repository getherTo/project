<?php

// 启用session
session_start();


// 清除session
unset($_SESSION['is_auth']);
unset($_SESSION['user_name']);
unset($_SESSION['email']);


// 跳转到登录页面
// header("Location: login.php");

// 返回上一个页面
if( $_SERVER['HTTP_REFERER'] ){
    header("Location: {$_SERVER['HTTP_REFERER'] }");
} else {
    header("Location: login.php");
}