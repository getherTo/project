<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/12
 * Time: 18:58
 */
header("Content-type:text/html;charset=utf-8");
?>
<form method="get" action="" name="form1">
    <table>
        <tr>
            <td>工龄： </td> <td><input type="text" name="working_age" id="working_age" value="" required="" ></td>
        </tr>
        <tr>
            <td>月工资：</td> <td><input type="text" name="monthly_wages" id="monthly_wages" value="" required=""></td>
        </tr>
        <tr>
            <td></td> <td><button type="button" onclick="count()">计算</button></td>
        </tr>
        <tr>
            <td>最终工资：</td><td><input type="text" name="salary" id="salary" value=""></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    function count(){
        var working_age = document.getElementById("working_age").value;
        var monthly_wages = document.getElementById("monthly_wages").value;
        var salary = "";
        for(var i = 1;i < working_age;i++){
            monthly_wages *=1.1
        }
        salary = monthly_wages;
        document.getElementById("salary").value = salary;
    }
//    var salary = monthly_wages*(1 + 0.1)*working_age;
//     document.getElementById("salary").value = salary;
</script>