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
$_ProductID1 = $_POST['ProductID1'];
$_ProductName1 = $_POST['ProductName1'];
$_UserID = $_POST['UserID'];

//Account for escape characters such as '
$_Message = mysqli_real_escape_string($conn, $_POST['message']);

echo("Message is ".$_Message);

$Amount1 = intval($_Amount1);
$Amount2 = intval($_Amount2);

echo("Counteroffer _Amount1 is ".$_Amount1);
echo("_Amount2 is ".$_Amount2);
echo("_MessageID is ".$_MessageID);
echo("_ProductID1 is ".$_ProductID1);
echo("_ProductName1 is ".$_ProductName1);
echo("_UserID1 is ".$_UserID1);


if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
}
else
{

//UserID from the session global
$_GUserID = $_SESSION["UserID"];
echo("_UserID is ".$_UserID);


//Get the amount of product currently in the database
$result = mysqli_query($conn, "SELECT TransactionID as tID FROM messages WHERE MessageID='$_MessageID'");
$row = mysqli_fetch_array($result);
$_TransactionID = $row['tID'];
$TransactionID = intval($_TransactionID);


//Get the IDs of the products currently in the database from transactions
$result = mysqli_query($conn, "SELECT ProductID1 as pID1, ProductID2 as pID2 FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
//$_ProductID1 = $row['pID1'];
$_ProductID2 = $row['pID2'];


//Get the amount of product currently in the database
$result = mysqli_query($conn, "SELECT Amount as pamount FROM products WHERE ProductID='$_ProductID1'");
$row = mysqli_fetch_array($result);
$_pAmount1 = $row['pamount'];
$pAmount1 = intval($_pAmount1);

echo "pAmount1 is: ".$pAmount1;

if($Amount1 > $pAmount1)
{
    echo "First Not enough product!";
    //header('Location:profile.php');
}
else
{


//Get the amount of product currently in the database
$result = mysqli_query($conn, "SELECT Amount as pamount FROM products WHERE ProductID='$_ProductID2'");
$row = mysqli_fetch_array($result);
$_pAmount2 = $row['pamount'];
$pAmount2 = intval($_pAmount2);

echo "pAmount2 is: ".$pAmount2;

if($Amount2 > $pAmount2)
{
    echo "Second Not enough product!";
    //header('Location:profile.php');
}
else
{

//Get the first user ID from the transaction
$result = mysqli_query($conn, "SELECT UserID1 AS u1ID FROM messages WHERE MessageID='$_MessageID'");
$row = mysqli_fetch_array($result);
$UserID1 = $row['u1ID'];

//Get the second user ID from the transaction
$result = mysqli_query($conn, "SELECT UserID2 AS u2ID FROM messages WHERE MessageID='$_MessageID'");
$row = mysqli_fetch_array($result);
$UserID2 = $row['u2ID'];

//Update the message with the new information.

if($_GUserID == $UserID1)
{
    $stmt = $conn->prepare("UPDATE messages SET Amount1=?,Amount2=?,ProductName1=?,BarterMessage=?,MessageUserID=?,Product1UserID=? WHERE MessageID=?");
    $stmt->bind_param("iisssss", $_Amount1, $_Amount2, $_ProductName1, $_Message, $_GUserID, $_UserID, $_MessageID);
    $stmt->execute();
    $stmt->close();

    $sql = "UPDATE messages SET Amount1='$_Amount1',Amount2='$_Amount2',ProductName1='$_ProductName1',BarterMessage='$_Message',MessageUserID='$_GUserID',Product1UserID='$_UserID' WHERE MessageID='$_MessageID'";

}
else
{
    $sql = "UPDATE messages SET Amount1='$_Amount2',Amount2='$_Amount1',ProductName2='$_ProductName1',BarterMessage='$_Message',MessageUserID='$_GUserID',Product2UserID='$_UserID' WHERE MessageID='$_MessageID'";
}


$conn->query($sql); 

//$sql = "UPDATE transactions SET Quantity2='$_Amount1',ProductName2='$_ProductName1',ProductID2='$_ProductID1',UserID2='$_UserID1' WHERE TransactionID='$_TransactionID'";

//$conn->query($sql); 



$conn->close();

header('Location:profile.php');


} //These brackets are the ugly solution to using header:
} //Each one closes out an if-else statement.
} //Without them, the rest of the page plays out even after the header change.

?>