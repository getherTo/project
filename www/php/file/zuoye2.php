<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form method="get" name="form1">
    <input type="text" name="id" placeholder="请输入身份证号码" required="">
    <input type="submit" name="" value="提交">
</form>
<?php
echo "您的信息为：";
$a = file_get_contents("areaCode.txt");
$b = explode("\r\n", $a);
foreach ($b as $c) {
    $d = explode(" ", $c);//print_r($d);
    $d[$d[0]] = $d[1];// print_r($d);
$id = $_GET['id'];
    $area = mb_substr($id,0,2,'utf-8');
    echo $d[$area]."\r\n";
    $area = mb_substr($id,0,4,'utf-8');
    echo $d[$area]."\r\n";
$area = mb_substr($id,0,6,'utf-8');
    echo $d[$area];
}


//echo$d[$area];
?>
</body>
</html>