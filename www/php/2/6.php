<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/23
 * Time: 11:06
 */
header("Content-type:text/html;charset=utf-8");
function bim($high,$weight){
    $bim = $weight/($high*$high);
    return number_format($bim,2);
}
?>
<form method="get" name="form1">
    <input type="text" name="high" placeholder="请输入身高/米">
    <input type="text" name="weight" placeholder="请输入体重/千克">
    <input type="submit" value="提交">
</form>
<?php
$a = $_GET['high'];
$b = $_GET['weight'];
if ($a>0 && $b>0){
    $bim = bim($a,$b);
    echo $bim;
}
if ($_GET['high']!=null && $_GET['weight']!=null ){
if ($bim <18.5){
    echo "&nbsp;";
     echo "过轻";
}elseif ($bim>=18.5 && $bim<24.99){
    echo "&nbsp;";
    echo "正常";
}elseif($bim>=24.99 && $bim<28){
    echo "&nbsp;";
    echo "过重";
}elseif($bim>=28 && $bim< 32){
    echo "&nbsp;";
    echo "肥胖";
}elseif ($bim>=32){
    echo "&nbsp;";
    echo "非常肥胖";
}
}
?>