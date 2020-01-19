-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 12:56 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
create database `loan_app`;
  use loan_app;
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `transactionid` int(20) NOT NULL,
  `transactionamt` int(20) DEFAULT NULL,
  `trandoneby` int(20) DEFAULT NULL,
  `transactiontype` varchar(20) NOT NULL,
  `transactiondate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `account`
--
DELIMITER $$
CREATE TRIGGER `acctrigg` AFTER INSERT ON `account` FOR EACH ROW BEGIN
SET @tid = (SELECT `balance` FROM `tracktransaction` WHERE `tranuserId` = NEW.trandoneby);
IF(@tid > 0 AND NEW.transactiontype = "deposite")
THEN
UPDATE `tracktransaction` SET `balance`= NEW.transactionamt + @tid, `transDate`= now() WHERE `tranuserId` = NEW.trandoneby;

ELSEIF(@tid > 0 AND NEW.transactiontype = "withdraw")
THEN
UPDATE `tracktransaction` SET `balance`= @tid - NEW.transactionamt, `transDate`= now() WHERE `tranuserId` = NEW.trandoneby;

ELSE
INSERT INTO `tracktransaction`(`tranuserId`, `balance`, `transDate`) VALUES (NEW.trandoneby, NEW.transactionamt, now());

END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `applyloan`
--

CREATE TABLE `applyloan` (
  `LoanId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `AccountNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `loan_amount` int(5) NOT NULL,
  `loan_limit` int(5) NOT NULL,
  `payment_date` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `max` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sms_status` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reciever` int(12) NOT NULL,
  `sender` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatters`
--

CREATE TABLE `chatters` (
  `chatlinkingId` int(12) NOT NULL,
  `user1_Id` int(15) NOT NULL,
  `user2_Id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chatters`
--

INSERT INTO `chatters` (`chatlinkingId`, `user1_Id`, `user2_Id`) VALUES
(19, 1017856, 3453),
(22, 3269123, 1017856),
(23, 888, 47309);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `AccountNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guarantor`
--

CREATE TABLE `guarantor` (
  `GuarantorId` int(20) NOT NULL,
  `GuarantorName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `LoanId` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Commision` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loanapplication`
--

CREATE TABLE `loanapplication` (
  `appId` int(10) NOT NULL,
  `gNationalId` int(15) DEFAULT NULL,
  `loanAmt` int(20) DEFAULT NULL,
  `AppReason` varchar(150) DEFAULT NULL,
  `AppDoneBy` int(15) DEFAULT NULL,
  `Gfeedback` varchar(15) NOT NULL DEFAULT 'pending',
  `loanGiversFBack` varchar(15) NOT NULL DEFAULT 'pending',
  `appDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `Nationalid` int(8) NOT NULL,
  `First` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Last` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `YOB` date NOT NULL,
  `Email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `pass1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`Nationalid`, `First`, `Last`, `YOB`, `Email`, `phone`, `pass1`, `type`) VALUES
(888, '94837', '8924', '2018-10-14', 'jgkdg', 7097094, '202cb962ac59075b964b07152d234b70', 1),
(3453, 'Pam', 'manscm', '2018-10-10', 'xzncljkdshjakhcoi', 4875837, '202cb962ac59075b964b07152d234b70', 0),
(12345, 'John', 'Wanyonyi', '2018-10-16', '', 722000000, 'e10adc3949ba59abbe56e057f20f883e', 0),
(47309, 'Penny', 'Accapella', '2018-10-16', 'kldhlkjfgv', 814375089, '202cb962ac59075b964b07152d234b70', 0),
(89665, '12', '456', '2018-10-15', 'daniel.simiyu@strathmore.', 722000054, 'b1fa0218c1040b082e2374a941707c35', 1),
(456789, 'kelly', 'ineza', '1997-02-28', 'ikellybertile@gmail.com', 705218742, 'f49c2af8d476dc5ebf746ed0dbf16287', 1),
(1017856, 'Dan', 'Oyugis', '2018-10-10', 'dan@gmail.com', 709988765, '202cb962ac59075b964b07152d234b70', 1),
(1234567, 'sindayikengera', 'Lily', '1998-01-29', 'lilysindayikengera@strath', 707593552, 'c6d1592b6f0712579e888f09cb2cfbdb', 1),
(3269123, 'Danny', 'Dan', '1890-03-25', 'dan@gmail.com', 708965432, 'e807f1fcf82d132f9bb018ca6738a19f', 0),
(35608223, 'Daniel', 'Simiyu', '0000-00-00', 'daniel.simiyu@strathmore.', 2147483647, '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tracktransaction`
--

CREATE TABLE `tracktransaction` (
  `trackId` int(12) NOT NULL,
  `tranuserId` int(12) DEFAULT NULL,
  `balance` float DEFAULT '0',
  `transDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`transactionid`),
  ADD KEY `trandoneby` (`trandoneby`);

--
-- Indexes for table `applyloan`
--
ALTER TABLE `applyloan`
  ADD PRIMARY KEY (`LoanId`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `chatters`
--
ALTER TABLE `chatters`
  ADD PRIMARY KEY (`chatlinkingId`),
  ADD KEY `user1_Id` (`user1_Id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`AccountNumber`);

--
-- Indexes for table `guarantor`
--
ALTER TABLE `guarantor`
  ADD PRIMARY KEY (`GuarantorId`);

--
-- Indexes for table `loanapplication`
--
ALTER TABLE `loanapplication`
  ADD PRIMARY KEY (`appId`),
  ADD KEY `gNationalId` (`gNationalId`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`Nationalid`);

--
-- Indexes for table `tracktransaction`
--
ALTER TABLE `tracktransaction`
  ADD PRIMARY KEY (`trackId`),
  ADD KEY `tranuserId` (`tranuserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `transactionid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `chatters`
--
ALTER TABLE `chatters`
  MODIFY `chatlinkingId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `loanapplication`
--
ALTER TABLE `loanapplication`
  MODIFY `appId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tracktransaction`
--
ALTER TABLE `tracktransaction`
  MODIFY `trackId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`trandoneby`) REFERENCES `signup` (`Nationalid`);

--
-- Constraints for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD CONSTRAINT `chatroom_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `signup` (`Nationalid`);

--
-- Constraints for table `chatters`
--
ALTER TABLE `chatters`
  ADD CONSTRAINT `chatters_ibfk_1` FOREIGN KEY (`user1_Id`) REFERENCES `signup` (`Nationalid`);

--
-- Constraints for table `guarantor`
--
ALTER TABLE `guarantor`
  ADD CONSTRAINT `guarantor_ibfk_1` FOREIGN KEY (`GuarantorId`) REFERENCES `signup` (`Nationalid`);

--
-- Constraints for table `loanapplication`
--
ALTER TABLE `loanapplication`
  ADD CONSTRAINT `loanapplication_ibfk_1` FOREIGN KEY (`gNationalId`) REFERENCES `signup` (`Nationalid`);

--
-- Constraints for table `tracktransaction`
--
ALTER TABLE `tracktransaction`
  ADD CONSTRAINT `tracktransaction_ibfk_1` FOREIGN KEY (`tranuserId`) REFERENCES `account` (`transactionid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
