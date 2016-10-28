<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/6
 * Time: 10:57
 */
header("Content-type: text/html; charset=utf-8");

// 最大页码
$max_page = 10;
// 当前页
$page = $_GET['page'];
if( !is_numeric($page) || $page == 0 ){ // 如果页码为非数字，或等于0时
    $page = 1;
} else if ( $page > $max_page ){ // 如果当前页码大于最大页码时
    $page = $max_page;
}
// 下一页
$nextPage = $page + 1;
if( $nextPage > $max_page ){  // 如果下一页码大于最大页码时
    $nextPage = $max_page;
}
// 上一页
if( $page >=2  ){  // 如果当前页码大于等于2时
    $prePage = $page - 1;
} else {
    $prePage = 1;
}
if( $prePage > $max_page ){ // 如果上一页大于最大页码时
    $prePage = $max_page-1;
}
echo "当前页为： " . $page;
echo "<br>下一页为： " . $nextPage  ;
echo "<br>上一页为： " . $prePage ;
echo "<br>";
?>
<a href="<?php echo "$page=1" ?>">首页</a>
<a href="<?php echo $page - 1 ?>">上一页</a>
<a href="<?php echo $page + 1 ?>">下一页</a>
<a href="<?php echo $max_page ?>">末页</a>