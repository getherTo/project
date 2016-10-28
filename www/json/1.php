<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/20
 * Time: 15:04
 */
$name = $_GET['name']; // 获取jquery页面传递的参数
$arr['akl'] = "akl.jpg";
$arr['dcr'] = "dcr.jpg";
$arr['ez'] = "ez.jpg";
$arr['hl'] = "hl.jpg";
$arr['hn'] = "hn.jpg";
$arr['kn'] = "kn.jpg";
$arr['kzs'] = "kzs.jpg";
$arr['lks'] = "lks.jpg";
$arr['rw'] = "rw.jpg";
$arr['tm'] = "tm.jpg";
$arr['ys'] = "ys.jpg";
$arr['zz'] = "zz.jpg";
$img = $arr[$name];
if(!$img) {
    $img = "yangmi.jpg";
}
echo  "<img src='{$img}' width='400px' height='200px'>";