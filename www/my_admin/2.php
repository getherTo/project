<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/21
 * Time: 9:52
 */
include_once ("common/db.php");
$name = $_GET['user_name'];
$sql = "select id from user where user_name='{$_GET['user_name']}'";
$val = mysqli_query($link,$sql);
$arr = mysqli_fetch_array($val,MYSQL_ASSOC);
if($arr){
    echo "用户名已存在";
}else{
    echo "用户名可用";
}