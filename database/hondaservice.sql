/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50723
Source Host           : localhost:3306
Source Database       : hondaservice

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2019-02-02 13:53:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for backcar
-- ----------------------------
DROP TABLE IF EXISTS `backcar`;
CREATE TABLE `backcar` (
  `bc_id` varchar(30) NOT NULL,
  `bc_date` date DEFAULT NULL,
  `emp_id` varchar(30) DEFAULT NULL,
  `gc_id` varchar(30) DEFAULT NULL,
  `rs_id` varchar(30) DEFAULT NULL,
  `re_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`bc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D12 ข้อมูลการซ่อม';

-- ----------------------------
-- Records of backcar
-- ----------------------------
INSERT INTO `backcar` VALUES ('BAC000001', '2019-01-14', 'EMP000002', 'GEC000001', '21', 'REP000001');

-- ----------------------------
-- Table structure for buyorder
-- ----------------------------
DROP TABLE IF EXISTS `buyorder`;
CREATE TABLE `buyorder` (
  `buy_id` varchar(30) NOT NULL,
  `buy_num` varchar(30) NOT NULL,
  `buy_timein` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `buy_timeout` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sp_id` varchar(30) NOT NULL,
  `buy_namein` varchar(50) NOT NULL,
  `buy_nameout` varchar(50) NOT NULL,
  PRIMARY KEY (`buy_id`),
  KEY `sp_id` (`sp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of buyorder
-- ----------------------------
INSERT INTO `buyorder` VALUES ('001', '20', '2018-09-04 11:21:06', '2018-09-04 11:22:00', 'dp03', 'admin', 'admin');
INSERT INTO `buyorder` VALUES ('01', '11', '2018-09-12 12:00:03', '2018-09-12 12:00:03', 'dp01', 'emem', '');
INSERT INTO `buyorder` VALUES ('131', '20', '2018-09-01 13:36:44', '2018-09-01 13:37:49', 'dp01', 'emem', 'tantancafe');
INSERT INTO `buyorder` VALUES ('2131', '20', '2018-09-01 13:39:27', '2018-09-01 13:39:36', 'dp02', 'tantancafe', 'tantancafe');
INSERT INTO `buyorder` VALUES ('p01', '20', '2018-08-30 02:43:36', '2018-08-30 02:47:00', 'dp01', 'admin', 'emem');
INSERT INTO `buyorder` VALUES ('p02', '100', '2018-08-30 02:44:09', '2018-08-30 02:44:09', 'dp01', 'admin', '');
INSERT INTO `buyorder` VALUES ('p03', '50', '2018-08-30 02:45:14', '2018-08-30 02:45:14', 'dp01', 'emem', '');
INSERT INTO `buyorder` VALUES ('p04', '200', '2018-08-30 02:46:26', '2018-08-30 02:47:14', 'dp01', 'emem', 'emem');
INSERT INTO `buyorder` VALUES ('p12', '10', '2018-08-30 00:41:15', '2018-08-30 02:01:37', 'dp01', 'admin', 'admin');
INSERT INTO `buyorder` VALUES ('wqe', '20', '2018-09-01 22:01:11', '2018-09-01 22:01:34', 'dp02', 'emem', 'emem');

-- ----------------------------
-- Table structure for carorder
-- ----------------------------
DROP TABLE IF EXISTS `carorder`;
CREATE TABLE `carorder` (
  `co_id` varchar(30) NOT NULL,
  `co_carmodel` varchar(50) NOT NULL,
  `co_description` text NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D3 ข้อมูลรถ';

-- ----------------------------
-- Records of carorder
-- ----------------------------
INSERT INTO `carorder` VALUES ('CAR000001', 'REBEL500', 'รถคลาสสิค สีดำ ไฟกลม');
INSERT INTO `carorder` VALUES ('CAR000002', 'clicki125(2018)', 'ล้อแม็ค สีเขียว ตัวท็อป');
INSERT INTO `carorder` VALUES ('CAR000003', 'K194', 'น้ำ');
INSERT INTO `carorder` VALUES ('CAR000004', 'yamaha 150 ti', 'แดง');

-- ----------------------------
-- Table structure for carservice
-- ----------------------------
DROP TABLE IF EXISTS `carservice`;
CREATE TABLE `carservice` (
  `cs_id` varchar(30) NOT NULL,
  `cs_license` varchar(50) NOT NULL,
  `cs_description` text NOT NULL,
  `cs_date` datetime NOT NULL,
  `cus_id` varchar(30) NOT NULL,
  PRIMARY KEY (`cs_id`),
  KEY `cus_id` (`cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of carservice
-- ----------------------------
INSERT INTO `carservice` VALUES ('cs01', '8946', 'ไฟเสีย', '2018-09-05 11:05:47', '12345678');
INSERT INTO `carservice` VALUES ('cs02', '8855', 'ฟันเฟืองหัก', '2018-09-05 11:12:37', 'CafeTaKuMi');
INSERT INTO `carservice` VALUES ('cs03', '7846', 'ไฟเลี้ยวขาด', '2018-09-05 11:15:12', '12345678');
INSERT INTO `carservice` VALUES ('cs05', '5555', 'ไฟเสีย', '2018-09-05 13:50:04', '12345678');

-- ----------------------------
-- Table structure for checklist
-- ----------------------------
DROP TABLE IF EXISTS `checklist`;
CREATE TABLE `checklist` (
  `ch_id` varchar(30) NOT NULL,
  `ch_list` varchar(200) DEFAULT NULL,
  `ch_price` int(15) DEFAULT NULL,
  PRIMARY KEY (`ch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D5 ข้อมูลรายการตรวจเช็ค';

-- ----------------------------
-- Records of checklist
-- ----------------------------
INSERT INTO `checklist` VALUES ('CHK000001', 'เปลี่ยนยางหน้า', '30');
INSERT INTO `checklist` VALUES ('CHK000002', 'ตรวจเช็ครถ', '50');
INSERT INTO `checklist` VALUES ('CHK000003', 'เปลี่ยนไฟหน้ารถ fino ', '30');
INSERT INTO `checklist` VALUES ('CHK000004', 'เปลี่ยนคาบู', '100');
INSERT INTO `checklist` VALUES ('CHK000005', 'เปลี่ยนแบต', '50');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `cus_id` varchar(30) NOT NULL,
  `cus_user` varchar(255) DEFAULT NULL,
  `cus_pass` varchar(255) DEFAULT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `cus_add` text,
  `cus_tel` varchar(30) DEFAULT NULL,
  `co_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cus_id`),
  KEY `co_id` (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D2 ข้อมูลลูกค้า';

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('CUS000001', '123444', '123444', 'veeravat', 'vgbhgfh', '0894812345', 'CAR000002');
INSERT INTO `customer` VALUES ('CUS000002', '123444', '123456', 'วีระวัฒน์', '489ฟกหด', '0594259', 'CAR000003');
INSERT INTO `customer` VALUES ('CUS000003', '1234564', '1234564', 'วีระวัฒน์', '่ากเ', '่กาส', 'CAR000004');
INSERT INTO `customer` VALUES ('CUS000004', '12345678', '12345678', 'tantan', '78 ม.6', '987895', 'CAR000003');
INSERT INTO `customer` VALUES ('CUS000005', 'asdasdsadsa', 'sadsad', 'sadsadsa', 'sadsadsa', 'sadsadsa', 'CAR000001');
INSERT INTO `customer` VALUES ('CUS000006', 'CafeTaKuMiCafeTaKuMi', '12345678', 'Thanaporn Sermprungsuk', '78 หมู่6 ต.พระลับ อ.เมือง จ.ขอนแก่น 40000', '0992825820', 'CAR000001');
INSERT INTO `customer` VALUES ('CUS000007', 'CafeTaKuMi02', '12345678', 'asdas', 'dsadsa', 'asdsa', 'CAR000001');
INSERT INTO `customer` VALUES ('CUS000008', 'engeng', 'engeng', 'Thanaporn', '78 khonkaen', '0992825820', 'CAR000001');
INSERT INTO `customer` VALUES ('CUS000009', 'jamejame', '2345678', 'jameza', 'khonkaen', '12312321', 'CAR000001');
INSERT INTO `customer` VALUES ('CUS000010', 'kingking', 'kingking', 'Thanaporn', '78 Khonkaen', '1234567890', 'CAR000001');
INSERT INTO `customer` VALUES ('CUS000011', 'panupong', '12345678', 'panupong', 'khonkaen', '12345678', 'CAR000001');
INSERT INTO `customer` VALUES ('CUS000012', 'pornhub2', '12345678', 'Thanaporn2', '78 Khonkaen2', '0658455182', 'CAR000001');

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `emp_id` varchar(30) NOT NULL,
  `emp_user` varchar(255) DEFAULT NULL,
  `emp_pass` varchar(255) DEFAULT NULL,
  `emp_name` varchar(50) DEFAULT NULL,
  `emp_add` text,
  `emp_tel` varchar(30) DEFAULT NULL,
  `emp_position` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D4 ข้อมูลพนักงาน';

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('EMP000001', 'admin', '1111', 'Thanaporn Sermprungsuk', '78 หมู่6 ต.พระลับ อ.เมือง จ.ขอนแก่น 40000', '12345678', '0');
INSERT INTO `employee` VALUES ('EMP000002', 'user', 'user', 'thanaporn', '7878', '12345678', '1');
INSERT INTO `employee` VALUES ('EMP000004', '1111', '2222', 'พรชัย ภูชัยยัง', '115/8', '0827468287', '1');
INSERT INTO `employee` VALUES ('EMP000005', 'qqqq', 'wwww', 'asdasd', 'asdasd', '1231231231', '1');

-- ----------------------------
-- Table structure for get_car
-- ----------------------------
DROP TABLE IF EXISTS `get_car`;
CREATE TABLE `get_car` (
  `gc_id` varchar(30) NOT NULL,
  `gc_date` date DEFAULT NULL,
  `gc_text` varchar(50) DEFAULT NULL,
  `cus_id` varchar(30) DEFAULT NULL,
  `rs_id` varchar(30) DEFAULT NULL,
  `co_id` varchar(30) DEFAULT NULL,
  `gc_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`gc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='D11 รับรถเข้ารับบริการ';

-- ----------------------------
-- Records of get_car
-- ----------------------------
INSERT INTO `get_car` VALUES ('GEC000001', '2018-11-10', 'asdasd', 'CUS000001', '21', 'CAR000002', '4');
INSERT INTO `get_car` VALUES ('GEC000002', '2018-11-11', 'DFGDFG', 'CUS000002', '27', 'CAR000003', '3');
INSERT INTO `get_car` VALUES ('GEC000003', '2018-11-11', 'dfgdfg', 'CUS000003', '28', 'CAR000004', '3');
INSERT INTO `get_car` VALUES ('GEC000004', '2018-11-11', 'dfgdfg', 'CUS000004', '29', 'CAR000003', '2');
INSERT INTO `get_car` VALUES ('GEC000005', '2019-01-14', 'กหฟดฟหด', 'CUS000009', '34', 'CAR000001', '1');
INSERT INTO `get_car` VALUES ('GEC000006', '2019-01-14', 'dasd', 'CUS000010', '35', 'CAR000001', '0');
INSERT INTO `get_car` VALUES ('GEC000007', '2019-02-02', 'asdasd', 'CUS000001', '40', 'CAR000002', '0');

-- ----------------------------
-- Table structure for listorder
-- ----------------------------
DROP TABLE IF EXISTS `listorder`;
CREATE TABLE `listorder` (
  `lo_price` varchar(50) NOT NULL,
  `lo_num` varchar(50) NOT NULL,
  `sp_id` varchar(30) NOT NULL,
  `os_id` varchar(30) NOT NULL,
  KEY `sp_id` (`sp_id`),
  KEY `os_id` (`os_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of listorder
-- ----------------------------
INSERT INTO `listorder` VALUES ('200', '2', 'dp02', '2');
INSERT INTO `listorder` VALUES ('40', '2', 'dp01', '2');
INSERT INTO `listorder` VALUES ('400', '2', 'dp03', '2');
INSERT INTO `listorder` VALUES ('100', '5', 'dp01', '3');
INSERT INTO `listorder` VALUES ('400', '4', 'dp02', '3');
INSERT INTO `listorder` VALUES ('600', '3', 'dp03', '3');
INSERT INTO `listorder` VALUES ('200', '10', 'dp01', '4');
INSERT INTO `listorder` VALUES ('2000', '10', 'dp03', '4');

-- ----------------------------
-- Table structure for manageque
-- ----------------------------
DROP TABLE IF EXISTS `manageque`;
CREATE TABLE `manageque` (
  `mq_id` varchar(50) NOT NULL,
  `cs_id` varchar(50) NOT NULL,
  PRIMARY KEY (`mq_id`),
  KEY `cs_id` (`cs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manageque
-- ----------------------------
INSERT INTO `manageque` VALUES ('1', 'cs01');
INSERT INTO `manageque` VALUES ('2', 'cs03');
INSERT INTO `manageque` VALUES ('3', 'cs05');

-- ----------------------------
-- Table structure for ordersp
-- ----------------------------
DROP TABLE IF EXISTS `ordersp`;
CREATE TABLE `ordersp` (
  `os_id` int(30) NOT NULL,
  `os_add` text NOT NULL,
  `os_tel` varchar(30) NOT NULL,
  `os_nameout` varchar(30) NOT NULL,
  `os_datein` datetime NOT NULL,
  `os_dateout` datetime NOT NULL,
  `emp_id` varchar(30) NOT NULL,
  PRIMARY KEY (`os_id`),
  KEY `cus_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ordersp
-- ----------------------------
INSERT INTO `ordersp` VALUES ('1', 'ศูนย์ฮอนด้าขอนแก่น', '0992825820', 'emem', '2018-09-12 01:03:12', '2018-09-12 20:40:33', 'emem');
INSERT INTO `ordersp` VALUES ('2', 'ศูนย์ขอนแก่น', '0846584532', 'admin', '2018-09-26 15:27:11', '2018-09-26 15:29:42', 'admin');
INSERT INTO `ordersp` VALUES ('3', 'ศูนย์กรุงเทพ', '0846521654', '', '2018-09-26 15:28:38', '0000-00-00 00:00:00', 'admin');
INSERT INTO `ordersp` VALUES ('4', 'Loko', '123456', 'admin', '2018-10-04 07:07:34', '2018-10-04 07:16:28', 'admin');

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `pa_id` varchar(30) NOT NULL,
  `pa_date` date DEFAULT NULL,
  `emp_id` varchar(30) DEFAULT NULL,
  `pa_total` int(200) DEFAULT NULL,
  `gc_id` varchar(30) DEFAULT NULL,
  `rs_id` varchar(30) DEFAULT NULL,
  `re_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`pa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D12 ข้อมูลการซ่อม';

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES ('PAY000001', '2019-01-13', 'EMP000002', '600', 'GEC000001', '21', 'REP000001');
INSERT INTO `payment` VALUES ('PAY000002', '2019-01-14', 'EMP000002', '2130', 'GEC000002', '27', 'REP000002');
INSERT INTO `payment` VALUES ('PAY000003', '2019-01-14', 'EMP000002', '550', 'GEC000003', '28', 'REP000003');

-- ----------------------------
-- Table structure for payment_copy
-- ----------------------------
DROP TABLE IF EXISTS `payment_copy`;
CREATE TABLE `payment_copy` (
  `pay_id` varchar(30) NOT NULL,
  `pay_price` varchar(30) NOT NULL,
  `re_id` varchar(30) NOT NULL,
  `ui_id` varchar(30) NOT NULL,
  `cs_id` varchar(30) NOT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `re_id` (`re_id`),
  KEY `ui_id` (`ui_id`),
  KEY `cs_id` (`cs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment_copy
-- ----------------------------
INSERT INTO `payment_copy` VALUES ('001', '2000', 're01', '001', 'cs01');
INSERT INTO `payment_copy` VALUES ('002', '520', 're02', '002', 'cs03');

-- ----------------------------
-- Table structure for purchase_order
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order`;
CREATE TABLE `purchase_order` (
  `po_id` varchar(30) NOT NULL,
  `po_date` date DEFAULT NULL,
  `po_agent` varchar(255) DEFAULT NULL,
  `po_address` text,
  `po_tel` varchar(30) DEFAULT NULL,
  `po_total` varchar(30) DEFAULT NULL,
  `emp_id` varchar(30) DEFAULT NULL,
  `po_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D7 สั่งซื้ออะไหล่';

-- ----------------------------
-- Records of purchase_order
-- ----------------------------
INSERT INTO `purchase_order` VALUES ('POR000001', '2018-11-03', 'sdfsdf', 'fsdfsdf', 'sdfsdfsd', '1060', 'EMP000002', '1');
INSERT INTO `purchase_order` VALUES ('POR000002', '2018-11-03', 'asdasdasd', 'sdasdasd', 'asdasda', '240', 'EMP000002', '1');
INSERT INTO `purchase_order` VALUES ('POR000003', '2018-11-03', 'asasd', 'ddddd', 'dddd', '1700', 'EMP000002', '1');
INSERT INTO `purchase_order` VALUES ('POR000004', '2018-11-04', 'bc', 'vcbcvb', 'bcvbcvbc', '5100', 'EMP000002', '1');
INSERT INTO `purchase_order` VALUES ('POR000005', '2018-11-04', 'dfsdfsdf', 'ghjghj', '0824447586', '180', 'EMP000002', '1');
INSERT INTO `purchase_order` VALUES ('POR000006', '2018-11-06', 'adas', 'asdasd', 'asdasd', '2280', 'EMP000002', '1');
INSERT INTO `purchase_order` VALUES ('POR000007', '2018-11-06', 'asdasd', 'asdasdasd', 'asdasd', '120', 'EMP000002', '0');
INSERT INTO `purchase_order` VALUES ('POR000008', '2018-11-07', 'ฟหกฟห', 'ฟหกฟหก', 'ฟหกฟหก', '500', 'EMP000001', '0');
INSERT INTO `purchase_order` VALUES ('POR000009', '2018-11-17', 'gfhfgh', '121212', 'fghfgh', '1200', 'EMP000002', '0');
INSERT INTO `purchase_order` VALUES ('POR000010', '2018-12-08', 'ฟหฟหกฟ', 'กฟหกก', '0844444444', '1400', 'EMP000002', '1');

-- ----------------------------
-- Table structure for purchase_order_list
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_list`;
CREATE TABLE `purchase_order_list` (
  `po_id` varchar(30) DEFAULT NULL,
  `sp_id` varchar(30) DEFAULT NULL,
  `po_num` int(10) DEFAULT NULL,
  `po_price` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='D8 รายการสั่งซื้ออะไหล่';

-- ----------------------------
-- Records of purchase_order_list
-- ----------------------------
INSERT INTO `purchase_order_list` VALUES ('POR000001', 'SPR000001', '3', '20');
INSERT INTO `purchase_order_list` VALUES ('POR000001', 'SPR000002', '6', '100');
INSERT INTO `purchase_order_list` VALUES ('POR000001', 'SPR000003', '2', '200');
INSERT INTO `purchase_order_list` VALUES ('POR000002', 'SPR000001', '2', '20');
INSERT INTO `purchase_order_list` VALUES ('POR000002', 'SPR000002', '2', '100');
INSERT INTO `purchase_order_list` VALUES ('POR000003', 'SPR000004', '1', '1500');
INSERT INTO `purchase_order_list` VALUES ('POR000003', 'SPR000003', '1', '200');
INSERT INTO `purchase_order_list` VALUES ('POR000004', 'SPR000003', '3', '200');
INSERT INTO `purchase_order_list` VALUES ('POR000004', 'SPR000004', '3', '1500');
INSERT INTO `purchase_order_list` VALUES ('POR000005', 'SPR000001', '4', '20');
INSERT INTO `purchase_order_list` VALUES ('POR000005', 'SPR000002', '1', '100');
INSERT INTO `purchase_order_list` VALUES ('POR000006', 'SPR000001', '4', '20');
INSERT INTO `purchase_order_list` VALUES ('POR000006', 'SPR000002', '3', '100');
INSERT INTO `purchase_order_list` VALUES ('POR000006', 'SPR000003', '2', '200');
INSERT INTO `purchase_order_list` VALUES ('POR000006', 'SPR000004', '1', '1500');
INSERT INTO `purchase_order_list` VALUES ('POR000007', 'SPR000001', '1', '20');
INSERT INTO `purchase_order_list` VALUES ('POR000007', 'SPR000002', '1', '100');
INSERT INTO `purchase_order_list` VALUES ('POR000008', 'SPR000002', '5', '100');
INSERT INTO `purchase_order_list` VALUES ('REP000001', 'SPR000001', '2', '20');
INSERT INTO `purchase_order_list` VALUES ('REP000001', 'SPR000002', '1', '100');
INSERT INTO `purchase_order_list` VALUES ('POR000009', 'SPR000001', '10', '20');
INSERT INTO `purchase_order_list` VALUES ('POR000009', 'SPR000006', '10', '100');
INSERT INTO `purchase_order_list` VALUES ('POR000010', 'SPR000009', '5', '150');
INSERT INTO `purchase_order_list` VALUES ('POR000010', 'SPR000008', '5', '130');

-- ----------------------------
-- Table structure for repair
-- ----------------------------
DROP TABLE IF EXISTS `repair`;
CREATE TABLE `repair` (
  `re_id` varchar(30) NOT NULL,
  `re_date` date DEFAULT NULL,
  `emp_id` varchar(30) DEFAULT NULL,
  `re_total` int(200) DEFAULT NULL,
  `gc_id` varchar(30) DEFAULT NULL,
  `rs_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`re_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D12 ข้อมูลการซ่อม';

-- ----------------------------
-- Records of repair
-- ----------------------------
INSERT INTO `repair` VALUES ('REP000001', '2018-11-17', 'EMP000001', '600', 'GEC000001', '21');
INSERT INTO `repair` VALUES ('REP000002', '2018-12-16', 'EMP000002', '2130', 'GEC000002', '27');
INSERT INTO `repair` VALUES ('REP000003', '2019-01-14', 'EMP000002', '550', 'GEC000003', '28');
INSERT INTO `repair` VALUES ('REP000004', '2019-01-14', 'EMP000002', '1100', 'GEC000004', '29');

-- ----------------------------
-- Table structure for repair_checklist
-- ----------------------------
DROP TABLE IF EXISTS `repair_checklist`;
CREATE TABLE `repair_checklist` (
  `re_id` varchar(30) DEFAULT NULL,
  `ch_id` varchar(30) DEFAULT NULL,
  `re_price` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ข้อมูลรายการซ่อม';

-- ----------------------------
-- Records of repair_checklist
-- ----------------------------
INSERT INTO `repair_checklist` VALUES ('REP000001', 'CHK000001', '30');
INSERT INTO `repair_checklist` VALUES ('REP000001', 'CHK000002', '50');
INSERT INTO `repair_checklist` VALUES ('REP000002', 'CHK000001', '30');
INSERT INTO `repair_checklist` VALUES ('REP000002', 'CHK000004', '100');
INSERT INTO `repair_checklist` VALUES ('REP000003', 'CHK000003', '30');
INSERT INTO `repair_checklist` VALUES ('REP000003', 'CHK000004', '100');

-- ----------------------------
-- Table structure for repair_spareparts
-- ----------------------------
DROP TABLE IF EXISTS `repair_spareparts`;
CREATE TABLE `repair_spareparts` (
  `re_id` varchar(30) DEFAULT NULL,
  `sp_id` varchar(30) DEFAULT NULL,
  `re_num` int(50) DEFAULT NULL,
  `re_price` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='D13 ข้อมูลการใช้อะไหลา';

-- ----------------------------
-- Records of repair_spareparts
-- ----------------------------
INSERT INTO `repair_spareparts` VALUES ('REP000001', 'SPR000002', '1', '100');
INSERT INTO `repair_spareparts` VALUES ('REP000001', 'SPR000003', '1', '200');
INSERT INTO `repair_spareparts` VALUES ('REP000001', 'SPR000001', '1', '20');
INSERT INTO `repair_spareparts` VALUES ('REP000001', 'SPR000003', '1', '200');
INSERT INTO `repair_spareparts` VALUES ('REP000002', 'SPR000004', '1', '1500');
INSERT INTO `repair_spareparts` VALUES ('REP000002', 'SPR000005', '1', '500');
INSERT INTO `repair_spareparts` VALUES ('REP000003', 'SPR000007', '1', '200');
INSERT INTO `repair_spareparts` VALUES ('REP000003', 'SPR000003', '1', '200');
INSERT INTO `repair_spareparts` VALUES ('REP000003', 'SPR000001', '1', '20');
INSERT INTO `repair_spareparts` VALUES ('REP000004', 'SPR000002', '1', '100');
INSERT INTO `repair_spareparts` VALUES ('REP000004', 'SPR000005', '1', '500');

-- ----------------------------
-- Table structure for reservation
-- ----------------------------
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `rs_id` int(50) NOT NULL,
  `rs_description` text NOT NULL,
  `rs_date` datetime NOT NULL,
  `rs_datereal` datetime NOT NULL,
  `rs_status` varchar(50) NOT NULL,
  `cus_id` varchar(50) NOT NULL,
  `rs_ex` text,
  `rs_doc` text,
  PRIMARY KEY (`rs_id`),
  KEY `cus_id` (`cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D9 จองคิวเข้ารับบริการ';

-- ----------------------------
-- Records of reservation
-- ----------------------------
INSERT INTO `reservation` VALUES ('21', 'ss', '2018-08-30 07:10:00', '2018-09-05 16:48:27', 'รับรถแล้ว', 'CUS000001', null, '222');
INSERT INTO `reservation` VALUES ('27', 'หฟก', '2018-08-30 10:04:00', '2018-09-05 18:48:27', 'ชำระเงินแล้ว', 'CUS000002', null, '333');
INSERT INTO `reservation` VALUES ('28', 'asd', '2018-08-30 12:55:00', '2018-09-05 19:48:27', 'ชำระเงินแล้ว', 'CUS000003', null, '444');
INSERT INTO `reservation` VALUES ('29', 'หาตั้งนาน', '2018-08-30 04:04:00', '2018-09-05 19:48:27', 'ซ่อมรถเสร็จแล้ว', 'CUS000004', null, '555');
INSERT INTO `reservation` VALUES ('30', 'ลองใหม่', '2018-08-31 01:05:00', '2018-08-10 19:47:36', 'นำรถเข้ารับบริการแล้ว', 'CUS000005', null, '22123');
INSERT INTO `reservation` VALUES ('31', '555+ss', '2018-08-31 02:22:00', '2018-08-01 19:47:20', 'นำรถเข้ารับบริการแล้ว', 'CUS000006', null, '33213');
INSERT INTO `reservation` VALUES ('34', 'แอลจองนะ', '2018-10-24 04:44:00', '2018-10-01 19:47:08', 'นำรถเข้ารับบริการแล้ว', 'CUS000009', null, '2133');
INSERT INTO `reservation` VALUES ('35', 'รุ่นรอง', '2018-11-26 09:04:00', '2018-11-01 23:31:44', 'นำรถเข้ารับบริการแล้ว', 'CUS000010', null, '1233');
INSERT INTO `reservation` VALUES ('36', 'บิ๊กไบสีแดง', '2018-12-01 09:04:00', '2018-11-27 23:31:34', 'ยืนยันการจองแล้ว', 'CUS000011', null, '333');
INSERT INTO `reservation` VALUES ('37', 'X56', '2018-10-04 13:00:00', '2018-10-01 23:29:53', 'ยืนยันการจองแล้ว', 'CUS000012', null, '112');
INSERT INTO `reservation` VALUES ('38', 'รถเสีย ไฟหน้าแตก', '2018-12-05 12:00:00', '2018-11-05 23:29:45', 'ยกเลิกการจองแล้ว', 'CUS000004', 'sdasd', '22');
INSERT INTO `reservation` VALUES ('39', 'รถเสีย', '2019-03-01 09:04:00', '2019-02-02 16:04:13', 'ยืนยันการจองแล้ว', 'CUS000001', null, '333');
INSERT INTO `reservation` VALUES ('40', 'รถเสีย2', '2019-03-03 09:04:00', '2019-02-02 12:04:13', 'นำรถเข้ารับบริการแล้ว', 'CUS000001', '', '44');
INSERT INTO `reservation` VALUES ('41', 'เสีย3', '2019-02-02 11:23:35', '2019-02-02 08:26:47', 'ยืนยันการจองแล้ว', 'CUS000004', 'test', '5');
INSERT INTO `reservation` VALUES ('42', 'เสีย4', '2019-02-02 11:23:35', '2019-02-02 08:26:47', 'ยังไม่ยืนยันการจอง', 'CUS000005', 'test2', '55-3');
INSERT INTO `reservation` VALUES ('43', 'เสีย5', '2019-02-05 12:25:31', '2019-02-02 08:26:47', 'ยังไม่ยืนยันการจอง', 'CUS000002', 'test5', '55-43');

-- ----------------------------
-- Table structure for spareparts
-- ----------------------------
DROP TABLE IF EXISTS `spareparts`;
CREATE TABLE `spareparts` (
  `sp_id` varchar(30) NOT NULL,
  `sp_name` varchar(30) DEFAULT NULL,
  `sp_description` text,
  `sp_price` varchar(30) DEFAULT NULL,
  `sp_num` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D6 ข้อมูลอะไหล่';

-- ----------------------------
-- Records of spareparts
-- ----------------------------
INSERT INTO `spareparts` VALUES ('SPR000001', 'ฟันเฟือง', 'เป็นชิ้นส่วนเครื่องจักร', '20', '1');
INSERT INTO `spareparts` VALUES ('SPR000002', 'น้ำมันเครื่อง', 'ใช้เมื่อหมดจะสต้าทรถไม่ติด', '100', '13');
INSERT INTO `spareparts` VALUES ('SPR000003', 'ไฟเลี้ยว', 'ใช้เป็นสัญญาณจราจร', '200', '4');
INSERT INTO `spareparts` VALUES ('SPR000004', 'คาบู', 'คาบู ตราหมาทีบลูกบอล ใช้วัสดุระดับ Hight-end ช่วยให้เร่งความเร็วได้สูงงงงง', '1500', '5');
INSERT INTO `spareparts` VALUES ('SPR000005', 'ยางรถ ตรา BMW size L', 'ยางรถสำหรับรถ 110cc', '500', '8');
INSERT INTO `spareparts` VALUES ('SPR000006', 'สายเบรค', '-', '100', '5');
INSERT INTO `spareparts` VALUES ('SPR000007', 'ไฟหน้ารถ Mio รุ่นเก่า', '-', '200', '14');
INSERT INTO `spareparts` VALUES ('SPR000008', 'สายคันเร่ง size M', '-', '130', '10');
INSERT INTO `spareparts` VALUES ('SPR000009', 'หัวเทียน', '-', '150', '10');

-- ----------------------------
-- Table structure for store
-- ----------------------------
DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `sto_id` varchar(50) NOT NULL,
  `sto_name` varchar(50) NOT NULL,
  `sto_add` text NOT NULL,
  `sto_tel` varchar(30) NOT NULL,
  `sto_description` text NOT NULL,
  PRIMARY KEY (`sto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='D1 ข้อมูลร้าน';

-- ----------------------------
-- Records of store
-- ----------------------------
INSERT INTO `store` VALUES ('STO000001', 'Honda Bigwing', 'khonkaen 40000', '0827416082', 'ร้านค้านี้เปิดมาเพื่อซ่อมรถ');

-- ----------------------------
-- Table structure for useitem
-- ----------------------------
DROP TABLE IF EXISTS `useitem`;
CREATE TABLE `useitem` (
  `ui_id` varchar(30) NOT NULL,
  `ui_description` text NOT NULL,
  `ui_price` varchar(30) NOT NULL,
  `sp_id` varchar(30) NOT NULL,
  `cs_id` varchar(30) NOT NULL,
  PRIMARY KEY (`ui_id`),
  KEY `sp_id` (`sp_id`),
  KEY `cs_id` (`cs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of useitem
-- ----------------------------
INSERT INTO `useitem` VALUES ('001', 'ไฟเลี้ยว 2 จำนวน น้ำมันเครื่อง 1 จำนวน', '500', 'dp01', 'cs01');
INSERT INTO `useitem` VALUES ('002', 'ไฟเลี้ยว จำนวน 2 ราคา 400 ', '400', 'dp01', 'cs03');

-- ----------------------------
-- Procedure structure for test
-- ----------------------------
DROP PROCEDURE IF EXISTS `test`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `test`(IN teacher Varchar (300))
BEGIN
	SET @tnum := LENGTH(teacher)-LENGTH(REPLACE(teacher,',',''));
	SET @x:=1;
	WHILE @x  <= @tnum+1 DO
		SET @tn := SUBSTRING_INDEX(teacher,',',@x);
		IF ISNULL(@lastn) THEN
			SET @curt := @tn;
		ELSE
			SET @curt := REPLACE(REPLACE(@tn,@lastn,''),',','');
		END IF;
		#Insert data here.
		SELECT 'Insert',@curt;

		SET @lastn := @tn;
		SET  @x := @x + 1; 
	END WHILE;

END
;;
DELIMITER ;
