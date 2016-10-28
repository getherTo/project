<?php
header("Content-type:text/html;charset=utf-8");

	/* 加载图像处理类所在的文件 */
	include "image.class.php";
	/* 实例化图像处理类对象，没有通过参数指定图片所在路径，所以默认为当前路径 */
	$img = new Image('./image/');
	
	/* 为图片brophp.jpg，添加一个imge目录下的water_small.png图片水印 ，第三个参数使用1，水印位置顶部居左*/
	echo $img -> watermark('brophp.jpg', 'water_small.png', 1, 'wa1_');  //输出wa1_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 2, 'wa2_');  //输出wa2_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 3, 'wa3_');  //输出wa3_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 4, 'wa4_');  //输出wa4_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 5, 'wa5_');  //输出wa5_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 6, 'wa6_');  //输出wa6_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 7, 'wa7_');  //输出wa7_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 8, 'wa8_');  //输出wa8_brophp.jpg
	echo $img -> watermark('brophp.jpg', 'water_small.png', 9, 'wa9_');  //输出wa9_brophp.jpg

	/* 没有指定第四个参数（名称前缀），使用默认的名称前缀"wa_" */
	echo $img -> watermark('brophp.jpg', 'water_small.png', 0);          //输出wa_brophp.jpg
	/* 第四个参数（名称前缀）设置空('')，就会将原来brophp.jpg图片覆盖掉 */
	echo $img -> watermark('brophp.jpg', 'water_small.png', 0,'');       //输出brophp.jpg
	/* 第二个参数如果没有指定路径，则water_small.png图片和brophp.jpg图片在同一个目录下 */
	echo $img -> watermark('brophp.jpg', 'water_small.png', 0, 'wa0_');          //输出wa0_brophp.jpg

	
	
	