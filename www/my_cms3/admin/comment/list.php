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
            width: 800px;
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
include_once "../common/function.php";


// 查询新闻
$sql = "select * from comment where 1 ";
$sql .= " order by created_at desc ";
$sql_count =  "select count(*) as amount from comment where 1 "; // 统计总记录数



// 获取总记录条数
$result_amount = mysqli_query($link, $sql_count);
$arr_amount = mysqli_fetch_array($result_amount, MYSQL_ASSOC);
// 总记录条数
$amount = $arr_amount['amount'];

// 每页的记录条数
$page_size = 10;

$page = $_GET['page'];
if($page <= 0){
  $page = 1;
}

// 分页计算， 计算分页的offset
$offset = ($page - 1 ) * $page_size;
$sql .= " limit $offset, $page_size ";
$result = mysqli_query($link, $sql);

$arr_comments = mysqli_fetch_all($result, MYSQL_ASSOC);


?>

<script>
    function del( id ){
        if( confirm("您确定要删除此评论吗吗?") ){
            document.location.href = "delete.php?id=" + id ;

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
        <div class="public-content-cont">
            <table class="public-cont-table">
                <tr>
                    <th>用户名</th>
                    <th>评论内容</th>
                    <th>电话</th>
                    <th>性别</th>
                    <th>城市</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                <?
                if (count($arr_comments) > 0) {
                    foreach ($arr_comments as $val) {
                        echo "<tr>";
                        echo "<td>". mb_substr($val['user_name'], 0,15,"utf-8")."</td>";
                        echo "<td>". mb_substr($val['content'], 0,50,"utf-8")."</td>";
                        echo "<td>". $val['phone']."</td>";
                        echo "<td>". $val['sex']."</td>";
                        echo "<td>". $val['city']."</td>";
                        echo "<td>{$val['created_at']}</td>";
                        ?>
                        <td>
                            <div class="table-fun">
                            <a href="javascript:;" onclick="del(<?php echo $val['id']?>)">删除</a>
                            </div>
                        </td>
                        <?
                        echo " </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' align='center'>暂无记录！</td></tr>";
                }

                ?>
            </table>
            <div class="news_page">
              <?php echo getPage($amount, $page_size, $page);?>
            </div>
        </div>
    </div>
</div>
</body>
</html>