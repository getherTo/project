<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/7
 * Time: 14:19
 */
header("Content-type: text/html; charset=utf-8");
$date = date("Ymd");
$path = "../../upload/".$date;
if (is_dir($path)){
echo " 存在";
}else{
    echo "不存在";
    if( mkdir( $path )) {
        echo "创建文件目录成功";
    } else {
        echo "创建文件目录失败";
    }
}
