<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台欢迎页</title>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/public.css" />
    <link rel="stylesheet" href="../css/content.css" />
</head>

<?php

include_once "../common/db.php";



if( count($_POST)>0 ){ // 更新分类信息

    $update_sql = "update news set category_id = '{$_POST['category_id']}',
                                   title = '{$_POST['title']}',
                                   content = '{$_POST['content']}',
                                   tag = '{$_POST['tag']}',
                                   author = '{$_POST['author']}'
            where id = {$_POST['id']} ";

    // 执行sql语句
    $result = mysqli_query($link, $update_sql);

    if($result){
        echo "更新成功！";
        // 直接跳转进入简历列表
        header("Location: news_list.php");

    } else {
        echo "更新失败！";
    }
}



//获取所有的新闻分类
$sql  = "select * from news_category ";
$result = mysqli_query($link, $sql);
$arr_news_category = mysqli_fetch_all($result, MYSQL_ASSOC);

// 根据id 获取新闻
$id = $_GET['id'];
if( !is_numeric($id) ){
    echo "ERROR!";
    exit;
}

// 查询信息
$sql = "select * from news  where id = $id";
$result = mysqli_query($link, $sql);
$arr_news = mysqli_fetch_array($result, MYSQL_ASSOC);


if( count($_POST)>0 ){


    if( $_POST['created_at'] ){
        $current_time  = $_POST['created_at'];
    } else {
        $current_time = date("Y-m-d H:i:s");
    }
    $sql = "insert into news( category_id, title, content,tag,author,created_at  )
                      values (
                              '{$_POST['category_id']}',
                              '{$_POST['title']}',
                              '{$_POST['content']}',
                              '{$_POST['tag']}',
                              '{$_POST['author']}',
                              '$current_time' )";



    // 执行sql语句
    $result = mysqli_query($link, $sql);

    if($result){
        echo "添加成功！";
        // 直接跳转进入列表
        header("Location: news_list.php");
    } else {

        echo "添加失败！";
        echo mysqli_error($link);
        exit;

    }

}



?>


<body marginwidth="0" marginheight="0">
<div class="container">
    <div class="public-nav">您当前的位置：<a href="">管理首页</a></div>
    <div class="public-content">
        <div class="public-content-header">
            <h3>新闻发布</h3>
        </div>
        <div class="public-content-cont">
             <form method="post" action="" name="form1">
                <div class="form-group">
                    <label for="">请选择分类</label>

                    <select name="category_id" required class="form-select">
                        <option value="">-请选择-</option>
                        <?php
                        foreach( $arr_news_category as $val){
                            $str_selected = "";
                            if( $arr_news['category_id'] == $val['id']){
                                $str_selected = "selected";
                            }
                            echo "<option value='{$val['id']}' $str_selected>{$val['name']}</option>";
                        }
                        ?>
                    </select>


                </div>
                <div class="form-group">
                    <label for="">标题</label>
                    <input class="form-input-txt" type="text" name="title" value="<?php echo $arr_news['title']?>" required/>
                </div>

                 <div class="form-group">
                     <label for="">标签</label>
                     <input class="form-input-txt" type="text" name="tag" value="<?php echo $arr_news['tag']?>" required/>
                 </div>

                 <div class="form-group">
                     <label for="">作者</label>
                     <input class="form-input-txt" type="text" name="author" value="<?php echo $arr_news['author']?>" required/>
                 </div>


                 <div class="form-group">
                    <label for="">内容</label>
                    <textarea id="editor_id" name="content"  class="form-input-textara" style="width:700px;height:300px;"><?php echo $arr_news['content']?></textarea>
                </div>


                <div class="form-group">
                    <label for="">发布时间</label>
                    <input class="form-input-txt" name="created_at" value="<?php echo $arr_news['created_at']?>" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                </div>

                <div class="form-group" style="margin-left:150px;">
                    <input type="submit" class="sub-btn" value="提  交" />
                    <input type="reset" class="sub-btn" value="重  置" />
                    <a href="news_list.php">取消</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../kingediter/kindeditor-all-min.js"></script>
<script src="../js/laydate.js"></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_id');
    });
</script>
</body>
</html>