

/* ------------USER TABLES----------------- */

/*user profile pics */
CREATE TABLE User_Images
(	image_id 		INTEGER UNIQUE NOT NULL,
	image_url		VARCHAR(2083),
	image_name		VARCHAR(250) UNIQUE NOT NULL,
	image_extension	VARCHAR(5) NOT NULL,
	
	PRIMARY KEY (image_id)
) ENGINE=INNODB;


/* User profiles and login credentials */
CREATE TABLE Users
(	user_id 		INTEGER UNIQUE NOT NULL,
	google_id		VARCHAR(21) UNIQUE,
	email 			VARCHAR(254) UNIQUE NOT NULL,
	image_id		INTEGER,
	password		VARCHAR(20),
	first_name		VARCHAR(40) NOT NULL,
	last_name		VARCHAR(40) NOT NULL,
	birth_date		DATE NOT NULL,
	phone_number	INTEGER(11),
	last_login		DATETIME,
	
	PRIMARY KEY (user_id),
	FOREIGN KEY (image_id) 
		REFERENCES User_Images (image_id)
		ON DELETE SET NULL
	
) ENGINE=INNODB;


/* -------------GROUP TABLES------------------ */


/* Group profiles */
CREATE TABLE Groups
(	group_id 			INTEGER UNIQUE NOT NULL,
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
(	message_id		INTEGER UNIQUE NOT NULL,
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


/* -------------CALENDAR TABLES----------------- */

/* Personal Calendar Entries */
CREATE TABLE Personal_Calendar
(	event_id	 		INTEGER UNIQUE NOT NULL,
	user_id		 		INTEGER UNIQUE,
	event_date			DATETIME,
	entry_description	VARCHAR(1000),
	
	PRIMARY KEY (event_id),
	FOREIGN KEY (user_id) 
		REFERENCES Users (user_id)
		ON DELETE CASCADE
) ENGINE=INNODB;


/* Group Calendar Entries */
CREATE TABLE Group_Calendar
(	event_id 			INTEGER UNIQUE NOT NULL,
	group_id 			INTEGER NOT NULL,
	user_id				INTEGER,
	event_date			DATETIME,
	entry_description	VARCHAR(1000),
	
	PRIMARY KEY (event_id),
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
CREATE TABLE Files
(	fileshare_id 		INTEGER UNIQUE NOT NULL,
	created_user_id 	INTEGER NOT NULL,
	fileshare_name		VARCHAR(255) UNIQUE NOT NULL,
	file_extension		VARCHAR(5),
	file_size			INTEGER,
	date_created		DATETIME,
	date_modified		DATETIME,
	
	PRIMARY KEY (fileshare_id),
	FOREIGN KEY (created_user_id) 
		REFERENCES Users (user_id)
) ENGINE=INNODB;


/* Group File information */
CREATE TABLE Group_Files
(	group_id			INTEGER NOT NULL,
	fileshare_id 		INTEGER NOT NULL,
	modified_user_id 	INTEGER,

	FOREIGN KEY (group_id)
		REFERENCES Groups (group_id),
	FOREIGN KEY (fileshare_id)
		REFERENCES Files (fileshare_id),
	FOREIGN KEY (modified_user_id)
		REFERENCES Users (user_id)
		ON DELETE SET NULL
) ENGINE=INNODB;

