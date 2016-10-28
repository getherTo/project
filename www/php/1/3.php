<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/18
 * Time: 11:14
 */
header("Content-type:text/html;charset=utf-8");
$countrys = ['美国','英国','中国','俄罗斯','德国','意大利','荷兰','法国','澳大利亚','日本'];

for ($cts =0;$cts<count($countrys);$cts++)
{
    echo $countrys[$cts]." ";
};
while ($cts < count($countrys) )
{
    echo $countrys[$cts]." ";
    $cts++;
};
$num = 1;
$s = 0;
while ($num<=100)
{
    echo $s =$num+$s." ";
    $num++;
}
echo $s;

$i = 1;
$j = 0;
do {
    $j =$j+$i;
    $i++;
}while ($i<=100);
echo $j;