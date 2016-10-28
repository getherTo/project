<?php

include_once "common/db.php";

// 根据新闻id获取新闻
$news_id = intval($_GET['id']);
//获取所有的新闻分类
$sql_category  = "select * from news where id = $news_id ";
$result = mysqli_query($link, $sql_category);
$news = mysqli_fetch_array($result, MYSQL_ASSOC);


//获取所有的新闻分类
$sql_category  = "select * from news_category ";
$result = mysqli_query($link, $sql_category);
$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);

$arr_news_category_value = array();
foreach($arr_news_category as $val ){
  $arr_news_category_value[$val['id']] = $val['name'];
}

// 设置当前导航
$current_nav = "news";

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $news['title']?> - 新闻资讯</title>
<link rel="stylesheet" type="text/css" href="Assets/css/reset.css"/>
<script type="text/javascript" src="Assets/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="Assets/css/thems.css">
<!--幻灯片-->

  <style>
    .news_content p{
      text-indent: 2em;
      color: #444;
      font-size: 18px;
      line-height: 34px;;
    }
  </style>

</head>

<body>
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
        <a href="">首页</a>>
        <a href="news.php">新闻资讯</a>
    </div>
    <!--当前位置-->
    <!--左边重要导航盒子-->
    <div class="sidenav">
    	<div class="side_m">
            <div class="side_h">
                <p>About us</p>
                <img src="Assets/images/news.png" alt="关于金百合"/>
            </div>
            <div class="line_01">&nbsp;</div>
        <ul class="side_nav_l">
          <li class="<?php if(!$news_category_id) echo "now";?>"><a href="news.php">全部</a></li>
          <?php
          foreach($arr_news_category_value as $key => $val){
            ?>
            <li class="<?php if($news_category_id==$key) echo "now";?>"><a href="news.php?category_id=<?php echo $key?>"><?php echo $val;?></a></li>
          <?php
          }
          ?>
        </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>
    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
    	<h1 style="text-align: center;font-size: 22px; font-weight: bold"><?php echo $news['title']?></h1>
    	<p style="text-align: center">【发布时间： <?php echo $news['created_at']?>】</p>
        <div class="s_main_b news_content">
          <?php echo $news['content']?>
        </div>
    </div>
    <!--右边主要内容-->
</div>
<!--主体盒子-->
<div class="space_hx">&nbsp;</div>
<!--底部-->
<div class="foot">
	<div class="foot_m">
    	<ul class="foot_nav clearfix">
        	<li class="f_about">
            	<b>公司简介</b>
                <div class="f_nav_m">
                	<p>金百合文化传媒有限公司是一家集影视广告、培训，童星包装推广、演艺经纪、活动策划及广告策划、制作、发行、企业形象和品牌推广于一体的专业传媒运营公司。</p>
                	<p>我们拥有专业的策划团队，不仅勇于尝试多种题材的项...</p>
                </div>
            </li>
            <li>
            	<b>关于我们</b>
                <div class="f_nav_m">
                	<a href="">公司简介</a>
                    <a href="">企业资质</a>
                    <a href="">发展历程</a>
                    <a href="">培训项目</a>
                </div>
            </li>
            <li>
            	<b>学员中心</b>
                <div class="f_nav_m">
                	<a href="">学员班级</a>
                    <a href="">学院班级</a>
                </div>
            </li>
            <li>
            	<b>最新活动</b>
                <div class="f_nav_m">
                	
                </div>
            </li>
            <li>
            	<b>新闻资讯</b>
                <div class="f_nav_m">
                	<a href="">公司新闻</a>
                    <a href="">行业资讯</a>
                </div>
            </li>
            <li>
            	<b>联系我们</b>
                <div class="f_nav_m">
                	<a href="">联系方式</a>
                    <a href="">留言反馈</a>
                </div>
            </li>
        </ul>
        <div class="f_tel">
        	<p class="yellow">您可以拨打我们的服务电话</p>
            <h3>135-1077-4595</h3>
            <p><b>金百合文化传媒有限公司</b></p>
            <p>龙华新区弓村汇海广场A栋1007-1011室</p>
            <p><b>Tel:</b>135-1077-4595</p>
            <p><b>Fax:</b>135-1077-4xxx</p>
            <p><b>E-mail:</b>135@163.com</p>
        </div>
    </div>
</div>
<div class="copyright">
	<p>Copyright © 2015 金百合文化传媒有限公司 All rights reserved.  粤ICP备11036519号-1 </p>
</div>
<!--底部-->
<script language="javascript">
$(function(){

})
</script>
</body>
</html>
