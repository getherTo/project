<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>编辑新闻分类</title>
    <link href="/thinkphp_3.2.3/Public/cms/css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/thinkphp_3.2.3/Public/cms/js/jquery.min.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3/Public/cms/js/global.js"></script>
</head>
<body>

<div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3 align="center"><a href="article_category.html" class="actionBtn">新闻分类</a>编辑分类</h3>
    <form method="POST" action="<?php echo U('index/update_news_category');?>">
<input type="hidden" name="id" value="<?php echo ($news_category["id"]); ?>">

        <table align="center">
            <tr>
                <td> 新闻分类ID：  </td>
                <td><?php echo ($news_category["id"]); ?></td>
                </tr>
            <tr>
                <td> 新闻分类名称：</td>
                <td><input type="text" name="name" value="<?php echo ($news_category["name"]); ?>"  /> </td>
               </tr>
            <tr>
               <td><input name="submit" class="btn" type="submit" value="提交" /></td>
            </tr>
        </table>

</form>
</div>
</body>
</html>