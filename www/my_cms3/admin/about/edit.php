<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台欢迎页</title>
    <link rel="stylesheet" href="../css/reset.css"/>
    <link rel="stylesheet" href="../css/public.css"/>
    <link rel="stylesheet" href="../css/content.css"/>
    <script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.all.min.js"></script>
</head>



<?php

include_once "../common/checklogin.php";
include_once "../common/db.php";
include_once "../common/function.php";

// 获取类型
$arrType = getAllType();

// 根据id 获取关于我们相关信息
if ($_GET['id']) {
    $id = $_GET['id'];
} else {
    $id = $_POST['id'];
}
if (!is_numeric($id)) {
    echo "ERROR!";
    exit;
}

// 查询
$sql = "select * from about_us where id = $id";
$result = mysqli_query($link, $sql);
$arr_info = mysqli_fetch_array($result, MYSQL_ASSOC);

if (count($_POST) > 0) { // 更新公告信息

    $update_sql = "update about_us set content = '{$_POST['content']}'
            where id = {$_POST['id']} ";

    // 执行sql语句
    $result = mysqli_query($link, $update_sql);

    if ($result) {
        echo "更新成功！";
        // 直接跳转进入简历列表
        header("Location: list.php");

    } else {
        echo "更新失败！";
    }

}

?>


<body marginwidth="0" marginheight="0">
<div class="container">
    <div class="public-nav">您当前的位置：<a href="">管理首页</a></div>
    <div class="public-content">
        <div class="public-content-header">
            <h3>编辑-<?php echo $arrType[$arr_info['type']] ?></h3>
        </div>
        <div class="public-content-cont">
            <form method="post" action="" name="form1">
                <input type="hidden" name="id" value="<?php echo $arr_info['id'] ?>">

                <div class="form-group">
                    <label for="">内容</label>
                    <div style="float: left">
                       <script id="editor_id" name="content" type="text/plain"><?php echo $arr_info['content'] ?></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor_id', {
                            initialFrameWidth: 650,
                            initialFrameHeight: 300
                        });

                    </script>
                    </div>
                </div>
                <div style="clear: both"></div>
                <div class="form-group" style="margin-left:150px;">
                    <input type="submit" class="sub-btn" value="提  交"/>
                    <input type="reset" class="sub-btn" value="重  置"/>
                    <a href="list.php">取消</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>