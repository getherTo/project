<?php
/*
 * 文件创建于 2008-11-16 日 PHPeclipse - PHP - Code Templates
 */
$temp="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";//去掉了 O 和 0 。
$yzchar="";
for($i=0;$i<4;$i++){
	$yzchar.=substr($temp,rand(0,33),1);
}
setcookie("verifycode",$yzchar,time()+10*60);	//保存十分钟

yzimg($yzchar);
function yzImg($nmsg){
	if (function_exists('imagecreate')){
		$backr=rand(230,245);$backg=rand(230,245);$backb=rand(230,245);
		$borderr=rand(20,150);$borderg=rand(20,150);$borderb=rand(20,150);
		$charwidth=15;
		$width=strlen($nmsg)*$charwidth;
		$height=22;
		$aimg = imagecreate($width,$height);
		$back = imagecolorallocate($aimg, $backr, $backg, $backb);
		$charcolor = imagecolorallocate($aimg, $borderr, $borderg, $borderb);
		$border=imagecolorallocate($aimg, $backr-50, $backg-50, $backb-50);
		imagefilledrectangle($aimg, 0, 0, $width - 1, $height - 1, $back);
		imagerectangle($aimg, 0, 0, $width - 1, $height - 1, $border);
		for ($i=0;$i<strlen($nmsg);$i++){
			$floatx=rand(4,10);//随机偏移字符X的位置。
			$floaty=rand(0,7);
			imagechar($aimg,5,$i*($charwidth-2)+$floatx,$floaty, $nmsg[$i],$charcolor);
		}
		for($i=0;$i<25;$i++){
			$x1=rand(2,$width-3);$y1=rand(2,$height-3);//$x2=rand(1,$width);$y2=rand(1,$height);
			//imageline ($aimg,$x1,$y1,$x2,$y2,$charcolor);	//随机画线
			imagesetpixel($aimg,$x1,$y1,$charcolor);		//随机画点
		}

		header("Pragma:no-cache");
		header("Cache-control:no-cache");
		header("Content-type: image/png");
		imagepng($aimg);
		imagedestroy($aimg);		//释放内存。
		exit;
	} else {
		header("Pragma:no-cache");
		header("Cache-control:no-cache");
		header("ContentType: Image/BMP");

		$Color[0] = chr(0).chr(0).chr(0);
		$Color[1] = chr(250).chr(250).chr(250);
		$_Num[0]  = "1110000111110111101111011110111101001011110100101111010010111101001011110111101111011110111110000111";
		$_Num[1]  = "1111011111110001111111110111111111011111111101111111110111111111011111111101111111110111111100000111";
		$_Num[2]  = "1110000111110111101111011110111111111011111111011111111011111111011111111011111111011110111100000011";
		$_Num[3]  = "1110000111110111101111011110111111110111111100111111111101111111111011110111101111011110111110000111";
		$_Num[4]  = "1111101111111110111111110011111110101111110110111111011011111100000011111110111111111011111111000011";
		$_Num[5]  = "1100000011110111111111011111111101000111110011101111111110111111111011110111101111011110111110000111";
		$_Num[6]  = "1111000111111011101111011111111101111111110100011111001110111101111011110111101111011110111110000111";
		$_Num[7]  = "1100000011110111011111011101111111101111111110111111110111111111011111111101111111110111111111011111";
		$_Num[8]  = "1110000111110111101111011110111101111011111000011111101101111101111011110111101111011110111110000111";
		$_Num[9]  = "1110001111110111011111011110111101111011110111001111100010111111111011111111101111011101111110001111";

		echo chr(66).chr(77).chr(230).chr(4).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(54).chr(0).chr(0).chr(0).chr(40).chr(0).chr(0).chr(0).chr(40).chr(0).chr(0).chr(0).chr(10).chr(0).chr(0).chr(0).chr(1).chr(0);
		echo chr(24).chr(0).chr(0).chr(0).chr(0).chr(0).chr(176).chr(4).chr(0).chr(0).chr(18).chr(11).chr(0).chr(0).chr(18).chr(11).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0);

		for ($i=9;$i>=0;$i--){
				for ($j=0;$j<=3;$j++){
						for ($k=1;$k<=10;$k++){
								echo $Color[substr($_Num[$nmsg[$j]], $i * 10 + $k, 1)];
						}
				}
		}
		exit;
	}
}

?>
