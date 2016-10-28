<?php
// 启用session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理员注册</title>
  <link rel="stylesheet" href="css/reset.css"/>
  <link rel="stylesheet" href="css/login.css"/>

  <script src="js/jquery.min.js" type="text/javascript"></script>

  <style>
    .error_tips {
      color: red;
    }
  </style>


</head>

<?php



if (count($_POST) > 0) { // 判断用户是否提交

  $error_tips = "";
  // 检查验证码是否正确
  if ($_POST['code'] != "" && $_POST['code'] == $_SESSION['session_code']) {
    // 通过验证后，验证码要销毁
    unset($_SESSION['session_code']);


    if ($_POST['password'] != $_POST['password2']) { // 检查2次输入的用户密码是否一致

      $error_tips = "提示信息：两次密码不一致！";
    } else {

      // $pasword  $salt

      $salt = substr(md5(time() . rand(1000, 9999)), 0, 10);
      // 生成一个10位的随机数，做为密码加密的盐，保证密码的安全性

      // 将用户输入的密码和satl字符串进行连接，在加密，保证密码的安全性
      $password = md5($_POST['password'] . $salt);

      $ip = $_SERVER['REMOTE_ADDR'];
      $current_time = date("Y-m-d H:i:s");


      include_once "common/db.php";
      $sql = "insert into user ( user_name, password, salt, email, mobile, ip , created_at )
                              values (  '{$_POST['user_name']}', '{$password}', '{$salt}','{$_POST['email']}','{$_POST['mobile']}', '{$ip}',  '{$current_time}' )
                        ";
      $result = mysqli_query($link, $sql);
      if (!$result) {
        // 调试语句
        echo "注册失败！";
        echo mysqli_error($link);
        exit;
      } else {
        // 注册成功
        header("Location: login.php?register=ok");
      }
    }

  } else {
    $error_tips = "提示信息：验证码不正确";
  }
}

?>


<body style="background:  url('images/bg/<?php echo rand(1, 9) ?>.jpg')">
<div class="page">
  <div class="loginwarrp">
    <div class="logo">管理员注册</div>
    <p class="error"><?php echo $error_tips; ?></p>

    <div class="login_form">
      <form id="register" name="register" method="post" action="">
        <li class="login-item">
          <span>用户名：</span>
          <input type="text" name="user_name" id="user_name" class="login_input" placeholder="请输入用户名"
                 required="required">
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
          <input type="button" name="Submit" value="注册" id="btn"/><a href="login.php" class="register">登录</a>
        </li>
      </form>
    </div>
  </div>
</div>

<script>
  $("#btn").click(function () {

    var user_name = $("#user_name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var password = $("#password").val();
    var password2 = $("#password2").val();
    var code = $("#code").val();

    var check_flag = true;

    if (user_name == "") {
      $("#user_name_tips").html("用户名");
      $("#user_name_tips").show();
      check_flag = false;
    } else {
      $("#user_name_tips").html("");
    }

    if (password == "") {
      $("#password_tips").html("密码");
      $("#password_tips").show();
      check_flag = false;
    } else {
      $("#password_tips").html("");
    }

    if (password2 == "") {
      $("#password2_tips").html("确认密码");
      $("#password2_tips").show();
      check_flag = false;
    } else {
      $("#password2_tips").html("");
    }

    if (password && password2 && password != password2) {
      $("#password2_tips").html("密码不一致");
      $("#password2_tips").show();
      check_flag = false;
    } else {
      $("#password2_tips").html("");
    }


    if (code == "") {
      $("#code_tips").html("验证码");
      $("#code_tips").show();
      check_flag = false;
    } else {
      $("#code_tips").html("");
    }

    // 检查邮件格式是否正确
    if (!emailCheck(email)) {
      $("#email_tips").html("Email格式错误");
      $("#email_tips").show();
      check_flag = false;
    } else {
      $("#email_tips").html("");
    }

    // 检查手机格式是否正确
    if (!validatePhone(mobile)) {

      $("#mobile_tips").html("手机格式错误");
      $("#mobile_tips").show();
      check_flag = false;

    } else {
      $("#mobile_tips").html("");
    }

    $.ajax({
      type: "GET", // 发送请求的方式 GET 或 POST
      url: "ajax/check_register.php", // 请求的php地址
      data: {code: $("#code").val(), user_name: $("#user_name").val()}, // 发送的参数
      async: false,
      success: function (html) {  // html为请求的php文件返回的内容
        if (html == "code_error") {
          $("#code_tips").html("验证码错误");
          $("#code_tips").show();
          check_flag = false;
        } else if (html == "user_exited") {
          $("#user_name_tips").html("用户名已存在");
          $("#user_name_tips").show();
          check_flag = false;
        } else if (html == "ok") {
          // 通过检查
          $("#code_tips").html("");
        }
      }
    });

    if (check_flag) { // 检测通过
      $("#register").submit(); // 提交表单
    }

  });

  // 检测邮件地址
  function emailCheck(strEmail) {
    var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
    if (!pattern.test(strEmail)) {
      //alert("请输入正确的邮箱地址。");
      return false;
    } else {
      //alert("邮箱地址正确");
      return true;
    }
    return true;
  }


  // 验证电话号码
  function validatePhone(phoneValue) {
    phoneValue = phoneValue;
    var reg = /^[1][0-9]{10}$/;
    return reg.test(phoneValue);
  }


</script>

</body>
</html>