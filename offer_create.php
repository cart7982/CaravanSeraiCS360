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
$_ProdUserID = $_POST['UserID'];

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
    header('Location:login.html');
    exit();
}

//UserID from the session global
$_UserID = $_SESSION["UserID"];

 //Get the amount of product currently in the database
 $result = mysqli_query($conn, "SELECT Amount as pamount FROM products WHERE ProductID='$_ProductID'");
 $row = mysqli_fetch_array($result);
 $_pAmount = $row['pamount'];
 $pAmount = intval($_pAmount);

 if($Amount > $pAmount)
 {
    echo "Not enough product!";
    header('Location:make_offer.php');
    exit();
 }


//Grab the highest ID in the messages column, then increment it by one for the new MessageID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(MessageID) AS max FROM messages");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$_MessageID = intval($PrevID) + 1;

//Get the first user ID from the transaction
$result = mysqli_query($conn, "SELECT UserID1 AS u1ID FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$PrevID = $row['u1ID'];
//$_UserID1 = intval($PrevID);
$_UserID1 = $PrevID;

//Get the second user ID from the transaction
$result = mysqli_query($conn, "SELECT UserID2 AS u2ID FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$PrevID = $row['u2ID'];
//$_UserID2 = intval($PrevID);
$_UserID2 = $PrevID;

//This lets an admin create new messages that don't use their own ID
if(isset($_SESSION["AdminID"]) && $_SESSION["AdminID"] != '0')
{
    $_UserID = $_UserID2;
}

//Get the second amount from the transaction
$result = mysqli_query($conn, "SELECT Quantity1 AS amount1, ProductID1 AS productID1 FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$Amount = $row['amount1'];
$_Amount2 = intval($Amount);
$_ProductID2 = $row['productID1'];

//Get the second productname from the transaction
$result = mysqli_query($conn, "SELECT ProductName1 AS pname1 FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$_ProductName2 = $row['pname1'];
//$_ProductName2 = intval($PrevID);

echo "_ProductName is: ".$_ProductName;
echo "_UserID is: ".$_UserID;
echo "_UserID2 is: ".$_UserID2;
echo "_ProductName2 is: ".$_ProductName2;

//Update the transaction with the second product name and ID
//$sql = "UPDATE transactions SET ProductName2='$_ProductName',ProductID2='$_ProductID',UserID2='$_ProdUserID',Quantity2='$Amount' WHERE TransactionID='$_TransactionID'";

//THIS NEEDS TO KEEP THE USER IDS THE SAME
//SO THAT THE ORIGINAL USER STAYS IN THE LOOP
//THE TRANSACTION SHOULD NOT BE ALTERED FROM HERE UNTIL ACCEPTANCE
$stmt = $conn->prepare("UPDATE transactions SET ProductName2 = ?, ProductID2 = ?, Quantity2 = ? WHERE TransactionID = ?");
$stmt->bind_param("ssis", $_ProductName, $_ProductID, $Amount, $_TransactionID);
$stmt->execute();
$stmt->close();

//Create the initial message
$stmt = $conn->prepare("INSERT INTO messages (MessageID, UserID1, UserID2, BarterMessage, TransactionID, Amount1, Amount2, ProductName1, ProductID1, ProductName2, ProductID2, MessageUserID, Product1UserID, Product2UserID  ) VALUES (?, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')");
$stmt->bind_param("s", $_MessageID);
$stmt->execute();
$stmt->close();

//Add the barter information into the message
$stmt = $conn->prepare("UPDATE messages SET 
    Product1UserID = ?, 
    Product2UserID = ?, 
    ProductName1 = ?, 
    ProductID1 = ?, 
    ProductName2 = ?,  
    ProductID2 = ?, 
    TransactionID = ?, 
    Amount1 = ?, 
    Amount2 = ?, 
    UserID1 = ?, 
    UserID2 = ?, 
    BarterMessage = ?, 
    MessageUserID = ?
    WHERE MessageID = ?"
);
$stmt->bind_param(
    "ssssssssssssss", 
    $_UserID,
    $_UserID1,
    $_ProductName,
    $_ProductID,
    $_ProductName2,
    $_ProductID2,
    $_TransactionID,
    $_Amount1,
    $_Amount2,
    $_UserID,
    $_UserID1,
    $_Message,
    $_UserID,
    $_MessageID
);
$stmt->execute();
$stmt->close();
header('Location:profile.php');
exit();


?>