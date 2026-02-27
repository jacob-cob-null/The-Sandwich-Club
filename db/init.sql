-- The Sandwich Club initial database schema
-- This file is auto-executed by MySQL on first container start.

-- init restaurant_db

CREATE DATABASE IF NOT EXISTS `restaurant_db`;
USE `restaurant_db`;

-- menus table

CREATE TABLE IF NOT EXISTS `menus` (
  `ID`          INT(11)      NOT NULL AUTO_INCREMENT,
  `Name`        VARCHAR(128) NOT NULL,
  `DateCreated` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateDeleted` DATETIME     NULL     DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

-- products table

CREATE TABLE IF NOT EXISTS `products` (
  `ID`          INT(11)       NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(128)  NOT NULL,
  `price`       DECIMAL(5,2)  NOT NULL,
  `imagePath`   VARCHAR(255)  NULL     DEFAULT NULL,
  `DateCreated` DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateDeleted` DATETIME      NULL     DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

-- products table = menus + products

CREATE TABLE IF NOT EXISTS `menuproducts` (
  `ID`        INT(11) NOT NULL AUTO_INCREMENT,
  `menuID`    INT(11) NOT NULL,
  `productID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `menuID`    (`menuID`),
  KEY `productID` (`productID`),
  CONSTRAINT `fk_mp_menu`    FOREIGN KEY (`menuID`)    REFERENCES `menus`    (`ID`) ON DELETE CASCADE,
  CONSTRAINT `fk_mp_product` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`) ON DELETE CASCADE
) ENGINE = InnoDB;
