<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form method="post" action="" name="name1">
    姓名：<input type="text" name="a" placeholder="请输入" required=""><br>
    手机：<input type="text" name="b" placeholder="请输入" required=""><br>
    <input type="submit" value="提交">
</form>
 <?php
$file ="date.txt";
 file_put_contents($file,"姓名：".$_POST['a']."\r\n"."手机号：".$_POST['b']."\r\n"."\r\n",FILE_APPEND);
 ?>
</body>
</html>