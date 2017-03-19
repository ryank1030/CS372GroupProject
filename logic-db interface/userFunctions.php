<?php

/* -----basic sql queries for User Logic requests----
	### all of this is untested and currently in procedural form. This probably doesn't work yet and is heavily subject to change.
	
	Every one of these functions requires the connection to be established, tested, and closed down outside of the function. If there's a connection error or a NULL result, they'll all return FALSE. Do error handling outside.
	
	none of the processing of the returned data has been handled in any of these functions as of yet.
	
	none of the input/output has been sanitized for sql or html at this point, so use at your own risk.
	
*/ 


/*	basic query prototypes:
	sql_init_user($conn)
	sql_get_user_id($conn, $googleID)
	sql_max_user_id($conn)
	sql_new_user_id($conn)
	sql_add_user($conn, $googleID, $imageID, $email, $pass, $firstname, $lastname, $bday, $phoneNum)
	sql_get_user($conn, $userID)
	sql_user_update_login_time($conn, $userID)
	sql_user_last_login($conn, $userID)
	sql_get_user_pass($conn, $email)	
	sql_user_exists($conn, $email)
	sql_get_user_image($conn, $userID)
*/






/* init default user (do not use for an actual account) */
function sql_init_user($conn)
{
	$sql = "INSERT INTO Users (user_id, google_id, image_id, email, password, first_name, last_name, birth_date, phone_number, last_login) VALUES ( '0', '000000000000000000000', '0', 'blank@blank.com', '', 'empty', 'empty', '1990-01-01','12345678901', NOW())";
	
	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}
	
	return TRUE;
}
	
	
/* get user_id from google_id */	
function sql_get_user_id($conn, $googleID)
{
	$sql = 	"SELECT user_id FROM Users WHERE google_id = '$googleID'";

	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}
	
	return $userID;
}


/* get max user_id for generating a new user_id */
function sql_max_user_id($conn)
{
	$sql = "SELECT MAX(user_id) FROM Users";

	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}
	
	return $maxUserID;
}


/* create a new user id */
function sql_new_user_id($conn)
{
	$old_id = max_user_id ($conn);
	
	if ($old_id == FALSE)
	{
		return FALSE;
	}
	
	return $old_id + 1;

}



/* make user */
function sql_add_user($conn, $googleID, $imageID, $email, $pass, $firstname, $lastname, $bday, $phoneNum)
{
	$user_id = new_user_id($conn);
	
	$sql = "INSERT INTO Users (user_id, google_id, image_id, email, password, first_name, last_name, birth_date, phone_number, last_login) VALUES ('$new_user_id', '$googleID', '$imageID', '$email', '$pass', '$firstname', '$lastname', $bday, '$phoneNum', NOW())";
	
	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}
}


/* get user details from userID */
function sql_get_user($conn, $userID)
{
	$sql = "SELECT google_id, image_id, email, first_name, last_name, birth_date, phone_number, last_login FROM Users WHERE user_id = '$userID'";

	$result = mysqli_query($conn, $query);

	if (!result)
	{
		return FALSE;
	}
	
	return $result;
}


/* update user login time stamp to now */
function sql_user_update_login_time($conn, $userID)
{
	$sql = "UPDATE Users SET last_login = NOW() WHERE user_id = '$userID'";
	
	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}
	
	return TRUE;
	
}


/* get last user login*/
function sql_user_last_login($conn, $userID)
{
	$sql = "SELECT last_login FROM Users WHERE user_id = '$userID'";
	
	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}
	
	return $loginTime;
}


function sql_get_user_pass($conn, $email)
{
	$sql = "SELECT password FROM Users WHERE email = '$email'";
	
	$result = mysqli_query($conn, $query);

	if (!result)
	{
		return FALSE;
	}	
	
	return $result;
}


function sql_user_exists($conn, $email)
{
	$sql = "SELECT user_id FROM Users WHERE email = '$email'";
	
	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}	
	
	return TRUE;
}



/* retrieve user profile picture info */
function sql_get_user_image($conn, $userID)
{
	
	$sql = "SELECT image_url, image_name, image_extension FROM User_Images WHERE image_id = (SELECT image_id FROM Users WHERE user_id = '$userID'";
	
	$result = mysqli_query($conn, $query);
	
	if (!result)
	{
		return FALSE;
	}	
	
	return $result;
}

	
?>