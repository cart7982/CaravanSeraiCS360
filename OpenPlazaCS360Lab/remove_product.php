<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Get the ID to be deleted from the UserPage.
$_ProductID = $_POST['ProductID'];

//This grabs the integer from the string:
$ID = intval(preg_replace('/[^0-9]+/','', $_ProductID), 10);

$sql = "DELETE FROM products WHERE ProductID='$ID'";

$conn->query($sql);

$conn->close();

header('Location:product_listings.php');
?>