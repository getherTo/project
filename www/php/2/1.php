<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/22
 * Time: 11:47
 */
header("Content-type:text/html;charset=utf-8");
$arr = range('a' ,'z');
$arr1 = array_chunk($arr,5);
?>
<table border="1" align="center" width="900">
    <caption><h2>26个英文字母</h2></caption>
<?php
    foreach( $arr1 as $key=>$val){
        echo "<tr>";
        echo "<td>".$val[0]."</td>";
        echo "<td>".$val[1]."</td>";
        echo "<td>".$val[2]."</td>";
        echo "<td>".$val[3]."</td>";
        echo "<td>".$val[4]."</td>";
        echo "<tr>";
    };

?>
</table>
