<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
$pre_tax = $_GET["pre_tax"];
$tax_payable = $_GET["tax_payable"];
$net_payroll = $_GET["net_payroll"];
$salary = $_GET["salary"];
//$tax_payable = $pre_tax-$pre_tax*(0.08+0.02+0.01+0.08)-3500;
?>
<form action="" method="get">
    <table align="center">
        <tr>
            <td> 税前工资：</td>
            <td>
                <input type="text" name="pre_tax" value="<?php echo $pre_tax ?>" required></td>
        </tr>
        <tr>
            <td>起征点：</td>
            <td>
                <select>
                    <option>3500</option>
                    <option>4800</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="提交"></td>
            <td><input type="reset" name="reset" value="重置"></td>
        </tr>

        <tr>
            <td> 应交税款：</td>
            <td>
                <?php
                if($pre_tax<3500 ){
                    $tax_payable=0;
                }
               else if (($pre_tax-3500)<=1455 && ($pre_tax-3500)>0){
                   $tax_payable=($pre_tax-3500)*0.03;}
               else {
                    $tax_payable = $pre_tax-$pre_tax*(0.08+0.02+0.01+0.08)-3500;
                }
                ?>
                <input type="text" name="tax_payable" value="<?php echo $tax_payable ?>"></td>
        </tr>
        <tr>
            <td> 个税：</td>
            <td>
                <?php
                    if ($tax_payable <= 1455) {
                        $net_payroll = $tax_payable * 0.03;
                    } else if ($tax_payable > 1455 && $tax_payable <= 4155) {
                        $net_payroll = $tax_payable * 0.1 - 105;
                    } else if ($tax_payable > 4155 && $tax_payable <= 7755) {
                        $net_payroll = $tax_payable * 0.2 - 555;
                    } else if ($tax_payable > 7755 && $tax_payable <= 27255) {
                        $net_payroll = $tax_payable * 0.25 - 1005;
                    } else if ($tax_payable > 27255 && $tax_payable <= 41255) {
                        $net_payroll = $tax_payable * 0.3 - 2755;
                    } else if ($tax_payable > 41255 && $tax_payable <= 57505) {
                        $net_payroll = $tax_payable * 0.35 - 5505;
                    } else if ($tax_payable > 57505) {
                        $net_payroll = $tax_payable * 0.45 - 13505;
                    }
                ?>
                <input type="text" name="net_payroll" value="<?php  echo $net_payroll ?>"></td>
        </tr>
        <tr>
            <td>实发工资：</td>
            <td>
                <?php
                 $salary = $pre_tax-$net_payroll;
                ?>
                <input type="text" name="net_payroll" value="<?php echo $salary ?>"></td>
        </tr>
    </table>
</form>
</body>
</html>