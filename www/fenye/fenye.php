<?php

function getAllType(){
    return array(1=>'关于我们',2=>'联系我们',3=>'企业荣誉');
}

/**
 * @name getPage2 分页函数
 * @param int $count 要分页的总记录数
 * @param int $page 当前页码
 * @param int $page_size 每页显示的记录数
 * @param int $str_search 查询条件
 * @param int $page_length 最多显示的分页数字
 * @return html 分页代码  类型百度 带数字的分页数
 */
function getPage2($count, $page, $page_size, $str_search = "", $page_length = 10)
{
  $page_count = ceil($count / $page_size);  //计算得出总页数
  $init = 1;
  $max_p = $page_count;
  $pages = $page_count;

  //判断当前页码
  $page = (empty($page) || $page <= 0) ? 1 : $page;

  //分页数字不能为偶数
  $page_length = ($page_length % 2) ? $page_length : $page_length + 1;  //页码个数
  $pageoffset = ($page_length - 1) / 2;  //页码个数左右偏移量

  $page_html = '';
  if ($page != 1) {
    $page_html .= "<a href=\"?page=1{$str_search}\">首页</a> ";        //第一页
    $page_html .= "<a href=\"?page=" . ($page - 1) . "{$str_search}\">上页</a>"; //上一页
  } else {
    $page_html .= "<a class='disabled'>首页</a> ";
    $page_html .= "<a class='disabled'>上页</a> ";
  }
  if ($pages > $page_length) {
    //如果当前页小于等于左偏移
    if ($page <= $pageoffset) {
      $init = 1;
      $max_p = $page_length;
    } else  //如果当前页大于左偏移
    {
      //如果当前页码右偏移超出最大分页数
      if ($page + $pageoffset >= $pages + 1) {
        $init = $pages - $page_length + 1;
      } else {
        //左右偏移都存在时的计算
        $init = $page - $pageoffset;
        $max_p = $page + $pageoffset;
      }
    }
  }
  for ($i = $init; $i <= $max_p; $i++) {
    if ($i == $page) {
      $page_html .= "<a class='now'>" . $i . '</a> ';
    } else {
      $page_html .= " <a href=\"?page=" . $i . "{$str_search}\">" . $i . "</a> ";
    }
  }
  if ($page != $pages) {
    $page_html .= " <a href=\"?page=" . ($page + 1) . "{$str_search}\">下页</a> ";//下一页
    $page_html .= "<a href=\"?page=" . $pages . "{$str_search}\">末页</a> ";    //最后一页
  } else {
    $page_html .= "<a  class='disabled'>下页</a> ";
    $page_html .= "<a   class='disabled'>末页</a> ";
  }
  echo "$page_html";
}
