<?php

/* basic database connection/disconnection*/



echo "<p> inside dataAccess.php /n</p>";


include 'userSQL.php';

$uSql = new UserSQL;



class dataAccess
{

	
	private $HOST_NAME = "localhost";
	private $HOST_USER = "root";
	private $HOST_PASS = "root";
	private $SERV_NAME = "groupShare";

	private $conn;
		

		
	// Connects to the mySQL server
	public function connect()
	{
		$conn = mysqli_connect($HOST_NAME, $HOST_USER, $HOST_PASS, $SERV_NAME);
		
		if (mysqli_connect_errno())
		{
			return FALSE;
		}

		return $conn;
	}
	
	
	// Disconnects from mySQL server	
	public function close()
	{
		mysqli_close($conn);
	}

		
	// checks server connection
	public function is_connected()	
	{
		echo "<p> testing connection </p>";
		
		if (!$conn) 
		{ 
			return FALSE;
		}
	
		return TRUE;
	}

	
	// returns the database connection as a variable
	public function get_conn()	
	{
		return $conn;
	}
	
	
	// queries the server, use queries from $uSql, $gSql, etc
	public function query($query)
	{
		$result = mysqli_query($conn, $query);
		
		if (!$result)
		{
			return FALSE;
		}
		
		return $result;
	}
	

	// returns the error number/type of a server connection error
	public function conn_error()
	{
		return mysqli_connect_errno();
	}


}



echo "<p>end of dataAccess </p>";




?>