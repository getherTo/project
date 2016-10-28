<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>数组循环练习</title>


    <style>
    td,th{
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }
    .red{
        color: red;
    }
    .red{
        color: red;
    }
    .orange{
        color: orange;
    }
    .yellow{
        color: yellow;
    }
    .green{
        color: green;
    }
    .blue{
        color: blue;
    }
    .cyan{
        color: indigo;
    }
    .purple{
        color: purple;
    }
</style>
</head>
<?php
$name = ['red'=>'红色','orange'=>'橙色','yellow'=>'黄色','green'=>'绿色','cyan'=>'青色','blue'=>'蓝色','purple'=>'紫色'];
echo "<table style='text-align: center' border='1' width='400'align='center'>";
echo "<tr>";
echo "<td>颜色</td>";
echo "<td>英文</td>";
echo "</tr>";
foreach ($name as $key=>$var){
    echo "<tr class='$key'>";
    echo "<td>$var</td>";
    echo "<td>$key</td>";
    echo "</tr>";
};
echo "</table>";
?>
</body>
</html>
