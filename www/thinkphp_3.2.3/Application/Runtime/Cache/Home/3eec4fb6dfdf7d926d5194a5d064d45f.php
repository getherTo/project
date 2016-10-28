<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>新闻详情-<?php echo ($news["title"]); ?></title>
</head>
<body>

<h1><?php echo ($news["title"]); ?></h1>
<p>发布时间: <?php echo ($news["created_at"]); ?></p>
<div style="border: 1px solid #a9a9a9;margin: 10px;padding: 10px;line-height: 34px;font-size: 18px;">
    <?php echo (htmlspecialchars_decode($news["content"])); ?>
</div>

</body>
</html>