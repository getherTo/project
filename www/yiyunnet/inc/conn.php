<?php
/*
 * 文件创建于 2008-11-4 日 PHPeclipse - PHP - Code Templates
 */

/**
* 以下变量需根据您的服务器说明档修改
*/
$dbhost="localhost";	// 数据库服务器(一般不必改)
$dbuser="root";		// 数据库用户名
$dbpw="";			// 数据库密码
$dbname="yiyunnet";		// 数据库名
$pre="yiyun_";			// 网站表区分符
$database = 'mlsql';	// 数据库类型(一般不必改)
$pconnect = 0;			// 数据库是否持久连接(一般不必改)
$dbcharset="gbk";		// 数据库编码,gbk或latin1或utf8或big5
$temp=$dbname;
if($temp==""){		//不直接用dbname,因为安装时会把后面的也替换掉。
	echo "<a href=\"install/\">请先运行安装程序</a>";
	exit;
}
/**
 * 根据php168系统修改而来，好处在于更改数据库类型时只要更改这个类就可以了。
 * 实例化为 conn 对象。
 */
Class MYSQL_DB {
	var $connet_nums = 0;	//数据库当前页面连接次数
	var $IsConnet = 0;		//数据库是否已链接
	function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = '') {
		global $dbcharset;
		if($pconnect) {
			if(!@mysql_pconnect($dbhost, $dbuser, $dbpw)) {
				$this->Err('MYSQL 不能永久连接数据库,请确定数据库用户名,密码设置正确,并且服务器支持永久连接<br>');
				exit;
			}
		} else {
			if(!@mysql_connect($dbhost, $dbuser, $dbpw)) {
				$this->Err('MYSQL 连接数据库失败,请确定数据库用户名,密码设置正确<br>');
				exit;
			}
		}
		if(!@mysql_select_db($dbname)){
			$this->Err("MYSQL 连接成功,但当前使用的数据库 {$dbname} 不存在<br>");
			exit;
		}
		if($dbcharset){
			mysql_query("SET NAMES '$dbcharset'");
		}
		if( mysql_get_server_info() > '5.0' ){
			mysql_query("SET sql_mode=''");
		}
		$this->IsConnet=1;
	}

	function close() {
		$this->IsConnet=0;
		return mysql_close();
	}

	function query($SQL,$method='',$showerr='0') {
		if($this->IsConnet==0){
			global $dbhost, $dbuser, $dbpw, $dbname, $pconnect;
			$this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
		}

		//分析统计查询时间
		$speed_headtime=explode(' ',microtime());
		$speed_headtime=$speed_headtime[0]+$speed_headtime[1];

		if($method=='U_B' && function_exists('mysql_unbuffered_query')){
			$query = mysql_unbuffered_query($SQL);
		}else{
			$query = mysql_query($SQL);
		}

		//分析统计查询时间
		$speed_endtime=explode(' ',microtime());
		$totaltime=number_format((($speed_endtime[0]+$speed_endtime[1]-$speed_headtime)/1),6);
		$speed_totaltime="TIME $totaltime second(s)\t$SQL\r\n";
		if($totaltime>0.3){
			write_file(WEBROOT."/cache/MysqlTime.txt",$speed_totaltime,'a');
			//大于3M,自动删除
			if(filesize(WEBROOT."/cache/MysqlTime.txt")>1024*1024*3){
				unlink(WEBROOT."/cache/MysqlTime.txt");
			}
		}
		$this->connet_nums++;

		if (!$query&&$showerr=='1')  $this->Err("数据库连接出错:$SQL<br>");
		return $query;
	}

	function get_one($SQL){

		$query=$this->query($SQL,'U_B');

		$rs =& mysql_fetch_array($query, MYSQL_ASSOC);

		return $rs;
	}

	function update($SQL) {
		if($this->IsConnet==0){
			global $dbhost, $dbuser, $dbpw, $dbname, $pconnect;
			$this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
		}

		if(function_exists('mysql_unbuffered_query')){
			$query = mysql_unbuffered_query($SQL);
		}else{
			$query = mysql_query($SQL);
		}
		$this->connet_nums++;

		if (!$query)  $this->Err("数据库连接出错:$SQL<br>");
		return $query;
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}

	function num_rows($query) {
		$rows = mysql_num_rows($query);
		return $rows;
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		$id = mysql_insert_id();
		return $id;
	}

	function insert_file($file){
		global $dbcharset,$pre;
		$check=0;		//后来加的。
		$readfiles=read_file($file);
		$readfiles=str_replace("#pre_#",$pre,$readfiles);			//替换表的前辍。
		$readfiles=str_replace("#lang#",$dbcharset,$readfiles);		//替换表的字符集。
		$detail=explode("\n",$readfiles);
		$count=count($detail);
		for($j=0;$j<$count;$j++){
			$ck=substr($detail[$j],0,4);
			if( ereg("#",$ck)||ereg("--",$ck) ){		//去掉注释行。
				continue;
			}
			$array[]=$detail[$j];
		}
		$read=implode("\n",$array);			//合并数组
		$sql=str_replace("\r",'',$read);	//替换\r
		$detail=explode(";\n",$sql);		//分解字符串，标准：;\n也就是一条语句结束，分解后数组中不包含“;”。
		$count=count($detail);
		for($i=0;$i<$count;$i++){
			$sql=str_replace("\r",'',$detail[$i]);
			$sql=str_replace("\n",'',$sql);
			$sql=trim($sql);
			if($sql){
				$this->query($sql);
				$check++;
			}
		}
		return $check;
	}
	function Err($msg='') {
		$sqlerror = mysql_error();
		$sqlerrno = mysql_errno();
		if(strstr($sqlerror,"Can't open file: '")){
			preg_match("/Can't open file: '([^']+)\.MYI'/is",$sqlerror,$array);
			echo "系统已自动修复数据库,请再次刷新网页,如果修复不成功,请重启数据库再修复<br>";
			$this->query("REPAIR TABLE `$array[1]`");
		}
		if(strstr($sqlerror,"should be repaired")){
			$sqlerror=str_replace("\\","/",$sqlerror);
			preg_match("/([^\/]+)' is marked as/is",$sqlerror,$array);
			echo "系统已自动修复数据库,请再次刷新网页,如果修复不成功,请重启数据库再修复<br>";
			$this->query("REPAIR TABLE `$array[1]`");
		}
		echo "$msg<br>$sqlerror<br>$sqlerrno";
		//die("");
	}
}

$conn=new MYSQL_DB;
?>