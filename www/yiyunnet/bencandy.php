<?php
/*
 * �ļ������� 2008-11-4 �� PHPeclipse - PHP - Code Templates
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
if($records!=1){showerror("�Բ�����Ҫ����Ϣ���ܱ�����Աɾ����");}
$row=$conn->fetch_array($query);
if($row['yz']!=1)showerror("�Բ��𣬸���Ϣ��û�б���ˣ�");



/*--------------  ȡ�������Ϣ  -----------------*/
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
/*--------------  ȡ�������Ϣ���  -----------------*/


//=================���ҳ��
$sql="select rid from {$pre}reply where aid={$id}";
$query=$conn->query($sql);
$records=$conn->num_rows($query);
if($records<1){showerror("�Բ�����Ҫ����Ϣ�����Ѿ���ɾ����");}
if($records>1){
	$showpage=showpage($records,$page,1);
}
if($page>$records)$page=$records;
$page-=1;
//=======================���ҳ�����
$sql="select * from {$pre}reply where aid={$id} order by rid limit {$page},1";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
$bencontent=$row['content'];
$benproperty=$row['property'];
//============================================����Ϊ��Ʒģ��
$benpropercode="";
if($benproperty!=""){		//����в�Ʒ����
	$benproperarr=split(" ",$benproperty);
	$preg="/\A(.+?)&nbsp;/";
	preg_match($preg,$bencontent,$provalue);
	$bencontent=preg_replace($preg,"",$bencontent);
	if(is_array($provalue['1'])){
		$provaluearr=split(" ",$provalue['1']['0']);
	}else{
		$provaluearr=split(" ",$provalue['1']);
	}
	//�ѳɹ���ֵתΪ��������
	$benpropercode="<div class=\"benpro\"><table width=\"100%\" border=\"0\">\n";
	for($i=0;$i<count($benproperarr);$i++){
		$benpropercode.="<tr><td width=\"40%\"><div class=\"benproitem\">{$benproperarr[$i]}��</div></td><td><div class=\"benproitem\">{$provaluearr[$i]}</div></td></tr>\n";
		$benpropercode.="<tr height=\"2\"><td colspan=\"2\"><div class=\"benprohr\"><span style=\"display:none;\">��</span></div></td></tr>";
	}
	$benpropercode.="</table></div><div class=\"benprotitle\">��ϸ˵��</div>";
	if($bentitlepic==""){
		$bentitlepiccode="<div class=\"bentitleimgdiv\"></div>";
	}else{
		$bentitlepiccode="<div class=\"bentitleimgdiv\">".imagecode($bentitlepic,300)."</div>";
	}
//	die();
}
//==================================��Ʒģ�鴦����ɣ�
//���¶�ȡ���











//ȡ����Ŀ�������
$sql="select * from {$pre}sort where fid={$fid}";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
if($row['hitsofhot']>0)$web['hitsofhot']=$row['hitsofhot'];



unset($fatherarray);
findfatherarray($fid,$fatherarray);			//�ҳ������ϼ���Ŀ
$temp=count($fatherarray);
for($i=$temp-1;$i>0;$i--){
	$web['daohang'].=" &gt; <a href=\"list.php?fid={$fatherarray[$i]['fid']}\">{$fatherarray[$i]['name']}</a>";
}
$web['daohang'].=" &gt; {$title}";


//===================�ؼ����������롣
$keywordscode="";
$keywords=trim($keywords);
$keywords = preg_replace("/[\s\v]+/"," ",$keywords);
if($keywords!=""){
	$temp=explode(" ",$keywords);
	for($i=count($temp);$i>0;){
		$i--;
		$keywordscode.=" <a href=\"search.php?keyword={$temp[$i]}&type=content\" target=\"_blank\">{$temp[$i]}</a>\n";
	}
	$keywordscode="�ؼ��֣�$keywordscode";
}


$fids.=$fid.canlistsonsfid($fid);			//�õ�������ʾ�� fid �б�

//================================���ŵ��
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

//================================�Ƽ�����
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

//=================================�������
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

//=======================��һƪ����һƪ
$sql="select * from {$pre}article where aid<{$id} and yz=1  and fid={$fid} order by aid desc limit 0,1";
$query=$conn->query($sql);
$row=$conn->fetch_array($query);
if($row['title']==""){
	$lastpage="û����";
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
	$nextpage="û����";
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