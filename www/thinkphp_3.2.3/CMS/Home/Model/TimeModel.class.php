<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-10-11
 * Time: 17:24
 */
namespace Home\Model;
use Think\Model;
class TimeModel extends    Model{

    protected $_auto = array(
        array('created_at', 'getDate', Model::MODEL_INSERT, 'callback'),
    );

    // 获取当前日期时间
    public function getDate()
    {
        return date("Y-m-d H:i:s");
    }

}