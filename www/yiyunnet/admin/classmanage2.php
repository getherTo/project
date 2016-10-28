<?php
/*
 * 文件创建于 2008-11-21 日 PHPeclipse - PHP - Code Templates
 */


require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="joinsave"){
	$classa=abs((int)$_GET['classa']);
	$classb=abs((int)$_GET['classb']);
	if($classa==0||$classb==0){
		die("<script LANGUAGE='javascript'>alert('错误！');location.href=\"classmanage2.php\";</script>");
	}
	if($classa==$classb){
		die("<script LANGUAGE='javascript'>alert('错误！不能自己合并自己');location.href=\"classmanage2.php\";</script>");
	}

	$sql="select * from {$pre}sort where fid={$classa}";
	$query=$conn->query($sql);
	$aconfig=$conn->fetch_array($query);
	if($aconfig['fid']!=$classa)
		die("<script LANGUAGE='javascript'>alert('错误！');location.href=\"classmanage2.php\";</script>");

	$asonsfid=findsonsfid($classa);
	if(preg_match("/\b{$classb}\b/",$asonsfid))
		die("<script LANGUAGE='javascript'>alert('错误！栏目 B 不能是栏目 A 的子栏目。');location.href=\"classmanage2.php\";</script>");
	$sql="select * from {$pre}sort where fid={$classb}";
	$query=$conn->query($sql);
	$bconfig=$conn->fetch_array($query);
	if($bconfig['fid']!=$classb)
		die("<script LANGUAGE='javascript'>alert('错误！');location.href=\"classmanage2.php\";</script>");
	$conn->query("update {$pre}reply set fid={$classb} where fid={$classa}");		//将fid为A的fid改为B
	$conn->query("update {$pre}article set fid={$classb} where fid={$classa}");		//将fid为A的fid改为B
	$conn->query("update {$pre}sort set fup={$classb} where fup={$classa}");		//将fup为A的fup改为B
	$conn->query("delete from {$pre}sort where fid={$classa}");		//删除A
	$action="ok";
}
if($action=="restor"){
	$acceptclass=abs((int)$_GET['acceptclass']);
	if($acceptclass>0){
		$sql="select * from {$pre}sort where fid={$acceptclass}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$acceptclass=0;	//如果接收栏目不存在，设为顶级栏目
	}
	$okfids=substr(findsonsfid(0,0),1);
	$conn->query("update {$pre}sort set fup={$acceptclass} where fid not in ({$okfids})");
	$action="ok";
}
if($action=="move"){
	$movea=abs((int)$_GET['movea']);
	$moveb=abs((int)$_GET['moveb']);
	if($movea==0){
		die("<script LANGUAGE='javascript'>alert('错误！');location.href=\"classmanage2.php\";</script>");
	}
	if($movea==$moveb){
		die("<script LANGUAGE='javascript'>alert('错误！不能这样移动');location.href=\"classmanage2.php\";</script>");
	}
	$asonsfid=findsonsfid($movea);
	if(preg_match("/\b{$moveb}\b/",$asonsfid))
		die("<script LANGUAGE='javascript'>alert('错误！栏目 B 不能是栏目 A 的子栏目。');location.href=\"classmanage2.php\";</script>");
	if($moveb>0){
		$sql="select * from {$pre}sort where fid={$moveb}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$moveb=0;
	}
	$conn->query("update {$pre}sort set fup={$moveb} where fid={$movea}");
	$action="ok";
}

