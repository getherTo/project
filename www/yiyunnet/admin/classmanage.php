<?php
/*
 * 文件创建于 2008-11-20 日 PHPeclipse - PHP - Code Templates
 */
require("adminhead.php");
$action=filtrate(trim($_GET['action']));
if(isoutlink())$action="";
if($action=="add"){
	$classname=mysubstr(no_special_char($_POST['classname']),0,18);
	$fupclass=(int)$_POST['fupclass'];
	$classmod=(int)$_POST['classmod'];
	if($classname=="")die("<script LANGUAGE='javascript'>alert('错误，分类名称无效！');location.href=\"classmanage.php\";</script>");
	if($fupclass!=0){
		$sql="select * from {$pre}sort where fid={$fupclass}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$fupclass=0;
	}
	$sql="insert into {$pre}sort (name,fup,classmod) VALUES('{$classname}',{$fupclass},{$classmod})";
	$conn->query($sql);
	$action="ok";
}
if($action=="del"){
	if($adminlevel<8)die("<script LANGUAGE='javascript'>alert('错误，您无权删除网站内容！');location.href=\"classmanage.php\";</script>");
	$fid=(int)$_GET['fid'];
	$fids=$fid.findsonsfid($fid);
	if(strstr($fids,",")){
		$fids="fid in({$fids})";
	}else{
		$fids="fid={$fids}";
	}
	$conn->query("delete from {$pre}reply where {$fids}");		//删除内容
	$conn->query("delete from {$pre}article where {$fids}");	//删除内容标题
	$conn->query("delete from {$pre}sort where {$fids}");		//删除分类
	$action="ok";
}
if($action=="editsave"){
	$fid=(int)$_GET['fid'];

	$fupclass=abs((int)$_POST['fupclass']);
	$name=no_special_char($_POST['name']);
	$disable=abs((int)$_POST['disable']);
	$classmod=(int)$_POST['classmod'];
	$indexlist=abs((int)$_POST['indexlist']);
	$hitsofhot=abs((int)$_POST['hitsofhot']);
	$listtitlechars=abs((int)$_POST['listtitlechars']);
	$dateformat=no_special_char($_POST['dateformat']);
	$fatherlist=abs((int)$_POST['fatherlist']);
	$listsons=abs((int)$_POST['listsons']);
	$listsortlen=abs((int)$_POST['listsortlen']);
	$listrows=abs((int)$_POST['listrows']);
	$listcontentchars=abs((int)$_POST['listcontentchars']);
	$keyword=no_special_char($_POST['keyword']);
	$descrip=no_special_char($_POST['descrip']);
	if($name==""){
		die("<script LANGUAGE='javascript'>alert('错误，栏目名称不能为空！');history.go(-1);</script>");
	}
	if($fupclass==$fid){
		die("<script LANGUAGE='javascript'>alert('错误，不能指定自已为自己的上级栏目！');history.go(-1);</script>");
	}
	$sonsfids=findsonsfid($fid);		//找到子栏目列表
	if($sonsfids!=""){
		if(preg_match("/\b{$fupclass}\b/",$sonsfids)){
			die("<script LANGUAGE='javascript'>alert('错误，不能指定自已的子栏目为自己的上级栏目！但可指定其它子栏目为自己的上级栏目！！');history.go(-1);</script>");
		}
	}
	if($fupclass!=0){
		$sql="select * from {$pre}sort where fid={$fupclass}";
		$query=$conn->query($sql);
		if($conn->num_rows($query)<1)$fupclass=0;		//如果指定的上级栏目不存在，则定为顶级栏目
	}
	$sql="update {$pre}sort set fup={$fupclass}, name='{$name}', disable={$disable}, classmod={$classmod}," .
			" indexlist={$indexlist}, listtitlechars={$listtitlechars}, dateformat='{$dateformat}', fatherlist={$fatherlist}," .
			" listsons={$listsons}, listsortlen={$listsortlen}, listrows={$listrows}, listcontentchars={$listcontentchars}," .
			" keyword='{$keyword}', descrip='{$descrip}',hitsofhot={$hitsofhot} where fid={$fid}";
	$conn->query($sql);
	$action="ok";
}
if($action=="edit"){
	$fid=(int)$_GET['fid'];
	$sql="select * from {$pre}sort where fid={$fid}";
	$query=$conn->query($sql);
	if($conn->num_rows($query)!=1)die("<script LANGUAGE='javascript'>alert('错误，目标不存在！');history.go(-1);</script>");
	$fidconfig=$conn->fetch_array($query);
	if($fidconfig['disable'])$disable1="checked";
	else $disable0="checked";
	if($fidconfig['classmod']==2)$classmod2="selected";
	else $classmod1="selected";
	if($fidconfig['indexlist'])$indexlist1="checked";
	else $indexlist0="checked";
	if($fidconfig['fatherlist'])$fatherlist1="checked";
	else $fatherlist0="checked";
	if($fidconfig['listsons'])$listsons1="checked";
	else $listsons0="checked";

}

