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
if ($b>20){
    echo substr_replace($a, '...', 20);
}else{
    echo $a;
}
?>

</body>
</html>