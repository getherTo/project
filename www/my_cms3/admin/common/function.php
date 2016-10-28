<?php

// 分页函数
function getPage($rows,$page_size, $page, $params = ""){
  $page_count = ceil($rows/$page_size);
  if($page <= 1 || $page == '') $page = 1;
  if($page >= $page_count) $page = $page_count;
  $pre_page = ($page == 1)? 1 : $page - 1;
  $next_page= ($page == $page_count)? $page_count : $page + 1 ;
  $pagenav= "第 $page/$page_count 页 共 $rows 条记录 ";
  $pagenav.= "<a href='?page=1{$params}'>首页</a> ";
  $pagenav.= "<a href='?page=$pre_page{$params}'>前一页</a> ";
  $pagenav.= "<a href='?page=$next_page{$params}'>后一页</a> ";
  $pagenav.= "<a href='?page=$page_count{$params}'>末页</a>";
  $pagenav.="　跳到<select name='topage' size='1' onchange='window.location=\"?page=\"+this.value+\"{$params}\"' >\n";
  for($i=1;$i<=$page_count;$i++){
    if($i==$page) $pagenav.="<option value='$i' selected>$i</option>\n";
    else $pagenav.="<option value='$i'>$i</option>\n";
  }
  $pagenav .= "</select>";
  return $pagenav;
}


// DECODE  解密
// ENCODE  加密
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
  $ckey_length = 4;
  $key = md5($key != '' ? $key : getglobal('authkey'));
  $keya = md5(substr($key, 0, 16));
  $keyb = md5(substr($key, 16, 16));
  $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

  $cryptkey = $keya.md5($keya.$keyc);
  $key_length = strlen($cryptkey);

  $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
  $string_length = strlen($string);

  $result = '';
  $box = range(0, 255);

  $rndkey = array();
  for($i = 0; $i <= 255; $i++) {
    $rndkey[$i] = ord($cryptkey[$i % $key_length]);
  }

  for($j = $i = 0; $i < 256; $i++) {
    $j = ($j + $box[$i] + $rndkey[$i]) % 256;
    $tmp = $box[$i];
    $box[$i] = $box[$j];
    $box[$j] = $tmp;
  }

  for($a = $j = $i = 0; $i < $string_length; $i++) {
    $a = ($a + 1) % 256;
    $j = ($j + $box[$a]) % 256;
    $tmp = $box[$a];
    $box[$a] = $box[$j];
    $box[$j] = $tmp;
    $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
  }

  if($operation == 'DECODE') {
    if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
      return substr($result, 26);
    } else {
      return '';
    }
  } else {
    return $keyc.str_replace('=', '', base64_encode($result));
  }
}

function getAllType(){
    return array(1=>'关于我们',2=>'联系我们',3=>'企业荣誉');
}