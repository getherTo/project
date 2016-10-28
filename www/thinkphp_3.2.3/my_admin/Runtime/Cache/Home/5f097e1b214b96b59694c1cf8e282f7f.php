<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>新闻分类列表</title>
</head>
<body>
<h1>新闻分类列表</h1>
<h2><input type="button" onclick="adNews()" value="添加新闻分类"></h2>
<table border="1" width="1000px">
    <tr>
        <th>新闻分类ID</th>
        <th>分类名</th>
        <th>操作</th>
    </tr>
    <?php if(is_array($news_category)): $i = 0; $__LIST__ = $news_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news_category): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($news_category["id"]); ?></td>
            <td><?php echo ($news_category["name"]); ?></td>
            <td>
                <a href="/thinkphp_3.2.3/home/index/save/id/<?php echo ($news_category["id"]); ?>">编辑</a>&nbsp;
                <a href="javascript:void(0)" onclick="del('<?php echo ($news_category["id"]); ?>')">删除</a>&nbsp;
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<script>
    function del( id  ){
        if( confirm("您确定删除此新闻吗？") ){
            document.location.href = "/thinkphp_3.2.3/home/index/delete/id/" + id ;
        }
    }
    function adNews(){
        document.location.href = "/thinkphp_3.2.3/my_admin/home/view/index/add.html" ;

    }
</script>
</body>
</html>