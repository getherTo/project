-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-26 11:56:59
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_cms3`
--

-- --------------------------------------------------------

--
-- 表的结构 `zhuanpan_prizes`
--

CREATE TABLE IF NOT EXISTS `zhuanpan_prizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `amount` int(11) NOT NULL DEFAULT '0',
  `zhuanpan_index` int(11) NOT NULL DEFAULT '0',
  `img` varchar(200) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `zhuanpan_prizes`
--

INSERT INTO `zhuanpan_prizes` (`id`, `name`, `amount`, `zhuanpan_index`, `img`, `created_at`) VALUES
(2, '奖品1', 100000, 1, '/my_cms3/upload/phpC451.jpg', '2016-09-26 11:11:48'),
(3, '奖品2', 10, 2, '/my_cms3/upload/php76A.jpg', '2016-09-26 11:12:05'),
(4, '奖品3', 5, 3, '/my_cms3/upload/php615D.jpg', '2016-09-26 11:12:28'),
(5, '奖品4', 5, 4, '/my_cms3/upload/php9D45.jpg', '2016-09-26 11:12:44'),
(6, '奖品5', 10, 5, '/my_cms3/upload/phpCAEA.jpg', '2016-09-26 11:12:55');

-- --------------------------------------------------------

--
-- 表的结构 `zhuanpan_users`
--

CREATE TABLE IF NOT EXISTS `zhuanpan_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(100) NOT NULL DEFAULT '',
  `prize_id` int(11) NOT NULL DEFAULT '0',
  `prize_name` varchar(100) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `zhuanpan_users`
--

INSERT INTO `zhuanpan_users` (`id`, `user_id`, `user_name`, `prize_id`, `prize_name`, `created_at`) VALUES
(1, 1, '测试1', 1, '测试奖品', '2016-09-14 03:03:27'),
(2, 0, '访客5420', 0, '2', '2016-09-26 11:53:30'),
(3, 0, '访客8180', 2, '奖品1', '2016-09-26 11:54:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
