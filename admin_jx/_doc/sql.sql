create database if not exists `jx`;
USE `jx`;
CREATE TABLE `jx_admin` (
  `admin_id` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `admin_account` varchar(50) NOT NULL DEFAULT '',
  `admin_password` varchar(50) NOT NULL DEFAULT '',
  `admin_addTime` datetime DEFAULT NULL,
  `admin_loginTime` datetime DEFAULT NULL,
  `admin_loginCount` int(10) DEFAULT '0',
  `admin_lastIP` varchar(100) DEFAULT NULL,
  `admin_group` int(4) DEFAULT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `jx_admin` (`admin_id`, `admin_account`, `admin_password`, `admin_addTime`, `admin_loginTime`, `admin_loginCount`, `admin_lastIP`, `admin_group`) VALUES
(1, 'admin', '7fef6171469e80d32c0559f88b377245', NULL, '2017-01-5 19:12:16', 1, '127.0.0.1', NULL);


CREATE TABLE `jx_class`(
	`class_id` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`class_name` varchar(20) DEFAULT ''
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `jx_class`(`class_id`,`class_name`)VALUES(1,'DEFAULT1');
INSERT INTO `jx_class`(`class_id`,`class_name`)VALUES(2,'DEFAULT2');
INSERT INTO `jx_class`(`class_id`,`class_name`)VALUES(3,'DEFAULT3');
INSERT INTO `jx_class`(`class_id`,`class_name`)VALUES(4,'DEFAULT4');


CREATE TABLE `jx_pic`(
	`pic_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`pic_name` varchar(100) DEFAULT '',
	`pic_link` varchar(100) DEFAULT '',
	`pic_address` varchar(100) DEFAULT '',
	`pic_classid` int(11),
	`pic_order` int(4) DEFAULT 0
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `jx_site`(
	`site_id` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`site_email` varchar(100) DEFAULT '',
	`site_email1` varchar(100) DEFAULT '',
	`site_phone` varchar(100) DEFAULT '',
	`site_phone1` varchar(100) DEFAULT '',
	`site_webname` varchar(100) DEFAULT ''
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO `jx_site`(`site_id`,`site_webname`,`site_email1`,`site_email`,`site_phone1`,`site_phone`)VALUES(1,'Fashion','email@test.com','email@test.com','18610088251','18610088251');


