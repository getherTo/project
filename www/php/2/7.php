<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>循环练习</title>

</head>
<body style="padding:30px">

<?php
if( count($_GET) > 0 ){
    echo "<h2>";
    echo "您选择的是：";
    echo   $_GET["year"];
    echo "年";
    echo  $_GET["month"];
    echo "月";
    echo $_GET["day"];
    echo "日";
    $shengixao = ['鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'];
    // 根据用户的出生年份， 计算出用户的生肖
    $shengxiao_index = ($_GET["year"] - 1900) % 12;
    $img_index = $shengxiao_index + 1;
    echo "<br>生肖:".$shengixao[$shengxiao_index];
    echo "<img src='/php/1/shengxiao/{$img_index}.png'>";
    $month =  $_GET["month"];
    $day =  $_GET["day"];
    $img = "";
    if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
        $star = "水瓶座";
        $img = "shuiping.png";
    } else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
        $star = "双鱼座";
        $img = "shuangyu.png";
    } else if (($month == 3 && $day > 20) || ($month == 4 && $day <= 19)) {
        $star = "白羊座";
        $img = "baiyang.png";
    } else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
        $star = "金牛座";
        $img = "jinniu.png";
    } else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
        $star = "双子座";
        $img = "shuangzi.png";
    } else if (($month == 6 && $day > 21) || ($month == 7 && $day <= 22)) {
        $star = "巨蟹座";
        $img = "juxie";
    } else if (($month == 7 && $day > 22) || ($month == 8 && $day <= 22)) {
        $star = "狮子座";
        $img = "shizi.png";
    } else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
        $star = "处女座";
        $img = "chunv.png";
    } else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
        $star = "天秤座";
        $img = "tiancheng.png";
    } else if (($month == 10 && $day > 23) || ($month == 11 && $day <= 22)) {
        $star = "天蝎座";
        $img = "tianxie.png";
    } else if (($month == 11 && $day > 22) || ($month == 12 && $day <= 21)) {
        $star = "射手座";
        $img = "sheshou.png";
    } else if (($month == 12 && $day > 21) || ($month == 1 && $day <= 19)) {
        $star = "魔羯座";
        $img = "moxie.png";
    }
    echo "您的星座是：" . $star ;
    echo "&nbsp;";
    echo "<img src='/php/2/xingzuo/{$img}'>";
}



// 定义历史上的今天的数组
// 829
$history[829][0] = array('title'=>'亚太出版商联合会年会首次在中国举行','url'=>'http://www.todayonhistory.com/8/29/YaTaiChuBanShangLianHeHuiNianHuiShouCiZai-china-JuHang.html', 'img'=>'');
$history[829][1] = array('title'=>'国际微笑行动','url'=>'http://www.todayonhistory.com/8/29/GuoJiWeiXiaoHangDong.html', 'img'=>'1.png');
$history[829][2] = array('title'=>'苏联宇宙飞船与空间站对接成功','url'=>'http://www.todayonhistory.com/8/29/SuLianYuZhouFeiChuanYu-space-ZhanDuiJieChengGong.html', 'img'=>'2.png');

// 829
$history[830][0] = array('title'=>'海环球金融中心启用','url'=>'http://www.todayonhistory.com/8/30/HaiHuanQiuJinRongZhongXinQiYong.html', 'img'=>'3.png');
$history[830][1] = array('title'=>'我国最大的企业博士后工作站开站','url'=>'http://www.todayonhistory.com/8/30/WoGuoZuiDaDeQiYeBoShiHou-job-ZhanKaiZhan.html', 'img'=>'');
$history[830][2] = array('title'=>'家乐福兼并普罗莫代斯组成世界第二大零售集团','url'=>'http://www.todayonhistory.com/8/30/JiaYueFuJianBingPuLuoMoDaiSiZuChengShiJieDiErDaLingShouJiTuan.html', 'img'=>'4.png');

// 调用数组
$selected_day = $_GET['month'].$_GET['day']; // 选择的日期
if($selected_day){ // 判断选择的日期是否有值
    $show_history = $history[$selected_day]; // 调用选择的日期下标，调用数组
}


?>
<h1>循环练习</h1>
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
