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

//Get the second user ID from the transaction
$result = mysqli_query($conn, "SELECT UserID2 AS u2ID FROM messages WHERE MessageID='$_MessageID'");
$row = mysqli_fetch_array($result);
$PrevID = $row['u2ID'];
$_UserID2 = intval($PrevID);



$sql = "UPDATE messages SET Amount1='$_Amount1',Amount2='$_Amount2',BarterMessage='$_Message' WHERE MessageID='$_MessageID'";
$conn->query($sql); 



header('Location:profile.php');


}


?>