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
$_Amount1 = $_POST['amount1'];
$_Amount2 = $_POST['amount2'];
$_MessageID = $_POST['MessageID'];

//Account for escape characters such as '
$_Message = mysqli_real_escape_string($conn, $_POST['message']);

echo("Message is ".$_Message);

$Amount1 = intval($_Amount1);
$Amount2 = intval($_Amount2);
$MessageID = intval($_MessageID);

echo("_Amount1 is ".$_Amount1);
echo("_Amount2 is ".$_Amount2);
echo("_MessageID is ".$_MessageID);


if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
}
else
{

//UserID from the session global
$_UserID = $_SESSION["UserID"];
echo("_UserID is ".$_UserID);


//Get the amount of product currently in the database
$result = mysqli_query($conn, "SELECT TransactionID as tID FROM messages WHERE MessageID='$_MessageID'");
$row = mysqli_fetch_array($result);
$_TransactionID = $row['tID'];
$TransactionID = intval($_TransactionID);


//Get the amount of product currently in the database
$result = mysqli_query($conn, "SELECT ProductID1 as pID1, ProductID2 as pID2 FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$_ProductID1 = $row['pID1'];
$_ProductID2 = $row['pID2'];


//Get the amount of product currently in the database
$result = mysqli_query($conn, "SELECT Amount as pamount FROM products WHERE ProductID='$_ProductID1'");
$row = mysqli_fetch_array($result);
$_pAmount1 = $row['pamount'];
$pAmount1 = intval($_pAmount1);

if($Amount1 > $pAmount1)
{
    echo "Not enough product!";
    header('Location:profile.php');
}


//Get the amount of product currently in the database
$result = mysqli_query($conn, "SELECT Amount as pamount FROM products WHERE ProductID='$_ProductID2'");
$row = mysqli_fetch_array($result);
$_pAmount2 = $row['pamount'];
$pAmount2 = intval($_pAmount2);

if($Amount2 > $pAmount2)
{
    echo "Not enough product!";
    header('Location:profile.php');
}


//Get the second user ID from the transaction
$result = mysqli_query($conn, "SELECT UserID2 AS u2ID FROM messages WHERE MessageID='$_MessageID'");
$row = mysqli_fetch_array($result);
$PrevID = $row['u2ID'];
$_UserID2 = intval($PrevID);

//Update the message with the new information.
$sql = "UPDATE messages SET Amount1='$_Amount1',Amount2='$_Amount2',BarterMessage='$_Message',MessageUserID='$_UserID' WHERE MessageID='$_MessageID'";

$conn->query($sql); 


$conn->close();

header('Location:profile.php');


}


?>