CREATE TABLE `Users` (
	`userID` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(255),
	`email` varchar(255) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`admin` bool NOT NULL DEFAULT false,
	PRIMARY KEY (`userID`)
);

CREATE TABLE `Posts` (
	`postID` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(30) NOT NULL,
	`post_desc` TEXT(64) NOT NULL,
	PRIMARY KEY (`postID`)
);

CREATE TABLE `Teacher` (
	`teacherID` int(11) NOT NULL AUTO_INCREMENT,
	`teachername` varchar(255),
	`email` varchar(255) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`access` bool NOT NULL DEFAULT false,
	PRIMARY KEY (`teacherID`)
);

CREATE TABLE `Lessons` (
	`lessonID` int NOT NULL AUTO_INCREMENT,
	`description` TEXT(800) NOT NULL,
	PRIMARY KEY (`lessonID`)
);

CREATE TABLE `banneduser` (
	`bannedID` int NOT NULL AUTO_INCREMENT,
	`userID` int NOT NULL,
	PRIMARY KEY (`bannedID`)
);

CREATE TABLE `bannedteacher` (
	`bannedID` int NOT NULL AUTO_INCREMENT,
	`teacherID` int NOT NULL,
	PRIMARY KEY (`bannedID`)
);

CREATE TABLE `Tasks` (
	`taskID` int(255) NOT NULL AUTO_INCREMENT,
	`taskTitle` varchar(255) NOT NULL,
	`taskDescription` varchar(255) NOT NULL,
	`teacherID` varchar(255) NOT NULL,
	PRIMARY KEY (`taskID`)
);

CREATE TABLE `TaskStatus` (
	`statusID` int(255) NOT NULL AUTO_INCREMENT,
	`taskID` int(255) NOT NULL,
	`userID` int(255) NOT NULL,
	`status` varchar(255) NOT NULL,
	PRIMARY KEY (`statusID`)
);

ALTER TABLE `banneduser` ADD CONSTRAINT `banneduser_fk0` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);

ALTER TABLE `bannedteacher` ADD CONSTRAINT `bannedteacher_fk0` FOREIGN KEY (`teacherID`) REFERENCES `Teacher`(`teacherID`);

ALTER TABLE `Tasks` ADD CONSTRAINT `Tasks_fk0` FOREIGN KEY (`teacherID`) REFERENCES `Teacher`(`teacherID`);

ALTER TABLE `TaskStatus` ADD CONSTRAINT `TaskStatus_fk0` FOREIGN KEY (`taskID`) REFERENCES `Tasks`(`taskID`);

ALTER TABLE `TaskStatus` ADD CONSTRAINT `TaskStatus_fk1` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);









