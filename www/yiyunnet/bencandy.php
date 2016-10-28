<?php
/*
 * 文件创建于 2008-11-4 日 PHPeclipse - PHP - Code Templates
 */

require("inc/head.php");
$id=(int)$_GET['id'];
$page=(int)$_GET['page'];
if($page<1)$page=1;
if($id<1){
	@header("location:index.php");
	exit;
}
$sql="select * from {$pre}article where aid={$id}";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records!=1){showerror("对不起，您要的信息可能被管理员删除！");}
$row=$conn->fetch_array($query);
if($row['yz']!=1)showerror("对不起，该信息还没有被审核！");



/*--------------  取出相关信息  -----------------*/
$fid=$row['fid'];
$title=$row['title'];
$web['title']=$row['title']."-".$web['title'];
$bentitlecolor=$row['titlecolor'];
$openblank=$row['openblank'];

if(strlen($bentitlecolor)!=""){
	$bentitle="<div class=\"bentitle\" style=\"color:{$bentitlecolor}\">{$row['title']}</div>";
}else{
	$bentitle="<div class=\"bentitle\">{$row['title']}</div>";
}
$bencopyfrom=$row['copyfrom'];
$benfromurl=$row['copyfromurl'];
if(strlen($bencopyfrom)>0&&strlen($benfromurl)>0){
	$bencopyfrom="<a href=\"{$benfromurl}\">{$bencopyfrom}</a>";
}
$benauthor=$row['author'];
$benhits=$row['hits']+1;
$benposttime=formatdate($row['posttime'],"y-m-d H:i");
$benusername=$row['username'];
$bentitlepic=$row['titlepic'];
$keywords=$row['keywords'];
if(strlen($keywords)>0)$web['keywords']=$keywords;
/*--------------  取出相关信息完成  -----------------*/


//=================算出页数
$sql="select rid from {$pre}reply where aid={$id}";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records<1){showerror("对不起，您要的信息可能已经被删除！");}
if($records>1){
	$showpage=showpage($records,$page,1);
}
if($page>$records)$page=$records;
$page-=1;
//=======================算出页数完成
$sql="select * from {$pre}reply where aid={$id} order by rid limit {$page},1";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
$bencontent=$row['content'];
$benproperty=$row['property'];
//============================================以下为产品模块
$benpropercode="";
if($benproperty!=""){		//如果有产品属性
	$benproperarr=split(" ",$benproperty);
	$preg="/\A(.+?)&nbsp;/";
	preg_match($preg,$bencontent,$provalue);
	$bencontent=preg_replace($preg,"",$bencontent);
	if(is_array($provalue['1'])){
		$provaluearr=split(" ",$provalue['1']['0']);
	}else{
		$provaluearr=split(" ",$provalue['1']);
	}
	//已成功将值转为两个数组
	$benpropercode="<div class=\"benpro\"><table width=\"100%\" border=\"0\">\n";
	for($i=0;$i<count($benproperarr);$i++){
		$benpropercode.="<tr><td width=\"40%\"><div class=\"benproitem\">{$benproperarr[$i]}：</div></td><td><div class=\"benproitem\">{$provaluearr[$i]}</div></td></tr>\n";
		$benpropercode.="<tr height=\"2\"><td colspan=\"2\"><div class=\"benprohr\"><span style=\"display:none;\">　</span></div></td></tr>";
	}
	$benpropercode.="</table></div><div class=\"benprotitle\">详细说明</div>";
	if($bentitlepic==""){
		$bentitlepiccode="<div class=\"bentitleimgdiv\"></div>";
	}else{
		$bentitlepiccode="<div class=\"bentitleimgdiv\">".imagecode($bentitlepic,300)."</div>";
	}
//	die();
}
//==================================产品模块处理完成；
//文章读取完成











//取出栏目相关设置
$sql="select * from {$pre}sort where fid={$fid}";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
if($row['hitsofhot']>0)$web['hitsofhot']=$row['hitsofhot'];



unset($fatherarray);
findfatherarray($fid,$fatherarray);			//找出所有上级栏目
$temp=count($fatherarray);
for($i=$temp-1;$i>0;$i--){
	$web['daohang'].=" &gt; <a href=\"list.php?fid={$fatherarray[$i]['fid']}\">{$fatherarray[$i]['name']}</a>";
}
$web['daohang'].=" &gt; {$title}";


