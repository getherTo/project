<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>后台欢迎页</title>
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/public.css" />
  <link rel="stylesheet" href="../css/content.css" />
</head>

<?php

include_once "../common/db.php";

if( count($_POST)>0 ) {

  $error_tips = "";
  if ($_POST['password'] != $_POST['password2']) { // 检查2次输入的用户密码是否一致
    $error_tips = "提示信息：两次密码不一致！";
  } else {
    $salt = substr(md5(time() . rand(1000, 9999)), 0, 10);
    // 生成一个10位的随机数，做为密码加密的盐，保证密码的安全性
    // 将用户输入的密码和satl字符串进行连接，在加密，保证密码的安全性
    $password = md5($_POST['password'] . $salt);
    $ip = $_SERVER['REMOTE_ADDR'];
    $current_time = date("Y-m-d H:i:s");
    // 注册用户信息
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
      header("Location: list.php");
    }
  }
}


?>


<body marginwidth="0" marginheight="0">
<div class="container">
  <div class="public-nav">您当前的位置：<a href="">管理首页</a></div>
  <div class="public-content">
    <div class="public-content-header">
      <h3>添加用户</h3>
    </div>
    <div class="public-content-cont">
      <form method="post" action="" name="form1">
        <div class="form-group">
          <label for="">用户名</label>
          <input class="form-input-txt" type="text" name="user_name" value="" required/>
        </div>

        <div class="form-group">
          <label for="">Email</label>
          <input class="form-input-txt" type="text" name="email" value="" required/>
        </div>

        <div class="form-group">
          <label for="">手机</label>
          <input class="form-input-txt" type="text" name="mobile" value="" required/>
        </div>
        <div class="form-group">
          <label for="">密码</label>
          <input class="form-input-txt" type="password" name="mobile" value="" required/>
        </div>

        <div class="form-group" style="margin-left:150px;">
          <input type="submit" class="sub-btn" value="提  交" />
          <input type="reset" class="sub-btn" value="重  置" />
          <a href="list.php">取消</a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>