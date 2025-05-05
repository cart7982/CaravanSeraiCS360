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
    echo "First User not detected!  Please log in to proceed!";
    header('Location:login.html');
}
else
{

//UserID from the session global
$_UserID = $_SESSION["UserID"];

echo('user id is '. $_UserID .'');

//Get the ProductID and Amount passed from Request Barter button
$ProductID = $_POST['ProductID'];
$Quantity = $_POST['Quantity'];

//Turn numbers into integers for calculations
//Since quantity is the only user input here, this also hardens for SQL
$_ProductID = intval($ProductID);
$_Quantity = intval($Quantity);

//Get the amount currently in the database
//Does not use external inputs, so not prepared
$result = mysqli_query($conn, "SELECT Amount as amount FROM products WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$Amount = $row['amount'];

//Turn amount into integer
$_Amount = intval($Amount);

$_TotalAmount = $Amount - $_Quantity;

echo("Amount is ".$Amount);
echo("_Amount is ".$_Amount);
echo("Total amount is ".$_TotalAmount);

//Compare current amount to request amount
if($_TotalAmount < 0)
{
    echo ("Insufficient amount of product in database.");
    header('Location:profile.php');
    exit();
}

if(isset($_SESSION["AdminID"]) && $_SESSION["AdminID"] != '0' && $_SESSION["AdminID"] != null)
{
    $_UserID = $_POST['userid1'];
    $_UserID2 = $_POST['userid2'];
    $_ProductName = $_POST['ProductName1'];
}


//Grab the highest ID in the transaction column, then increment it by one for the new ProductID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(TransactionID) AS max FROM transactions");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$_TransactionID = intval($PrevID) + 1;

//Get the Product name to match the product ID
$result = mysqli_query($conn, "SELECT ProductName as pname FROM products WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$_ProductName = $row['pname'];

//Get the ID of seller of the product
$result = mysqli_query($conn, "SELECT UserID as u2ID FROM products NATURAL JOIN owners WHERE ProductID='$_ProductID'");
$row = mysqli_fetch_array($result);
$_UserID2 = $row['u2ID'];

//Create new transaction from new ID
$sql = "INSERT INTO transactions (TransactionID, ProductID1, ProductID2, Quantity1,	Quantity2, UserID1,	UserID2, ProductName1, ProductName2, Completed) VALUES ('$_TransactionID','0','0','0','0','0','0','0','0','0')";
$conn->query($sql);

//Update purchase information on transaction table
$sql = "UPDATE transactions SET UserID1='$_UserID2',UserID2='$_UserID',Quantity1='$_Quantity',ProductID1='$_ProductID',ProductName1='$_ProductName' WHERE TransactionID='$_TransactionID'";
$conn->query($sql); 


//Update inventory information on products table - THIS SHOULD HAPPEN DURING THE ACCEPT PHASE ONLY
//$sql = "UPDATE products SET amount='$_TotalAmount' WHERE ProductID='$_ProductID'";
//$conn->query($sql); 

//header('Location:barter_cart.php');

if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
}
else
{
    
    //UserID from the session global
    header('Location:profile.php');
}

}


?>