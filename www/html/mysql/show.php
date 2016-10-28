<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/8
 * Time: 19:43
 */
header("Content-type: text/html; charset=utf-8");
// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}
// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'news');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}
// 设置mysql字符集 为 utf8
$link->query("set names utf8");
// 查询简历表中的用户信息
$sql = "select * from news where 1 ";
$result = mysqli_query($link, $sql);
$arr_news = mysqli_fetch_all($result, MYSQL_ASSOC);
//print_r($arr_news);
foreach($arr_news as $key=> $val){
   echo $val['title']."<br>";
   echo $val['author']."<br>";
    echo $val['created_at']."<br>";
    echo $val['content']."<hr>";
}




