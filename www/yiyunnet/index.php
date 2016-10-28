<?php
/*
 * 文件创建于 2008-11-4 日 PHPeclipse - PHP - Code Templates
 */


require("inc/head.php");


$showvotecode=showvote(0);

$sql="select * from {$pre}indexconfig order by list desc";
$query=$conn->query($sql);		//===========　一次性将数据读取出来
$records=$conn->num_rows($query);
unset($frontpic,$sprycode);
$frontnewslist=0;
$sprylist=0;			//选项卡显示顺序初始化
$frontrange=FALSE;			//显示在选项卡前面的列表初始化
$backrange=FALSE;			//显示在选项卡后面的列表初始化
for($i=0;$i<$records;$i++){
	$row=$conn->fetch_array($query);
	if($row['keytags']=="frontnews"){		//首页文章，不用处理，直接可显示
		$frontnews=$row;
		$frontnewslist=$row['list'];
		continue;
	}
	if($row['keytags']=="frontpic"&&$row['pic']!=""){		//图片
		$frontpic[]=$row;
		continue;
	}
	if($row['keytags']=="spry"){				//选项卡
		$sprycode[]=$row;
		if($row['list']>$sprylist)$sprylist=$row['list'];
		continue;
	}
	if($row['keytags']=="range"){			//平铺显示的栏目
		$rangecode[]=$row;
	}
}
//===============================================图片显示代码开始
$frontpiccode="";
if(is_array($frontpic) && $frontnewslist==1){
	if(count($frontpic)==1){
		$frontpiccode="<a href=\"{$frontpic[0]['url']}\" target=\"_blank\"><img class=\"frontimg\" src=\"{$frontpic[0]['pic']}\"/></a>";
	}else{
		$picnum=count($frontpic);
		$frontpiccode=<<<EOT
		<div id=oTransContainer style="FILTER: progid:DXImageTransform.Microsoft.Wipe(GradientSize=1.0,wipeStyle=0, motion='forward'); WIDTH: 165px; HEIGHT: 103px">
		<a href="{$frontpic['0']['url']}" target="_blank"><img id="oDIV1" class="frontimg" src="{$frontpic['0']['pic']}"/></a>";
EOT;
		$frontpiccode.=<<<EOT
		<script>var NowFrame = 1;var MaxFrame = {$picnum};var bStart = 0;function fnToggle(){var next = NowFrame + 1;if(next == MaxFrame+1){NowFrame = MaxFrame;next = 1;}if(bStart == 0){bStart = 1;setTimeout('fnToggle()', 2000);return;}else{oTransContainer.filters[0].Apply();document.images['oDIV'+next].style.display = "";document.images['oDIV'+NowFrame].style.display = "none";oTransContainer.filters[0].Play(duration=2);if(NowFrame == MaxFrame){NowFrame = 1;}else{NowFrame++;}}setTimeout('fnToggle()', 6000);}fnToggle();</script>
EOT;
		for($i=1;$i<$picnum;$i++){
			$k=$i+1;
			$frontpiccode.="<a href=\"{$frontpic[$i]['url']}\" target=\"_blank\"><img id=\"oDIV{$k}\" style=\"display:none;\" class=\"frontimg\" src=\"{$frontpic[$i]['pic']}\"/></a>";
		}
		$frontpiccode.="</div>";
	}
}
//===============================================图片显示代码结束,以下为选项卡显示代码
$sprynums=count($sprycode);
for($i=0;$i<$sprynums;$i++){
	$rs=$sprycode[$i];
	if($rs['fids']!=0){
		$rs['content']="";
		switch($rs['listmod']){
			case 0:				//文字列表
				$sql="select * from {$pre}article where fid in ({$rs['fids']}) and yz=1 order by aid desc limit 0,12";
				$query=$conn->query($sql);
				while($row=$conn->fetch_array($query)){
					if(strlen($row['title'])>32)$row['title']=mysubstr($row['title'],0,30)."..";
					$row['posttime']=date("y-m-d",$row['posttime']);
					$rs['content'].="<li><a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><span>{$row['posttime']}</span></li>\n";
				}
				break;
			case 1:				//图片列表
				$sql="select * from {$pre}article where fid in ({$rs['fids']}) and titlepic!='' and yz=1 order by aid desc limit 0,5";
				$query=$conn->query($sql);
				while($row=$conn->fetch_array($query)){
					if(strlen($row['title'])>16)$row['title']=mysubstr($row['title'],0,14)."..";
					$rs['content'].="<div class=\"imagelist\"><a href=\"bencandy.php?id={$row['aid']}\"><img src=\"{$row['titlepic']}\" class=\"spryimg\"><br />{$row['title']}</a></div>\n";
				}
				break;
			case 2:				//文字表表加一图片
				$sql="select * from {$pre}article where fid in ({$rs['fids']}) and titlepic!='' and yz=1 order by aid desc limit 0,1";
				$query=$conn->query($sql);
				$records=$conn->num_rows($query);
				if($records==1){
					$row=$conn->fetch_array($query);
					if(strlen($row['title'])>16)$row['title']=mysubstr($row['title'],0,14)."..";
					$tempimg="<div class=\"imagelist\"><a href=\"bencandy.php?id={$row['aid']}\"><img src=\"{$row['titlepic']}\" class=\"spryimg\"><br />{$row['title']}</a></div>";
				}
				$sql="select * from {$pre}article where fid in ({$rs['fids']}) and yz=1 order by aid desc limit 0,12";
				$query=$conn->query($sql);
				while($row=$conn->fetch_array($query)){
					if($records==1){
						if(strlen($row['title'])>22)$row['title']=mysubstr($row['title'],0,20)."..";
					}else{
						if(strlen($row['title'])>32)$row['title']=mysubstr($row['title'],0,30)."..";
					}
					$row['posttime']=date("y-m-d",$row['posttime']);
					$rs['content'].="<li><a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><span>{$row['posttime']}</span></li>\n";
				}		//以上代码与 case 0 时一样
				if($records==1)$rs['content']="<div class=\"sprycontenttlist\">{$rs['content']}</div>\n{$tempimg}";
				break;
			case 3:				//产品方式显示
				$preg="/\A(.+?)&nbsp;/";
				$sql="select * from {$pre}article a LEFT JOIN {$pre}reply B ON A.aid=B.aid" .
					" where b.property!='' and a.yz=1 and b.topic=1 and a.fid in ({$rs['fids']}) order by a.vouch desc, a.aid desc limit 0,2";
				$query=$conn->query($sql);
				while($row=$conn->fetch_array($query)){
					if(strlen($row['title'])>23)$row['title']=mysubstr($row['title'],0,21)."..";
					$properarr=split(" ",$row['property']);		//取得性值数数
					preg_match($preg,$row['content'],$provalue);		//将值匹配出来
					$row['content']=preg_replace($preg,"",$row['content']);
					if(is_array($provalue['1'])){
						$provaluearr=split(" ",$provalue['1']['0']);
					}else{
						$provaluearr=split(" ",$provalue['1']);
					}
					$rs['content'].="<div class=\"spryprod_block\">\n<a href=\"bencandy.php?id={$row['aid']}\">\n<img class=\"spryprod_img\" src=\"{$row['titlepic']}\"/>\n";
					$rs['content'].="<div class=\"spryprod_title\">{$row['title']}</div></a>\n";
					for($j=0;$j<5;$j++){
						if($properarr[$j]=="")break;
						$rs['content'].="{$properarr[$j]}：{$provaluearr[$j]}<br />\n";
					}
					$contentlen=80+(5-$j)*20;
					$rs['content'].=mysubstr(strip_tags($row['content']),0,$contentlen)."..\n";
					$rs['content'].="</div>";
				}
				break;
		}
		if($rs['content']!=""){
			$sprycode[$i]['content']=$rs['content'];
		}
	}
}
//===============================================选项卡显示代码结束，以下为平铺排列栏目显示
$rangenums=count($rangecode);
for($i=0;$i<$rangenums;$i++){
	$rs=$rangecode[$i];
	if($rs['fids']!=""){		//等于空时不进行任何操作
		$rs['content']="";		//初始化内容。
		if($rs['listmod']==0){		//只显示文字列表
			$sql="select * from {$pre}article where fid in ({$rs['fids']}) and yz=1 order by aid desc limit 0,8";
			$query=$conn->query($sql);
			while($row=$conn->fetch_array($query)){
				if(strlen($row['title'])>30)$row['title']=mysubstr($row['title'],0,29)."..";
				$row['posttime']=date("y-m-d",$row['posttime']);
				$rs['content'].="<li><a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><span>{$row['posttime']}</span></li>\n";
			}
		}elseif($rs['listmod']==2){		//一幅图片加文字列表
			$sql="select * from {$pre}article where fid in ({$rs['fids']}) and titlepic!='' and yz=1 order by vouch desc, aid desc limit 0,1";
			$query=$conn->query($sql);
			$records=$conn->num_rows($query);
			if($records!=1){
				$sql="select * from {$pre}article where fid in ({$rs['fids']}) and yz=1 order by aid desc limit 0,8";
			}else{
				$row=$conn->fetch_array($query);
				$row['posttime']=date("y-m-d H:i:s",$row['posttime']);
				$rs['content'].="<div class=\"rangepic\"><img src=\"{$row['titlepic']}\" class=\"rangeimg\"/><a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><div style=\"text-align:right;\">{$row['posttime']}</div></div>";
				$sql="select * from {$pre}article where fid in ({$rs['fids']}) and yz=1 order by aid desc limit 0,5";
			}
			$query=$conn->query($sql);
			while($row=$conn->fetch_array($query)){
				if(strlen($row['title'])>30)$row['title']=mysubstr($row['title'],0,29)."..";
				$row['posttime']=date("y-m-d",$row['posttime']);
				$rs['content'].="<li><a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><span>{$row['posttime']}</span></li>\n";
			}
		}
		if($rs['content']!=""){
			$rangecode[$i]['content']=$rs['content'];
		}
	}
}
//===============================================平铺排列显示代码结束，以下算出平铺排列的位置
for($i=0;$i<$rangenums;$i++){
	if($rangecode[$i]['list']>$sprylist){
		$frontrange=TRUE;
		$frontrangecode[]=$rangecode[$i];
	}else{
		$backrange=TRUE;
		$backrangecode[]=$rangecode[$i];
	}
}
$frontrangenums=count($frontrangecode);
$backrangenums=count($backrangecode);
unset($rangecode);
//==============================================最近更新代码
$newupdatecode="";
$sql="select * from {$pre}article where yz=1 order by aid desc limit 0,8;";
$query=$conn->query($sql);
while($row=$conn->fetch_array($query)){
	if(strlen($row['title'])>26)$row['title']=mysubstr($row['title'],0,24)."..";
	$newupdatecode.="<a href=\"bencandy.php?id={$row['aid']}\">{$row['title']}</a><br />\n";
}
//==============================================最近更新代码完成
require("template/head.htm");
require("template/index.htm");
require("inc/foot.php");
?>