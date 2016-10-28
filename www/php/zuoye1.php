<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/16
 * Time: 17:15
 */
header("Content-type:text/html;charset=utf-8");
echo "<h2>熟悉布尔值练习</h2>";
$boo = treu;
if ($boo == true)
    echo '变量$boo为真';
else echo'变量为假！！';
echo '<hr>';

echo "<h2>熟悉双引号单引号</h2>";
$i = '只会看一遍';
echo  "$i";
echo  "<p>";
echo  '$i';
echo '<hr>';

echo "<h2>熟悉字符串转换</h2>";
$num = '3.1415926r*r';
echo '使用（integer）操作符转换变量$num类型';
echo (integer)$num;
echo '<p>';
echo '输出变量$num的值:'.$num;
echo settype($num,'inerger');
echo '<p>';
echo '输出变量$num的值：'.$sun;
echo"<hr>";
echo "<h2>熟悉输出浮点类型</h2>";
echo '圆周率的3中书写方法：<p>';
echo '第一种：pi() ='.pi().'<p>';
echo '第二种：3.1415926 = '. 3.1415926.'<p>';
echo '第三种：3.14159265359E-11 = ' . 314159265359E-11 .'<p>';
echo "<hr>";

echo "<h2>预定义变量</h2>";
echo "当前文件路径= " .__FILE__;
echo "<br>当前行数：" .__LINE__;
echo "<br>当前PHP版本信息：" .PHP_VERSION;
echo "<br>当前操作系统：" .PHP_OS;
echo "<hr>";

echo "<h2>变量间的赋值</h2>";
$string1 = "spcn";
$string2 = $string1;
$string1 = "zhuding";
echo string1 ."".$string2;
##注意：&传址
$string1 = "spcn";
$string2 = &$string1;
$string1 = "zhuding";
echo string1 ."".$string2;

echo "<h2>条件语句</h2>";
$t = date("H");
if ($t<20)
{
    echo "Have a goog day!";
}
echo "<hr>";

echo "<h2>if…else语句</h2>";
$t = date("H");
if ($t<20)
    {
   echo "Have a goog day!";
    }  else
    {
    echo "Have a good night";
    }