<?php 
session_start();

$StartDate = $EndDate = $Summary = "";
$NewStart = $NewEnd = $NewSum = $eventID = "";

//unset the blank fields
if (!isset($_POST['NewStart']))
{
    unset($_SESSION['NewStart']);
}
if (!isset($_POST["NewEnd"]))
{
    unset($_SESSION['NewEnd']);
}
if (!isset($_POST["NewSum"]))
{
    unset($_SESSION['NewSum']);
}
if (!isset($_POST["eventID"]))
{
    unset($_SESSION['eventID']);
}
if (isset($_POST['editButton']) && $_POST['editButton'] && isset($_POST['eventID']) && $_POST['eventID'])
{
    //we want to edit the event
    $_SESSION['NewStart'] = $_POST['NewStart'];
    $_SESSION['NewEnd'] = $_POST['NewEnd'];
    $_SESSION['NewSum'] = $_POST['NewSum'];
    $_SESSION['eventID'] = $_POST['eventID'];
    $redirect = "signin-editEvent.php";
    header('Location: ' . $redirect);
}

if (isset($_POST['deleteButton']) && $_POST['deleteButton'] && isset($_POST['eventID']) && $_POST['eventID'])
{
    //we want to edit the event
    $_SESSION['eventID'] = $_POST['eventID'];
    $redirect = "signin-deleteEvent.php";
    header('Location: ' . $redirect);
}

if (isset($_POST["StartDate"]) && $_POST["StartDate"] && isset($_POST["EndDate"]) && $_POST["EndDate"] && isset($_POST["Summary"]) && $_POST["Summary"] && isset($_POST['addButton']) && $_POST['addButton'])
{
    //we have enough values to make an event
    $_SESSION['StartDate'] = $_POST["StartDate"];
    $_SESSION['EndDate'] = $_POST["EndDate"];
    $_SESSION['Summary'] = $_POST["Summary"];
    $redirect = "signin-addEvent.php";
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
$NewStart = $_POST["NewStart"];
$NewEnd = $_POST["NewEnd"];
$NewSum = $_POST["NewSum"];
$eventID = $_POST["eventID"];

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
    <input type="submit" value="Create" name="addButton">
  </fieldset>
</form>
<form action="index.php" method="post">
  <fieldset>
    <legend>Calendar Edit Entry:</legend>
    StartDate:<br>
    <input type="text" name="NewStart">
    <br>
    EndDate:<br>
    <input type="text" name="NewEnd">
    <br>
    Summary:<br>
    <input type="text" name="NewSum">
    <br>
    EventID (NEEDED use list to find): <br>
    <input type="text" name="eventID">
    <br><br>
    <input type="submit" value="Edit" name="editButton">
  </fieldset>
</form>
<form action="index.php" method="post">
   <fieldset>
    <legend>Calendar Delete Entry:</legend>
    EventID (NEEDED use list to find): <br>
    <input type="text" name="eventID">
    <br><br>
    <input type="submit" value="Delete" name="deleteButton">
   </fieldset>
</form>
<form action="signin-listEvent.php" method="post">
    <input type="submit" value="List" name="listButton">
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
    
echo "NewStart: ";
echo $NewStart;
echo "<br>NewEnd: ";
echo $NewEnd;
echo "<br>NewSum: ";
echo $NewSum;
echo "<br>eventID: ";
echo $eventID;
echo "<br>NewStart Session: ";
echo $_SESSION['NewStart'];
echo "<br>NewEnd Session: ";
echo $_SESSION['NewEnd'];
echo "<br>NewSum Session: ";
echo $_SESSION['NewSum'];
echo "<br>eventID Session: ";
echo $_SESSION['eventID'];

?>

</body>
</html>