<?php
/*
 * �ļ������� 2008-11-11 �� PHPeclipse - PHP - Code Templates
 */

require("inc/head.php");
$web['title'].="-��������";
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
		$searchresult="<div class=\"sresult\">�Բ���û���ҵ���Ҫ�ļ�¼��</div>";
	}
}else{			//���û�в����κ����ݣ�����ʾ��ӭ��Ϣ��
	$checktitle="checked";
	$searchresult="<div class=\"sresult\">" .
			"<div class=\"sresulttitle\">��ӭʹ���������ܣ�</div>\n" .
			"<div class=\"sresultcon\">��վΪ���ṩ�˷ǳ�ǿ����������ܣ����������ǳ����٣�׼ȷ���ҵ�����Ҫ����Ϣ������Ҫ�ص��У�</div>\n" .
			"<div class=\"sresultcon\">�� . ��ؼ��ֲ��ң�������ǲ������Ĳ�ѯ���ݣ�����ֻ�������м����ؼ��������в��ң�����˵������Ĺؼ���Ϊ\"��վ 2.0\"����ô�����ҵ����а�����\"��վ\" �� \"2.0\"������<br/>��������ؼ����ÿո�ֿ���</div>\n" .
			"<div class=\"sresultcon\">�� . ���������Ĺؼ��ֹ����ϸ񣬵��²�ѯ���ǳ��ٵ����ݣ���ô��ߵ���Ŀ���ʵ��ķſ��������ҳ���ص����ݣ������ѯ���Ľ���ǳ��࣬��ߵ���ĿҲ��ӽ�����ҳ����м�ֵ�������Թ��ο���</div>\n" .
			"<div class=\"sresultcon\">�� . �����࣬���ϴ�����˵�ϰ�ߣ��Բ��������˸е�İ����</div>\n" .
			"<div class=\"sresultcon\">�� . ����רһ��ֻ��Ա�վ���в��ҡ�</div>\n" .
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




//================================���ŵ��
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

//================================�Ƽ�����
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
//=============================�����ʾ���ɡ�
$artificearr[]="���ÿո��������ؼ��֣�ʹ������Ӿ�ȷ������";
$artificearr[]="����ؼ��ֺ󣬿���ֱ�Ӱ��س����Ͳ�ѯ�ؼ��֡�";
$artificearr[]="��ʱע������������ķ��Ҳ����!";
$artificearr[]="���ÿո��������ؼ��֣�ʹ������Ӿ�ȷ������";			//�Ӵ���ʾ���ʡ�
$artificearr[]="��ѡ��������ʽʱ��Ĭ�ϲ��ұ��⡣";
$artificearr[]="���������������������ã���ӭ��λ�������";
$artifice=$artificearr[rand(0,5)];

require("template/search.htm");
require("inc/foot.php");

?>
