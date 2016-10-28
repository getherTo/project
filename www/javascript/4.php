<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/13
 * Time: 10:54
 */
header("Content-type:text/html;charset=utf-8");
?>
<!--<ul id="my_ul">-->
<!--    <li>苹果</li>-->
<!--    <li>香蕉</li>-->
<!--    <li>橘子</li>-->
<!--</ul>-->
<!--<script>-->
<!--    var li = document.createElement("li"); // 创建 li-->
<!--    var text = document.createTextNode("梨子"); // 创建文本节点-->
<!--    var my_ul = document.getElementById("my_ul"); // 获取ul列表-->
<!--    li.appendChild(text); // 将文本节点追加到li中-->
<!--    my_ul.appendChild(li); // 将li标签追加到ul中-->
<!--</script>-->
<ul id="my_ul">
    <li>苹果</li>
    <li>香蕉</li>
    <li>橘子</li>
</ul>

<form id="my_form">
    <input type="text" name="fruits" id="fruits" value="">
    <select id="color">
        <option value="red">赤</option>
        <option value="orange">橙</option>
        <option value="yellow">黄</option>
        <option value="green">绿</option>
        <option value="cyan">青</option>
        <option value="blue">蓝</option>
        <option value="purple">紫</option>
    </select>
    <button type="button" id="button" value="" onclick="temp()">添加</button>
</form>
<script>
    function temp(){
        var fruits = document.getElementById("fruits").value;
        var color = document.getElementById("color").value;
        var my_li = document.getElementById("my_ul");
        my_li.innerHTML = my_li.innerHTML + "<li>"  + "<font color ='" + color + "'>" + fruits + "</font>" + "</li>";
    }
</script>