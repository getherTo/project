<?php
if (count($_POST) > 0) {
    $sql = "insert into course_name(name,typeid,summary) values ('{$_POST['name']}', '{$_POST['typeid']}', '{$_POST['summary']}')";
}
//echo $sql;
//连接数据库
header("content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit;
}
//选择数据库
$db_selected = mysqli_select_db($link, 'course');

if (!$db_selected) {
    echo "<br>select db error!";
    exit;
}
//设置字符集为utf8
$link->query("set names utf8");
$result = mysqli_query($link, $sql);
if ($result) {
    echo "课程添加成功！";
} else {
    echo "课程添加失败！";
}
?>
<form name="form" action="" method="post">
    <table align="center">
        <tr>
            <th colspan="2">新增课程</th>
        </tr>
        <tr>
            <th>课程名称</th>
            <td><input type="text" name="name" placeholder="新增课程"/></td>
        </tr>
        <tr>
            <th>课程类型id</th>
            <td><input type="text" name="typeid" placeholder="课程类型id"/></td>
        </tr>
        <tr>
            <th>课程简介</th>
            <td><textarea cols="30px" rows="10px" name="summary" placeholder="课程简介"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="点击提交"></td>
        </tr>
    </table>
</form>
