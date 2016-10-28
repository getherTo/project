<?php
header("Content-type: text/html; charset=utf-8");
// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}
// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'zuoye');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}
// 设置mysql字符集 为 utf8
$link->query("set names utf8");
$sql = "select * from press where 1";

$sql_count =  "select count(*) as amount from press where 1 ";

$result_amount = mysqli_query($link, $sql_count);
$arr_amount = mysqli_fetch_array($result_amount, MYSQL_ASSOC);
$amount = $arr_amount['amount'];
// 每页的记录条数
$page_size = 2;
// 总页码
$max_page = ceil( $amount / $page_size );

// 获取当前页码
$page = intval($_GET['page']); // 获取page值，并转成int
if( $page <= 0 || $page > $max_page){  // 如果page值小于0，或是大于最大页码
    $page = 1;
}
// 上一页
$pre_page = $page -1;
if( $pre_page < 1 ){ // 如果上一页小于1
    $pre_page = 1;
}
// 下一页
$next_page = $page + 1;
if( $next_page > $max_page ){ // 如果下一页大于最大页码
    $next_page = $max_page;
}
// 分页计算， 计算分页的offset
$offset = ($page - 1 ) * $page_size;
$sql .= " limit $offset, $page_size ";

////获取所有的新闻分类
//$sql  = "select * from press_type ";
//$result = mysqli_query($link, $sql);
//$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);
//$arr_news_category_value = array();
//
//foreach($arr_news_category as $val ){
//    $arr_news_category_value[$val['id']] = $val['name'];
//}
$result = mysqli_query($link, $sql);
$arr_news = mysqli_fetch_all($result, MYSQL_ASSOC);
?>
    <style>
        .cv td {
            text-align: center;
        }
    </style>
    <div style="width: 960px;margin:10 auto">
        <h1 align="center">新闻信息</h1>
        <table width="960px">
            <tr align="left">
                <td width="50%">
                </td>
                <td align="right"><a href="1.php">添加新闻</a></td>
            </tr>
        </table>
        <table border="1px" width="960px" align="center" class="cv">
            <tr>
                <th>分类id</th>
                <th>标题</th>
                <th>内容</th>
                <th>作者</th>
                <th>创建时间</th>
            </tr>
            <?
            if (count($arr_news) > 0) {
                foreach ($arr_news as $val) {
                    echo "<tr>";
                    echo "<td>{$val['news_type']}</td>";
                    echo "<td>{$val['title']}</td>";
                    echo "<td>{$val['details']}</td>";
                    echo "<td>{$val['writer']}</td>";
                    echo "<td>{$val['creation_time']}</td>";
                    echo " </tr>";
                }
            }
            ?>

        </table>
        <div style="padding: 10px 0px">
            <a href="2.php">首页</a>
            <?php
            if( $page > 1 ){
                ?>
                <a href="2.php?page=<?php echo $pre_page;?>">上一页</a>
            <?
            }
            if( $page < $max_page ){
                ?>
                <a href="2.php?page=<?php echo $next_page;?>">下一页</a>
            <?
            }
            ?>
            <a href="2.php?page=<?php echo $max_page;?>">末页</a>
            /  总页码 <font color="red"><?php echo $max_page;?></font>页 当前页码 <font color="red"><?php echo $page;?></font>页
        </div>
    </div>

<?php


//  释放mysql的资源
mysqli_free_result($result);

// 关闭数据库
mysqli_close($link);



?>