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

include_once "../common/checklogin.php";
include_once "../common/db.php";
include_once "../common/common.php";



if( count($_POST)>0 ){ // 更新简历信息

  if( count($_FILES['avatar']) > 0 ){ // 保存图片
    // 检查文件类型
    if(  !in_array($_FILES['avatar']['type'], array('image/jpeg','image/png', 'image/gif')) ){
      echo "只运行上传jpg或png图片， 文件类型不合法，不允许上传";
    }

    // 检查文件大小
    if( $_FILES['pic']['size'] > 5*1024*1024 ){
      echo "文件最大尺寸为5M，不允许上传.";
    }

    // 获取文件后缀名
    $file_ext= pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $tmp_file = $_FILES['avatar']['tmp_name']; // 临时文件
    $dest_file = pathinfo($tmp_file, PATHINFO_FILENAME).".".$file_ext; // 保存的文件名
    //move_uploaded_file($tmp_file, "d:/wamp/www/upload/".$dest_file);  // 使用绝对地址保存图片
    move_uploaded_file($tmp_file, "../../upload/".$dest_file); // 使用相对地址保存图片
    $avatar_path =  MY_DIR . "/upload/".$dest_file; // 注意，保存的时候，设置从服务器的根目录开始
  }


  $current_time = date("Y-m-d H:i:s");
  $sql = "insert into zhuanpan_prizes (name, amount, zhuanpan_index, img, created_at )
         values ( '{$_POST['name']}', '{$_POST['amount']}', '{$_POST['zhuanpan_index']}', '$avatar_path', '{$current_time}'  )";


  // 执行sql语句
  $result = mysqli_query($link, $sql);

  if($result){
    echo "添加成功！";
    header("Location: list.php");
  } else {

    echo "添加失败！";
    echo mysqli_error($link);
    exit;

  }
}


?>



<body marginwidth="0" marginheight="0">
<div class="container">
  <div class="public-nav">您当前的位置：<a href="">管理首页</a></div>
  <div class="public-content">
    <div class="public-content-header">
      <h3>添加</h3>
    </div>
    <div class="public-content-cont">
      <form method="post" action="" name="form1" enctype="multipart/form-data">

        <div class="form-group">
          <label>奖品名称:</label>
          <input type="text" class="form-input-txt" name="name" value="" required placeholder="奖品名称" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>图片:</label>
          <input type="file" name="avatar" />
        </div>
          <div class="form-group">
              <label>奖品数量:</label>
              <input type="text" class="form-input-txt" name="amount" value="" required placeholder="数量" style="width: 150px" />
          </div>
          <div class="form-group">
              <label>转盘位置:</label>
              <input type="text" class="form-input-txt" name="zhuanpan_index" value="" required placeholder="转盘位置" style="width: 150px" />
              <span>说明： 转盘位置为 1 - 12 </span>
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