<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 16:45
 */
header("Content-type: text/html; charset=utf-8");
class Page{
    public $rows;
    public $page;
    public $page_size;
    public $page_count;
    public $params;
    public function __construct($rows, $page, $page_size, $params = "")
    {
        $this->rows = $rows;
        $this->page = $page;
        $this->page_size = $page_size;
        $this->params = $params;
    }
    public function first_page()
    {
        return 1;
    }

    public function pre_Page()
    {
        return $pre_page = ($this->page == 1) ? 1 : $this->page - 1;
    }

    public function next_page()
    {
        return $next_page = ($this->page < ceil($this->rows / $this->page_size)) ? $this->page + 1 : ceil($this->rows / $this->page_size);
    }

    public function last_page()
    {
        return $page_count = ceil($this->rows / $this->page_size);
    }

    public function Way()
    {
        $page_count = ceil($this->rows / $this->page_size);
        if ($this->page <= 1 || $this->page == '') $this->page = 1;
        if ($this->page >= $page_count) $this->page = $page_count;
        $pre_page = ($this->page == 1) ? 1 : $this->page - 1;
        $next_page = ($this->page == $page_count) ? $page_count : $this->page + 1;
        $pagenav = "第 $this->page/$page_count 页 共 $this->rows 条记录 ";
        $pagenav .= "<a href='?page=1{$this->params}'>首页</a> ";
        $pagenav .= "<a href='?page=$pre_page{$this->params}'>前一页</a> ";
        $pagenav .= "<a href='?page=$next_page{$this->params}'>后一页</a> ";
        $pagenav .= "<a href='?page=$page_count{$this->params}'>末页</a>";
        $pagenav .= "跳到<select name='topage' size='1' onchange='window.location=\"?page=\"+this.value+\"{$this->params}\"' >\n";
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i == $this->page) $pagenav .= "<option value='$i' selected>$i</option>\n";
            else $pagenav .= "<option value='$i'>$i</option>\n";
        }
        $pagenav.="</select>";

        return $pagenav;
    }
}

$arr = new Page(150, 8, 10, '');
echo $arr->Way();
echo "<br>";
echo "首页是" . $arr->first_Page();
echo "<br>";
echo "上一页是" . $arr->pre_Page();
echo "<br>";
echo "当前页是" . $arr->page;
echo "<br>";
echo "下一页是" . $arr->next_Page();
echo "<br>";
echo "末页是" . $arr->last_Page();