$classoption="";		//下拉列表框代码。被合并栏目和目标栏目时用到。
findsonsarray(0,$fidsarray,0,1);		//找出所有分类
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("　　",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	$classoption.="<option value=\"{$fidsarray[$i]['fid']}\">{$fidsarray[$i]['name']}</option>\n";
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
		<div class="title">栏目合并操作</div>
		<form method="get" action="" name="joinclass" onsubmit="return checkjoinform();" style="margin:0px;">
		<div style="padding:10px;">
			将栏目A
			<select name="classa" id="classa">
				<option value="">===请选择栏目 A ===</option>
				{$classoption}
			</select>
			合并到B
			<select name="classb" id="classb">
				<option value="">===请选择栏目 B ===</option>
				{$classoption}
			</select>
			栏目中
			<input type="hidden" name="action" id="action" value="joinsave"/>
			<input type="submit" value="执行">
		</div>
		</form>
		<div style="margin:0 0 0 30;">
			<li>功能：将栏目 A 合并到栏目 B 中（即两个栏目合并到一个栏目）</li>
			<li>合并后栏目 A 将不再存在，也无法再创建和这一样的栏目</li>
			<li>原先 A 中的子栏目会被当作 B 中的子栏目，不会受到其它影响</li>
			<li>如果栏目 B 是栏目 A 的子栏目，合并不能成功，（即不能合并到子栏目中）</li>
			<li>如果栏目 A 是栏目 B 的子栏目，可以合并，合并后栏目 A 的子栏目成栏目 B 的直接子栏目</li>
		</div>



		<div style="padding:20px;"></div>
		<div class="title">修复出错栏目</div>
		<form method="get" action="" name="restoreclass" style="margin:0px;">
		<div style="padding:10px;">
			将出错栏目放到
			<select name="acceptclass" id="acceptclass">
				<option value="0">==顶==级==</option>
				{$classoption}
			</select>
			栏目中
			<input type="hidden" name="action" id="action" value="restor"/>
			<input type="submit" value="修复出错栏目">
		</div>
		</form>
		<div style="margin:0 0 0 30;">
			<li>功能：将出错栏目放到指定的栏目中。</li>
			<li>建议每隔一段时间修复一次，程序设计时可以足够保证栏目不出错，但可能有未知原因，还是修复一下好一点。</li>
			<li>操作简单，只要点一下　修复出错栏目　就可，如没有出错栏目，则不会进行任何操作。</li>
		</div>



		<div style="padding:20px;"></div>
		<div class="title">栏目移动操作</div>
		<form method="get" action="" name="moveclass" onsubmit="return checkmoveform();" style="margin:0px;">
		<div style="padding:10px;">
			将栏目A
			<select name="movea" id="movea">
				<option value="">===请选择栏目 A ===</option>
				{$classoption}
			</select>
			移动到B
			<select name="moveb" id="moveb">
				<option value="">===请选择栏目 B ===</option>
				<option value="0">==顶==级==</option>
				{$classoption}
			</select>
			栏目中
			<input type="hidden" name="action" id="action" value="move"/>
			<input type="submit" value="移 动">
		</div>
		</form>
		<div style="margin:0 0 0 30;">
			<li>功能：将栏目 A 移动到栏目 B 中并作为它的子栏目</li>
			<li>原先 A 中的子栏目会被被一起移动，但仍然是 A 的子栏目。</li>
			<li>不能移动到子栏目中，（如果栏目 B 是栏目 A 的子栏目，可先将 B 移动到外面，再把 A 移动到 B ）</li>
		</div>



	</div>
<script LANGUAGE='javascript'>
function showhelp(sid){
	whichEl = eval("help" + sid);
	if (whichEl.style.display == "none"){
		eval("help" + sid + ".style.display=\"\";");
	}else{
		eval("help" + sid + ".style.display=\"none\";");
	}
}
function checkjoinform(){
	if (document.joinclass.classa.value==''){
		alert('！！！请选择栏目A');
		document.joinclass.classa.focus();
		return false;
	}
	if (document.joinclass.classb.value==''){
		alert('！！！请选择栏目B');
		document.joinclass.classb.focus();
		return false;
	}
	return true;
}
function checkmoveform(){
	if (document.moveclass.movea.value==''){
		alert('！！！请选择栏目A');
		document.moveclass.movea.focus();
		return false;
	}
	if (document.moveclass.moveb.value==''){
		alert('！！！请选择栏目B');
		document.moveclass.moveb.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - 后台管理系统 - 网站类别管理";
</script>
EOT;
if($action=="ok")echo "<script LANGUAGE='javascript'>alert('操作完成！');</script>";
require("foot.htm");
?>
</body>
</html>