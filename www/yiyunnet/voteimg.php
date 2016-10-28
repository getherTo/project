<?php
/*
 * 文件创建于 2008-11-19 日 PHPeclipse - PHP - Code Templates
 */
require("inc/conn.php");
$id=(int)$_GET['id'];

$width=(int)$_GET['width'];
if($width<100)$width=500;
if($width>600)$width=600;
$sql="select * from {$pre}vote where cid={$id} order by id";
$height=160;
$backr=rand(230,245);$backg=rand(230,245);$backb=rand(230,245);
$charr=rand(100,150);$charg=rand(100,150);$charb=rand(100,160);

$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records<1){
	$aimg = imagecreate($width,$height);
	$back = imagecolorallocate($aimg, $backr, $backg, $backb);
	$charcolor=  imagecolorallocate($aimg, $charr, $charg, $charb);
	$border=imagecolorallocate($aimg, $backr-50, $backg-50, $backb-50);
	imagefilledrectangle($aimg, 0, 0, $width - 1, $height - 1, $back);
	imagerectangle($aimg, 0, 0, $width - 1, $height - 1, $border);
	imagestring($aimg,5,180,75, "sorry! not find",$charcolor);
	header("Pragma:no-cache");
	header("Cache-control:no-cache");
	header("Content-type: image/png");
	imagepng($aimg);
	imagedestroy($aimg);		//释放内存。
	exit;
}else{
	$max=0;
	for($i=0;$i<$records;$i++){
		$row[$i]=$conn->fetch_array($query);
		if($row[$i]['votenum']>$max)$max=$row[$i]['votenum'];
	}
	if($max<1)$max=1;
	$scale=($width-50)/$max;
	$height=$records*50;
	$aimg = imagecreate($width,$height);
	$back = imagecolorallocate($aimg, $backr, $backg, $backb);
	$charcolor=  imagecolorallocate($aimg, $charr, $charg, $charb);
	$border=imagecolorallocate($aimg, $backr-50, $backg-50, $backb-50);
	imagefilledrectangle($aimg, 0, 0, $width - 1, $height - 1, $back);
	imagerectangle($aimg, 0, 0, $width - 1, $height - 1, $border);
	for($i=0;$i<$records;$i++){
		$len=ceil($row[$i]['votenum']*$scale);
		$y1=$i*50+20;
		imagefilledrectangle($aimg, 0, $y1, $len+5, $y1+10, $charcolor);
		imagestring($aimg,5,$len+13,$y1-3,$row[$i]['votenum'],$charcolor);
	}
	header("Pragma:no-cache");
	header("Cache-control:no-cache");
	header("Content-type: image/png");
	imagepng($aimg);
	imagedestroy($aimg);		//释放内存。
	exit;
}

?>
