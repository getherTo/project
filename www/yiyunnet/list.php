<?php
/*
 * �ļ������� 2008-11-4 �� PHPeclipse - PHP - Code Templates
 */
require("inc/head.php");
$fid=(int)$_GET['fid'];
$page=(int)$_GET['page'];
if($page<1)$page=1;
if($fid<1){
	@header("location:index.php");
	exit;
}
$sql="select * from {$pre}sort where fid={$fid}";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
if($row['fid']==""){
	@header("location:index.php");
	exit;
}
if($row['disable']!=0)showerror("����Ŀ������");


$web['title']="{$web['title']}-{$row['name']}";				//��ҳ���⡣
if($row['keyword'])$web['keywords']=$row['keyword'];		//��վ�ؼ���
if($row['descrip'])$web['description']=$row['descrip'];		//�������
if($row['listrows']<1){$listrows=20;}else{$listrows=$row['listrows'];}
if($row['dateformat']!="")$web['listdate']=$row['dateformat'];//ʱ����ʾ��ʽ
if($row['hitsofhot']>0)$web['hitsofhot']=$row['hitsofhot'];
$listtitlechars=$row['listtitlechars'];						//���������ʾ������
$listcontentchars=$row['listcontentchars'];					//���������ʾ������
$listsortlen=$row['listsortlen'];								//��Ŀ����ʾ����
$fidname=$row['name'];											//������Ŀ��

unset($fatherarray);
findfatherarray($row['fup'],$fatherarray);			//�ҳ������ϼ���Ŀ
$temp=count($fatherarray);
for($i=$temp-1;$i>0;$i--){
	$web['daohang'].=" &gt; <a href=\"list.php?fid={$fatherarray[$i]['fid']}\">{$fatherarray[$i]['name']}</a>";
}
$web['daohang'].=" &gt; {$row['name']}";

//�ҳ�����Ŀ���ϼ���ID��
if($temp>0){$temp-=1;$temp=$fatherarray[$temp]['fid'];}else{$temp=$fid;}

$interfixclass=listsonsort($temp);		//�����Ŀ���루��һ����Ŀ�µ���������Ŀ��
if($interfixclass==""){
	$sql="select fid,name from {$pre}sort where fup=0 and disable=0";
	$query=$conn->query($sql);
	while($row=$conn->fetch_array($query)){
		if($row['fid']==$fid){
			$interfixclass.="<li>{$row['name']} &lt;&lt;</li>";
		}else{
			$interfixclass.="<li><a href=\"list.php?fid={$row['fid']}\">{$row['name']}</a></li>";
		}
	}
}
//====================�����Ŀ������ɡ�


$fids=$fid.canlistsonsfid($fid);			//�õ�������ʾ�� fid �б�

unset($sonsarray);
findsonsarray($fid,$sonsarray);
$sonsarray[0][$fid]=$fidname;		//��Ϊ����Ŀ��û�е�ǰ��Ŀ���ѵ�ǰ��Ŀ�ӽ�ȥ��



//====================������Ϣ
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

//=================�Ƽ���Ϣ
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




//ȡ������¼����ҳ����
$sql="select aid from {$pre}article where fid in ({$fids}) and yz=1";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
$maxpage=ceil($records/$listrows);
if($page>$maxpage)$page=$maxpage;
if($page<1)$page=1;
if($maxpage>1)$showpage=showpage($records,$page,$listrows);
$limitlow=($page-1)*$listrows;
//��ѯ�����¼��
$sql="select * from {$pre}article where fid in ({$fids}) and yz=1 order by aid desc limit $limitlow,$listrows";
$query=$conn->query($sql);
$i=1;

if($listsortlen<0)$listsortlen=0;	//
if(!strstr($fids,","))$listsortlen=0;//�������ʾ����Ŀֻ�е�ǰ��Ŀ������ʾ��Ŀ����
if($listsortlen>0 && $listsortlen<4)$listsortlen=4;

$showlist="";
while($row=$conn->fetch_array($query)){
	if($i<10)$i="0$i";		//ǰ��б����
	$arfid=$row['fid'];
	if($row['openblank']==1){
		$openblank=" target=\"_blank\" ";
	}else{
		$openblank="";
	}
	$arfidname="";
	if($listsortlen>0){
		$arfidname=$sonsarray[0][$arfid];
		if(strlen($arfidname)>$listsortlen){
			$arfidname="[<a href=\"list.php?fid={$arfid}\">".mysubstr($arfidname,0,$listsortlen-2)."..]</a> ";
		}else{
			$arfidname="[<a href=\"list.php?fid={$arfid}\">{$arfidname}</a>] ";
		}
	}
	if($listtitlechars>0 && strlen($row['title'])>$listtitlechars){
		$row['title']=mysubstr($row['title'],0,$listtitlechars)."...";
	}
	$row['title']="<a href=\"bencandy.php?id={$row['aid']}\"{$openblank}>{$row['title']}</a>";
	if($listcontentchars>0){
		$sql="select content from {$pre}reply where aid={$row['aid']} order by rid limit 0,1";
		$querycont=$conn->query($sql);
		$querycont=$conn->fetch_array($querycont);
		$row['content']=mysubstr(strip_tags($querycont['content']),0,$listcontentchars);
		$row['content']="\n<div class=\"listcontent\">{$row['content']}...����" .
						"\n<a href=\"bencandy.php?id={$row['aid']}\"{$openblank}>��</a></div>";
	}
	$row['posttime']=formatdate($row['posttime'],$web['listdate']);
	if($row['posttime']!="")$row['posttime']="<div class=\"showlisttime\">".$row['posttime']."</div>";
	$showlist.="<div class=\"showlist\">{$i} . {$arfidname}{$row['title']} ��({$row['hits']})".
				" {$row['posttime']}{$row['content']}</div>\n";
	$i++;
}
//�������ʾ��¼Ϊ�գ�����ʾ��Ӧ����Ŀ��
if($showlist==""){
	for($i=1;$i<count($sonsarray);$i++){
		$showlist.="<div class=\"showlist\">{$i} . <a href=\"list.php?fid={$sonsarray[$i]['fid']}\">{$sonsarray[$i]['name']}</a></div>\n";
	}
}
if($showlist=="")$showlist="<div class=\"showlist\">�Բ���������ؼ�¼������</div>";



require("template/head.htm");
require("template/list.htm");
require("inc/foot.php");
?>