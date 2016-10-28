<?php
/*
 * 文件创建于 2008-11-6 日 PHPeclipse - PHP - Code Templates
 */

require_once("head.php");
$web['logo']=$web['host'].$web['logo'];
$web['title']=$web['name'];							//网页标题
$web['daohang']="<a href=\"{$web['host']}\">{$web['name']}</a>";//导航条代码


$username=filtrate(trim($_COOKIE['username']));
$userpassword=filtrate(trim($_COOKIE['password']));
$user['styledir']=no_special_char($_COOKIE['styledir']);
$logintime=(int)$_COOKIE['logintime'];
//echo $username,$userpassword;
if($username!="" && $password!=""){
	$sql="select * from {$pre}userdata where uname='{$username}' and password='{$userpassword}' and logintime={$logintime}";
	$query=$conn->query($sql);
	$records=$conn->num_rows($query);
	if($records!=1){
		setcookie("username","");
	}else{
		$row=$conn->fetch_array($query);
		$user['name']=$username;
		$user['id']=$row['uid'];
		$user['password']=$password;
		$user['logintime']=date("Y-m-d H:i:s",$row['logintime']);
		$user['lasttime']=date("Y-m-d H:i:s",$row['lasttime']);
		$user['regtime']=date("Y-m-d H:i:s",$row['regdate']);
		$user['regip']=$row['regip'];
		if($row['birthday']!=0){
			$user['birthday']=date("Y-m-d",$row['birthday']);
		}
		$user['qq']=$row['oicq'];
		$user['homepage']=$row['homepage'];
		$user['email']=$row['email'];
		if($row['sex']==0){
			$user['sex']="保密";
		}elseif($row['sex']==1){
			$user['sex']="男";
		}else{
			$user['sex']="女";
		}

		$user['address']=$row['address'];
		$user['postalcode']=$row['postalcode'];
		$user['telephone']=$row['telephone'];
		$user['mobphone']=$row['mobphone'];
		$user['truename']=$row['truename'];

		$sql="update {$pre}userdata set lasttime={$web['today']} where uid={$row['uid']}";
		$conn->query($sql);
		$temp=date("m月d日H:i",$row['logintime']);
	if($row['yz']!=1)$user['status']="未验证";
	else $user['status']="正式会员";
$logincode=<<<EOT
	<div class="title"><span>会员信息</span></div>
	<div class="sidelogin">帐　　号：　{$row['uname']}</div>
	<div class="sidelogin">状　　态：　{$user['status']}</div>
	<div class="sidelogin">登陆时间：　{$temp}</div>
	<div class="sidelogin"><a href="user.php">进入会员中心</a>　<a href="logout.php">安全退出</a></div>
EOT;
	//=======================以下记录登陆日志
	$sql="select * from {$pre}userlogo where uid={$user['id']} order by id desc limit 0,1";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	$sql="update {$pre}userlogo set lasttime={$web['today']} where id={$row['id']}";
	$conn->query($sql);
	}
}

if($logincode==""){
$logincode=<<<EOT

	<form name="login" method="post" action="login.php?action=check" style="margin:0px;" onsubmit="return Checkuser();">
		<div class="title"><span>用户登陆</span></div>
		<div class="sidelogin">
			用户名：<input type="text" name="username" id="username" size="16" />
		</div>
		<div class="sidelogin">
			密　码：<input type="password" name="userpassword" id="userpassword" size="16" />
		</div>
		<div class="sidelogin">
			有效期：<select name="time" id="time">
				<option value="0" selected>不保存</option>
				<option value="1">一天</option>
				<option value="30">一个月</option>
				<option value="365">一年</option>
			</select>
			<a href="login.php?action=find1" target="_blank">找回密码</a>
		</div>
		<div class="sidelogin">
			<input type="submit" value="登陆"/>&nbsp;&nbsp;<input type="reset" value="重填"/>
			&nbsp;<a href="reg.php">注册新用户</a>
		</div>
	</form>

<script language='JavaScript' type='text/JavaScript'>
function Checkuser(){
	if (document.login.username.value==''){
		alert('温馨提示！用户名不能为空！');
		document.login.username.focus();
	return false;
	}
	if (document.login.userpassword.value==''){
		alert('温馨提示！请输入密码！');
		document.login.userpassword.focus();
		return false;
	}
	if(document.login.userpassword.value.length<6 || document.login.userpassword.value.length>32){
		alert("温馨提示！密码要在 6-32 个字节！而您输入了 "+document.login.userpassword.value.length+" 个字节");
		document.login.userpassword.value = "";
		document.login.userpassword.focus();
		return false;
	}
	return true;
}
</script>
EOT;
}

//=========================样式选择下拉框
if($user['styledir']==""){
	$user['styledir']=$web['styledir'];
	$user['stylename']=$web['stylename'];
}
if(count($stylearr)>1){
	$stylecode="<form name=\"styleform\" action=\"changestyle.php\" style=\"margin:0px;display:inline;\">\n";
	$stylecode.="<select name=\"styledir\" id=\"styledir\" onchange=\"submit();\">\n";
	for($i=0;$i<count($stylearr);$i++){
		if($user['styledir']==$stylearr[$i]['dir']){
			$stylecode.="<option value=\"{$stylearr[$i]['dir']}\" selected>{$stylearr[$i]['name']}</option>\n";
			$user['stylename']=$stylearr[$i]['name'];
		}else{
			$stylecode.="<option value=\"{$stylearr[$i]['dir']}\">{$stylearr[$i]['name']}</option>\n";
		}
	}
	$stylecode.="</select>\n</form>";
}



//=========================公告内容代码
$sql="select * from {$pre}placard order by id desc";
$query=$conn->query($sql);
$placardcode="";
while($row=$conn->fetch_array($query)){
	$placardcode.="<div class=\"placardtitle\">{$row['title']}</div>\n";
	$placardcode.="<div class=\"placardcontent\">{$row['content']}</div>\n";
	$placardcode.="<div class=\"placardtime\">".date("y-m-d",$row['posttime'])."</div>\n";
}

//==================友情链接代码，前十个
$sql="select name,url from {$pre}friendlink where yz=1 order by list desc limit 0,10";
$query=$conn->query($sql);
$yqlinkcode="<ul>";
while($row=$conn->fetch_array($query)){
	$yqlinkcode.="<li><a href=\"{$row['url']}\">{$row['name']}</a></li>";
}
$yqlinkcode.="</ul>";


if($user['name']!=""){
	$headuser="<a href=\"user.php\">用户中心</a> |";
}else{
	$headuser="<a href=\"login.php\">会员登陆</a> |";
}

$searchbar=<<<EOT
		<form name="searchform" id="searchform" action="search.php" method="get" target="_blank" style="margin:0px;">
		关键字：<input type="text" name="keyword" size="12" value="{$keyword}">
		<input type="submit" value="搜索">
		</form>
EOT;
?>