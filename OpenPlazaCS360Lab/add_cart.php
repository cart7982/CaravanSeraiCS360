<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "openplaza";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//Get the ProductID and Amount passed from product_listings "Add To Cart" button
$_ProductID = $_POST['ProductID'];
$_Amount = $_POST['Amount'];

//UserID from the session global
$_UserID = $_SESSION["UserID"];

if(isset($_ProductName) && isset($_Amount) && isset($_Description)) 
{
    //$sql = "INSERT INTO products (ProductName, ProductID, UserID, Amount, Description, Price) VALUES ('$_ProductName', '$_ProductID', '$_UserID', '$_Amount', '$_Description', '$_Price')";

    //Commit the query to the database connection.
    //$conn->query($sql);

    //$conn->close();
}

header('Location:product_listings.php');

?>