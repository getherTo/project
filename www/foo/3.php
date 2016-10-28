<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/26
 * Time: 16:55
 */
header("Content-type: text/html; charset=utf-8");
class Person{
    public  $name;
    public  $age;
    public  $sex;
    public  $height;
    public  $weight;
   // private $bank_id;
    public function __construct($name, $age, $sex, $height, $weight ){
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
        $this->height = $height;
        $this->weight = $weight;
    }

    public  function  eat(){
        return $this->name . " 在吃饭";
    }

    public  function  sleep(){
        return $this->name . " 在睡觉";
    }

    public  function  walk(){
        return $this->name . " 在走路";
    }

    public  function  think(){
        return $this->name . " 在思考";
    }
//    public function __toString(){
//        return "对象name：".$this->name;
//    }
//    public function __set($name,$value){
//        return $this->$name = $value;
//    }
}
//
//$tom = new Person();
//$tom->name = "tom";
//$tom->age = "18";
//$tom->sex = "男";
//$tom->height = 1.78;
//$tom->weight = 80;
//$tom->bank_id = "123";
//
//echo "<p>姓名： " . $tom->name."</p>";
//echo "<p>年龄： " . $tom->age."</p>";
//echo "<p>性别： " . $tom->sex."</p>";
//echo "<p>身高： " . $tom->height."</p>";
//echo "<p>体重： " . $tom->weight."</p>";
//echo "<p>" . $tom->eat()."</p>";
//echo "<p>" . $tom->sleep()."</p>";
//echo "<p>" . $tom->think()."</p>";
//echo "<br>".$tom->bank_id;
