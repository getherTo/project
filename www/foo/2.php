<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/26
 * Time: 15:54
 */
header("Content-type:text/html;charset=utf-8");
class User
{
    public $name;
    public $birthday;
    public $height;
    public $weight;
    public $married;
    public $bmi;

    public function married(){
        if ($this->married == true){
            return "已婚";
        }else {return "未婚";
        }
    }
    public function name()
    {
        return $this->name;
    }
    public function age() {
        return date("Y")- substr($this->birthday,0,4);
    }
    public function bmi()
    {
        if (is_numeric($this->height) && is_numeric($this->weight)) {
            $this->bmi = number_format($this->weight / ($this->height * $this->height),2);
        } else {
            $this->bmi = 0;
        }
        return $this->bmi;
    }
    public function bmiText()
    {
        if ( $this->bmi < 18.5) {
            $info =   "过轻" ;
        } elseif ( $this->bmi > 18.5 &&  $this->bmi <= 24.99) {
            $info = "正常";
        } elseif ( $this->bmi >= 25 &&  $this->bmi <= 28) {
            $info = "过重";
        } elseif ( $this->bmi > 28 &&  $this->bmi <= 32) {
            $info =  "肥胖";
        } elseif ( $this->bmi > 32) {
            $info = "非常肥胖";
        }
        return $info;
    }
}
$tom = new User();
$tom -> name = "tom";
$tom ->birthday = "1991-04-04";
$tom ->height = 1.77;
$tom ->weight = 65;
$tom ->married = "false";
echo "姓名：".$tom->name;
echo "<br>年龄：".$tom->age();
echo "<br>婚否：".$tom->married();
echo "<br>bim指数：".$tom->bmi();
echo "<br>体重健康状况：".$tom->bmiText();
