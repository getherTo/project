<?php
/*
 * �ļ������� 2008-11-8 �� PHPeclipse - PHP - Code Templates
 */

/**
 * �б���ʽ������������Ŀ����
 * ����Ŀ���ƣ����ռ�����ʾ���ݹ����
 */
function listsonsort($fidfather,$preli="",$step=1){
	global $conn,$pre,$fid,$web;
	if($step>$web['classlever'])showerror("��ʾ����Ŀ�б�ʱ����ϵͳ��������Ŀ����Ϊ{$web['classlever']}�㣡����");
	$step++;
	if($preli==""){
		$prelison="|--";
	}else{
		$prelison="��".$preli;
	}
	$sql="select fid,name from {$pre}sort where fup={$fidfather} and disable=0 order by listorder desc";
	$query=$conn->query($sql);
	while($row=$conn->fetch_array($query)){
		if($fid==$row['fid']){
			$sonfids.="<li>{$preli}{$row['name']} &lt;&lt;</li>\n";
		}else{
			$sonfids.="<li>{$preli}<a href=\"list.php?fid={$row['fid']}\">{$row['name']}</a></li>\n";
		}
		$sonfids.=listsonsort($row['fid'],$prelison,$step);
	}
	return $sonfids;
}
/**
 * ���ظ���Ŀ������������Ŀ��ʾ�����ݵ�����ĿID��
 * �Զ��ŷָ���������Ŀfid��
 * ���ȸ���ĿҪ������ʾ����Ŀ���ݹ����
 */
function canlistsonsfid ($fidfather,$step=1) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("�ڲ��ҿ���ʾ������Ŀʱ����ϵͳ��������Ŀ����Ϊ{$web['classlever']}�㣡����");
	$step++;
	$sql="select listsons from {$pre}sort where fid={$fidfather}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	if($row['listsons']!=1)return "";		//�������Ŀ��������ʾ����Ŀ�����ؿա�
	$sql="select fid from {$pre}sort where fup={$fidfather} and disable=0 and fatherlist=1";
	$query=$conn->query($sql);
	while($row=$conn->fetch_array($query)){
		$fids.=",".$row['fid'];
		$fids.=canlistsonsfid($row['fid'],$step);
	}
	return $fids;
}

/**
 * ������������Ŀ
 * �Զ��ŷָ���������Ŀfid��
 * ������ҳ���õ���Ŀ�����ҳ�������Ŀ����������Ŀ����ֹ������Ŀ���±�����������
 */
function findsonsfid ($fup,$step=1) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("�ڲ��ҿ���ʾ������Ŀʱ����ϵͳ��������Ŀ����Ϊ{$web['classlever']}�㣡����");
	$step++;
	$sql="select fid from {$pre}sort where fup={$fup}";
	$query=$conn->query($sql);
	while($row=$conn->fetch_array($query)){
		$fids.=",".$row['fid'];
		$fids.=findsonsfid($row['fid'],$step);
	}
	return $fids;
}



/**
 * ��������ʽ��������Ŀ�ż�����Ŀ����
 * ����Ŀ���ּ���ƽ�ȶԴ����ݹ����
 * ��[0]���� fid Ϊ���� fid��nameΪֵ������
 * $all�����Ϊ0��������Ŀ����Ч
 */

function findsonsarray ($fatherid,&$sons,$step=1,$all=0) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("�ڲ�������Ŀ�б�ʱ����ϵͳ��������Ŀ����Ϊ{$web['classlever']}�㣡����");
	$step++;
	if($all==0)
		$sql="select * from {$pre}sort where fup={$fatherid} and disable=0";
	else
		$sql="select * from {$pre}sort where fup={$fatherid}";
	$query=$conn->query($sql);
	$found=FALSE;
	while($row=$conn->fetch_array($query)){
		$sons['0'][$row['fid']]=$row['name'];
		$i=count($sons);
		$sons[$i]['fid']=$row['fid'];
		$sons[$i]['name']=$row['name'];
		$sons[$i]['disable']=$row['disable'];
		$sons[$i]['class']=$step;
		findsonsarray($row['fid'],$sons,$step,$all);
		$found=TRUE;
	}
	return $found;
}

/**
 * ��������ʽ���η����ϼ���Ŀ
 * ����ϼ���Ŀ�н��õģ�����ֹ���С�
 * ��[0]���� fid Ϊ���� fid��nameΪֵ������
 */
