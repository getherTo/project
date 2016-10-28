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
  `adminlevel` tinyint(1) NOT NULL default '0' COMMENT '����Ա������ֵԽ��Ȩ��Խ��',
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
  `vouch` tinyint(1) NOT NULL default '0' COMMENT '�Ƽ�',
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

INSERT INTO `#pre_#article` VALUES (347, '������վ����ϵͳ', '', 41, '', 0, 18, 1, 0, 0, 0, 1228439908, 0, 1, '', '', '', '', '', 0, 0, '/uploadfile/41/081205091609_1.jpg', '/uploadfile/41/081205091609_1.jpg|', 0, 1, '', 0, 0, 0, '', '', '');
INSERT INTO `#pre_#article` VALUES (348, '������վ��������ĵ�', '', 41, '', 0, 3, 0, 0, 0, 0, 1228441540, 0, 1, '', '', '', '', '', 0, 0, '/uploadfile/41/081205095254_1.gif', '/uploadfile/41/081205095254_1.gif|', 0, 1, '', 0, 0, 0, '', '', '');




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


INSERT INTO `#pre_#reply` VALUES (401, '', 0, 347, 41, 1, 1, 1, '��� ��С ���� ���� ���л���', '��վϵͳ 0.8M ��Դ��� ���� PHP5&nbsp;��������������վ����ϵͳ��һ���򵥣�ʵ�õ���վ����ϵͳ��ȫվ����DIV+CSS���֣���ȫ����WEB2.0��׼��������վ�ĺð��֡�<br /> ������վ�ص㣺 <ul> <li>�����򵥣����еĲ�������ͼ�λ���������վ�ͺ͹����Լ��������WORD�ļ�һ��</li> <li>������ȫ�����ڳ�����վ����Ӧ�о��У�</li> <li>�ḻ�İ��������ں�̨������ֻҪ����洦�ɼ����ʺţ��Ϳ���ʾ��Ӧ�İ�����Ϣ��</li> <li>ǿ����������ܣ��ںƴ�������У��ͻ���Թ�Ҳ������ĵ����ϣ�����վ��Ӫ������Թ�Լ�����Ϣ�޷����Լ��Ŀͻ��ܺõ��ṩ������վ���������ܺ�������վ�кܴ�Ĳ�ͬ������Ҳ�ǳ�ǿ�󣬿����Զ�������������ṩ���û���</li> <li>���һ�꼼��֧�֡�</li> </ul>', 0);
INSERT INTO `#pre_#reply` VALUES (402, '', 0, 348, 41, 1, 1, 1, '��� ��С ���� ���� ���л���', '�̳� 1M ��� ���� windowsxp&nbsp;<p>������������̨����˵���飬Ŀǰ���������У������Ϣ����ʱ���ղ�Ʒ������е�һЩ���£�лл��</p>', 0);




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


