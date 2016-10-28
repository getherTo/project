<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form method="post" name="form1" enctype="multipart/form-data" action="">
    <input type="file" name="pic">
    <input type="submit" value="提交">
</form>
<?php
print_r($_FILES);
?>
</body>
</html>