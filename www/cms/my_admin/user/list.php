<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>后台欢迎页</title>
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/content.css" />
  <link rel="stylesheet" href="../css/public.css">

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

// 获取查询条件
$search_name = $_GET['name'];
$search_mobile = $_GET['mobile'];

// 查询用户信息
$sql = "select * from user where 1 "; // 查询语句
$sql_count =  "select count(*) as amount from user where 1 "; // 统计总记录数
$sql_search = ""; // sql 查询条件语句
$str_search = ""; // 查询条件
// 姓名
if ($search_name) {
    $sql_search = " and user_name like '%$search_name%'";
    $str_search = "&user_name=".$search_name;
}
// 性别
if ( $search_gender ) {
    $sql_search .= " and  gender = '$search_gender'";
    $str_search .= "&gender=".$search_gender;
}
// 城市
if ( $search_mobile ) {
    $sql_search .= " and  mobile like '%$search_mobile%'";
    $str_search .= "&mobile=".$search_mobile;
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
$result_users = mysqli_query($link, $sql);

$arr_users = mysqli_fetch_all($result_users, MYSQL_ASSOC);

// 调试语句，查看相关sql语句
//echo "<br>查询sql语句：<br> $sql <br><br>";
//echo "<br>统计总记录条数sql语句：<br> $sql_count <br><br>";



?>

<div class="container">



  <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">用户列表</a></div>
  <div class="public-content">
    <div class="public-content-header">
      <div class="public-content-right fr">
        <a href="add.php" style="height: 24px; width: 60px;border: 1px solid #ccc;font-size: 12px;text-align:center">添加用户</a>
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
              用户名：<br> <input type="text" name="user_name" value="<?php echo $_GET['user_name']?>" placeholder="  " style="width: 150px">
            </div>
            <div>
              手机号：<br> <input type="text" name="mobile" value="<?php echo $_GET['mobile']?>" placeholder="" style="width: 150px">
            </div>
            <div>
              <input type="submit" value="查询">
            </div>
          </form>

        </div>

      </div>
      <table class="public-cont-table col-2">
        <tr>
          <th>用户ID</th>
          <th>用户名</th>
          <th>性别</th>
          <th>手机号</th>
          <th>创建时间</th>
          <th>操作</th>
        </tr>
        <?
        if (count($arr_users) > 0) {
          foreach ($arr_users as $val) {
            echo "<tr>";
            echo "<td>{$val['id']}</td>";
            echo "<td>{$val['user_name']}</td>";
            echo "<td>{$val['sex']}</td>";
            echo "<td>{$val['mobile']}</td>";
            echo "<td>{$val['created_at']}</td>";
            ?>
            <td>
              <div class="table-fun">
                <a href="edit.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
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
        <a href="list.php">首页</a>
        <?php
        if( $page > 1 ){
          ?>
          <a href="list.php?page=<?php echo $pre_page;?><?php echo $str_search?>">上一页</a>
        <?
        }

        if( $page < $max_page ){
          ?>
          <a href="list.php?page=<?php echo $next_page;?><?php echo $str_search?>">下一页</a>
        <?
        }
        ?>
        <a href="list.php?page=<?php echo $max_page;?><?php echo $str_search?>">末页</a>
        / 总记录数<font color="red"><?php echo $amount;?></font>条记录 共<font color="red"><?php echo $max_page;?></font>页 当前为<font color="red"><?php echo $page;?></font>页
      </div>
    </div>
  </div>
</div>
</body>
</html>