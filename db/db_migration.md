# Database Migration — restaurant_db

## menus

```sql
CREATE TABLE `menus` (
  `ID`          INT(11)      NOT NULL AUTO_INCREMENT,
  `Name`        VARCHAR(128) NOT NULL,
  `DateCreated` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateDeleted` DATETIME     NULL     DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB;
```

> `DateDeleted` is **NULL** while the record is active.
> Soft-delete sets `DateDeleted = NOW()`; list queries filter `WHERE DateDeleted IS NULL`.

## products

```sql
CREATE TABLE `products` (
  `ID`        INT(11)      NOT NULL AUTO_INCREMENT,
  `name`      VARCHAR(128) NOT NULL,
  `price`     DECIMAL(5,2) NOT NULL,
  `imagePath` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB;
```

## menuproducts

```sql
CREATE TABLE `menuproducts` (
  `ID`        INT(11) NOT NULL AUTO_INCREMENT,
  `menuID`    INT(11) NOT NULL,
  `productID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `menuID`    (`menuID`),
  KEY `productID` (`productID`),
  CONSTRAINT `fk_mp_menu`    FOREIGN KEY (`menuID`)    REFERENCES `menus`    (`ID`) ON DELETE CASCADE,
  CONSTRAINT `fk_mp_product` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`) ON DELETE CASCADE
) ENGINE = InnoDB;
```
