<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/23
 * Time: 9:03
 */
 for($i=1;$i<=100;$i++){
     if ($i%2==0){
         echo $i."&nbsp;";
     }
 }
echo "<br>";
$j = 1;
while($j<=100){
    if ($j%2==0){
        echo $j."&nbsp;";
    }
     $j++;
}
echo "<hr>";
$a = 1;
$b =2;
if ($a >0 && $b>1){
    echo $a."&nbsp;".$b;
}
echo "<hr>";
 if($a<=0 || $b <=0){
     echo $a."&nbsp;".$b;
 }
echo "<hr>";

if ($a==0 && $b==0){
    echo $a;
}elseif($a<0 || $b>0){
    echo $b;
}else{
    echo $a."&nbsp;".$b;
}