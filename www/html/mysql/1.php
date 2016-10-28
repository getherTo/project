<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/29
 * Time: 10:01
 */
header("Content-type: text/html; charset=utf-8");
$arr2  = [];
$arr2[] = ['id'=>1,'name'=>'tom', 'gender'=>'男'];
$arr2[] = ['id'=>2,'name'=>'andy', 'gender'=>'男'];
$arr2[] = ['id'=>3,'name'=>'joe', 'gender'=>'男'];
?>
<h1>方法二</h1>
<table border="1" width="800">
    <caption>学生信息</caption>
    <tr>
        <td>学号</td>
        <td>姓名</td>
        <td>性别</td>
    </tr>
    <?php
    foreach ($arr2 as $val){
        ?>
        <tr>
            <td><?php echo $val['id']?></td>
            <td><?php echo $val['name']?></td>
            <td><?php echo $val['gender']?></td>
        </tr>
    <?php
    }
    ?>
</table>
<?php echo "<hr>"?>
<?php
header("Content-type: text/html; charset=utf-8");
$arr['学号'] = [1,2,3];
$arr['姓名'] = ['tom','andy','joe'];
$arr['性别'] = ['男','男','男'];

?>
<h1>方法一</h1>
<table width="900px" border="1">
    <caption>学生信息</caption>
    <tr>
        <td>学号</td>
        <td>姓名</td>
        <td>性别</td>
    </tr>
    <?php

    foreach ( $arr['学号'] as $key => $val  ){
        ?>
        <tr>
            <td><?php echo $val;?></td>
            <td><?php echo $arr['姓名'][$key]?></td>
            <td><?php echo $arr['性别'][$key]?></td>
        </tr>

    <?php
    }
    ?>
</table>