<?php
/*
 * 文件创建于 2008-11-21 日 PHPeclipse - PHP - Code Templates
 */

require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="del"){
	$id=abs((int)$_GET['id']);
	$conn->query("delete from {$pre}stencil where id={$id}");
	$action="ok";
}
if($action=="add"||$action=="editsave"){
	$name=str_replace(" ","",mysubstr(no_special_char($_POST['name']),0,18));
	$isdefault=abs((int)$_POST['isdefault']);
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property1']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property2']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property3']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property4']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property5']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property6']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property7']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property8']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property9']),0,18));
	$property[]=str_replace(" ","",mysubstr(no_special_char($_POST['property10']),0,18));
	if($name==""||$property1==""||$property2==""||$property3==""){
		die("<script language='javascript'>alert('错误！名称或前三个属性输入有误');history.go(-1);</script>");
	}
	for($i=0;$i<10;$i++){
		if($property[$i]!=""){
			$content.=" ".$property[$i];
		}
	}
	$content=trim($content);
	if($action=="add"){
		$conn->query("insert into {$pre}stencil (name,isdefault,property,posttime) VALUES('{$name}',{$isdefault},'{$content}',{$web['today']})");
	}else{
		$id=abs((int)$_GET['id']);
		$sql="update {$pre}stencil set name='{$name}',isdefault={$isdefault},property='{$content}' where id={$id}";
		$conn->query($sql);
	}

	$action="ok";
	unset($property);unset($content);
}

if($action=="edit"){
	$id=abs((int)$_GET['id']);
	$sql="select * from {$pre}stencil where id={$id}";
	$query=$conn->query($sql);
	if($conn->num_rows($query)<1)die("<script language='javascript'>alert('错误！');location.href=\"class_stencil.php\";</script>");
	$stencilconfig=$conn->fetch_array($query);
	if($stencilconfig['isdefault'])$isdefault1="checked";
	else $isdefault0="checked";
	$editpro=explode(" ",$stencilconfig['property']);
}

