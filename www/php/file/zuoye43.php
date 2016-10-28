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
        .red{
            color: #ff0000;

        }
        .bold{
            font-weight: bold;
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

    $title = $_POST['title'];
    $content = $_POST['content'];

    $badword_flag = false; // 标记是否含有敏感词

    // 如果包含敏感词的， 提示： 含有敏感词，禁止发布。同时，记录相关Log文件
    foreach( $arrBadWords as $badword ){

        if( strpos($title, $badword) !== false ){ // 检查标题，含有敏感词
            $badword_flag = true;
            $str_replace = "<span class='red bold'>$badword</span>";
            $title = str_replace($badword,$str_replace, $title);
        }

        if( strpos($content, $badword) !== false ){ // 检查内容，含有敏感词
            $badword_flag = true;
            $str_replace = "<span class='red bold'>$badword</span>";
            $content = str_replace($badword,$str_replace, $content);
        }
    }

    if($badword_flag) {
        echo "<h2>含有敏感词，禁止发布!（标红加粗部分为敏感词）</h2>";
    }

    echo "<p>标题：</p>";
    echo "<p>$title</p>";
    echo "<p>内容：</p>";
    echo "<p>$content</p>";
}
?>