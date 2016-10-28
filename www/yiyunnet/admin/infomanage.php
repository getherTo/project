<?php
/*
 * 文件创建于 2008-11-22 日 PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
$action=filtrate(trim($_GET['action']));
$fid=abs((int)$_GET['fid']);
$page=abs((int)$_GET['page']);
$listrows=20;
$showpage="";
//========================================================以下为数据更新代码
if($action=="work"){		//批量操作代码
	$ids="";
	for($i=0;$i<$listrows;$i++){
		$id=(int)$_POST['list'.$i];
		if($id>0)$ids.=",".$id;
	}
	$ids=substr($ids,1);
	if($ids==""){
		die("<script LANGUAGE='javascript'>alert('错误，没有记录可更改！');history.go(-1);</script>");
	}
	switch($work){
		case "del":
			$del2=(int)$_POST['del2'];
			if($del2!=1)die("<script LANGUAGE='javascript'>alert('不能删除，请同时选择确认删除！');history.go(-1);</script>");
			if($adminlevel<8){
				die("<script LANGUAGE='javascript'>alert('对不起，您无权删除网站内容！');history.go(-1);</script>");
			}
			$conn->query("delete from {$pre}article where aid in({$ids})");
			$conn->query("delete from {$pre}reply where aid in({$ids})");
			break;
		case "vouch":
			$conn->query("update {$pre}article set vouch=1 where aid in({$ids})");
			break;
		case "notvouch":
			$conn->query("update {$pre}article set vouch=0 where aid in({$ids})");
			break;
		case "yz":
			$conn->query("update {$pre}article set yz=1 where aid in({$ids})");
			break;
		case "notyz":
			$conn->query("update {$pre}article set yz=0 where aid in({$ids})");
			break;
		case "openblank":
			$conn->query("update {$pre}article set openblank=1 where aid in({$ids})");
			break;
		case "notopenblank":
			$conn->query("update {$pre}article set openblank=0 where aid in({$ids})");
			break;
		default:
			die("<script LANGUAGE='javascript'>alert('没有操作要进行，请确认选择了操作方法！');history.go(-1);</script>");
			break;
	}
	header("location:".$web['refpage']);exit;
}
if($action=="changeyz"||$action=="changevouch"||$action=="changeopenblank"){		//更改单个信息状态代码
	$id=(int)$_GET['id'];
	$sql="select * from {$pre}article where aid={$id}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	if($row['aid']!=$id)die("<script LANGUAGE='javascript'>alert('非法操作！');history.go(-1);</script>");
	$row['yz']==1?$yz=0:$yz=1;
	$row['vouch']==1?$vouch=0:$vouch=1;
	$row['openblank']==1?$openblank=0:$openblank=1;
	if($action=="changeyz")$conn->query("update {$pre}article set yz={$yz} where aid={$id}");
	if($action=="changevouch")$conn->query("update {$pre}article set vouch={$vouch} where aid={$id}");
	if($action=="changeopenblank")$conn->query("update {$pre}article set openblank={$openblank} where aid={$id}");
	header("location:".$web['refpage']);exit;
}
if($action=="del"){				//删除单个信息代码
	if($adminlevel<8){
		die("<script LANGUAGE='javascript'>alert('对不起，您无权删除网站内容！');history.go(-1);</script>");
	}
	$id=(int)$_GET['id'];
	$conn->query("delete from {$pre}article where aid={$id}");
	$conn->query("delete from {$pre}reply where aid={$id}");
	header("location:".$web['refpage']);exit;
}
//=========================================================数据更新代码结束
if($fid>0){
	$query=$conn->query("select * from {$pre}sort where fid={$fid}");
	$row=$conn->fetch_array($query);
	if($row['fid']!=$fid){
		$fid=0;
	}
}
$vyz=(int)$_GET['vyz'];
$vvouch=(int)$_GET['vvouch'];
$vopenblank=(int)$_GET['vopenblank'];
//=========================================
findsonsarray(0,$fidsarray,0,1);		//找出所有分类
$classoption="";		//下拉列表框代码。
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("　",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	if($fid==$fidsarray[$i]['fid']){
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\" selected>{$fidsarray[$i]['name']}</option>\n";
	}else{
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\">{$fidsarray[$i]['name']}</option>\n";
	}
}
//==========================================以下是查询条件相关代码
$sql="select * from {$pre}article";
if($fid>0){
	$sqlv=" and fid={$fid}";
}
if($vyz==1){
	$sqlv.=" and yz=1";$vyz1="selected";
}elseif($vyz==2){
	$sqlv.=" and yz=0";$vyz2="selected";
}
if($vvouch==1){
	$sqlv.=" and vouch=1";$vvouch1="selected";
}elseif($vvouch==2){
	$sqlv.=" and vouch=0";$vvouch2="selected";
}
if($vopenblank==1){
	$sqlv.=" and openblank=1";$vopenblank1="selected";
}elseif($vopenblank==2){
	$sqlv.=" and openblank=0";$vopenblank2="selected";
}
if($sqlv!="")$sql.=" where ".substr($sqlv,5);
//============================================查询条件相关代码完成
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($page<1)$page=1;
if($maxpage>1) $showpage=showpage($records,$page,$listrows);
$limitlow=($page-1)*$listrows;
$sql.=" order by aid desc limit $limitlow,$listrows";
$query=$conn->query($sql);
$k=$conn->num_rows($query);
for($i=0;$i<$k;$i++){
	$infos[$i]=$conn->fetch_array($query);
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
		<div class="title">网站信息管理</div>
		<div style="padding:5px;"></div>
		<form name="formv" action="" method="get" style="margin:0px;">
			栏目<select name="fid" id="fid"><option value="0">查看所有栏目</option>{$classoption}</select>
			&nbsp;　审核<select name="vyz" id="vyz"><option value="0">不限</option><option value="1" {$vyz1}>已审核</option><option value="2" {$vyz2}>未审核</option></select>
			&nbsp;　推荐<select name="vvouch" id="vvouch"><option value="0">不限</option><option value="1" {$vvouch1}>已推荐</option><option value="2" {$vvouch2}>未推荐</option></select>
			&nbsp;　打开方式<select name="vopenblank" id="vopenblank"><option value="0">不限</option><option value="1" {$vopenblank1}>新窗口</option><option value="2" {$vopenblank2}>原窗口</option></select>
			&nbsp;　<input type="submit" value="查看" />
		</form>
		<div style="padding:5px;"></div>
		<form name="form1" action="?action=work" method="post" onsubmit="return checkform();" style="margin:0px;">
		<table width="100%" border="1" bordercolor="#cccccc">
		<tr>
			<th width="6%">ID</th>
			<th width="46%">标 题</th>
			<th width="5%">浏览</th>
			<th width="9%">发表日期</th>
			<th width="7%">审核</th>
			<th width="7%">推荐</th>
			<th width="9%">打开方式</th>
			<th width="11%">修改/删除</th>
		</tr>
EOT;
for($key=0;$key<count($infos);$key++){
$rs=$infos[$key];
//foreach($infos AS $key=>$rs){
$rs['posttime']=date("y-m-d H:i",$rs['posttime']);
if($rs['yz']==1)$rs['yz']="<span style=\"color:#046304;\">&nbsp; √ &nbsp;</span>";
else $rs['yz']="<span style=\"color:#f00;\">&nbsp; ╳ &nbsp;</span>";
if($rs['vouch']==1)$rs['vouch']="<span style=\"color:#046304;\">&nbsp; √ &nbsp;</span>";
else $rs['vouch']="<span style=\"color:#f00;\">&nbsp; ╳ &nbsp;</span>";
if($rs['openblank']==1)$rs['openblank']="<span style=\"color:#f00;\">新窗品</span>";
else $rs['openblank']="原窗口";
echo <<<EOT
		<tr align="center">
			<td>{$rs['aid']}</td>
			<td align="left">
				<input type="checkbox" name="list{$key}" id="list{$key}" value="{$rs['aid']}" style="border:0px;">
				<a href="../bencandy.php?id={$rs[aid]}" target="_blank"><span style="color:{$rs['titlecolor']}">{$rs[title]}</span></a>
			</td>
			<td>{$rs['hits']}</td>
			<td>{$rs['posttime']}</td>
			<td><a href="?action=changeyz&id={$rs[aid]}">{$rs['yz']}</a></td>
			<td><a href="?action=changevouch&id={$rs[aid]}">{$rs['vouch']}</a></td>
			<td><a href="?action=changeopenblank&id={$rs[aid]}">{$rs['openblank']}</a></td>
			<td>
				<a href="infoedit.php?id={$rs['aid']}">修改</a>
				<a href="?action=del&id={$rs['aid']}" ONCLICK="javascript:return confirm('真的要删除吗？删除后将不可恢复！！');">删除</a>
			</td>
		</tr>
EOT;
}
if($key==0)echo "<tr><td colspan=\"8\" height=\"40\">没找到任何内容</td></tr>";
echo <<<EOT
		<tr>
			<td colspan="8">
				[<a href="javascript:" onClick="CheckAll('all')">全选</a>/<a href="javascript:" onClick='CheckAll()'>反选</a>/<a href="javascript:" onClick="CheckAll('no')">不选</a>]
				<input type="radio" name="work" id="work" value="yz" style="border:0px;" />审核
				<input type="radio" name="work" id="work" value="notyz" style="border:0px;" />取消审核
				<input type="radio" name="work" id="work" value="vouch" style="border:0px;" />推荐
				<input type="radio" name="work" id="work" value="notvouch" style="border:0px;" />取消推荐
				<input type="radio" name="work" id="work" value="notopenblank" style="border:0px;" />原窗口打开
				<input type="radio" name="work" id="work" value="openblank" style="border:0px;" />新窗口打开
				<input type="radio" name="work" id="work" value="del" style="border:0px;" />删除
				<input type="checkbox" name="del2" id="del2" value="1" style="border:0px;" />确认删除
				<input type="submit" value="执行" />
			</td>
		</tr>
		</table>
		</form>
		<div class="showpage">{$showpage}</div>
	</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
function CheckAll(va){
	form=document.form1
	for (var i=0;i<form.elements.length-9;i++){
		var e = form.elements[i];
		if(va=='all'){
			e.checked = true;
		}else{
			if(va=='no'){
				e.checked = false;
			}else{
				e.checked == true ? e.checked = false : e.checked = true;
			}
		}
	}
}
function checkform() {
	form=document.form1
	var checko=false;
	for(var i=0;i<form.elements.length-9;i++){
		var e = form.elements[i];
		if(e.checked == true){
			checko=true;
			break;
		}
	}
	if(checko==false){
		alert( '您没有选择要操作的信息!');
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - 后台管理系统 - 网站内容管理";
//-->
</SCRIPT>
EOT;
require("foot.htm");
?>
</body>
</html>