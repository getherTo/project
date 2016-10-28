<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>文件上传-练习</h1>
<form action="/thinkphp_3.2.3/index.php/Home/Index/saveUpload" enctype="multipart/form-data" method="post" >
    名称：<input type="text" name="name" />
    图片1：<input type="file" name="photo" />
    <input type="submit" value="提交" >
</form>
</body>
</html>