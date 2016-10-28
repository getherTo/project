<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form method="get" action="">
    <input type="text" name="a" placeholder="请输入" required="">
    <input type="submit" value="提交"><br>
    <input type="text" name="b" placeholder="请输入" required="">
    <input type="submit" value="提交">
</form>
<?php
$a = $_GET['a'];
$b = $_GET['b'];
?>
</body>
</html>