<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

</head>
<body style="padding:30px">
<form name="form1" action="" method="get">
    <div>
        年<select name="year">
            <option value="">-年-</option>
            <?php
            for( $i=1900; $i<=2016;$i++){
                $year_selected = "";
                if($i == $_GET["year"]){
                    $year_selected = "selected";
                }
                echo "<option value='$i' $year_selected>-$i-</option>";
            }
            ?>
        </select>
        月<select name="month">
            <option value="">-月-</option>
            <?php
            for( $i=1; $i<=12;$i++){
                $month_selected = "";
                if($i == $_GET["month"]){
                    $month_selected = "selected";
                }
                echo "<option value='". $i . "' $month_selected>-" . $i . "-</option>";
            }
            ?>
        </select>
        日<select name="day">
            <option value="">-日-</option>
            <?php
            for( $i=1; $i<=31;$i++){
                $day_selected = "";
                if($i == $_GET["day"]){
                    $day_selected = "selected";
                }
                ?>
                <option value="<?php echo $i;?>" <?php echo $day_selected;?>>-<?php echo $i;?>-</option>
            <?php

            }
            ?>
        </select>
        <input type="submit" value="提交">
        <input type="reset" value="重置">

    </div>
</form>
<?php
function shengxiao1($sx){
    $shengixao = ['鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'];
    // 根据用户的出生年份， 计算出用户的生肖
    $shengxiao_index = ($sx - 1900) % 12;
    $img_index = $shengxiao_index + 1;
    $arr['name'] = $shengixao[$shengxiao_index];
    $arr['pic']= $img_index .".png";
    return $arr;
}
if( count($_GET) > 0 ){
    echo "<h2>";
    echo "您选择的是：";
    echo   $_GET["year"];
    echo "年";
    echo  $_GET["month"];
    echo "月";
    echo $_GET["day"];
    echo "日";
    function old($i)
    {
        $old = date('Y') - $i;
        return $old;
    }
    $w = old ($_GET['year']);
    echo  "<h2>你的年龄是：".$w ."岁";
    echo "</h2>";
    $arr_shengxiao = shengxiao1($_GET['year']);
    echo "<h2>您的生肖是:".$arr_shengxiao['name'];
    echo "<img src='/php/1/shengxiao/{$arr_shengxiao['pic']}'>";
    echo "</h2>";
    $month =  $_GET["month"];
    $day =  $_GET["day"];
    $img = "";
    function xingzuo1($month,$day){
        if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
            $ar['name'] = "水瓶座";
            $ar['pic'] = "shuiping.png";
        } else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
            $ar['name']= "双鱼座";
            $ar['pic'] = "shuangyu.png";
        } else if (($month == 3 && $day > 20) || ($month == 4 && $day <= 19)) {
            $ar['name'] = "白羊座";
            $ar['pic'] = "baiyang.png";
        } else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
            $ar['name'] = "金牛座";
            $ar['pic']= "jinniu.png";
        } else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
            $ar['name'] = "双子座";
            $ar['pic'] = "shuangzi.png";
        } else if (($month == 6 && $day > 21) || ($month == 7 && $day <= 22)) {
            $ar['name'] = "巨蟹座";
            $ar['pic'] = "juxie.png";
        } else if (($month == 7 && $day > 22) || ($month == 8 && $day <= 22)) {
            $ar['name'] = "狮子座";
            $ar['pic'] = "shizi.png";
        } else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
            $ar['name'] = "处女座";
            $ar['pic'] = "chunv.png";
        } else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
            $ar['name'] = "天秤座";
            $ar['pic'] = "tiancheng.png";
        } else if (($month == 10 && $day > 23) || ($month == 11 && $day <= 22)) {
            $ar['name'] = "天蝎座";
            $ar['pic'] = "tianxie.png";
        } else if (($month == 11 && $day > 22) || ($month == 12 && $day <= 21)) {
            $ar['name'] = "射手座";
            $ar['pic'] = "sheshou.png";
        } else if (($month == 12 && $day > 21) || ($month == 1 && $day <= 19)) {
            $ar['name'] = "魔羯座";
            $ar['pic'] = "moxie.png";
        }
        return $ar;
    }
    $xingzuo = xingzuo1($_GET["month"],$_GET["day"]);
   echo "<h2>您的星座是：" . $xingzuo['name'] ;
    echo "&nbsp;";
    echo "<img src='/php/2/xingzuo/{$xingzuo['pic']}'>";
    echo "</h2>";
}

$history[829][0] = array('title'=>'亚太出版商联合会年会首次在中国举行','url'=>'http://www.todayonhistory.com/8/29/YaTaiChuBanShangLianHeHuiNianHuiShouCiZai-china-JuHang.html', 'img'=>'');
$history[829][1] = array('title'=>'国际微笑行动','url'=>'http://www.todayonhistory.com/8/29/GuoJiWeiXiaoHangDong.html', 'img'=>'1.png');
$history[829][2] = array('title'=>'苏联宇宙飞船与空间站对接成功','url'=>'http://www.todayonhistory.com/8/29/SuLianYuZhouFeiChuanYu-space-ZhanDuiJieChengGong.html', 'img'=>'2.png');
$history[830][0] = array('title'=>'海环球金融中心启用','url'=>'http://www.todayonhistory.com/8/30/HaiHuanQiuJinRongZhongXinQiYong.html', 'img'=>'3.png');
$history[830][1] = array('title'=>'我国最大的企业博士后工作站开站','url'=>'http://www.todayonhistory.com/8/30/WoGuoZuiDaDeQiYeBoShiHou-job-ZhanKaiZhan.html', 'img'=>'');
$history[830][2] = array('title'=>'家乐福兼并普罗莫代斯组成世界第二大零售集团','url'=>'http://www.todayonhistory.com/8/30/JiaYueFuJianBingPuLuoMoDaiSiZuChengShiJieDiErDaLingShouJiTuan.html', 'img'=>'4.png');


$selected_day = $_GET['month'].$_GET['day'];
if($selected_day){
    $show_history = $history[$selected_day];
}
if( count($show_history) > 0 ){
    echo "<h1 align='center'>历史上的今天</h1>";
    echo "<h2 align='center'>{$_GET['month']}月{$_GET['day']}日</h2>";
    echo "<ul>";
    foreach($show_history as $val ){
        ?>
        <li>
            <?php
            if($val['img']){
                ?>
                <img src="/php/1/shengxiao/<?php echo $val['img']?>" width="150px" height="150px"><br>
            <?
            }
            ?>
            <a href="<?php echo $val['url']?>" target="_blank"><?php echo $val['title'];?></a>
        </li>
    <?php
    }
    echo "</ul>";
}
?>
</body>
</html>
