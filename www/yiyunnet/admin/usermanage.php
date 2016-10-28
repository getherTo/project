<?php
/*
 * 文件创建于 2008-11-27 日 PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
$listrows=20;
$page=abs((int)$_GET['page']);
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="changeyz"){
	$uid=(int)$_GET['uid'];
	$sql="select yz from {$pre}userdata where uid={$uid}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	$row['yz']==1?$uyz=0:$uyz=1;
	$conn->query("update {$pre}userdata set yz={$uyz} where uid={$uid}");
	header("location:{$web['refpage']}");exit;
}
if($action=="del"){
	if($adminlevel<8)die("<script LANGUAGE='javascript'>alert('错误，您无权修改用户资料！');history.go(-1);</script>");
	$uid=(int)$_GET['uid'];
	if($uid==$adminuid)die("<script LANGUAGE='javascript'>alert('错误，不能删除自己！');history.go(-1);</script>");
	$conn->query("delete from {$pre}userdata where uid={$uid}");
	header("location:{$web['refpage']}");exit;
}
if($action=="edit"){
	if($adminlevel<8)die("<script LANGUAGE='javascript'>alert('错误，您无权修改用户资料！');history.go(-1);</script>");
	$uid=(int)$_GET['uid'];
	$sql="select * from {$pre}userdata where uid={$uid}";
	$query=$conn->query($sql);
	$userdata=$conn->fetch_array($query);
	if($userdata['uid']!=$uid)die("<script LANGUAGE='javascript'>alert('错误，该用户不存在！');history.go(-1);</script>");
	if($userdata['birthday']!=0){
		$uyear=date("Y",$userdata['birthday']);
		$umonth=date("m",$userdata['birthday']);
		$uday=date("d",$userdata['birthday']);
	}
	if($userdata['sex']==1)$usex1="checked";
	elseif($userdata['sex']==2)$usex2="checked";
	else $usex0="checked";
	if($userdata['adminlevel']<4)$adminlevel0="checked";
	elseif($userdata['adminlevel']<8)$adminlevel4="checked";
	else $adminlevel8="checked";
}
if($action=="editsave"){
	if($adminlevel<8)die("<script LANGUAGE='javascript'>alert('错误，您无权修改用户资料！');history.go(-1);</script>");
	$uid=(int)$_GET['uid'];
	$email=$_POST['email'];
	if(!checkemail($email)){
		die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的邮箱格式错误！');history.go(-1);</script>");
	}
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	if($password!=""){			//======================密码修改
		if(!checkpassword($password)){
			die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的密码格式错误！');history.go(-1);</script>");
		}
		if(!checkpassword($password2)){
			die("<script LANGUAGE='javascript'>alert('温馨提示！您输入的密码格式错误！');history.go(-1);</script>");
		}
		if($password!=$password2){
			die("<script LANGUAGE='javascript'>alert('温馨提示！您两次输入的密码不一样！');history.go(-1);</script>");
		}
		$password=md5($password);
		$conn->query("update {$pre}userdata set password='{$password}' where uid={$uid}");
	}
	$answer=filtrate(trim($_POST['answer']));
	if($answer!=""){			//=======================问题的案修改
		$answer=md5($answer);
		$conn->query("update {$pre}userdata set answer='{$answer}' where uid={$uid}");
	}
	$clue=filtrate(trim($_POST['clue']));
	$uyear=(int)$_POST['uyear'];
	$umonth=(int)$_POST['umonth'];
	$uday=(int)$_POST['uday'];
	$sex=(int)$_POST['sex'];
	$oicq=$_POST['oicq'];
	$homepage=$_POST['homepage'];
	$address=mysubstr(filtrate(trim($_POST['address'])),0,200);
	$postalcode=$_POST['postalcode'];
	$telephone=$_POST['telephone'];
	$mobphone=$_POST['mobphone'];
	$truename=mysubstr(filtrate(trim($_POST['truename'])),0,16);
	if(!checkpost($postalcode))$postalcode="";
	if(!checkphone($telephone))$telephone="";
	if(checkphone($mobphone)!=2)$mobphone="";
	$birthday=0;
	if($uday>0 && $umonth>0 && $uyear>0 ){
		if(checkdate($umonth,$uday,$uyear)){
			if($uyear>1910&&$uyear<2008){
				$birthday=mktime(8,1,1,$umonth,$uday,$uyear);
			}
		}
	}
	if($sex>2||$sex<0)$sex=0;
	if($oicq!=""){
		if(!preg_match("/^[1-9][\d]{5,8}$/",$oicq)){
			$oicq="";
		}
	}
	if($homepage!=""){
		if(!checkurl($homepage)){
			$homepage="";
		}
	}
	$sql="update {$pre}userdata set question='{$clue}',email='{$email}',birthday={$birthday},sex={$sex}," .
			"oicq='{$oicq}',homepage='{$homepage}',address='{$address}',postalcode='{$postalcode}'," .
			"telephone='{$telephone}',mobphone='{$mobphone}',truename='{$truename}' where uid={$uid}";
	$conn->query($sql);
	$level=(int)$_POST['adminlevel'];
	if($uid!=$adminuid){
		$conn->query("update {$pre}userdata set adminlevel={$level} where uid={$uid}");
	}elseif($adminlevel!=$level){
		die("<script>alert(\"恭喜您！资料修改成功！但是您不能将自己改变为非超级管理员！\");location.href=\"usermanage.php\";</script>");
	}
	die("<script>alert(\"恭喜您！资料修改成功！！\");location.href=\"usermanage.php\";</script>");
}
//===========================================================
$sql="select uid from {$pre}userdata";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($page<1)$page=1;
if($maxpage>1)$showpage=showpage($records,$page,$listrows);
$limitlow=($page-1)*$listrows;
$sql="select * from {$pre}userdata order by uid desc limit $limitlow,$listrows";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
for($i=0;$i<$records;$i++){
	$userarr[$i]=$conn->fetch_array($query);
}

//===================以下为模版
echo <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="images/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
	<div id="body">
EOT;
if($action!="edit"){
echo <<<EOT
		<div class="title">用户资料管理</div>
		<div style="padding:5"></div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>UID</th>
			<th>用户名</th>
			<th>最后登陆日期</th>
			<th>最后登陆IP</th>
			<th>电子邮箱</th>
			<th>用户级别</th>
			<th>状态</th>
			<th>修改/删除</th>
		</tr>
EOT;
for($i=0;$i<count($userarr);$i++){
$rs=$userarr[$i];
$rs['logintime']=date("y-m-d H:i:s",$rs['logintime']);
$rs['yz']==1?$rs['yz']="已审核":$rs['yz']="未审核";
if($rs['adminlevel']>3){
	if($rs['adminlevel']>7){
		$rs['adminlevel']="<span style=\"color:ff3333;\">超级管理员</span>";
	}else{
		$rs['adminlevel']="<span style=\"color:ff33ff;\">管理员</span>";
	}
}else{
	$rs['adminlevel']="普通会员";
}
echo <<<EOT
		<tr align="center">
			<td>{$rs['uid']}</td>
			<td>{$rs['uname']}</td>
			<td>{$rs['logintime']}</td>
			<td>{$rs['lastip']}</td>
			<td>{$rs['email']}</td>
			<td>{$rs['adminlevel']}</td>
			<td><a href="?action=changeyz&uid={$rs['uid']}">{$rs['yz']}</a></td>
			<td><a href="?action=edit&uid={$rs['uid']}">修改</a>/<a href="?action=del&uid={$rs['uid']}">删除</a></td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
		<div class="showpage">{$showpage}</div>
EOT;
}else{
echo <<<EOT
		<div class="title">用户资料修改</div>
		<div style="padding:5"></div>
		<form method="post" action="?action=editsave&uid={$uid}" name="edit" style="margin:0px;">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="4">
		<tr>
			<td width="120">用 户 名：</td>
			<td>{$userdata['uname']}</td>
		</tr>
		<tr>
			<td>权　　限：</td>
			<td><input type="radio" name="adminlevel" id="adminlevel" value="0" style="border:0px;" {$adminlevel0} />普通用户
				<input type="radio" name="adminlevel" id="adminlevel" value="4" style="border:0px;" {$adminlevel4} /><span style="color:ff33ff;">管理员</span>
				<input type="radio" name="adminlevel" id="adminlevel" value="8" style="border:0px;" {$adminlevel8} /><span style="color:ff3333;">超级管理员</span>
			</td>
		</tr>
		<tr>
			<td>邮　　箱：</td>
			<td><input type="text" name="email" id="email" value="{$userdata['email']}"/></td>
		</tr>
		<tr>
			<td>新 密 码：</td>
			<td><input type="password" name="password" id="password"/>	如不修改，请留空</td>
		</tr>
		<tr>
			<td>重复密码：</td>
			<td><input type="password" name="password2" id="password2"/> 如不修改，请留空</td>
		</tr>
		<tr>
			<td>问　　题：</td>
			<td><input type="text" name="clue" id="clue" value="{$userdata['question']}"/> 忘记密码时可以回答问题找回密码</td>
		</tr>
		<tr>
			<td>答　　案：</td>
			<td><input type="text" name="answer" id="answer"/> 如不修改，请留空</td>
		</tr>
		<tr>
			<td>生　　日：</td>
			<td>
				<input type="text" name="uyear" id="uyear" size="4" value="{$uyear}"/>年
				<input type="text" name="umonth" id="umonth" size="2" value="{$umonth}"/>月
				<input type="text" name="uday" id="uday" value="{$uday}" size="2"/>日<br/>
			</td>
		</tr>
		<tr>
			<td>性　　别：</td>
			<td>
				<input type="radio" name="sex" id="sex" value="0" {$usex0} style="border:0"/>保密
				<input type="radio" name="sex" id="sex" value="1" {$usex1} style="border:0"/>男
				<input type="radio" name="sex" id="sex" value="2" {$usex2} style="border:0"/> 女
			</td>
		</tr>
		<tr>
			<td> Q　　Q ：</td>
			<td><input type="text" name="oicq" id="oicq" value="{$userdata['oicq']}"/></td>
		</tr>
		<tr>
			<td>个人主页：</td>
			<td><input type="text" name="homepage" id="homepage" value="{$userdata['homepage']}"/></td>
		</tr>
		<tr>
			<td>联系地址：</td>
			<td><input type="text" name="address" id="address" value="{$userdata['address']}" size="60"/></td>
		</tr>
		<tr>
			<td>邮政编码：</td>
			<td><input type="text" name="postalcode" id="postalcode" value="{$userdata['postalcode']}" size="6"/></td>
		</tr>
		<tr>
			<td>联系电话：</td>
			<td><input type="text" name="telephone" id="telephone" value="{$userdata['telephone']}" size="12"/></td>
		</tr>
		<tr>
			<td>联系手机：</td>
			<td><input type="text" name="mobphone" id="mobphone" value="{$userdata['mobphone']}" size="12"/></td>
		</tr>
		<tr>
			<td>真实姓名：</td>
			<td><input type="text" name="truename" id="truename" value="{$userdata['truename']}" size="16"/></td>
		</tr>
		</table>
		<div style="text-align:center;padding:5;">
			<input type="submit" value="提交"/> 　
			<input type="reset" value="重置"/>
		</div>
		</form>
EOT;
}
echo <<<EOT
	</div>
<script LANGUAGE='javascript'>
function showhelp(sid){
	whichEl = eval("help" + sid);
	if (whichEl.style.display == "none"){
		eval("help" + sid + ".style.display=\"\";");
	}else{
		eval("help" + sid + ".style.display=\"none\";");
	}
}
top.document.title="{$web['name']} - 后台管理系统 - 用户资料管理";
</script>
EOT;
require("foot.htm");
?>
</body>
</html>