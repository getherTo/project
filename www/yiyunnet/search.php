<?php
/*
 * 文件创建于 2008-11-11 日 PHPeclipse - PHP - Code Templates
 */

require("inc/head.php");
$web['title'].="-内容搜索";
$keyword=trim($_GET['keyword']);
$type=filtrate(trim($_GET['type']));
$page=(int)$_GET['page'];
if($page<1)$page=1;
$keyword=filtrate($keyword);
$listrows=10;

$sql="select fid from {$pre}sort where disable<>0";
$query=$conn->query($sql);
$disfids="";
while($row=$conn->fetch_array($query)){
	$disfids.=",{$row['fid']}";
	$disfids.=findsonsfid($row['fid']);
}
if($disfids!=""){
	$disfids=substr($disfids,1);
	if(strstr($disfids,",")){
		//$disfid="and fid not in({$disfids})";
		$disfids="and a.fid not in({$disfids})";
	}else{
		//$disfid="and fid<>{$disfids}";
		$disfids="and a.fid<>{$disfids}";
	}
}
if($keyword!=""){
	$web['title'].="-".$keyword;
	$arrkeyword=explode(" ",$keyword);
	$sql="";
	switch($type){
		case "content":
		$checkcontent="checked";
		for($i=count($arrkeyword);$i>0;){
			$i--;
			$sql.=" and b.content like '%{$arrkeyword[$i]}%'";
		}
		$sql=substr($sql,5);
		break;
		case "author":
		$checkauthor="checked";
		$sql="a.author='$keyword'";
		break;
		case "username":
		$checkusername="checked";
		$sql="a.username='$keyword'";
		break;
		default:
		$checktitle="checked";
		$type="title";
		$checktitle="checked";
		for($i=count($arrkeyword);$i>0;){
			$i--;
			$sql.=" and a.title like '%{$arrkeyword[$i]}%'";
		}
		$sql=substr($sql,5);
	}

	$sqljd="select a.aid from {$pre}article a LEFT JOIN {$pre}reply B ON A.aid=B.aid" .
			" where ".$sql." and a.yz=1 and b.topic=1 {$disfids} order by a.aid desc";
	$query=$conn->query($sqljd);
	$records=$conn->num_rows($query);
	if($records>0){
		$maxpage=ceil($records/$listrows);
		if($page>$maxpage)$page=$maxpage;
		$lowerlimit=($page-1)*$listrows;
		$showpage=showpage($records,$page,$listrows);
		$sql="select a.*,b.* from {$pre}article a LEFT JOIN {$pre}reply B ON A.aid=B.aid " .
				"where {$sql} and a.yz=1 and b.topic=1 {$disfids} order by a.aid desc limit {$lowerlimit},{$listrows}";

		$query=$conn->query($sql);
		$i=$lowerlimit+1;
		while($row=$conn->fetch_array($query)){
			if($i<10)$i="0$i";
			$row['title']="<a href=\"bencandy.php?id={$row['aid']}\" target=\"_blank\">{$row['title']}</a>";
			$row['title']="<div class=\"sresulttitle\">{$i} . {$row['title']}</div>\n";
			$row['content']=mysubstr(strip_tags($row['content']),0,200);
			$row['content']="<div class=\"sresultcon\">{$row['content']}...</div>\n";
			$searchresult.="<div class=\"sresult\">{$row['title']}{$row['content']}</div>\n";
			$i++;
		}
	}else{
		$searchresult="<div class=\"sresult\">对不起，没有找到您要的记录。</div>";
	}
}else{			//如果没有查找任何内容，就显示欢迎信息。
	$checktitle="checked";
	$searchresult="<div class=\"sresult\">" .
			"<div class=\"sresulttitle\">欢迎使用搜索功能！</div>\n" .
			"<div class=\"sresultcon\">本站为您提供了非常强大的搜索功能，可以让您非常快速，准确的找到您所要的信息。其主要特点有：</div>\n" .
			"<div class=\"sresultcon\">① . 多关键字查找，如果您记不清具体的查询内容，可以只输入其中几个关键字来进行查找，比如说你输入的关键字为\"网站 2.0\"，那么将会找到所有包含了\"网站\" 和 \"2.0\"的内容<br/>（※多个关键字用空格分开）</div>\n" .
			"<div class=\"sresultcon\">② . 如果您输入的关键字过于严格，导致查询到非常少的内容，那么侧边的栏目会适当的放宽条件查找出相关的内容，如果查询到的结果非常多，侧边的栏目也会从结果中找出较有价值的内容以供参考。</div>\n" .
			"<div class=\"sresultcon\">③ . 界面简洁，符合大多数人的习惯，以不致于让人感到陌生。</div>\n" .
			"<div class=\"sresultcon\">④ . 内容专一，只针对本站进行查找。</div>\n" .
			"</div>";
}

