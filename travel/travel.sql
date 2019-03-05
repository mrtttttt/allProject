-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2018 年 04 月 21 日 10:13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dBKwBymBQkoIcLLQYYDH`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `aname` varchar(50) DEFAULT NULL,
  `apass` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `apass`) VALUES
(1, '张三', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'tt', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- 表的结构 `con`
--

CREATE TABLE IF NOT EXISTS `con` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `money` varchar(20) DEFAULT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pid` varchar(10) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `start` varchar(50) DEFAULT NULL,
  `end` varchar(50) DEFAULT NULL,
  `startTime` varchar(20) DEFAULT NULL,
  `endTime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `con`
--

INSERT INTO `con` (`cid`, `title`, `content`, `money`, `cdate`, `pid`, `img`, `start`, `end`, `startTime`, `endTime`) VALUES
(10, '北纬十八度的夏天', '纽约著名时代广场', '8800.00', '2017-12-06 10:55:28', '3', NULL, '北京', '纽约', '3：30', '8：30'),
(11, '巴厘岛来自南半球的问候', '巴厘岛来自南半球的问候', '666.00', '2017-12-07 02:33:56', '3', NULL, '山西', '巴厘岛', '5.00', '10.00'),
(12, '中国万里长城', '绵延万里，气势磅礴', '99.00', '2017-12-07 06:40:39', '2', NULL, '太原', '北京', '8.30', '12.00');

-- --------------------------------------------------------

--
-- 表的结构 `love`
--

CREATE TABLE IF NOT EXISTS `love` (
  `lid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `love`
--

INSERT INTO `love` (`lid`, `cid`, `uid`) VALUES
(1, 10, 1),
(2, 10, 1),
(3, 10, 1),
(4, 11, 1),
(5, 10, 1),
(6, 10, 1),
(7, 10, 1),
(8, 10, 1),
(9, 11, 1),
(10, 12, 1),
(11, 10, 1),
(12, 11, 1),
(13, 12, 1),
(14, 12, 1),
(15, 12, 1),
(16, 12, 1),
(17, 10, 1),
(18, 11, 1),
(19, 12, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pinglun`
--

CREATE TABLE IF NOT EXISTS `pinglun` (
  `pingid` int(10) NOT NULL AUTO_INCREMENT,
  `pcon` varchar(1000) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `cid` int(10) DEFAULT NULL,
  PRIMARY KEY (`pingid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `position`
--

INSERT INTO `position` (`pid`, `pname`) VALUES
(2, '轮播'),
(3, '推荐');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) DEFAULT NULL,
  `upass` varchar(32) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `uname`, `upass`, `photo`, `email`) VALUES
(1, 'tt', 'e10adc3949ba59abbe56e057f20f883e', 'blob:http://localhost:8080/064870d1-6e31-4c7c-8f4d-26084e8d48d8', '123@qq.com'),
(13, 'aaaaaa', '3dbe00a167653a1aaee01d93e77e730e', NULL, 'aaaaaa@aaaa'),
(12, 'lql', 'e10adc3949ba59abbe56e057f20f883e', '/upload/1512578642568ty.jpg', NULL),
(14, 'zhangsan', 'e10adc3949ba59abbe56e057f20f883e', NULL, '854913036@qq.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
