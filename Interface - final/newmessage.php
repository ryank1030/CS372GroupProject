<?php
session_start();

if(ISSET($_POST['message']))
{
	//connect to db
	$link = mysqli_connect('localhost', 'root', 'zxcvbnm', 'groupshare');
	//$link = mysqli_connect('localhost', 'root', 'root', 'groupshare');
	if (!$link)
	{
		die('Could not connect1: ' . mysqli_error()); 
	}

	$message_contents = mysqli_real_escape_string($link, $_POST['message']);
	
	$groupID = $SESSION['gid'];
	$userID = $SESSION['id'];
	$sql = "INSERT INTO Chat_Messages (group_id, user_id, date_created, message_contents)
	VALUES ('$groupID', '$userID', NOW(), '$message_contents')";
	
	$result = mysqli_query($link, $sql);
	
	//close conection
	mysqli_close($link);
}

echo '<form action="newmessage.php" method="POST">';
echo '<textarea name="message" rows="3" cols="50"></textarea>';
echo '<input type="submit" name="Send"/>';
echo '</form>';



?>