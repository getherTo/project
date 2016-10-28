<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/26
 * Time: 14:51
 */
header("Content-type:text/html;charset=utf-8");
class Person{
    public function __construct($name,$birthday,$sex,$height,$weight){
        $this->name = $name;
        $this->age = $birthday;
        $this->sex = $sex;
        $this->weight = $weight;
        $this->height = $height;
    }
    public function __get($name){
        return $this->$name;
    }
    public function __set($name,$value){
        return $this->$name = $value;
    }
}
   $tom = new Person('tom',1991-04-04,'男',65,1.77);
echo $tom->name;
echo $tom->qq;