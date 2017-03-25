<?php

/* -----basic sql queries for User Logic requests----
	### all of this is untested, but it probably works. 
	
	this is a list of queries only, this doesn't sanitize anything, it's just for short handing the query format.
		
*/ 


/*	basic query prototypes:
	init_user()
	get_user_id($googleID)
	max_user_id()
	new_user_id()
	add_user($new_user_id, $googleID, $email, $pass, $firstname, $lastname, $bday, $phoneNum, $imageUrl)
	get_user($userID)
	user_update_login_time($userID)
	user_last_login($userID)
	get_user_pass($email)	
	user_exists($email)
	get_user_image($userID)
	set_user_image($userID, $imageUrl)
	update_user($userID, $email_in, $first_name_in, $last_name_in, $dob_in, $image_url_in, $phone_in)
	delete_user($user_id)
	get_user_basic($userID)
*/


class UserSQL
{
	//init default user (do not use for an actual account)
	public function init_user()
	{
		return "INSERT INTO Users (user_id, google_id, image_id, email, password, first_name, last_name, birth_date, phone_number, last_login, image_url) VALUES ( '0', '000000000000000000000', '0', 'blank@blank.com', '', 'empty', 'empty', '1990-01-01','12345678901', NOW(), '')";
	}
		
		
	// get user_id from google_id
	public function get_user_id($googleID)
	{
		return "SELECT user_id FROM Users WHERE google_id = '$googleID'";
	}


	// get max user_id for generating a new user_id
	public function max_user_id()
	{
		return "SELECT MAX(user_id) FROM Users";
	}


	// make new user account
//	public function add_user($new_user_id, $googleID, $email, $pass, $firstname, $lastname, $bday, $phoneNum, $imageUrl)
	public function add_user($new_user_id, $googleID, $email, $firstname, $lastname, $bday, $phoneNum, $imageUrl)
	{		
		//		return "INSERT INTO Users (user_id, google_id, image_url, email, password, first_name, last_name, birth_date, phone_number, last_login) VALUES ('$new_user_id', '$googleID', '$imageUrl', '$email', '$pass', '$firstname', '$lastname', $bday, '$phoneNum', NOW())";
		return "INSERT INTO Users (user_id, google_id, image_url, email, first_name, last_name, 	birth_date, phone_number, last_login) VALUES ('$new_user_id', '$googleID', '$imageUrl', '$email', '$firstname', '$lastname', $bday, '$phoneNum', NOW())";



	}


	// get all user details from userID
	/* Row Indexes:
		0 = user_id
		1 = google_id
		2 = email
		3 = image_url
		4 = password (depreciated?)
		5 = first_name
		6 = last name
		7 = birth_date
		8 = phone
		9 = last_login
	*/
	public function get_user($userID)
	{
		return "SELECT * FROM Users WHERE user_id = '$userID'";
	}

	
	//update user login time stamp to current server date/time
	public function user_update_login_time($userID)
	{
		return "UPDATE Users SET last_login = NOW() WHERE user_id = '$userID'";
	}


	//get last user login date/time
	public function user_last_login($userID)
	{
		return "SELECT last_login FROM Users WHERE user_id = '$userID'";
	}


	// returns a user's password based off of their email account
	public function get_user_pass($email)
	{
		return "SELECT password FROM Users WHERE email = '$email'";
	}


	// determines if a user's account exists based on if their email address is registered\
	public function user_exists($email)
	{
		return "SELECT user_id FROM Users WHERE email = '$email'";
	}


	// retrieve user profile picture info
	public function get_user_image($userID)
	{
		return "SELECT image_url FROM Users WHERE user_id = '$userID'";
	}
	

	// sets an image_id to a user's account
	public function set_user_image($userID, $imageUrl)
	{
		return "UPDATE Users SET image_url = '$imageUrl' WHERE user_ID = '$userID'";
	}
	
	
	// updates a user's account
	public function update_user($userID, $email_in, $first_name_in, $last_name_in, $dob_in, $image_url_in, $phone_in)
	{
		return "UPDATE Users SET email = '$email_in', first_name = '$first_name_in', last_name = '$last_name_in', birth_date = '$dob_in', image_url = '$image_url_in', phone_number = '$phone_in' WHERE user_ID = '$userID'";
	}
	
	
	// deletes a user from the User table. 
	// Note, this doesn't cover deleting a user from any groups or dealing with their files.
	// Note, that if you want to keep the user's info inact for group files and chat after they leave, that you probably shouldn't use this.
	public function delete_user($user_id)
	{
		return "DELETE FROM Users WHERE user_id = '$user_id'";
	}
	
	
	// get the most basic details from the server. 
	// Use this for cases where you need to list a bunch of users, but don't need more complicated  or hidden details like passwords, etc.
	public function get_user_basic($userID)
	{
		return "SELECT email, first_name, last_name, image_url, phone_number, last_login FROM Users WHERE user_id = '$userID'";
	}
	
	
	
	
}
	

	
	
?>