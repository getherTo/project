<?php
// 启用session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>会员注册</title>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/login.css" />
    <script src="../jquery.js" type="text/javascript"></script>

</head>
<?php
if( count($_POST) > 0 ) { // 判断用户是否提交
    $error_tips = "";
    // 检查验证码是否正确
    if(  $_POST['code'] != "" && $_POST['code'] == $_SESSION['session_code'] ){
        // 通过验证后，验证码要销毁
        unset($_SESSION['session_code']);

        if( $_POST['password'] != $_POST['password2']   ){ // 检查2次输入的用户密码是否一致

            $error_tips = "提示信息：两次密码不一致！";
        } else {

            // $pasword  $salt

            $salt = substr(md5(time().rand(1000,9999)),0,10);
            // 生成一个10位的随机数，做为密码加密的盐，保证密码的安全性

            // 将用户输入的密码和satl字符串进行连接，在加密，保证密码的安全性
            $password = md5($_POST['password'] . $salt );

            $ip = $_SERVER['REMOTE_ADDR'];
            $current_time = date("Y-m-d H:i:s");


            include_once "common/db.php";
            $sql = "insert into user ( user_name, password, salt, email, mobile, ip , created_at )
                              values (  '{$_POST['user_name']}', '{$password}', '{$salt}','{$_POST['email']}','{$_POST['mobile']}', '{$ip}',  '{$current_time}' )
                        ";
            $result = mysqli_query($link, $sql);
            if( !$result ){
                // 调试语句
                echo "注册失败！";
                echo mysqli_error($link);
                exit;
            } else {
                // 注册成功
                header("Location: login.php");
            }

        }

    }

//    else {
//        $error_tips = "提示信息：验证码不正确";
//    }

}

?>


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
				</li>
        <li class="login-item">
          <span>Email：</span>
          <input type="text" name="email" class="login_input" placeholder="请输入email" required="required">
        </li>
                <li class="login-item">
                    <span>手机：</span>
                    <input type="text" name="mobile" class="login_input" placeholder="请输入手机号码" required="required">
                </li>
				<li class="login-item">
					<span>密　码：</span>
					<input type="password" name="password" class="login_input" required="required">
				</li>
        <li class="login-item">
          <span>确认密码：</span>
          <input type="password" name="password2" class="login_input" required="required">
        </li>
				<li class="login-item verify">
					<span>验证码：</span>
					<input type="text" name="code" id="code" class="login_input verify_input" required="required">
				</li>
                <a href="javascript:;" title="点击图片切换验证码"><img src="checkcode.php" id="img_code" border="0" class="verifyimg" /></a>
				<div class="clearfix"></div>
				<li class="login-sub">
					<input type="submit" id="btn" name="Submit" value="注册" /><a href="login.php" class="register">登录</a>
				</li>                      
           </form>
            <script type="text/javascript">
                $("#user_name").blur(function(){
                    $.ajax({
                        type:"GET",
                        url:"2.php",
                        data:{user_name:$('#user_name').val()},
                        success:function(html){
                            if(html=="用户名已存在"){
                                alert("用户名重复，请重新输入");
                            } else if (html=="用户名可用"){
                                alert("用户名可用");
                            }
                        }
                    });
                });
            </script>

            <script>
                $("#btn").click(function(){
                    // 检测用户输入的验证码是否正确
                    $.ajax({
                        type: "GET", // 发送请求的方式 GET 或 POST
                        url: "1.php", // 请求的php地址
                        data: {code: $("#code").val() }, // 发送的参数
                        success:function( html ) {  // html为请求的php文件返回的内容
                            if(html=="error"){
                                alert("验证码错误，请重新输入");
                            } else if (html=="ok"){
                              //  alert("验证码正确");
                            }
                        }
                    });
                });

                // 给验证码图片绑定click事件
                $("#img_code").click( function(){
                    // 重新载入验证码图片  Math.random() 返回一个随机数，避免浏览器缓存验证码图片
                    $("#img_code").attr("src", "checkcode.php?v=" + Math.random() )
                })
            </script>
		</div>
	</div>
</div>
</body>
</html>