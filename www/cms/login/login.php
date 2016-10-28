<?php

// 启用session
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员登陆</title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/login.css" />
</head>

<?php

if( count($_POST) > 0 ) { // 判断用户是否提交

    include_once "common/db.php";

    // 查询数据库中是否存在用户信息
    $sql = "select * from user where user_name = '{$_POST['user_name']}'";
    $result = mysqli_query($link, $sql);
    $user =  mysqli_fetch_array($result, MYSQL_ASSOC);
    if( count($user) > 0 ){
        // 检查用户密码是否正确
        if ( $user['password'] == md5( $_POST['password'] . $user['salt'] ) ){
            // 登录成功
            // 设置session信息
            $_SESSION['is_auth'] = true;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['email'] = $user['email'];
            // 进入首页
            header("Location: ../home_page.php");
        } else {
            $error_tips = "用户不存在或密码错误！";
        }

    } else {
        $error_tips = "用户不存在或密码错误！";
    }



}

?>


<body style="background:  url('images/bg/<?php echo rand(1,9)?>.jpg')">
<div class="page">
    <div class="loginwarrp">
        <div class="logo">管理员登陆</div>
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
</body></html>
