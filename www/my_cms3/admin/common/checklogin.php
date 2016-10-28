<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/12
 * Time: 10:21
 */


// 启用session
session_start();
// 判断是否登录

if( !$_SESSION['is_auth'] ){
    header("Location: ". MY_DIR. "/admin/login.php" );
}
