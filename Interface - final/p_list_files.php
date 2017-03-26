<?php
session_start();

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
// Query for a list of all existing files

$sql = "SELECT pfid, name, round(size/1024/1024, 2) as size_mb, created FROM pfile WHERE user_id = (Select user_id from pfile where user_id = '{$uid}') ORDER BY name ASC;";
$result = $dbLink->query($sql);

// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no files in the database</p>';
    }
    else {
        // Print the top of a table
        echo '<table width="100%">
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Size (MB)</b></td>
                    <td><b>Upload Time</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['size_mb']}</td>
                    <td>{$row['created']}</td>
                    <td><a href='p_get_file.php?id={$row['pfid']}'>Download</a></td>
                    <td><a href='p_delete_file.php?id={$row['pfid']}'>Delete</a></td>
                </tr>";
        }
 
        // Close table
        echo '</table>';
    }
 
    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}
 
// Close the mysql connection
$dbLink->close();
?>