<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}
$db_selected = mysqli_select_db($link,'zuoye');
if(!$db_selected){
    echo "selected db error";
    exit();
}
if( count($_POST)>0 ){
    $current_time = date("Y-m-d H:i:s");
    $sql = "insert into press(news_type,title, details,writer,creation_time)
                      values (
                              '{$_POST['news_type']}',
                              '{$_POST['title']}',
                              '{$_POST['details']}',
                              '{$_POST['writer']}',
                              '$current_time' )";
    // 执行sql语句
    $result = mysqli_query($link, $sql);
    if($result){
        echo "添加成功！";
        // 直接跳转进入列表
        header("Location: 2.php");
    } else {
        echo "添加失败！";
        echo mysqli_error($link);
        exit;
    }
}
//获取所有的新闻分类
$sql  = "select * from press_type ";
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
                <select name="news_type" required>
                    <option value="">-请选择-</option>
                    <?php
                    foreach( $arr_news_category as $val){
                        echo "<option value='{$val['id']}'>{$val['press']}</option>";
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
            <td><strong>作者:</strong></td>
            <td><input type="text" name="writer" required placeholder="作者" style="width: 150px" /></td>
        </tr>
        <tr>
            <td><strong>新闻内容:</strong></td>
            <td><textarea name="details" placeholder="请输入新闻内容" style="width:300px;height: 300px"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
</body>
</html>

</body>
</html>