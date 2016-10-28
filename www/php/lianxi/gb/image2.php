<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/7
 * Time: 14:31
 */
// 告诉浏览器，这个文件，是一个png图片
header('Content-type: image/png');

// 读入已有图片
$image = imagecreatefromjpeg("heka.jpg");


$name = $_GET['name'];
if(!$name) $name = "大家";


//文字颜色  255,253,217
$black = imagecolorallocate($image, 0, 0, 0);
// 设置中文文字
imagettftext($image, 30, 0, 670, 110, $black, "simhei.ttf", "{$name}");
imagettftext($image, 17, 0, 540, 500, $black, "simhei.ttf", "新安人才网PHP培训班第8期全体学员");
imagettftext($image, 14, 0, 710, 770, $black, "simhei.ttf", date("Y-m-d"));



// 生成图片
imagepng($image);

// 销毁图片， 释放内存
imagedestroy($image);