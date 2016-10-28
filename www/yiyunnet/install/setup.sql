DROP TABLE IF EXISTS `#pre_#adminlogo`;
CREATE TABLE `#pre_#adminlogo` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `uid` mediumint(7) NOT NULL,
  `uname` varchar(16) NOT NULL,
  `logintime` int(10) NOT NULL,
  `lasttime` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `adminlevel` tinyint(1) NOT NULL,
  `remark` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=#lang# ;




DROP TABLE IF EXISTS `#pre_#friendlink`;
CREATE TABLE `#pre_#friendlink` (
  `id` mediumint(5) NOT NULL auto_increment,
  `fid` int(7) NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `url` varchar(150) NOT NULL default '',
  `logo` varchar(150) NOT NULL default '',
  `descrip` varchar(255) NOT NULL default '',
  `list` int(10) NOT NULL default '0',
  `ifhide` tinyint(1) NOT NULL default '0',
  `iswordlink` tinyint(1) NOT NULL default '0',
  `hits` tinyint(7) NOT NULL default '0',
  `posttime` int(10) NOT NULL default '0',
  `uid` int(7) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `yz` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;




DROP TABLE IF EXISTS `#pre_#guestbook`;
CREATE TABLE `#pre_#guestbook` (
  `id` int(7) NOT NULL auto_increment,
  `fid` mediumint(7) NOT NULL default '0',
  `ico` tinyint(2) NOT NULL default '0',
  `email` varchar(50) NOT NULL default '',
  `oicq` varchar(11) default NULL,
  `weburl` varchar(150) NOT NULL default '',
  `blogurl` varchar(150) NOT NULL default '',
  `uid` int(7) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `content` text NOT NULL,
  `yz` tinyint(1) NOT NULL default '0',
  `posttime` int(10) NOT NULL default '0',
  `list` int(10) NOT NULL default '0',
  `reply` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;




DROP TABLE IF EXISTS `#pre_#userdata`;
CREATE TABLE `#pre_#userdata` (
  `uid` mediumint(7) unsigned NOT NULL auto_increment,
  `uname` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `adminlevel` tinyint(1) NOT NULL default '0' COMMENT '管理员级别，数值越大权限越大',
  `question` varchar(32) NOT NULL default '',
  `answer` varchar(32) NOT NULL,
  `groupid` smallint(4) NOT NULL default '0',
  `yz` tinyint(1) NOT NULL default '0',
  `money` mediumint(7) NOT NULL default '0',
  `totalspace` int(10) NOT NULL default '0',
  `usespace` int(10) NOT NULL default '0',
  `logintime` int(10) NOT NULL,
  `lasttime` int(10) NOT NULL default '0',
  `lastip` varchar(15) NOT NULL default '',
  `regdate` int(10) NOT NULL default '0',
  `regip` varchar(15) NOT NULL default '',
  `sex` tinyint(1) NOT NULL default '0',
  `birthday` int(10) NOT NULL,
  `seekpasswords` tinyint(1) NOT NULL default '0',
  `oicq` varchar(11) NOT NULL default '',
  `homepage` varchar(150) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `province` varchar(20) NOT NULL default '',
  `city` varchar(20) NOT NULL default '',
  `postalcode` varchar(6) NOT NULL,
  `address` varchar(255) NOT NULL default '',
  `mobphone` varchar(12) NOT NULL default '',
  `telephone` varchar(25) NOT NULL default '',
  `truename` varchar(20) NOT NULL default '',
  `moneycard` mediumint(7) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `province` (`province`,`city`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;




DROP TABLE IF EXISTS `#pre_#userlogo`;
CREATE TABLE `#pre_#userlogo` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `uid` mediumint(7) NOT NULL,
  `uname` varchar(16) NOT NULL,
  `logintime` int(10) NOT NULL,
  `lasttime` int(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `adminlevel` tinyint(1) NOT NULL,
  `remark` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=#lang# ;




DROP TABLE IF EXISTS `#pre_#article`;
CREATE TABLE `#pre_#article` (
  `aid` mediumint(7) unsigned NOT NULL auto_increment,
  `title` varchar(150) NOT NULL default '',
  `smalltitle` varchar(100) NOT NULL default '',
  `fid` mediumint(7) unsigned NOT NULL default '0',
  `fname` varchar(50) NOT NULL default '',
  `info` tinyint(2) NOT NULL default '0',
  `hits` mediumint(7) NOT NULL default '0',
  `vouch` tinyint(1) NOT NULL default '0' COMMENT '推荐',
  `openblank` tinyint(1) NOT NULL default '0',
  `pages` smallint(4) NOT NULL default '0',
  `comments` mediumint(7) NOT NULL default '0',
  `posttime` int(10) NOT NULL default '0',
  `passtime` int(10) NOT NULL default '0',
  `uid` mediumint(7) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `author` varchar(30) NOT NULL default '',
  `copyfrom` varchar(100) NOT NULL default '',
  `copyfromurl` varchar(150) NOT NULL default '',
  `titlecolor` varchar(15) NOT NULL default '',
  `fonttype` tinyint(1) NOT NULL default '0',
  `titleicon` smallint(3) NOT NULL default '0',
  `titlepic` varchar(150) NOT NULL default '0',
  `picurl` text NOT NULL,
  `ispic` tinyint(1) NOT NULL default '0',
  `yz` tinyint(1) NOT NULL default '0',
  `yzer` varchar(30) NOT NULL default '',
  `yztime` int(10) NOT NULL default '0',
  `levels` tinyint(2) NOT NULL default '0',
  `levelstime` int(10) NOT NULL default '0',
  `keywords` varchar(100) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `editer` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`aid`),
  KEY `fid` (`fid`),
  KEY `hits` (`hits`,`yz`,`fid`,`ispic`),
  KEY `lastview` (`yz`,`fid`,`ispic`),
  KEY `list` (`passtime`,`yz`,`fid`,`ispic`),
  KEY `ispic` (`ispic`),
  KEY `uid` (`uid`),
  KEY `levels` (`levels`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;

INSERT INTO `#pre_#article` VALUES (347, '宜云网站管理系统', '', 41, '', 0, 18, 1, 0, 0, 0, 1228439908, 0, 1, '', '', '', '', '', 0, 0, '/uploadfile/41/081205091609_1.jpg', '/uploadfile/41/081205091609_1.jpg|', 0, 1, '', 0, 0, 0, '', '', '');
INSERT INTO `#pre_#article` VALUES (348, '宜云网站管理帮助文档', '', 41, '', 0, 3, 0, 0, 0, 0, 1228441540, 0, 1, '', '', '', '', '', 0, 0, '/uploadfile/41/081205095254_1.gif', '/uploadfile/41/081205095254_1.gif|', 0, 1, '', 0, 0, 0, '', '', '');




DROP TABLE IF EXISTS `#pre_#reply`;
CREATE TABLE `#pre_#reply` (
  `rid` mediumint(7) NOT NULL auto_increment,
  `subhead` varchar(150) NOT NULL default '',
  `postdate` int(10) NOT NULL default '0',
  `aid` mediumint(7) NOT NULL default '0',
  `fid` mediumint(7) NOT NULL default '0',
  `uid` mediumint(7) NOT NULL default '0',
  `topic` tinyint(1) NOT NULL default '0',
  `ishtml` tinyint(1) NOT NULL default '1',
  `property` text NOT NULL,
  `content` mediumtext NOT NULL,
  `orderid` mediumint(7) NOT NULL default '0',
  PRIMARY KEY  (`rid`),
  KEY `aid` (`aid`),
  KEY `topic` (`topic`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang#;


INSERT INTO `#pre_#reply` VALUES (401, '', 0, 347, 41, 1, 1, 1, '类别 大小 性质 语言 运行环境', '网站系统 0.8M 开源软件 中文 PHP5&nbsp;　　宜云网络网站管理系统是一个简单，实用的网站管理系统，全站采用DIV+CSS布局，完全符合WEB2.0标准，是您建站的好帮手。<br /> 　　本站特点： <ul> <li>操作简单：所有的操作都已图形化，管理网站就和管理自己电脑里的WORD文件一样</li> <li>功能齐全：对于常用网站功能应有尽有，</li> <li>丰富的帮助档：在后台管理中只要点击随处可见的问号，就可显示相应的帮助信息。</li> <li>强大的搜索功能：在浩大的数据中，客户埋怨找不到称心的资料，而网站经营者又埋怨自己的信息无法向自己的客户很好的提供。而本站的搜索功能和其它网站有很大的不同，功能也非常强大，可以自动调整搜索结果提供给用户。</li> <li>免费一年技术支持。</li> </ul>', 0);
INSERT INTO `#pre_#reply` VALUES (402, '', 0, 348, 41, 1, 1, 1, '类别 大小 性质 语言 运行环境', '教程 1M 免费 中文 windowsxp&nbsp;<p>宜云网络管理后台操作说明书，目前还在制作中，相关信息请暂时参照产品与服务中的一些文章，谢谢！</p>', 0);




DROP TABLE IF EXISTS `#pre_#indexconfig`;
CREATE TABLE `#pre_#indexconfig` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `keytags` varchar(32) NOT NULL,
  `listmod` tinyint(3) NOT NULL,
  `list` tinyint(3) NOT NULL,
  `fids` varchar(32) NOT NULL,
  `pic` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `keytags` (`keytags`,`list`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#indexconfig` VALUES (31, 'frontnews', 0, 1, '', '', '', '宜云网络网站管理系统介绍', '　　宜云网络网站管理系统是一个简单，实用的网站管理系统，全站采用DIV+CSS布局，完全符合WEB2.0标准，是您建站的好帮手。<br /> 　　本站特点： <ul> <li>操作简单：所有的操作都已图形化，管理网站就和管理自己电脑里的WORD文件一样</li> <li>功能齐全：对于常用网站功能应有尽有，</li> <li>丰富的帮助档：在后台管理中只要点击随处可见的问号，就可显示相应的帮助信息。</li> <li>强大的搜索功能：在浩大的数据中，客户埋怨找不到称心的资料，而网站经营者又埋怨自己的信息无法向自己的客户很好的提供。而本站的搜索功能和其它网站有很大的不同，功能也非常强大，可以自动调整搜索结果提供给用户。</li> </ul>');
INSERT INTO `#pre_#indexconfig` VALUES (32, 'frontpic', 0, 1, '', '/uploadfile/0/081202154811_1.jpg', 'list.php?fid=20', '', '');
INSERT INTO `#pre_#indexconfig` VALUES (24, 'spry', 3, 127, '41', '', '', '我们的产品', '<p>我们的产品，内容还在更新中</p>');
INSERT INTO `#pre_#indexconfig` VALUES (26, 'range', 2, 10, '', '', '', '请添加', '<p>当你没有指定内容时，也是显示这些手工输入的内容。<br /> 当然，如果你没有指定内容，也没有编辑这些后备的内容时，当显示空内容。</p>');
INSERT INTO `#pre_#indexconfig` VALUES (27, 'range', 2, 11, '', '', '', '请到添加', '<p>这是预置的内容，当指定的内容为空时，将显示这些手工编辑的内容。</p>');
INSERT INTO `#pre_#indexconfig` VALUES (28, 'range', 0, 7, '', '', '', '内容块标题', '&nbsp;&nbsp;&nbsp;&nbsp;');
INSERT INTO `#pre_#indexconfig` VALUES (29, 'range', 2, 6, '', '', '', '这是标题', '这是手工输入的代码');
INSERT INTO `#pre_#indexconfig` VALUES (30, 'spry', 1, 122, '42', '', '', '操作说明', '<div style="padding-top: 7px">这里的标签也是在后台由<strong>管理员添加</strong>的，内容的显示方式有5种：</div> <div style="padding-top: 7px">　　1.普通列表的方式显示，将显示2列，每列6行，共12条信息。</div> <div style="padding-top: 7px">　　2.图片方式显示，将并排显示5幅图片，图片下方是标题。</div> <div style="padding-top: 7px">　　3.普通列表加图片显示，在显示2列普通列表的情况下，将显示一幅图片。图片显示位置和风格有关。</div> <div style="padding-top: 7px">　　4.产品方式显示，这种方式首先在内容中查找产品，并以图片加产品属性的方式显示。</div> <div style="padding-top: 7px">　　5.手工输入显示的内容，不指定显示栏目，将显示预置的内容，就如本文。</div>');




DROP TABLE IF EXISTS `#pre_#menu`;
CREATE TABLE `#pre_#menu` (
  `id` mediumint(5) NOT NULL auto_increment,
  `fup` mediumint(5) NOT NULL default '0',
  `name` varchar(80) NOT NULL default '',
  `linkurl` varchar(150) NOT NULL default '',
  `color` varchar(15) NOT NULL default '',
  `target` tinyint(1) NOT NULL default '0',
  `moduleid` tinyint(2) NOT NULL default '0',
  `type` tinyint(2) NOT NULL default '0',
  `hide` tinyint(1) NOT NULL default '0',
  `list` smallint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#menu` VALUES (1, 0, '网站首页', 'index.php', '', 0, 0, 0, 0, 30);
INSERT INTO `#pre_#menu` VALUES (2, 0, '试验栏目', 'list.php?fid=42', '', 0, 0, 0, 0, 5);
INSERT INTO `#pre_#menu` VALUES (3, 0, '内容搜索', 'search.php', '', 0, 0, 0, 0, 1);
INSERT INTO `#pre_#menu` VALUES (4, 0, '访客留言', 'guestbook.php', '', 0, 0, 0, 0, 3);
INSERT INTO `#pre_#menu` VALUES (5, 0, '产品与服务', 'list.php?fid=41', '', 0, 0, 0, 0, 6);
INSERT INTO `#pre_#menu` VALUES (6, 0, '我的分类', 'list.php?fid=43', '', 0, 0, 0, 0, 5);




DROP TABLE IF EXISTS `#pre_#placard`;
CREATE TABLE `#pre_#placard` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `title` (`title`,`posttime`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#placard` VALUES (1, '更多风格模版正在制作中', '本系统完全采用DIV+CSS布局，完全符合WEB 2.0的特点，为了适应不同用户的要求，更多的风格正在开发中。添加风格只要添加一个文件就可完成。', 1228393545);
INSERT INTO `#pre_#placard` VALUES (2, '宜云网络网站管理系统发布了', '经过不断的完善，宜云网站管理系统1.0版终于发布了，本系统能强大，操作简单，易于上手的，可以适应多种环境的网站建设。', 1228393316);




DROP TABLE IF EXISTS `#pre_#sort`;
CREATE TABLE `#pre_#sort` (
  `fid` mediumint(7) unsigned NOT NULL auto_increment,
  `fup` mediumint(7) unsigned NOT NULL default '0',
  `fmid` mediumint(5) NOT NULL default '0',
  `name` varchar(50) NOT NULL,
  `class` smallint(4) NOT NULL default '0',
  `classmod` mediumint(7) NOT NULL,
  `disable` tinyint(1) NOT NULL default '0' COMMENT '禁用该栏目',
  `hitsofhot` int(11) NOT NULL default '10' COMMENT '热门最少点击数',
  `listsortlen` tinyint(1) NOT NULL default '10' COMMENT '列表页显示栏目名长度',
  `listtitlechars` tinyint(1) NOT NULL default '0' COMMENT '列表页显示标题长度',
  `listcontentchars` int(4) NOT NULL default '0' COMMENT '列表页显示文章内容长度',
  `fatherlist` tinyint(1) NOT NULL default '1' COMMENT '允许父栏目显示该栏目列表',
  `listsons` tinyint(1) NOT NULL default '1' COMMENT '列表是否显示子栏目内容',
  `dateformat` char(32) NOT NULL default '年-月-日 时:分' COMMENT '列表日期时间格式',
  `type` tinyint(1) NOT NULL default '0',
  `admin` varchar(100) NOT NULL default '',
  `listrows` int(2) NOT NULL default '0',
  `indexlist` tinyint(1) NOT NULL default '0',
  `listorder` tinyint(2) NOT NULL default '0',
  `logo` varchar(150) NOT NULL default '',
  `descrip` text NOT NULL,
  `keyword` text NOT NULL,
  `list_html` varchar(255) NOT NULL default '',
  `bencandy_html` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`fid`),
  KEY `fup` (`fup`),
  KEY `fmid` (`fmid`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#sort` VALUES (42, 0, 0, '试验栏目', 0, -1, 0, 10, 10, 0, 0, 1, 1, '年-月-日 时:分', 0, '', 0, 0, 0, '', '', '', '', '');
INSERT INTO `#pre_#sort` VALUES (43, 0, 0, '我的分类', 0, -1, 0, 10, 10, 0, 0, 1, 1, '年-月-日 时:分', 0, '', 0, 0, 0, '', '', '', '', '');
INSERT INTO `#pre_#sort` VALUES (41, 0, 0, '产品与服务', 0, 10, 0, 10, 10, 0, 0, 1, 1, '年-月-日 时:分', 0, '', 0, 0, 0, '', '', '', '', '');




DROP TABLE IF EXISTS `#pre_#stencil`;
CREATE TABLE `#pre_#stencil` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `property` text NOT NULL,
  `posttime` int(7) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#stencil` VALUES (9, '手机', 1, '品牌 颜色 规格 像素 价格 内存 MP3 MP4 待机时间 保修', 1227306531);
INSERT INTO `#pre_#stencil` VALUES (10, '软件', 0, '类别 大小 性质 语言 运行环境', 1227306675);




DROP TABLE IF EXISTS `#pre_#vote`;
CREATE TABLE `#pre_#vote` (
  `id` int(7) NOT NULL auto_increment,
  `cid` int(7) NOT NULL default '0',
  `voteoption` varchar(50) NOT NULL,
  `votenum` int(7) NOT NULL default '0',
  `list` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#vote` VALUES (1, 1, '强大的搜索功能', 0, 0);
INSERT INTO `#pre_#vote` VALUES (2, 1, '操作灵活', 0, 0);
INSERT INTO `#pre_#vote` VALUES (3, 1, '没什么特别的，和其它网站一样', 0, 0);
INSERT INTO `#pre_#vote` VALUES (4, 1, '不好说', 0, 0);




DROP TABLE IF EXISTS `#pre_#vote_config`;
CREATE TABLE `#pre_#vote_config` (
  `cid` int(7) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `about` text NOT NULL,
  `type` tinyint(4) NOT NULL default '0',
  `limittime` int(10) NOT NULL default '0',
  `limitip` tinyint(1) NOT NULL default '0',
  `ip` text NOT NULL,
  `posttime` int(10) NOT NULL default '0',
  `user` text NOT NULL,
  `begintime` int(10) NOT NULL default '0',
  `endtime` int(10) NOT NULL default '0',
  `enableguestvote` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#vote_config` VALUES (1, '宜云网络系统投票', '您觉得本系统最大的特点是什么', 1, 5, 0, '', 1228392725, '', 0, 0, 1);
