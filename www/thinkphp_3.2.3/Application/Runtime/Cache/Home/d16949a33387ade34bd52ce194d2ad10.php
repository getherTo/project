<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
   
</head>
<body>
<form method="get" action="<?php echo U(index/IDcard);?>">
    <table align="center">
        <tr>
        <td>请输入你的身份证号码：</td>
        <td><input type="text" name="name" id="name"  required=""></td>
        <td><input type="submit" value="查询"></td>
        </tr>
    </table>
</form>
</body>
</html>