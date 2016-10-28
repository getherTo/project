<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><h2>添加评论</h2></title>
    <script src="../jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"></script>
</head>
<body>
<!--<form action="" method="post">-->
<!--    用户ID： <input type="text"  name="user_id"><br>-->
<!--    用户名：  <input type="text"  name="user_name"><br>-->
<!--    <script id="container" name="container" type="text/plain"></script>-->
<!--    <input type="submit" value="提交">-->
<!--    <input type="reset" value="重置">-->
<!--</form>-->
<div class="guestform">
    <div class="title"><span>我要留言</span></div>
    <form name="guest" method="post" action="" onsubmit="return checkguest();" style="margin:0;">
        <div >称 呼：<input type="text" name="user_name" id="user_name" value="" size="16"/> </div>
        <div >邮 箱：<input type="text" name="mail" id="mail" value="" size="32"/></div>
        <div >Q Q：<input type="text" name="qq" id="qq" value="" size="10"/></div>
        <div >个人网址：<input type="text" name="homepage" id="homepage" value="" size="36"/></div>
        <div >留言内容： </div>
        <div >  <script id="container" name="container" type="text/plain"></script></div>
        <div  style="text-align:center;"><input type="submit" value="提交"/> <input type="reset" value="重置"/></div>
    </form>
    <div class="bottom"><span></span></div>
</div>
<script language='JavaScript' type='text/JavaScript'>
    function checkguest(){
        if (document.guest.gname.value==''){
            alert('温馨提示！称呼不能为空！');
            document.guest.gname.focus();
            return false;
        }
        if (document.guest.content.value==''){
            alert('温馨提示！内容不能为空！');
            document.guest.content.focus();
            return false;
        }
        return true;
    }
</script>
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
$user_name = $_POST['user_name'];
$mail = $_POST['mail'];
$qq = $_POST['qq'];
$homepage = $_POST['homepage'];
$container = $_POST['container'];
$time = date('Y-m-d');
$ip = $_SERVER["REMOTE_ADDR"];
$link = mysqli_connect('localhost','root','','message_board');
$add_sql  = "insert into message_board (user_name, mail,qq,homepage,container,created_at,ip)
VALUES ('{$mail}','{$user_name}','{$qq}','{$homepage}','{$container}', '{$time}', '{$ip}')";
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
$link = mysqli_connect('localhost','root','','message_board');
$sql = "select * from message_board where 1 ";
$arr = mysqli_query($link,$sql);
$final = mysqli_fetch_all($arr,MYSQLI_ASSOC);
?>
<table border="1px solid" cellspacing="1px" width="960px" align="center" class="cv">
    <tr>
        <th>id</th>
        <th>用户名</th>
        <th>邮箱</th>
        <th>Q Q</th>
        <th>个人网页</th>
        <th>留言内容</th>
        <th>评论时间</th>
        <th>用户IP</th>
    </tr>
    <?
    foreach ($final as $var) {
        echo "<tr>";
        echo "<td>{$var['id']}</td>";
        echo "<td>{$var['user_name']}</td>";
        echo "<td>{$var['mail']}</td>";
        echo "<td>{$var['qq']}</td>";
        echo "<td>{$var['homepage']}</td>";
        echo "<td>{$var['container']}</td>";
        echo "<td>{$var['created_at']}</td>";
        echo "<td>{$var['ip']}</td>";
        echo " </tr>";
    }
    ?>
</table>
</body>
</html>