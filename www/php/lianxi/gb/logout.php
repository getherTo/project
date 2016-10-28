<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/8
 * Time: 14:28
 */

// 清除相关登录cookie
// 写入cookie
//setcookie("user_name", "", time() -1, "/" );
//setcookie("email", "", time() -1, "/");
//setcookie("is_login","", time() -1, "/");
//// 跳回list页面
//header("Location: list.php");
session_start();
$_SESSION['user_name']=$_POST['user_name'];
$_SESSION['email']=$_POST['email'];
$_SESSION['password'] = $_POST['password'];
unset($_SESSION);
header("Location: list.php");