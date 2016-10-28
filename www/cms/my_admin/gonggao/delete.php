<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/2
 * Time: 15:44
 */


// 根据id 删除公告
$id = $_GET['id'];
if( !is_numeric($id) ){
    echo "ERROR!";
    exit;
}


$sql = "delete from gonggao where id = $id";


// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}

// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'my_db');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}

// 执行sql语句
$result = mysqli_query($link, $sql);

if($result){
    echo "删除成功！";
    // 直接跳转进入简历列表
    header("Location: list.php");

} else {
    echo "删除失败！";
}


