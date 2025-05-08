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
    exit();
}

//UserID posted from previous
$_UserID = $_SESSION["UserID"];

//If an admin has posted the userID to be removed
if(isset($_POST["UserID"]))
{
   $_UserID = $_POST["UserID"];
}

//Get the posted group ID
$_GroupID = $_POST["GroupID"];

echo '_UserID is '.$_UserID;

$sql = "DELETE FROM user_groups WHERE UserID='$_UserID' AND GroupID='$_GroupID'";
$conn->query($sql);
header('Location:profile.php');


?>