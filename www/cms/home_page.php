<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>我们的网站</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="myfocus-2.0.4.min.js"></script>
    <style>
        body{
            background-color: gainsboro;
        }
    </style>

</head>
<body>
<div id="head" style="margin: 0 auto;width: 1440px">
    <div id="logo" style="float: left" ><img src="img/logo.jpg" style="height: 120px;width: 200px"></div>
    <div id="topbar" style="float: right; margin-right: 50px;margin-top: 10px">
        <a href="login/login.php">会员登录</a>
        <a href="login/register.php">会员注册</a>
        <a href="login/guestbook.php">在线留言</a>
    </div>
    <div id="banner"><img src="img/index.jpg" style="height: 80px;width: 1165px;margin-right: 30px;float: right"></div>
    <div id="menu" >
        <ul style="list-style-type: none">
            <li style="float: left; margin: 10px"><a href="home_page.php"><span>网站首页</span></a></li>
            <li style="float: left; margin: 10px"><a href=""><span>关于我们</span></a></li>
            <li style="float: left; margin: 10px"><a href=""><span>学员中心</span></a></li>
            <li style="float: left; margin: 10px"><a href=""><span>最新活动</span></a></li>
            <li style="float: left; margin: 10px"><a href=""><span>新闻资讯</span></a></li>
            <li style="float: left; margin: 10px"><a href=""><span>联系我们</span></a></li>
        </ul>
        <div style="float: right;margin-right: 30px"> <form name="searchform" id="searchform" action="" method="get" target="_blank" style="margin:0px;">
                关键字：<input type="text" name="keyword" size="12" value="">
                <input type="submit" value="搜索">
            </form></div>
    </div>
    <div style="clear:both;"></div>
</div>
<div style="width:1390px;margin: 0 auto">
<div id="boxID" style="width:1390px;height:400px">
    <!-- 内容列表 -->
    <div class="pic">
        <ul>
            <li><a href="#"><img src="img/1.jpg" alt="标题1" /></a></li>
            <li><a href="#"><img src="img/2.jpg" alt="标题2" /></a></li>
            <li><a href="#"><img src="img/3.jpg" alt="标题3" /></a></li>
            <li><a href="#"><img src="img/4.jpg" alt="标题3" /></a></li>
            <li><a href="#"><img src="img/5.jpg" alt="标题3" /></a></li>
            <li><a href="#"><img src="img/6.png" alt="标题3" /></a></li>
            <!-- 你可以根据需要添加更多的列 -->
        </ul>
    </div>
</div></div>
<script type="text/javascript">
    myFocus.set({
        id: 'boxID',//焦点图盒子ID
        pattern: 'mF_slide3D',//焦点图风格的名称
        time: 4,//切换时间间隔(秒)
        trigger: 'mouseover',//触发切换模式:'click'(点击)/'mouseover'(悬停)
        delay: 200,//'mouseover'模式下的切换延迟(毫秒)
        width:1390,//标题高度,'default'为默认CSS高度，0为隐藏 width:300,//设置图片区域宽度(像素)
        height:500 //设置图片区域高度(像素)
    });
</script>
<div style="clear: both"></div>
<div style="margin: 0 auto;width: 1440px">
<div style="width: 33%;float: left">
    <h3>最新资讯</h3>
    <p style="text-indent: 2em;color:#696969">金百合文化传媒有限公司是一家集影视广告、培训，
        童星包装推广、演艺经纪、活动策划及广告策划、制作、发行、企业形象和品牌推广于一体的专业传媒运营公司。
        我们拥有专业的策划团队，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，
        不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，
        不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，
        不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项，不仅勇于尝试多种题材的项...</p>
</div>
<div style="width: 33%;float: left">
    <h3>公司风采</h3>
    <video src="2.mp4" style="width: 450px;height: 280px"  poster="pic2.jpg" controls></video>
</div>
<div style="width: 33%;float: left">
    <h3>名师团队</h3>
<img src="pic2.jpg" style="height: 280px;width: 450px">
</div>
</div>


<div style="margin: 0 auto;width: 1440px">
            <div style="width: 20%;float: left">
                <ul style="margin-left: 100px;list-style-type: none">
                <h4 style="color:#696969">关于我们</h4>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">公司简介</a></li><br>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">企业资质</a></li><br>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">发展历程</a></li><br>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">培训项目</a></li>
                    </ul>
            </div>
            <div style="width: 20%;float: left">
                <ul style="margin-left: 100px;list-style-type: none">
                <h4 style="color:#696969">学员中心</h4>
                    <li style="font-size: 14px"> <a href="" style="text-decoration: none;color: #808080">学员班级</a> </li><br>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">学院班级</a></li>
                </ul>
            </div>
            <div style="width: 20%;float: left">
                <ul style="margin-left: 100px;list-style-type: none">
                <h4 style="color:#696969">新闻资讯</h4>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">公司新闻</a></li><br>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">行业资讯</a></li>
                </ul>
            </div>
            <div style="width: 20%;float: left">
                <ul style="margin-left: 100px;list-style-type: none">
                <h4 style="color:#696969">联系我们</h4>
                    <li style="font-size: 14px"> <a href="" style="text-decoration: none;color: #808080">联系方式</a></li><br>
                    <li style="font-size: 14px"><a href="" style="text-decoration: none;color: #808080">留言反馈</a></li>
                </ul>
            </div>
        <div style="width: 20%;float: left">
            <p style="font-size: 14px;color: #C0A10D">您可以拨打我们的服务电话</p>
            <h1 style="color: #C0A10D;">135-1077-4595</h1>
            <p><b>金百合文化传媒有限公司</b></p>
            <p>龙华新区弓村汇海广场A栋1007-1011室</p>
            <p><b>Tel:</b>135-1077-4595</p>
            <p><b>Fax:</b>135-1077-4xxx</p>
            <p><b>E-mail:</b>135@163.com</p>
        </div>
</div>
<div style="clear: both"></div>
<hr color="grey">
<div style="width: 1440px;margin-left: 300px">
    <p>Copyright © 2015 金百合文化传媒有限公司 All rights reserved.  粤ICP备11036519号-1 </p>
</div>
</body>
</html>