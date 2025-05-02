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
}
else
{
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

$_ProductName = $_POST['productname'];
$_Description = $_POST['description'];
$_Amount = $_POST['amount'];
$_NewProductID = $_POST['NewProductID'];
$_ProductID = $_POST['ProductID'];

//Get the image file names:
$_Filename = basename($_FILES['uploadfile']['name']);
$_TempFilename = $_FILES['uploadfile']['tmp_name'];
$targetDir = './Images/';
$targetFile = $targetDir . $_Filename;

echo "_Filename is: ".$_Filename;
echo "_TempFilename is: ".$_TempFilename;
echo "_ProductName is: ".$_ProductName;
echo "_Description is: ".$_Description;
echo "_Amount is: ".$_Amount;
echo "_NewProductID is: ".$_NewProductID;

//Check if a new product image is set
if(isset($_FILES['uploadfile']['tmp_name']) && $_FILES['uploadfile']['tmp_name'] != null && $_FILES['uploadfile']['tmp_name'] != '')
{
    //Get the image filename/path from the database
    $stmt = $conn->prepare("SELECT ImagePath FROM products WHERE ProductID = ?");
    $stmt->bind_param("s", $_ProductID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) 
    {
        $imagePath = './Images/' . $row['ImagePath'];

        //Delete the image from the file system
        if (file_exists($imagePath) && $row['ImagePath'] != 'logo_1.jpg') {
            if (unlink($imagePath)) {
                echo "Image deleted successfully.<br>";
            } else {
                echo "Failed to delete image.<br>";
            }
        } else {
            echo "Image file not found.<br>";
        }
    }
    $stmt->close();

    //Move the new product image to database
    if (move_uploaded_file($_TempFilename, $targetFile)) {
        echo "File uploaded successfully to $targetFile!";
    } else {
        echo "Failed to move uploaded file.";
    }
    
    //Update with the product image included
    $stmt = $conn->prepare("UPDATE products SET ProductName=?,Description=?, Amount=?, ImagePath=? WHERE ProductID=?");
    $stmt->bind_param("sssss", $_ProductName, $_Description, $_Amount, $_Filename, $_ProductID);
    $stmt->execute();
    $stmt->close();
}

if(isset($_POST['description']) && $_Description != null && $_Description != '')
{    
    $stmt = $conn->prepare("UPDATE products SET Description=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_Description);
    $stmt->execute();
    $stmt->close();
}

if(isset($_POST['productname']) && $_ProductName != null && $_ProductName != '')
{    
    $stmt = $conn->prepare("UPDATE products SET ProductName=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_ProductName);
    $stmt->execute();
    $stmt->close();
}

if(isset($_POST['amount']) && $_Amount != null && $_Amount != '')
{    
    $stmt = $conn->prepare("UPDATE products SET Amount=? WHERE ProductID='$_ProductID'");
    $stmt->bind_param("s", $_Amount);
    $stmt->execute();
    $stmt->close();
}

if($_SESSION["AdminID"] != '0' && isset($_SESSION["AdminID"]))
{

    if(isset($_POST['_NewProductID']) && $_NewProductID != null && $_NewProductID != '')
    {    
        $stmt = $conn->prepare("UPDATE products SET ProductID=? WHERE ProductID='$_ProductID'");
        $stmt->bind_param("s", $_NewProductID);
        $stmt->execute();
        $stmt->close();
    }
}
else
{
    echo "No AdminID found!";
}


//header('Location:profile.php');
exit();
}
?>