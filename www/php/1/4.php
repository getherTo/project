<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
?>
<form style="text-align: center">
    <select>
        <?php
            for ($i = 1900;$i <= 2016;$i++){
                echo "<option>".$i."</option>";
            }
            ?>
    </select>
    <select>
        <?php
        for ($s = 1;$s <= 12;$s++){
        echo "<option>".$s."</option>";
        }
        ?>
    </select>
    <select>
        <?php
        for ($j = 1;$j <= 31;$j++){
        echo "<option>".$j."</option>";
        }
        ?>
    </select>
    <select>
        <?php
        $arr =['鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'];
        for ($i=0;$i<count($arr);$i++){
        echo "<option>".$arr[$i]."</option>";
        }
?>
    </select>
    <input type="submit" value="提交">
    <input type="reset" value="重置">
    </form>
</body>
</html>