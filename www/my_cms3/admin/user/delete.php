<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/2
 * Time: 15:44
 */


include_once "../common/db.php";


// 根据简历id 删除简历
$id = $_GET['id'];
if( !is_numeric($id) ){
    echo "ERROR!";
    exit;
}


$sql = "delete from user where id = $id";


// 执行sql语句
$result = mysqli_query($link, $sql);

if($result){
    echo "删除成功！";
    // 直接跳转进入简历列表
    header("Location: list.php");

} else {
    echo "删除简历失败！";
}


