<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/7
 * Time: 15:08
 */
header('Content-type: image/png');

//创建图像
$image=imagecreatetruecolor(100,20);

//设置颜色
$red=imagecolorallocate($image,255,255,255);
imagestring($image,5,2,2,'18556522728',$red);



//生成图片
imagepng($image);

//销毁图片， 释放内存
imagedestroy($image);


//调用image.php代码
//商家电话：：<imgsrc="image.php">