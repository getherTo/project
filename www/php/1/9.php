<?php
header('Content-Type:text/html;charset=utf-8');
$ch = curl_init();
$url = 'http://apis.baidu.com/apistore/idservice/id?id=420984198704207896';
$header = array(
    'apikey: 7d808256bf25115a167554514e51393e',
);
// 添加apikey到header
curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 执行HTTP请求
curl_setopt($ch , CURLOPT_URL , $url);
$res = curl_exec($ch);

var_dump(json_decode($res));
?>