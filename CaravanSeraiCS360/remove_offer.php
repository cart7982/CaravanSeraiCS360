<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(!isset($_SESSION["UserID"]))
{
    echo "First User not detected!  Please log in to proceed!";
    header('Location:login.html');
}

//UserID from the session global
$_UserID = $_SESSION["UserID"];
//Get the ID to be deleted from the UserPage.
//$_ProductID = $_POST['ProductID'];
$MessageID = $_POST['MessageID'];

//Get integer value of quantity
$_MessageID = intval($MessageID);

echo '_MessageID is '.$_MessageID;

$sql = "DELETE FROM messages WHERE MessageID='$_MessageID'";
$conn->query($sql);
header('Location:profile.php');


?>