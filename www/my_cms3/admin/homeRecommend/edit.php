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



// 根据id 获取图片信息
if( $_GET['id']){
  $id = $_GET['id'];
} else {
  $id = $_POST['id'];
}
if( !is_numeric($id) ){
  echo "ERROR!";
  exit;
}

$sql = "select * from home_recommend where id = $id";
$result = mysqli_query($link, $sql);
$arr_recommend = mysqli_fetch_array($result, MYSQL_ASSOC);



if( count($_POST)>0 ){ // 更新


  if( count($_FILES['avatar']) > 0 && $_FILES['avatar']['name']   ){ // 保存头像图片

    $flag = true;

    // 检查文件类型
    if(  !in_array($_FILES['avatar']['type'], array('image/jpeg','image/png', 'image/gif')) ){
      echo "只运行上传jpg或png图片， 文件类型不合法，不允许上传";
      $flag = false;
    }

    // 检查文件大小
    if( $_FILES['pic']['size'] > 3*1024*1024 ){
      echo "文件最大尺寸为3M，不允许上传.";
      $flag = false;
    }

    if ( $flag ){
      // 获取文件后缀名
      $file_ext= pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
      $tmp_file = $_FILES['avatar']['tmp_name']; // 临时文件
      $dest_file = pathinfo($tmp_file, PATHINFO_FILENAME).".".$file_ext; // 保存的文件名
      //move_uploaded_file($tmp_file, "d:/wamp/www/upload/".$dest_file);  // 使用绝对地址保存图片
      move_uploaded_file($tmp_file, "../../upload/".$dest_file); // 使用相对地址保存图片
      $avatar_path =  MY_DIR . "/upload/".$dest_file; // 注意，保存的时候，设置从服务器的根目录开始
    }
  }

  if( !$avatar_path ){
    $avatar_path = $arr_recommend['img'];
  }

  $update_sql = "update home_recommend set title = '{$_POST['title']}',
content = '{$_POST['content']}',
link = '{$_POST['link']}',
                          img = '{$avatar_path}'
            where id = {$_POST['id']} ";

  // 执行sql语句
  $result = mysqli_query($link, $update_sql);

  if($result){
    echo "更新成功！";
    header("Location: list.php");

  } else {
    echo "更新失败！";
  }
}





?>



<body marginwidth="0" marginheight="0">
<div class="container">
  <div class="public-nav">您当前的位置：<a href="">管理首页</a></div>
  <div class="public-content">
    <div class="public-content-header">
      <h3>首页推荐－<?php echo $arr_recommend['type']?></h3>
    </div>
    <div class="public-content-cont">
      <form method="post" action="" name="form1" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $arr_recommend['id']?>">

        <div class="form-group">
          <label>标题:</label>
          <input type="text"  class="form-input-txt"  name="title" value="<?php echo $arr_recommend['title']?>" required placeholder="标题" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>内容:</label>
          <textarea name="content" id="content" rows="5" cols="50"><?php echo $arr_recommend['content']?></textarea>
        </div>
        <div class="form-group">
          <label>链接:</label>
          <input type="text"  class="form-input-txt"  name="link" value="<?php echo $arr_recommend['link']?>" required placeholder="链接" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>图片:</label>
          <input type="file" name="avatar" />
          <?php
          if ($arr_recommend['img'] ){
            echo "原图片：<a href='{$arr_recommend['img']}' target='_blank'><img src='{$arr_recommend['img']}' width='100px' height='100px'></a>";
          }
          ?>
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