<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/23
 * Time: 9:43
 */
header("Content-type:text/html;charset=utf-8");
$arr = [['姓名'=>'x1','年龄'=>19,'性别'=>'男'], ['姓名'=>'x2','年龄'=>20,'性别'=>'女']];
foreach ($arr as $val){
    foreach ($val as$key=> $val1){
        echo "&nbsp;";
        echo "$val1";
    }

}


