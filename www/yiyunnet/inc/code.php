<?php
/*
 * �ļ������� 2008-11-6 �� PHPeclipse - PHP - Code Templates
 */

require_once("head.php");
$web['logo']=$web['host'].$web['logo'];
$web['title']=$web['name'];							//��ҳ����
$web['daohang']="<a href=\"{$web['host']}\">{$web['name']}</a>";//����������


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
			$user['sex']="����";
		}elseif($row['sex']==1){
			$user['sex']="��";
		}else{
			$user['sex']="Ů";
		}

		$user['address']=$row['address'];
		$user['postalcode']=$row['postalcode'];
		$user['telephone']=$row['telephone'];
		$user['mobphone']=$row['mobphone'];
		$user['truename']=$row['truename'];

		$sql="update {$pre}userdata set lasttime={$web['today']} where uid={$row['uid']}";
		$conn->query($sql);
		$temp=date("m��d��H:i",$row['logintime']);
	if($row['yz']!=1)$user['status']="δ��֤";
	else $user['status']="��ʽ��Ա";
$logincode=<<<EOT
	<div class="title"><span>��Ա��Ϣ</span></div>
	<div class="sidelogin">�ʡ����ţ���{$row['uname']}</div>
	<div class="sidelogin">״����̬����{$user['status']}</div>
	<div class="sidelogin">��½ʱ�䣺��{$temp}</div>
	<div class="sidelogin"><a href="user.php">�����Ա����</a>��<a href="logout.php">��ȫ�˳�</a></div>
EOT;
	//=======================���¼�¼��½��־
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
		<div class="title"><span>�û���½</span></div>
		<div class="sidelogin">
			�û�����<input type="text" name="username" id="username" size="16" />
		</div>
		<div class="sidelogin">
			�ܡ��룺<input type="password" name="userpassword" id="userpassword" size="16" />
		</div>
		<div class="sidelogin">
			��Ч�ڣ�<select name="time" id="time">
				<option value="0" selected>������</option>
				<option value="1">һ��</option>
				<option value="30">һ����</option>
				<option value="365">һ��</option>
			</select>
			<a href="login.php?action=find1" target="_blank">�һ�����</a>
		</div>
		<div class="sidelogin">
			<input type="submit" value="��½"/>&nbsp;&nbsp;<input type="reset" value="����"/>
			&nbsp;<a href="reg.php">ע�����û�</a>
		</div>
	</form>

<script language='JavaScript' type='text/JavaScript'>
function Checkuser(){
	if (document.login.username.value==''){
		alert('��ܰ��ʾ���û�������Ϊ�գ�');
		document.login.username.focus();
	return false;
	}
	if (document.login.userpassword.value==''){
		alert('��ܰ��ʾ�����������룡');
		document.login.userpassword.focus();
		return false;
	}
	if(document.login.userpassword.value.length<6 || document.login.userpassword.value.length>32){
		alert("��ܰ��ʾ������Ҫ�� 6-32 ���ֽڣ����������� "+document.login.userpassword.value.length+" ���ֽ�");
		document.login.userpassword.value = "";
		document.login.userpassword.focus();
		return false;
	}
	return true;
}
</script>
EOT;
}

//=========================��ʽѡ��������
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



//=========================�������ݴ���
$sql="select * from {$pre}placard order by id desc";
$query=$conn->query($sql);
$placardcode="";
while($row=$conn->fetch_array($query)){
	$placardcode.="<div class=\"placardtitle\">{$row['title']}</div>\n";
	$placardcode.="<div class=\"placardcontent\">{$row['content']}</div>\n";
	$placardcode.="<div class=\"placardtime\">".date("y-m-d",$row['posttime'])."</div>\n";
}

//==================�������Ӵ��룬ǰʮ��
$sql="select name,url from {$pre}friendlink where yz=1 order by list desc limit 0,10";
$query=$conn->query($sql);
$yqlinkcode="<ul>";
while($row=$conn->fetch_array($query)){
	$yqlinkcode.="<li><a href=\"{$row['url']}\">{$row['name']}</a></li>";
}
$yqlinkcode.="</ul>";


if($user['name']!=""){
	$headuser="<a href=\"user.php\">�û�����</a> |";
}else{
	$headuser="<a href=\"login.php\">��Ա��½</a> |";
}

$searchbar=<<<EOT
		<form name="searchform" id="searchform" action="search.php" method="get" target="_blank" style="margin:0px;">
		�ؼ��֣�<input type="text" name="keyword" size="12" value="{$keyword}">
		<input type="submit" value="����">
		</form>
EOT;
?>