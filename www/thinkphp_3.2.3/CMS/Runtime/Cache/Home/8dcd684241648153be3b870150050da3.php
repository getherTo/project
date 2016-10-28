<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员登陆</title>
    <link rel="stylesheet" href="/thinkphp_3.2.3/Public/home/css/reset.css" />
    <link rel="stylesheet" href="/thinkphp_3.2.3/Public/home/css/login.css" />
</head>
<body style="background:  url('/thinkphp_3.2.3/Public/images/9.jpg')">
<div class="page">
    <div class="loginwarrp">
        <div class="logo"><h2>管理员登陆</h2></div>
        <p class="error"><?php echo $error_tips;?></p>
        <div class="login_form">
            <form id="login" name="login" method="post" action="">
                <li class="login-item">
                    <span>用户名：</span>
                    <input type="text" name="user_name" class="login_input" placeholder="请输入用户名" required="required">
                </li>
                <li class="login-item">
                    <span>密　码：</span>
                    <input type="password" name="password" class="login_input" placeholder="密　码" required="required">
                </li>
                <div class="clearfix"></div>
                <li class="login-sub">
                    <input type="submit" name="Submit" value="登录" />  <a href="register.php" class="register">注册</a>
                </li>
            </form>
        </div>
    </div>
</div>
</body>
</html>