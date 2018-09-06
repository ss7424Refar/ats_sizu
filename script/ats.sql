drop table ats_testtask_info;
-- ats_testtask_info
CREATE TABLE `ats_testtask_info` (
  `TaskID` bigint(10) NOT NULL AUTO_INCREMENT,
  `TestImage` varchar(60) DEFAULT NULL,
  `ExecuteJob` varchar(60) DEFAULT NULL,
  `OSActivation` varchar(8) DEFAULT NULL,
  `DMI_ProductName` VARCHAR(30) NULL,
  `DMI_PartNumber` varchar(30) DEFAULT NULL,
  `DMI_SerialNumber` varchar(20) DEFAULT NULL,
  `DMI_OEMString` varchar(100) DEFAULT NULL,
  `DMI_SystemConfig` VARCHAR(20) NULL,
  `BIOS_EC` VARCHAR(20) NULL,
  `TestItem` varchar(20) DEFAULT NULL,
  `TestMachine` varchar(30) DEFAULT NULL,
  `MachineID` int(7) DEFAULT NULL,
  `SwitchId` int(2) DEFAULT NULL,
  `LANIP` varchar(16) DEFAULT NULL,
  `ShelfID` int(1) DEFAULT NULL,
  `TestResult` varchar(8) DEFAULT NULL,
  `TestResultPath` varchar(40) DEFAULT NULL,
  `TestStartTime` datetime DEFAULT NULL,
  `TestEndTime` datetime DEFAULT NULL,
  `TaskStatus` int(1) DEFAULT NULL,
  `Tester` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`TaskID`),
  UNIQUE KEY `TaskID_UNIQUE` (`TaskID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET='utf8';


#procedure

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_procedure`()
BEGIN
	declare i int;

    set i=0;
    while i < 900 do
		INSERT INTO `tpms`.`ats_testtask_info` (`TaskID`, `TestImage`, `DMIModifyFlag`, `DMI_PartNumber`, `DMI_SerialNumber`, `DMI_OEMString`, `TestItem`, `TestMachine`, `MachineID`, `PowerID`, `LANID`, `LANIP`, `ShelfID`, `TestResult`, `TestResultPath`, `TestStartTime`, `TestEndTime`, `TaskStatus`, `Tester`)
		VALUES (NULL, 'TI10661700B', '1', 'PT24C', 'ZD102073H', 'PT24C--ZD', 'JumpStart', 'Altair TX20 CS2 SKU2', '1308044', '1', '1', '1', '1', 'pass', '192.168.10.43//test', '2009-06-08 23:53:17', '2009-06-08 23:53:17', '1', 'Xu.wanliang');

	end while;

END

#system_config
CREATE TABLE `tpms`.`ats_system_config` (
  `name` VARCHAR(30) NOT NULL,
  `value` VARCHAR(50) NULL,
  PRIMARY KEY (`name`)) ENGINE=InnoDB DEFAULT CHARSET='latin1';

#reset
update ats_testtask_info set TaskStatus = '0', TestStartTime=NULL where TaskID between 8712116  and 8712129;

-- mysql event
show variables like '%event_scheduler%';

SET GLOBAL event_scheduler = ON;

show processlist;

select date_add(date(ADDDATE(curdate(),1)), interval 1 hour) from dual;

CREATE EVENT IF NOT EXISTS  ats_update_expired
  on schedule EVERY 1 DAY STARTS date_add(date( ADDDATE(curdate(),1)),interval 1 hour)
do update ats_testtask_info set TaskStatus=5 where TIMESTAMPDIFF(hour, TestStartTime, now()) >= 24 and TaskStatus = '1';

