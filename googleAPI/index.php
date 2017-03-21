<?php 
session_start();

$StartDate = $EndDate = $Summary = "";

if (isset($_POST["StartDate"]) && $_POST["StartDate"] && isset($_POST["EndDate"]) && $_POST["EndDate"] && isset($_POST["Summary"]) && $_POST["Summary"])
{
    //we have enough values to make an event
    $_SESSION['StartDate'] = $_POST["StartDate"];
    $_SESSION['EndDate'] = $_POST["EndDate"];
    $_SESSION['Summary'] = $_POST["Summary"];
    $redirect = "signin.php";
    header('Location: ' . $redirect);
}
else
{
 //remove our session variables
    unset($_SESSION['StartDate']);
    unset($_SESSION['EndDate']);
    unset($_SESSION['Summary']);
}

$StartDate = $_POST["StartDate"];
$EndDate = $_POST["EndDate"];
$Summary = $_POST["Summary"];

?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body>

<form action="index.php" method="post">
  <fieldset>
    <legend>Calendar Add Entry:</legend>
    StartDate:<br>
    <input type="text" name="StartDate">
    <br>
    EndDate:<br>
    <input type="text" name="EndDate">
    <br>
    Summary:<br>
    <input type="text" name="Summary">
    <br><br>
    <input type="submit" value="Create">
  </fieldset>
</form>

<?php
echo "<h2>Your Input:</h2>";
echo "StartDate: ";
echo $StartDate;
echo "<br>";
echo "EndDate: ";
echo $EndDate;
echo "<br>";
echo "Summary: ";
echo $Summary;
echo "<br>";
echo "StartDate Session: ";
echo $_SESSION['StartDate'];
echo "<br>";
echo "EndDate Session: ";
echo $_SESSION['EndDate'];
echo "<br>";
echo "Summary Session: ";
echo $_SESSION['Summary'];
echo "<br>";
if (isset($_SESSION['createdEvent']) && $_SESSION['createdEvent'])
{
    echo $_SESSION['createdEvent'];
    unset ($_SESSION['createdEvent']);
}
?>

</body>
</html>