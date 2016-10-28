<?php

header("Content-type: text/html; charset=utf-8");

// 读取敏感词文件
$data = file_get_contents("censorwords.txt");
// 将$data变量 转成一维数组
$arrBadWords = explode("\n", $data);
?>

<style>
    body{
        color: #333;
    }
    div{line-height: 45px}
    label{display:inline-block;width: 55px}
    .text1{
        width: 300px
    }
    .textarea1{
        width: 300px;
        height:150px;
    }
    .btn1{
        width: 60px;
        height:30px;
    }


</style>

<h1>敏感词提交过滤测试</h1>
<form name="form1" action="" method="post">
    <div><label>标题:</label><input type="text" name="title" class="text1" value="" placeholder="请输入标题" required></div>
    <div><label>内容:</label><textarea name="content" class="textarea1" required></textarea></div>
    <div><label></label><input type="submit" value="提交" class="btn1"> <input type="reset" value="重置" class="btn1"></div>
</form>


<?php

if( count($_POST) > 0 ){
    // 将标题和内容中的敏感词替换成***
    $title = str_replace($arrBadWords, "***", $_POST['title']);
    $content = str_replace($arrBadWords, "***", $_POST['title']);
    echo "<h2>您提交的数据</h2>";
    echo "<p><strong>标题：</strong></p>";
    echo "<p>$title</p>";
    echo "<p><strong>内容：</strong></p>";
    echo "<p>$content</p>";
}
?>

