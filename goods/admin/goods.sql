/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : goods

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-04-15 00:09:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `aname` varchar(255) DEFAULT NULL,
  `aphone` varchar(20) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `defau` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('1', '14', '木子', '15313323691', '北京市丰台区榴景秀园三号楼一单元902', '0');
INSERT INTO `address` VALUES ('2', '14', '假的ma ', '17835424211', '19#466', '1');
INSERT INTO `address` VALUES ('3', '14', '真的', '15135973762', '凯通大厦', '1');
INSERT INTO `address` VALUES ('7', '12', '婷婷', '17835423011', '19#381', '0');
INSERT INTO `address` VALUES ('8', '15', '文杰', '123456', '北京', '0');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '衣服');
INSERT INTO `category` VALUES ('4', '鞋子');
INSERT INTO `category` VALUES ('5', '用具');
INSERT INTO `category` VALUES ('6', '书');
INSERT INTO `category` VALUES ('9', '箱包');
INSERT INTO `category` VALUES ('10', '运动户外');
INSERT INTO `category` VALUES ('13', '手机电脑');

-- ----------------------------
-- Table structure for `collect`
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `colid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `gid` int(10) DEFAULT NULL,
  PRIMARY KEY (`colid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of collect
-- ----------------------------

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `gtitle` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ginfo` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gphoto` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `price` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cid` int(10) DEFAULT NULL,
  `gtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('5', '联想笔记本', 'i5-6200  4G', '/upload/1523611094072cssj.jpg', '12', '22', '13', '2018-03-23 14:26:43', '0');
INSERT INTO `goods` VALUES ('6', '新山地自行车', '好车，美滋滋', 'undefined', '15', '199.0', '1', '2018-03-24 16:56:28', '1');
INSERT INTO `goods` VALUES ('7', '真山地自行车', '这次是真的', '/upload/1521883954972zxc1.jpg;/upload/1521883958980zxc2.jpg;/upload/1521883966456zxc3.jpg', '15', '199', '1', '2018-03-24 17:32:52', '0');
INSERT INTO `goods` VALUES ('8', '办公桌', '迷你版', '/upload/1523410556891qq.png;/upload/1523410558132tibet-1.jpg;/upload/1523410559841tibet-3.jpg;/upload/1523410561845tibet-4.jpg', '14', '111.00', '9', '2018-04-11 09:36:10', '0');
INSERT INTO `goods` VALUES ('9', '魅族手机', '3 32  只用了一年 八成新', '/upload/20180315/1523721899548001.jpg;/upload/20180315/1523721920582002.jpg;/upload/20180315/1523721931628003.jpg;/upload/20180315/1523721944857004.jpg', '14', '500.00', '13', '2018-04-13 18:14:20', '0');
INSERT INTO `goods` VALUES ('10', '测试图片', '没故事', '/upload/20180313/1523622349968qq.png', '14', '0.0', '1', '2018-04-13 20:26:53', '0');
INSERT INTO `goods` VALUES ('11', 'qwe', 'wqeeeeeeeee', '/upload/20180314/1523694190718cssj.jpg', '14', '0.01', '13', '2018-04-14 16:23:26', '0');

-- ----------------------------
-- Table structure for `money`
-- ----------------------------
DROP TABLE IF EXISTS `money`;
CREATE TABLE `money` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `uid1` int(10) DEFAULT NULL,
  `gid` int(10) DEFAULT NULL,
  `num` varchar(50) DEFAULT NULL,
  `uid2` int(10) DEFAULT NULL,
  `mtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `aid` int(10) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of money
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci DEFAULT '/images/default.jpeg',
  `info` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `money` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('12', 'tt', '15135973762', 'e10adc3949ba59abbe56e057f20f883e', '/images/default.jpeg', null, '111');
INSERT INTO `user` VALUES ('14', 'tt', 'tt', 'e10adc3949ba59abbe56e057f20f883e', '/upload/20180314/1523694181215cssj.jpg', null, '21113');
INSERT INTO `user` VALUES ('15', 'mr', '17835424211', '96e79218965eb72c92a549dd5a330112', '/images/default.jpeg', null, '1571');
INSERT INTO `user` VALUES ('16', '17835424210', '17835424210', '827ccb0eea8a706c4c34a16891f84e7b', '/images/default.jpeg', null, null);
