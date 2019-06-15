CREATE DATABASE IF NOT EXISTS `forge` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `forge`;

CREATE TABLE `projects` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `plastic` varchar(10),
  `amount` varchar(50),
  `plasticColor` varchar(50),
  `plasticBrand` varchar(255),
  `printTemp` int(10),
  `payment` float,
  `machine` varchar(50) NOT NULL,
  `forClass` BOOLEAN,
  `startTime` DATETIME NOT NULL,
  `eta` DATETIME,
  `endTime` DATETIME,
  `success` BOOLEAN,
  `timesFailed` int,
  `userID` int NOT NULL,
  `userInitials` varchar(10),
  PRIMARY KEY (`pid`)
);


CREATE TABLE `hardware` (
  `inUse` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `machineName` varchar(50)  NOT NULL,
  `usesPlastic` tinyint(1) DEFAULT NULL,
  `multiple_extrusion` tinyint(1) DEFAULT NULL,
  `num_extrusions` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`machineName`)
);

CREATE TABLE `users` (
  `rcsID` varchar(255) NOT NULL,
  `rin` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `gender` varchar(50),
  `major` varchar(255) NOT NULL,
  `outstandingBalance` float NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`rin`)
);

CREATE TABLE `volunteers` (
  `vID` int NOT NULL AUTO_INCREMENT,
  `rin` int NOT NULL,
  `dayOfWeek` int NOT NULL,
  `startTime` TIME NOT NULL,
  `endTime` TIME NOT NULL,
  PRIMARY KEY (`vID`)
);

CREATE TABLE `plastics` (
  `pID` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `price` float(11) NOT NULL,
  PRIMARY KEY (`pID`)
);


CREATE TABLE `sessions` (
  `sessionID` varchar(1000) NOT NULL,
  `userID` int NOT NULL,
  `expiration` DATETIME,
  PRIMARY KEY (`sessionID`(191))
);

  ALTER TABLE `projects` ADD CONSTRAINT `fk_machine` FOREIGN KEY (`machine`) REFERENCES `hardware`(`machineName`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  ALTER TABLE `projects` ADD CONSTRAINT `fk_userID`  FOREIGN KEY (`userID`) REFERENCES `users`(`rin`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  ALTER TABLE `sessions` ADD CONSTRAINT `fk_userID2` FOREIGN KEY (`userID`) REFERENCES `users`(`rin`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  ALTER TABLE `volunteers` ADD CONSTRAINT `fk_userID3` FOREIGN KEY (`rin`) REFERENCES `users`(`rin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"Laser Cutter",0,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"Vinyl Cutter",0,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"3D Scanner",0,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"Makerbot Z18",1,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"TAZ 5",1,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"TAZ Mini",1,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"Makerbot Mini",1,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"Form 1+",1,0,0);
  INSERT INTO `hardware`(`inUse`, `status`, `machineName`, `usesPlastic`,`multiple_extrusion`, `num_extrusions`) VALUES (0,1,"Sewing Machine",0,0,0);


  INSERT INTO `plastics`(`pID`, `type`, `price`) VALUES (1,"PLA",0.07);
  INSERT INTO `plastics`(`pID`, `type`, `price`) VALUES (2,"ABS",0.06);
  INSERT INTO `plastics`(`pID`, `type`, `price`) VALUES (3,"Nylon",0.1);
  INSERT INTO `plastics`(`pID`, `type`, `price`) VALUES (4,"Flexy",0.09);
  INSERT INTO `plastics`(`pID`, `type`, `price`) VALUES (5,"nGen",0.055);
  INSERT INTO `plastics`(`pID`, `type`, `price`) VALUES (6,"Resin",0.2);

  INSERT INTO `users` (`rcsID`, `rin`, `firstName`, `lastName`, `email`, `password`, `type`, `gender`, `major`, `outstandingBalance`) VALUES
('ADMIN', 660000000, 'Super', 'User', 'rpi.forge@gmail.com', '$2y$10$aXRt6c3hqluUmHpULUO6nOvdu0F3N6Q3AzqG0bptSQCRZ9E89dlEy', 'TA', 'male', 'ITWS', 0.0);
