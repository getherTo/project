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
   $s = ['水瓶座','双鱼座','白羊座','金牛座','双子座','巨蟹座','狮子座','处女座','天秤座','天蝎座','射手座','摩羯座'];
    $shengixao = ['鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'];
    // 根据用户的出生年份， 计算出用户的生肖
    $shengxiao_index = ($_GET["year"] - 1900) % 12;
    $img_index = $shengxiao_index + 1;
    echo "<br>生肖:".$shengixao[$shengxiao_index];
    echo "<img src='shengxiao/{$img_index}.png'>";
    $s_index =($_GET["month"].".".$_GET["day"]);
    echo "<br>星座:".$s_index;
    if($s_index>=3.21 && $s_index<=4.19){
        echo '你是白羊座';
    }elseif($s_index>=4.20 && $s_index<=5.20){
        echo '你是金牛座';
    }elseif($s_index>=5.21 && $s_index<=6.21){
        echo '你是双子座';
    }elseif($s_index>=6.22 && $s_index<=7.22){
        echo '你是巨蟹座';
    }elseif($s_index>=7.23 && $s_index<=8.22){
        echo '你是狮子座';
    }elseif($s_index>=8.23 && $s_index<=9.22){
        echo '你是处女座';
    }elseif($s_index>=9.23 && $s_index<=10.23){
        echo '你是天秤座';
    }elseif($s_index>=10.24 && $s_index<=11.22){
        echo '你是天蝎座';
    }elseif($s_index>=11.23 && $s_index<=12.21){
        echo '你是射手座';
    }elseif($s_index>=12.22 && $s_index<=1.19){
        echo '你是魔羯座';
    }elseif($s_index>=1.20 && $s_index<=2.18){
        echo '你是水平座';
    }elseif($s_index>=2.19 && $s_index<=3.20){
        echo '你是双鱼座';
    }
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
</body>
</html>