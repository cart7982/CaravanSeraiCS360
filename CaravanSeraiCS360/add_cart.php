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
    header('Location:index.php');
}
else
{
    $NewAmount = $_Prod_Amount - $_Quantity;
}

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
//$_UserID = $_SESSION["UserID"];

//Check if the variables needed for a transaction have been set
if(isset($_ProductID) && isset($_Quantity)) 
{
    //Check if there is already a quantity for that product ID
    $result = mysqli_query($conn, "SELECT Quantity as quantity FROM transactions WHERE ProductID='$_ProductID' AND UserID='$_UserID'");

    //If a quantity is found
    if($result->num_rows != 0)
    {
        //Get integer value of that quantity
        $row = mysqli_fetch_array($result);
        $add_on = $row['quantity'];
        $_add_on = intval($add_on);

        //Calculate new quantity for transaction
        $new_quantity = $_add_on + $_Quantity;
        echo "new_quantity ".$new_quantity." ";
        $new_total = $new_quantity;

        //Update purchase information on transaction table
        $sql = "UPDATE transactions SET Quantity='$new_quantity' WHERE ProductID='$_ProductID' AND UserID='$_UserID'";
        $conn->query($sql);    
        
        //Update the product with the lowered inventory amount
        $sql = "UPDATE products SET Amount='$NewAmount' WHERE ProductID='$_ProductID'";
        $conn->query($sql);

    }
    else
    {
        //No quantity was found, so insert new transaction
        //Put purchase information into transaction table
        $sql = "INSERT INTO transactions (TransactionID, ProductName, ProductID, UserID, Quantity) VALUES ('$NewTransactionID', '$_ProductName', '$_ProductID', '$_UserID', '$_Quantity')";
        $conn->query($sql);

        //Update the product with the lowered inventory amount
        $sql = "UPDATE products SET Amount='$NewAmount' WHERE ProductID='$_ProductID'";
        $conn->query($sql);

        $conn->close();
    }

    header('Location:cart.php');
}

//header('Location:product_listings.php');

?>