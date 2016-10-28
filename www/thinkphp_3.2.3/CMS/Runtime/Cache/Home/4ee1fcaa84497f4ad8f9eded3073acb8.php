<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>编辑新闻</title>
    <link href="/thinkphp_3.2.3/Public/cms/css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/thinkphp_3.2.3/Public/cms/js/jquery.min.js"></script>
    <script type="text/javascript" src="/thinkphp_3.2.3/Public/cms/js/global.js"></script>
</head>
<body>

<div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3 align="center"><a href="/thinkphp_3.2.3/cms.php/Home/index/article.html" class="actionBtn">新闻分类</a>编辑分类</h3>
    <form method="POST" action="<?php echo U('index/update_news');?>">
        <input type="hidden" name="id" value="<?php echo ($news["id"]); ?>">

        <table align="center">
            <tr>
                <td> 新闻ID：  </td>
                <td><?php echo ($news["id"]); ?></td>
            </tr>
            <tr>
                <td> 新闻标题：</td>
                <td><input type="text" name="title" value="<?php echo ($news["title"]); ?>"  /> </td>
            </tr>
            <tr>
                <td> 新闻内容：</td>
                <td><textarea type="text" cols="80" rows="15"  name="content" value=""/><?php echo ($news["content"]); ?></textarea> </td>
            </tr>
            <tr>
                <td> 新闻作者：</td>
                <td><input type="text" name="author" value="<?php echo ($news["author"]); ?>"/> </td>
            </tr>
            <tr>
                <td> 新闻标签：</td>
                <td><input type="text" name="tag" value="<?php echo ($news["tag"]); ?>" /> </td>
            </tr>
            <tr>
                <td><input name="submit" class="btn" type="submit" value="提交" /></td>
            </tr>
        </table>

    </form>
</div>
</body>
</html>