//===================关键字搜索代码。
$keywordscode="";
$keywords=trim($keywords);
$keywords = preg_replace("/[\s\v]+/"," ",$keywords);
if($keywords!=""){
	$temp=explode(" ",$keywords);
	for($i=count($temp);$i>0;){
		$i--;
		$keywordscode.=" <a href=\"search.php?keyword={$temp[$i]}&type=content\" target=\"_blank\">{$temp[$i]}</a>\n";
	}
	$keywordscode="关键字：$keywordscode";
}


$fids.=$fid.canlistsonsfid($fid);			//得到可以显示的 fid 列表。

//================================热门点击
$sql="select title,aid from {$pre}article where fid in({$fids})" .
		" and yz=1 and hits>{$web['hitsofhot']} order by aid desc limit 8";
$query=$conn->query($sql);
$i=0;
while($row=$conn->fetch_array($query)){
	$i++;
	if(strlen($row['title'])>26){
		$listhots.="<a href=\"bencandy.php?id={$row['aid']}\" title=\"{$row['title']}\">" .
				mysubstr($row['title'],0,24) .
				"..</a><br/>\n";
	}else{
		$listhots.="<a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><br/>\n";
	}
}
while($i<8){
	$i++;
	$listhots.="<br/>";
}

//================================推荐文章
$sql="select title,aid from {$pre}article where fid in({$fids})" .
		" and yz=1 and vouch=1 order by aid desc limit 8";
$query=$conn->query($sql);
$i=0;
while($row=$conn->fetch_array($query)){
	$i++;
	if(strlen($row['title'])>26){
		$listvouch.="<a href=\"bencandy.php?id={$row['aid']}\" title=\"{$row['title']}\">" .
				mysubstr($row['title'],0,24) .
				"..</a><br/>\n";
	}else{
		$listvouch.="<a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><br/>\n";
	}
}
while($i<8){
	$i++;
	$listvouch.="<br/>";
}

//=================================相关文章
$kindred="";
$i=0;
if(strlen(trim($keywords))>0){
	$keywords=preg_replace("/[\s\v]+/"," ",$keywords);
	$keywords=explode(" ",$keywords);
	$i=count($keywords);
	$sql="";
	while($i>0){
		$i--;
		$sql.=" or keywords like '%{$keywords[$i]}%'";
	}
	$sql=substr($sql,4);
	$sql="select title,aid from {$pre}article where ({$sql}) and yz=1 and aid<>{$id} order by aid desc limit 8";
	$query=$conn->query($sql);
	while($row=$conn->fetch_array($query)){
		$i++;
		if(strlen($row['title'])>26){
			$kindred.="<a href=\"bencandy.php?id={$row['aid']}\" title=\"{$row['title']}\">" .
					mysubstr($row['title'],0,24) .
					"..</a><br/>\n";
		}else{
			$kindred.="<a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><br/>\n";
		}
	}
}
while($i<8){
	$i++;
	$kindred.="<br/>";
}

//=======================上一篇与下一篇
$sql="select * from {$pre}article where aid<{$id} and yz=1  and fid={$fid} order by aid desc limit 0,1";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
if($row['title']==""){
	$lastpage="没有了";
}
else{
	if(strlen($row['title'])>30){
		$lastpage="<a href=\"bencandy.php?id={$row['aid']}\"title=\"{$row['title']}\">".mysubstr($row['title'],0,28)."..</a>";
	}else{
		$lastpage="<a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a>";
	}
}

$sql="select * from {$pre}article where aid>{$id} and yz=1 and fid={$fid} order by aid limit 0,1";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
if($row['title']==""){
	$nextpage="没有了";
}else{
	if(strlen($row['title'])>30){
		$nextpage="<a href=\"bencandy.php?id={$row['aid']}\"title=\"{$row['title']}\">".mysubstr($row['title'],0,28)."..</a>";
	}else{
		$nextpage="<a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a>";
	}
}


$sql="update {$pre}article set hits={$benhits} where aid={$id}";
$conn->query($sql);
require("template/head.htm");
require("template/bencandy.htm");
require("inc/foot.php");
?>