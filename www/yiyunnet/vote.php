<?php
/*
 * �ļ������� 2008-11-19 �� PHPeclipse - PHP - Code Templates
 */

require("inc/head.php");
$id=(int)$_GET['id'];
$page=(int)$_GET['page'];
$action=filtrate(trim($_GET['action']));




if($action=="save"){
	$sql="select * from {$pre}vote_config where cid={$id}";
	$query=$conn->query($sql);
	if($conn->num_rows($query)<1){
		die("<script>alert(\"��ܰ��ʾ������ͶƱ�����ڻ��ѱ�ɾ����\");location.href=\"index.php\";</script>");
	}
	$row=$conn->fetch_array($query);
	if($row['begintime']>$web['today']){
		die("<script>alert(\"��ܰ��ʾ������ͶƱʱ�仹δ����\");location.href=\"index.php\";</script>");
	}
	if($row['endtime']<$web['today'])
		if($row['endtime']!=0)
			die("<script>alert(\"��ܰ��ʾ������ͶƱ�ѹ��ڣ�\");location.href=\"index.php\";</script>");
	//�û����
	if($row['enableguestvote']==0&&$user['name']==""){
		die("<script>alert('�Բ��𣬸�ͶƱֻ�ڻ�Ա�н��У�');location.href=\"vote.php?id={$id}\";</script>");
	}
	//ʱ������
	if($row['limittime']>0){
		$lastpolltime=(int)$_COOKIE["polltime$id"];
		if($lastpolltime+$row['limittime']*60>$web['today']){
			die("<script>alert('�Բ����벻Ҫ�ظ�ͶƱ��');location.href=\"vote.php?id={$id}\";</script>");
		}
		setcookie("polltime$id",$web['today'],time()+365*24*60*60);
	}
	if($row['type']==2){		//��ѡͶƱ
		for($i=0;$i<8;$i++){
			$optid=(int)$_POST["option{$i}"];
			if($optid>0){
				$sql="select votenum from {$pre}vote where id={$optid}";
				$query=$conn->query($sql);
				$row=$conn->fetch_array($query);
				$votenum=$row['votenum']+1;
				$sql="update {$pre}vote set votenum={$votenum} where id={$optid}";
				$conn->query($sql);
			}
		}
	}else{						//��ѡͶƱ
		$optid=(int)$_POST["option0"];
		if($optid>0){
			$sql="select votenum from {$pre}vote where id={$optid}";
			$query=$conn->query($sql);
			$row=$conn->fetch_array($query);
			$votenum=$row['votenum']+1;
			$sql="update {$pre}vote set votenum={$votenum} where id={$optid}";
			$conn->query($sql);
		}
	}
}




$listrows="20";
if($page<1)$page=1;
$web['daohang'].=" &gt; <a href=\"vote.php\">������ͶƱ</a>";
$sql="select * from {$pre}vote_config where cid={$id}";
$query=$conn->query($sql);
if($conn->num_rows($query)<1){
	$id=0;
	$sql="select * from {$pre}vote_config";
	$query=$conn->query($sql);
	$records=$conn->num_rows($query);
	$maxpage=ceil($records/$listrows);
	if($page>$maxpage)$page=$maxpage;
	if($page<1)$page=1;
	if($maxpage>1)$showpage=showpage($records,$page,$listrows);
	$limitlow=($page-1)*$listrows;
	$sql="select * from {$pre}vote_config  " .
			"order by cid desc limit {$limitlow},{$listrows}";
	$query=$conn->query($sql);
	$showlist="";
	$i=0;
	while($row=$conn->fetch_array($query)){
		$i++;
		if($i<10)$i="0$i";
		$row['posttime']=formatdate($row['posttime'],$web['listdate']);
		if($row['posttime']!="")$row['posttime']="<div class=\"showlisttime\">".$row['posttime']."</div>";
		$showlist.="<div class=\"showlist\">{$i} . <a href=\"vote.php?id={$row['cid']}\">{$row['name']}</a>{$row['posttime']}</div>\n";
	}
	$showvotecode=showvote(0);
}else{
	$row=$conn->fetch_array($query);
	$votename=$row['name'];
	$voteabout=$row['about'];
	$votetype=$row['type'];
	$web['title']=$votename."-".$web['title'];
	$web['daohang'].=" &gt; $votename";
	$sql="select * from {$pre}vote where cid={$id} order by id";
	$query=$conn->query($sql);
	$records=$conn->num_rows($query);
	for($i=0;$i<$records;$i++){
		$voteoptions[$i]=$conn->fetch_array($query);
	}
	$showvotecode=showvote($id);
}


require("template/head.htm");
require("template/vote.htm");
require("inc/foot.php");
?>
