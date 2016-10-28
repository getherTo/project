<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="../jQuery/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"></script>
</head>
<body>

<form class="form-group" action="" method="get">
    <table  width="500px" style="margin: 0 auto">
        <tr>
            <td>
                用户ID： <input class="form-control" type="text" id="user_id" name="user_id">
                用户名： <input class="form-control" type="text" id="user_name" name="user_name"></td>
        </tr>
        <tr>
            <td>
                <script class="form-control" cols="10" rows="5" name="assese" id="assese" type="text/plain"></script>
            </td>
        </tr>
        <tr>
            <td>
                <input class="btn-primary btn btn-sm" type="submit" value="提交">
               <input  class="btn-warning btn btn-sm " type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    var ue = UE.getEditor('assese', {
        initialFrameWidth: 640,
        initialFrameHeight: 320,
        toolbars: [
            ['fullscreen', 'source', 'forecolor', 'redo', 'bold']
        ]
    });
    var ue = UE.getEditor('assese');
</script>
<?php

$link = mysqli_connect('localhost','root','','comment');
$sql = "select * from comment where 1 ";
//$link->query("set names utf8");
$arr = mysqli_query($link,$sql);
$final = mysqli_fetch_all($arr,MYSQLI_ASSOC);
//print_r($final);
echo "<table class='table table-bordered' style=' margin:0 auto;width:800px'>";
foreach($final as $var){
    echo "<tr>";
    echo "<td>".$var['id'];
    echo "<td>".$var['user_id'];
    echo "<td>".$var['user_name'];
    echo "<td>".$var['content'];
    echo "<td>".$var['created'];
    echo "<td>".$var['ip'];
    echo "</tr>";
}
echo "</table>";
?>
<?php
$user_id = $_GET['user_id'];
$user_name = $_GET['user_name'];
$content = $_GET['assese'];
$time = date('Y-m-d');
$ip = $_SERVER["REMOTE_ADDR"];
$link = mysqli_connect('localhost','root','','comment');

$add_sql  = "insert into comment (user_id, user_name,content,created,ip)
VALUES ($user_id,$user_name,$content, '{$time}', '{$ip}')";
//$link->query("set names utf8");
$add_arr = mysqli_query($link,$add_sql);
$final_arr = mysqli_fetch_all($add_arr,MYSQLI_ASSOC);
//print_r($final);
echo "<table class='table table-bordered' style=' margin:0 auto;width:800px'>";
foreach($final as $var){
    echo "<tr>";
    echo "<td>".$var['id'];
    echo "<td>".$var['user_id'];
    echo "<td>".$var['user_name'];
    echo "<td>".$var['content'];
    echo "<td>".$var['created'];
    echo "<td>".$var['ip'];
    echo "</tr>";
}
echo "</table>";
?>
</body>
</html>
