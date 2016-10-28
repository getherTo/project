<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台欢迎页</title>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/content.css" />
</head>

<?php

include_once "../common/db.php";


if( count($_POST)>0 ){


    if( $_POST['id'] ){
        $sql = "update news_category set name = '{$_POST['name']}'
            where id = {$_POST['id']} ";
    } else {
        $sql = "insert into news_category ( name  ) values ( '{$_POST['name']}')";

    }


    // 执行sql语句
    $result = mysqli_query($link, $sql);

    if($result){
        echo "添加成功！";
        // 直接跳转进入列表
        header("Location: news_category_list.php");
    } else {

        echo "添加失败！";
        echo mysqli_error($link);
        exit;

    }

}


// 查询新闻分类表中信息
$sql = "select * from news_category where 1 ";

$sql .= " order by id desc  ";
$sql .= " limit 100 ";
$result = mysqli_query($link, $sql);

$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);


if( $_GET['id'] ){
    // 取出需要编辑的新闻分类
    $sql = "select * from news_category where id = " . $_GET['id'] ;
    $result = mysqli_query($link, $sql);
    $news_category = mysqli_fetch_array($result, MYSQL_ASSOC);
}


?>


<body marginwidth="0" marginheight="0">
<div class="container">
    <div class="public-nav">您当前的位置：<a href="">管理首页</a>><a href="">分类管理</a></div>
    <div class="public-content">
        <div class="public-content-cont two-col">
            <div class="public-cont-left">
                <div class="public-cont-title">
                    <h3><?php echo ($_GET['id']) ? "编辑" : "添加" ?>分类</h3>
                </div>

                <form method="post" action="" name="form1">
                <?php
                if($_GET['id']){
                    ?>
                    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                    <?
                }
                ?>
                <div class="form-group ">
                    <label for="">分类名称</label>
                    <input type="text" name="name" value="<?php echo $news_category['name'];?>" class="form-input-small" required>
                </div>
                <div class="form-group mt0" style="text-align:center;margin-top:15px;">
                    <input type="submit" class="sub-btn" value="提   交">
                </div>

                 </form>
            </div>
            <table class="public-cont-table">
                <tr>
                    <th style="width:20%">分类ID</th>
                    <th style="width:30%">分类名称</th>
                    <th style="width:30%">操作</th>
                </tr>

                <?

                if (count($arr_news_category) > 0) {
                    foreach ($arr_news_category as $val) {
                        echo "<tr>";
                        echo "<td>{$val['id']}</td>";
                        echo "<td>{$val['name']}</td>";
                        ?>
                        <td>
                            <div class="table-fun">
                            <a href="news_category_list.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
                            <a href="javascript:;" onclick="del(<?php echo $val['id']?>)">删除</a>
                            </div>
                        </td>
                        <?
                        echo " </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' align='center'>暂无记录！</td></tr>";
                }

                ?>



            </table>
        </div>
    </div>
</div>
<script>
    function del(id){
        if( confirm("请确认删除吗?")){
            document.location.href = "news_category_delete.php?id=" + id ;
        }
    }
</script>
</body>
</html>