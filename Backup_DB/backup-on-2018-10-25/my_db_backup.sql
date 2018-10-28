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
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `companyid` int(30) NOT NULL,
  `guarantyitem` text COLLATE utf8_unicode_ci NOT NULL,
  `agentcharge` double(30,2) NOT NULL,
  `accountline` int(11) NOT NULL,
  `homeremind` text COLLATE utf8_unicode_ci NOT NULL,
  `readytorun` int(30) NOT NULL,
  `pullnextperiod` int(10) NOT NULL,
  PRIMARY KEY (`accountid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (1, 1, '1300.00', '350.00', '350.00', 1, '2018-10-24', '0.00', '2018-10-31', 1, 0, 1, ' ', 1, '', '0.00', 1, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (2, 1, '1300.00', '350.00', '350.00', 1, '2018-10-31', '0.00', '2018-11-07', 1, 0, 1, ' ', 1, '', '0.00', 1, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (3, 1, '1300.00', '300.00', '300.00', 1, '2018-11-07', '0.00', '2018-11-14', 1, 0, 1, ' ', 1, '', '0.00', 1, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (4, 1, '1300.00', '300.00', '300.00', 1, '2018-11-14', '0.00', '2018-11-21', 1, 0, 1, ' ', 1, '', '0.00', 1, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (5, 2, '1250.00', '1250.00', '0.00', 1, '2018-10-09', '0.00', '2018-11-09', 1, 1, 2, 'closed', 1, '', '33.33', 2, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (6, 3, '1300.00', '350.00', '0.00', 1, '2018-10-24', '0.00', '2018-10-31', 1, 0, 1, 'closed', 1, '', '0.00', 2, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (7, 3, '1300.00', '350.00', '0.00', 1, '2018-10-31', '0.00', '2018-11-07', 1, 0, 1, 'closed', 1, '', '0.00', 2, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (8, 3, '1300.00', '300.00', '0.00', 1, '2018-11-07', '0.00', '2018-11-14', 1, 0, 1, 'closed', 1, '', '0.00', 2, '', 0, 0);
INSERT INTO account (`accountid`, `refid`, `oriamount`, `amount`, `totalamount`, `customerid`, `datee`, `interest`, `duedate`, `packageid`, `agentid`, `packagetypeid`, `status`, `companyid`, `guarantyitem`, `agentcharge`, `accountline`, `homeremind`, `readytorun`, `pullnextperiod`) VALUES (9, 3, '1300.00', '300.00', '0.00', 1, '2018-11-14', '0.00', '2018-11-21', 1, 0, 1, 'closed', 1, '', '0.00', 2, '', 0, 0);


#
# TABLE STRUCTURE FOR: admin
#

DROP TABLE IF EXISTS admin;

CREATE TABLE `admin` (
  `adminid` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO admin (`adminid`, `username`, `password`, `company`) VALUES (1, 'admin', 'admin', 'Admin');
INSERT INTO admin (`adminid`, `username`, `password`, `company`) VALUES (2, 'qwe', 'qwe', '');
INSERT INTO admin (`adminid`, `username`, `password`, `company`) VALUES (3, 'jimmy', '123456', 'Jimmy');


#
# TABLE STRUCTURE FOR: agent
#

DROP TABLE IF EXISTS agent;

CREATE TABLE `agent` (
  `agentid` int(100) NOT NULL AUTO_INCREMENT,
  `agentname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `charge` double(10,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  `salary` double(30,2) NOT NULL,
  PRIMARY KEY (`agentid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO agent (`agentid`, `agentname`, `charge`, `companyid`, `salary`) VALUES (1, 'qqqqw', '33.33', 1, '83.33');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO agentpayment (`paymentid`, `agentid`, `payment`, `paymentdate`, `refid`) VALUES (1, 1, '83.33', '2018-10-24', 2);


#
# TABLE STRUCTURE FOR: assistant
#

DROP TABLE IF EXISTS assistant;

CREATE TABLE `assistant` (
  `assisid` int(6) NOT NULL AUTO_INCREMENT,
  `assisname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `customerid` int(6) NOT NULL,
  `charge` varchar(30) CHARACTER SET latin1 NOT NULL,
  `accountid` int(100) NOT NULL,
  `salary` double(10,2) NOT NULL,
  PRIMARY KEY (`assisid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: baddebt
#

DROP TABLE IF EXISTS baddebt;

CREATE TABLE `baddebt` (
  `baddebtid` int(100) NOT NULL AUTO_INCREMENT,
  `accountid` int(30) NOT NULL,
  PRIMARY KEY (`baddebtid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: bank
#

DROP TABLE IF EXISTS bank;

CREATE TABLE `bank` (
  `bookid` int(30) NOT NULL AUTO_INCREMENT,
  `bank` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,2) NOT NULL,
  `datee` date NOT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO bank (`bookid`, `bank`, `description`, `type`, `amount`, `datee`) VALUES (1, 'pbb', 'Amy', 'receive', '350.00', '2018-10-24');
INSERT INTO bank (`bookid`, `bank`, `description`, `type`, `amount`, `datee`) VALUES (2, 'hlb', 'qqq', 'receive', '200.00', '2018-10-24');


#
# TABLE STRUCTURE FOR: blacklist
#

DROP TABLE IF EXISTS blacklist;

CREATE TABLE `blacklist` (
  `blacklistid` int(6) NOT NULL AUTO_INCREMENT,
  `customerid` int(6) NOT NULL,
  PRIMARY KEY (`blacklistid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: coh
#

DROP TABLE IF EXISTS coh;

CREATE TABLE `coh` (
  `bookid` int(30) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,2) NOT NULL,
  `datee` date NOT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO coh (`bookid`, `title`, `description`, `type`, `amount`, `datee`) VALUES (1, '', '', '', '300000.00', '2018-10-24');
INSERT INTO coh (`bookid`, `title`, `description`, `type`, `amount`, `datee`) VALUES (2, '', '', '', '250000.00', '2018-10-24');


#
# TABLE STRUCTURE FOR: customer
#

DROP TABLE IF EXISTS customer;

CREATE TABLE `customer` (
  `customerid` int(6) NOT NULL AUTO_INCREMENT,
  `customername` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phoneno` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `wechatname` text COLLATE utf8_unicode_ci NOT NULL,
  `companyid` int(30) NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `passport` text COLLATE utf8_unicode_ci NOT NULL,
  `photopath` text COLLATE utf8_unicode_ci NOT NULL,
  `blacklist` int(11) NOT NULL,
  `reset` int(15) NOT NULL,
  `re-date` date NOT NULL,
  PRIMARY KEY (`customerid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO customer (`customerid`, `customername`, `address`, `gender`, `phoneno`, `wechatname`, `companyid`, `status`, `passport`, `photopath`, `blacklist`, `reset`, `re-date`) VALUES (1, 'Lu CHow Ling', 'test', 'Male', '0127008141', 'Lu', 1, 'good', '9999996666', '', 0, 0, '0000-00-00');


#
# TABLE STRUCTURE FOR: dbbackup
#

DROP TABLE IF EXISTS dbbackup;

CREATE TABLE `dbbackup` (
  `backupid` int(30) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`backupid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO dbbackup (`backupid`, `date`) VALUES (1, '2018-10-10');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (2, '2018-10-16');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (3, '2018-10-17');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (4, '2018-10-18');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (5, '2018-10-19');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (6, '2018-10-20');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (7, '2018-10-21');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (8, '2018-10-22');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (9, '2018-10-23');
INSERT INTO dbbackup (`backupid`, `date`) VALUES (10, '2018-10-24');


#
# TABLE STRUCTURE FOR: emp
#

DROP TABLE IF EXISTS emp;

CREATE TABLE `emp` (
  `bookid` int(30) NOT NULL AUTO_INCREMENT,
  `employee` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,2) NOT NULL,
  `datee` date NOT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: employee
#

DROP TABLE IF EXISTS employee;

CREATE TABLE `employee` (
  `employeeid` int(6) NOT NULL AUTO_INCREMENT,
  `employeename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `salary` double(10,2) NOT NULL,
  `companyid` int(30) NOT NULL,
  `contactnum` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`employeeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: expenses
#

DROP TABLE IF EXISTS expenses;

CREATE TABLE `expenses` (
  `expensesid` int(30) NOT NULL AUTO_INCREMENT,
  `expensesitem` text COLLATE utf8_unicode_ci NOT NULL,
  `expensesfee` double(30,2) NOT NULL,
  `expensesdate` date NOT NULL,
  `companyid` int(30) NOT NULL,
  PRIMARY KEY (`expensesid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_10_5days (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (1, '1000.00', '40.00', '1100.00', 1);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_15_5days (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (1, '1000.00', '40.00', '1150.00', 1);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_15_week (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (1, '1000.00', '50.00', '1150.00', 1);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_20_week (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (1, '1000.00', '50.00', '1200.00', 1);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_25_month (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`) VALUES (1, '1000.00', '10.00', '1250.00', 1);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_30_4week (`packageid`, `lentamount`, `interest`, `totalamount`, `week1`, `week2`, `week3`, `week4`, `companyid`) VALUES (1, '1000.00', '50.00', '1300.00', '350.00', '350.00', '300.00', '300.00', 1);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_manual_5days_4week (`packageid`, `lentamount`, `interest`, `totalamount`, `week1`, `week2`, `week3`, `week4`, `companyid`) VALUES (1, '1000.00', '50.00', '1250.00', '350.00', '300.00', '300.00', '300.00', 1);


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO package_manual_payeveryday_manualdays (`packageid`, `lentamount`, `interest`, `totalamount`, `companyid`, `days`, `amounteveryday`) VALUES (1, '1000.00', '50.00', '1200.00', 1, 20, '60.00');


#
# TABLE STRUCTURE FOR: packagetype
#

DROP TABLE IF EXISTS packagetype;

CREATE TABLE `packagetype` (
  `packagetypeid` int(11) NOT NULL AUTO_INCREMENT,
  `packagetypename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`packagetypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `customername` text COLLATE utf8_unicode_ci NOT NULL,
  `payment` double(10,2) NOT NULL,
  `paymenttype` text COLLATE utf8_unicode_ci NOT NULL,
  `paymentdate` date NOT NULL,
  UNIQUE KEY `paymantid` (`paymentid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (1, 5, '', '100.00', 'amount', '2018-10-24');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (2, 5, '', '1000.00', 'newpackage', '2018-10-24');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (3, 5, '', '150.00', 'amount', '2018-10-24');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (4, 6, '', '350.00', 'amount', '2018-10-24');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (5, 7, '', '350.00', 'amount', '2018-10-24');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (6, 8, '', '300.00', 'amount', '2018-10-24');
INSERT INTO payment (`paymentid`, `accountid`, `customername`, `payment`, `paymenttype`, `paymentdate`) VALUES (7, 9, '', '300.00', 'amount', '2018-10-24');


#
# TABLE STRUCTURE FOR: total
#

DROP TABLE IF EXISTS total;

CREATE TABLE `total` (
  `bookid` int(30) NOT NULL AUTO_INCREMENT,
  `bank` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(15,2) NOT NULL,
  `datee` date NOT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO total (`bookid`, `bank`, `description`, `type`, `amount`, `datee`) VALUES (1, 'mbb', 'Amy', 'credit', '350.00', '2018-10-24');
INSERT INTO total (`bookid`, `bank`, `description`, `type`, `amount`, `datee`) VALUES (2, 'mbb', 'qwe', 'debit', '100.00', '2018-10-15');


