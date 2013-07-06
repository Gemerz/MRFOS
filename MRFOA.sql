-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 06 日 12:19
-- 服务器版本: 5.5.31-percona-sure1-log
-- PHP 版本: 5.3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `frdsports_MRFOA`
--

-- --------------------------------------------------------

--
-- 表的结构 `gs_admin`
--

CREATE TABLE IF NOT EXISTS `gs_admin` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` tinyint(5) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `last_time` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `gs_admin`
--

INSERT INTO `gs_admin` (`id`, `username`, `password`, `role_id`, `status`, `last_time`) VALUES
(1, 'admin', 'ce17f6c5ea002380228bd24ab41141ce', 1, 1, 1372663731),
(2, 'paul', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, 1372664339);

-- --------------------------------------------------------

--
-- 表的结构 `gs_goods`
--

CREATE TABLE IF NOT EXISTS `gs_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `MRF` varchar(250) NOT NULL,
  `supply` varchar(255) NOT NULL,
  `name` varchar(250) NOT NULL,
  `ename` varchar(250) NOT NULL,
  `price` varchar(200) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `cate_id` tinyint(4) NOT NULL,
  `code` varchar(250) NOT NULL,
  `place` varchar(25) NOT NULL,
  `size` varchar(100) NOT NULL,
  `add_time` datetime NOT NULL,
  `storage_id` tinyint(4) NOT NULL,
  `count` int(40) NOT NULL,
  `status` int(10) NOT NULL,
  `request_by` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `gs_goods`
--

INSERT INTO `gs_goods` (`id`, `MRF`, `supply`, `name`, `ename`, `price`, `unit`, `cate_id`, `code`, `place`, `size`, `add_time`, `storage_id`, `count`, `status`, `request_by`, `remark`) VALUES
(5, '1206', '广州市供应有限公司', '小小', 'xiaoxiao', '3773.6', '21.2', 1, 'TX20139', '中国', '2012', '2013-04-19 00:00:00', 2, 178, 1, 'colin', ''),
(6, '16029', '广州国喂公司', '车身面', '1222', '1138.8', '5.2', 2, 'dd', '222', '22', '2013-04-01 00:00:00', 2, 219, 0, 'Fenng', ''),
(7, '12345', '珠海小一公司', '小件', '22', '12828.2', '583.1', 1, '22', '22', '22', '2013-04-01 00:00:00', 1, 22, 0, '小珠', ''),
(8, '1203', '广州一公司', '车头前头', '在', '3488.4', '34.2', 6, 'ddd', 'ddd', 'dd', '2013-06-06 00:00:00', 1, 102, 0, 'Gemer', ''),
(9, '12', 'gem', 'kddk', 'dd', '242198.97', '21.39', 1, '22', '22', '11', '2013-06-05 00:00:00', 1, 11323, 0, 'IVY', '');

-- --------------------------------------------------------

--
-- 表的结构 `gs_goods_cate`
--

CREATE TABLE IF NOT EXISTS `gs_goods_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `spid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ename` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `gs_goods_cate`
--

INSERT INTO `gs_goods_cate` (`id`, `pid`, `spid`, `name`, `ename`, `status`) VALUES
(6, 2, '2|', '车底', '', 1),
(2, 0, '0', '车身', '', 1),
(3, 0, '0', '电子产品', '', 1),
(4, 1, '1|', '车架', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `gs_goods_img`
--

CREATE TABLE IF NOT EXISTS `gs_goods_img` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) NOT NULL,
  `url` varchar(150) CHARACTER SET utf8 NOT NULL,
  `order` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `gs_goods_img`
--

INSERT INTO `gs_goods_img` (`id`, `cate_id`, `url`, `order`, `add_time`, `status`) VALUES
(1, 5, '1304/19/5170b6057c73a.JPG', 1, 0, 0),
(17, 5, '1304/19/5170c0551b149.JPG', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `gs_role`
--

CREATE TABLE IF NOT EXISTS `gs_role` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `gs_role`
--

INSERT INTO `gs_role` (`id`, `name`) VALUES
(1, '管理员'),
(2, '查看员');

-- --------------------------------------------------------

--
-- 表的结构 `gs_storage`
--

CREATE TABLE IF NOT EXISTS `gs_storage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pid` int(10) NOT NULL,
  `spid` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `gs_storage`
--

INSERT INTO `gs_storage` (`id`, `name`, `pid`, `spid`, `status`) VALUES
(1, 'FRD仓库', 0, 0, 1),
(2, '福特仓库', 0, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
