<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>测试验证码</h1>
<form name="form1" action="<?php echo U('index/checkCaptcha');?>" method="get">
    <img src="<?php echo U('index/captcha');?>" ><br>
    <input type="text" name="code" required><br>
    <input type="submit" value="验证">
</form>
</body>
</html>