<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
$red  = [['name'=>'红玫瑰','img'=>'hong.png'],['name'=>'红玫瑰','img'=>'hong.png']];
$orange =[['name'=>'橙玫瑰','img'=>'cheng.png'],['name'=>'橙玫瑰','img'=>'cheng.png']];
$yellow =[['name'=>'黄玫瑰','img'=>'huang.png'],['name'=>'黄玫瑰','img'=>'huang.png']];
$green  = [['name'=>'绿玫瑰','img'=>'lv.png'],['name'=>'绿玫瑰','img'=>'lv.png']];
$cyan  = [['name'=>'青玫瑰','img'=>'qing.png'],['name'=>'青玫瑰','img'=>'qing.png']];


foreach( $red as $key => $val ){
echo $val['name'];
echo "<img src='hua/{$val['img']}' >";
echo "<br>";
}

foreach( $green as $key => $val ){
echo $val['name'];
echo "<img src='hua/{$val['img']}' >";
echo "<br>";
}
?>
</body>
</html>