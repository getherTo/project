<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>用户列表</h1>
<table border="1" width="1000px">
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>用户Email</th>
    </tr>
    <?php if(is_array($arr_users)): $i = 0; $__LIST__ = $arr_users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($user["id"]); ?></td>
            <td><?php echo ($user["user_name"]); ?></td>
            <td><?php echo ($user["email"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</body>
</html>