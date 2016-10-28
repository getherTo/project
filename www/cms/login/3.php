<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><h2>添加评论</h2></title>
    <script src="jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"></script>
</head>
<body>
<form action="" method="post">
    用户ID： <input type="text"  name="user_id"><br>
    用户名：  <input type="text"  name="user_name"><br>
    <script id="container" name="container" type="text/plain"></script>
    <input type="submit" value="提交">
    <input type="reset" value="重置">
</form>
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        initialFrameWidth: 640,
        initialFrameHeight: 320,
        toolbars: [
            ['fullscreen', 'source', 'forecolor', 'redo', 'bold']
        ]
    });
    var ue = UE.getEditor('container');
</script>
<?php
header("Content-type: text/html; charset=utf-8");
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$content = $_POST['container'];
$time = date('Y-m-d');
$ip = $_SERVER["REMOTE_ADDR"];
$link = mysqli_connect('localhost','root','','comment');
$add_sql  = "insert into comment (user_id, user_name,content,created_at,ip)
VALUES ('{$user_id}','{$user_name}','{$content}', '{$time}', '{$ip}')";
//$result = mysqli_query($link, $add_sql);
//if($result){
//    echo "添加成功！";
//} else {
//    echo "添加失败！";
//    echo mysqli_error($link);
//    exit;
//}
?>
<?php
header("Content-type: text/html; charset=utf-8");
$link = mysqli_connect('localhost','root','','comment');
$sql = "select * from comment where 1 ";
$arr = mysqli_query($link,$sql);
$final = mysqli_fetch_all($arr,MYSQLI_ASSOC);
?>
<table border="1px solid" cellspacing="1px" width="960px" align="center" class="cv">
    <tr>
        <th>id</th>
        <th>用户ID</th>
        <th>用户名</th>
        <th>评论内容</th>
        <th>评论时间</th>
        <th>用户IP</th>
    </tr>
    <?
    foreach ($final as $var) {
        echo "<tr>";
        echo "<td>{$var['id']}</td>";
        echo "<td>{$var['user_id']}</td>";
        echo "<td>{$var['user_name']}</td>";
        echo "<td>{$var['content']}</td>";
        echo "<td>{$var['created_at']}</td>";
        echo "<td>{$var['ip']}</td>";
        echo " </tr>";
    }
    ?>
</table>
</body>
</html>