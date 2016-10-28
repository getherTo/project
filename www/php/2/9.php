<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/24
 * Time: 15:23
 */
header("Content-type:text/html;charset=utf-8");
$a = "192.168.29.244";
$b = explode(".",$a);
foreach ($b as $c ){
    echo "&nbsp;".$c;
}
echo"<hr>";
$d ="18556522728";
$e = substr($d,0,3)."****".substr($d,7,4);
echo $e;