<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DouPHP 管理中心 - 新闻列表 </title>
<meta name="Copyright" content="Douco Design." />
<link href="/Public/cms/css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/cms/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/cms/js/global.js"></script>
<script type="text/javascript" src="/Public/cms/js/jquery.autotextarea.js"></script>
</head>
<body>
<div id="dcWrap">
 <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="/Public/cms/images/dclogo.gif" alt="logo"></a></div>
  <div class="nav">
   <ul>
    <li class="M"><a href="JavaScript:void(0);" class="topAdd">新建</a>
     <div class="drop mTopad"><a href="product.php?rec=add">商品</a> <a href="article.php?rec=add">新闻</a> <a href="nav.php?rec=add">自定义导航</a> <a href="show.html">首页幻灯</a> <a href="page.php?rec=add">单页面</a> <a href="manager.php?rec=add">管理员</a> <a href="link.html"></a> </div>
    </li>
    <li><a href="../index.php" target="_blank">查看站点</a></li>
    <li><a href="index.php?rec=clear_cache">清除缓存</a></li>
    <li><a href="http://help.douco.com" target="_blank">帮助</a></li>
    <li class="noRight"><a href="module.html">DouPHP+</a></li>
   </ul>
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，admin</a>
     <div class="drop mUser">
      <a href="manager.php?rec=edit&id=1">编辑我的个人资料</a>
      <a href="manager.php?rec=cloud_account">设置云账户</a>
     </div>
    </li>
    <li class="noRight"><a href="login.php?rec=logout">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 --> <div id="dcLeft"><div id="menu">
 <ul class="top">
  <li><a href="index.html"><i class="home"></i><em>管理首页</em></a></li>
 </ul>
 <ul>
  <li><a href="system.html"><i class="system"></i><em>系统设置</em></a></li>
  <li><a href="nav.html"><i class="nav"></i><em>自定义导航栏</em></a></li>
  <li><a href="show.html"><i class="show"></i><em>首页幻灯广告</em></a></li>
  <li><a href="page.html"><i class="page"></i><em>单页面管理</em></a></li>
 </ul>
   <ul>
  <li><a href="product_category.html"><i class="productCat"></i><em>商品分类</em></a></li>
  <li><a href="product.html"><i class="product"></i><em>商品列表</em></a></li>
 </ul>
  <ul>
  <li><a href="article_category.html"><i class="articleCat"></i><em>新闻分类</em></a></li>
  <li class="cur"><a href="article.html"><i class="article"></i><em>新闻列表</em></a></li>
 </ul>
   <ul class="bot">
  <li><a href="backup.html"><i class="backup"></i><em>数据备份</em></a></li>
  <li><a href="mobile.html"><i class="mobile"></i><em>手机版</em></a></li>
  <li><a href="theme.html"><i class="theme"></i><em>设置模板</em></a></li>
  <li><a href="manager.html"><i class="manager"></i><em>网站管理员</em></a></li>
  <li><a href="manager_log.html"><i class="managerLog"></i><em>操作记录</em></a></li>
 </ul>
</div></div>
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">DouPHP 管理中心<b>></b><strong>新闻列表</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <h3><a href="addarticle.html?rec=add" class="actionBtn add">添加新闻</a>新闻列表</h3>
        <div id="list">
    <form name="action" method="post" action="article.php?rec=action">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
        <tr>
            <th>新闻ID</th>
            <th>标题</th>
            <th>内容</th>
            <th>作者</th>
            <th>标签</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($arr_news)): $i = 0; $__LIST__ = $arr_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($news["id"]); ?></td>
                <td><a href="/thinkphp_3.2.3/home/index/view_news/id/<?php echo ($news["id"]); ?>" target="_blank"><?php echo ($news["title"]); ?></a></td>
                <td><?php echo ($news["content"]); ?></td>
                <td><?php echo ($news["author"]); ?></td>
                <td><?php echo ($news["tag"]); ?></td>
                <td><?php echo ($news["created_at"]); ?></td>
                <td>
                    <a href="/thinkphp_3.2.3/cms.php/home/index/edit_newss/id/<?php echo ($news["id"]); ?>">编辑</a>&nbsp;
                    <a href="javascript:void(0)" onclick="del('<?php echo ($news["id"]); ?>')">删除</a>&nbsp;
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         </table>
        <script>
            function del( id  ){
                if( confirm("您确定删除此新闻吗？") ){
                    document.location.href = "/thinkphp_3.2.3/cms.php/home/index/delete_news/id/" + id ;
                }
            }
            function adNews(){
                document.location.href = "/thinkphp_3.2.3/cms.php/home/index/add_news" ;

            }
        </script>
    </form>
    </div>
    <div class="clear"></div>
    <div class="pager">总计 10 个记录，共 1 页，当前第 1 页 | <a href="article.php?page=1">第一页</a> 上一页 下一页 <a href="article.php?page=1">最末页</a></div>           </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   版权所有 © 2013-2015 漳州豆壳网络科技有限公司，并保留所有权利。
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
 <script type="text/javascript">
 
 onload = function()
 {
   document.forms['action'].reset();
 }

 function douAction()
 {
     var frm = document.forms['action'];

     frm.elements['new_cat_id'].style.display = frm.elements['action'].value == 'category_move' ? '' : 'none';
 }
 
 </script>
</body>
</html>