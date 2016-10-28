<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/12
 * Time: 19:13
 */
header("Content-type:text/html;charset=utf-8");
?>
<script type="text/javascript">
function test(){
    var txt1 = document.getElementById("txt1");
    var txt2 = document.getElementById("txt2");
    var txt3 = document.getElementById("txt3");
    var opt  = document.getElementById("sel");
     txt3.value =  eval(txt1.value + opt.value + txt2.value);//eval函数可计算某个字符串，并执行其中的的js代码
}
</script>
<input type="text" id="txt1" >
<select id="sel">
     <option value="+">+</option>
     <option value="-">-</option>
     <option value="*">*</option>
     <option value="/">/</option>
</select>
<input type="text" id="txt2" >
=
<input type="text" id="txt3" >
<button type="button" onclick="test()">计算</button>
<!--<input type="button" id="btn" value="计算" onclick="test()">-->