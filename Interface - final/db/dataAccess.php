<?php

// basic database connection/disconnection addresses
class DataAccess
{
	private $HOST_NAME = "localhost";
	private $HOST_USER = "root";
	private $HOST_PASS = "zxcvbnm";
	private $SERV_NAME = "groupshare2";
	
	public function host_name()
	{
		return $this->HOST_NAME;		
	}
	
	public function host_user()
	{
		return $this->HOST_USER;		
	}
	
	public function host_pass()
	{
		return $this->HOST_PASS;		
	}
	
	public function serv_name()
	{
		return $this->SERV_NAME;		
	}
	
}	
?>