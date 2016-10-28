<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>运算符计算</title>
</head>
<body>
<?php
$a = -100;
$b = 50;
$c =30;
?>
<table border="1" cellspacing="2" cellpadding="2" align="center" width="400">
    <tr>
        <td>运算</td>
        <td>结果</td>
    </tr>
    <tr>
        <td>$a+$b</td>
        <td><?php echo $a+$b ?></td>
    </tr>
    <tr>
        <td>$a-$b</td>
        <td><?php echo $a-$b ?></td>
    </tr>
    <tr>
        <td>$a*$b</td>
        <td><?php echo $a*$b ?></td>
    </tr>
    <tr>
        <td>$a/$b</td>
        <td><?php echo number_format($a/$b,2) ?></td>
    </tr>
    <tr>
        <td>$a%$c</td>
        <td><?php echo $a%$c ?></td>
    </tr>
    <tr>
        <td>$a++</td>
        <td><?php echo $a++.$a ?></td>
    </tr>
    <tr>
        <td>$b--</td>
        <td><?php echo $b-- ?></td>
    </tr>
    <tr>
        <td>++$c</td>
        <td><?php echo ++$c ?></td>
    </tr>
</table>
</body>
</html>