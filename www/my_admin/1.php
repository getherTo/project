<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 16:29
 */

// 启用session
session_start();

$code = $_GET['code'];

if( $code != "" && $code == $_SESSION['session_code'] ) {
    echo "ok";
} else {
    echo "error";
}
