<?php

/*	Prototypes:

	Note: for any function with $conn and $uSql in the parameters, just leave it as is in the call.

	--- getters ---
	
	get_this_user()
	get_user_id()
	get_email()
	get_user_pass()
	get_google_id()
	get_first_name()
	get_last_name()
	get_dob()
	get_last_login()
	get_image_url()
	get_phone()
	
	
	--- get and set database operations ---
	
	set_user($email_in, $google_id_in, $first_name_in, $last_name_in, $dob_in, $image_url_in,  $phone_in)
	set_user_basic($email_in, $first_name_in, $last_name_in, $dob_in, $image_url_in,  $phone_in)
	get_user($conn, $uSql, $googleID_in)
	get_user_basic($conn, $uSql, $user_id_in)
	update_last_login($conn, $uSql)
	create_user($conn, $uSql)
	edit_user($conn, $uSql, $email_in, $first_name_in, $last_name_in, $dob_in, $image_url_in,  $phone_in)
	delete_user($conn, $uSql)	
	set_user_id($user_id_in)
*/



include_once 'dataAccess.php';
include_once 'userSQL.php';


// server info class
// note: you may have to pass this into your calls every time you do a server call. Instancing this inside the class didn't work.
if (!defined($conn))
{	
	$conn = new DataAccess;
}



// user sql command variable
// note: you may have to pass this into your calls every time you do a server call. Instancing this inside the class didn't work.
if (!defined($uSql))
{	
	$uSql = new UserSQL;
}



// User business logic class
class User
{
	// ### none of these variables are sanitized/hashed/converted within this class, do it outside before inputting into this class.
	
	private $user_id;		// format: int, never change this directly unless fake populating a server
	private $email;			// ### check format outside of these functions
//	private $password;		// max length 20 chars
	private	$google_id;		// 21 char string (let me know if it needs an extra char for the '/n' character)
	private $first_name;
	private $last_name;
	private $dob;			// format: "YYYY-MM-DD"
	private $last_login;	// format: "YYYY-MM-DD HH:MM:SS"
	private $image_url;
	private $phone;			// format: int(11), no dashes or braces
	
	// constructor
	function __construct() 
	{}

	// destructor
	function __destruct() 
	{
		$this->user_id = null;
		$this->email = null;
//		$this->password = null;
		$this->google_id = null;
		$this->first_name = null;
		$this->last_name = null;
		$this->dob = null;
		$this->last_login = null;	// ### add this to class diagram, please
		$this->image_url = null;
		$this->phone = null;
	}


	// ---- Basic Getters ----
	
	// Returns all info stored in this class's variables (hopefully as an array)
	public function get_this_user()
	{
		return $this;
	}

	
	// Returns user_id
	//### works
	public function get_user_id()
	{
		return $this->user_id;
	}

	
	// Returns email address
	//### works
	public function get_email()
	{
		return $this->email;
	}
	
/*	
	// Returns password
	//### works
	public function get_user_pass()
	{
		return $this->password;
	}
*/	
	
	// Returns google ID
	//### works
	public function get_google_id()
	{
		return $this->google_id;
	}
	
	
	// Returns user's first name
	//### works
	public function get_first_name()
	{
		return $this->first_name;
	}
	
	
	// returns user's last name
	//### works
	public function get_last_name()
	{
		return $this->last_name;
	}
	
	
	// returns date of birth
	// format: "YYYY-MM-DD"
	//### works
	public function get_dob()
	{
		return $this->dob;
	}

	
	// returns user's last login date/time
	// format: "YYYY-MM-DD HH:MM:SS"
	//### works
	public function get_last_login()
	{
		return $this->last_login;
	}

	
	// returns the url of the user's profile pic
	// ### you might have to use htmlspecialchars() to format this. let me know if you want that incorporated into
	// this function, though it might also be a js command, I can't remember at this time :(
	//### works
	public function get_image_url()
	{
		return $this->image_url;
	}
	

