<?php
header("Content-type:text/html;charset=utf-8");
	/* 加载图像处理类所在的文件 */
	include "image.class.php";
	/* 实例化图像处理类对象，通过构造方法的参数指定图片所在路径 */
	$img = new Image('./image/');
	
	/* 在图片brophp.jpg中,从50X50开始，裁剪出120X120的图片，返回带默认前缀“cu_”的图片名称 */
	$img -> cut("brophp.jpg", 50, 50, 120,120);               //cu_brophp.jpg
	/* 可以通过第6个参数，为裁剪出来的图片指定名称前缀，实现同一张背景图片中裁剪出多张图片 */
	$img -> cut("brophp.jpg", 50, 50, 120,120, 'user_');      //user_brophp.jpg
	/* 如果第6个参数设置为'', 则是使用裁剪出来的图片将原图覆盖掉 */
	$img -> cut("brophp.jpg", 50, 50, 120,120, '');           //brophp.jpg
	
	
	
	
	