<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/16
 * Time: 15:03
 */
header("Content-type:text/html;charset=utf-8");
$dir = $_GET["dir"];
if ($dir=='west')
        {
        echo '西';
        }
else if ($dir=='east')
    {
        echo'东';
   }
else if ($dir == 'north') {
    echo '北';
} else if ($dir == 'sourth') {
    echo '南';
} else {
    echo '未知';
}