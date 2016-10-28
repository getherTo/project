<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>新增简历信息</title>
</head>
<body>

<?php

if( count($_POST)>0 ){

    $current_time = date("Y-m-d H:i:s");
    $sql = "insert into cv ( name, sex, city, height, weight, birthday, mobile, created_at )
         values ( '{$_POST['name']}','{$_POST['sex']}','{$_POST['city']}','{$_POST['height']}','{$_POST['weight']}','{$_POST['birthday']}','{$_POST['mobile']}', '{$current_time}'  )";

    // 连接mysql数据库
    $link = mysqli_connect('localhost', 'root', '');
    if (!$link) {
        echo "connect mysql error!";
        exit();
    }

     // 选中数据库 my_db为数据库的名字
    $db_selected = mysqli_select_db($link, 'fei');
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


<form method="post" action="" name="form1">
    <table>
        <tr>
            <td colspan="2"><h1>新增简历信息</h1></td>
        </tr>
        <tr>
            <td><strong>姓名:</strong></td>
            <td><input type="text" name="name" required placeholder="姓名" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>性别:</strong></td>
            <td>
                <label><input type="radio" name="sex" value="男">男</label>
                <label><input type="radio" name="sex" value="女">女</label>
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