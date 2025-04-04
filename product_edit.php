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
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
}
else
{
//UserID from the session global
$_UserID = $_SESSION["UserID"];

$_ProductName = $_POST['productname'];
$_Description = $_POST['description'];
$_ProductID = $_POST['ProductID'];

$sql = "UPDATE products SET ProductName='$_ProductName',Description='$_Description' WHERE ProductID='$_ProductID'";
$conn->query($sql);


header('Location:profile.php');
}
?>