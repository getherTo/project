<?php
/*
 * �ļ������� 2008-11-4 �� PHPeclipse - PHP - Code Templates
 */


date_default_timezone_set('Hongkong');						//�趨ʱ��Ϊ��������
error_reporting(0);
$time=explode(' ',microtime());
define('WEBROOT', str_replace('\\','/',substr(dirname(__FILE__), 0, -4).'/')) ;	//������վ��Ŀ¼��

require("publicfun.php");

unset($web);
$web['dirname']="yiyunnet/";								//��վĿ¼������ڸ�Ŀ¼��
$web['close']=0;										//��վ�Ƿ�ر�
$web['whyclose']="���ڸ�������";
$web['name']="�ҵ���վ";								//��վ����
$web['logo']="images/logo.gif";							//LOGO��ַ
$web['stylename']="�������";
$web['styledir']="skyblue";
$web['listdate']="��-��-�� ʱ:��";
$web['classlever']=10;									//�����������󼶱�
$web['hitsofhot']=10;									//�������ٵ����
$web['webmaster']="����կ��";							//��վ������
$web['email']="182824196@qq.com";						//��վE-Mail
$web['enableuserreg']=1;								//�������û�ע��
$web['checkuserreg']=1;								//�û�������֤
$web['linkreg']=1;										//����������������
$web['keywords']="�������磬��վ������վ���裬CMS��վ����ҵ��վ";							//��վ�ؼ���
$web['description']="һ���ǳ�ʵ�õ���վ����ϵͳ";						//�������
$web['copyright']="��Ȩ��Ϣ <a href=\"http://www.yiyunnet.cn\">��������</a> ";							//�ײ���Ȩ��Ϣ
$web['beian']="��ICP��0000001��";
//������Ϣ�����ں�̨�޸ġ�
$web['today']=$time[1];
$web['starttime']=$time[0]+$time[1];unset($time);		//��ʼִ��ʱ��
$web['time']=0;
$web['currenturl']=selfurl();									//��ǰURL
$web['refpage']=$_SERVER[HTTP_REFERER];				//��Դҳ��
$web['menu']="";
$web['host']='http://'.$_SERVER['HTTP_HOST'].'/'.$web['dirname'];


unset($user);
$user['os']=osinfo();								//����ϵͳ
$user['browse']=browseinfo();						//�����
$user['ip']=fkip();									//�ÿ�IP
$user['id']=0;
$user['name']="";							//��ʼ��
$user['password']="";						//��ʼ��
$user['logintime']="";						//��ʼ��
$user['lasttime']="";						//��ʼ��
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
