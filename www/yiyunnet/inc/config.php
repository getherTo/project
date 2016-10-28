<?php
/*
 * 文件创建于 2008-11-4 日 PHPeclipse - PHP - Code Templates
 */


date_default_timezone_set('Hongkong');						//设定时区为东八区。
error_reporting(0);
$time=explode(' ',microtime());
define('WEBROOT', str_replace('\\','/',substr(dirname(__FILE__), 0, -4).'/')) ;	//定义网站根目录。

require("publicfun.php");

unset($web);
$web['dirname']="yiyunnet/";								//网站目录（相对于根目录）
$web['close']=0;										//网站是否关闭
$web['whyclose']="正在更新数据";
$web['name']="我的网站";								//网站名称
$web['logo']="images/logo.gif";							//LOGO地址
$web['stylename']="淡蓝风格";
$web['styledir']="skyblue";
$web['listdate']="年-月-日 时:分";
$web['classlever']=10;									//分类允许的最大级别
$web['hitsofhot']=10;									//热门最少点击数
$web['webmaster']="江宜寨主";							//网站所有者
$web['email']="182824196@qq.com";						//网站E-Mail
$web['enableuserreg']=1;								//允许新用户注册
$web['checkuserreg']=1;								//用户须获得验证
$web['linkreg']=1;										//允许申请友情链接
$web['keywords']="宜云网络，网站管理，网站建设，CMS建站，企业建站";							//网站关键字
$web['description']="一个非常实用的网站管理系统";						//相关描述
$web['copyright']="版权信息 <a href=\"http://www.yiyunnet.cn\">宜云网络</a> ";							//底部版权信息
$web['beian']="赣ICP备0000001号";
//以上信息可以在后台修改。
$web['today']=$time[1];
$web['starttime']=$time[0]+$time[1];unset($time);		//开始执行时间
$web['time']=0;
$web['currenturl']=selfurl();									//当前URL
$web['refpage']=$_SERVER[HTTP_REFERER];				//来源页面
$web['menu']="";
$web['host']='http://'.$_SERVER['HTTP_HOST'].'/'.$web['dirname'];


unset($user);
$user['os']=osinfo();								//操作系统
$user['browse']=browseinfo();						//浏览器
$user['ip']=fkip();									//访客IP
$user['id']=0;
$user['name']="";							//初始化
$user['password']="";						//初始化
$user['logintime']="";						//初始化
$user['lasttime']="";						//初始化
$user['stylename']="";
$user['styledir']="";
$user['status']='';
$user['regtime']="";
$user['regip']="";
$user['sex']="";
$user['birthday']="";
$user['qq']="";
$user['homepage']="";
$user['email']="";

$user['address']="";
$user['postalcode']="";
$user['telephone']="";
$user['mobphone']="";
$user['truename']="";

unset($ad);
$ad['bannerimg']="images/banner.jpg";
$ad['bannerurl']="#";


//echo $web["today"];
?>
