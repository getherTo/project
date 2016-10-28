<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>新闻列表</title>
</head>
<body>

<h1>新闻列表</h1>
<h2><input type="button" onclick="adNews()" value="添加新闻"></h2>

<table border="1" width="1000px">
    <tr>
        <th>新闻ID</th>
        <th>标题</th>
        <th>作者</th>
        <th>标签</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <?php if(is_array($arr_news)): $i = 0; $__LIST__ = $arr_news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($news["id"]); ?></td>
            <td><a href="/thinkphp_3.2.3/home/index/view_news/id/<?php echo ($news["id"]); ?>" target="_blank"><?php echo ($news["title"]); ?></a></td>
            <td><?php echo ($news["author"]); ?></td>
            <td><?php echo ($news["tag"]); ?></td>
            <td><?php echo ($news["created_at"]); ?></td>
            <td>
                <a href="/thinkphp_3.2.3/home/index/edit_news/id/<?php echo ($news["id"]); ?>">编辑</a>&nbsp;
                <a href="javascript:void(0)" onclick="del('<?php echo ($news["id"]); ?>')">删除</a>&nbsp;
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<script>
    function del( id  ){
        if( confirm("您确定删除此新闻吗？") ){
            document.location.href = "/thinkphp_3.2.3/home/index/delete_news/id/" + id ;
        }
    }
    function adNews(){
        document.location.href = "/thinkphp_3.2.3/home/index/add_news" ;

    }
</script>

</body>
</html>