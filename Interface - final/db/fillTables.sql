/* test account table filler */



	
	
/* user account test list */
/* format: 
INSERT INTO Users (user_id, google_id, email, password, first_name, last_name, birth_date, phone_number, last_login, image_url) VALUES ( <userID int>, <googleID string(21)>,  <email (string)>, <password (string(20))> , <firstname (string)>, <lastname (string)>, <birth_date DATE>, <phone number (int(11))>, <DATETIME> <image_url INT>);
	
*/

/* ### these googleIDsare fake and won't authenticate*/


INSERT INTO Users (user_id, google_id, email, password, first_name, last_name, birth_date, phone_number, last_login, image_url) VALUES ( '1', '00000000000000000001', 'testersont20@gmail.com', 'testguy', ' Testy', 'Testerson', '1999-12-24', '12345678901', NOW(), 'https://www.dropbox.com/s/pu96jl3gehay79x/usertestavatar.png?dl=0');

INSERT INTO Users (user_id, google_id, email, password, first_name, last_name, birth_date, phone_number, last_login, image_url) VALUES ( '2', '00000000000000000002', 'tasha.test.cs372@gmail.com', '', 'Tasha', 'Baller', '1988-02-29','575498541884', '2017-02-28 17:25:03', 'https://www.dropbox.com/s/pu96jl3gehay79x/usertestavatar.png?dl=0');
	
INSERT INTO Users (user_id, google_id, email, password, first_name, last_name, birth_date, phone_number, last_login, image_url) VALUES ( '3', '00000000000000000003', 'pizzaman10039@yahoo.com', 'CS372GroupProject', 'Robert', 'Khoo', '2006-10-31','09876543210', '2015-05-18 03:55:11', 'https://www.dropbox.com/s/pu96jl3gehay79x/usertestavatar.png?dl=0');

	
	
/*	
INSERT INTO Users (user_id, google_id, image_url, email, password, first_name, last_name, birth_date, phone_number, last_login)
	VALUES ( '4', '', '4', 'billiams@yahoo.com', 'billiam', 'Bill', 'Williams', '1974-05-01','19878675309', '2017-04-28 03:55:11');
	
INSERT INTO Users (user_id, google_id, image_url, email, password, first_name, last_name, birth_date, phone_number, last_login)
	VALUES ( '5', '', '5', 'imperfectAnemia@yahoo.com', 'blood', 'Roni', 'Brinks', '1997-08-26','19878675309', NOW());	
	
INSERT INTO Users (user_id, google_id, image_url, email, password, first_name, last_name, birth_date, phone_number, last_login)
	VALUES ( '6', '', '6', 'causticAuspex@yahoo.com', 'heart', 'Esra', 'Astor', '1997-08-27','19878675309', NOW());	

INSERT INTO Users (user_id, google_id, image_url, email, password, first_name, last_name, birth_date, phone_number, last_login)
	VALUES ( '7', '', '7', 'confusedDefender@yahoo.com', 'balance', 'Lloyd', 'Valant', '1997-08-28','19878675309', NOW());	
*/	
	/* need the googleIDs and box_id for the user
	
	
	
/* group account test list */
/* format:
INSERT INTO Groups (group_id, group_name, group_description)
	VALUES ( <groupID (int)>, <groupname (string)>, <groupDescription (string)>);
*/



	
INSERT INTO Groups (group_id, group_name, group_description)
	VALUES ( '1', 'TestGroup1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquet ex tempor, ornare sapien vitae, lobortis arcu. Morbi quis mi ac massa hendrerit suscipit. Quisque malesuada, massa a tincidunt bibendum, est dolor hendrerit mauris, in efficitur nulla diam in urna. Curabitur blandit tortor vel urna convallis sagittis. Sed fringilla, massa ut maximus malesuada, nisl enim ultrices metus, vitae dapibus dolor lacus ut eros. Nunc vitae fermentum ipsum, a facilisis tellus. Proin est justo, aliquet a feugiat vel, viverra eget lectus. Vestibulum a interdum orci, eu mollis augue. ');

INSERT INTO Groups (group_id, group_name, group_description)
	VALUES ( '2', 'Group Share', 'This project involves creating a web app for building group projects');	
	
INSERT INTO Groups (group_id, group_name, group_description)
	VALUES ( '3', 'cs123_project', '');	
	
INSERT INTO Groups (group_id, group_name, group_description)
	VALUES ( '4', 'all admins', 'all admin leader test');	
	*/
	
	
	
/* group user list */
/* format:
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( <groupID int>, <groupname string>, '<isAdmin bool>);
*/


INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '1', '1', 'TRUE');	
	
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '1', '2', 'TRUE');		
	
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '1', '3', 'FALSE');		
	
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '2', '2', 'TRUE');		
	
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '3', '2', 'TRUE');			
	
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '4', '1', 'TRUE');		
	
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '4', '2', 'TRUE');		
	
INSERT INTO Group_Users (group_id, user_id, admin_leader)
	VALUES ( '4', '3', 'TRUE');		
		
	
/* group user pending list */	
/* format:
INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval)
	VALUES ( <groupID int>, <groupname string>, <bool>, <bool>);
*/	
	
/*	
INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval)
	VALUES ( '3', '1', 'TRUE', 'FALSE');	

INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval)
	VALUES ( '4', '5', 'FALSE', 'TRUE');		
	
INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval)
	VALUES ( '4', '6', 'TRUE', 'FALSE');			
	
INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval)
	VALUES ( '4', '7', 'FALSE', 'TRUE');

INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval)
	VALUES ( '2', '7', 'TRUE', 'FALSE');	
	
INSERT INTO Add_Users_Pending (group_id, user_id, user_approval, admin_approval)
	VALUES ( '2', '7', 'TRUE', 'FALSE');	
*/

	
/* personal calendar entry list */
/* format:
INSERT INTO Personal_Calendar (event_id, user_id, event_date, event_description)
	VALUES ( <event id (int)>, <userID (int), <DATETIME>, <event description (string));
*/



	
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('1', '1', '2017-03-18 03:55:11', 'Test entryes');	

INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('2', '1', '2017-03-18 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras laoreet convallis eros vitae dictum. Nunc faucibus, augue eu laoreet molestie, dui dui venenatis mi, vitae molestie ex diam tincidunt metus. Curabitur pulvinar magna libero, sed venenatis ipsum scelerisque vitae. Nulla sollicitudin tempor diam sit amet consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris sit amet turpis non elit porta pretium vitae non massa. Cras sed vestibulum tortor.

Ut ac cursus erat, ac blandit purus. Maecenas egestas lectus dolor, sit amet auctor elit aliquet vel. Pellentesque sed dapibus sem. Cras euismod at erat accumsan commodo. Donec elementum odio libero. Proin sodales justo ornare suscipit lacinia. Nulla tempor, enim ac aliquet sollicitudin, ante enim tempor massa, eu facilisis dolor metus id nisi.');		
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('2', '2', '2017-03-18 12:56:00', 'Buy Milk');	
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('3', '1', '2017-03-18 23:59:00', 'abcdefg123456789!@#$%^&*_-=+');	
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('4', '2', '2017-03-18 23:59:00', 'Test same datetime entry on another account');	
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('5', '1', '2017-03-18 23:59:00', 'Test same datetime entry on same account');		
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('6', '1', NOW(), 'Test datetime entry using NOW');		
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('7', '1', '2016-02-28 12:00:00', 'Test datetime entry on feb 28');

INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('8', '1', '2016-02-29 12:00:00', 'Test datetime entry on feb 29');	
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('9', '1', '2016-02-29 12:00:00', 'Test newline character \n -does this work? \n -does this show up right?');		
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('10', '2', '2017-03-28 12:00:00', 'Hand in project');	
	
INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('11', '2', '2017-03-28 18:00:00', 'Study for MATH122 midterm');	

INSERT INTO Personal_Calendar (event_id, user_id, event_date, entry_description)
	VALUES ('13', '2', '2017-03-29 12:00:00', 'Lunch with Judy, discuss project');	
	
	
/* group calendar entry list */
/* format:
INSERT INTO Group_Calendar (event_id, group_id, user_id, event_date, entry_description)
	VALUES (<eventID (int), <groupID (int)>, <userID (int)>, <DATETIME>, 'blank');
*/




	
	
INSERT INTO Group_Calendar (event_id, group_id, user_id, event_date, entry_description)
	VALUES ('1', '1', '1', '2017-03-28 18:00:00', 'Another test thing');	

INSERT INTO Group_Calendar (event_id, group_id, user_id, event_date, entry_description)
	VALUES ('2', '1', '2', '2017-03-28 18:00:00', 'Multiple users, same datetime test');
	
INSERT INTO Group_Calendar (event_id, group_id, user_id, event_date, entry_description)
	VALUES ('3', '1', '2', '2017-03-28 18:00:00', 'Same user, same datetime test');

INSERT INTO Group_Calendar (event_id, group_id, user_id, event_date, entry_description)
	VALUES ('4', '1', '2', '2017-03-28 19:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras laoreet convallis eros vitae dictum. Nunc faucibus, augue eu laoreet molestie, dui dui venenatis mi, vitae molestie ex diam tincidunt metus. Curabitur pulvinar magna libero, sed venenatis ipsum scelerisque vitae. Nulla sollicitudin tempor diam sit amet consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris sit amet turpis non elit porta pretium vitae non massa. Cras sed vestibulum tortor.

Ut ac cursus erat, ac blandit purus. Maecenas egestas lectus dolor, sit amet auctor elit aliquet vel. Pellentesque sed dapibus sem. Cras euismod at erat accumsan commodo. Donec elementum odio libero. Proin sodales justo ornare suscipit lacinia. Nulla tempor, enim ac aliquet sollicitudin, ante enim tempor massa, eu facilisis dolor metus id nisi.');	
	
INSERT INTO Group_Calendar (event_id, group_id, user_id, event_date, entry_description)
	VALUES ('5', '1', '1', '2017-03-29 19:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras laoreet convallis eros vitae dictum. Nunc faucibus, augue eu laoreet molestie, dui dui venenatis mi, vitae molestie ex diam tincidunt metus. Curabitur pulvinar magna libero, sed venenatis ipsum scelerisque vitae. Nulla sollicitudin tempor diam sit amet consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris sit amet turpis non elit porta pretium vitae non massa. Cras sed vestibulum tortor.

Ut ac cursus erat, ac blandit purus. Maecenas egestas lectus dolor, sit amet auctor elit aliquet vel. Pellentesque sed dapibus sem. Cras euismod at erat accumsan commodo. Donec elementum odio libero. Proin sodales justo ornare suscipit lacinia. Nulla tempor, enim ac aliquet sollicitudin, ante enim tempor massa, eu facilisis dolor metus id nisi.');	
	

/* group chat message list */
/* format:
INSERT INTO Chat_Messages (message_id, group_id, user_id, date_created, message_contents)
	VALUES (<int>, <int>, <int>, <DATETIME>, <string>);
*/


	
	
INSERT INTO Chat_Messages (message_id, group_id, user_id, date_created, message_contents)
	VALUES ('1', '1', '1', '2017-03-28 18:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ornare vehicula augue, ut pretium ante gravida eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend aliquam dui nec finibus. Mauris sit amet porttitor enim. Nullam gravida lectus quis ipsum sagittis fringilla. Fusce pellentesque ligula a tellus placerat posuere. Praesent ultricies sapien tempus rutrum dignissim. Sed iaculis a mauris dictum pharetra. Donec porttitor quis nisi vel viverra. Aenean nec consectetur metus, id interdum est. Vivamus nunc lorem, tempor mattis vehicula vitae, mattis non quam. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer lacinia faucibus lacus, eget lobortis nibh placerat in. Duis eu ante eu lacus sagittis tincidunt.

Cras egestas, metus in semper interdum, ante ligula placerat dui, ac interdum ex tellus sed felis. Curabitur dui massa, consectetur ac consectetur vel, semper ac ligula. Maecenas scelerisque erat vel magna vulputate, ut mollis sapien cursus. Vestibulum semper pulvinar dui at luctus. Phasellus molestie facilisis feugiat. Maecenas faucibus nec risus quis euismod. Morbi sit amet lorem id lorem feugiat efficitur. Nullam eget tincidunt dui. Maecenas nec tincidunt neque, quis venenatis ex. Maecenas pellentesque, velit ac imperdiet vehicula, nisl purus vestibulum ante, nec scelerisque leo diam id sapien. Maecenas eu augue a orci volutpat dictum rhoncus eu tellus. Pellentesque tortor felis, porta in dapibus in, euismod non ligula. Pellentesque vitae feugiat metus. Etiam magna nulla, facilisis sit amet sodales quis, varius quis risus. Duis facilisis enim sed molestie posuere. Pellentesque vulputate dui lobortis, placerat tellus quis, tempus felis. ');	

INSERT INTO Chat_Messages (message_id, group_id, user_id, date_created, message_contents)
	VALUES ('2', '1', '2', '2017-03-28 18:00:01', 'test abcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*-_=+');	
	
	
INSERT INTO Chat_Messages (message_id, group_id, user_id, date_created, message_contents)
	VALUES ('3', '2', '2', '2017-03-28 18:00:00', 'This is what the project requires: 
	1. Problem Definition
	2. Specification Doc
	3. Design Specification Doc
	4. Code Decription
	5. Technical Documentation
	6. User Documentation
	7. Code Testing
	8. Breakdown of Who Completed What');	
	
INSERT INTO Chat_Messages (message_id, group_id, user_id, date_created, message_contents)
	VALUES ('4', '2', '3', '2017-03-28 18:25:00', 'Does anyone want to meet on Friday to discuss this?');	

	
	
	
	
	
	
	