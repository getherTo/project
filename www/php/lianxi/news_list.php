<?php

// 调试信息
//error_reporting(E_ALL);  // 显示所有错误
//error_reporting(E_ALL &  ~ E_NOTICE); // 显示所有错误, 忽略notice错误

header("Content-type: text/html; charset=utf-8");

// 引用db.php
include "3.php";
// 查询新闻
$sql = "select * from news where 1 ";

// 根据查询条件，查询新闻
$str_search = "";
if($_GET['category_id']){
    $sql .= " and category_id = {$_GET['category_id']} ";
    $str_search = "&category_id=".$_GET['category_id'];
}
if( $_GET['title'] ){
    $sql .= " and title  like '%{$_GET['title']}%'";
    $str_search .= "&title=".$_GET['title'];
}
if( $_GET['author'] ){
    $sql .= " and author= '{$_GET['author']}'";
    $str_search .= "&author=".$_GET['author'];
}
if( $_GET['date_from'] && $_GET['date_to'] ){
    $sql .= " and  created_at >= '{$_GET['date_from']}' and created_at <= '{$_GET['date_to']}' ";
    $str_search .= "&date_from=".$_GET['date_from'];
    $str_search .= "&date_to=".$_GET['date_to'];
}


$sql .= " order by created_at ";

// 获取排序信息
$order = $_GET['order'];
if(!$order) $order = "desc";
$sql .= " $order";

// 获取排序图标
if( $order == "desc" ){
    $order_img = "down.png";
} else {
    $order_img = "up.png";
}

$sql .= " limit 50 ";

// 输出sql语句，查看是否正确
// echo $sql;
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
    <div style="width: 1200px;margin:10 auto">
        <h1 align="center">新闻信息</h1>
        <table width="1200">
            <form action="" method="get">
            <tr align="left">
                <td width="85%">
                    新闻分类
                    <select name="category_id">
                        <option value="">-请选择-</option>
                        <?php
                           foreach( $arr_news_category_value as $key => $val ){
                               ?>
                               <option value="<?php echo $key;?>" <?php if($_GET['category_id']==$key) echo "selected";?>><?php echo $val;?></option>
                               <?php
                           }
                        ?>
                     </select>
                    标题： <input type="text" name="title" value="<?php echo $_GET['title']?>" placeholder="请输入要查询的标题(模糊查询)" style="width: 180px">
                    作者： <input type="text" name="author" value="<?php echo $_GET['author']?>" placeholder="请输入要查询的作者(精确查询)" style="width: 180px">
                    创建时间： <input type="text"  name="date_from" value="<?php echo $_GET['date_from']?>" placeholder="请输入查询时间" style="width: 100px">至<input type="text"  name="date_to" value="<?php echo $_GET['date_to']?>" placeholder="请输入查询时间" style="width: 100px">
                    <input type="submit" value="查询">
                </td>
                <td align="right"><a href="1.php">添加新闻</a></td>
            </tr>
            </form>
        </table>
        <table border="1px" width="1200px" align="center" class="cv">
            <tr>
                <th>id</th>
                <th>分类名称</th>
                <th>标题</th>
                <th>作者</th>
                <th>
                    <a href="?order=<?=($order=="desc")?"asc":"desc"?><?php echo $str_search;?>">创建时间</a>
                    <img src="/images/icon/png_16x16/<?php echo $order_img;?>">
                </th>
                <th>操作</th>
            </tr>
            <?
            if (count($arr_news) > 0) {
                foreach ($arr_news as $val) {
                    echo "<tr>";
                    echo "<td>{$val['id']}</td>";
                    echo "<td>{$arr_news_category_value[$val['category_id']]}</td>";
                    echo "<td><a href='show.php?id={$val['id']}' target='_blank'>{$val['title']}</a></td>";
                    echo "<td>{$val['author']}</td>";
                    ?>
                    <td><?php echo $val['created_at']?></td>
                    <?php
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