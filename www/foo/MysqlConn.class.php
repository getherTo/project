<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 15:06
 */
header("Content-type: text/html; charset=utf-8");

class MysqlConn{
    public $host; //数据库连接地址
    public $username; //用户名
    public $password; //密码
    public $database; //数据库名称
    public $link;  //数据库连接

    //构造函数
    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connect();
    }
    // 连接mysql数据库
    public function connect()
    {
        $this->link = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }
    // 查询sql
    public function  query($sql)
    {
        $result = mysqli_query($this->link, $sql);
        if ($result) {
            $return = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $return[] = $row;
            }
            return $return;
        } else {
            return false;
        }
    }
    // 执行增，删，改相关sql语句
    public function  execute($sql)
    {
        return mysqli_query($this->link, $sql);
    }
}

// 实例化一个MysqlConn类的对象
$my_cms_db = new MysqlConn('localhost', 'root', '', 'my_cms3');
// 查询sql语句
$sql = "select * from home_imgs limit 3";
// 调用方法， 实现数据库查询
$arr_news = $my_cms_db->query($sql);
print_r($arr_news);