<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>编辑新闻</title>
</head>
<body>

<?php

// 根据id 获取新闻
$id = $_GET['id'];
if( !is_numeric($id) ){
    echo "ERROR!";
    exit;
}

// 查询简历信息
$sql = "select * from news  where id = $id";

// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}

// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'news');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}

// 设置mysql字符集 为 utf8
$link->query("set names utf8");


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


// 查询信息
$result = mysqli_query($link, $sql);
$arr_news = mysqli_fetch_array($result, MYSQL_ASSOC);


//获取所有的新闻分类
$sql  = "select * from news_category ";
$result = mysqli_query($link, $sql);
$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);



?>


<form method="post" action="" name="form1">
    <input type="hidden" name="id" value="<?php echo $arr_news['id']?>">
    <table>
        <tr>
            <td colspan="2"><h1>编辑新闻</h1></td>
        </tr>
        <tr>
            <td><strong>新闻分类:</strong></td>
            <td>
                <select name="category_id" required>
                    <option value="">-请选择-</option>
                    <?php
                    foreach( $arr_news_category as $val){
                        $str_selected = "";
                        if( $arr_news['category_id'] == $val['id']){
                            $str_selected = "selected";
                        }
                        echo "<option value='{$val['id']}' $str_selected>{$val['name']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>


        <tr>
            <td><strong>标题:</strong></td>
            <td><input type="text" name="title" value="<?php echo $arr_news['title']?>" required placeholder="标题" style="width: 150px" /></td>
        </tr>

        <tr>
            <td><strong>标签:</strong></td>
            <td><input type="text" name="tag" value="<?php echo $arr_news['tag']?>" required placeholder="标签" style="width: 150px" /></td>
        </tr>

        <tr>
            <td><strong>作者:</strong></td>
            <td><input type="text" name="author" value="<?php echo $arr_news['author']?>" required placeholder="作者" style="width: 150px" /></td>
        </tr>

        <tr>
            <td><strong>新闻内容:</strong></td>
            <td><textarea name="content" placeholder="请输入新闻内容" style="width:300px;height: 300px"><?php echo $arr_news['content']?></textarea></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
</body>
</html>