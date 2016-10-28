<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><h2>留言板</h2></title>
    <script src="jquery.js"></script>
</head>
<body>
    <span>我要留言</span>
    <form name="guest" method="post" action="" onsubmit="return checkguest();" style="margin:0;">
        称 呼：<input type="text" name="user_name" id="user_name" value="" size="16"/> <br>
        邮 箱：<input type="text" name="mail" id="mail" value="" size="32"/><br>
        Q Q：<input type="text" name="qq" id="qq" value="" size="10"/><br>
        个人网址：<input type="text" name="homepage" id="homepage" value="" size="36"/><br>
        留言内容： <br>
        <textarea name="content" id="content" rows="10" cols="80"></textarea><br>
        <input type="submit" value="提交"/> <input type="reset" value="重置"/>   <a  href="../home_page.php" style="text-decoration: none"><p style="font-size: 12px">返回主页</p></a>
    </form>
<script language='JavaScript' type='text/JavaScript'>
    function checkguest(){
        if (document.guest.user_name.value==''){
            alert('温馨提示！称呼不能为空！');
            document.guest.user_name.focus();
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
<?php
$link = mysqli_connect('localhost','root','','message_board');
if( count($_POST) >0 ){
    $user_name = $_POST['user_name'];
    $mail = $_POST['mail'];
    $qq = $_POST['qq'];
    $homepage = $_POST['homepage'];
    $content = $_POST['content'];
    $time = date('Y-m-d h:i:s');
    $ip = $_SERVER["REMOTE_ADDR"];
    $link = mysqli_connect('localhost','root','','message_board');
    $add_sql  = "insert into message_board (user_name, mail,qq,homepage,content,created_at,ip)
VALUES ('{$mail}','{$user_name}','{$qq}','{$homepage}','{$content}', '{$time}', '{$ip}')";
    $result = mysqli_query($link, $add_sql);
}
//if($result){
//    echo "添加成功！";
//} else {
//    echo "添加失败！";
//    echo mysqli_error($link);
//    exit;
//}
?>
<?php
$sql = "select * from message_board where 1 ";
$arr = mysqli_query($link,$sql);
$final = mysqli_fetch_all($arr,MYSQLI_ASSOC);
?>
<table style="text-align: center" border="0px" cellspacing="0px" width="960px" class="cv">
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
        echo "<td>{$var['content']}</td>";
        echo "<td>{$var['created_at']}</td>";
        echo "<td>{$var['ip']}</td>";
        echo " </tr>";
    }
    ?>
</table>
</body>
</html>
