<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-30
 * Time: 8:58
 */
namespace Home\Model;
use Think\Model;
class NewsModel extends Model
{
    // 定义自动验证
    protected $_validate  = array(
        array('title', 'require', '请填写标题'),
    );

    // 定义自动完成
    protected $_auto = array(
        array('created_at', 'getDate', Model::MODEL_INSERT, 'callback'),
    );

    // 获取当前日期时间
    public function getDate()
    {
        return date("Y-m-d H:i:s");
    }
}