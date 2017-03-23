<?php

/* basic database connection/disconnection*/




class dataAccess
{
	private $HOST_NAME = "localhost";
	private $HOST_USER = "root";
	private $HOST_PASS = "root";
	private $SERV_NAME = "groupShare";

	private $conn;
		
	// constructor
	function __construct() 
	{}


	// destructor
	function __destruct() 
	{
		if (is_connected())
		{
			close();
		}

		$HOST_NAME = null;
		$HOST_USER = null;
		$HOST_PASS = null;
		$SERV_NAME = null;
		$conn = null;
		
	}

	
	// Connects to the mySQL server then pings the server to check if the connection is established.
	// returns TRUE if connected, FALSE if it failed
	public function connect()
	{
		$conn = mysqli_connect($HOST_NAME, $HOST_USER, $HOST_PASS, $SERV_NAME);
		
		
		echo mysqli_get_server_info ($conn);
		
		
		
		return mysqli_ping($conn);	
	}
	
	
	// Disconnects from mySQL server	
	public function close()
	{
		mysqli_close($conn);
	}

		
	// pings the server to test the connection
	public function is_connected()	
	{		
	
		return mysqli_get_server_info ($conn);
//		return mysqli_ping($conn); 
	}

	
	// queries the server, use queries from $uSql, $gSql, etc
	public function query($query)
	{
		if (!$result = mysqli_query($conn, $query))
		{
			return FALSE;
		}
		
		return $result;
	}
	

	// returns the error number/type of a server connection error
	public function conn_error()
	{
		return mysqli_error($conn);
	}
}


?>