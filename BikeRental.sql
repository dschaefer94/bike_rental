DROP TABLE IF EXISTS booking;
DROP TABLE IF EXISTS bike;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS storeLocation;
DROP TABLE IF EXISTS bikeType;

-- Aufgabe 1 a) & b)
CREATE TABLE storeLocation (
  id VARCHAR(36) PRIMARY KEY,
  street VARCHAR(100),
  postalCode INT(5),
  city VARCHAR(100)
);

CREATE TABLE bikeType (
  id VARCHAR(36) PRIMARY KEY,
  description VARCHAR(100),
  fee DECIMAL(6,2) DEFAULT 0
);

CREATE TABLE customer (
  id VARCHAR(36) PRIMARY KEY,
  customerNo VARCHAR(5) UNIQUE,
  firstname VARCHAR(150),
  lastname VARCHAR(150)
);

CREATE TABLE bike (
  id VARCHAR(36) PRIMARY KEY,
  bikeNo VARCHAR(4),
  damage varchar(1000) NULL,
  storeLocationId VARCHAR(36) REFERENCES storeLocation(id),
  bikeTypeId VARCHAR(36) REFERENCES bikeType(id)
);

CREATE TABLE booking (
  id VARCHAR(36) PRIMARY KEY,
  bookingDate DATE DEFAULT CURRENT_TIMESTAMP,
  pickupDate DATE,
  days TINYINT(2) CHECK (days BETWEEN 1 AND 14),
  customerId VARCHAR(36) REFERENCES customer(id),
  bikeId VARCHAR(36) REFERENCES bike(id)
);
-- Aufagbe 2: Befuellen der Tabellen
INSERT INTO storeLocation VALUES 
('0bb28278-d28a-11e7-b93f-2c4d544f8fe0', 'Ludgeristraße 100', 48143, 'Münster')
, ('1cb28278-d28a-11e7-b93f-2c4d544f8fe0', 'Große-Kurfürsten-Straße 12', 33602, 'Bielefeld');

INSERT INTO bikeType VALUES 
('d34b06f5-df64-11f0-9846-fc3497bf08e3', 'E-Bike', 10.00)
, ('e354b6c4-df64-11f0-9846-fc3497bf08e3', 'Trekkingrad', 6.99)
, ('f58b06d5-df64-11f0-9846-fc3497bf08e3', 'Lastenrad', 12.50);

INSERT INTO `bike`(`id`, `bikeNo`, `storeLocationId`, `bikeTypeId`) VALUES 
('a69496bd-df64-11f0-9846-fc3497bf08e3', 'LR01', '0bb28278-d28a-11e7-b93f-2c4d544f8fe0', 'd34b06f5-df64-11f0-9846-fc3497bf08e3')
, ('b42496bd-df64-11f0-9846-fc3497bf08e3', 'LR02', '0bb28278-d28a-11e7-b93f-2c4d544f8fe0', 'd34b06f5-df64-11f0-9846-fc3497bf08e3')
, ('c70496bd-df64-11f0-9846-fc3497bf08e3', 'E001', '0bb28278-d28a-11e7-b93f-2c4d544f8fe0', 'd34b06f5-df64-11f0-9846-fc3497bf08e3')
, ('d63496bd-df64-11f0-9846-fc3497bf08e3', 'E002', '0bb28278-d28a-11e7-b93f-2c4d544f8fe0', 'd34b06f5-df64-11f0-9846-fc3497bf08e3')
, ('e87496bd-df64-11f0-9846-fc3497bf08e3', 'E003', '1cb28278-d28a-11e7-b93f-2c4d544f8fe0', 'd34b06f5-df64-11f0-9846-fc3497bf08e3')
, ('a94496bd-df64-11f0-9846-fc3497bf08e3', 'E004', '1cb28278-d28a-11e7-b93f-2c4d544f8fe0', 'd34b06f5-df64-11f0-9846-fc3497bf08e3')
, ('f32496bd-df64-11f0-9846-fc3497bf08e3', 'TR01', '1cb28278-d28a-11e7-b93f-2c4d544f8fe0', 'e354b6c4-df64-11f0-9846-fc3497bf08e3')
, ('b56496bd-df64-11f0-9846-fc3497bf08e3', 'TR02', '1cb28278-d28a-11e7-b93f-2c4d544f8fe0', 'e354b6c4-df64-11f0-9846-fc3497bf08e3');

INSERT INTO customer VALUES 
('xx-deleted-customer-xx', 'dxxx', 'Deleted', 'Deleted')
, ('0236c075-df64-11f0-9846-fc3497bf08e3', 'B-001', 'Fiona', 'Flott')
, ('5136b065-df64-11f0-9846-fc3497bf08e3', 'B-002', 'Timo', 'Tritt')
, ('3126d034-df64-11f0-9846-fc3497bf08e3', 'M-001', 'Sonja', 'Sattel');

INSERT INTO booking (`id`, `pickupDate`, `days`, `customerId`, `bikeId`) VALUES 
('2ae54efb-df67-11f0-9846-fc3497bf08e3', DATE '2026-06-27', 3, '0236c075-df64-11f0-9846-fc3497bf08e3', 'f32496bd-df64-11f0-9846-fc3497bf08e3') -- TR01
, ('03d2f688-df68-11f0-9846-fc3497bf08e3', DATE '2026-07-04', 1, '0236c075-df64-11f0-9846-fc3497bf08e3', 'a69496bd-df64-11f0-9846-fc3497bf08e3') -- LR01
, ('02d2f688-af68-12f0-9046-fd3497bf18e3', DATE '2026-06-26', 7, '3126d034-df64-11f0-9846-fc3497bf08e3', 'c70496bd-df64-11f0-9846-fc3497bf08e3'); -- E001
