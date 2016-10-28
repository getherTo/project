<?php

// 启用session
session_start();


// 判断是否登录
if( !$_SESSION['is_auth'] ){
  header("Location: login.php");
}

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
			<div class="public-header-logo"><a href=""><img src="/my_admin/images/logo.gif"><h3 class="logo_title">新安人才网PHP培训班第8期</h3></a></div>
			<div class="public-header-admin fr">
				<div class="public-header-fun fr">
                    <p class="admin-name">用户名：<?php echo $_SESSION['user_name']?></p>
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
          <a href="user/list.php" target="mainframe">会员管理</a>

        </li>
				<li class="public-ifame-item">
					<a href="cv/list.php" target="mainframe">简历列表</a>

				</li>
                <li class="public-ifame-item">
                    <a href="news/news_category_list.php" target="mainframe">新闻分类列表</a>
                </li>
				<li class="public-ifame-item">
					<a href="news/news_list.php" target="mainframe">新闻列表</a>

				</li>

				<li class="public-ifame-item">
					<a href="gonggao/list.php" target="mainframe" >公告管理</a>

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