function findfatherarray ($fup,&$fathers,$step=1) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("�ڲ����ϼ���Ŀ�б�ʱ����ϵͳ��������Ŀ����Ϊ{$web['classlever']}�㣡����");
	$step++;
	$sql="select fid,name,fup,disable from {$pre}sort where fid={$fup}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	if($row['fid']==""){
		waringlog("FID��Ϊ {$fup} ����Ŀ�����ڣ������¼���Ŀָ���������޸���Ŀ��Ϣ��");
		return FALSE;		//�������ϼ���Ŀ
	}
	if($row['disable']!=0)showerror("�Բ�������Ȩ�鿴�������");
	$fathers['0'][$row['fid']]=$row['name'];
	$i=count($fathers);
	$fathers[$i]['fid']=$row['fid'];
	$fathers[$i]['name']=$row['name'];
	if($row['fup']==0)return TRUE;
	return findfatherarray($row['fup'],$fathers,$step);
}

/**
 * ���ز˵��б����飬δ��ɣ���û�ҵ����õķ���д�����˵�
 * �ڶ�������Ĭ��Ϊ���Ҳ����صġ�
 */
function findmenusarray ($fup,&$menuarray,$findhidden="no",$step=0) {
	global $conn,$pre;
	if($step>3)return '';
	$step++;
	if($findhidden=='no'){
		$sql="select * from {$pre}menu where fup=$fup and hide=0";
	}else{
		$sql="";
	}
}

/**
 * ���ص���ͶƱ�ı�����
 */
function showvote ($cid=0) {
	global $conn,$pre,$web;
	if($cid<1){
		$sql="select * from {$pre}vote_config where begintime<{$web['today']} and (endtime>{$web['today']}||endtime=0) order by cid desc limit 1";
	}else{
		$sql="select * from {$pre}vote_config where cid={$cid} and begintime<{$web['today']} and (endtime>{$web['today']}||endtime=0)";
	}
	$query=$conn->query($sql);
	if($conn->num_rows($query)<1)return "";
	$votem=$conn->fetch_array($query);
	$cid=$votem['cid'];
	$sql="select * from {$pre}vote where cid={$cid} order by id";
	$query=$conn->query($sql);
	if($conn->num_rows($query)<1)return "";
	while($row=$conn->fetch_array($query)){
		$voteo[]=$row;
	}
	$string="<div class=\"title\"><a href=\"vote.php?id={$cid}\"><span>{$votem['name']}</span></a></div>\n";
	$string.="<div class=\"sidecontent\">";
	$string.=$votem['about']."<br/>\n";
	$string.="<form name=\"voteform\" method=\"post\" action=\"vote.php?action=save&id={$cid}\" style=\"margin:0px\">\n";
	if($votem['type']==2){
		for($i=0;$i<count($voteo);$i++)
			$string.="<div style=\"height:25\"><input type=\"checkbox\" name=\"option{$i}\" id=\"option{$i}\" value=\"{$voteo[$i]['id']}\" style=\"border:0\"/> {$voteo[$i]['voteoption']}</div>\n";
	}else{
		for($i=0;$i<count($voteo);$i++)
			$string.="<div style=\"height:25\"><input type=\"radio\" name=\"option0\" id=\"option0\" value=\"{$voteo[$i]['id']}\" style=\"border:0\"/> {$voteo[$i]['voteoption']}</div>\n";
	}
	$string.="<div style=\"text-align:center\"><input type=\"submit\" value=\"�ύ\"/></div>\n";
	$string.="</form>\n</div>\n<div class=\"bottom\"><span></span></div>";
	return $string;
}

/**
 * ����ͼƬ�ĵ��ô���
 * ����������ͼƬ��ַ�������ʾ�ߴ�
 */
function imagecode ($imgfilename,$max=300) {
	global $web;
	$pathname=WEBROOT.substr($imgfilename,strlen($web['dirname'])+1);
	if(!empty($pathname) && file_exists($pathname)){
		$imgsize=getimagesize($pathname);
		$width=$imgsize['0'];
		$height=$imgsize['1'];
		if($height==0||$width==0)return "";
		if($height>$max||$width>$max){
			if($height>$width){
				$scale=$max/$height;
			}else{
				$scale=$max/$width;
			}
			$height=floor($height*$scale);
			$width=floor($width*$scale);
		}
		return "<img src=\"$imgfilename\" width=\"$width\" height=\"$height\" />";
	}else{
		return "<img src=\"$imgfilename\" />";
	}
}


/**
 * ��uploadfile�ļ����д���һ��Ŀ¼
 */
function mkuploaddir ($dirname) {
	if(!preg_match("/\A[\w]{1,12}\Z/",$dirname)){
		die("���ܴ���Ŀ¼");
	}
	$dirpath=WEBROOT."uploadfile/$dirname";
	if(!file_exists($dirpath))return mkdir($dirpath);
	return true;
}

/**
 * ��ʾ������Ϣ
 * Ҫ��ֹ��ǰҳ��Ķ���Ϊ������Ϣ
 */
function showerror ($str,$location="") {
	echo $str;
	exit;
}

/**
 * ��¼������Ϣ
 * ��ǰҳ����Լ���ִ�е�Ϊ������Ϣ�����ó��ָ��û���
 */
function waringlog ($str) {
	;
}















?>
