<?php


include 'dataAccess.php';
include 'UserImage.php';

class User
{
	private $user_id;
	private $email;
	private $password;
	private	$google_id;
	private $first_name;
	private $last_name;
	private $dob;
	private $last_login;	// ### add this to class diagram, please

	private $profilepic = new UserImage();
	
		
	public function get_this_user()
	{
		return $this;
	}
	
	
	public function get_user_id()
	{
		return $this->$user_id;
	}

	
	public function get_email()
	{
		return $this->$email;
	}
	
	
	public function get_this_user_pass()
	{
		return $this->$password;
	}
	
	
	public function get_google_id()
	{
		return $this->$google_id;
	}
	
	
	public function get_first_name()
	{
		return $this->$first_name;
	}
	
	
	public function get_last_name()
	{
		return $this->$last_name;
	}
	
	
	public function get_dob()
	{
		return $this->$dob;
	}

	
	public function get_last_login()
	{
		return $this->$last_login;
	}

	
	public function get_this_user_image()
	{
		return $this->$profilepic->get_this_image();
	}
	

	public function set_user($db, $email_in, $google_id_in, $first_name_in, $last_name_in, $dob_in, $image_url_in, $image_name_in, $image_extension_in)
	{
		$this->$email = $email_in; 
		$this->$google_id = $google_id_in; 
		$this->$first_name = $first_name_in; 
		$this->$last_name = $last_name_in; 
		$this->$dob = $dob_in; 
		$this->$profilepic->set_image($image_url_in, $image_name_in, $image_extension_in);
	}	
	
	
	public function create_user($db, $googleID_in)
	{
		
		if (!$result = $db->query($db->$uSql->get_user_id($googleID_in)))
		{
			return false;
		} 
		
		// ### not sure if I have to do something else here
		$this->$user_id = $result;
		$this->$google_id = $googleID_in;
		
		
		if ($result = $db->query($db->$uSql->get_user($this->$user_id)))
		{
			$this->$email = $result["email"];
			$this->$password = $result["password"];
			$this->$first_name = $result["frist_name"];
			$this->$last_name = $result["last_name"];
			$this->$dob = $result["birth_date"];
			$this->$last_login = $result["last_login"];
		}
		
		$this->$profilepic->get_image($db, $userID);
		
		return true;
	}
	
	
	public function update_last_login($db)
	{
		
		if (!$result = $db->query($db->$uSql->user_update_login_time($this->$user_id)))
		{
			return false;
		} 
	
		$this->$user_id = $db->query($db->$uSql->user_last_login($this->$user_id))
	
	}
	
	
	
	/* 
		add in
	edit_user()
		
	
	*/
	
	
	
	
	
	

}




?>