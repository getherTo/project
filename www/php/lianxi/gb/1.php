<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/7
 * Time: 14:59
 */

// 告诉浏览器， 这是一张图片， 图片的格式是png

header("Content-type:image/png");
// 创建一个 400*300 的图片
$image = imagecreatetruecolor(150, 30);
// 生成图片
imagepng($image);
// 销毁图片，释放内存
imagedestroy($image);