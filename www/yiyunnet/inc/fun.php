<?php
/*
 * 文件创建于 2008-11-8 日 PHPeclipse - PHP - Code Templates
 */

/**
 * 列表形式返回所有子栏目链接
 * 带栏目名称，按照级别显示，递归调用
 */
function listsonsort($fidfather,$preli="",$step=1){
	global $conn,$pre,$fid,$web;
	if($step>$web['classlever'])showerror("显示子栏目列表时出错，系统限制了栏目分类为{$web['classlever']}层！！！");
	$step++;
	if($preli==""){
		$prelison="|--";
	}else{
		$prelison="　".$preli;
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
 * 返回该栏目中所有允许父栏目显示其内容的子栏目ID号
 * 以豆号分隔开的子栏目fid号
 * 首先该栏目要允许显示子栏目，递归调用
 */
function canlistsonsfid ($fidfather,$step=1) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("在查找可显示的子栏目时出错，系统限制了栏目分类为{$web['classlever']}层！！！");
	$step++;
	$sql="select listsons from {$pre}sort where fid={$fidfather}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	if($row['listsons']!=1)return "";		//如果该栏目不允许显示子栏目，返回空。
	$sql="select fid from {$pre}sort where fup={$fidfather} and disable=0 and fatherlist=1";
	$query=$conn->query($sql);
	while($row=$conn->fetch_array($query)){
		$fids.=",".$row['fid'];
		$fids.=canlistsonsfid($row['fid'],$step);
	}
	return $fids;
}

/**
 * 查找所有子栏目
 * 以豆号分隔开的子栏目fid号
 * 在搜索页面用到，目的是找出禁用栏目的所有子栏目，防止禁用栏目文章被搜索出来。
 */
function findsonsfid ($fup,$step=1) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("在查找可显示的子栏目时出错，系统限制了栏目分类为{$web['classlever']}层！！！");
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
 * 以数组形式返回子栏目号及子栏目名。
 * 子栏目不分级别，平等对待，递归调用
 * 键[0]是以 fid 为键名 fid的name为值的数组
 * $all如果不为0则所有栏目都有效
 */

function findsonsarray ($fatherid,&$sons,$step=1,$all=0) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("在查找子栏目列表时出错，系统限制了栏目分类为{$web['classlever']}层！！！");
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
 * 以数组形式依次返回上级栏目
 * 如果上级栏目有禁用的，将终止运行。
 * 键[0]是以 fid 为键名 fid的name为值的数组
 */
function findfatherarray ($fup,&$fathers,$step=1) {
	global $conn,$pre,$web;
	if($step>$web['classlever'])showerror("在查找上级栏目列表时出错，系统限制了栏目分类为{$web['classlever']}层！！！");
	$step++;
	$sql="select fid,name,fup,disable from {$pre}sort where fid={$fup}";
	$query=$conn->query($sql);
	$row=$conn->fetch_array($query);
	if($row['fid']==""){
		waringlog("FID号为 {$fup} 的栏目不存在，但有下级栏目指向它。请修复栏目信息。");
		return FALSE;		//不存在上级栏目
	}
	if($row['disable']!=0)showerror("对不起，您无权查看相关内容");
	$fathers['0'][$row['fid']]=$row['name'];
	$i=count($fathers);
	$fathers[$i]['fid']=$row['fid'];
	$fathers[$i]['name']=$row['name'];
	if($row['fup']==0)return TRUE;
	return findfatherarray($row['fup'],$fathers,$step);
}

/**
 * 返回菜单列表数组，未完成，还没找到更好的方法写下拉菜单
 * 第二个参数默认为查找不隐藏的。
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
 * 返回调查投票的表单代码
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
	$string.="<div style=\"text-align:center\"><input type=\"submit\" value=\"提交\"/></div>\n";
	$string.="</form>\n</div>\n<div class=\"bottom\"><span></span></div>";
	return $string;
}

/**
 * 返回图片的调用代码
 * 参数两个，图片地址，最大显示尺寸
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
 * 在uploadfile文件夹中创建一个目录
 */
function mkuploaddir ($dirname) {
	if(!preg_match("/\A[\w]{1,12}\Z/",$dirname)){
		die("不能创建目录");
	}
	$dirpath=WEBROOT."uploadfile/$dirname";
	if(!file_exists($dirpath))return mkdir($dirpath);
	return true;
}

/**
 * 显示出错信息
 * 要终止当前页面的定义为出错信息
 */
function showerror ($str,$location="") {
	echo $str;
	exit;
}

/**
 * 记录警告信息
 * 当前页面可以继续执行的为警告信息。不用呈现给用户。
 */
function waringlog ($str) {
	;
}















?>
