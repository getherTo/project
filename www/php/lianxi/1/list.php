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

// 获取查询条件
$search_name = $_GET['name'];
$search_sex = $_GET['sex'];
$search_city = $_GET['city'];

// 查询简历表中的用户信息
$sql = "select * from cv where 1 "; // 查询语句
$sql_count =  "select count(*) as amount from cv where 1 "; // 统计总记录数
$sql_search = ""; // sql 查询条件语句
$str_search = ""; // 查询条件
if ($search_name) {
    $sql_search = " and name like '%$search_name%'";
    $str_search = "&name=".$search_name;
}
if ( $search_sex ) {
    $sql_search .= " and  sex = '$search_sex'";
    $str_search .= "&sex=".$search_sex;
}
//if ( $search_city ) {
//    $sql_search .= " and  city = '$search_city'";
//    $str_search .= "&city=".$search_city;
//}
if ( $search_city){
    $sql_search .= " and city = '$search_city'";
    $str_search .= "&city=".$search_city;
}
$sql .= $sql_search;
$sql .= " order by id desc  ";


$sql_count .= $sql_search;
// 获取总记录条数
$result_amount = mysqli_query($link, $sql_count);
$arr_amount = mysqli_fetch_array($result_amount, MYSQL_ASSOC);
// 总记录条数
$amount = $arr_amount['amount'];

$city = "select city,count(city) from cv group by city";
$result_city = mysqli_query($link,$city);
$arr_city = mysqli_fetch_all($result_city, MYSQL_ASSOC);

//if ($search_city){
//   $sql_search = " and city ='$search_city'";
//   $str_search = "&city=".$search_city;
//}
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
echo "<br>查询sql语句：<br> $sql <br><br>";
//echo "<br>统计总记录条数sql语句：<br> $sql_count <br><br>";

?>
    <style>
        .cv td {
            text-align: center;
        }
    </style>
    <div style="width: 960px;margin:10 auto">
        <h1 align="center">个人简历信息</h1>
        <table width="960px">
            <tr align="left">
                <td width="70%">
                    <form name="form1" action="" method="get">
                        姓名：<input type="text" name="name" value="<?php echo $search_name ?>" placeholder="请输入用户姓名">
                        性别: <select name="sex">
                                <option value="">-请选择-</option>
                                <option value="男" <?php if($search_sex=="男") echo "selected";?>>男</option>
                                <option value="女" <?php if($search_sex=="女") echo "selected";?>>女</option>
                              </select>
                        城市： <select name="city">
                            <option value="">-请选择-</option>
                            <?php

                            foreach($arr_city as $val){
                                ?>
                                <option value="<?php echo $val['city'];?>" <?php echo ($search_city==$val['city']) ? "selected" : ""   ?>><?php echo $val['city'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <input type="submit" value="查询">
                    </form>
                </td>
                <td align="right"><a href="add.php">添加简历</a></td>
            </tr>
        </table>
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
                <th>照片地址</th>
            </tr>

            <?php

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
                    <td>

                    </td>
                    <?php

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
                <a href="list.php?page=<?php echo $pre_page;?><?php echo $str_search?>">上一页</a>
            <?php
            }

            if( $page < $max_page ){
                ?>
                <a href="list.php?page=<?php echo $next_page;?><?php echo $str_search?>">下一页</a>
            <?php
            }
            ?>
            <a href="list.php?page=<?php echo $max_page;?><?php echo $str_search?>">末页</a>
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