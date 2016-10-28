<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
use Think\Model;
class IndexController extends Controller {


    public function login(){
        $this->display();
    }

    //显示新闻分类列表
    public  function  article_category(){
        $data = M('news_category'); // 实例化表对象
        $news_category = $data->select();
        $this->news_category = $news_category; // 查询news_category表数据，并给模板
        $this->display();
    }

    //显示新闻列表
    public  function article()
    {
        $data = M('news'); // 实例化news表对象
        $this->arr_news = $data->select(); // 查询user表数据，并给模板变量赋值
        $this->display(); // 调用模板
    }


    //增加新闻分类
    public function add_article_category(){
        $this->display();
    }

    //保存增加新闻
    public  function insert_news_category()
    {
        $news_category = D('news_category');
        if ($news_category->create()) {
            $result = $news_category->add();
            if ($result) {
                $this->success('操作成功！','/thinkphp_3.2.3/cms.php/Home/index/article_category.html',3);
            } else {
                $this->error('写入错误！');
            }
        } else {
            $this->error($news_category->getError());
        }
    }

    // 删除新闻
    public  function delete_news_category($id)
    {
        $news = M('news_category');
        $result = $news->delete($id);
        if ($result) {
            $this->success('操作成功！','/thinkphp_3.2.3/cms.php/Home/index/article_category.html',3);
        } else {
            $this->error('写入错误！');
        }
    }

    // 编辑新闻
    public  function edit_news($id)
    {
        $data = M('news_category');
        // 读取数据
        $news = $data->find($id);
        if($news) {
            $this->news_category = $news;// 模板变量赋值
        } else {
            $this->error('数据错误');
        }
        $this->display();
    }

    // 修改保存新闻
    public  function update_news_category()
    {
        $news_category = D('news_category');
        if ($news_category->create()) {
            $result = $news_category->save();
            if ($result) {
                $this->success('操作成功！','/thinkphp_3.2.3/cms.php/Home/index/article_category.html',3);
            } else {
                $this->error('写入错误！');
            }
        } else {
            $this->error($news_category->getError());
        }
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
    public  function edit_newss($id)
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
                $this->success('操作成功！','/thinkphp_3.2.3/cms.php/Home/index/article.html',3);
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
                $this->success('操作成功！','/thinkphp_3.2.3/cms.php/Home/index/article.html',3);
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
            $this->success('操作成功！','/thinkphp_3.2.3/cms.php/Home/index/article.html',3);
        } else {
            $this->error('写入错误！');
        }
    }


    public  function show()
    {
        $data = M('home_imgs'); // 实例化news表对象
        $this->arr_home_imgs = $data->select(); // 查询user表数据，并给模板变量赋值
        $this->display(); // 调用模板
    }

    public function add_banner()
    {
        $carousel = D('home_imgs');  //调用自定义model类，处理数据
        if ($carousel->create()) {
            $upload = new Upload();
            $upload ->savePath = 'images/';
            $result = $upload->uploadOne($_FILES['img']);
            if($result) {
                $files_path =__ROOT__ .  "/Uploads/" . $result['savepath'] . $result['savename'];
            }
            $_POST['img'] .= $files_path;
            $result = $carousel->add($_POST);
            if ($result) {
                $this->success('操作成功！', U('index/show'), 3);
            } else {
                $this->error('写入错误！');
            }
        } else {
            $this->error($carousel->getError());
        }
    }

    public function edit_images()
    {
        $id = I('get.id');
        $images = M('home_imgs');
        $data = $images->find($id);
        if ($data) {
            $this->images = $data;
        } else {
            $this->error("数据错误");
        }
        $this->display();
    }

    public function update_banner()
    {
        $banner = M('home_imgs');
        $upload = new Upload();
        $upload->savePath = 'cms/images/';
        $result = $upload->uploadOne($_FILES['img']);
        if ($result) {
            $files_path = "/Uploads/" . $result['savepath'] . $result['savename'];
        }
        if ($files_path) {
            $_POST['img'] = $files_path;
        }
        $result = $banner->save($_POST);
        if ($result) {
            $this->success('操作成功！', U('index/show'), 3);
        } else {
            $this->error($banner->getError());
        }
    }



    public function delete_banner()
    {
        $id = I('get.id');
        $banner = M('home_imgs');
        $banner->find($id);
        $result = $banner->delete();
        if ($result) {
            $this->success('操作成功！', U('index/show'), 3);
        } else {
            $this->error('写入错误！');
        }
    }



}