INSERT INTO `#pre_#indexconfig` VALUES (31, 'frontnews', 0, 1, '', '', '', '����������վ����ϵͳ����', '��������������վ����ϵͳ��һ���򵥣�ʵ�õ���վ����ϵͳ��ȫվ����DIV+CSS���֣���ȫ����WEB2.0��׼��������վ�ĺð��֡�<br /> ������վ�ص㣺 <ul> <li>�����򵥣����еĲ�������ͼ�λ���������վ�ͺ͹����Լ��������WORD�ļ�һ��</li> <li>������ȫ�����ڳ�����վ����Ӧ�о��У�</li> <li>�ḻ�İ��������ں�̨������ֻҪ����洦�ɼ����ʺţ��Ϳ���ʾ��Ӧ�İ�����Ϣ��</li> <li>ǿ����������ܣ��ںƴ�������У��ͻ���Թ�Ҳ������ĵ����ϣ�����վ��Ӫ������Թ�Լ�����Ϣ�޷����Լ��Ŀͻ��ܺõ��ṩ������վ���������ܺ�������վ�кܴ�Ĳ�ͬ������Ҳ�ǳ�ǿ�󣬿����Զ�������������ṩ���û���</li> </ul>');
INSERT INTO `#pre_#indexconfig` VALUES (32, 'frontpic', 0, 1, '', '/uploadfile/0/081202154811_1.jpg', 'list.php?fid=20', '', '');
INSERT INTO `#pre_#indexconfig` VALUES (24, 'spry', 3, 127, '41', '', '', '���ǵĲ�Ʒ', '<p>���ǵĲ�Ʒ�����ݻ��ڸ�����</p>');
INSERT INTO `#pre_#indexconfig` VALUES (26, 'range', 2, 10, '', '', '', '�����', '<p>����û��ָ������ʱ��Ҳ����ʾ��Щ�ֹ���������ݡ�<br /> ��Ȼ�������û��ָ�����ݣ�Ҳû�б༭��Щ�󱸵�����ʱ������ʾ�����ݡ�</p>');
INSERT INTO `#pre_#indexconfig` VALUES (27, 'range', 2, 11, '', '', '', '�뵽���', '<p>����Ԥ�õ����ݣ���ָ��������Ϊ��ʱ������ʾ��Щ�ֹ��༭�����ݡ�</p>');
INSERT INTO `#pre_#indexconfig` VALUES (28, 'range', 0, 7, '', '', '', '���ݿ����', '&nbsp;&nbsp;&nbsp;&nbsp;');
INSERT INTO `#pre_#indexconfig` VALUES (29, 'range', 2, 6, '', '', '', '���Ǳ���', '�����ֹ�����Ĵ���');
INSERT INTO `#pre_#indexconfig` VALUES (30, 'spry', 1, 122, '42', '', '', '����˵��', '<div style="padding-top: 7px">����ı�ǩҲ���ں�̨��<strong>����Ա���</strong>�ģ����ݵ���ʾ��ʽ��5�֣�</div> <div style="padding-top: 7px">����1.��ͨ�б�ķ�ʽ��ʾ������ʾ2�У�ÿ��6�У���12����Ϣ��</div> <div style="padding-top: 7px">����2.ͼƬ��ʽ��ʾ����������ʾ5��ͼƬ��ͼƬ�·��Ǳ��⡣</div> <div style="padding-top: 7px">����3.��ͨ�б��ͼƬ��ʾ������ʾ2����ͨ�б������£�����ʾһ��ͼƬ��ͼƬ��ʾλ�úͷ���йء�</div> <div style="padding-top: 7px">����4.��Ʒ��ʽ��ʾ�����ַ�ʽ�����������в��Ҳ�Ʒ������ͼƬ�Ӳ�Ʒ���Եķ�ʽ��ʾ��</div> <div style="padding-top: 7px">����5.�ֹ�������ʾ�����ݣ���ָ����ʾ��Ŀ������ʾԤ�õ����ݣ����籾�ġ�</div>');




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


INSERT INTO `#pre_#menu` VALUES (1, 0, '��վ��ҳ', 'index.php', '', 0, 0, 0, 0, 30);
INSERT INTO `#pre_#menu` VALUES (2, 0, '������Ŀ', 'list.php?fid=42', '', 0, 0, 0, 0, 5);
INSERT INTO `#pre_#menu` VALUES (3, 0, '��������', 'search.php', '', 0, 0, 0, 0, 1);
INSERT INTO `#pre_#menu` VALUES (4, 0, '�ÿ�����', 'guestbook.php', '', 0, 0, 0, 0, 3);
INSERT INTO `#pre_#menu` VALUES (5, 0, '��Ʒ�����', 'list.php?fid=41', '', 0, 0, 0, 0, 6);
INSERT INTO `#pre_#menu` VALUES (6, 0, '�ҵķ���', 'list.php?fid=43', '', 0, 0, 0, 0, 5);




