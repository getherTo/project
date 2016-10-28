<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>新增新闻分类</title>
</head>
<body>

<?php

include_once "../common/db.php";

if( count($_POST)>0 ){

    $sql = "insert into news_category ( name  ) values ( '{$_POST['name']}')";

    // 执行sql语句
    $result = mysqli_query($link, $sql);

    if($result){
        echo "添加成功！";
        // 直接跳转进入列表
        header("Location: news_category_list.php");
    } else {

        echo "添加失败！";
        echo mysqli_error($link);
        exit;

    }

}


?>


<form method="post" action="" name="form1">
    <table>
        <tr>
            <td colspan="2"><h1>新增新闻分类</h1></td>
        </tr>
        <tr>
            <td><strong>分类名称:</strong></td>
            <td><input type="text" name="name" required placeholder="分类名称" style="width: 150px" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
</body>
</html>