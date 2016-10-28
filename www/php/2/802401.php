<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form method="get" action="">
    <input type="text" name="a" placeholder="请输入" required="">
    <input type="submit" value="提交">
</form>
<?php
  $a =$_GET['a'];
   echo "1.左空格:".ltrim($a);
   echo "<br>";
   echo "2.右空格:".rtrim($a);
echo "<br>";
echo "3.字符长度:".strlen($a);
echo "<br>";
$b = strlen($a);
if ($b<6){
    echo "4.字符长度太短";
}elseif ($b>20){
    echo "4.字符长度太长";
}elseif($b>=6 && $b<=20){
    echo"4.字符长度符合标准";
}
echo "<br>";
echo   "5a.".mb_substr($a,2,null,'utf-8');
echo "<br>";
echo   "5b.".mb_substr($a,3,10,'utf-8');
if ($b>20){
    echo substr_replace($a, '...', 19);
}else{
    echo $a;
}
?>

</body>
</html>