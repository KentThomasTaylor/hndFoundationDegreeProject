-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2019 at 10:43 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

DROP TABLE IF EXISTS `tblorders`;
CREATE TABLE IF NOT EXISTS `tblorders` (
  `orderID` int(12) NOT NULL AUTO_INCREMENT,
  `ID` int(12) NOT NULL,
  `useracclogid` int(12) NOT NULL,
  `ccid` int(12) NOT NULL,
  `productid` int(12) NOT NULL,
  `ordertime` varchar(20) NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `ID` (`ID`),
  KEY `useracclogid` (`useracclogid`),
  KEY `ccid` (`ccid`),
  KEY `productid` (`productid`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`orderID`, `ID`, `useracclogid`, `ccid`, `productid`, `ordertime`) VALUES
(35, 2, 9, 1, 87, '02-06-19 23:28:41'),
(33, 25, 14, 4, 81, '01-06-19 20:23:28'),
(32, 2, 9, 3, 82, '01-06-19 18:03:04'),
(34, 2, 13, 3, 81, '02-06-19 23:11:53'),
(30, 2, 13, 1, 84, '01-06-19 18:02:20'),
(29, 2, 13, 1, 82, '01-06-19 18:02:20'),
(28, 2, 9, 1, 87, '01-06-19 18:01:49'),
(36, 29, 15, 5, 81, '05-06-19 11:31:24'),
(37, 29, 15, 5, 88, '05-06-19 11:31:24'),
(38, 29, 15, 5, 89, '05-06-19 11:31:24'),
(39, 30, 16, 6, 83, '06-06-19 10:56:32'),
(40, 30, 16, 6, 89, '06-06-19 10:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

DROP TABLE IF EXISTS `tblproducts`;
CREATE TABLE IF NOT EXISTS `tblproducts` (
  `productID` int(12) NOT NULL AUTO_INCREMENT,
  `productName` varchar(30) NOT NULL,
  `productPrice` varchar(10) NOT NULL,
  `productDescription` varchar(255) NOT NULL,
  `productCategory` varchar(20) NOT NULL,
  `prodImage` varchar(100) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`productID`, `productName`, `productPrice`, `productDescription`, `productCategory`, `prodImage`) VALUES
(94, 'Apple Earphones', '9.99', 'Genuine Apple earphones for Apple devices', 'electronics', '4d15c13a6c460ee60b16aa21cb7f8939.jpg'),
(93, 'iPhone Charger', '9.99', 'Genuine Apple lightning cable for Apple devices', 'electronics', 'b0dbb2a6320cf6856200a62d289b727b.jpg'),
(92, 'iPad Mini', '899', 'iPad Mini, 128 GB', 'electronics', '9c92a568004e47b8758cb53a7e93078e.jfif'),
(90, 'iPhone 8', '599', 'iPhone 8, 256 GB', 'electronics', '57d9209fe509f4f879cc0fc3a84536b9.png'),
(91, 'iPhone x', '999', 'iPhone 10, 64 GB', 'electronics', '567d19540e30980fea06e59d7931818a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbltempbasket`
--

DROP TABLE IF EXISTS `tbltempbasket`;
CREATE TABLE IF NOT EXISTS `tbltempbasket` (
  `tempBasketID` int(12) NOT NULL AUTO_INCREMENT,
  `id` int(12) NOT NULL,
  `productID` int(12) NOT NULL,
  PRIMARY KEY (`tempBasketID`),
  KEY `id` (`id`),
  KEY `productID` (`productID`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltempbasket`
--

INSERT INTO `tbltempbasket` (`tempBasketID`, `id`, `productID`) VALUES
(237, 30, 83),
(236, 30, 81),
(238, 30, 87),
(239, 30, 88);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `useracclogid` int(12) NOT NULL AUTO_INCREMENT,
  `id` int(12) NOT NULL,
  `userFname` varchar(20) NOT NULL,
  `userLname` varchar(25) NOT NULL,
  `userAddLine1` varchar(25) NOT NULL,
  `userAddLine2` varchar(25) NOT NULL,
  `userTown` varchar(60) NOT NULL,
  `userCity` varchar(60) NOT NULL,
  `userPcode` varchar(10) NOT NULL,
  `userMobile` text NOT NULL,
  `userDoB` varchar(10) NOT NULL,
  PRIMARY KEY (`useracclogid`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`useracclogid`, `id`, `userFname`, `userLname`, `userAddLine1`, `userAddLine2`, `userTown`, `userCity`, `userPcode`, `userMobile`, `userDoB`) VALUES
(9, 2, 'John', 'Smith', '31 Oxtail Rd', 'Danke St', 'Tameside', 'GM', 'OL6XUA', '07777777777', '01-01-1990'),
(13, 2, 'John', 'Smith', '8 Eiling House', 'Road Close', 'Ashton', 'Manchester', 'OL67WQ', '07283546287', '01-01-2000'),
(14, 25, 'Megan', 'Seel', '21 Danking Road', '', 'Bolton', 'GM', 'BL12RU', '07384625374', '01-01-2000'),
(15, 29, 'fdsafd', 'sfdafsd', 'sfdasfdasfd', 'fsdfdsfda', 'sfdsfdsfd', 'sfdasfdfsd', 'BL11BB', '07283648263', '01-01-01'),
(16, 30, 'john', 'doe', '23 fghgfhfdg', '', 'tameside', 'manchester', 'bl12hd', '07458658745', '01-01-00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusercc`
--

DROP TABLE IF EXISTS `tblusercc`;
CREATE TABLE IF NOT EXISTS `tblusercc` (
  `ccid` int(12) NOT NULL AUTO_INCREMENT,
  `id` int(12) NOT NULL,
  `ccnumber` varchar(16) NOT NULL,
  `ccexdate` varchar(10) NOT NULL,
  `cccvv` int(3) NOT NULL,
  PRIMARY KEY (`ccid`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusercc`
--

INSERT INTO `tblusercc` (`ccid`, `id`, `ccnumber`, `ccexdate`, `cccvv`) VALUES
(1, 2, '1111111111111111', '01/20', 154),
(3, 2, '0162826374658126', '01/22', 321),
(4, 25, '0156895473325894', '01/29', 185),
(5, 29, '0162738451628364', '01/30', 375),
(6, 30, '0182734619273516', '01/22', 123);

-- --------------------------------------------------------

--
-- Table structure for table `tbluserloginlog`
--

DROP TABLE IF EXISTS `tbluserloginlog`;
CREATE TABLE IF NOT EXISTS `tbluserloginlog` (
  `userLoginLogID` int(12) NOT NULL AUTO_INCREMENT,
  `logIP` varchar(20) NOT NULL,
  `id` int(12) NOT NULL,
  `time` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`userLoginLogID`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserloginlog`
--

INSERT INTO `tbluserloginlog` (`userLoginLogID`, `logIP`, `id`, `time`) VALUES
(110, '::1', 2, '2019-05-12 03:12:00.702073'),
(109, '127.0.0.1', 2, '2019-05-12 03:12:00.702073'),
(108, '::1', 3, '2019-05-12 03:12:00.702073'),
(111, '::1', 2, '2019-05-12 03:12:19.411191'),
(112, '::1', 3, '2019-05-12 03:14:34.447736'),
(113, '127.0.0.1', 3, '2019-05-12 16:25:14.726888'),
(114, '::1', 3, '2019-05-12 16:26:03.763374'),
(115, '127.0.0.1', 3, '2019-05-12 17:35:32.029426'),
(116, '::1', 3, '2019-05-12 23:22:22.302605'),
(117, '127.0.0.1', 3, '2019-05-12 23:29:27.186949'),
(118, '::1', 3, '2019-05-16 09:58:22.281660'),
(119, '::1', 3, '2019-05-16 10:03:35.098660'),
(120, '::1', 3, '2019-05-16 11:11:50.463660'),
(121, '::1', 3, '2019-05-16 11:19:41.422660'),
(122, '::1', 3, '2019-05-16 11:25:19.316084'),
(123, '::1', 3, '2019-05-23 10:59:11.360827'),
(124, '::1', 25, '2019-06-01 20:20:10.625769'),
(125, '::1', 27, '2019-06-02 19:34:07.945547'),
(126, '127.0.0.1', 27, '2019-06-02 19:34:28.383114'),
(127, '::1', 29, '2019-06-05 11:29:17.042000'),
(128, '::1', 30, '2019-06-06 10:53:24.500974');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(17, 'randtestacc1', 'randtestacc1@a.a', 'user', '7c5c14da8e45366fa039f4ba6554f319'),
(2, 'admin', 'admin@wf.com', 'admin', '7c6a180b36896a0a8c02787eeafb0e4c'),
(3, 'user', 'email@outlook.com', 'user', 'dc647eb65e6711e155375218212b3964'),
(27, 'testaccount18436423', 'testaccount18436423@gmail.com', 'user', '3d7afbef6daf48554627ed3a37d8e28c'),
(19, 'randtestacc3', 'randtestacc3@a.a', 'user', 'fde83511b417bf7e9db853f27f512270'),
(18, 'randtestacc2', 'randtestacc2@a.a', 'user', 'af03fa5ceb0230ba3d9236cdc819d582'),
(26, 'testaccount184364', 'testaccount184364@gmail.com', 'user', 'f63d8c0193b6491b2013e6fbf548db0a'),
(21, 'fgdsfgds', 'fgdgdfs@dfgsdgfs.jp', 'user', 'b9f8fa6f36e5a3e5a929279916741140'),
(22, 'ShmellySmith', 'shmellysmith123@gmail.com', 'user', '42f749ade7f9e195bf475f37a44cafcb'),
(23, 'dfsihukdfg89', 'dsfgfdsg@outlook.com', 'user', '4c3558965d617a369951e5904f98b2a1'),
(24, 'testaccount8357', 'sdgfgfdsgsg@Sdfg.jp', 'user', '8daebbfb9bb78104682b692ea4d40f5f'),
(25, 'testacc09435hjk', 'testacc09435hjk@fgd.hp', 'user', '1faa8eb244183c3eb012609282493f06'),
(28, 'administrator', 'administrator@localshopper.com', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99'),
(29, 'testacc1234554321', 'testacc1234554321@sfdfds.gp', 'user', 'e679dd36947384dfc9bf248205266d5a'),
(30, 'asfd98sfda', 'asfd98sfda@outlook.com', 'user', '1835ef0fa4bb1926e4d08fb8d245112a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