	// returns user's phone number
	// This is stored as an int, so you may have to separate and format this
	//### works
	public function get_phone()
	{
		return $this->phone;
	}
	
	
// ---------------------- get and set database operations -------------------------
	

	// sets this User's variables to the following to initialize the class
	// use this when creating an account to fill this instance's variables
	// does not set user_id
	//### works
	public function set_user($email_in, $google_id_in, $first_name_in, $last_name_in, $dob_in, $image_url_in, $phone_in)
	{
		$this->email = $email_in; 
		$this->google_id = $google_id_in; 
		$this->first_name = $first_name_in; 
		$this->last_name = $last_name_in; 
		$this->dob = $dob_in; 
		$this->image_url = $image_url_in;
		$this->phone = $phone_in;
	}	
	
	
	// sets this User's variables to the following to initialize the class
	// use this when editing an existing account
	// does not change $user_id , $google_id
	//### works
	public function set_user_basic($email_in, $first_name_in, $last_name_in, $dob_in, $image_url_in,  $phone_in)
	{
		$this->email = $email_in; 
		$this->first_name = $first_name_in; 
		$this->last_name = $last_name_in; 
		$this->dob = $dob_in; 
		$this->image_url = $image_url_in;
		$this->phone = $phone_in;
	}	


	// retrieves a User's stored information from the database via their google ID
	
	//#works, unless this needs to be changed because of google id stuff
	public function get_user($conn, $uSql, $googleID_in)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return false;
			
		}
		
		// first verifies that the google_ID exists in the server
		// will return false if the account doesn't exist
		if (!$result1 = mysqli_query($db ,$uSql->get_user_id($googleID_in)))
		{
			mysqli_close($db);
			return false;
		} 
		
		// sets the googleID to the input, and the user ID to the retrieved result
		while ($row = mysqli_fetch_row($result1)) 
		{
			$this->user_id = $row[0];
		}
		
		$this->google_id = $googleID_in;
		
		// gets and sets the rest of the user's info
		// ### there might also be some extra lines of code that deal with determining the # of rows returned, not sure yet, untested.
		if ($result2 = mysqli_query($db ,$uSql->get_user($this->user_id)))
		{			
			while ($row = mysqli_fetch_row($result2)) 
			{							
				$this->email = $row[2];
				$this->first_name = $row[5];
				$this->last_name = $row[6];
				$this->dob = $row[7];
				$this->last_login = $row[9];
				$this->image_url = $row[3];
				$this->phone = $row[8];		
			}
		}		
		
		mysqli_close($db);
		return true;
	}
	
	
	// retrieves a User's stored information from the database via their user ID
	// Use this in situations where more complex and private user info isn't necessary, ie: a group's member list, another user's profile anything
	
	//### works
	public function get_user_basic($conn, $uSql, $user_id_in)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return false;
		}

		// get user info
		// will return false if the user_id_in doesn't exist				
		if (!$result = mysqli_query($db, $uSql->get_user_basic($user_id_in)))
		{
			mysqli_close($db);
			return false;
		} 
	
		// set user info
		$this->user_id = $user_id_in;
		
		if ($result2 = mysqli_query($db ,$uSql->get_user($this->user_id)))
		{
			while ($row = mysqli_fetch_row($result2)) 
			{					
				$this->email = $row[2];
				$this->first_name = $row[5];
				$this->last_name = $row[6];
				$this->last_login = $row[9];
				$this->image_url = $row[3];
				$this->phone = $row[8];						
			}
		}		
		
		mysqli_close($db);
		return true;
	}
	

	// automatically updates this user's login date/time to the current server time
	
	// ### works
	public function update_last_login($conn, $uSql)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return false;
			
		}
		
		// update login time at database	
		if (!$result = mysqli_query($db ,$uSql->user_update_login_time($this->user_id)))
		{
			mysqli_close($db);
			return false;
		} 
	
		// return the login time and update $last_login
		if ($result = mysqli_query($db ,$uSql->user_last_login($this->user_id)))
		{
			while ($row = mysqli_fetch_row($result)) 
			{					
				$this->user_id = $row[0];
			}
		}
		
		mysqli_close($db);
		return true;
	}



	// uses the current info stored in this instance to create a new user account
	//	Precondition: all vars except for $user_id, $last_login and maybe $image_url must be set, use set_user first
	// returns false if the google_id already exists or if the account isn't created for whatever reason.
	// ### works
	public function create_user($conn, $uSql)
	{
		// connect to the server
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return false;
			
		}
		
		// check if the account exists on the db
		if (!$result = mysqli_query($db, $uSql->get_user_id($this->google_id)))
		{
			mysqli_close($db);
			return false;
		} 
		
		// generate a new user_id based on the last max user_id on the Users table.
		if ($result2 = mysqli_query($db, $uSql->max_user_id()))
		{	
			while ($row = mysqli_fetch_row($result2)) 
			{					
				$old_id = $row[0];
			}		
		}
		
		$this->user_id = $old_id + 1;
		
		// create new listing in Users table
