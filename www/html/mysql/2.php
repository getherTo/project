<html>
<head>
    <title>编辑课程类别</title>
</head>
<?php
header("content-type:tex/html;charset=utf-8");
// 根据课程id 获取课程类别信息
$id = $_GET['id'];
if (!is_numeric($id)) {
    echo "error!";
    exit;
}
//查询课程类别信息
$sql = "select * from course_name where id = $id";
//连接数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit;
}
//选择数据库
$db_selected = mysqli_select_db($link, 'course');

if (!$db_selected) {
    echo "select db error!";
    exit;
}
//设定字符集utf8
$link->query("set names utf8");

//更新课程类别信息
if (count($_POST) > 0) {
    $update_sql = "update course_name set name='{$_POST['name']}',typeid={$_POST['typeid']},summary='{$_POST['summary']}' where id = {$_POST['id']}";
}
//执行sql语句
$result = mysqli_query($link, $update_sql);
if ($result) {
    echo "课程类别更新成功！";
} else {
    echo "课程类别更新失败！";
}
//查询课程类别信息
$result = mysqli_query($link, $sql);
$arr = mysqli_fetch_array($result, MYSQL_ASSOC);
?>

<form name="form1" action="" method="post">
    <input type="hidden" name="id" value="<?php echo $arr['id'] ?>">
    <table>
        <tr>
            <th colspan="2">编辑课程类别信息</th>
        </tr>
        <tr>
            <th>更新课程名称</th>
            <td><input type="text" name="name" placeholder="课程名称"/></td>
        </tr>
        <tr>
            <th>更新课程类型id</th>
            <td><input type="text" name="typeid" placeholder="课程类型id"/></td>
        </tr>
        <tr>
            <th>更新课程简介</th>
            <td><textarea cols="30px" rows="10px" name="summary" placeholder="课程简介"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="点击提交"></td>
        </tr>
    </table>
</form>
