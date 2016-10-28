<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/12
 * Time: 18:38
 */
header("Content-type:text/html;charset=utf-8");
$num1 = $_GET["num1"]; // 将$_GET["num1"]变量赋给 $num1 变量
$num2 = $_GET["num2"];
$sel = $_GET["sel"];
?>
<div style="width: 900px; margin: 0 auto">
    <form action="" method="get" name="form1">
        <table>
            <tr>
                <td>
                    <input type="text" name="num1" value="<?php echo $num1 ?>" required>
                </td>
                <td>
                    <select name="sel" required>
                        <?php
                        /*
                        if ($sel == "") echo "selected";
                        逻辑判断语句  如果 $sel 变量等于 空字符串， 输出 selected 字符串
                        */
                        ?>
                        <option value="" <?php if ($sel == "") echo "selected"; ?>>-请选择运算符-</option>
                        <option value="+" <?php if ($sel == "+") echo "selected"; ?>>加</option>
                        <option value="-" <?php if ($sel == "-") echo "selected"; ?>>减</option>
                        <option value="*" <?php if ($sel == "*") echo "selected"; ?>>乘</option>
                        <option value="/" <?php if ($sel == "/") echo "selected"; ?>>除</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="num2" value="<?php echo $num2 ?>" placeholder="请输入数字" required>
                </td>
                <td>
                    <input type="submit" value="计算">
                </td>
                <td>
                    <?php
                    if ($sel == "+") {
                        $result = $num1 + $num2;
                    }
                    if ($sel == "-") {
                        $result = $num1 - $num2;
                    }
                    if ($sel == "*") {
                        $result = $num1 * $num2;
                    }
                    if ($sel == "/") {
                        $result = $num1 / $num2;
                    }
                    ?>
                    <input type="text" name="" placeholder="结果" value="<?php echo $result; ?>">
                </td>
            </tr>
        </table>
    </form>
</div>