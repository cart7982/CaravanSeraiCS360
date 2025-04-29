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
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
    exit();
}
//UserID from the session global
$_UserID = $_SESSION["UserID"];

//If the user ID has been posted, set that instead (for admin use):
if(isset($_POST["UserID"]) && $_POST["UserID"] != null && $_POST["UserID"] != "")
{
    $_UserID = $_POST["UserID"];
    //Get the new product ID from the admin entry:
    $_NewProductID = $_POST["NewProductID"];
}
else
{
    echo "No user ID posted!";
}
//UserID1 	UserID2 	BarterMessage 	TransactionID 	Amount1 	
//MessageID 	Amount2 	ProductName1 	ProductName2 	MessageUserID 	Product1UserID 	Product2UserID 	

$_MessageID = $_POST['MessageID'];
$_NewMessageID = $_POST['NewMessageID'];
$_UserID1 = $_POST['UserID1'];
$_UserID2 = $_POST['UserID2'];
$_BarterMessage = $_POST['BarterMessage'];
$_TransactionID = $_POST['TransactionID'];
$_Amount1 = $_POST['Amount1'];
$_Amount2 = $_POST['Amount2'];
$_ProductName1 = $_POST['ProductName1'];
$_ProductName2 = $_POST['ProductName2'];
$_MessageUserID = $_POST['MessageUserID'];
$_Product1UserID = $_POST['Product1UserID'];
$_Product2UserID = $_POST['Product2UserID'];

//Get the data from messages to check the old information against the new
$result = mysqli_query($conn,"SELECT * FROM messages WHERE MessageID='$_MessageID'");
$row = $result->fetch_assoc();

if($_SESSION["AdminID"] != '0' && $_SESSION["AdminID"] != "0" && isset($_SESSION["AdminID"]))
{

    if(isset($_POST['UserID1']) && $_UserID1 != null && $_UserID1 != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET UserID1=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_UserID1);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['UserID2']) && $_UserID2 != null && $_UserID2 != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET UserID2=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_UserID2);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['BarterMessage']) && $_BarterMessage != null && $_BarterMessage != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET BarterMessage=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_BarterMessage);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['TransactionID']) && $_TransactionID != null && $_TransactionID != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET TransactionID=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_TransactionID);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['Amount1']) && $_Amount1 != null && $_Amount1 != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET Amount1=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_Amount1);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['Amount2']) && $_Amount2 != null && $_Amount2 != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET Amount2=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_Amount2);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['ProductName1']) && $_ProductName1 != null && $_ProductName1 != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET ProductName1=? WHERE MessageID='$_ProductName1'");
        $stmt->bind_param("s", $_ProductName1);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['ProductName2']) && $_ProductName2 != null && $_ProductName2 != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET ProductName2=? WHERE MessageID='$_ProductName2'");
        $stmt->bind_param("s", $_ProductName2);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['MessageUserID']) && $_MessageUserID != null && $_MessageUserID != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET UserID2=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_MessageUserID);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['Product1UserID']) && $_Product1UserID != null && $_Product1UserID != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET Product1UserID=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_Product1UserID);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['Product2UserID']) && $_Product2UserID != null && $_Product2UserID != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET Product2UserID=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_Product2UserID);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['NewMessageID']) && $_NewMessageID != null && $_NewMessageID != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET MessageID=? WHERE MessageID='$_MessageID'");
        $stmt->bind_param("s", $_NewMessageID);
        $stmt->execute();
        $stmt->close();
    }
}
else
{
    echo "No AdminID found!";
}


header('Location:profile.php');
exit();

?>