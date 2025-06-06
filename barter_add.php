<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
if (!isset($_SESSION["UserID"]))
{
    echo "Login failed!  No user ID found!";
    header("Location:login.html");
    exit();
}

//Get the vars thrown from profile.php
$_Quantity = $_POST['Quantity'];
$_TransactionID = $_POST['TransactionID'];

//Get integer value of quantity
//Since this is the only user inputted value, this page is secure against SQL injection.
$Quantity = intval($_Quantity);

echo 'Quantity is '.$_Quantity;



//Get the current amount of the product in the transaction.
//Queries like this don't need to be hardened using $stmt prepare since they are only using internal IDs.
$result = mysqli_query($conn, "SELECT Quantity1 as amount FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$Amount = $row['amount'];
$current_Amount = intval($Amount);


echo 'current_Amount '.$current_Amount;


//Get the new amount for the transaction
$_amount = $current_Amount + $Quantity;
echo '_amount '.$_amount;


$sql = "UPDATE transactions SET Quantity1='$_amount' WHERE TransactionID='$_TransactionID'";
$conn->query($sql);


$conn->close();

header('Location:profile.php');

?>