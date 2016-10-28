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
$sql = "select * from zhuanpan_prizes order by id desc limit 100 "; // 查询语句
$result = mysqli_query($link, $sql);
$arr_prizes = mysqli_fetch_all($result, MYSQL_ASSOC);

?>

<script>
  function del( id ){
    if( confirm("您确定要删除此奖品吗?") ){
      document.location.href = "delete.php?id=" + id ;

    }
  }
</script>

<div class="container">



  <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">转盘奖品管理</a></div>
  <div class="public-content">
    <div class="public-content-header">
      <div class="public-content-right fl">
        <a href="add.php" style="height: 24px; width: 60px;border: 1px solid #ccc;font-size: 12px;text-align:center">添加</a>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="public-content-cont">
      <table class="public-cont-table">
        <tr>
          <th>id</th>
            <th>奖品名称</th>
            <th>图片</th>
            <th>转盘位置</th>
            <th>数量</th>
          <th>创建时间</th>
          <th>操作</th>
        </tr>
        <?

        if (count($arr_prizes) > 0) {
          foreach ($arr_prizes as $val) {
            echo "<tr>";
            echo "<td>{$val['id']}</td>";
            echo "<td>{$val['name']}</td>";
            echo "<td>";
            if($val['img']){
              echo "<img src='{$val['img']}' width='60px' height='60px'>";
            }

            echo "</td>";
            echo "<td>{$val['zhuanpan_index']}</td>";
            echo "<td>{$val['amount']}</td>";
            echo "<td>{$val['created_at']}</td>";
            ?>
            <td>
              <div class="table-fun">
              <a href="edit.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
              <a href="javascript:;" onclick="del(<?php echo $val['id'];?>)">删除</a>
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
    </div>
  </div>
</div>
</body>
</html>