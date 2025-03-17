<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

session_start();

if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    header('Location:login.html');
}

unset($_SESSION['Groupname']);
unset($_SESSION['GroupID']);


header('Location:profile.php');

?>