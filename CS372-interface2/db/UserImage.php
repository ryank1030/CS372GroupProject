<?






echo "<p>inside UserImage</p>";

class UserImage
{
	
/*	
	private var $image_id;
	private var $image_url;
	private var $image_name;
	private var $image_extension;
/*	
	
	public function get_this_image()
	{
		return $this;
	}
	
	
	public function get_this_image_id()
	{
		return $this->$image_id;
	}
	
	
	public function get_this_image_url()
	{
		return $this->$image_url;
	}
	
	
	public function get_this_image_name()
	{
		return $this->$image_name;
	}
	
	
	public function get_this_image_name()
	{
		return $this->$image_extension;
	}
	
	
	public function get_image_name_string()
	{
		return $this->$image_name + . + $this->$image_extension;
	}
	
	
	
	
	public function set_image($url_in, $name_in, $extension_in)
	{
		$this->$image_url = $url_in;
		$this->$image_name = $name_in;
		$this->$image_extension = $extension_in;
	}
	
	
	public function set_image($image_id_in, $url_in, $name_in, $extension_in)
	{
		$this->$image_id = $image_id_in;
		$this->$image_url = $url_in;
		$this->$image_name = $name_in;
		$this->$image_extension = $extension_in;
	}
	
	
	
	/* get user image info from server */
	/*
	public function get_image($db, $userID)
	{
		
		if (!$result = $db->query($uSql->get_user_image($userID)))
		{
			$result = $db->query($uSql->get_user_image('0'));	
		
		}

		
		/* process result here*/
		
/*		
		$this->$image_id = $result["image_id"];
		$this->$image_url = $result["image_url"];
		$this->$image_name = $result["image_name"];
		$this->$image_extension = $result["image_extension"];
		
		
		return TRUE;
	}	
	
	
	/* uploads user image info to server */
	
/*
	public function upload_image($db , $userID)
	{
		if (!is_null($image_id))
		{
			$this->$image_id = new_image_id($db);
		}
					
		$db->query($uSql->upload_image($image_id, $image_url, $image_name, $image_extension );
	
		$db->query($uSql->set_user_image($userID, $image_id));
		
		return TRUE;
		
	}
	

	public function new_image_id($db)
	{
		if ($old_id = $db->query($uSql->max_image_id()))
		{
			$new_id = $old_id + 1;
		}
		else
		{
			$new_id = 1;
		}
				
		return $new_id;
	}
	
	*/
	

}



echo "<p>end of UserImage</p>";

?>