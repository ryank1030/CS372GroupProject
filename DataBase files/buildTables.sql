/* buildTables.sql */

/* ------------USER TABLES----------------- */


/* User profiles and login credentials */
CREATE TABLE Users
(	user_id 		INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
	google_id		VARCHAR(21) UNIQUE,
	email 			VARCHAR(254) UNIQUE NOT NULL,
	image_url		VARCHAR(2083),
	password		VARCHAR(20),
	first_name		VARCHAR(40) NOT NULL,
	last_name		VARCHAR(40),
	birth_date		DATE,
	phone_number	VARCHAR(255),
	last_login		DATETIME,
	
	PRIMARY KEY (user_id)
) ENGINE=INNODB;


/* -------------GROUP TABLES------------------ */


/* Group profiles */
CREATE TABLE Groups
(	group_id 			INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
	group_name 			VARCHAR(100) NOT NULL,
	group_description	VARCHAR(5000),
	
	PRIMARY KEY (group_id)
) ENGINE=INNODB;


/* Group Member listings */
CREATE TABLE Group_Users
(	group_id 		INTEGER NOT NULL,
	user_id 		INTEGER NOT NULL,
	admin_leader	BOOLEAN NOT NULL,
	
	FOREIGN KEY (group_id) 
		REFERENCES Groups (group_id)
		ON DELETE CASCADE,
	FOREIGN KEY (user_id) 
		REFERENCES Users (user_id)
		ON DELETE CASCADE
) ENGINE=INNODB;


/* Add user to group pending listing */
/* user must have approval from a group Admin Leader and accept (or submit) group membership before being transferred to the Group_Users listing */
CREATE TABLE Add_Users_Pending
(	group_id 		INTEGER NOT NULL,
	user_id 		INTEGER NOT NULL,
	user_approval	BOOLEAN NOT NULL,
	admin_approval	BOOLEAN NOT NULL,
	
	FOREIGN KEY (group_id) 
		REFERENCES Groups (group_id)
		ON DELETE CASCADE,
	FOREIGN KEY (user_id) 
		REFERENCES Users (user_id)
		ON DELETE CASCADE
) ENGINE=INNODB;


/* ---------------CHAT TABLES-------------------- */


/* Chat Message entries */
CREATE TABLE Chat_Messages
(	message_id		INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
	group_id 		INTEGER NOT NULL,
	user_id 		INTEGER,
	date_created	DATETIME NOT NULL,
	message_contents VARCHAR(5000),
	
	PRIMARY KEY (message_id),
	FOREIGN KEY (group_id)
		REFERENCES Groups (group_id)
		ON DELETE CASCADE,
	FOREIGN KEY (user_id)
		REFERENCES Users (user_id)
		ON DELETE SET NULL
) ENGINE=INNODB;


/* ----------------FILE HOSTING TABLES---------------- */


/* Hosted File information */
/* Need to know what to do with files when a user is deleted because of groups, and the file API in general */
CREATE TABLE `gfile` (
    `group_id`  INT NOT NULL,
    `gfid`      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`      VARCHAR(255) NOT NULL DEFAULT 'Untitled.txt',
    `mime`      VARCHAR(50) NOT NULL DEFAULT 'text/plain',
    `size`      BIGINT UNSIGNED NOT NULL DEFAULT 0,
    `data`      MEDIUMBLOB NOT NULL,
    `created`   DATETIME NOT NULL,
    PRIMARY KEY (`gfid`), 
    FOREIGN KEY (`group_id`) 
		REFERENCES Groups (`group_id`) 
		ON DELETE CASCADE
) ENGINE=INNODB;
 
 
CREATE TABLE `pfile` (
    `user_id`   INT NOT NULL,
    `pfid`      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`      VARCHAR(255) NOT NULL DEFAULT 'Untitled.txt',
    `mime`      VARCHAR(50) NOT NULL DEFAULT 'text/plain',
    `size`      BIGINT UNSIGNED NOT NULL DEFAULT 0,
    `data`      MEDIUMBLOB NOT NULL,
    `created`   DATETIME NOT NULL,
    PRIMARY KEY (`pfid`),
    FOREIGN KEY (`user_id`) 
		REFERENCES Users (`user_id`) 
		ON DELETE CASCADE
) ENGINE=INNODB;

