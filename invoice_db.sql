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