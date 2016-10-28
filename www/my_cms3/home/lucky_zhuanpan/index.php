<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>转盘幸运大抽奖</title>
<style>
* { margin: 0; padding: 0;}
body { font-family: "Microsoft Yahei"; background-color: #15734b;}
h1 { width: 900px; margin: 40px auto; font: 32px "Microsoft Yahei"; text-align: center; color: #fff;}
.dowebok { width: 894px; height: 563px; margin: 0 auto; background-image: url(images/s3_bg.png);}
.rotary { position: relative; float: left; width: 504px; height: 504px; margin: 20px 0 0 20px; background-image: url(images/g.png);}
.hand { position: absolute; left: 144px; top: 144px; width: 216px; height: 216px; cursor: pointer;}
.list { float: right; width: 300px; padding-top: 44px;}
.list strong { position: relative; left: -45px; display: block; height: 65px; line-height: 65px; font-size: 32px; color: #ffe63c;}
.list h4 { height: 45px; margin: 30px 0 10px; line-height: 45px; font-size: 24px; color: #fff;}
.list ul { line-height: 36px; list-style-type: none; font-size: 12px; color: #fff;}
.list span { display: inline-block; width: 94px;}
</style>
</head>


<?php

// 获取中奖用户信息
include_once "../common/db.php";

// 查询
$sql = "select * from zhuanpan_users order by id desc limit 10"; // 查询语句
$result = mysqli_query($link, $sql);
$arr_users = mysqli_fetch_all($result, MYSQL_ASSOC);




?>

<body>
<h1>转盘幸运大抽奖</h1>
<div class="dowebok">
	<div class="rotary">
		<img class="hand" src="images/z.png" alt="">
	</div>
	<div class="list">
		<strong>100%中奖</strong>
		<h4>中奖用户名单</h4>
		<ul id="prize_ul">

			<?php if( count ($arr_users)): ?>
            <?php foreach($arr_users as $val):?>
            <li>
                <span><?php echo $val['user_name']?></span> <span><?php echo $val['prize_name']?></span>
            </li>
            <?php endforeach;?>
            <?php endif;?>

		</ul>
	</div>
</div>

<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.rotate.min.js"></script>
<script>
$(function(){

	var $hand = $('.hand');
	$hand.click(function(){
		var data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        var prize_name;
        var user_name;

        // 这里data可以调用ajax来获得数据
        // php后台可以根据需要来控制用户中奖的奖品，并将相关数据记录到数据库中

        $.ajax({
         type: "GET", // 发送请求的方式 GET 或 POST
         url: "../ajax/lucky.php", // 请求的php地址
         async: false,
         dataType: "json",
         success: function (html) {  // html为请求的php文件返回的内容
             if( html == "error"){
                 alert( "服务器错误！");
             } else {
                 data =  parseInt(html.zhuanpan_idex); // 将字符串转为int型
                 prize_name = html.prize_name;
                 user_name = html.user_name;
             }
         }
         });

		switch(data){
			case 1:
				rotateFunc(1,16,prize_name, user_name);
				break;
			case 2:
				rotateFunc(2,47,prize_name, user_name);
				break;
			case 3:
				rotateFunc(3,76,prize_name, user_name);
				break;
			case 4:
				rotateFunc(4,106,prize_name, user_name);
				break;
			case 5:
				rotateFunc(5,135,prize_name, user_name);
				break;
			case 6:
				rotateFunc(6,164,prize_name, user_name);
				break;
			case 7:
				rotateFunc(7,193,prize_name, user_name);
				break;
			case 8:
				rotateFunc(8,223,prize_name, user_name);
				break;
			case 9:
				rotateFunc(9,252,prize_name, user_name);
				break;
			case 10:
				rotateFunc(10,284,prize_name, user_name);
				break;
			case 11:
				rotateFunc(11,314,prize_name, user_name);
				break;
			case 12:
				rotateFunc(12,345,prize_name, user_name);
				break;
		}
	});

	var rotateFunc = function(awards,angle,prize_name, user_name){
		$hand.stopRotate();
		$hand.rotate({
			angle: 0,
			duration: 5000,
			animateTo: angle + 1440,
			callback: function(){
				alert( "恭喜您抽中了： " + prize_name);
                $("#prize_ul").prepend("<li><span>" + user_name + "</span> <span>" + prize_name + "</span></li>")

			}
		});
	};
});
</script>







</body>
</html>