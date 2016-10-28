<?php
// 启用session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>管理员注册</title>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/login.css" />

    <script src="js/jquery.min.js" type="text/javascript"></script>

    <style>
      .error_tips{
        color: red;
      }
    </style>



</head>


<body style="background:  url('images/bg/<?php echo rand(1,9)?>.jpg')">
<div class="page">
	<div class="loginwarrp">
		<div class="logo">管理员注册</div>
		<p class="error"><?php echo $error_tips;?></p>
        <div class="login_form">
			<form id="register" name="register" method="post" action="">
				<li class="login-item">
					<span>用户名：</span>
					<input type="text" name="user_name" id="user_name" class="login_input" placeholder="请输入用户名" required="required">
          <span id="user_name_tips" class="error_tips"></span>
				</li>
        <li class="login-item">
          <span>Email：</span>
          <input type="text" name="email" id="email" class="login_input" placeholder="请输入email" required="required">
          <span id="email_tips" class="error_tips"></span>
        </li>
                <li class="login-item">
                    <span>手机：</span>
                    <input type="text" name="mobile" id="mobile" class="login_input" placeholder="请输入手机号码" required="required">
                    <span id="mobile_tips" class="error_tips"></span>
                </li>
				<li class="login-item">
					<span>密　码：</span>
					<input type="password" name="password" id="password" class="login_input" required="required">
          <span id="password_tips" class="error_tips"></span>
				</li>
        <li class="login-item">
          <span>确认密码：</span>
          <input type="password" name="password2" id="password2" class="login_input" required="required">
          <span id="password2_tips" class="error_tips"></span>
        </li>
				<li class="login-item verify">
					<span>验证码：</span>
					<input type="text" name="code" id="code" class="login_input verify_input" required="required">
				</li>
				<img src="common/checkcode.php" border="0" class="verifyimg" width="60px"/>
        <div class="clearfix"></div>
        <li style="padding:10px 0px">
        <span id="code_tips" class="error_tips"></span>
        </li>


        <li style="padding:10px 0px">
          <span id="code_tips" class="error_tips"></span>
        </li>

				<li class="login-sub">
					<input type="button" name="Submit" value="注册" id="btn" /><a href="login.php" class="register">登录</a>
				</li>                      
           </form>
		</div>
	</div>
</div>

<script>
 $(function(){

   alert(1);

 });

</script>

</body>
</html>