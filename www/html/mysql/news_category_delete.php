<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/2
 * Time: 15:44
 */


// 根据简历id 删除简历
$id = $_GET['id'];
if( !is_numeric($id) ){
    echo "ERROR!";
    exit;
}


$sql = "delete from news_category where id = $id";


// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}

// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'news_category');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}

// 执行sql语句
$result = mysqli_query($link, $sql);

if($result){
    echo "删除简历成功！";
    // 直接跳转进入简历列表
    header("Location: news_category_list.php");

} else {
    echo "删除简历失败！";
}


