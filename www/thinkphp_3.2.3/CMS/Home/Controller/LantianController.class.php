<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
use Think\Model;
class LantianController extends Controller{



    public  function index()
    {
        $data = M('home_imgs'); // 实例化news表对象
        $this->arr_home_imgs = $data->select(); // 查询user表数据，并给模板变量赋值
        $this->display(); // 调用模板
    }
    //显示新闻列表
    public  function news()
    {
        $data = M('news'); // 实例化news表对象
        $this->arr_news = $data->select(); // 查询user表数据，并给模板变量赋值
        $this->display(); // 调用模板
    }

}