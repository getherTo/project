CREATE TABLE IF NOT EXISTS `pre_forum_order` (
`orderid` char(32) NOT NULL COMMENT '订单id',
`status` char(3) NOT NULL COMMENT '状态',
`buyer` char(50) NOT NULL COMMENT '购买者姓名',
`admin` char(15) NOT NULL COMMENT '补单管理员姓名',
`uid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '购买者id',
`amount` int(10) NOT NULL DEFAULT '0' COMMENT '数量',
`price` float(7,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
`submitdate` varchar(20) NOT NULL COMMENT '提交日期',
`confirmdate` varchar(20) NOT NULL COMMENT '确认日期',
`email` char(40) NOT NULL COMMENT '购买时的email',
`ip` char(15) NOT NULL COMMENT '购买时的IP'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pre_forum_order`
--

INSERT INTO `pre_forum_order` (`orderid`, `status`, `buyer`, `admin`, `uid`, `amount`, `price`, `submitdate`, `confirmdate`, `email`, `ip`) VALUES
('12186', '已支付', '王一宝', '黄一舟', 11, 8, 180.00, '2016-08-15 12:52:12', '2016-08-31 15:24:21', '1214554@sohou.com', '192.168.1.151'),
('10186', '正常', '黄二宝', '黄二舟', 18, 4, 120.00, '2016-07-31 02:52:12', '2016-08-01 15:24:21', '183554@sohou.com', '192.168.1.111'),
('15186', '已取消', '王一宝', '黄舟', 2, 4, 280.00, '2016-05-31 11:52:12', '2016-06-31 15:24:21', '953554@sohou.com', '192.168.1.161'),
('10986', '已支付', '张三宝', '黄舟舟', 71, 5, 110.00, '2016-05-31 09:52:12', '2016-05-01 15:28:21', '243554@sohou.com', '192.168.1.211'),
('10136', '未支付', '吴三宝', '周舟', 61, 15, 50.00, '2016-04-08 18:52:12', '2016-04-31 05:24:21', '123854@sohou.com', '192.168.1.171'),
('10111', '已支付', '余宝', '黄丹', 86, 11, 120.00, '2016-08-10 11:52:12', '2016-08-31 18:24:21', '1254@sohou.com', '192.168.1.158'),
('21186', '已支付', '王五宝', '吴延祥', 54, 23, 111.00, '2016-08-15 13:52:12', '2016-08-31 09:24:21', '562554@sohou.com', '192.168.1.211'),
('10154', '已支付', '花宝', '张飞', 19, 10, 562.00, '2016-07-21 16:52:12', '2016-08-31 15:24:21', '625554@sohou.com', '192.168.1.125'),
('10146', '已支付', '赵飞', '张宇', 54, 14, 140.00, '2016-05-31 07:52:12', '2016-06-04 15:24:21', '1523554@sohou.com', '192.168.1.114'),
('15481', '已支付', '孙宝', '李飞', 15, 5, 124.00, '2016-04-31 12:52:12', '2016-05-31 15:24:21', '453554@sohou.com', '192.168.1.154');
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12800", "正常", "王宝宝", "黄舟" , 1001 , 5 , 120, "2016-01-31 16:00:00", "2016-08-31 16:00:00" , "1234@sohou.com", "192.168.1.111" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12801", "正常", "卜鸿朗", "黄舟" , 1002 , 15 , 120, "2016-02-31 16:00:00", "2016-08-31 16:00:00" , "2222@sohou.com", "192.168.1.112" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12802", "正常", "孟宁", "黄舟" , 1003 ,25 , 120, "2016-06-31 16:00:00", "2016-08-31 16:00:00" , "2221@sohou.com", "192.168.1.113" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12803", "正常", "邵力勤", "黄舟" , 1004 , 35 , 120, "2016-04-31 16:00:00", "2016-08-31 16:00:00" , "3331@sohou.com", "192.168.1.114" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12804", "正常", "蒋舒", "黄舟" , 1005 , 45 , 120, "2016-05-31 16:00:00", "2016-08-31 16:00:00" , "5551@sohou.com", "192.168.1.115" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12805", "正常", "张健柏", "黄舟" , 1006 , 55 , 120, "2016-06-31 16:00:00", "2016-08-31 16:00:00" , "5552@sohou.com", "192.168.1.116" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12806", "已取消", "朱文昊", "黄舟" , 1007 , 65 , 120, "2016-07-31 16:00:00", "2016-08-31 16:00:00" , "5553@sohou.com", "192.168.1.117" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12807", "已取消", "戚舒", "黄舟" , 1008 , 65 , 120, "2015-08-31 16:00:00", "2016-08-31 16:00:00" , "6662@sohou.com", "192.168.1.118" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12808", "已取消", "潘娟", "黄舟" , 1009 , 75 , 120, "2015-09-31 16:00:00", "2016-08-31 16:00:00" , "7771@sohou.com", "192.168.1.119" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12809", "已取消", "凤锦程", "黄舟" , 1010 , 85 , 120, "2015-10-31 16:00:00", "2016-08-31 16:00:00" , "7772@sohou.com", "192.168.1.120" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12810", "已取消", "薛淑", "黄舟" , 1011 , 95 , 120, "2015-11-31 16:00:00", "2016-08-31 16:00:00" , "8881@sohou.com", "192.168.1.121" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12811", "已取消", "许泽洋", "黄舟" , 1012 , 105 , 120, "2015-12-31 16:00:00", "2016-08-31 16:00:00" , "8882@sohou.com", "192.168.1.122" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12812", "已取消", "任纯", "黄舟" , 1013 , 115 , 120, "2015-08-31 16:00:00", "2016-08-31 16:00:00" , "8888@sohou.com", "192.168.1.123" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12813", "已退款", "廉羽", "黄舟" , 1014 , 135 , 120, "2015-08-01 16:00:00", "2016-08-31 16:00:00" , "5555@sohou.com", "192.168.1.124" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12814", "已退款", "余莊", "黄舟" , 1015 , 125 , 120, "2015-08-02 16:00:00", "2016-08-31 16:00:00" , "6666@sohou.com", "192.168.1.125" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12815", "已退款", "陈伟祺", "黄舟" , 1016 , 155 , 120, "2015-08-03 16:00:00", "2016-08-31 16:00:00" , "9999@sohou.com", "192.168.1.126" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "12816", "已退款", "金天磊", "黄舟" , 1017 , 165 , 120, "2015-08-05 16:00:00", "2016-08-31 16:00:00" , "6668@sohou.com", "192.168.1.127" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "15956", "正常", "王宝宝", "黄舟" , 10001 , 105 , 120, "2016-02-20 17:20:21", "2016-03-21 17:30:21" , "1234@sohou.com", "192.168.1.121" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "5956", "已取消", "张三", "丁骁" , 10002 , 10 , 150, "2016-03-21 17:19:21 ", "2016-04-22 19:30:21" , "125575654@sohou.com", "192.168.1.117" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10054486", "已退款", "王二麻", "时伟伟" , 10003 , 2 , 110, "2016-08-21 17:20:21", "2016-08-22 18:20:21" , "125754@sohou.com", "192.168.1.157" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "100455486", "已签收", "李狗蛋", "李建华" , 10004 , 16 , 190, "2016-08-30 19:20:21", "2016-08-31 22:20:21" , "125554@sohou.com", "192.168.1.241" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "100888556", "已丢失", "二宝", "樊瑞" , 10005 , 19 , 50, "2016-08-25 18:20:21", "2016-08-29 19:20:28" , "12854@sohou.com", "192.168.1.116" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "1005586", "已查找", "李四", "吴延祥" , 10006 , 120 , 15, "2016-08-14 20:20:21", "2016-08-16 22:55:26" , "125554@sohou.com", "192.168.1.201" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "1044086", "已交易", "二蛋", "周鹏飞" , 10007 , 14 , 10, "2016-08-01 15:20:21", "2016-08-02 23:20:21" , "1554@sohou.com", "192.168.1.189" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10898086", "已放弃", "孔国源", "邓科" , 10008 , 17 , 170, "2016-07-21 16:20:21", "2016-08-27 20:20:27" , "12544554@sohou.com", "192.168.1.231" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "1054086", "已不在", "平香", "严璧" , 10009 , 122 , 90, "2016-08-10 13:20:21", "2016-08-15 21:20:29" , "12575457@sohou.com", "192.168.1.251" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10545086", "已抛弃", "海贼王", "史丹" , 10010 , 112 , 56, "2016-08-12 19:30:21", "2016-08-14 22:20:23" , "12785554@sohou.com", "192.168.1.214" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10086", "正常", "王宝宝", "黄舟" , 30000 , 5 , 120, "2016-08-31 11:10:10", "2016-08-31 12:15:29" , "1234@sohou.com", "174.168.1.111" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21544", "已支付", "苗雨泽", "黄舟" , 30001 , 10 , 615, "2016-08-31 12:12:10", "2016-08-31 12:13:41" , "4648@sohou.com", "165.168.1.140" );
insert into pre_forum_order ( orderid,status,buyer,admin,uid,amount,price,submitdate,confirmdate,email,ip) values(  "21466", "已取消", "汤黎昕", "黄舟" , 30002 , 11 , 546, "2016-08-30 13:12:10", "2016-08-30 13:13:41" , "8975@sohou.com", "192.168.178.159" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21874", "已支付", "傅媛", "黄舟" , 30003 , 18 , 253, "2016-08-30 14:12:10", "2016-08-31 14:15:46" , "4789@sohou.com", "146.255.1.112" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21874", "完成", "何然", "黄舟" , 30004 , 9 , 415, "2016-08-30 08:12:10", "2016-08-30 09:15:46" , "4648@sohou.com", "199.168.147.147" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21874", "已退款", "茅濮存", "黄舟" , 30005 , 47 , 789, "2016-08-30 09:25:30", "2016-08-30 09:25:56" , "2866@sohou.com", "178.168.1.159" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21874", "已支付", "顾纨", "黄舟" , 30006 , 98 , 478, "2016-08-31 09:38:57", "2016-08-31 09:59:56" , "8888@sohou.com", "156.198.1.159" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21874", "已取消", "彭子轩", "黄舟" , 30007 , 17 , 555, "2016-08-31 15:39:48", "2016-08-31 15:25:22" , "7777@sohou.com", "158.198.255.111" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21874", "完成", "何芸", "黄舟" , 30008 , 19 , 333, "2016-08-31 16:09:03", "2016-08-31 16:10:46" , "1654@sohou.com", "126.3.169.1" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "21874", "正常", "常祺祥", "黄舟" , 30009 , 23 , 888, "2016-08-31 17:29:47", "2016-08-31 17:45:36" , "1654@sohou.com", "198.156.147.123" );
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10086", "已支付", "周杰伦", "黄舟" , 10001 , 1 , 120, "2016-08-30 14:00:00", "2016-08-31 15:00:00" , "1234@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10087", "已取消", "王丹丹", "李建华" , 100 , 2 , 151, "2016-08-30 16:00:00", "2016-08-31 03:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10088", "已退款", "刘德华", "时伟伟" , 4923 , 3 , 160, "2016-08-30 18:06:00", "2016-08-31 00:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10089", "已支付", "黄宝宝", "丁骁" , 1567 , 4 , 170, "2016-08-30 16:00:00", "2016-08-31 03:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10090", "正常", "王宝宝", "邓科" , 9877 , 5 , 180, "2016-08-30 12:00:00", "2016-08-31 14:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10091", "已取消", "郭富城", "周鹏飞" , 2147 , 11 , 200, "2016-08-29 16:00:00", "2016-08-30 01:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10092", "正常", "周星驰", "吴延祥" , 6005 , 12 , 210, "2016-08-26 16:00:00", "2016-08-27 03:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10093", "已支付", "周润发", "樊瑞" , 98 , 18 , 250, "2016-08-25 24:00:00", "2016-08-26 03:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10094", "已支付", "范冰冰", "宋丹丹" , 21 , 20 , 260, "2016-07-30 16:00:00", "2016-07-31 21:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10095", "已支付", "万家热线", "赵本山" , 354 , 22 , 270, "2016-06-30 16:00:00", "2016-07-31 03:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10096", "已退款", "新安人才网", "林心如" , 11 , 30 , 280, "2016-01-30 16:00:00", "2016-02-31 03:00:00" , "huangzhou@sohou.com", "192.168.1.11");
insert into pre_forum_order ( orderid, status, buyer, admin, uid, amount, price, submitdate, confirmdate, email,ip) values(  "10097", "已支付", "王思聪", "赵薇" , 7431 , 50 , 500, "2016-03-30 16:00:00", "2016-04-31 03:00:00" , "huangzhou@sohou.com", "192.168.1.11");