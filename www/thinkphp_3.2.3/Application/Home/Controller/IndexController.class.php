<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
use Think\Upload;
use Think\Verify;
use Think\Image;
class IndexController extends Controller {
    public function index1()
    {
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; }
div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px}
 h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; }
 p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style>
 <div style="padding: 24px 48px;">
 <h1>o～( ▔▽▔ )～o  </h1>
 <p>欢迎 <b>新安人才网第八期PHP培训班成员</b>！</p>
 <p>欢迎使用 <b>ThinkPHP</b>！</p>
 <br/>版本 V{$Think.version}</div>
 <script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script>
 <thinkad id="ad_55e75dfae343f5a1"></thinkad>
 <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8');
    }

//// 查询数据

//    // 写入数据
//    public  function insert()
//    {
//
//        $think_form = D('think_form'); // 调用自定义model类，来处理数据
//        if ($think_form->create()) {
//            $result = $think_form->add();
//            if ($result) {
//                $this->success('操作成功！','http://192.168.1.152/thinkphp_3.2.3/index.php/home/index/hello',3);
//            } else {
//                $this->error('写入错误！');
//            }
//        } else {
//            $this->error($think_form->getError());
//        }
//    }
//
// 新闻列表
    public  function news_list()
    {
        $data = M('news'); // 实例化news表对象
        $this->arr_news = $data->select(); // 查询user表数据，并给模板变量赋值
        $this->display(); // 调用模板

    }


// 添加新闻
    public  function add_news()
    {
        $this->display(); // 调用模板
    }

// 查新新闻
    public  function view_news($id)
    {
        $data = M('news');
        // 读取数据
        $news = $data->find($id);
        if($news) {
            $this->news = $news;// 模板变量赋值
        } else {
            $this->error('数据错误');
        }
        $this->display();
    }

// 编辑新闻
    public  function edit_news($id)
    {
        $data = M('news');
        // 读取数据
        $news = $data->find($id);
        if($news) {
            $this->news = $news;// 模板变量赋值
        } else {
            $this->error('数据错误');
        }
        $this->display();
    }


// 保存新增新闻
    public  function insert_news()
    {
        $news = D('News');
        if ($news->create()) {
            $result = $news->add();
            if ($result) {
                $this->success('操作成功！','/thinkphp_3.2.3/home/Index/news_list',3);
            } else {
                $this->error('写入错误！');
            }
        } else {
            $this->error($news->getError());
        }
    }

// 修改保存新闻
    public  function update_news()
    {
        $news = D('News');
        if ($news->create()) {
            $result = $news->save();
            if ($result) {
                $this->success('操作成功！','/thinkphp_3.2.3/home/Index/news_list',3);
            } else {
                $this->error('写入错误！');
            }
        } else {
            $this->error($news->getError());
        }
    }

// 删除新闻
    public  function delete_news($id)
    {
        $news = M('news');
        $result = $news->delete($id);
        if ($result) {
            $this->success('操作成功！','/thinkphp_3.2.3/home/Index/news_list',3);
        } else {
            $this->error('写入错误！');
        }
    }



    public  function  users(){
        $data = M('User'); // 实例化news表对象
        $users = $data->limit(10)->select();
        $this->arr_users = $users; // 查询user表数据，并给模板
        $this->display();
    }
    public function index(){

        $this->display();
    }
    public function guanyulantian(){

        $this->display();
    }
    public function neirong(){

        $this->display();
    }

    // 新闻列表
    public function news()
    {
        $data = M('news'); // 实例化news表对象
        // 获取新闻记录总数
        $amount = $data->count();

        // 每页显示的条数
        $page_size = 3;
        // 当前页码
        $page = I("get.p",1);
        // 分页
        $this->pager = new Page($amount, $page_size);

        // 获取新闻
        $news = $data->page("{$page},{$page_size}")->select();
        $this->arr_news = $news; // 查询user表数据，并给模板变量赋值
        // echo count($this->arr_news);
        $this->display();
    }

    // 文件上传
    public function upload()
    {
        $this->display();
    }
// 保存文件上传
    public function saveUpload()
    {
        if( IS_POST ) { // 判断是否为post提交
            $upload = new Upload();
            $results = $upload->uploadOne($_FILES['photo']); // 上传多个文件
            if ($results ) {
                $file_path = "/uploads/" . $results['savepath'] . $results['savename'];
                echo $file_path;
            }
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
    public function test()
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


    public function image(){
        $image = new Image();
        $image->open('./Public/images/lxr2.jpg')->water('./Public/images/water_small.png',
            Image::IMAGE_WATER_CENTER, 30 )->save('./Uploads/images/water2.jpg');
        //使用下面的方法可以分别获得当前图片的各种信息：
        echo "width=".$image->width(); // 获取图片宽度
        echo "<br>height=".$image->height(); // 获取图片高度
        echo "<br>typ=".$image->type(); // 获取图片类型
        echo "<br>mime=".$image->mime(); // 获取图片的MIME类型

    }




    public function IDcard(){
        header('Content-Type:text/html;charset=utf-8');
        if($_GET){
            $id_card = $_GET['name'];
        }
        $ch = curl_init();

        $url = "http://apis.baidu.com/apistore/idservice/id?id=$id_card";
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

        $this->display();
    }


}

//$data = M("News"); // 实例化数据模型对象
//$news_id = $data->getFieldByTitle("aaa",'id');
