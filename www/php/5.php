<?php
header("Content-type:text/html;charset=utf-8");
$name = "产品";
$name1 = "产品1";
$name2 = "产品2";
$name3 = "产品3";
$name4 = "产品4";

$date = "付款日期";
$date1 = "2016-1-2";
$date2 = "2016-1-3";
$date3 = "2016-1-4";
$date4 = "2016-1-5";

$status ="状态";
$status1 ="已发货";
$status2 ="已发货";
$status3 ="已发货";
$status4 ="已发货";

echo "<table border='1' cellspacing='2' cellpadding='2' align='center' width='700'>
    <tr>
        <td><strong>$name</strong></td>
        <td><strong>$date</strong></td>
        <td><strong>$status</strong></td>
    </tr>
    <tr>
        <td>$name1</td>
        <td>$date1</td>
        <td>$status1</td>
    </tr>
    <tr>
        <td>$name2</td>
        <td>$date2</td>
        <td>$status2</td>
    </tr>
    <tr>
        <td>$name3</td>
        <td>$date3</td>
        <td>$status3</td>
    </tr>
    <tr>
        <td>$name4</td>
        <td>$date4</td>
        <td>$status4</td>
    </tr>
</table>"
?>
