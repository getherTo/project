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
$search_name = $_GET['name'];
$search_gender = $_GET['gender'];
$search_city = $_GET['city'];
$search_mobile = $_GET['mobile'];
$search_height_from= $_GET['height_from'];
$search_height_to = $_GET['height_to'];
$search_weight_from= $_GET['weight_from'];
$search_weight_to = $_GET['weight_to'];
if($_GET['order'] ){
  $order =  $_GET['order'];
} else {
  $order = "desc";
}
if($_GET['orderby'] ){
  $orderby =  $_GET['orderby'];
} else {
  $orderby = "id";
}



// 查询简历表中的用户信息
$sql = "select * from cv where 1 "; // 查询语句
$sql_count =  "select count(*) as amount from cv where 1 "; // 统计总记录数
$sql_search = ""; // sql 查询条件语句
$str_search = ""; // 查询条件
// 姓名
if ($search_name) {
  $sql_search = " and name like '%$search_name%'";
  $str_search = "&name=".$search_name;
}
// 性别
if ( $search_gender ) {
  $sql_search .= " and  gender = '$search_gender'";
  $str_search .= "&gender=".$search_gender;
}
// 城市
if ( $search_city ) {
  $sql_search .= " and  city = '$search_city'";
  $str_search .= "&city=".$search_city;
}
// 手机号码
// 城市
if ( $search_mobile ) {
  $sql_search .= " and  mobile like '%$search_mobile%'";
  $str_search .= "&mobile=".$search_mobile;
}
// 身高
if ( $search_height_from && $search_height_to ) {
  $sql_search .= " and  height >=  $search_height_from and height <= $search_height_to ";
  $str_search .= "&height_from=".$search_height_from."&height_to=".$search_height_to;
} else if ( $search_height_from ){
  $sql_search .= " and  height >=  $search_height_from  ";
  $str_search .= "&height_from=".$search_height_from;
}else if ( $search_height_to ){
  $sql_search .= " and  height <= $search_height_to ";
  $str_search .= "&height_to=".$search_height_to;
}

// 体重
if ( $search_weight_from && $search_weight_to ) {
  $sql_search .= " and  weight >=  $search_weight_from and weight <= $search_weight_to ";
  $str_search .= "&weight_from=".$search_weight_from."&weight_to=".$search_weight_to;
} else if ( $search_weight_from ){
  $sql_search .= " and  weight >=  $search_weight_from  ";
  $str_search .= "&weight_from=".$search_weight_from;
}else if ( $search_weight_to ){
  $sql_search .= " and  weight <= $search_weight_to ";
  $str_search .= "&weight_to=".$search_weight_to;
}

// 关联查询条件语句
$sql .= $sql_search;


// 设置排序
if( $order == "desc" ){
  $sql .= " order by $orderby desc  ";
  $str_order = "asc";
  $order_img = "down.png";
} else if(  $order == "asc" ) {
  $sql .= " order by $orderby asc  ";
  $str_order = "desc";
  $order_img = "up.png";
}
// 排序条件
$str_search_order =  $str_order . $str_search ;


// 查询条件，增加排序规则
$str_search .= "&order=$order&orderby=$orderby";

// 给排序保留查询条件
if($str_search){
  $str_order .= $str_search;
}


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
$result_cv = mysqli_query($link, $sql);

$arr_cvs = mysqli_fetch_all($result_cv, MYSQL_ASSOC);

// 调试语句，查看相关sql语句
//echo "<br>查询sql语句：<br> $sql <br><br>";
//echo "<br>统计总记录条数sql语句：<br> $sql_count <br><br>";


// 定义城市数组
$arr_city = ['亳州','六安','合肥','安庆','淮南','马鞍山','阜阳'];





?>

<script>
  function del( id ){
    if( confirm("您确定要删除此新闻吗?") ){
      document.location.href = "delete.php?id=" + id ;

    }
  }
</script>

