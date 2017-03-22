<?php

/* -----basic sql queries for User Logic requests----
	### all of this is untested and currently in procedural form. This probably doesn't work yet and is heavily subject to change.
	
	this is a list of queries only, this doesn't sanitize anything, it's just for short handing the query format
		
*/ 


/*	basic query prototypes:
	init_user()
	get_user_id($googleID)
	max_user_id()
	new_user_id()
	add_user($googleID, $imageID, $email, $pass, $firstname, $lastname, $bday, $phoneNum)
	get_user($userID)
	user_update_login_time($userID)
	user_last_login($userID)
	get_user_pass($email)	
	user_exists($email)
	get_user_image($userID)
*/


echo "<p>inside userSQL</p>";

class UserSQL
{
	/* init default user (do not use for an actual account) */
	public function init_user()
	{
		return "INSERT INTO Users (user_id, google_id, image_id, email, password, first_name, last_name, birth_date, phone_number, last_login) VALUES ( '0', '000000000000000000000', '0', 'blank@blank.com', '', 'empty', 'empty', '1990-01-01','12345678901', NOW())";
	}
		
		
	/* get user_id from google_id */	
	public function get_user_id($googleID)
	{
		return "SELECT user_id FROM Users WHERE google_id = '$googleID'";
	}


	/* get max user_id for generating a new user_id */
	public function max_user_id()
	{
		return "SELECT MAX(user_id) FROM Users";
	}


	/* make user */
	public function add_user($googleID, $imageID, $email, $pass, $firstname, $lastname, $bday, $phoneNum)
	{		
		return "INSERT INTO Users (user_id, google_id, image_id, email, password, first_name, last_name, birth_date, phone_number, last_login) VALUES ('$new_user_id', '$googleID', '$imageID', '$email', '$pass', '$firstname', '$lastname', $bday, '$phoneNum', NOW())";

	}


	/* get user details from userID */
	public function get_user($userID)
	{
		return "SELECT google_id, image_id, email, first_name, last_name, birth_date, phone_number, last_login FROM Users WHERE user_id = '$userID'";
	}


	/* update user login time stamp to now */
	public function user_update_login_time($userID)
	{
		return "UPDATE Users SET last_login = NOW() WHERE user_id = '$userID'";
	}


	/* get last user login*/
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
	public function sql_user_exists($email)
	{
		return "SELECT user_id FROM Users WHERE email = '$email'";
	}


	/* retrieve user profile picture info */
	public function get_user_image($userID)
	{
		return "SELECT image_url, image_name, image_extension FROM User_Images WHERE image_id = (SELECT image_id FROM Users WHERE user_id = '$userID'";
	}
	

	// sets an image_id to a user's account
	public function set_user_image($userID, $imageID)
	{
		return "UPDATE Users SET image_id = '$imageID' WHERE user_ID = '$userID'";
	
	}
	
	
	/* upload user profile picture info */
	public function upload_image($imageID, $imageURL, $imageName, $imageExtension )
	{
		return "INSERT INTO User_Images (image_id, image_url, image_name, image_extension) VALUES ('$imageID', '$imageURL', '$imageName', '$imageExtension')";
	}
	
	
	// returns the largest image_id in the table
	public function max_image_id()
	{
		return "SELECT MAX(image_id) FROM User_Images";
	}
	
}
	
echo "<p>end of userSQL</p>";	
	
	
?>