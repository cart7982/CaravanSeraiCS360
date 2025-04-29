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

$_GroupID = $_POST['GroupID'];
$_NewGroupID = $_POST['NewGroupID'];
$_Documents = $_POST['Documents'];
$_GroupName = $_POST['GroupName'];
$_Email = $_POST['Email'];
$_NewPassword = $_POST['NewPassword'];

//Create hashed password
$_HashedPassword = password_hash($_NewPassword, PASSWORD_DEFAULT);

//Get the data from the group to check the old password against the new
$result = mysqli_query($conn,"SELECT * FROM groups WHERE GroupID='$_GroupID'");
$row = $result->fetch_assoc();

if($_SESSION["AdminID"] != '0' && $_SESSION["AdminID"] != "0" && isset($_SESSION["AdminID"]))
{

    if(isset($_POST['Documents']) && $_Documents != null && $_Documents != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET Documents=? WHERE GroupID='$_GroupID'");
        $stmt->bind_param("s", $_Documents);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['GroupName']) && $_GroupName != null && $_GroupName != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET GroupName=? WHERE GroupID='$_GroupID'");
        $stmt->bind_param("s", $_GroupName);
        $stmt->execute();
        $stmt->close();
    }

    if(isset($_POST['Email']) && $_Email != null && $_Email != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET Email=? WHERE GroupID='$_GroupID'");
        $stmt->bind_param("s", $_Email);
        $stmt->execute();
        $stmt->close();
    }

    //Before setting the new password, check that it doesn't match the old password,
    //which assumes the admin copy/pasted the hashed password into the field.
    if(isset($_POST['NewPassword']) && $_NewPassword != null && $_NewPassword != '' && $_NewPassword != $row['Password'])
    {    
        $stmt = $conn->prepare("UPDATE groups SET Password=? WHERE GroupID='$_GroupID'");
        $stmt->bind_param("s", $_HashedPassword);
        $stmt->execute();
        $stmt->close();
    }

    //Change the groupID last so as to not affect previous updates
    if(isset($_POST['GroupID']) && $_GroupID != null && $_GroupID != '')
    {    
        $stmt = $conn->prepare("UPDATE groups SET GroupID=? WHERE GroupID='$_GroupID'");
        $stmt->bind_param("s", $_NewGroupID);
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