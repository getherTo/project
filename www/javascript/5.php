<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/13
 * Time: 14:56
 */
header("Content-type:text/html;charset=utf-8");
?>
<form id="form1">
   用户名： <input type="text" id="name" value="" onfocus="change_border(this);" onblur="blurInput(this)">
   密码： <input type="password" id="password" value="" onfocus="change_border(this);"  onblur="blurInput(this)">
</form>
<script type="text/javascript">
    function change_border(el) {
        el.style.border = "1px solid red";
    }
    function blurInput( obj ){
        obj.style.border = "1px solid gray";
    }
</script>
