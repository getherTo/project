<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>编辑新闻</title>
    <script type="text/javascript" charset="utf-8" src="/my_admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/my_admin/ueditor/ueditor.all.min.js"></script>
</head>
<body>

<div style="width: 900px; margin:10px auto">
    <h1>编辑新闻</h1>
    <form method="POST" action="/thinkphp_3.2.3/home/index/update_news">
    <input type="hidden" name="id" value="<?php echo ($news["id"]); ?>">
    标题：<input type="text" name="title" value="<?php echo ($news["title"]); ?>" /><br/>
    内容：  <script id="container" name="content" type="text/plain"><?php echo ($news["content"]); ?></script>
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            initialFrameWidth: 650,
            initialFrameHeight: 200
        });
        var ue = UE.getEditor('container');
    </script>


    <br/>
    作者：<input type="text" name="author" value="<?php echo ($news["author"]); ?>"  /><br/>
    标签：<input type="text" name="tag" value="<?php echo ($news["tag"]); ?>"  /><br/>
    <input type="submit" value="提交" />
</form>
</div>
</body>
</html>