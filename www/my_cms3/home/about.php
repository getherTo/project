<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>关于我们</title>
<link rel="stylesheet" type="text/css" href="Assets/css/reset.css"/>
<script type="text/javascript" src="Assets/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="Assets/css/thems.css">
<!--幻灯片-->
</head>

<body>

<?php
// 载入共有文件
include_once "common/db.php";
include_once "common/function.php";

// 获取所有类型
$arrType = getAllType();


// 获取关于我们
$id = $_GET['id'];
if(!$id) $id = 1;

// 设置当前导航
$current_nav = "about_us".$id;



$sql = "select * from about_us where id = $id";
// 查询信息
$result = mysqli_query($link, $sql);
$about_us = mysqli_fetch_array($result, MYSQL_ASSOC);

?>


<!--顶部-->
<?php
include_once "top.php";
?>
<!--顶部-->

<!--头部-->
<?php
include_once "header_nav.php";
?>
<!--头部-->



<!--主体盒子-->
<div class="second">
	<!--当前位置-->
    <div class="position">
    	<b>所在位置：</b>
        <a href="index.php">首页</a>>
        <a class="yellow"><?php echo $arrType[$about_us['type']]?></a>

    </div>
    <!--当前位置-->
    <!--左边重要导航盒子-->
    <div class="sidenav">
    	<div class="side_m">
            <div class="side_h">
                <p>About us</p>
                <img src="Assets/images/about.png" alt="关于金百合"/>
            </div>
            <div class="line_01">&nbsp;</div>
            <ul class="side_nav_l">

                <?php
                foreach( $arrType as $key => $val){
                    ?>
                    <li class="<?php echo ($key==$id) ? "now" : "" ?>"><a href="about.php?id=<?php echo $key;?>"><?php echo $val;?></a></li>
                    <?
                }
                ?>
            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>
    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
    	<h1><?php echo $arrType[$about_us['type']]?></h1>
        <div class="s_main_b">
            <?php
            echo $about_us['content'];
            ?>
        </div>
    </div>
    <!--右边主要内容-->
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>

<!--底部-->
<?php include_once "footer.php"?>
<!--底部-->

<script language="javascript">
$(function(){

})
</script>
</body>
</html>
