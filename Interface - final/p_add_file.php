<?php
session_start();

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
          $servername = "localhost";
          $username = "root";
          $password = "zxcvbnm";
          $dbname = "groupshare2";
        // Connect to the database
        $dbLink = new mysqli($servername, $username, $password, $dbname);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
///////////////////////////////////////// Retrieving user_id by comparing googleid session variable to googleid in database.
        $g_id = $_SESSION['id'];
        $q = "SELECT user_id FROM Users WHERE google_id = '{$g_id}'";
        $user_id = mysqli_query($dbLink, $q);
        $row = $user_id->fetch_assoc();
        $uid = $row['user_id'];
/////////////////////////////////////////
        
        // Gather all required data
        $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);

        // Create the SQL query
        $query = "
            INSERT INTO `pfile` (
                `user_id`, `name`, `mime`, `size`, `data`, `created`
            )
            VALUES (
                '{$uid}','{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )";
 
        // Execute the query
        $result = $dbLink->query($query);
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="file-page.php">here</a> to go back</p>';
?>
 
 