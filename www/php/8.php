<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/15
 * Time: 19:24
 */
header("Content-type:text/html;charset=utf-8");
$title = "课程表";
$time = "时间";
$classing = "上课";
$Monday = "星期一";
$Tuesday = "星期二";
$Wednesday = "星期三";
$Thursday = "星期四";
$Friday = "星期五";
$Saturday = "星期六";
$Sunday = "星期天";
$am = "上午";
$bm = "下午";
$chinese = "数学";
$math = "语文";
$english = "英语";
$physical = "历史";
$chemical = "物理";
$sports = "体育";
$rest = "休息";
echo "<style>
td{
    text-align:center;
    }
</style>";
echo "<table border='1px'  align='center' width='800px' cellspacing='1' cellpadding='5'>
    <caption><h1>$title</h1></caption>

    <tr>
        <td>$time</td>
        <td colspan='5'>$classing</td>
        <td colspan='2'>$rest</td>
    </tr>

    <tr>
        <th>$week</th>
        <th>$Monday</th>
        <th>$Tuesday</th>
        <th>$Wednesday</th>
        <th>$Thursday</th>
        <th>$Friday</th>
        <th>$Saturday</th>
        <th>$Sunday</th>
    </tr>

    <tr>
        <td rowspan='4'>$am</td>
        <td>$chinese</td>
        <td>$math</td>
        <td>$english</td>
        <td>$chemical</td>
        <td>$physical</td>
        <td>$sports</td>
        <td rowspan='4'>$rest</td>
    </tr>

    <tr>
        <td>$chinese</td>
        <td>$chinese</td>
        <td>$math</td>
        <td>$english</td>
        <td>$chemical</td>
        <td>$physical</td>
    </tr>

    <tr>
        <td>$chinese</td>
        <td>$chinese</td>
        <td>$math</td>
        <td>$english</td>
        <td>$chemical</td>
        <td>$physical</td>
    </tr>

    <tr>
        <td>$chinese</td>
        <td>$chinese</td>
        <td>$math</td>
        <td>$english</td>
        <td>$chemical</td>
        <td>$physical</td>
    </tr>
    <tr/>
    <tr>
        <td rowspan='2'>$bm</td>
        <td>$chinese</td>
        <td>$math</td>
        <td>$english</td>
        <td>$chemical</td>
        <td>$physical</td>
        <td>$sports</td>
        <td rowspan='2'>$rest</td>
    </tr>

    <tr>
        <td>$chinese</td>
        <td>$math</td>
        <td>$english</td>
        <td>$chemical</td>
        <td>$physical</td>
        <td>$sports</td>
    </tr>
</table>"
    ?>