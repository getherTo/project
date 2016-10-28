<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/21
 * Time: 13:48
 */

$guess = $_GET['result'];
$result['num'] =  rand(1,6); // 随机获取一个点数
$result['win_flag'] = false;

if($guess=="big"){
    if( $result['num']  >= 4 ){
        $result['win_flag'] = true;
    }
} else if ($guess=="small"){
    if( $result['num']  <= 3 ){
        $result['win_flag'] = true;
    }
}

echo json_encode($result);