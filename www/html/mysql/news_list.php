<?php

header("Content-type: text/html; charset=utf-8");
// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}
// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'news');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}
// 设置mysql字符集 为 utf8
$link->query("set names utf8");
// 查询简历表中的用户信息
$sql = "select * from news where 1 ";
$result = mysqli_query($link, $sql);
$arr_news = mysqli_fetch_all($result, MYSQL_ASSOC);
//获取所有的新闻分类
$sql  = "select * from news_category ";
$result = mysqli_query($link, $sql);
$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);
$arr_news_category_value = array();
foreach($arr_news_category as $val ){
    $arr_news_category_value[$val['id']] = $val['name'];
}

?>

    <style>
        .cv td {
            text-align: center;
        }
    </style>

    <script>
        function deleteCv( id ){
            if( confirm("您确定要删除此新闻吗?") ){
                document.location.href = "delete.php?id=" + id ;
            }
        }
    </script>

    <div style="width: 960px;margin:10 auto">
        <h1 align="center">新闻信息</h1>
        <table width="960px">
            <tr align="left">
                <td width="50%">
                </td>
                <td align="right"><a href="news_add.php">添加新闻</a></td>
            </tr>
        </table>
        <table border="1px" width="960px" align="center" class="cv">
            <tr>
                <th>id</th>
                <th>分类id</th>
                <th>标题</th>
                <th>作者</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?

            if (count($arr_news) > 0) {
                foreach ($arr_news as $val) {
                    echo "<tr>";
                    echo "<td>{$val['id']}</td>";
                    echo "<td>{$val['category_id']}</td>";
                    echo "<td><a href='show.php'>{$val['title']}</a> </td>";
                    echo "<td>{$val['author']}</td>";
                    echo "<td>{$val['created_at']}</td>";
                    ?>
                    <td>
                        <a href="news_edit.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
                        <a href="news_delete.php?id=<?php echo $val['id'];?>">删除</a>
                    </td>
                    <?
                    echo " </tr>";
                }
            } else {
                echo "<tr><td colspan='6' align='center'>暂无记录！</td></tr>";
            }
            ?>

        </table>
    </div>
<?php
//  释放mysql的资源
mysqli_free_result($result);

// 关闭数据库
mysqli_close($link);



?>