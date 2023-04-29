CREATE TABLE  `invoice_db`.`invoice` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `INVOICE_NO` int(11) NOT NULL,
  `INVOICE_DATE` date NOT NULL,
  `CNAME` varchar(50) NOT NULL,
  `CADDRESS` varchar(150) NOT NULL,
  `CCITY` varchar(50) NOT NULL,
  `GRAND_TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`SID`)
);

CREATE TABLE  `invoice_db`.`invoice_products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SID` int(11) NOT NULL,
  `PNAME` varchar(100) NOT NULL,
  `PRICE` double(10,2) NOT NULL,
  `QTY` int(11) NOT NULL,
  `TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`ID`)
);



-- NEW DATABASES 


-- Adminer 4.8.1 MySQL 10.4.24-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `devis`;
CREATE TABLE `devis` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `DEVIS_NO` int(11) NOT NULL,
  `DEVIS_DATE` date NOT NULL,
  `CNAME` varchar(50) NOT NULL,
  `CADDRESS` varchar(150) NOT NULL,
  `CCITY` varchar(50) NOT NULL,
  `GRAND_TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `devis` (`SID`, `DEVIS_NO`, `DEVIS_DATE`, `CNAME`, `CADDRESS`, `CCITY`, `GRAND_TOTAL`) VALUES
(1,	3,	'2023-04-26',	'FDFD',	'FDF',	'FDF',	99.00),
(6,	5,	'2023-04-18',	'YUNUS',	'GHG',	'AGHFVGN',	134.00);

DROP TABLE IF EXISTS `devis_products`;
CREATE TABLE `devis_products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SID` int(11) NOT NULL,
  `PNAME` varchar(100) NOT NULL,
  `PRICE` double(10,2) NOT NULL,
  `METRE` varchar(100) NOT NULL,
  `QTY` int(11) NOT NULL,
  `TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `devis_products` (`ID`, `SID`, `PNAME`, `PRICE`, `METRE`, `QTY`, `TOTAL`) VALUES
(1,	1,	'FDF',	3.00,	'',	33,	99.00);

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `INVOICE_NO` int(11) NOT NULL,
  `INVOICE_DATE` date NOT NULL,
  `CNAME` varchar(50) NOT NULL,
  `CADDRESS` varchar(150) NOT NULL,
  `CCITY` varchar(50) NOT NULL,
  `GRAND_TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `invoice` (`SID`, `INVOICE_NO`, `INVOICE_DATE`, `CNAME`, `CADDRESS`, `CCITY`, `GRAND_TOTAL`) VALUES
(2,	1,	'2023-04-15',	'Ahmet corumlu',	'impasse du croupillon',	'France',	13230.00),
(25,	4,	'2023-04-29',	'Yunus cobane',	'rue de la chaux',	'justtts ',	430.00);

DROP TABLE IF EXISTS `invoice_products`;
CREATE TABLE `invoice_products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SID` int(11) NOT NULL,
  `PNAME` varchar(100) NOT NULL,
  `PRICE` double(10,2) NOT NULL,
  `METRE` varchar(100) NOT NULL,
  `QTY` int(11) NOT NULL,
  `TOTAL` double(10,2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1,	'erhancoban',	'yunuscoban',	'2023-04-18 16:53:29'),
(2,	'admin2',	'$2y$10$yTsePv7w0cnpp0593pQsDeC5RwBpTkaaD9soYfsX3D6yG18pPHWe6',	'2023-04-18 16:56:46'),
(3,	'cobanerhan',	'$2y$10$Ffb9mEE/d7TzkmtvNA5jauZFg7v1ebKP7R6qkKnwAnyhz/1FTpq8a',	'2023-04-18 16:57:19');

-- 2023-04-29 09:32:48