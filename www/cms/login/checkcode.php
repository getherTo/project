<?php
// 启用session
session_start();

// 设置头部， 表示此文件为一张png的图片
Header("Content-type:image/PNG");

//  画一张指定宽高的图片  44 * 18
$im = imagecreate(65, 22);

//  定义背景颜色
$back = imagecolorallocate($im, 245, 245, 245);

//把背景颜色填充到刚刚画出来的图片中
imagefill($im, 0, 0, $back);

//生成4位数字
$vcodes = "";

for ($i = 0; $i < 4; $i++) {

// 随机生成字体颜色
  $font_color = imagecolorallocate($im, rand(100, 255), rand(0, 100), rand(100, 255));

//  生成随机数
  $authnum = rand(1, 9);

// 记录随机数
  $vcodes .= $authnum;

// 将随机数写入图片， x轴，每次向由移动10个像素, y轴始终为1
  imagestring($im, 5, 5 + $i * 14, 4, $authnum, $font_color);
}

// 写入session
$_SESSION['session_code'] = $vcodes;

//加入干扰象素 ， 循环200次
for ($i = 0; $i < 200; $i++) {
  $randcolor = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
//画像素点函数
  imagesetpixel($im, rand(1, 65), rand(1,22), $randcolor);
}

imagepng($im);


imagedestroy($im);

