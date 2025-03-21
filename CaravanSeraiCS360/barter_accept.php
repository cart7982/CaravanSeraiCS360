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

//UserID from the session global
$_UserID = $_SESSION["UserID"];

//Transaction database will be updated in here using MessageID
//This means getting BOTH productIDs (Or the transactionID and ProductID2)
//This also needs to remove the message from the database

$_MessageID = $_POST['MessageID'];

//FIRST it needs to get an accept from BOTH PARTIES
//Whichever ID is in the MessageUserID is considered to have ALREADY ACCEPTED
//That column is set by Make Offer and Counteroffer
//Get the second user ID from the transaction

$result = mysqli_query($conn, "SELECT MessageUserID AS accept1 FROM messages WHERE MessageID='$_MessageID'");
$row = mysqli_fetch_array($result);
$accept1 = $row['accept1'];

//echo "accept1 is: ".$accept1;

//$sql = "SELECT MessageUserID AS accept1 FROM messages WHERE MessageID='$_MessageID'";
//$conn->query($sql);

if($accept1 != null && $accept1 != $_UserID)
{
    $result = mysqli_query($conn, "SELECT Amount1 AS amt1, Amount2 AS amt2, TransactionID as trnID FROM messages WHERE MessageID='$_MessageID'");
    $row = mysqli_fetch_array($result);
    $_Amount1 = $row['amt1'];
    $_Amount2 = $row['amt2'];
    $_TransactionID = $row['trnID'];

    echo "_Amount1 is: ".$_Amount1;
    echo "_Amount2 is: ".$_Amount2;
    echo "_TransactionID is: ".$_TransactionID;

    $Amount1 = intval($_Amount1);
    $Amount2 = intval($_Amount2);

    //Finalize the transaction tuple with the agreed numbers
    $sql = "UPDATE transactions SET Quantity1='$_Amount1',Quantity2='$_Amount2' where TransactionID='$_TransactionID'";
    $conn->query($sql);


    //Get the product id for the first product currently in the database
    $result = mysqli_query($conn, "SELECT ProductID1 as pID1 FROM transactions WHERE TransactionID='$_TransactionID'");
    $row = mysqli_fetch_array($result);
    $_ProductID1 = $row['pID1'];

    echo "_ProductID1 is: ".$_ProductID1;

    //Get the amount of product1 currently in the database
    $result = mysqli_query($conn, "SELECT Amount as amount FROM products WHERE ProductID='$_ProductID1'");
    $row = mysqli_fetch_array($result);
    $_Product1Amount = $row['amount'];
    $Product1Amount = intval($_Product1Amount);

    echo "Product1Amount is: ".$Product1Amount;

    //Calculate new amount for database
    $NewProduct1Amount = $Product1Amount - $Amount1;

    $sql = "UPDATE products SET Amount='$NewProduct1Amount' WHERE ProductID='$_ProductID1'";
    $conn->query($sql);

    //Get the product id for the second product currently in the database
    $result = mysqli_query($conn, "SELECT ProductID2 as pID2 FROM transactions WHERE TransactionID='$_TransactionID'");
    $row = mysqli_fetch_array($result);
    $_ProductID2 = $row['pID2'];

    echo "_ProductID2 is: ".$_ProductID2;

    //Get the amount of product1 currently in the database
    $result = mysqli_query($conn, "SELECT Amount as amount FROM products WHERE ProductID='$_ProductID2'");
    $row = mysqli_fetch_array($result);
    $_Product2Amount = $row['amount'];
    $Product2Amount = intval($_Product2Amount);

    //Calculate new amount for database
    //The amounts SHOULD be correct already by way of make_offer and counteroffer
    $NewProduct2Amount = $Product2Amount - $Amount2;

    $sql = "UPDATE products SET Amount='$NewProduct2Amount' WHERE ProductID='$_ProductID2'";
    $conn->query($sql);

    //Remove entries that have emptied out
    $sql = "DELETE FROM products WHERE Amount='0'";
    $conn->query($sql);
    

    //Get the user IDs from the transaction
    $result = mysqli_query($conn, "SELECT UserID1 AS uID1, UserID2 AS uID2 FROM transactions WHERE TransactionID='$_TransactionID'");
    $row = mysqli_fetch_array($result);
    $_UserID1 = $row['uID1'];
    $_UserID2 = $row['uID2'];
    
    echo "_UserID1 is: ".$_UserID1;
    echo "_UserID2 is: ".$_UserID2;

    //Check for products using UserID with ProductID1
    $result = mysqli_query($conn, "SELECT ProductID as pID FROM products WHERE UserID='$_UserID1' AND ProductID='$_ProductID1'");
    $row = mysqli_fetch_array($result);

    if($row != null)
    {
        $_ProductID1 = $row['pID'];

        //reused productid1...
        echo "2nd _ProductID1 is: ".$_ProductID1;

        //Get the amount of product1 currently in the database
        $result = mysqli_query($conn, "SELECT Amount as amount FROM products WHERE ProductID='$_ProductID1'");
        $row = mysqli_fetch_array($result);
        $_Product1Amount = $row['amount'];
        $Product1Amount = intval($_Product1Amount);

        echo "Product1Amount is: ".$Product1Amount;
        echo "Amount1 is: ".$Amount1;

        $NewProduct1Amount = $Product1Amount + $Amount1;

        $sql = "UPDATE products SET Amount='$NewProduct1Amount' WHERE ProductID='$_ProductID1'";
        $conn->query($sql);
    }
    else
    {
        //Grab the highest ID in the ProductID column, then increment it by one for the new ProductID to be assigned.
        $result = mysqli_query($conn, "SELECT MAX(ProductID) AS max FROM products");
        $row = mysqli_fetch_array($result);
        $PrevID = $row['max'];
        $_newProductID1 = intval($PrevID) + 1;

        //Grab the product name from the product table.
        $result = mysqli_query($conn, "SELECT ProductName as pname FROM products WHERE ProductID='$_ProductID2'");
        $row = mysqli_fetch_array($result);
        $_ProductName1 = $row['pname'];

        $sql = "INSERT INTO products (ProductName, ProductID, UserID, Amount) VALUES ('$_ProductName1', '$_newProductID1', '$_UserID2', '$Amount1')";
        //Commit the query to the database connection.
        $conn->query($sql);
    }


    $result = mysqli_query($conn, "SELECT ProductID as pID FROM products WHERE UserID='$_UserID2' AND ProductID='$_ProductID2'");
    $row = mysqli_fetch_array($result);

    if($row != null)
    {
        $_ProductID2 = $row['pID'];

        //Get the amount of product1 currently in the database
        $result = mysqli_query($conn, "SELECT Amount as amount FROM products WHERE ProductID='$_ProductID2'");
        $row = mysqli_fetch_array($result);
        $_Product2Amount = $row['amount'];
        $Product2Amount = intval($_Product2Amount);

        $NewProduct2Amount = $Product2Amount + $Amount2;

        $sql = "UPDATE products SET Amount='$NewProduct2Amount' WHERE ProductID='$_ProductID2'";
        $conn->query($sql);
    }
    else
    {
        //Grab the highest ID in the ProductID column, then increment it by one for the new ProductID to be assigned.
        $result = mysqli_query($conn, "SELECT MAX(ProductID) AS max FROM products");
        $row = mysqli_fetch_array($result);
        $PrevID = $row['max'];
        $_newProductID2 = intval($PrevID) + 1;


        //Grab the product name from the product table.
        $result = mysqli_query($conn, "SELECT ProductName as pname FROM products WHERE ProductID='$_ProductID1'");
        $row = mysqli_fetch_array($result);
        $_ProductName2 = $row['pname'];

        $sql = "INSERT INTO products (ProductName, ProductID, UserID, Amount) VALUES ('$_ProductName2', '$_newProductID2', '$_UserID1', '$Amount2')";

        //Commit the query to the database connection.
        $conn->query($sql);
    }

    //Delete message when complete
    $sql = "DELETE FROM messages WHERE MessageID='$_MessageID'";
    $conn->query($sql);


    header('Location:profile.php');

}
else
{
    echo "Not your offer to accept!  accept1 is: ".$accept1;
}
    
//header('Location:profile.php');



?>