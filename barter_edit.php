<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

session_start();
if (!isset($_SESSION["UserID"]))
{
    echo "Login failed!  No user ID found!";
    header("Location:login.html");
    exit();
}

//TransactionID 	ProductID1 	ProductID2 	Quantity1 	Quantity2 	UserID1 	UserID2 	ProductName1 	ProductName2 	Completed
$_TransactionID = $_POST["TransactionID"];
$_NewTransactionID = $_POST["NewTransactionID"];
$_ProductID1 = $_POST["ProductID1"];
$_ProductID2 = $_POST["ProductID2"];
$_Quantity1 = $_POST["Quantity1"];
$_Quantity2 = $_POST["Quantity2"];
$_UserID1 = $_POST["UserID1"];
$_UserID2 = $_POST["UserID2"];
$_ProductName1 = $_POST["ProductName1"];
$_ProductName2 = $_POST["ProductName2"];
$_Completed = $_POST["Completed"];

//Check if each variable has been set, and then update it if it has.
//TransactionID is updated at the end.
if(isset($_POST["ProductID1"]))
{
    $stmt = $conn->prepare("UPDATE transactions SET ProductID1 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_ProductID1, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["ProductID2"])) {
    $stmt = $conn->prepare("UPDATE transactions SET ProductID2 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_ProductID2, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["Quantity1"])) {
    $stmt = $conn->prepare("UPDATE transactions SET Quantity1 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_Quantity1, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["Quantity2"])) {
    $stmt = $conn->prepare("UPDATE transactions SET Quantity2 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_Quantity2, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["UserID1"])) {
    $stmt = $conn->prepare("UPDATE transactions SET UserID1 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_UserID1, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["UserID2"])) {
    $stmt = $conn->prepare("UPDATE transactions SET UserID2 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_UserID2, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["ProductName1"])) {
    $stmt = $conn->prepare("UPDATE transactions SET ProductName1 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_ProductName1, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["ProductName2"])) {
    $stmt = $conn->prepare("UPDATE transactions SET ProductName2 = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_ProductName2, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST["Completed"])) {
    $stmt = $conn->prepare("UPDATE transactions SET Completed = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_Completed, $_TransactionID);
    $stmt->execute();
    $stmt->close();

}

if(isset($_POST["NewTransactionID"]) && $_NewTransactionID != '' && $_NewTransactionID != null)
{
    $stmt = $conn->prepare("UPDATE transactions SET TransactionID = ? WHERE TransactionID = ?");
    $stmt->bind_param("ss", $_NewTransactionID, $_TransactionID);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header('Location:profile.php');
exit();
?>