<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/17
 * Time: 15:05
 */
header("Content-type:text/html;charset=utf-8");
$integral = [];
$integral = ['排名'=>[1,2,3,4,5,6,7,8,9,10],
    '球队'=>['山东鲁能','广州恒大','上海上港','北京国安','广州富力','江苏舜天','石家庄永昌','上海申花','辽宁宏运','河南建业'],
    '场次'=>[11,11,11,11,11,11,10,11,10,10],
    '胜/负/平'=>['7/1/3','6/4/1','6/4/1','6/4/1','4/4/3','4/4/3','4/4/3','4/2/5','3/4/3','3/3/4'],
    '净胜球'=>[11,15,11,8,3,-1,1,-5,-5,-2],
    '积分'=>[22,22,22,22,16,16,15,14,13,12]];
 print_r($integral);
echo "<br>";
echo "<br>";
echo "<br>";
echo $integral ['球队'][9]."<br>";
echo $integral ['排名'][9]."<br>";
echo $integral ['场次'][9]."<br>";
echo $integral ['胜/负/平'][9]."<br>";
echo $integral ['净胜球'][9]."<br>";
echo $integral ['积分'][9]."<br>";