<?php
/*
 * 文件创建于 2008-11-4 日 PHPeclipse - PHP - Code Templates
 */

require("config.php");
require("conn.php");
require("fun.php");
require("checkfun.php");
require(WEBROOT."images/style.php");
require("code.php");
if($web['close']!=0){
	echo "<title>{$web['title']}</title>";
	echo "<br/><br/>对不起，网站暂时关闭，原因是：<br/>";
	die($web['whyclose']);
}


if(is_file(WEBROOT."images/{$user['styledir']}/css.css")){
	$web['styledir']="images/{$user['styledir']}/css.css";
	$web['stylename']=$user['stylename'];
}elseif(is_file(WEBROOT."images/{$web['styledir']}/css.css")){
	$web['styledir']="images/{$web['styledir']}/css.css";
}else{
	$web['styledir']="images/default/css.css";
}

$sql="select * from {$pre}menu where hide=0 and fup=0 order by list desc";
$query=$conn->query($sql);
$web['menu']="";
while($row=$conn->fetch_array($query)){
	if($row['target']==1){
		$web['menu'].="<li><a href=\"{$row['linkurl']}\" target=\"_blank\"><span>{$row['name']}</span></a></li>\n";
	}else{
		$web['menu'].="<li><a href=\"{$row['linkurl']}\"><span>{$row['name']}</span></a></li>\n";
	}
}
$web['menu']="<ul>".$web['menu']."</ul>";
?>
