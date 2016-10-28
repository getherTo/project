<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/2
 * Time: 15:44
 */

include_once "../common/db.php";

include_once "../common/checklogin.php";



// 根据id 删除公告
$id = $_GET['id'];
if( !is_numeric($id) ){
    echo "ERROR!";
    exit;
}


$sql = "delete from home_imgs where id = $id";

// 执行sql语句
$result = mysqli_query($link, $sql);

if($result){
    echo "删除成功！";
    // 直接跳转进入简历列表
    header("Location: list.php");

} else {
    echo "删除失败！";
}


