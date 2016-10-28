<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>新增新闻</title>
</head>
<body>
<?php
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

if( count($_POST)>0 ){
    $current_time = date("Y-m-d H:i:s");
    $sql = "insert into news( category_id, title, content,tag,author,created_at  )
                      values (
                              '{$_POST['id']}',
                              '{$_POST['title']}',
                              '{$_POST['content']}',
                              '{$_POST['tag']}',
                              '{$_POST['author']}',
                              '$current_time' )";
    // 执行sql语句
    $result = mysqli_query($link, $sql);
    if($result){
        echo "添加成功！";
        // 直接跳转进入列表
        header("Location: news_list.php");
    } else {
        echo "添加失败！";
        echo mysqli_error($link);
        exit;
    }
}
//获取所有的新闻分类
$sql  = "select * from news_category ";
$result = mysqli_query($link, $sql);
$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);

?>
<form method="post" action="" name="form1">
    <table>
        <tr>
            <td colspan="2"><h1>新增新闻</h1></td>
        </tr>
        <tr>
            <td><strong>新闻分类:</strong></td>
            <td>
            <select name="name" required>
                <option value="">-请选择-</option>
                <?php
                foreach( $arr_news_category as $val){
                    echo "<option value='{$val['id']}'>{$val['news']}</option>";
                }
                ?>
            </select>
            </td>
        </tr>
        <tr>
            <td><strong>标题:</strong></td>
            <td><input type="text" name="title" required placeholder="标题" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>标签:</strong></td>
            <td><input type="text" name="tag" required placeholder="标签" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>作者:</strong></td>
            <td><input type="text" name="author" required placeholder="作者" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>新闻内容:</strong></td>
            <td><textarea name="content" placeholder="请输入新闻内容" style="width:300px;height: 300px"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
</body>
</html>