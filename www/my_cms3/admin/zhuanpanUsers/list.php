<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>后台欢迎页</title>
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/content.css" />
  <link rel="stylesheet" href="../css/public.css">

  <style>
    a{
      display: inline-block;
    }
  </style>

</head>
<body marginwidth="0" marginheight="0">

<?php

include_once "../common/checklogin.php";
include_once "../common/db.php";
include_once "../common/function.php";



// 查询
$sql = "select * from zhuanpan_users order by id desc limit 100"; // 查询语句
$result = mysqli_query($link, $sql);
$arr_users = mysqli_fetch_all($result, MYSQL_ASSOC);

?>

<script>
  function del( id ){
    if( confirm("您确定要删除此中奖用户吗?") ){
      document.location.href = "delete.php?id=" + id ;

    }
  }
</script>

<div class="container">



  <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">转盘中奖用户</a></div>
  <div class="public-content">
    <div class="clearfix"></div>
    <div class="public-content-cont">
      <table class="public-cont-table">
        <tr>
            <th>中奖用户id</th>
            <th>中奖用户名</th>
            <th>奖品id</th>
            <th>奖品名称</th>
          <th>中奖时间</th>
          <th>操作</th>
        </tr>
        <?

        if (count($arr_users) > 0) {
          foreach ($arr_users as $val) {
            echo "<tr>";
            echo "<td>{$val['user_id']}</td>";
            echo "<td>{$val['user_name']}</td>";
            echo "<td>{$val['prize_id']}</td>";
            echo "<td>{$val['prize_name']}</td>";
            echo "<td>{$val['created_at']}</td>";
            ?>
            <td>
              <div class="table-fun">
              <a href="javascript:;" onclick="del(<?php echo $val['id'];?>)">删除</a>
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
    </div>
  </div>
</div>
</body>
</html>