<div class="container">



  <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">新闻列表</a></div>
  <div class="public-content">
    <div class="public-content-header">
      <div class="public-content-right fr">
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
              城市： <select name="city">
                <option value="">-请选择-</option>
                <?php
                foreach($arr_city as $val){
                  ?>
                  <option value="<?php echo $val;?>" <?php echo ($search_city==$val) ? "selected" : ""   ?>><?php echo $val;?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div>
              姓名：<input type="text" name="name" value="<?php echo $search_name ?>" placeholder="请输入用户姓名">
            </div>
            <div>
              手机号码：<input type="text" name="mobile" value="<?php echo $search_mobile ?>" placeholder="请输入手机号">
            </div>
            <div>
              性别: <select name="gender">
                <option value="">-请选择-</option>
                <option value="男" <?php if($search_gender=="男") echo "selected";?>>男</option>
                <option value="女" <?php if($search_gender=="女") echo "selected";?>>女</option>
              </select>
            </div>
            <div>
              身高：<input type="text" name="height_from" value="<?php echo $search_height_from ?>" placeholder="请输入身高">
              -
              <input type="text" name="height_to" value="<?php echo $search_height_to ?>" placeholder="请输入身高">
            </div>
            <div>
              体重：<input type="text" name="weight_from" value="<?php echo $search_weight_from ?>" placeholder="请输入身高">
              -
              <input type="text" name="weight_to" value="<?php echo $search_weight_to ?>" placeholder="请输入身高">

            </div>
            <div>
              <input type="submit" value="查询">
            </div>
          </form>

        </div>

      </div>
      <table class="public-cont-table col-2">
        <tr>
          <th>
            <a href="list.php?orderby=id&order=<?php echo $str_search_order;?>">id</a>
            <?php
            if($orderby == "id"){
              ?>
              <img src="../images/<?php echo $order_img?>">
            <?
            }
            ?>
          </th>
          <th>
            <a href="list.php?orderby=name&order=<?php echo $str_search_order;?>">姓名</a>
            <?php
            if($orderby == "name"){
              ?>
              <img src="../images/<?php echo $order_img?>">
            <?
            }
            ?>
          </th>
          <th>
            <a href="list.php?orderby=gender&order=<?php echo $str_search_order;?>">性别</a>
            <?php
            if($orderby == "gender"){
              ?>
              <img src="../images/<?php echo $order_img?>">
            <?
            }
            ?>
          </th>
          <th>
            <a href="list.php?orderby=city&order=<?php echo $str_search_order;?>">城市</a>
            <?php
            if($orderby == "city"){
              ?>
              <img src="../images/<?php echo $order_img?>">
            <?
            }
            ?>
          </th>
          <th>
            <a href="list.php?orderby=height&order=<?php echo $str_search_order;?>">身高</a>
            <?php
            if($orderby == "height"){
              ?>
              <img src="../images/<?php echo $order_img?>">
            <?
            }
            ?>
          </th>
          <th>
            <a href="list.php?orderby=weight&order=<?php echo $str_search_order;?>">体重</a>
            <?php
            if($orderby == "weight"){
              ?>
              <img src="../images/<?php echo $order_img?>">
            <?
            }
            ?>
          </th>
          <th>
            <a href="list.php?orderby=mobile&order=<?php echo $str_search_order;?>">手机号</a>
            <?php
            if($orderby == "mobile"){
              ?>
              <img src="../images/<?php echo $order_img?>">
            <?
            }
            ?>
          </th>
          <th>操作</th>
        </tr>
        <?

        if (count($arr_cvs) > 0) {
          foreach ($arr_cvs as $val) {
            echo "<tr>";
            echo "<td>{$val['id']}</td>";
            echo "<td>{$val['name']}</td>";
            echo "<td>{$val['gender']}</td>";
            echo "<td>{$val['city']}</td>";
            echo "<td>{$val['height']}</td>";
            echo "<td>{$val['weight']}</td>";
            echo "<td>{$val['mobile']}</td>";
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
          echo "<tr><td colspan='7' align='center'>暂无记录！</td></tr>";
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