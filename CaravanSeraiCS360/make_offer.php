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

$_Message = $_POST['message'];
$_Amount1 = $_POST['amount'];//Amount of product being offered
$_TransactionID = $_POST['TransactionID'];

$_ProductID = $_POST['ProductID'];
$_ProductName = $_POST['ProductName'];

echo '_ProductID is '.$_ProductID;
echo 'ProductName is '.$_ProductName;

echo("Message is ".$_Message);

$Amount = intval($_Amount1);
$TransactionID = intval($_TransactionID);

echo("_Amount is ".$_Amount1);
echo("_TransactionID is ".$_TransactionID);


if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
}
else
{

//UserID from the session global
$_UserID = $_SESSION["UserID"];


//Grab the highest ID in the messages column, then increment it by one for the new MessageID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(MessageID) AS max FROM messages");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$_MessageID = intval($PrevID) + 1;

//Get the second user ID from the transaction
$result = mysqli_query($conn, "SELECT UserID2 AS u2ID FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$PrevID = $row['u2ID'];
$_UserID2 = intval($PrevID);

//Get the second amount from the transaction
$result = mysqli_query($conn, "SELECT Quantity1 AS amount1 FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$PrevID = $row['amount1'];
$_Amount2 = intval($PrevID);

//Get the second productname from the transaction
$result = mysqli_query($conn, "SELECT ProductName1 AS pname1 FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$_ProductName2 = $row['pname1'];
//$_ProductName2 = intval($PrevID);


$sql = "INSERT INTO messages (MessageID) VALUES ('$_MessageID')";
$conn->query($sql);

$sql = "UPDATE messages SET ProductName1='$_ProductName',ProductName2='$_ProductName2',TransactionID='$_TransactionID',Amount1='$_Amount1',Amount2='$_Amount2',UserID1='$_UserID',UserID2='$_UserID2',BarterMessage='$_Message' WHERE MessageID='$_MessageID'";
$conn->query($sql);


header('Location:profile.php');


}


?>