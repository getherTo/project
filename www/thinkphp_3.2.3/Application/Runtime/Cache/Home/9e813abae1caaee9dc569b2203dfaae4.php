<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>添加内容</h1>
<form method="POST" action="/thinkphp_3.2.3/home/index/insert">
    标题：<input type="text" name="title" required /><br/>
    内容：<textarea name="content" rows="8" cols="55" required></textarea><br/>
   <!--时间：<input type="text" name="created_at"  required /><br/>-->
    <input type="submit" value="提交" />
</form>
</body>
</html>