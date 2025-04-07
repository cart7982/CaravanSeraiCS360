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


$_Username = $_POST['username'];
$_Password = $_POST['pwd'];
$_Email = $_POST['email'];


if(isset($_POST['username']) && $_Username != null && $_Username != '')
{
    $_SESSION["Username"] = $_Username;
    $stmt = $conn->prepare("UPDATE Users SET Username=? WHERE UserID=?");
    $stmt->bind_param("ss", $_Username, $_UserID);
    $stmt->execute();
    $stmt->close();

    // $sql = "UPDATE Users SET Username='$_Username' WHERE UserID='$_UserID'";
    // $conn->query($sql);
}
if(isset($_POST['pwd']) && $_Password != null && $_Password != '')
{   
    $_HashedPassword = password_hash($_Password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE Users SET Password=? WHERE UserID=?");
    $stmt->bind_param("ss", $_HashedPassword, $_UserID);
    $stmt->execute();
    $stmt->close();

    // $sql = "UPDATE Users SET Password='$_Password' WHERE UserID='$_UserID'";
    // $conn->query($sql);
}
if(isset($_POST['email']) && $_Email != null && $_Email != '')
{    
    $_SESSION["Email"] = $_Email;
    $stmt = $conn->prepare("UPDATE Users SET Email=? WHERE UserID=?");
    $stmt->bind_param("ss", $_Email, $_UserID);
    $stmt->execute();
    $stmt->close();

    // $sql = "UPDATE Users SET Email='$_Email' WHERE UserID='$_UserID'";
    // $conn->query($sql);
}

header('Location:profile.php');
}
?>