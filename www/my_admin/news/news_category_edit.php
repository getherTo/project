<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>编辑分类信息</title>
</head>
<body>

<?php

// 根据id 获取分类信息
$id = $_GET['id'];
if( !is_numeric($id) ){
    echo "ERROR!";
    exit;
}

// 查询简历信息
$sql = "select * from news_category where id = $id";

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


if( count($_POST)>0 ){ // 更新分类信息

    $update_sql = "update news_category set name = '{$_POST['name']}'
            where id = {$_POST['id']} ";

    // 执行sql语句
    $result = mysqli_query($link, $update_sql);

    if($result){
        echo "更新成功！";
        // 直接跳转进入简历列表
        header("Location: news_category_list.php");

    } else {
        echo "更新失败！";
    }
}


// 查询信息
$result = mysqli_query($link, $sql);
$arr_news_category = mysqli_fetch_array($result, MYSQL_ASSOC);

?>


<form method="post" action="" name="form1">
    <input type="hidden" name="id" value="<?php echo $arr_news_category['id']?>">
    <table>
        <tr>
            <td colspan="2"><h1>编辑分类信息</h1></td>
        </tr>
        <tr>
            <td><strong>分类名称:</strong></td>
            <td><input type="text" name="name" value="<?php echo $arr_news_category['name']?>" required placeholder="姓名" style="width: 150px" /></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
</body>
</html>