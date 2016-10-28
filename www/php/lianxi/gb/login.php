<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <link href="/html/bootstrap-3.3.5/dist/css/bootstrap.css" rel="stylesheet">

    <link href="/html/bootstrap-3.3.7/dist/css/normalize.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/html/bootstrap-3.3.7/dist/js/html5shiv.js"></script>
    <script src="/html/bootstrap-3.3.7/dist/js/respond.min.js"></script>
    <![endif]-->
</head>


<body>

<?php

if ( count($_POST) > 0 ) { // 判断是否提交表单

//    include_once "common.php";
//
//    // 写入cookie
//    // 加密用户名
//    $user_name = authcode($_POST['user_name'], "ENCODE", "key");
//    setcookie("user_name", $user_name, time()+ 86400, "/");
//    setcookie("email", $_POST['email'], time()+ 86400, "/");
//    setcookie("is_login",true, time()+ 86400, "/");
//    header("Location: list.php");
    session_start();
    $_SESSION['user_name']=$_POST['user_name'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    header("Location: list.php");
 //   unset($_SESSION);
   // print_r($_SESSION);
}

?>

<div style="padding: 20px">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" style="border: 2px solid darkcyan">
        <h2>cookie练习</h2>
        <form method="post" name="register" action="login.php">
            <div class="form-group">
                <label for="user_name">用户名</label>
                <input type="text" class="form-control" id="user_name" name="user_name"
                       placeholder = "请输入姓名">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control" id="email" name="email"
                       placeholder = "请输入您的email">
            </div>

            <div class="form-group">
                <label for="email">密码</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder = "请输入您的密码">
            </div>
            <div class="form-group">
                <button type="submit" class="btn-success  btn-lg btn-block ">提交</button>
            </div>
            <div class="form-group">
                <button type="reset" class="btn-primary btn-lg btn-block ">取消</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>