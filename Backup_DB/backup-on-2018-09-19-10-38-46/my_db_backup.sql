#
# TABLE STRUCTURE FOR: account
#

DROP TABLE IF EXISTS account;

CREATE TABLE `account` (
  `accountid` int(100) NOT NULL AUTO_INCREMENT,
  `refid` int(30) NOT NULL,
  `oriamount` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `totalamount` double(15,2) NOT NULL,
  `customerid` int(30) NOT NULL,
  `datee` date NOT NULL,
  `interest` double(30,2) NOT NULL,
  `duedate` date NOT NULL,
  `packageid` int(30) NOT NULL,
  `agentid` int(30) NOT NULL,
  `packagetypeid` int(30) NOT NULL,
  `status` text NOT NULL,
  `companyid` int(30) NOT NULL,
  `guarantyitem` text NOT NULL,
  `agentcharge` double(30,2) NOT NULL,
  `accountline` int(11) NOT NULL,
  PRIMARY KEY (`accountid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (1, 1, '1200.00', '1200.00', '0.00', 2, '2018-07-19', '0.00', '2018-07-26', 4, 1, 3, 'closed', 2, '', '33.00', 1);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (2, 2, '1150.00', '1150.00', '0.00', 2, '2018-09-18', '0.00', '2018-09-25', 3, 0, 4, 'closed', 2, 'Silver Watch', '0.00', 1);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (3, 3, '2500.00', '0.00', '0.00', 2, '2018-08-21', '0.00', '2018-08-26', 4, 2, 9, 'closed', 2, '', '16.66', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (4, 3, '2500.00', '4300.00', '0.00', 2, '2018-08-26', '1800.00', '2018-08-31', 4, 2, 9, 'closed', 2, '', '16.66', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (5, 3, '2500.00', '250.00', '0.00', 2, '2018-08-31', '1300.00', '2018-09-05', 4, 2, 9, 'closed', 2, '', '16.66', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (6, 3, '2500.00', '250.00', '0.00', 2, '2018-09-05', '800.00', '2018-09-10', 4, 2, 9, 'closed', 2, '', '16.66', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (7, 4, '2300.00', '2300.00', '0.00', 2, '2018-09-18', '0.00', '2018-09-25', 4, 0, 4, 'closed', 2, '', '0.00', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (8, 5, '2300.00', '2300.00', '0.00', 2, '2018-09-18', '0.00', '2018-09-25', 4, 0, 4, 'closed', 2, '', '0.00', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (9, 6, '1400.00', '1400.00', '0.00', 2, '2018-07-31', '0.00', '2018-08-01', 4, 2, 8, 'closed', 2, '', '16.66', 3);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (11, 8, '1250.00', '350.00', '350.00', 2, '2018-09-19', '0.00', '2018-09-24', 3, 0, 9, '', 2, '', '0.00', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (10, 7, '2300.00', '2300.00', '0.00', 2, '2018-09-13', '0.00', '2018-09-20', 4, 1, 4, 'closed', 2, 'q\'we', '33.00', 4);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (12, 8, '1250.00', '350.00', '350.00', 2, '2018-09-24', '0.00', '2018-09-29', 3, 0, 9, '', 2, '', '0.00', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (13, 8, '1250.00', '350.00', '350.00', 2, '2018-09-29', '0.00', '2018-10-04', 3, 0, 9, '', 2, '', '0.00', 2);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`) VALUES (14, 8, '1250.00', '200.00', '200.00', 2, '2018-10-04', '0.00', '2018-10-09', 3, 0, 9, '', 2, '', '0.00', 2);


#
# TABLE STRUCTURE FOR: admin
#

DROP TABLE IF EXISTS admin;

CREATE TABLE `admin` (
  `adminid` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` tinytext NOT NULL,
  `campany` varchar(50) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO admin (`adminid`, `username`, `password`, `campany`) VALUES (1, 'admin', 'admin', 'admin');
INSERT INTO admin (`adminid`, `username`, `password`, `campany`) VALUES (2, 'frezzy96', '01325214', 'FrezzyCompany');
INSERT INTO admin (`adminid`, `username`, `password`, `campany`) VALUES (3, 'frezzy1', '01325214', 'MoneyX');


#
# TABLE STRUCTURE FOR: agent
#

DROP TABLE IF EXISTS agent;

CREATE TABLE `agent` (
  `agentid` int(100) NOT NULL AUTO_INCREMENT,
  `agentname` varchar(100) NOT NULL,
  `charge` double(10,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  `salary` double(30,2) NOT NULL,
  PRIMARY KEY (`agentid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO agent (`agentid`, `agentname`, `charge`, `companyid`, `salary`) VALUES (1, 'Agent A', '33.00', 2, '165.00');


#
# TABLE STRUCTURE FOR: agentpayment
#

DROP TABLE IF EXISTS agentpayment;

CREATE TABLE `agentpayment` (
  `paymentid` int(30) NOT NULL AUTO_INCREMENT,
  `agentid` int(30) NOT NULL,
  `payment` double(30,2) NOT NULL,
  `paymentdate` date NOT NULL,
  `refid` int(30) NOT NULL,
  PRIMARY KEY (`paymentid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (2, 2, '50.00', '2018-09-18', 3);
INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (3, 2, '60.00', '2018-09-18', 6);
INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (4, 2, '0.64', '2018-09-18', 6);
INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (5, 2, '3.30', '2018-09-18', 3);
INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (6, 1, '6.00', '2018-09-18', 1);
INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (7, 1, '9.00', '2018-09-18', 7);
INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (8, 1, '5.00', '2018-09-18', 1);


#
# TABLE STRUCTURE FOR: assistant
#

DROP TABLE IF EXISTS assistant;

CREATE TABLE `assistant` (
  `assisid` int(6) NOT NULL AUTO_INCREMENT,
  `assisname` varchar(50) NOT NULL,
  `customerid` int(6) NOT NULL,
  `charge` varchar(30) NOT NULL,
  `accountid` int(100) NOT NULL,
  `salary` double(10,2) NOT NULL,
  PRIMARY KEY (`assisid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: baddebt
#

DROP TABLE IF EXISTS baddebt;

CREATE TABLE `baddebt` (
  `baddebtid` int(100) NOT NULL AUTO_INCREMENT,
  `accountid` int(30) NOT NULL,
  `datee` date NOT NULL,
  PRIMARY KEY (`baddebtid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (1, 2, '1970-03-02');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (2, 3, '1970-03-02');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (3, 4, '1970-03-02');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (4, 5, '1970-03-02');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (5, 6, '2018-06-17');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (6, 7, '2018-07-09');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (7, 8, '2018-04-12');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (8, 9, '2018-04-19');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (9, 10, '2018-04-26');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (10, 11, '2018-05-03');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (11, 12, '2018-06-11');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (12, 14, '2018-08-15');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (13, 29, '2018-03-09');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (14, 30, '2018-03-09');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (15, 31, '2018-02-09');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (16, 32, '2018-02-09');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (17, 33, '2018-02-09');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (18, 34, '2018-03-18');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (19, 35, '2018-03-18');
INSERT INTO baddebt (`baddebtid`, `accountid`, `datee`) VALUES (20, 1, '2018-06-17');


#
# TABLE STRUCTURE FOR: blacklist
#

DROP TABLE IF EXISTS blacklist;

CREATE TABLE `blacklist` (
  `blacklistid` int(6) NOT NULL AUTO_INCREMENT,
  `customerid` int(6) NOT NULL,
  PRIMARY KEY (`blacklistid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: customer
#

DROP TABLE IF EXISTS customer;

CREATE TABLE `customer` (
  `customerid` int(6) NOT NULL AUTO_INCREMENT,
  `customername` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `phoneno` varchar(30) NOT NULL,
  `wechatname` text NOT NULL,
  `companyid` int(30) NOT NULL,
  `status` text NOT NULL,
  `passport` text NOT NULL,
  `photopath` text NOT NULL,
  `blacklist` int(11) NOT NULL,
  PRIMARY KEY (`customerid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO customer (`customerid`, `customername`, `address`, `gender`, `phoneno`, `wechatname`, `companyid`, `status`, `passport`, `photopath`, `blacklist`) VALUES (2, 'Lu Chow Ling', '51, Jalan Setia 12/19, Taman Setia Indah, 81100, JB', 'Male', '0127008141', 'Lu.', 2, '', 'qwe', 'http://127.0.0.1:52044/Image/Customer_Image/2.jpg', 0);
INSERT INTO customer (`customerid`, `customername`, `address`, `gender`, `phoneno`, `wechatname`, `companyid`, `status`, `passport`, `photopath`, `blacklist`) VALUES (3, 'Tan', '99, Jalan 99, Taman 99, JB', 'Male', '0138857748', 'TanG', 2, '', '', '', 0);
INSERT INTO customer (`customerid`, `customername`, `address`, `gender`, `phoneno`, `wechatname`, `companyid`, `status`, `passport`, `photopath`, `blacklist`) VALUES (4, 'qqww', 'qq', 'Male', '22', '11', 1, '', '', '', 0);
INSERT INTO customer (`customerid`, `customername`, `address`, `gender`, `phoneno`, `wechatname`, `companyid`, `status`, `passport`, `photopath`, `blacklist`) VALUES (5, 'qq', 'qq', 'Male', 'qq', '11', 1, '', '', '', 0);
INSERT INTO customer (`customerid`, `customername`, `address`, `gender`, `phoneno`, `wechatname`, `companyid`, `status`, `passport`, `photopath`, `blacklist`) VALUES (6, '22', 'qq', 'Male', 'qq', '11', 1, '', '', '', 0);


#
# TABLE STRUCTURE FOR: dbbackup
#

DROP TABLE IF EXISTS dbbackup;

CREATE TABLE `dbbackup` (
  `backupid` int(30) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`backupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: employee
#

DROP TABLE IF EXISTS employee;

CREATE TABLE `employee` (
  `employeeid` int(6) NOT NULL AUTO_INCREMENT,
  `employeename` varchar(50) NOT NULL,
  `salary` double(10,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`employeeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: package_10_5days
#

DROP TABLE IF EXISTS package_10_5days;

CREATE TABLE `package_10_5days` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO package_10_5days (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (5, '1000.00', '50.00', '1100.00', 1);
INSERT INTO package_10_5days (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (6, '2000.00', '100.00', '2200.00', 2);


#
# TABLE STRUCTURE FOR: package_15_5days
#

DROP TABLE IF EXISTS package_15_5days;

CREATE TABLE `package_15_5days` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO package_15_5days (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (5, '1000.00', '50.00', '1150.00', 1);
INSERT INTO package_15_5days (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (6, '2000.00', '100.00', '2300.00', 2);


#
# TABLE STRUCTURE FOR: package_15_week
#

DROP TABLE IF EXISTS package_15_week;

CREATE TABLE `package_15_week` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO package_15_week (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (2, '500.00', '50.00', '575.00', 2);
INSERT INTO package_15_week (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (3, '1000.00', '75.00', '1150.00', 2);
INSERT INTO package_15_week (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (4, '2000.00', '100.00', '2300.00', 2);


#
# TABLE STRUCTURE FOR: package_20_week
#

DROP TABLE IF EXISTS package_20_week;

CREATE TABLE `package_20_week` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO package_20_week (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (3, '500.00', '50.00', '600.00', 2);
INSERT INTO package_20_week (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (4, '1000.00', '75.00', '1200.00', 2);


#
# TABLE STRUCTURE FOR: package_25_month
#

DROP TABLE IF EXISTS package_25_month;

CREATE TABLE `package_25_month` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO package_25_month (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (2, '500.00', '10.00', '625.00', 2);


#
# TABLE STRUCTURE FOR: package_30_4week
#

DROP TABLE IF EXISTS package_30_4week;

CREATE TABLE `package_30_4week` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `week1` double(30,2) NOT NULL,
  `week2` double(30,2) NOT NULL,
  `week3` double(30,2) NOT NULL,
  `week4` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO package_30_4week (`packageid`, `lentamount`, `interest`, `totalamount`, `week1`, `week2`, `week3`, `week4`, `companyid`) VALUES (3, '1000.00', '50.00', '1300.00', '350.00', '350.00', '300.00', '300.00', 2);


#
# TABLE STRUCTURE FOR: package_manual_5days_4week
#

DROP TABLE IF EXISTS package_manual_5days_4week;

CREATE TABLE `package_manual_5days_4week` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `week1` double(30,2) NOT NULL,
  `week2` double(30,2) NOT NULL,
  `week3` double(30,2) NOT NULL,
  `week4` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO package_manual_5days_4week (`packageid`, `lentamount`, `interest`, `totalamount`, `week1`, `week2`, `week3`, `week4`, `companyid`) VALUES (3, '1000.00', '50.00', '1250.00', '350.00', '350.00', '350.00', '200.00', 2);
INSERT INTO package_manual_5days_4week (`packageid`, `lentamount`, `interest`, `totalamount`, `week1`, `week2`, `week3`, `week4`, `companyid`) VALUES (4, '2000.00', '100.00', '2500.00', '1000.00', '1000.00', '250.00', '250.00', 2);


#
# TABLE STRUCTURE FOR: package_manual_payeveryday_manualdays
#

DROP TABLE IF EXISTS package_manual_payeveryday_manualdays;

CREATE TABLE `package_manual_payeveryday_manualdays` (
  `packageid` int(30) NOT NULL AUTO_INCREMENT,
  `lentamount` double(30,2) NOT NULL,
  `interest` double(30,2) NOT NULL,
  `totalamount` double(30,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  `days` int(30) NOT NULL,
  `amounteveryday` double(30,2) NOT NULL,
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO package_manual_payeveryday_manualdays (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`, `days`, `amounteveryday`) VALUES (4, '1000.00', '50.00', '1400.00', 2, 20, '70.00');
INSERT INTO package_manual_payeveryday_manualdays (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`, `days`, `amounteveryday`) VALUES (5, '2000.00', '100.00', '2500.00', 2, 50, '50.00');


#
# TABLE STRUCTURE FOR: packagetype
#

DROP TABLE IF EXISTS packagetype;

CREATE TABLE `packagetype` (
  `packagetypeid` int(11) NOT NULL AUTO_INCREMENT,
  `packagetypename` varchar(100) NOT NULL,
  PRIMARY KEY (`packagetypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (1, 'package_30_4week');
INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (2, 'package_25_month');
INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (3, 'package_20_week');
INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (4, 'package_15_week');
INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (5, 'package_10_5days');
INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (6, 'package_15_5days');
INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (8, 'package_manual_payeveryday_manualdays');
INSERT INTO packagetype (`packagetypeid`, `packagetypename`) VALUES (9, 'package_manual_5days_4week');


#
# TABLE STRUCTURE FOR: payment
#

DROP TABLE IF EXISTS payment;

CREATE TABLE `payment` (
  `paymentid` int(100) NOT NULL AUTO_INCREMENT,
  `accountid` int(15) NOT NULL,
  `customername` text NOT NULL,
  `payment` double(10,2) NOT NULL,
  `paymenttype` text NOT NULL,
  `paymentdate` date NOT NULL,
  UNIQUE KEY `paymantid` (`paymentid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (1, 1, '', '1000.00', 'newpackage', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (2, 1, '', '150.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (3, 4, '', '2000.00', 'newpackage', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (4, 4, '', '1000.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (5, 4, '', '3100.00', 'discount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (6, 5, '', '1550.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (7, 6, '', '1050.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (8, 7, '', '2000.00', 'newpackage', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (9, 7, '', '300.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (10, 8, '', '2300.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (11, 9, '', '1400.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (12, 10, '', '2300.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (13, 1, '', '50.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (14, 2, '', '1150.00', 'amount', '2018-09-18');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (15, 3, '', '0.00', 'newpackage', '2018-09-19');


