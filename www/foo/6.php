<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 14:43
 */
header("Content-type: text/html; charset=utf-8");

//try {
//    throw new Exception('MyException抛出的错误',1324);
//} catch( Exception $e ){
//    echo $e->getMessage();
//}
//finally{
//    echo "<br>finally!!";
//}
class MyException extends Exception {
    // ...
}

//调用自定义的异常类
try {
    throw new MyException('MyException抛出的错误',1324);
} catch( MyException $e ){
    echo $e->getMessage();
}