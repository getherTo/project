<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>简历展示</title>

</head>
<body>

<h1>简历展示</h1>


<?php

print_r($_POST);  // 调试语句，打印出页面所有的post变量
echo "<p>姓名:".$_POST["name"];"</p>";
echo "<p>性别:".$_POST["sex"];"</p>";
echo "<p>出生年月:" . $_POST["yr"]."年". $_POST["mh"]."月". $_POST["day"]."日";"</p>";
echo "<p>身份证号码:".$_POST["card"];"</p>";
echo "<p>民族:".$_POST["national"];"</p>";
echo "<p>政治面貌:".$_POST["zhengzhi"];"</p>";
echo "<p>婚姻状况:".$_POST["marriage"];"</p>";
echo "<p>健康状况:".$_POST["health"];"</p>";
echo "<p>身高:".$_POST["height"];"</p>";
echo "<p>户口所在地:".$_POST["registered"];"</p>";
echo "<p>专业:".$_POST["major"];"</p>";
echo "<p>学历:".$_POST["edu"];"</p>";
echo "<p>毕业院校:".$_POST["graduate"];"</p>";
echo "<p>毕业时间:". $_POST["ye"]."年". $_POST["mo"]."月";"</p>";
echo "<p>技术职称:".$_POST["te"];"</p>";
echo "<p>教育经历:". $_POST["year"]."年". $_POST["month"]."月到". $_POST["ya"]."年". $_POST["mth"]."月";"</p>";
echo "<p>在何单位或学校:".$_POST["educations"];"</p>";
echo "<p>人生经历:".$_POST["miaoshu"];"</p>";
echo "<p>业务专长:".$_POST["zhuanchang"];"</p>";
echo "<p>通讯地址:".$_POST["communication"];"</p>";
echo "<p>邮政编码:".$_POST["postcode"];"</p>";
echo "<p>手机号:".$_POST["phone"];"</p>";
echo "<p>qq号:".$_POST["qq"];"</p>";
?>
</body>
</html>