<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-30
 * Time: 16:26
 */
$a = 0;
$b = 1;
$b || $a = 100;   // $a = 0， 因为$b 为 1， 后面的赋值语句没有被执行
echo $a;
echo "<hr>";
$a = 1;
$b = 0;
$b || $a = 100;   // $a = 100， 因为$b为 0， 后面的赋值语句被执行了
   echo $a;