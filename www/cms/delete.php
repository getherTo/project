<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','','message_board');
$sql = "select * from message_board where 1 ";
$arr = mysqli_query($link,$sql);
$final = mysqli_fetch_all($arr,MYSQLI_ASSOC);

//print_r($final);
//exit;
?>
<script>
    function del( id ){
        if( confirm("您确定要删除此新闻吗?") ){
            document.location.href = "delete_book.php?id=" + id ;
        }
    }
</script>
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
            <th>编辑</th>
        </tr>
    <?
    if ($final>0){
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
        ?>
        <td><a href="javascript:;" onclick=del({$var['id']})>删除</a>
        </td>
        <?php
        echo " </tr>";
    }
    }
?>
</body>
</html>