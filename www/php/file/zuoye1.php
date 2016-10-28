<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/25
 * Time: 16:53
 */
header("Content-type:text/html;charset=utf-8");
$a = file_get_contents("areaCode.txt");
$b = explode("\r\n", $a);
?>
<table width='400px' border='1px' align='center'>
        <tr>
            <th>省市信息</th>
            <th>编码</th>
        </tr>
    <?php
foreach ($b as $c) {
    echo "<tr>";
    $d = explode(" ", $c);
    echo "<td>";
    echo $d[1];
    echo "</td>";
    echo "<td>";
    echo $d[0];
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>
