<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/2
 * Time: 11:11
 */
header("Content-type: text/html; charset=utf-8");
$link = mysqli_connect ('localhost','root','');
if (!$link){
    echo "connect mysql error";
}else {
//    echo "connect mysql success!";
}
$fei = mysqli_select_db($link,'fei');
if ($fei){
//    echo "success";
}else{
    echo "error";
}
$sql = "select * from cv limit 10";
$result = mysqli_query($link,$sql);
$cv_arr = mysqli_fetch_all($result,MYSQL_ASSOC);
//print_r($cv_arr);
$search_name = $_GET['name'];
// 查询简历表中的用户信息
$sql = "select * from cv ";
if ($search_name) {
$sql .= " where name like '%$search_name%'";
}
$sql .= " limit 10 ";
$result = mysqli_query($link, $sql);
$arr_cvs = mysqli_fetch_all($result, MYSQL_ASSOC);

    print_r($arr_cvs);
?>
<style>
    td {
        text-align: center;
    }
</style>

<div style="width: 960px;margin:10 auto">
    <table>
        <tr>
            <td>

                <form name="form1" action="" method="get">
                    姓名：<input type="text" name="name" value="<?php echo $search_name ?>" placeholder="请输入用户姓名"
                              required>
                    <input type="submit" value="查询">
                </form>
            </td>
        </tr>
    </table>
<table border="1px" width="960px" align="center">
            <caption><h1>个人简历信息</h1></caption>
            <tr>
                <th>id</th>
                <th>姓名</th>
                <th>性别</th>
                <th>城市</th>
                <th>身高</th>
                <th>体重</th>
                <th>手机号</th>
            </tr>

            <?
            if (count($cv_arr) > 0) {
                foreach ($cv_arr as $val) {
                    echo "<tr>";
                    echo "<td>{$val['id']}</td>";
                    echo "<td>{$val['name']}</td>";
                    echo "<td>{$val['sex']}</td>";
                    echo "<td>{$val['city']}</td>";
                    echo "<td>{$val['height']}</td>";
                    echo "<td>{$val['weight']}</td>";
                    echo "<td>{$val['mobile']}</td>";
                    echo " </tr>";
                }
            }
            ?>
</table>
