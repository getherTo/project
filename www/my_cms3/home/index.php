<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>金百合</title>
<meta name="title" content="金百合首页" />
<meta name="description" content="描述信息" />
<meta name="keywords" content="关键词1,关键词2,关键词3" />
<link rel="stylesheet" type="text/css" href="Assets/css/reset.css"/>
<script type="text/javascript" src="Assets/js/jquery-1.8.3.min.js"></script>
<!--幻灯片-->
<script type="text/javascript" src="Assets/js/js_z.js"></script>
<link rel="stylesheet" type="text/css" href="Assets/css/thems.css">
<!--幻灯片-->
</head>

<body>

<?php
// 载入共有文件
include_once "common/db.php";
include_once "common/function.php";

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
<?php
include_once "common/db.php";
$sql = "select * from home_imgs where 1";
$result = mysqli_query($link, $sql);
$arr = mysqli_fetch_all($result, MYSQL_ASSOC );

?>

<!--幻灯片-->
<div class="banner">
	<div id="inner">
        <div class="hot-event">
        	<div class="event-item" style="display: block;">
                <a target="_blank" href="" class="banner">
                    <img src="<?php
                    foreach($arr as $val){
                        echo $val['img'];
                    }
                     ?>" class="photo"  />
                </a>
            </div>
            <div class="switch-tab">
                <a href="#" onClick="return false;" class="current">1</a>
                <a href="#" onClick="return false;">2</a>
                <a href="#" onClick="return false;">3</a>
                <a href="#" onClick="return false;">4</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#inner').nav({ t: 6000, a: 500 });
    </script>
</div>
<!--幻灯片-->
<div class="space_hx">&nbsp;</div>
<!--主体盒子-->
<div class="wrap">
	<ul class="box_m clearfix">
    	<li class="zxhd">
        	<div class="box_h">
            	最新活动<span>News</span>
            </div>
            <div class="box_body">
            	<img src="Assets/upload/pic1.jpg" alt="金百合最新活动"/>
                <h3><a href="">深圳金百合文化传媒公司举行开业盛典</a></h3>
                <p>4月11日下午，龙华新区龙华商业广场二楼宴会厅人山人海，包括社区居民在内的500名,观众齐聚一堂，共同观赏了一场重量级演唱会，....</p>
            </div>
        </li>
        <li class="xyfc">
        	<div class="box_h">
            	学员风采<span>Style</span>
            </div>
            <div class="box_body">
                <embed width="317" height="188" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://www.btjdlj.com/Flvplayer.swf?vcastr_file=http://365jia.cn/uploads/special/video/zzh/1276_xh.flv"/>
            </div>
        </li>
        <li class="mstd">
        	<div class="box_h">
            	名师团队<span>Teacher</span>
            </div>
            <div class="box_body">
            	<a href=""><img src="Assets/upload/pic2.jpg" alt="金百合名师团队"/></a>
            </div>
        </li>
    </ul>
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>

<!--底部-->

<!-- 页脚 -->
<?php
include_once "footer.php";
?>
<!-- 页脚 -->


<script language="javascript">
    $(function(){
        //幻灯片
        var w_width=$(window).width();
        var w_banner=(1920-w_width)/2;
        $('.hot-event .event-item img').css('margin-left','-'+w_banner+'px'		);
    })
</script>

</body>
</html>
