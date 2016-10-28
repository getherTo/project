<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form method="post" name="form1">
    操作:<select name="select">
        <option>增</option>
        <option>删</option>
        <option>改</option>
        <option>查</option>
    </select><br><br>
    id：&nbsp;&nbsp;<input type="text" name="id" placeholder=""><br><br>
    姓名：<input type="text" name="name" placeholder=""><br><br>
    手机：<input type="text" name="phone" placeholder=""><br><br>
    性别：<input type="radio" name="sex">男
          <input type="radio" name="sex">女<br><br>
    简介：<textarea>
    </textarea><br><br>
    <input type="submit" value="提交">
    <input type="submit" value="重置">
</form>
?>
</body>
</html>