<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>蓝色企业集团公司网站模板</title>
<link type="text/css" href="/thinkphp_3.2.3/Public/home/css/style.css" rel="stylesheet" />
<link type="text/css" href="/thinkphp_3.2.3/Public/home/css/nav.css" rel="stylesheet" />
<link type="text/css" href="/thinkphp_3.2.3/Public/home/css/news.css" rel="stylesheet" />
<script language="javascript" src="/thinkphp_3.2.3/Public/home/js/jquery-1.7.2.min.js"></script>
<script language="javascript" src="/thinkphp_3.2.3/Public/home/js/nav.js"></script>
<script language="javascript" src="/thinkphp_3.2.3/Public/home/js/png.js"></script>
<script language="javascript" src="/thinkphp_3.2.3/Public/home/js/jquery.pack.js"></script>
<script language="javascript" src="/thinkphp_3.2.3/Public/home/js/slide.js"></script>


<script type="text/javascript" src="/thinkphp_3.2.3/Public/home/js/jwplayer.js" ></script>
</head>

<body>
<!-- header -->
<div class="head">
	<div class="top">
		<div class="line_01">
			<p class="logo"><a href="/" class="index"><img src="/thinkphp_3.2.3/Public/home/images/logo.png" width="162" height="56" /></a></p>
			<form action="/e/search/index.php" method="post" name="searchform" id="searchform">
						<p class="search">
							<input type="text" value="" name='keyboard' id='keyboard' class="s_text"/>
							<input type="submit" value="搜索" class="s_btn"/>
						</p>
			</form>
		</div>
		<div class="header_all">
            <div class="nav" id="nav">
                    <p class="n_left_bg"><a href="index.html" class="index">首页</a></p>
                    <ul>
                      <li><span class="v"><a href="guanyulantian.html" class="about">关于蓝天</a></span>
 <div class="bg">
                                <div class="b_link">
                   
<a href="/guanyulantian/dongshichangzhici/">董事长致辞</a>


<a href="/guanyulantian/gongsijieshao/">公司介绍</a>


<a href="/guanyulantian/guanlituandui/">管理团队</a>


                </div>
                            </div>


</li><li><span class="v"><a href="news.html" class="news">新闻中心</a></span>
 <div class="bg">
                                <div class="b_link">
                   
<a href="/xinwenzhongxin/jituanyaowen/">集团要闻</a>


<a href="/xinwenzhongxin/xingyexinxi/">行业信息</a>


<a href="/xinwenzhongxin/hongguanhuanjing/">宏观环境</a>


                </div>
                            </div>


</li><li><span class="v"><a href="#" class="industry">蓝天产业</a></span>
 <div class="bg">
                                <div class="b_link">
                   
<a href="/lantianchanye/lantiantouzi/">蓝天投资</a>


<a href="/lantianchanye/lantianranqi/">蓝天燃气</a>


<a href="/lantianchanye/lantiannongye/">蓝天农业</a>


<a href="/lantianchanye/lantianzhiye/">蓝天置业</a>


<a href="/lantianchanye/lantiankuangye/">蓝天矿业</a>


<a href="/lantianchanye/lantianshihua/">蓝天石化</a>


                </div>
                            </div>


</li><li><span class="v"><a href="#" class="careers">人力资源</a></span>
 <div class="bg">
                                <div class="b_link">
                   
<a href="/renliziyuan/rencaipeixun/">人才培训</a>


<a href="/renliziyuan/rencaizhaopin/">人才招聘</a>


<a href="/renliziyuan/rencailinian/">人才理念</a>


                </div>
                            </div>


</li><li><span class="v"><a href="#" class="party">企业党建</a></span>
 <div class="bg">
                                <div class="b_link">
                   
<a href="/qiyedangjian/dangweigongzuo/">党委工作</a>


<a href="/qiyedangjian/tuanweigongzuo/">团委工作</a>


                </div>
                            </div>


</li><li><span class="v"><a href="#" class="cultrue">企业文化</a></span>
 <div class="bg">
                                <div class="b_link">
                   
<a href="/qiyewenhua/qiyelinian/">企业理念</a>


<a href="/qiyewenhua/zhinenglinian/">职能理念</a>


<a href="/qiyewenhua/qiyebiaoshi/">企业标示</a>


<a href="/qiyewenhua/banchejingshen/">板车精神</a>


<a href="/qiyewenhua/wenhuahuodong/">文化活动</a>


                </div>
                            </div>


</li><li><span class="v"><a href="#" class="contact">联系我们</a></span>
 <div class="bg">
                                <div class="b_link">
                   
<a href="/lianxiwomen/jituanzongbu/">集团总部</a>


<a href="/lianxiwomen/liuyanban/">留言板</a>


                </div>
                            </div>


</li>                    </ul>
                 
                    <div class="clear"></div>
              </div>
		</div>
      	<div class="clear"></div>
  	</div>
    
</div>
<!-- header end -->

<div class="wrap">
<div class="banner banner_pic">
	<div class="ban_pic"><img src="/thinkphp_3.2.3/Public/home/images/xwzx.jpg" /></div>
</div>
<div class="us">
	<div class="p_center">
    	<div class="tit">
        	<h2>新闻中心</h2>
            <p>
                   
<a href="/xinwenzhongxin/jituanyaowen/">集团要闻</a>


<a href="/xinwenzhongxin/xingyexinxi/">行业信息</a>


<a href="/xinwenzhongxin/hongguanhuanjing/">宏观环境</a>


               </p>
        </div>
         <div class="p_list">
        	<ul>
                <?php if(is_array($arr_news)): $i = 0; $__LIST__ = $arr_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><li><?php echo ($news["title"]); ?><span><?php echo ($news["created_at"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
        </div>
		
<div class="new_right">
<ul>
<li >
<a target="_blank" href="#" class="another" style="background:none; padding:0px; color:#164F85;">最新新闻</a>
</li>
<script src='/d/js/js/newnews.js'></script>
</ul>
</div>
<div class="clear"></div>

        <div class="page">
			

            <?php echo ($pager->show()); ?>

        </div>



    </div>
</div>
</div>
<!-- 页脚 -->
<div class="foot">
	<P>COPYRIGHT BY @2011 HENAN LANTIAN GROUP CO.,LTD. ALL RIGHT RESERVED</P>
	<p>版权所有：河南蓝天集团有限公司 网站备案号：豫ICP备05008790号</p>
</div>
</body>
</html>