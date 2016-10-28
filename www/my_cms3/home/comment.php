<?php
session_start();


// 载入共有文件
include_once "common/db.php";

if( count($_POST)>0 ){


  $current_time = date("Y-m-d H:i:s");
  $sql = "insert into comment ( user_name, sex, phone,content,city,created_at  )
                      values (
                              '{$_POST['user_name']}',
                              '{$_POST['sex']}',
                              '{$_POST['phone']}',
                              '{$_POST['content']}',
                              '{$_POST['city']}',
                              '$current_time' )";



  // 执行sql语句
  $result = mysqli_query($link, $sql);

  if($result){
   // echo "添加成功！";
    // 直接跳转进入列表
    //header("Location: news_list.php");

    header("Content-type: text/html; charset=utf-8");
    ?>
      <script>
         alert('留言成功！');
         document.location.href = 'index.php';
      </script>
    <?php
    exit;

  } else {

    echo "添加失败！";
    echo mysqli_error($link);
    exit;

  }

}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>联系我们</title>
<link rel="stylesheet" type="text/css" href="Assets/css/reset.css"/>
<script type="text/javascript" src="Assets/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="Assets/css/thems.css">
<!--幻灯片-->
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
        <a href="comment.php">留言反馈</a>
    </div>
    <!--当前位置-->
    <!--左边重要导航盒子-->
    <div class="sidenav">
    	<div class="side_m">
            <div class="side_h">
                <p>Contact us</p>
                <img src="Assets/images/contact.png" alt="联系我们"/>
            </div>
            <div class="line_01">&nbsp;</div>
            <ul class="side_nav_l">
                <li  class="now"><a href="">留言反馈</a></li>
            </ul>
            <div class="line_02">&nbsp;</div>
        </div>
    </div>
    <!--左边重要导航盒子-->
    <!--右边主要内容-->
    <div class="s_main">
    	<ul class="contact">
         <form id="commentForm" action="" method="post">
        	<li class="clearfix">
            	<span>留言内容：<i>*</i></span>
                <div class="li_r">
                	<textarea   cols="" rows="" name="content" id="content"></textarea>
                    <em id="counter"></em>
                    <p>小于等于500字符</p>
                </div>
            </li>
            <li class="clearfix">
            	<span>留言人：</span>
                <div class="li_r">
                	<input  type="text" name="user_name" id="user_name">
                    <em>小于10个字符</em>
                </div>
            </li>
            <li class="sex clearfix">
            	<span>性别：</span>
                <div class="li_r">
                	<input name="sex" type="radio" value="男" checked >
                    <span>男</span>
                    <input name="sex" type="radio" value="女">
                    <span>女</span>
                </div>
            </li>
            <li class="clearfix">
            	<span>联系电话：<i>*</i></span>
                <div class="li_r">
                	<input  type="text" name="phone" id="phone">
                    <em>小于等于32个字符</em>
                </div>
            </li>
            <li class="clearfix">
            	<span>城市：</span>
                <div class="li_r">
                	<input  type="text" name="city" id="city">
                </div>
            </li>
            <li class="yzm clearfix">
            	<span>验证码：<i>*</i></span>
                <div class="li_r">
                	<input type="text" name="code" id="code">
                    <a href=""><img src="common/checkcode.php" alt="验证码" id="code_img"/></a>
                    <a href="javascript:;" id="link_code">看不清楚？换张图片</a>
                </div>
            </li>
            <li class="clearfix">
            	<span>&nbsp;</span>
                <div class="li_r">
                	<input  class="btn" type="button" value="发表留言" id="btn">
                </div>
            </li>
            </form>
        </ul>
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
   $('#link_code').click(function(){

    $("#code_img").attr("src", "common/checkcode.php?v="+ Math.random())
  });

  // 输入框绑定键盘弹起事件
  $('#content').bind("keyup", function () {
    recount(); // 计算字符数
  });

  $("#btn").click(function () {

    var content = $("#content").val();
    var phone = $("#phone").val();

    if (content == "") {
      alert("请输入留言内容");
      $("#content").focus();
      return false;
    }

    if (content.length > 500 ) {
      alert("留言内容不能超500个字符");
      $("#content").focus();
      return false;
    }

    if ($("#user_name").val().length > 10 ) {
      alert("留言人不能超10个字符");
      $("#user_name").focus();
      return false;
    }


    if (phone == "") {
      alert("请输入电话");
      $("#phone").focus();
      return false;
    }

    $.ajax({
      type: "GET", // 发送请求的方式 GET 或 POST
      url: "ajax/check_code.php", // 请求的php地址
      data: {code: $("#code").val()}, // 发送的参数
      async: false,
      success: function (html) {  // html为请求的php文件返回的内容
        if (html == "error") {
          alert("验证码错误！");
          $("#code").focus();
          return false;
        }  else if (html == "ok") {
          // 通过检查
          $("#commentForm").submit(); // 提交表单
        }
      }
    });

    return false;



  });

});


function recount() {
  $('#counter').html("已输入字符：" + $('#content').val().length);
}
</script>
</body>
</html>
