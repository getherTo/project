<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/22
 * Time: 16:07
 */
header("Content-type:text/html;charset=utf-8");
$names=["丁骁","黄舟","时伟伟","李建华","樊瑞","吴延祥","周鹏飞","邓科"];
?>
<form name="form1" method="get" action="">
    <select name="num">
        <option value="">请选择</option>
        <?php
        for($i=1;$i<=count($names);$i++){
            $str_selected = "";
            if ($_GET [ "num"]==$i){
               $str_selected = "selected";
            };
         echo "<option value='{$i}' $str_selected>{$i}人</option>";
        };
        ?>
    </select>
<input type="submit" value="提交">
</form>
<?php
$users = array_rand($names,$_GET["num"]);
    echo "抽中组员:";
   if ($_GET["num" == 1]){
       echo $names [$users];
   } else if ($_GET["num"]>1){
            foreach ( $users as $var){
                echo $names[$var];
                echo "&nbsp;";
            }
};
?>
