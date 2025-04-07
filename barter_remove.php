<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(!isset($_SESSION["UserID"]))
{
    echo "First User not detected!  Please log in to proceed!";
    header('Location:login.html');
}
else
{

//UserID from the session global
$_UserID = $_SESSION["UserID"];
//Get the ID to be deleted from the UserPage.
//$_ProductID = $_POST['ProductID'];
$Quantity = $_POST['Quantity'];
$_TransactionID = $_POST['TransactionID'];

//Get integer value of quantity
//This also hardens for SQL
$_Quantity = intval($Quantity);

echo '_Quantity is '.$_Quantity;
echo '_TransactionID is '.$_TransactionID;

//This grabs the integer from the string:
//$ID = intval(preg_replace('/[^0-9]+/','', $_ProductID), 10);

//$sql = "DELETE FROM transactions WHERE ProductID='$ID'";

//Get the current amount of the product in the transaction
$result = mysqli_query($conn, "SELECT Quantity1 as amount FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$Amount = $row['amount'];
$current_Amount = intval($Amount);

echo 'current_Amount '.$current_Amount;

//Get the new amount
$_amount = $current_Amount - $_Quantity;
echo '_amount '.$_amount;


//Get the ProductID from the tranaction.
$result = mysqli_query($conn, "SELECT ProductID1 as pID FROM transactions WHERE TransactionID='$_TransactionID'");
$row = mysqli_fetch_array($result);
$ID = $row['pID'];
$_ProductID = intval($ID);




if(intval($_amount) <= 0)
{
    $sql = "DELETE FROM transactions WHERE TransactionID='$_TransactionID'";
    $conn->query($sql);
    $conn->close();
}
else if (intval($_amount) > 0)
{
    //Calculate the amount to go back into products table
    $amount_Putback = $_Quantity;
    $new_total = $_amount;

    //echo 'amount_Putback '.$amount_Putback;

    $sql = "UPDATE products SET Amount='$amount_Putback' WHERE ProductID='$ID'";
    $conn->query($sql);

    $sql = "UPDATE transactions SET Quantity1='$_amount' WHERE TransactionID='$_TransactionID'";
    $conn->query($sql);
    $conn->close();
}
else
{
    header('Location:profile.php');
}

header('Location:profile.php');
exit();

}
?>