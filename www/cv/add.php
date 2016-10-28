<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>新增简历信息</title>
</head>
<body>

<?php

if( count($_POST)>0 ){

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
        $avatar_path = "/upload/".$dest_file; // 注意，保存的时候，设置从服务器的根目录开始
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


<form method="post" action="" name="form1" enctype="multipart/form-data">
    <table>
        <tr>
            <td colspan="2"><h1>新增简历信息</h1></td>
        </tr>
        <tr>
            <td><strong>姓名:</strong></td>
            <td><input type="text" name="name" required placeholder="姓名" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>头像:</strong></td>
            <td><input type="file" name="avatar" /></td>
        </tr>
        <tr>
            <td><strong>性别:</strong></td>
            <td>
                <label><input type="radio" name="gender" value="男">男</label>
                <label><input type="radio" name="gender" value="女">女</label>
            </td>
        </tr>
        <tr>
            <td><strong>城市:</strong></td>
            <td>
                <select name="city">
                    <option value="0">-请选择-</option>
                    <option value="亳州">-亳州-</option>
                    <option value="六安">-六安-</option>
                    <option value="合肥">-合肥-</option>
                    <option value="安庆">-安庆-</option>
                    <option value="淮南">-淮南-</option>
                    <option value="芜湖">-芜湖-</option>
                    <option value="马鞍山">-马鞍山-</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><strong>身高:</strong></td>
            <td><input type="text" name="height" required placeholder="身高（单位 厘米）" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>体重:</strong></td>
            <td><input type="text" name="weight" required placeholder="体重（单位 公斤）" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>出生日期:</strong></td>
            <td><input type="text" name="birthday" required placeholder="出生日期(格式 年-月-日)" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>手机:</strong></td>
            <td><input type="text" name="mobile" required placeholder="手机号码" style="width: 150px" /></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
</body>
</html>