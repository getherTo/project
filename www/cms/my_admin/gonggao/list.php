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
    .news_search input{
      width:140px;
      margin:5px 0px;
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
    a{
      display: inline-block;
    }
  </style>

</head>
<body marginwidth="0" marginheight="0">

<?php

include_once "../common/db.php";
include_once "../common/function.php";



// 获取查询条件
$search_title = $_GET['title'];



// 查询简历表中的用户信息
$sql = "select * from gonggao where 1 "; // 查询语句
$sql_count =  "select count(*) as amount from gonggao where 1 "; // 统计总记录数
$sql_search = ""; // sql 查询条件语句
$str_search = ""; // 查询条件
// 姓名
if ($search_title) {
  $sql_search = " and title like '%$search_name%'";
  $str_search = "&title=".$search_title;
}

// 关联查询条件语句
$sql .= $sql_search;
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


// 获取查询条件相关记录
$result = mysqli_query($link, $sql);

$arr_gonggao = mysqli_fetch_all($result, MYSQL_ASSOC);

// 调试语句，查看相关sql语句
//echo "<br>查询sql语句：<br> $sql <br><br>";
//echo "<br>统计总记录条数sql语句：<br> $sql_count <br><br>";



?>

<script>
  function del( id ){
    if( confirm("您确定要删除此公告吗?") ){
      document.location.href = "delete.php?id=" + id ;

    }
  }
</script>

<div class="container">



  <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">新闻列表</a></div>
  <div class="public-content">
    <div class="public-content-header">
      <div class="public-content-right fl">
        <a href="add.php" style="height: 24px; width: 60px;border: 1px solid #ccc;font-size: 12px;text-align:center">添加</a>
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
              标题：<input type="text" name="title" value="<?php echo $search_name ?>" placeholder="请输入用户姓名">
            </div>
            <div>
              <input type="submit" value="查询">
            </div>
          </form>

        </div>

      </div>
      <table class="public-cont-table col-2">
        <tr>
          <th>id</th>
          <th>图片</th>
          <th>标题</th>
          <th>创建时间</th>
          <th>操作</th>
        </tr>
        <?

        if (count($arr_gonggao) > 0) {
          foreach ($arr_gonggao as $val) {
            echo "<tr>";
            echo "<td>{$val['id']}</td>";
            echo "<td>{$val['title']}</td>";
            echo "<td>";
            if($val['avatar']){
              echo "<img src='{$val['avatar']}' width='60px' height='60px'>";
            }

            echo "</td>";
            echo "<td>{$val['created_at']}</td>";
            ?>
            <td>
              <div class="table-fun">
              <a href="edit.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
              <a href="delete.php?id=<?php echo $val['id'];?>">删除</a>
              </div>
            </td>
            <?
            echo " </tr>";
          }
        } else {
          echo "<tr><td colspan='5' align='center'>暂无记录！</td></tr>";
        }

        ?>
      </table>

      <div class="news_page">
        <?php echo getPage($amount, 10, $page, $str_search); ?>
      </div>

    </div>
  </div>
</div>
</body>
</html>