<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/6
 * Time: 10:11
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
$sql = "select * from news ";
$result = mysqli_query($link, $sql);
$arr_news = mysqli_fetch_all($result, MYSQL_ASSOC);
//print_r($arr_news);
//获取所有的新闻分类
$db_selected = mysqli_select_db($link, 'news_category');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}
$sql  = "select * from news_category ";
$result = mysqli_query($link, $sql);
$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);
//print_r($arr_news_category);
$arr_news_category_value = array();
foreach($arr_news_category as $val ){
    $arr_news_category_value[$val['id']] = $val['name'];
}
?>