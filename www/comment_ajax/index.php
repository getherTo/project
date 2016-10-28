<?php

//载入 数据库连接文件
include_once 'db.php';

// 载入公用函数库文件
include_once 'function.php';

// 查询所有评论信息
$sql = "select * from comment order by id desc limit 100";
$query = mysqli_query($link, $sql);
$results = mysqli_fetch_all($query, MYSQL_ASSOC);
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>评论说说 - ajax</title>
  <link rel="stylesheet" type="text/css" href="css/main.css"/>
  <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/global.js"></script>
</head>
<body>

<div id="main">

  <h2 class="top_title"> PHP+Mysql+jQuery实现发布评论说说</h2>

  <div class="demo">
    <form id="myform" action="" method="post">
      <h3><span class="counter">140</span>说说你正在做什么...</h3>
       <input type="text" name="user_name" id="user_name" value="" placeholder="请输入昵称">
      <textarea name="saytxt" id="saytxt" class="input" rows="2" cols="40" placeholder="请输入评论内容"></textarea>
      <p>
          <!-- 图片提交按钮 -->
        <input type="image" src="images/btn.gif" class="sub_btn" alt="发布"/>
        <span id="msg"></span>
      </p>
    </form>
    <div class="clear"></div>
    <div id="saywrap">
      <?php
      if (count($results) > 0) {
        foreach ($results as $val) {
          echo formatSay($val[content], $val[created_at], $val[user_name]);
        }
      } else {
          echo "<p id='no_record'>暂无记录！</p>";
      }
      ?>
    </div>
  </div>
</div>


</body>
</html>