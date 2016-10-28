<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>php运算符练习</title>
</head>
<body>
<?php
$num1 = $_GET["num1"]; // 将$_GET["num1"]变量赋给 $num1 变量
$num2 = $_GET["num2"];
$sel = $_GET["sel"];
?>

<div style="width: 900px; margin: 0 auto">
    <h1>php运算符练习</h1>

    <form action="" method="get" name="form1">
        <table>
            <tr>
                <td>
                    <input type="text" name="num1" value="<?php echo $num1 ?>" placeholder="请输入数字" required>
                </td>
                <td>
                    <select name="sel" required>
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
                    switch ($sel){
                        case "+":
                              $result = $num1 + $num2;
                            break;
                        case "-":
                              $result = $num1 - $num2;
                            break;
                        case "*":
                              $result = $num1 * $num2;
                            break;
                        case "/":
                              $result = $num1 / $num2;
                            break;
                        default:
                            $result= "错误";
                    }

                    ?>
                    <input type="text" name="" placeholder="结果" value="<?php echo $result; ?>">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>