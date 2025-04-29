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

//UserID from the session global
$_UserID = $_SESSION["UserID"];
//Get the ID to be deleted from the UserPage.
//$_ProductID = $_POST['ProductID'];
$_TransactionID = $_POST['TransactionID'];

echo '_TransactionID is '.$_TransactionID;

$sql = "DELETE FROM messages WHERE TransactionID='$_TransactionID'";
$conn->query($sql);
$sql = "DELETE FROM transactions WHERE TransactionID='$_TransactionID'";
$conn->query($sql);
header('Location:profile.php');


?>