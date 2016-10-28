<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台欢迎页</title>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/content.css" />
    <link rel="stylesheet" href="../css/public.css">

    <style>
        .news_search div{
            padding:5px;
            font-size: 14px;
            color: #333;
        }
        .search_title{
            text-align: center;
            font-size: 22px;
            color: #666;
            margin: 5px;
        }

        .news_page{
            float: right;
            width: 900px;
            padding:20px;
            text-align: left;
        }
        .news_page a{
            display: inline-block;
            margin:0 10px;
        }
    </style>

</head>
<body marginwidth="0" marginheight="0">

<?php

include_once "../common/db.php";




// 查询新闻
$sql = "select * from news where 1 ";
$sql_count =  "select count(*) as amount from news where 1 "; // 统计总记录数


// 根据查询条件，查询新闻
$str_search = "";
$sql_search = "";
if($_GET['category_id']){
    $sql_search = " and category_id = {$_GET['category_id']} ";
    $str_search = "&category_id=".$_GET['category_id'];
}
if( $_GET['title'] ){
    $sql_search .= " and title  like '%{$_GET['title']}%'";
    $str_search .= "&title=" . $_GET['title'];
}
if( $_GET['author'] ){
    $sql_search .= " and author = '{$_GET['author']}'";
    $str_search .= "&author=".$_GET['author'];
}

if( $_GET['date_from'] && $_GET['date_to'] ){
    $sql_search .= " and  created_at >= '{$_GET['date_from']}' and created_at <= '{$_GET['date_to']}' ";
    $str_search .= "&date_from=".$_GET['date_from'];
    $str_search .= "&date_to=".$_GET['date_to'];
}

$sql .= $sql_search;
$sql .= " order by created_at desc ";


$sql_count .= $sql_search;


// 获取总记录条数
$result_amount = mysqli_query($link, $sql_count);
$arr_amount = mysqli_fetch_array($result_amount, MYSQL_ASSOC);
// 总记录条数
$amount = $arr_amount['amount'];

// 每页的记录条数
$page_size = 10;

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
<script>
    function del( id ){
        if( confirm("您确定要删除此新闻吗?") ){
            document.location.href = "news_delete.php?id=" + id ;

        }
    }
</script>

<div class="container">



    <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">新闻列表</a></div>
    <div class="public-content">
        <div class="public-content-header">
            <div class="public-content-right fr">
                <a href="news_add.php" style="height: 24px; width: 60px;border: 1px solid #ccc;font-size: 12px;text-align:center">添加新闻</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="public-content-cont two-col">
            <div class="public-cont-left col-1">
                <div class="public-cont-title">
                    <h3 class="search_title">搜索</h3>
                </div>
                <div class="news_search">

                    <form action="" method="get">
                        <div>
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
                        </div>
                        <div>
                            标题：<br> <input type="text" name="title" value="<?php echo $_GET['title']?>" placeholder="请输入要查询的标题(模糊查询)" style="width: 150px">
                        </div>
                        <div>
                                作者：<br> <input type="text" name="author" value="<?php echo $_GET['author']?>" placeholder="请输入要查询的作者(精确查询)" style="width: 150px">
                        </div>
                        <div>
                                创建时间：<br> <input type="text"  name="date_from" value="<?php echo $_GET['date_from']?>" placeholder="请输入查询时间" style="width: 150px"><br>至<br><input type="text"  name="date_to" value="<?php echo $_GET['date_to']?>" placeholder="请输入查询时间" style="width: 150px">
                        </div>
                        <div>
                                <input type="submit" value="查询">
                        </div>
                    </form>

                </div>

            </div>
            <table class="public-cont-table col-2">
                <tr>
                    <th>新闻ID</th>
                    <th>分类名称</th>
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
                        echo "<td>{$arr_news_category_value[$val['category_id']]}</td>";
                        echo "<td>". mb_substr($val['title'], 0,15,"utf-8")."</td>";
                        echo "<td>{$val['author']}</td>";
                        echo "<td>{$val['created_at']}</td>";
                        ?>
                        <td>
                            <div class="table-fun">
                            <a href="news_edit.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
                            <a href="javascript:;" onclick="del(<?php echo $val['id']?>)">删除</a>
                            </div>
                        </td>
                        <?
                        echo " </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' align='center'>暂无记录！</td></tr>";
                }

                ?>
            </table>
            <div class="news_page">
                <a href="news_list.php">首页</a>
                <?php
                if( $page > 1 ){
                    ?>
                    <a href="news_list.php?page=<?php echo $pre_page;?><?php echo $str_search?>">上一页</a>
                <?
                }

                if( $page < $max_page ){
                    ?>
                    <a href="news_list.php?page=<?php echo $next_page;?><?php echo $str_search?>">下一页</a>
                <?
                }
                ?>
                <a href="news_list.php?page=<?php echo $max_page;?><?php echo $str_search?>">末页</a>
                / 总记录数<font color="red"><?php echo $amount;?></font>条记录 共<font color="red"><?php echo $max_page;?></font>页 当前为<font color="red"><?php echo $page;?></font>页
            </div>
        </div>
    </div>
</div>
</body>
</html>