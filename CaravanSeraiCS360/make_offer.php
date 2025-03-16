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
$_Amount = $_POST['amount'];
$_TransactionID = $_POST['TransactionID'];

echo("Message is ".$_Message);

$Amount = intval($_Amount);
$TransactionID = intval($_TransactionID);

echo("_Amount is ".$_Amount);
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

$sql = "INSERT INTO messages (TransactionID, Amount, UserID1, UserID2, BarterMessage, MessageID) VALUES ('$_TransactionID','$_Amount','$_UserID','$_UserID2','$_Message','$_MessageID')";
$conn->query($sql);


header('Location:profile.php');


}


?>