<?php


header("Content-type: text/html; charset=utf-8");

// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}

// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'news_category ');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}

// 设置mysql字符集 为 utf8
$link->query("set names utf8");


// 查询简历表中的用户信息
$sql = "select * from news_category where 1 ";

$sql .= " order by id desc  ";
$sql .= " limit 50 ";
$result = mysqli_query($link, $sql);

$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);


?>

    <style>
        .cv td {
            text-align: center;
        }
    </style>

    <script>
        function deleteCv( id ){
            if( confirm("您确定要删除此新闻分类吗?") ){
                document.location.href = "delete.php?id=" + id ;
            }
        }
    </script>

    <div style="width: 960px;margin:10 auto">
        <h1 align="center">新闻分类信息</h1>
        <table width="960px">
            <tr align="left">
                <td width="50%">
                </td>
                <td align="right"><a href="news_category_add.php">添加分类</a></td>
            </tr>
        </table>
        <table border="1px" width="960px" align="center" class="cv">
            <tr>
                <th>id</th>
                <th>分类名称</th>
                <th>操作</th>
            </tr>

            <?

            if (count($arr_news_category) > 0) {
                foreach ($arr_news_category as $val) {
                    echo "<tr>";
                    echo "<td>{$val['id']}</td>";
                    echo "<td>{$val['name']}</td>";
                    ?>
                    <td>
                        <a href="news_category_edit.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
                        <a href="news_category_delete.php?id=<?php echo $val['id'];?>">删除</a>
                    </td>
                    <?
                    echo " </tr>";
                }
            } else {
                echo "<tr><td colspan='3' align='center'>暂无记录！</td></tr>";
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