//		if (!$result3 = $db->query($uSql->add_user($this->user_id, $this->google_id, $this->email, $this->password, $this->first_name, $this->last_name, $this->dob, $this->phone, $this->image_url )))
		if (!$result3 = $db->query($uSql->add_user($this->user_id, $this->google_id, $this->email, $this->first_name, $this->last_name, $this->dob, $this->phone, $this->image_url )))

		{
			mysqli_close($db);
			return false;
		} 
		
		mysqli_close($db);
		return true;	
	}
	
	
	// updates this User instances variables based on the below inputs and updates this in the database.
	// this does not change the $user_id or the $google_id
	// Precondition: user_id is set to an existing account
	
	//#works
	public function edit_user($conn, $uSql, $email_in, $first_name_in, $last_name_in, $dob_in, $image_url_in,  $phone_in)
	{
		
		// connect to server, check connection
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return false;
		}
		
		// update the user info in this class
		$this->set_user_basic($email_in, $first_name_in, $last_name_in, $dob_in, $image_url_in,  $phone_in);
		
		// update the user info in the database
		if (!$result = mysqli_query($db ,$uSql->update_user($this->user_id, $this->email, $this->first_name, $this->last_name, $this->dob, $this->image_url, $this->phone)))
		{
			mysqli_close($db);
			return false;
		} 
		
		mysqli_close($db);
		return true;
	}
	
	
	// deletes the current User instance's account from the database and sets this instance to null.
	// Use a separate function to remove file entries where necessary before calling this function.
	// Precondition: user_id is set to an existing account
	
	// *** Use this sparingly, as this will nuke the user's account. This'll affect every server call where the user is mentioned. The user_id delete Cascades into the Group_Users, Add_Users_Pending, and Personal_Calendar.
	// 		This just sets any entries in Group_Files, Group_Calendar, and Chat_Messages to NULL, so those entries will still exist, but won't list who posted them (I think). 
	// *** This may also not work every time you call it, since Files currently has this restricted on delete. This is to prevent group files from getting deleted. Let me know if this needs to be changed.
	
	//### works
	public function delete_user($conn, $uSql)
	{
		if(!$db = mysqli_connect($conn->host_name(), $conn->host_user(), $conn->host_pass(), $conn->serv_name()))
		{
			return false;
		}
		
		if (!$result = mysqli_query($db ,$uSql->delete_user($this->user_id)))
		{
			mysqli_close($db);
			return false;
		} 
		
		// delete all of this classes variables
		$this->user_id = null;
		$this->email = null;
		$this->password = null;
		$this->google_id = null;
		$this->first_name = null;
		$this->last_name = null;
		$this->dob = null;
		$this->last_login = null;	// ### add this to class diagram, please
		$this->image_url = null;
		$this->phone = null;
		
		mysqli_close($db);		
		return true;
	}
	
	
	// sets user_id to the entered user_id
	// generally, use this for testing only
	
	public function set_user_id($user_id_in)
	{
		$this->user_id = $user_id_in; 
	}	
	
	
}


?>