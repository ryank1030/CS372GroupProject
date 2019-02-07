<?php
session_start();
		
$servername = "localhost";
$username = "root";
$password = "zxcvbnm";
ini_set('display_errors', 1);
ini_set('log_errors', 1); 
error_reporting(E_ALL | E_STRICT);
var_dump(function_exists('mysqli_connect')); 
$link = mysqli_connect("localhost", "root", "zxcvbnm", "groupshare");
echo "after";
// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


include 'db/User.php';

$user = new User;

$user->set_user($_GET['Email'], $_GET['ID'], $_GET['GivenName'], $_GET['FamilyName'], "1999-01-01", $_GET['Image'], 0);

$user->create_user($conn, $uSql);
$_SESSION['id'] = $_GET['ID'];
$_SESSION['firstname'] = $_GET['GivenName'];
$_SESSION['lastname'] = $_GET['FamilyName'];
$_SESSION['email'] = $_GET['Email'];
$_SESSION['image'] = $_GET['Image'];

$redirect = "homepage.php";
header("Location: " . $redirect);
    
echo $_GET['ID'];
echo "<br />";
echo $_GET['GivenName'];
echo "<br />";
echo $_GET['FamilyName'];
echo "<br />";
echo $_GET['Email'];
echo "<br />";
echo $_GET['Image'];
echo "<br />";

?>