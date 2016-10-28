<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/25
 * Time: 20:06
 */
header("Content-type:text/html;charset=utf-8");
$pub = "pub.ini";
$data = file_put_contents($pub, "[出版信息]" . "\n" . "书名 = php" . "\n" . "作者 = 小p" . "\n" . "出版日期 = 2016.8.18" . "\n" . "出版社 = 新安");
$data = parse_ini_file("pub.ini", true);
//print_r($data);
/*foreach ($data as $book){
    $c = implode("\n",$book);
    $bok = str_replace('2016.8.18', '2016.8.26', $c);
    echo $bok;
}
file_put_contents($pub,$bok);*/
$new_data = array();
// 遍历数组
foreach( $data as $key => $val ){
    $new_data .= "[$key]\r\n";
    foreach ( $val as $key2 => $val2){
        $new_data .= $key2;
        $new_data .= "=";
        if( $key2 == "出版日期" ){
            $new_data .= "2016年9月";
        } else {
            $new_data .= $val2;
        }
        $new_data .= "\r\n";
    }
}
file_put_contents("pub.ini", $new_data);
echo "Done!";
