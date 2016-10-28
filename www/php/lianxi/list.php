<?php

// 显示所有的错误
error_reporting(E_ALL & ~E_NOTICE  );
header("Content-type: text/html; charset=utf-8");
// 连接mysql数据库
$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    echo "connect mysql error!";
    exit();
}
// 选中数据库 my_db为数据库的名字
$db_selected = mysqli_select_db($link, 'fei');
if (!$db_selected) {
    echo "<br>selected db error!";
    exit();
}
// 设置mysql字符集 为 utf8
$link->query("set names utf8");
// 查询简历表中的用户信息
$sql = "select * from cv where 1 "; // 查询语句
$sql_count =  "select count(*) as amount from cv where 1 "; // 统计总记录数
$sql_search = ""; // sql 查询条件语句
$sql .= $sql_search;
$sql .= " order by id asc  ";
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
?>
    <style>
        .cv td {
            text-align: center;
        }
    </style>
    <div style="width: 960px;margin:10 auto">
        <h1 align="center">个人简历信息</h1>
        <table border="1px" width="960px" align="center" class="cv">
            <tr>
                <th>id</th>
                <th>姓名</th>
                <th>性别</th>
                <th>城市</th>
                <th>身高</th>
                <th>体重</th>
                <th>手机号</th>
                <th>操作</th>
            </tr>
            <?
            if (count($arr_cvs) > 0) {
                foreach ($arr_cvs as $val) {
                    echo "<tr>";
                    echo "<td>{$val['id']}</td>";
                    echo "<td>{$val['name']}</td>";
                    echo "<td>{$val['sex']}</td>";
                    echo "<td>{$val['city']}</td>";
                    echo "<td>{$val['height']}</td>";
                    echo "<td>{$val['weight']}</td>";
                    echo "<td>{$val['mobile']}</td>";
                    ?>
                    <td>
                        <a href="edit.php?id=<?php echo $val['id'];?>">编辑</a>&nbsp;
                        <a href="delete.php?id=<?php echo $val['id'];?>">删除</a>
                    </td>
                    <?
                    echo " </tr>";
                }
            } else {
                echo "<tr><td colspan='7' align='center'>暂无记录！</td></tr>";
            }

            ?>
        </table>
        <div style="padding: 10px 0px">
            <a href="list.php">首页</a>
            <?php
            if( $page > 1 ){
                ?>
                <a href="list.php?page=<?php echo $pre_page;?>">上一页</a>
            <?
            }
            if( $page < $max_page ){
                ?>
                <a href="list.php?page=<?php echo $next_page;?>">下一页</a>
            <?
            }
            ?>
            <a href="list.php?page=<?php echo $max_page;?>">末页</a>
            /  总页码 <font color="red"><?php echo $max_page;?></font>页 当前页码 <font color="red"><?php echo $page;?></font>页
        </div>
    </div>
<?php
//  释放mysql的资源
mysqli_free_result($result_amount);
mysqli_free_result($result_cv);
// 关闭数据库
mysqli_close($link);
?>