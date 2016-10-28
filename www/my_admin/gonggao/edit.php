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


// 根据id 获取公告
$id = $_GET['id'];
if( !is_numeric($id) ){
  echo "ERROR!";
  exit;
}

// 查询公告信息
$sql = "select * from gonggao where id = $id";


// 查询信息
$result = mysqli_query($link, $sql);
$arr_gonggao = mysqli_fetch_array($result, MYSQL_ASSOC);

if( count($_POST)>0 ){ // 更新公告信息


  if( count($_FILES['avatar']) > 0   ){ // 保存头像图片

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
      move_uploaded_file($tmp_file, "../upload/".$dest_file); // 使用相对地址保存图片
      $avatar_path = "/my_admin/upload/".$dest_file; // 注意，保存的时候，设置从服务器的根目录开始
    }
  }

  if( !$avatar_path ){
    $avatar_path = $arr_gonggao['avatar'];
  }

  $update_sql = "update gonggao set title = '{$_POST['title']}',
                          avatar = '{$avatar_path}',
                          content = '{$_POST['content']}'
            where id = {$_POST['id']} ";

  // 执行sql语句
  $result = mysqli_query($link, $update_sql);

  if($result){
    echo "更新成功！";
    // 直接跳转进入简历列表
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
      <h3>编辑公告</h3>
    </div>
    <div class="public-content-cont">
      <form method="post" action="" name="form1" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $arr_gonggao['id']?>">

        <div class="form-group">
          <label>标题:</label>
          <input type="text"  class="form-input-txt"  name="title" value="<?php echo $arr_gonggao['name']?>" required placeholder="姓名" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>头像:</label>
          <input type="file" name="avatar" />
          <?php
          if ($arr_gonggao['avatar'] ){
            echo "原头像：<a href='{$arr_gonggao['avatar']}' target='_blank'><img src='{$arr_gonggao['avatar']}' width='100px' height='100px'></a>";
          }
          ?>
        </div>

        <div class="form-group">
          <label for="">内容</label>
          <textarea id="editor_id" name="content"  class="form-input-textara" style="width:700px;height:300px;"><?php echo $arr_gonggao['content']?></textarea>
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
<script src="../kingediter/kindeditor-all-min.js"></script>
<script src="../js/laydate.js"></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_id');
    });
</script>
</body>
</html>