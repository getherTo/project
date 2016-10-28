<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/25
 * Time: 15:18
 */
header("Content-type:text/html;charset=utf-8");
$b = file_get_contents("date.txt");
$a = explode("\r\n",$b);
//print_r($a);
echo "<table width='600px' border='1px' align='center'>";
echo "<caption>用户信息</caption>";
echo "<tr>";
echo "<td>用户名</td>";
echo "<td>年龄</td>";
echo "<td>性别</td>";
echo "</tr>";
//print_r($a);
foreach ($a as $key=>$val){
    if($val == "" ){
        continue;
  //  print_r($val);
    }
    $a1 = explode(",",$val);
//print_r($a1);
    echo "<tr>";
    foreach($a1 as $val2){
    $a2= explode(" ",$val2);
        echo "<td>";
        echo $a2[1];
        echo "</td>";
    }
    echo "</tr>";
}