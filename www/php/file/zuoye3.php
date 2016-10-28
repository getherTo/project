<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/26
 * Time: 8:48
 */
header("Content-type:text/html;charset=utf-8");
$a = file_get_contents("censorwords.txt");
$b = explode("\n", $a);
//print_r( $b);
$c = array_chunk($b,10);
?>
    <table width="964px" align="center" border="1px">
        <caption><h1>敏感词</h1></caption>
<?php
foreach($c as $key=>$d){
    echo "<tr>";
   foreach($d as $e){
       echo "<td>";
echo $e;
       echo "</td>";
   }
    echo "</tr>";
}
?>
        </table>