findsonsarray(0,$fidsarray,0,1);		//找出所有分类
$classoption="";		//下拉列表框代码。增加新类别和修改类别时用到。
$disclass=65535;
for($i=1;$i<count($fidsarray);$i++){
	if($fidsarray[$i]['class']>1){
		$fidsarray[$i]['name']=str_repeat("　　",$fidsarray[$i]['class']-1)."|--".$fidsarray[$i]['name'];
	}
	if($fidconfig['fup']==$fidsarray[$i]['fid']){
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\" selected>{$fidsarray[$i]['name']}</option>\n";
	}else{
		$classoption.="<option value=\"{$fidsarray[$i]['fid']}\">{$fidsarray[$i]['name']}</option>\n";
	}
	//==============下面算那些栏目被禁用，易弄错逻辑
	if($fidsarray[$i]['disable']){
		$fidsarray[$i]['disable']="<span style=\"color:red\">禁用</span>";
		if($fidsarray[$i]['class']<$disclass)$disclass=$fidsarray[$i]['class'];
	}else{
		if($fidsarray[$i]['class']>$disclass){
			$fidsarray[$i]['disable']="<span style=\"color:red\">连带禁用</span>";
		}else{
			$fidsarray[$i]['disable']="正常";
			$disclass=65535;
		}
	}

}
//以下为模型下拉列表框代码
$spenciloption="";
if($fidconfig['classmod']==0){
	$spenciloption.="<option value=\"0\" selected>&lt;不 指 定&gt;</option>";
}else{
	$spenciloption.="<option value=\"0\">&lt;不 指 定&gt;</option>";
}
$query=$conn->query("select name,id from {$pre}stencil");
while($row=$conn->fetch_array($query)){
	if($fidconfig['classmod']==$row['id']){
		$spenciloption.="<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
	}else{
		$spenciloption.="<option value=\"{$row['id']}\">{$row['name']}</option>";
	}
}
if($fidconfig['classmod']==-1){
	$spenciloption.="<option value=\"-1\" selected>&lt;不 应 用&gt;</option>";
}else{
	$spenciloption.="<option value=\"-1\">&lt;不 应 用&gt;</option>";
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
EOT;
if($action!="edit"){
echo <<<EOT
		<div class="title">增加新的分类</div>
		<form method="post" action="?action=add" name="addclass" onsubmit="return checkaddclassform();" style="margin:0">
		<div style="padding:10">
			分类名称：<img src="images/help_icon.gif" onClick="showhelp(1)">
					<input type="text" name="classname" id="classname" size="12"/>
			所属分类：<img src="images/help_icon.gif" onClick="showhelp(2)">
					<select name="fupclass" id="fupclass">
						<option value="0" selected>作为顶级分类</option>
						{$classoption}
					</select>
			模型：<img src="images/help_icon.gif" onClick="showhelp(3)">
					<select name="classmod" id="classmod">
						{$spenciloption}
					</select>
			<input type="submit" value="增加">
		</div>
		<div id="help1" class="help" style="display:none;">分类名称：类别的名字，显示给访问者可以看到的文字，比如　公司新闻　产品中心　售后服务等。</div>
		<div id="help2" class="help" style="display:none;">所属分类：如果选择，增加的这个分类将作为所选择的分类的子类。</div>
		<div id="help3" class="help" style="display:none;">应用模型：在发布信息时，可以自动套用这个模型，可以到模型管理里增加，修改模型。<br/>不指定：将自动查找默认模型并应用，如没有默认的，将不应用模型<br/>不应用：不应用任何模型，适合用于文章，新闻栏目。</div>
		</form>

		<div style="padding:5;border-top:1px solid #888;margin-top:10px"></div>
		<div class="title">编辑分类</div>
		<div style="padding:5px"></div>
		<div id="help4" class="help" style="display:none;">FID：栏目的唯一标识号，创建时系统分配的，不能更改。</div>
		<div id="help5" class="help" style="display:none;">栏目名：栏目名称，按从属关系统显示。</div>
		<div id="help6" class="help" style="display:none;">状态：正常或禁用，如果禁用（假删除，只有后台管理可看到），则该栏目及其子栏目都不可查看，可以解除禁用恢复查看，如果确定不要，可删除操作，。</div>
		<div id="help7" class="help" style="display:none;">浏览：点击　前台查看将新建一个窗口以普通浏览者的身份查看该栏目。</div>
		<div id="help8" class="help" style="display:none;">内容：编辑管理该栏目的内容。</div>
		<div id="help9" class="help" style="display:none;">操作：可修改或删除，修改将显示详细的修改选项。</div>
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<th>FID<img src="images/help_icon.gif" onClick="showhelp(4)"></th>
			<th width="460">栏目名<img src="images/help_icon.gif" onClick="showhelp(5)"></th>
			<th>状态<img src="images/help_icon.gif" onClick="showhelp(6)"></th>
			<th>浏览<img src="images/help_icon.gif" onClick="showhelp(7)"></th>
			<th>内容<img src="images/help_icon.gif" onClick="showhelp(8)"></th>
			<th>操作<img src="images/help_icon.gif" onClick="showhelp(9)"></th>
		</tr>
EOT;
for($i=1;$i	<count($fidsarray);$i++){
echo <<<EOT
		<tr align="center">
			<td>{$fidsarray[$i]['fid']}</td>
			<td align="left">　{$fidsarray[$i]['name']}</td>
			<td>{$fidsarray[$i]['disable']}</td>
			<td><a href="../list.php?fid={$fidsarray[$i]['fid']}" target="_blank">前台查看</a></td>
			<td><a href="infomanage.php?fid={$fidsarray[$i]['fid']}">管理</a></td>
			<td><a href="?action=edit&fid={$fidsarray[$i]['fid']}">修改</a>
				<a href="?action=del&fid={$fidsarray[$i]['fid']}" ONCLICK="javascript:return confirm('真的要删除吗？删除后将不可恢复！建议将它禁用！删除会删出他本身及所有子栏目的全部内容！');">删除</a>
			</td>
		</tr>
EOT;
}
echo "		</table>";
}else{
echo <<<EOT
		<div class="title">栏目修改</div>
		<form method="post" action="?action=editsave&fid={$fid}" name="editclass" onsubmit="return checkeditclassform();" style="margin:0">
		<table width="100%" border="1" bordercolor="aaaaaa" cellspacing="0" cellpadding="2">
		<tr>
			<td>上级栏目：<img src="images/help_icon.gif" onClick="showhelp(10)">
			<div id="help10" class="help" style="display:none;">上级栏目：父栏目，将　{$fidconfig['name']}　作为他的子栏目，如果选择作为顶级栏目，则不从属于任何栏目。</div>
			</td>
			<td><select name="fupclass" id="fupclass">
					<option value="0">作为顶级栏目</option>
					{$classoption}
				</select>
			</td>
		</tr>
		<tr>
			<td>栏目名称：<img src="images/help_icon.gif" onClick="showhelp(11)">
			<div id="help11" class="help" style="display:none;">分类(栏目)名称：类别的名字，显示给访问者可以看到的文字，比如　公司新闻　产品中心　售后服务等。</div>
			</td>
			<td><input type="text" name="name" id="name" value="{$fidconfig['name']}" /></td>
		</tr>
		<tr>
			<td>是否禁用本栏目：<img src="images/help_icon.gif" onClick="showhelp(12)">
			<div id="help12" class="help" style="display:none;">如果禁用（假删除，只有后台管理可看到），则该栏目及其子栏目都不可查看，可以解除禁用恢复查看。</div>
			</td>
			<td><input type="radio" name="disable" id="disable" value="0" {$disable0} style="border:0px;"/>不禁用
				<input type="radio" name="disable" id="disable" value="1" {$disable1} style="border:0px;"/>禁用
			</td>
		</tr>
		<tr>
			<td>栏目模型：<img src="images/help_icon.gif" onClick="showhelp(13)">
			<div id="help13" class="help" style="display:none;">栏目模块：在发布信息时，可以自动套用这个模型，可以到模型管理里增加，修改模型。<br/>不指定：将自动查找默认模型并应用，如没有默认的，将不应用模型<br/>不应用：不应用任何模型，适合用于文章，新闻栏目。</div>
			</td>
			<td><select name="classmod" id="classmod">
					{$spenciloption}
				</select>
			</td>
		</tr>
		<tr>
			<td>是否在首页显示本栏目内容：<img src="images/help_icon.gif" onClick="showhelp(14)">
			<div id="help14" class="help" style="display:none;">暂无帮助说明。</div>
			</td>
			<td><input type="radio" name="indexlist" id="indexlist" value="0" {$indexlist0} style="border:0px;"/>不显示
				<input type="radio" name="indexlist" id="indexlist" value="1" {$indexlist1} style="border:0px;"/>显示
			</td>
		</tr>
		<tr>
			<td>热门信息的最少点击数：<img src="images/help_icon.gif" onClick="showhelp(15)">
			<div id="help15" class="help" style="display:none;">定义为热门信息最少要被浏览的次数，为 0 将以网站整站的定义为准</div>
			</td>
			<td><input type="text" name="hitsofhot" id="hitsofhot" value="{$fidconfig['hitsofhot']}"></td>
		</tr>
		<tr>
			<td>列表页标题的最大长度（字节）：<img src="images/help_icon.gif" onClick="showhelp(16)">
			<div id="help16" class="help" style="display:none;">列表页标题的最大长度：列表页一般是一行显示一个标题，如果标题太长，会出现占两行的情况，所以可以设定显示的长度，当超过设定长度时，超过部分以两个点号表示。<br/>一个汉字算两个字节</div>
			</td>
			<td><input type="text" name="listtitlechars" id="listtitlechars" value="{$fidconfig['listtitlechars']}" />　为０表示不限制</td>
		</tr>
		<tr>
			<td>列表页时间的显示格式：<img src="images/help_icon.gif" onClick="showhelp(17)">
			<div id="help17" class="help" style="display:none;">列表页时间的显示格式：时间显示的样式，可选项为:<br/>年：两位数的年份<br/>月：两位数的月份<br/>日：两位数的日期<br/>时：两位数的小时<br/>分：两位数的分钟<br/>秒：两位数的秒<br/>星期：中文的星期显示，如星期一<br/>不显示：不显示时间<br/>中间可以包含分隔符将各个元素分开，但最好不要包含英文字母</div>
			</td>
			<td><input type="text" name="dateformat" id="dateformat" value="{$fidconfig['dateformat']}" />　可以多个元素组合使用</td>
		</tr>
		<tr>
			<td>是否允许父栏目显示本栏目内容：<img src="images/help_icon.gif" onClick="showhelp(18)">
			<div id="help18" class="help" style="display:none;">比如说这个栏目的父栏目是　栏目Ａ，当用户打开栏目Ａ时是否允许显示这个栏目的内容。</div>
			</td>
			<td><input type="radio" name="fatherlist" id="fatherlist" value="0" {$fatherlist0} style="border:0px;"/>不允许
				<input type="radio" name="fatherlist" id="fatherlist" value="1" {$fatherlist1} style="border:0px;"/>允许
			</td>
		</tr>
		<tr>
			<td>是否允许显示子栏目内容：<img src="images/help_icon.gif" onClick="showhelp(19)">
			<div id="help19" class="help" style="display:none;">请查看上一帮助，如果两者设置互相冲突，以否决权为主。</div>
			</td>
			<td><input type="radio" name="listsons" id="listsons" value="0" {$listsons0} style="border:0px;"/>不允许
				<input type="radio" name="listsons" id="listsons" value="1" {$listsons1} style="border:0px;"/>允许
			</td>
		</tr>
		<tr>
			<td>如显示了子栏目，栏目名称的长度：<img src="images/help_icon.gif" onClick="showhelp(20)">
			<div id="help20" class="help" style="display:none;">如果显示了子栏目的内容，为了区分各个栏目中的文章，在前面显示栏目名，如果没有子栏目显示，该设置无效，为０表示不管什么情况都不显示。<br/>一个汉字算两个字节</div>
			</td>
			<td><input type="text" name="listsortlen" id="listsortlen" value="{$fidconfig['listsortlen']}" />　为０表示不显示</td>
		</tr>
		<tr>
			<td>列表页每页显示多少行：<img src="images/help_icon.gif" onClick="showhelp(21)">
			<div id="help21" class="help" style="display:none;">每页显示的行数，为０表示默认。</div>
			</td>
			<td><input type="text" name="listrows" id="listrows" value="{$fidconfig['listrows']}" />　为０表示默认</td>
		</tr>
		<tr>
			<td>列表页每篇文章显示前面多少个字节：<img src="images/help_icon.gif" onClick="showhelp(22)">
			<div id="help22" class="help" style="display:none;">在列表页显示内容的前一部分，就像内容预览一样的功能。</div>
			</td>
			<td><input type="text" name="listcontentchars" id="listcontentchars" value="{$fidconfig['listcontentchars']}" />　为０表示不显示</td>
		</tr>
		<tr>
			<td>栏目关键字：<img src="images/help_icon.gif" onClick="showhelp(23)">
			<div id="help23" class="help" style="display:none;">为空就是整个网站的关键字，建议不为空，可输入与内容有关的文字。</div>
			</td>
			<td><input type="text" name="keyword" id="keyword" value="{$fidconfig['keyword']}" size="70"/></td>
		</tr>
		<tr>
			<td>栏目描述：<img src="images/help_icon.gif" onClick="showhelp(24)">
			<div id="help24" class="help" style="display:none;">栏目的说明，与关键字一样，适当的运用会提高网站在百度，GOOGLE等的重要性。</div>
			</td>
			<td><input type="text" name="descrip" id="descrip" value="{$fidconfig['descrip']}" size="70" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="提交"/>　<input type="reset" value="重填"></td>
		</tr>
		</table>
		</form>
EOT;
}
echo <<<EOT
	</div>
<script LANGUAGE='javascript'>
function showhelp(sid){
	if(sid < 4){
		for(temp=1;temp<4;temp++){
			if(temp!=sid)eval("help" + temp + ".style.display=\"none\";");
		}
	}
	if(sid > 3 && sid < 9){
		for(temp=4;temp<9;temp++){
			if(temp!=sid)eval("help" + temp + ".style.display=\"none\";");
		}
	}
	whichEl = eval("help" + sid);
	if (whichEl.style.display == "none"){
		eval("help" + sid + ".style.display=\"\";");
	}else{
		eval("help" + sid + ".style.display=\"none\";");
	}
}
function checkaddclassform(){
	if (document.addclass.classname.value==''){
		alert('！！！分类名不能为空！');
		document.addclass.classname.focus();
		return false;
	}
	return true;
}
function checkeditclassform(){
	if (document.editclass.name.value==''){
		alert('！！！栏目名不能为空！');
		document.editclass.name.focus();
		return false;
	}
	return true;
}
top.document.title="{$web['name']} - 后台管理系统 - 网站类别管理";
</script>
EOT;
require("foot.htm");
if($action=="ok")echo "<script LANGUAGE='javascript'>alert('数据更新成功！');</script>";
?>

</body>
</html>
