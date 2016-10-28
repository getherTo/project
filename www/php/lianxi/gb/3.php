<?php
// 告诉浏览器，这个文件，是一个png图片
header ( 'Content-type: image/png' );

// 创建图像
$image  =  imagecreatetruecolor ( 50, 20 );

// 填充颜色 - ps里的点击画布填色
imagefill ( $image ,  0 ,   0 , imagecolorallocate ( $image ,  149 ,  188 ,  205 ) );

$code = "";
for( $i=1; $i <=4; $i++){
    $rand_code = rand(1,9); // 生成1-9的随机数
    imagestring($image, 5, 5+($i-1)*10, 2, $rand_code,$red); // 将文字写入图片
    $code .= $rand_code;
}

//加入干扰象素 ， 循环100次
for ($i = 0; $i < 100; $i++) {
    $randcolor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
//画像素点函数
    imagesetpixel($image, rand(1, 44), rand(1,18), $randcolor);
}


// 设置颜色
$red = imagecolorallocate($image, 255,255,255);


// 生成图片
imagepng ( $image );

// 销毁图片， 释放内存
imagedestroy ( $image );
?>