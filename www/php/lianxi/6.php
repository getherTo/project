<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

// 获取用户提交的文件
if( count($_FILES) > 0 ){
    // 检查文件类型
    if(  !in_array($_FILES['pic']['type'], array('image/jpeg','image/png', 'image/gif')) ){
        echo "只运行上传jpg或png图片， 文件类型不合法，不允许上传";
    }

    // 检查文件大小
    if( $_FILES['pic']['size'] > 2*1024*1024 ){
        echo "文件最大尺寸为2M，不允许上传.";
    }

    // 获取文件后缀名
    $file_ext= pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
    $tmp_file = $_FILES['pic']['tmp_name']; // 临时文件
    $dest_file = pathinfo($tmp_file, PATHINFO_FILENAME).".".$file_ext; // 保存的文件名
    //move_uploaded_file($tmp_file, "d:/wamp/www/upload/".$dest_file);  // 使用绝对地址保存图片
    move_uploaded_file($tmp_file, "../../upload/".$dest_file); // 使用相对地址保存图片
    echo "<br>上传成功！";
}

?>
<h1>文件上传</h1>
<form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="file" name="pic">
    <input type="submit" value="提交">
</form>
</body>
</html>
