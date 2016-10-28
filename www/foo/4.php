<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 16:09
 */
header("Content-type: text/html; charset=utf-8");
// 引用Human.php文件
include_once "3.php";

// 定义Chinese类
class Chinese extends Person{

}

$chinese_1 = new Chinese('张三',20, '男', 1.8, 80);
echo  "<br>姓名：" . $chinese_1->name;
echo  "<br>年龄：" . $chinese_1->age;
echo  "<br>吃饭：" . $chinese_1->eat();
