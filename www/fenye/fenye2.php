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
  return $pagenav;
}