$sql="select * from {$pre}stencil";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$max=0;
for($i=0;$i<$records;$i++){
	$stencil[$i]=$conn->fetch_array($query);
	$propertys[$i]=explode(" ",$stencil[$i]['property']);
	if($stencil[$i]['isdefault']==0)$stencil[$i]['isdefault']="否";
	else $stencil[$i]['isdefault']="是";
	$stencil[$i]['posttime']=date("y-m-d",$stencil[$i]['posttime']);
	if(count($propertys[$i])>$max)$max=count($propertys[$i]);		//算最多的字段数
}
if($max>8)$max=8;
for($i=0;$i<$records;$i++){
	$k=count($propertys[$i]);
	for($j=0;$j<$k;$j++){
		if($j==$max-1&&$max!=$k){
			$content[$i].="<td>...</td>";$j++;break;
		}
		$content[$i].="<td>{$propertys[$i][$j]}</td>";
	}
	for(;$j<$max;$j++){
		$content[$i].="<td>　</td>";
	}
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
		<div class="title">模型管理</div>
		<div style="padding:5px;"></div>
		<table width="100%" border="1" bordercolor="888888" cellspacing="0" cellpadding="1">
		<tr>
			<th>名称<img src="images/help_icon.gif" onClick="showhelp(1)"></th>
			<th>默认<img src="images/help_icon.gif" onClick="showhelp(2)"></th>
			<th colspan="{$max}">属性<img src="images/help_icon.gif" onClick="showhelp(3)"></th>
			<th>创建时间</th>
			<th>操作</th>
		</tr>
EOT;
for($i=0;$i<$records;$i++){
echo <<<EOT
		<tr align="center">
			<td>{$stencil[$i]['name']}</td>
			<td>{$stencil[$i]['isdefault']}</td>
			{$content[$i]}
			<td>{$stencil[$i]['posttime']}</td>
			<td><a href="?action=edit&id={$stencil[$i]['id']}">修改</a>
				<a href="?action=del&id={$stencil[$i]['id']}" ONCLICK="javascript:return confirm('真的要删除吗？删除后将不可恢复！应用该模型的栏目需重新指定，但不会影响已有内容');">删除</a>
			</td>
		</tr>
EOT;
}
echo <<<EOT
		</table>
		<div style="padding:15px;"></div>
EOT;
if($action!="edit")
echo <<<EOT
		<div class="title">增加模型</div>
		<div style="padding:5px;"></div>
		<form method="post" action="?action=add" name="form" onsubmit="return checkform();" style="margin:0px;">
EOT;
else
echo <<<EOT
		<div class="title">修改模型</div>
		<div style="padding:5px;"></div>
		<form method="post" action="?action=editsave&id={$stencilconfig['id']}" name="form" onsubmit="return checkform();" style="margin:0px;">
EOT;
echo <<<EOT
		<table width="100%" border="1" bordercolor="888888" cellspacing="0" cellpadding="1">
		<tr>
			<td>模型名称：<img src="images/help_icon.gif" onClick="showhelp(1)">
				<div id="help1" class="help" style="display:none;">模型的标识名，从栏目指定模型时将显示这个名字</div>
			</td>
			<td width="550"><input type="text" name="name" id="name" value="{$stencilconfig['name']}"/>*</td>
		</tr>
		<tr>
			<td>是否设为默认模型：<img src="images/help_icon.gif" onClick="showhelp(2)">
				<div id="help2" class="help" style="display:none;">当相应的栏目没有指定应用的模型时，将自动调用默认模型作为它的模型</div>
			</td>
			<td><input type="radio" name="isdefault" id="isdefault" value="0" {$isdefault0} style="border:0px;"/>当作普通模型
				<input type="radio" name="isdefault" id="isdefault" value="1" {$isdefault1} style="border:0px;"/>设为默认
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="float:left;"><img src="images/help_icon.gif" onClick="showhelp(3)"></div>
				<div id="help3" class="help" style="display:none;">为适应瞬息万变的互联网，固定的产品说明已不能适应越来越多的要求，所以决定推出可以定制的模型。<br/>
					※用法<br/>1　：根据实际的产品输入下面的属性值，如手机行业可以输入：品牌　型号　像素　屏幕布大小　颜色　主要卖点　等。完全根据自己的需要自己定制。<br/>
					2　：一行输入一个属性值，不能有空格。(就算有，也会被自动取消)<br/>
					3　：在相应的分类中，指定所用的模型，然后在添加产品时，就会调用相应的模型来发布自己的产品。
				</div>
			</td>
		</tr>
		<tr>
			<td>属性一：</td>
			<td><input type="text" name="property1" id="property1" value="{$editpro['0']}"/>(最少输入前三项)</td>
		</tr>
		<tr>
			<td>属性二：</td>
			<td><input type="text" name="property2" id="property2" value="{$editpro['1']}"/>(最少输入前三项)</td>
		</tr>
		<tr>
			<td>属性三：</td>
			<td><input type="text" name="property3" id="property3" value="{$editpro['2']}"/>(最少输入前三项)</td>
		</tr>
		<tr>
			<td>属性四：</td>
			<td><input type="text" name="property4" id="property4" value="{$editpro['3']}"/></td>
		</tr>
		<tr>
			<td>属性五：</td>
			<td><input type="text" name="property5" id="property5" value="{$editpro['4']}"/></td>
		</tr>
		<tr>
			<td>属性六：</td>
			<td><input type="text" name="property6" id="property6" value="{$editpro['5']}"/></td>
		</tr>
		<tr>
			<td>属性七：</td>
			<td><input type="text" name="property7" id="property7" value="{$editpro['6']}"/></td>
		</tr>
		<tr>
			<td>属性八：</td>
			<td><input type="text" name="property8" id="property8" value="{$editpro['7']}"/></td>
		</tr>
		<tr>
			<td>属性九：</td>
			<td><input type="text" name="property9" id="property9" value="{$editpro['8']}"/></td>
		</tr>
		<tr>
			<td>属性十：</td>
			<td><input type="text" name="property10" id="property10" value="{$editpro['9']}"/></td>
		</tr>
		<tr><td align="center" colspan="2"><input type="submit" value="提交"></td></tr>
		</table>
		</form>

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
function checkform(){
	if (document.form.name.value==''){
		alert('！！！请输入模型名称');
		document.form.name.focus();
		return false;
	}
	if (document.form.property1.value==''){
		alert('！！！请最少输入前三个属性');
		document.form.property1.focus();
		return false;
	}
	if (document.form.property2.value==''){
		alert('！！！请最少输入前三个属性');
		document.form.property2.focus();
		return false;
	}
	if (document.form.property3.value==''){
		alert('！！！请最少输入前三个属性');
		document.form.property3.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - 后台管理系统 - 产品模型管理";
</script>
EOT;
require("foot.htm");
if($action=="ok")echo "<script language='javascript'>alert('操作成功');</script>";
?>
</body>
</html>
