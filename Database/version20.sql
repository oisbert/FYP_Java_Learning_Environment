CREATE TABLE `Users` (
	`userID` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(255),
	`email` varchar(255) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`admin` bool NOT NULL DEFAULT false,
	`points` int NOT NULL DEFAULT '0',
	`pointtracker` bool,
	PRIMARY KEY (`userID`)
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

CREATE TABLE `Posts` (
	`PostID` int(255) NOT NULL AUTO_INCREMENT,
	`userID` int(255) NOT NULL,
	`date` DATE NOT NULL,
	`Title` varchar(255) NOT NULL,
	`description` varchar(255) NOT NULL,
	PRIMARY KEY (`PostID`)
);

CREATE TABLE `Reply` (
	`ReplyID` int(255) NOT NULL AUTO_INCREMENT,
	`PostID` int(255) NOT NULL,
	`description` varchar(255) NOT NULL,
	`userID` int NOT NULL,
	`replyby` varchar(255) NOT NULL,
	PRIMARY KEY (`ReplyID`)
);

ALTER TABLE `banneduser` ADD CONSTRAINT `banneduser_fk0` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);

ALTER TABLE `bannedteacher` ADD CONSTRAINT `bannedteacher_fk0` FOREIGN KEY (`teacherID`) REFERENCES `Teacher`(`teacherID`);

ALTER TABLE `Tasks` ADD CONSTRAINT `Tasks_fk0` FOREIGN KEY (`teacherID`) REFERENCES `Teacher`(`teacherID`);

ALTER TABLE `TaskStatus` ADD CONSTRAINT `TaskStatus_fk0` FOREIGN KEY (`taskID`) REFERENCES `Tasks`(`taskID`);

ALTER TABLE `TaskStatus` ADD CONSTRAINT `TaskStatus_fk1` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);

ALTER TABLE `Posts` ADD CONSTRAINT `Posts_fk0` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);

ALTER TABLE `Reply` ADD CONSTRAINT `Reply_fk0` FOREIGN KEY (`PostID`) REFERENCES `Posts`(`PostID`);

ALTER TABLE `Reply` ADD CONSTRAINT `Reply_fk1` FOREIGN KEY (`userID`) REFERENCES `Users`(`userID`);










