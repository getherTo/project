<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--1. /thinkphp_3.2.3 <br>-->
<!--2. /thinkphp_3.2.3/index.php <br>-->
<!--3. /thinkphp_3.2.3/index.php/Home <br>-->
<!--4. /thinkphp_3.2.3/index.php/Home/Index  <br>-->
<!--5. /thinkphp_3.2.3/index.php/Home/Index/hello <br>-->
<!--6. /thinkphp_3.2.3/home/index/hello <br>-->
<!--7. /thinkphp_3.2.3/Public <br>-->
<h1>管理员列表</h1>
<table border="1" width="600px">
    <tr>
        <th>用户Id</th>
        <th>标题</th>
        <th>内容</th>
        <th>时间</th>
    </tr>
    <?php if(is_array($think_forms)): $i = 0; $__LIST__ = $think_forms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$think_form): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($think_form["id"]); ?></td>
            <td><?php echo ($think_form["title"]); ?></td>
            <td><?php echo ($think_form["content"]); ?></td>
            <td><?php echo ($think_form["created_at"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>

</body>
</html>