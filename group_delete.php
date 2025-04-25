<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION["UserID"])) {
    echo "Login failed! No user ID found!";
    header("Location:login.html");
    exit();
}

//UserID from the session global
$_UserID = $_SESSION["UserID"];


if (isset($_POST['GroupID'])) {
    $_GroupID = $_POST['GroupID'];
    
    //Get the groupname from the groups table
    $sql = "SELECT GroupName FROM groups WHERE GroupID='$_GroupID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_GroupName = $row['GroupName'];

    //Delete from the groups table
    $stmt = $conn->prepare("DELETE FROM groups WHERE GroupID = ?");
    $stmt->bind_param("s", $_GroupID);
    $stmt->execute();
    $stmt->close();

    //Drop the related group table
    $drop_sql = "DROP TABLE IF EXISTS `$_GroupName`";
    $conn->query($drop_sql);
}

$conn->close();
header('Location:profile.php');
exit();
?>