DROP TABLE IF EXISTS `#pre_#placard`;
CREATE TABLE `#pre_#placard` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `title` (`title`,`posttime`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#placard` VALUES (1, '������ģ������������', '��ϵͳ��ȫ����DIV+CSS���֣���ȫ����WEB 2.0���ص㣬Ϊ����Ӧ��ͬ�û���Ҫ�󣬸���ķ�����ڿ����С���ӷ��ֻҪ���һ���ļ��Ϳ���ɡ�', 1228393545);
INSERT INTO `#pre_#placard` VALUES (2, '����������վ����ϵͳ������', '�������ϵ����ƣ�������վ����ϵͳ1.0�����ڷ����ˣ���ϵͳ��ǿ�󣬲����򵥣��������ֵģ�������Ӧ���ֻ�������վ���衣', 1228393316);




DROP TABLE IF EXISTS `#pre_#sort`;
CREATE TABLE `#pre_#sort` (
  `fid` mediumint(7) unsigned NOT NULL auto_increment,
  `fup` mediumint(7) unsigned NOT NULL default '0',
  `fmid` mediumint(5) NOT NULL default '0',
  `name` varchar(50) NOT NULL,
  `class` smallint(4) NOT NULL default '0',
  `classmod` mediumint(7) NOT NULL,
  `disable` tinyint(1) NOT NULL default '0' COMMENT '���ø���Ŀ',
  `hitsofhot` int(11) NOT NULL default '10' COMMENT '�������ٵ����',
  `listsortlen` tinyint(1) NOT NULL default '10' COMMENT '�б�ҳ��ʾ��Ŀ������',
  `listtitlechars` tinyint(1) NOT NULL default '0' COMMENT '�б�ҳ��ʾ���ⳤ��',
  `listcontentchars` int(4) NOT NULL default '0' COMMENT '�б�ҳ��ʾ�������ݳ���',
  `fatherlist` tinyint(1) NOT NULL default '1' COMMENT '������Ŀ��ʾ����Ŀ�б�',
  `listsons` tinyint(1) NOT NULL default '1' COMMENT '�б��Ƿ���ʾ����Ŀ����',
  `dateformat` char(32) NOT NULL default '��-��-�� ʱ:��' COMMENT '�б�����ʱ���ʽ',
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


INSERT INTO `#pre_#sort` VALUES (42, 0, 0, '������Ŀ', 0, -1, 0, 10, 10, 0, 0, 1, 1, '��-��-�� ʱ:��', 0, '', 0, 0, 0, '', '', '', '', '');
INSERT INTO `#pre_#sort` VALUES (43, 0, 0, '�ҵķ���', 0, -1, 0, 10, 10, 0, 0, 1, 1, '��-��-�� ʱ:��', 0, '', 0, 0, 0, '', '', '', '', '');
INSERT INTO `#pre_#sort` VALUES (41, 0, 0, '��Ʒ�����', 0, 10, 0, 10, 10, 0, 0, 1, 1, '��-��-�� ʱ:��', 0, '', 0, 0, 0, '', '', '', '', '');




DROP TABLE IF EXISTS `#pre_#stencil`;
CREATE TABLE `#pre_#stencil` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `property` text NOT NULL,
  `posttime` int(7) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#stencil` VALUES (9, '�ֻ�', 1, 'Ʒ�� ��ɫ ��� ���� �۸� �ڴ� MP3 MP4 ����ʱ�� ����', 1227306531);
INSERT INTO `#pre_#stencil` VALUES (10, '���', 0, '��� ��С ���� ���� ���л���', 1227306675);




DROP TABLE IF EXISTS `#pre_#vote`;
CREATE TABLE `#pre_#vote` (
  `id` int(7) NOT NULL auto_increment,
  `cid` int(7) NOT NULL default '0',
  `voteoption` varchar(50) NOT NULL,
  `votenum` int(7) NOT NULL default '0',
  `list` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=#lang# ;


INSERT INTO `#pre_#vote` VALUES (1, 1, 'ǿ�����������', 0, 0);
INSERT INTO `#pre_#vote` VALUES (2, 1, '�������', 0, 0);
INSERT INTO `#pre_#vote` VALUES (3, 1, 'ûʲô�ر�ģ���������վһ��', 0, 0);
INSERT INTO `#pre_#vote` VALUES (4, 1, '����˵', 0, 0);




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


INSERT INTO `#pre_#vote_config` VALUES (1, '��������ϵͳͶƱ', '�����ñ�ϵͳ�����ص���ʲô', 1, 5, 0, '', 1228392725, '', 0, 0, 1);
