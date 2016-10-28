<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <link href="/html/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">

    <link href="/html/bootstrap-3.3.7/dist/css/normalize.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/html/bootstrap-3.3.7/dist/js/html5shiv.js"></script>
    <script src="/html/bootstrap-3.3.7/dist/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<?php

session_start();
//include_once "common.php";

// 获取Cookie信息
if( $_SESSION ){
    echo "登录成功！";

    // 获取并解密用户
 //   $user_name = authcode($_COOKIE['user_name'], "DECODE", "key");
    echo "欢迎 ".$_POST['user_name'];
    echo "|";
    echo "<a href='login.php'>退出</a>";
} else {
    echo "<a href='login.php'>登录</a>";
}


?>

</body>
</html>