$sqlpre="select a.*,b.* from {$pre}article a LEFT JOIN {$pre}reply B ON A.aid=B.aid where";
$sql="";
if($keyword!=""){
	if($type=="title"){		//111111111111
		$sqlpre="select aid,title from {$pre}article where";
		$disfids=str_replace("a.","",$disfids);
		if($records>20){		//22222222222
			for($i=count($arrkeyword);$i>0;){
				$i--;
				$sql.=" and title like '%{$arrkeyword[$i]}%'";
			}
			$sql=substr($sql,5)." and";
		}else{		//22222222222222
			if(count($arrkeyword)==1 and $records<10){
				$sql="";
			}else{
				for($i=count($arrkeyword);$i>0;){
					$i--;
					$sql.=" or title like '%{$arrkeyword[$i]}%'";
				}
				$sql="(".substr($sql,4).") and";
			}
		}

	}elseif($type=="content"){		//11111111111111111111

		if($records>20){		//22222222222222
			for($i=count($arrkeyword);$i>0;){
				$i--;
				$sql.=" and b.content like '%{$arrkeyword[$i]}%'";
			}
			$sql=substr($sql,5)." and";
		}else{		//22222222222222
			if(count($arrkeyword)==1 and $records<10){
				$sql="";
			}else{
				for($i=count($arrkeyword);$i>0;){
					$i--;
					$sql.=" or b.content like '%{$arrkeyword[$i]}%'";
				}
				$sql="(".substr($sql,4).") and";
			}
		}

	}else{		//111111111111111111
		$sql="";
	}
}
if($sql==""){
	$sqlpre="select aid,title from {$pre}article where";
	$disfids=str_replace("a.","",$disfids);
}




//================================热门点击
$sqlhot="{$sqlpre} {$sql} yz=1 {$disfids} order by hits desc limit 8";

$query=$conn->query($sqlhot);
$i=0;
while($row=$conn->fetch_array($query)){
	$i++;
	if(strlen($row['title'])>28){
		$listhots.="<a href=\"bencandy.php?id={$row['aid']}\" title=\"{$row['title']}\">" .
				mysubstr($row['title'],0,26) .
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
$sqlvouch="{$sqlpre} {$sql} yz=1 and vouch=1 {$disfids} order by posttime desc limit 8";

$query=$conn->query($sqlvouch);
$i=0;
while($row=$conn->fetch_array($query)){
	$i++;
	if(strlen($row['title'])>28){
		$listvouch.="<a href=\"bencandy.php?id={$row['aid']}\" title=\"{$row['title']}\">" .
				mysubstr($row['title'],0,26) .
				"..</a><br/>\n";
	}else{
		$listvouch.="<a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><br/>\n";
	}
}
while($i<8){
	$i++;
	$listvouch.="<br/>";
}
//=============================随机显示技巧。
$artificearr[]="可用空格隔开多个关键字，使结果更加精确！！！";
$artificearr[]="输入关键字后，可以直接按回车发送查询关键字。";
$artificearr[]="随时注意侧边栏，那里的风光也不错!";
$artificearr[]="可用空格隔开多个关键字，使结果更加精确！！！";			//加大显示概率。
$artificearr[]="不选择搜索方式时，默认查找标题。";
$artificearr[]="力争把搜索功能做到更好，欢迎各位提意见。";
$artifice=$artificearr[rand(0,5)];

require("template/search.htm");
require("inc/foot.php");

?>
