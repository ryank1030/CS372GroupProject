<?php
session_start();

if(ISSET($_POST['message']))
{
	//connect to db
	$link = mysqli_connect('localhost', 'root', 'midna10039', 'IM');
	if (!$link)
	{
		die('Could not connect: ' . mysqli_error()); 
	}

	$message = mysqli_real_escape_string($link, $_POST['message']);
	$username = mysqli_real_escape_string($link, $_SESSION['username']);

	$sql = "INSERT INTO messages (message, username)
	VALUES ('$message', '$username')";
	
	$result = mysqli_query($link, $sql);
	
	//close conection
	mysqli_close($link);
}

echo '<form action="newmessage.php" method="POST">';
echo '<textarea name="message" rows="3" cols="50"></textarea>';
echo '<input type="submit" name="Send"/>';
echo '</form>';



?>