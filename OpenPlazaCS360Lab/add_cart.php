<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "openplaza";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

session_start();

//Get the ProductID and Amount passed from product_listings "Add To Cart" button
$ProductID = $_POST['ProductID'];
$Quantity = $_POST['Quantity'];

//Turn Amount into an integer for calculations
$_ProductID = intval($ProductID);
$_Quantity = intval($Quantity);

// echo "Quantity ".$_Quantity." ";
// echo "ProdID ".$ProductID." ";
// echo "_ProdID ".$_ProductID." ";

//Get the Amount as an integer to test if taking more than total:
$result = mysqli_query($conn, "SELECT Amount as amount FROM products WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$Prod_Amount = $row['amount'];
$_Prod_Amount = intval($Prod_Amount);

//echo 'ProdAmt '.$_Prod_Amount.' ';

if($_Quantity > $_Prod_Amount)
{
    echo "Not enough inventory!  Transaction failed!";
    header('Location:product_listings.php');
}
else
{
    $NewAmount = $_Prod_Amount - $_Quantity;
}

//Get the Price as an integer to be used with Amount to find a total checkout price:
$result = mysqli_query($conn, "SELECT Price as price FROM products WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$Price = $row['price'];
$_Price = intval($Price);

// echo 'Price '.$Price.' ';
// echo '_Price '.$_Price.' ';

//Calculate total transaction cost in a taxless fairyland
$_TotalPrice = $_Price * $_Quantity;
//echo "TotalPrice ".$_TotalPrice." ";

//Get the product name for organization in the cart:
$result = mysqli_query($conn, "SELECT ProductName as prodname FROM products WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$_ProductName = $row['prodname'];

//Grab the highest TransactionID in the column, then increment it by one for the new ID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(TransactionID) AS max FROM transactions");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$NewTransactionID = intval($PrevID) + 1;


//UserID from the session global
$_UserID = $_SESSION["UserID"];

//Check if the variables needed for a transaction have been set
if(isset($_ProductID) && isset($_UserID) && isset($_Quantity) && isset($_TotalPrice) && isset($_Price)) 
{
    //Put purchase information into transaction table
    $sql = "INSERT INTO transactions (TransactionID, ProductName, ProductID, UserID, Quantity, TotalPrice, Price) VALUES ('$NewTransactionID', '$_ProductName', '$_ProductID', '$_UserID', '$_Quantity', '$_TotalPrice', '$_Price')";
    $conn->query($sql);

    //Update the product with the lowered inventory amount
    $sql = "UPDATE Products SET Amount='$NewAmount' WHERE ProductID='$_ProductID'";
    $conn->query($sql);

    $conn->close();
    header('Location:cart.php');
}

//header('Location:product_listings.php');

?>