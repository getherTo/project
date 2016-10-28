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



if( count($_POST)>0 ){ // 更新简历信息


  if( count($_FILES['avatar']) > 0 ){ // 保存头像图片
    // 检查文件类型
    if(  !in_array($_FILES['avatar']['type'], array('image/jpeg','image/png', 'image/gif')) ){
      echo "只运行上传jpg或png图片， 文件类型不合法，不允许上传";
    }

    // 检查文件大小
    if( $_FILES['pic']['size'] > 3*1024*1024 ){
      echo "文件最大尺寸为3M，不允许上传.";
    }

    // 获取文件后缀名
    $file_ext= pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $tmp_file = $_FILES['avatar']['tmp_name']; // 临时文件
    $dest_file = pathinfo($tmp_file, PATHINFO_FILENAME).".".$file_ext; // 保存的文件名
    //move_uploaded_file($tmp_file, "d:/wamp/www/upload/".$dest_file);  // 使用绝对地址保存图片
    move_uploaded_file($tmp_file, "../upload/".$dest_file); // 使用相对地址保存图片
    $avatar_path = "/my_admin/upload/".$dest_file; // 注意，保存的时候，设置从服务器的根目录开始
  }



  $current_time = date("Y-m-d H:i:s");
  $sql = "insert into cv ( name, avatar,  gender, city, height, weight, birthday, mobile, created_at )
         values ( '{$_POST['name']}', '$avatar_path', '{$_POST['gender']}','{$_POST['city']}','{$_POST['height']}','{$_POST['weight']}','{$_POST['birthday']}','{$_POST['mobile']}', '{$current_time}'  )";


  // 连接mysql数据库
  $link = mysqli_connect('localhost', 'root', '');
  if (!$link) {
    echo "connect mysql error!";
    exit();
  }

  // 选中数据库 my_db为数据库的名字
  $db_selected = mysqli_select_db($link, 'my_db');
  if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
  }

  // 设置mysql字符集 为 utf8
  $link->query("set names utf8");


  // 执行sql语句
  $result = mysqli_query($link, $sql);

  if($result){
    echo "添加简历成功！";
    // 直接跳转进入简历列表
    header("Location: list.php");
  } else {

    echo "添加简历失败！";
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
      <h3>添加简历</h3>
    </div>
    <div class="public-content-cont">
      <form method="post" action="" name="form1" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $arr_cv['id']?>">

        <div class="form-group">
          <label>姓名:</label>
          <input type="text" class="form-input-txt" name="name" value="<?php echo $arr_cv['name']?>" required placeholder="姓名" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>头像:</label>
          <input type="file" name="avatar" />
          <?php
          if ($arr_cv['avatar'] ){
            echo "原头像：<a href='{$arr_cv['avatar']}' target='_blank'><img src='{$arr_cv['avatar']}' width='100px' height='100px'></a>";
          }
          ?>
        </div>
        <div class="form-group">
          <label>性别:</strong></label>
          <input type="radio" name="gender" value="男" <?=($arr_cv['gender']=="男")?"checked":""?> >男
          <input type="radio" name="gender" value="女" <?=($arr_cv['gender']=="女")?"checked":""?>>女
          </td>
        </div>
        <div class="form-group">
          <label>城市:</label>
          <select name="city" class="form-input-txt">
            <option value="0">-请选择-</option>
            <option value="亳州" <?=($arr_cv['city']=="亳州")?"selected":""?> >-亳州-</option>
            <option value="六安" <?=($arr_cv['city']=="六安")?"selected":""?>>-六安-</option>
            <option value="合肥" <?=($arr_cv['city']=="合肥")?"selected":""?>>-合肥-</option>
            <option value="安庆" <?=($arr_cv['city']=="安庆")?"selected":""?>>-安庆-</option>
            <option value="淮南" <?=($arr_cv['city']=="淮南")?"selected":""?>>-淮南-</option>
            <option value="芜湖" <?=($arr_cv['city']=="芜湖")?"selected":""?>>-芜湖-</option>
            <option value="马鞍山" <?=($arr_cv['city']=="马鞍山")?"selected":""?>>-马鞍山-</option>
            <option value="阜阳" <?=($arr_cv['city']=="阜阳")?"selected":""?>>-阜阳-</option>
          </select>
        </div>
        <div class="form-group">
          <label>身高:</strong></label>
          <td><input type="text" class="form-input-txt" name="height" value="<?php echo $arr_cv['height']?>" required placeholder="身高（单位 厘米）" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>体重:</strong></label>
          <input type="text" class="form-input-txt" name="weight"  value="<?php echo $arr_cv['weight']?>" required placeholder="体重（单位 公斤）" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>出生日期:</label>
          <input type="text" class="form-input-txt" name="birthday"  value="<?php echo $arr_cv['birthday']?>" required placeholder="出生日期(格式 年-月-日)" style="width: 150px" />
        </div>
        <div class="form-group">
          <label>手机:</label>
          <input type="text" class="form-input-txt" name="mobile" value="<?php echo $arr_cv['mobile']?>" required placeholder="手机号码" style="width: 150px" />
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