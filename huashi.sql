/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : huashi

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2018-03-11 18:10:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `admin_pass` varchar(50) COLLATE utf8_bin NOT NULL,
  `myname` varchar(50) COLLATE utf8_bin NOT NULL,
  `admin_type` int(20) NOT NULL,
  `myphone` varchar(50) COLLATE utf8_bin NOT NULL,
  `admin_remarks` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1', '0', '');
INSERT INTO `admin` VALUES ('18', 'ss', '383c3256ad50111bddece77badf74854', 'ss', '0', 'ss', 'ss');

-- ----------------------------
-- Table structure for `exchange`
-- ----------------------------
DROP TABLE IF EXISTS `exchange`;
CREATE TABLE `exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `gif_id` int(20) NOT NULL,
  `exchange_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `exchange_person` varchar(50) COLLATE utf8_bin NOT NULL,
  `exchange_date` date NOT NULL,
  `exchange_integral` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of exchange
-- ----------------------------
INSERT INTO `exchange` VALUES ('21', '1', '9', '袁靖杀', '闵龙', '2018-03-10', '5');
INSERT INTO `exchange` VALUES ('22', '1', '9', '袁靖杀', '闵龙', '2018-03-10', '5');

-- ----------------------------
-- Table structure for `finance`
-- ----------------------------
DROP TABLE IF EXISTS `finance`;
CREATE TABLE `finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `finance_type` varchar(50) COLLATE utf8_bin NOT NULL,
  `finance_money` decimal(20,2) NOT NULL,
  `finance_details` varchar(50) COLLATE utf8_bin NOT NULL,
  `finance_date` date NOT NULL,
  `finance_entering` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of finance
-- ----------------------------
INSERT INTO `finance` VALUES ('1', '收入', '500.80', '微信收了50元', '2018-03-10', '2018-03-10 00:39:19');
INSERT INTO `finance` VALUES ('2', '支出', '200.50', '买了两张桌子', '2018-03-10', '2018-03-10 00:39:56');
INSERT INTO `finance` VALUES ('3', '收入', '10000.58', '今天闵龙交的上学期的学费', '2018-03-10', '2018-03-10 01:51:49');
INSERT INTO `finance` VALUES ('4', '支出', '100.50', '员工聚餐', '2018-02-13', '2018-03-10 02:07:01');
INSERT INTO `finance` VALUES ('5', '收入', '225.50', '新收的一个学生', '2018-04-11', '2018-03-10 19:02:03');

-- ----------------------------
-- Table structure for `gif`
-- ----------------------------
DROP TABLE IF EXISTS `gif`;
CREATE TABLE `gif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gif_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `gif_sum` int(20) NOT NULL,
  `gif_rest` int(20) NOT NULL,
  `gif_exchange_integral` int(20) NOT NULL,
  `gif_price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of gif
-- ----------------------------
INSERT INTO `gif` VALUES ('9', '袁靖杀', '1000', '998', '5', '0.20');
INSERT INTO `gif` VALUES ('7', '三国杀卡片1', '50', '50', '2', '0.20');

-- ----------------------------
-- Table structure for `integra`
-- ----------------------------
DROP TABLE IF EXISTS `integra`;
CREATE TABLE `integra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `integral_add` int(20) NOT NULL,
  `integral_date` date NOT NULL,
  `integral_now` int(20) NOT NULL,
  `integral_type` varchar(50) COLLATE utf8_bin NOT NULL,
  `integral_explain` varchar(50) COLLATE utf8_bin NOT NULL,
  `exchange_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of integra
-- ----------------------------
INSERT INTO `integra` VALUES ('1', '1', '5', '2018-03-08', '22', '奖励', '', '0');
INSERT INTO `integra` VALUES ('2', '1', '1', '2018-03-08', '22', '奖励', '', '0');
INSERT INTO `integra` VALUES ('3', '12', '2', '2018-03-08', '11', '奖励', '', '0');
INSERT INTO `integra` VALUES ('4', '12', '1', '2018-03-08', '11', '奖励', '', '0');
INSERT INTO `integra` VALUES ('5', '12', '1', '2018-03-08', '11', '奖励', '', '0');
INSERT INTO `integra` VALUES ('6', '12', '5', '2018-03-08', '11', '奖励', '', '0');
INSERT INTO `integra` VALUES ('7', '9', '5', '2018-03-08', '5', '奖励', '', '0');
INSERT INTO `integra` VALUES ('8', '9', '2', '2018-03-08', '7', '奖励', '', '0');
INSERT INTO `integra` VALUES ('9', '9', '5', '2018-03-08', '12', '奖励', '', '0');
INSERT INTO `integra` VALUES ('10', '9', '3', '2018-03-08', '15', '奖励', '', '0');
INSERT INTO `integra` VALUES ('11', '12', '2', '2018-03-08', '11', '奖励', '', '0');
INSERT INTO `integra` VALUES ('12', '1', '2', '2018-03-08', '22', '奖励', '', '0');
INSERT INTO `integra` VALUES ('13', '2', '1', '2018-03-08', '19', '奖励', '', '0');
INSERT INTO `integra` VALUES ('14', '2', '2', '2018-03-08', '19', '奖励', '', '0');
INSERT INTO `integra` VALUES ('15', '2', '2', '2018-03-08', '19', '奖励', '', '0');
INSERT INTO `integra` VALUES ('16', '2', '2', '2018-03-08', '19', '奖励', '', '0');
INSERT INTO `integra` VALUES ('17', '2', '3', '2018-03-08', '19', '奖励', '', '0');
INSERT INTO `integra` VALUES ('18', '2', '3', '2018-03-08', '19', '奖励', '', '0');
INSERT INTO `integra` VALUES ('19', '4', '1', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('20', '4', '2', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('21', '4', '2', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('22', '4', '2', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('23', '4', '2', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('24', '4', '2', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('25', '4', '2', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('26', '4', '5', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('27', '4', '2', '2018-03-08', '27', '奖励', '', '0');
INSERT INTO `integra` VALUES ('28', '3', '5', '2018-03-08', '29', '奖励', '', '0');
INSERT INTO `integra` VALUES ('29', '3', '5', '2018-03-08', '29', '奖励', '', '0');
INSERT INTO `integra` VALUES ('30', '3', '5', '2018-03-08', '29', '奖励', '', '0');
INSERT INTO `integra` VALUES ('31', '3', '5', '2018-03-08', '29', '奖励', '', '0');
INSERT INTO `integra` VALUES ('32', '3', '1', '2018-03-08', '29', '奖励', '', '0');
INSERT INTO `integra` VALUES ('33', '3', '2', '2018-03-08', '29', '奖励', '', '0');
INSERT INTO `integra` VALUES ('54', '1', '5', '2018-03-10', '22', '兑换', '兑换礼物【袁靖杀】', '21');
INSERT INTO `integra` VALUES ('55', '1', '5', '2018-03-10', '22', '兑换', '兑换礼物【袁靖杀】', '22');

-- ----------------------------
-- Table structure for `renew`
-- ----------------------------
DROP TABLE IF EXISTS `renew`;
CREATE TABLE `renew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `student_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `renew_date` date NOT NULL,
  `add_classhour` int(11) NOT NULL,
  `remarks` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of renew
-- ----------------------------
INSERT INTO `renew` VALUES ('13', '8', '私人', '2018-07-12', '2', 0x66617766776566776566);
INSERT INTO `renew` VALUES ('12', '9', '美女', '2018-04-18', '2', 0x73667366);
INSERT INTO `renew` VALUES ('10', '1', '闵龙', '2018-02-23', '19', 0x776567666673);
INSERT INTO `renew` VALUES ('9', '2', '酸辣', '2018-02-25', '5', 0x776567657267657267776572);
INSERT INTO `renew` VALUES ('11', '12', '小兵', '2018-03-23', '3', 0x736673);
INSERT INTO `renew` VALUES ('14', '96', 'sgagearg', '2018-10-24', '2', 0x797572);

-- ----------------------------
-- Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `student_initials` varchar(50) COLLATE utf8_bin NOT NULL,
  `student_age` int(11) NOT NULL,
  `student_data` datetime NOT NULL,
  `student_rest` int(20) NOT NULL,
  `student_birthday` date NOT NULL,
  `parento` varchar(50) COLLATE utf8_bin NOT NULL,
  `phoneo` varchar(50) COLLATE utf8_bin NOT NULL,
  `sex` varchar(50) COLLATE utf8_bin NOT NULL,
  `parentt` varchar(50) COLLATE utf8_bin NOT NULL,
  `phonet` varchar(50) COLLATE utf8_bin NOT NULL,
  `address` varchar(50) COLLATE utf8_bin NOT NULL,
  `classType` varchar(50) COLLATE utf8_bin NOT NULL,
  `school` varchar(50) COLLATE utf8_bin NOT NULL,
  `integral` int(20) NOT NULL,
  `state` varchar(20) COLLATE utf8_bin NOT NULL,
  `remarks` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', '闵龙', 'ml', '10', '2018-02-27 01:38:48', '26', '2018-02-26', 'fdsf', 'sfsf', '女', 'grwerg', 'ag', 'gaerg', '默认班级', 'fwfw', '22', '停课', 0x776567666673);
INSERT INTO `student` VALUES ('2', '酸辣', 'sl', '10', '2018-03-05 18:28:30', '3', '1899-11-30', '酸辣粉', '110', '男', '空心粉', '120', '湖北宜昌市', '默认班级', '野鸡大学', '19', '正常', '');
INSERT INTO `student` VALUES ('3', '小人', 'xr', '10', '2018-02-27 00:51:07', '2', '1899-11-30', 'gerg', 'egergw', '男', '', '', 'sfsdfs', '默认班级', '', '29', '', '');
INSERT INTO `student` VALUES ('4', '高兴', 'gx', '255', '2018-02-22 23:29:17', '3', '0000-00-00', '', '', '男', '', '', '', '', '', '27', '', '');
INSERT INTO `student` VALUES ('5', '疯子', 'fz', '255', '2018-02-22 23:29:17', '4', '0000-00-00', '', '', '男', '', '', '', '', '', '4', '', '');
INSERT INTO `student` VALUES ('6', '铁人', 'tr', '255', '2018-02-22 23:29:17', '3', '0000-00-00', '', '', '女', '', '', '', '', '', '5', '', '');
INSERT INTO `student` VALUES ('7', '兄热', 'xr', '255', '2018-02-22 23:29:17', '2', '0000-00-00', '', '', '女', '', '', '', '', '', '5', '', '');
INSERT INTO `student` VALUES ('8', '私人', 'sr', '255', '2018-02-22 23:29:17', '3', '0000-00-00', '', '', '女', '', '', '', '', '', '5', '', '');
INSERT INTO `student` VALUES ('9', '美女', 'mv', '255', '2018-02-22 23:29:17', '4', '0000-00-00', '', '', '女', '', '', '', '', '', '15', '', '');
INSERT INTO `student` VALUES ('12', '小兵', 'xb', '255', '2018-02-22 23:29:17', '3', '0000-00-00', '', '', '女', '', '', '', '', '', '11', '', '');
INSERT INTO `student` VALUES ('94', 'sdsdf', 'sdfgsdgfsdf', '4', '2018-02-25 10:14:52', '-2', '2018-02-13', 'gsgsgsg', 'sgsgsd', '女', 'gd', '', 'gsgsd', '默认班级', '', '0', '', '');
INSERT INTO `student` VALUES ('95', 'hetheh', 'heghe', '4', '2018-02-25 18:19:20', '-4', '2018-02-07', 'egerg', 'gerg', '男', '', '', 'agwrgw', '默认班级', '', '0', '', '');
INSERT INTO `student` VALUES ('96', 'sgagearg', 'gragwg', '5', '2018-02-27 01:30:46', '0', '2018-02-26', 'erherhg', 'ergherger', '男', 'gerger', 'gergerg', 'argaarg', '默认班级', '', '0', '', '');

-- ----------------------------
-- Table structure for `teacher`
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `tercher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `teacher_age` int(20) NOT NULL,
  `teacher_phone` varchar(50) COLLATE utf8_bin NOT NULL,
  `teacher_entry` varchar(50) COLLATE utf8_bin NOT NULL,
  `teacher_address` varchar(50) COLLATE utf8_bin NOT NULL,
  `teacher_state` varchar(50) COLLATE utf8_bin NOT NULL,
  `teacher_remarks` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`tercher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', '张老师', '4', 'sfs', '2018-03-02', 'fsfsfs', '正常', 0x73667366);
INSERT INTO `teacher` VALUES ('16', '田老师', '1', 'eger', '2018-03-03', 'grwegwr', '正常', 0x777267777267777267);
INSERT INTO `teacher` VALUES ('15', '冯老师', '1', 'eher', '2018-03-03', 'erh', '正常', 0x7268);
INSERT INTO `teacher` VALUES ('17', '猪老师', '2', 'dgdg', '2018-03-03', 'dfgdfgdf', '正常', 0x67646667646667);
INSERT INTO `teacher` VALUES ('18', '郭老师', '1', 'dhaethb', '2018-03-03', 'erghreg', '正常', 0x67657267);

-- ----------------------------
-- Table structure for `teachersign`
-- ----------------------------
DROP TABLE IF EXISTS `teachersign`;
CREATE TABLE `teachersign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `teacher_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `teacher_sign_data` date NOT NULL,
  `timeslot` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of teachersign
-- ----------------------------
INSERT INTO `teachersign` VALUES ('17', '18', '郭老师', '2018-03-03', '下午');
INSERT INTO `teachersign` VALUES ('16', '17', '猪老师', '2018-03-03', '下午');
INSERT INTO `teachersign` VALUES ('15', '15', '冯老师', '2018-03-03', '下午');
INSERT INTO `teachersign` VALUES ('14', '16', '田老师', '2018-03-03', '下午');
INSERT INTO `teachersign` VALUES ('13', '1', '张老师', '2018-03-03', '下午');
INSERT INTO `teachersign` VALUES ('18', '1', '张老师', '2018-03-04', '上午');
INSERT INTO `teachersign` VALUES ('19', '16', '田老师', '2018-03-04', '上午');
INSERT INTO `teachersign` VALUES ('20', '15', '冯老师', '2018-03-04', '上午');
INSERT INTO `teachersign` VALUES ('21', '17', '猪老师', '2018-03-04', '上午');
INSERT INTO `teachersign` VALUES ('22', '18', '郭老师', '2018-03-04', '上午');

-- ----------------------------
-- Table structure for `todaycourse`
-- ----------------------------
DROP TABLE IF EXISTS `todaycourse`;
CREATE TABLE `todaycourse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(20) NOT NULL,
  `student_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `timeslot` varchar(50) COLLATE utf8_bin NOT NULL,
  `student_rest` int(20) NOT NULL,
  `course_data` date NOT NULL,
  `address` varchar(50) COLLATE utf8_bin NOT NULL,
  `course_content` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of todaycourse
-- ----------------------------
INSERT INTO `todaycourse` VALUES ('6', '3', '小人', '上午', '4', '2018-03-02', 'sfsdfs', '水粉 蔬菜王国');
INSERT INTO `todaycourse` VALUES ('7', '7', '兄热', '上午', '4', '2018-03-02', '', '油画棒 数星星');
INSERT INTO `todaycourse` VALUES ('11', '8', '私人', '上午', '6', '2018-03-02', '', '线描 爱学习的小男孩');
INSERT INTO `todaycourse` VALUES ('10', '12', '小兵', '上午', '7', '2018-03-02', '', '水彩笔 天使');
INSERT INTO `todaycourse` VALUES ('12', '94', 'sdsdf', '上午', '-1', '2018-03-02', 'gsgsd', '中秋');
INSERT INTO `todaycourse` VALUES ('13', '4', '高兴', '下午', '4', '2018-03-03', '', '中秋');
INSERT INTO `todaycourse` VALUES ('14', '96', 'sgagearg', '下午', '1', '2018-03-03', 'argaarg', '水彩笔 天使');
INSERT INTO `todaycourse` VALUES ('15', '95', 'hetheh', '上午', '-1', '2018-03-02', '室内', '画画');
INSERT INTO `todaycourse` VALUES ('56', '95', 'hetheh', '下午', '-4', '2018-03-09', 'agwrgw', '');
INSERT INTO `todaycourse` VALUES ('18', '9', '美女', '上午', '6', '2018-03-04', '', '');
INSERT INTO `todaycourse` VALUES ('19', '2', '酸辣', '上午', '6', '2018-03-01', '事儿', 'afa');
INSERT INTO `todaycourse` VALUES ('20', '8', '私人', '上午', '5', '2018-03-04', '', '');
INSERT INTO `todaycourse` VALUES ('21', '94', 'sdsdf', '上午', '-2', '2018-03-04', 'gsgsd', '');
INSERT INTO `todaycourse` VALUES ('22', '6', '铁人', '上午', '4', '2018-03-04', '', '');
INSERT INTO `todaycourse` VALUES ('23', '3', '小人', '上午', '3', '2018-03-04', 'sfsdfs', '吃饭');
INSERT INTO `todaycourse` VALUES ('24', '7', '兄热', '上午', '3', '2018-03-04', '', '');
INSERT INTO `todaycourse` VALUES ('25', '12', '小兵', '上午', '6', '2018-03-04', '', '');
INSERT INTO `todaycourse` VALUES ('26', '4', '高兴', '上午', '3', '2018-03-04', '', '');
INSERT INTO `todaycourse` VALUES ('27', '96', 'sgagearg', '上午', '0', '2018-03-04', 'argaarg', '');
INSERT INTO `todaycourse` VALUES ('28', '5', '疯子', '上午', '4', '2018-03-04', '', '');
INSERT INTO `todaycourse` VALUES ('29', '2', '酸辣', '上午', '5', '2018-03-05', '室内', '吃饭');
INSERT INTO `todaycourse` VALUES ('30', '8', '私人', '上午', '4', '2018-03-05', '', '');
INSERT INTO `todaycourse` VALUES ('31', '9', '美女', '上午', '5', '2018-03-05', '室内', '画画');
INSERT INTO `todaycourse` VALUES ('32', '1', '闵龙', '全天', '32', '2018-03-05', '室内', '吃饭');
INSERT INTO `todaycourse` VALUES ('33', '95', 'hetheh', '上午', '-3', '2018-03-05', '室内', '画画');
INSERT INTO `todaycourse` VALUES ('34', '6', '铁人', '上午', '3', '2018-03-05', '', '');
INSERT INTO `todaycourse` VALUES ('35', '3', '小人', '上午', '2', '2018-03-05', 'sfsdfs', '睡觉');
INSERT INTO `todaycourse` VALUES ('36', '2', '酸辣', '上午', '4', '2018-03-06', '湖北宜昌市', '');
INSERT INTO `todaycourse` VALUES ('37', '8', '私人', '上午', '3', '2018-03-06', '', '');
INSERT INTO `todaycourse` VALUES ('52', '1', '闵龙', '全天', '30', '2018-03-06', '室内', '杀袁靖');
INSERT INTO `todaycourse` VALUES ('53', '1', '闵龙', '上午', '29', '2018-03-07', '吃饭', '吃饭');
INSERT INTO `todaycourse` VALUES ('51', '9', '美女', '上午', '4', '2018-03-06', '室外', '喂鱼');
INSERT INTO `todaycourse` VALUES ('50', '12', '小兵', '上午', '3', '2018-03-06', '室内', '上课');
INSERT INTO `todaycourse` VALUES ('49', '3', '小人', '上午', '2', '2018-03-06', '室内', '喂鱼');
INSERT INTO `todaycourse` VALUES ('54', '2', '酸辣', '上午', '3', '2018-03-07', '湖北宜昌市', 'fgsgf');
INSERT INTO `todaycourse` VALUES ('55', '1', '闵龙', '下午', '28', '2018-03-08', 'gaerg', '');
INSERT INTO `todaycourse` VALUES ('57', '1', '闵龙', '上午', '26', '2018-03-09', '室内', '自习');
INSERT INTO `todaycourse` VALUES ('58', '7', '兄热', '上午', '2', '2018-03-11', '', '');
