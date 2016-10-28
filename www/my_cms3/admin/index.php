<?php

include_once "common/common.php";
include_once "common/checklogin.php"

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/public.css">

</head>
<body>
<div class="public-header-warrp">
	<div class="public-header">
		<div class="content">
			<div class="public-header-logo"><a href=""><img src="<?php echo MY_DIR;?>/admin/images/logo.gif"><h3 class="logo_title" style="width: 4000px">新安人才网PHP培训班第8期-管理后台</h3></a></div>
			<div class="public-header-admin fr">
				<div class="public-header-fun fr">
                    <p class="admin-name" style="display: inline-block; width: 150px">用户名：<?php echo $_SESSION['user_name']?></p>
                    <a href="logout.php" class="public-header-loginout"> 退 出 </a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<!-- 内容展示 -->
<div class="public-ifame mt20">
	<div class="content">

		<div class="clearfix"></div>
		<!-- 左侧导航栏 -->
		<div class="public-ifame-leftnav">
			<div class="public-title-warrp">
				<div class="public-ifame-title ">
					<a href="">首页</a>
				</div>
			</div>
			<ul class="left-nav-list">
				<li class="public-ifame-item">
          <a href="user/list.php" target="mainframe">管理员列表</a>

        </li>
				<li class="public-ifame-item">
					<a href="homeImgs/list.php" target="mainframe">首页轮播大图</a>
				</li>
        <li class="public-ifame-item">
          <a href="homeRecommend/list.php" target="mainframe">首页推荐</a>
        </li>
                <li class="public-ifame-item">
                    <a href="about/list.php" target="mainframe">关于我们</a>
                </li>
                <li class="public-ifame-item">
                    <a href="news/news_category_list.php" target="mainframe">新闻分类</a>
                </li>

                <li class="public-ifame-item">
                    <a href="news/news_list.php" target="mainframe">新闻列表</a>
                </li>

                <li class="public-ifame-item">
                    <a href="comment/list.php" target="mainframe">留言反馈</a>
                </li>
                <li class="public-ifame-item">
                    <a href="zhuanpanPrizes/list.php" target="mainframe">转盘奖品</a>
                </li>
                <li class="public-ifame-item">
                    <a href="zhuanpanUsers/list.php" target="mainframe">转盘中奖用户</a>
                </li>
			</ul>
		</div>
		<!-- 右侧内容展示部分 -->
		<div class="public-ifame-content">
		<iframe  src="main.html" frameborder="0" id="mainframe"  name="mainframe" scrolling="yes" marginheight="0" marginwidth="0" width="100%" style="height: 700px;"></iframe>
		</div>
	</div>
</div>
</body>
</html>