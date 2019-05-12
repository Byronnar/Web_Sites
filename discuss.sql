-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 12 月 14 日 08:22
-- 服务器版本: 5.1.32
-- PHP 版本: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `discuss`
--

-- --------------------------------------------------------

--
-- 表的结构 `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `access_type` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `access`
--

INSERT INTO `access` (`ID`, `access_type`) VALUES
(1, 'Level1'),
(2, 'Level2'),
(3, 'Level3'),
(4, 'UnEnrollment');

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_ID` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(256) NOT NULL,
  `content` varchar(256) NOT NULL,
  `pic_name` varchar(256) NOT NULL,
  `users_ID` int(11) NOT NULL,
  PRIMARY KEY (`post_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `post`
--

INSERT INTO `post` (`post_ID`, `post_name`, `content`, `pic_name`, `users_ID`) VALUES
(1, 'toby is trying this function', 'test', 'pic1.jpg', 1),
(2, 'UTAS', 'GOOD SCHOOL', './file/20171214080722u.jpg', 1),
(3, 'shanghai', 'Beautiful', './file/20171214081245310216.jpg', 1),
(9, '666', '666', './file/20171214082122295492.jpg', 1),
(10, '888', '888', './file/20171214082216TIM', 1);

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `reply_ID` int(11) NOT NULL AUTO_INCREMENT,
  `comments` text NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_ID` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL,
  `pic_name` varchar(256) NOT NULL,
  PRIMARY KEY (`reply_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `reply`
--

INSERT INTO `reply` (`reply_ID`, `comments`, `updated_time`, `users_ID`, `post_ID`, `pic_name`) VALUES
(1, 'I love you kxo205', '2015-11-05 15:09:08', 1, 1, 'pic2.jpg'),
(4, 'Beautiful', '2017-12-14 16:15:23', 103, 2, './file/20171214081523u.jpg'),
(5, 'good', '2017-12-14 16:16:09', 1, 4, './file/20171214081609timg.jpg'),
(7, 'fdfdfdfff', '2017-12-14 16:20:21', 1, 4, './file/20171214082021295492.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- 导出表中的数据 `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `access`) VALUES
(1, 'toby', '202cb962ac59075b964b07152d234b70', 3),
(102, 'acess1', '1a6c0d64f65c99f938b18fe0a3f4aa51', 1),
(103, 'acess2', '79bd05dbf91db16cb251b5e938af4b94', 2),
(104, 'acess4', '04ad7b94ece8ad1ce816689695c10373', 4);