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



if( count($_POST)>0 ){ // 更新分类信息

  $update_sql = "update news set category_id = '{$_POST['category_id']}',
                                   title = '{$_POST['title']}',
                                   content = '{$_POST['content']}',
                                   tag = '{$_POST['tag']}',
                                   author = '{$_POST['author']}'
            where id = {$_POST['id']} ";

  // 执行sql语句
  $result = mysqli_query($link, $update_sql);

  if($result){
    echo "更新成功！";
    // 直接跳转进入简历列表
    header("Location: news_list.php");

  } else {
    echo "更新失败！";
  }
}



// 根据id 获取用户信息
$id = $_GET['id'];
if( !is_numeric($id) ){
  echo "ERROR!";
  exit;
}

// 查询信息
$sql = "select * from user  where id = $id";
$result = mysqli_query($link, $sql);
$arr_user = mysqli_fetch_array($result, MYSQL_ASSOC);


if( count($_POST)>0 ){

  /*
   *    $current_time = date("Y-m-d H:i:s");
    // 注册用户信息
    $sql = "insert into user ( user_name, password, salt, email, mobile, ip , created_at )
   */


  $sql_password = "";
  if( $_POST['password'] ){
    $salt = substr(md5(time() . rand(1000, 9999)), 0, 10);
    // 生成一个10位的随机数，做为密码加密的盐，保证密码的安全性
    // 将用户输入的密码和satl字符串进行连接，在加密，保证密码的安全性
    $password = md5($_POST['password'] . $salt);
    $sql_password = " , salt = '$salt', password = '{$password}' ";
  }


  $current_time = date("Y-m-d H:i:s");
  $update_sql = "update user set user_name = '{$_POST['user_name']}',
                          email = '{$_POST['email']}',
                          mobile = '{$_POST['mobile']}',
                          created_at = '{$current_time}' " . $sql_password ."
                  where id = {$_POST['id']} ";



  // 执行sql语句
  $result = mysqli_query($link, $update_sql);

  if($result){
    echo "更新成功！";
    // 直接跳转进入列表
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
      <h3>添加用户</h3>
    </div>
    <div class="public-content-cont">
      <form method="post" action="" name="form1">
        <input type="hidden" name="id" value="<?php echo $arr_user['id'];?>">
        <div class="form-group">
          <label for="">用户名</label>
          <input class="form-input-txt" type="text" name="user_name" value="<?php echo $arr_user['user_name'];?>" required/>
        </div>

        <div class="form-group">
          <label for="">Email</label>
          <input class="form-input-txt" type="text" name="email" value="<?php echo $arr_user['email'];?>" required/>
        </div>

        <div class="form-group">
          <label for="">手机</label>
          <input class="form-input-txt" type="text" name="mobile" value="<?php echo $arr_user['mobile'];?>" required/>
        </div>
        <div class="form-group">
          <label for="">密码</label>
          <input class="form-input-txt" type="password" name="password" value=""/>
          <span>留空则保留原密码</span>
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