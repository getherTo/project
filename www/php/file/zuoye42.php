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
    $find_badwors = array(); // 保存敏感词

    // 如果包含敏感词的， 提示： 含有敏感词，禁止发布。同时，记录相关Log文件
    foreach( $arrBadWords as $badword ){
           if (!$badword) continue; //如果敏感词为空，跳出本次循环，进行下一次循环
        if( strpos($title, $badword) !== false ){ // 含有敏感词
            $badword_flag = true;
            // 记录log
            $log = "时间：". date("Y-m-d H:i:s")." ip:".$_SERVER['REMOTE_ADDR']." 敏感词：$badword";
            file_put_contents("badword.log", $log, FILE_APPEND);
            // 保存敏感词
            $find_badwors[] = $badword;
        }
    }
    if($badword_flag) {
        echo " 含有如下敏感词，禁止发布!<br>";
        echo "<span class='red'>".implode("<br>",$find_badwors) . "</span>";;
    } else {
        // ... 保存发布相关代码
        echo "发布成功！";
    }
}
?>