<html>
<head>
<meta http-equiv="refresh" content="2">
</head>
<body>
<?php
//this is where the messages from the server will go

//connect to db

$link = mysqli_connect('localhost', 'root', 'zxcvbnm', 'groupshare2');

//$link = mysqli_connect('localhost', 'root', 'root', 'groupshare');

if (!$link)
{
	die('Could not connect2: ' . mysqli_error()); 
}



//query the database
$query = "SELECT * FROM chat_messages";

if($result = mysqli_query($link, $query)) {
	/*fetch associative array*/
	while ($row = mysqli_fetch_row($result))
	{
		$sql2 ="SELECT first_name, last_name FROM Users WHERE user_id = '$row[2]'";
		
		$nameresult = mysqli_query($link, $sql2);
		
		$row2 = mysqli_fetch_row($nameresult);
		
		echo $row2['0']. " " . $row2['1']. ' says: '.$row['4'].'<br/>';
	}
	mysqli_free_result($result);
}
	
/* free result set*/
mysqli_close($link);
	


?>
</body>
</html>