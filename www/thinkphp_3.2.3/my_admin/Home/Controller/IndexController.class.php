<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; }
            div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑";
            color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal;
             margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }
              a,a:hover{color:blue;}</style><div style="padding: 24px 48px;">
              <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div>
              <script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js">
              </script><thinkad id="ad_55e75dfae343f5a1"></thinkad>
              <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public  function  news_category(){
        $data = M('news_category'); // 实例化表对象
        $news_category = $data->select();
        $this->news_category = $news_category; // 查询news_category表数据，并给模板
        $this->display();
    }
    public  function add()
    {
        $this->display(); // 调用模板
    }
    public  function insert()
    {
        $news_category = D('news_category');
        if ($news_category->create()) {
            $result = $news_category->add();
            if ($result) {
                $this->success('操作成功！','/thinkphp_3.2.3/my_admin/home/Index/news_category',3);
            } else {
                $this->error('写入错误！');
            }
        } else {
            $this->error($news_category->getError());
        }
    }




    // 生成验证码
    public function captcha()
    {
        $captcha = new Verify();
        $captcha->useCurve = false;
        //$captcha->useNoise = false;
        //$captcha->bg = array(255, 0, 0);
        $captcha->fontSize = 16;
        $captcha->entry();
    }

// 测试验证码页面
    public function test1()
    {
        $this->display();
    }

// 验证验证码
    public function checkCaptcha()
    {
        $captcha = new Verify();
        if( $captcha->check(I('get.code')) ){
            $this->show("验证码正确");
        }  else {
            $this->show("验证码错误");
        }

    }
}