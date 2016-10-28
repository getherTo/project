<?php
	/* 加载图像处理类所在的文件 */
	include "image.class.php";
	/* 实例化图像处理类对象，通过构造方法的参数指定图片所在路径 */
	$img = new Image('./image/');
	
	/* 将上传到服务器的大图控制在500X500以内，最后一个参数使用了'',将原来图片覆盖 */
	$filename = $img -> thumb("brophp.jpg", 500, 500, '');	
	
	/* 另存为一张250X250的中图，返回的图片名称会默认加上th_前缀 */
	$midname = $img -> thumb($filename, 250,250);
	/* 另存为一张80X80的小图标，返回的图片名称前使用指定的icon_作为前缀 */
	$icon = $img -> thumb($filename, 80, 80, 'icon_');
	
	echo $filename.'<br>';     //缩放成功输出brophp.jpg
	echo $midname.'<br>';      //缩放成功输出th_brophp.jpg
	echo $icon.'<br>';         //缩放成功输出icon_brophp.jpg
	
	
	