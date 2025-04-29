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

//Hash new password
$_HashedPassword = password_hash($_Password, PASSWORD_DEFAULT);

//Get the data from users to check the old information against the new
$result = mysqli_query($conn,"SELECT * FROM users WHERE UserID='$_UserID'");
$row = $result->fetch_assoc();

//Check if an admin is logged in
if($_SESSION["AdminID"] != null && $_SESSION["AdminID"] != "0")
{
    //Admins use a posted version of the userID and NewUserID
    $_UserID = $_POST["UserID"];
    $_NewUserID = $_POST["NewUserID"];

    //Update username
    if (isset($_POST['username']) && $_POST['username'] != '' && $_POST['username'] != null) {
        $stmt = $conn->prepare("UPDATE users SET Username=? WHERE UserID=?");
        $stmt->bind_param("ss", $_Username, $_UserID);
        $stmt->execute();
        $stmt->close();
    }

    //Update password
    if (isset($_POST['pwd']) && $_POST['pwd'] != '' && $_POST['pwd'] != null && $_HashedPassword != $row['Password']) {
        $stmt = $conn->prepare("UPDATE users SET Password=? WHERE UserID=?");
        $stmt->bind_param("ss", $_HashedPassword, $_UserID);
        $stmt->execute();
        $stmt->close();
    }

    //Update email
    if (isset($_POST['email']) && $_POST['email'] != '' && $_POST['email'] != null) {
        $stmt = $conn->prepare("UPDATE users SET Email=? WHERE UserID=?");
        $stmt->bind_param("ss", $_Email, $_UserID);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST["NewUserID"]) && $_POST["NewUserID"] != '' && $_POST["NewUserID"] != null)
    {
        $stmt = $conn->prepare("UPDATE users SET UserID=? WHERE UserID=?");
        $stmt->bind_param("ss", $_NewUserID, $_UserID);
        $stmt->execute();
        $stmt->close();

    }
    
    //Unsetting to let the admin be able to edit their own profile info normally otherwise    
    unset($_POST["UserID"]);
    unset($_POST["NewUserID"]);
}
else
{
//Update username
if (isset($_POST['username']) && $_POST['username'] != '' && $_POST['username'] != null) {
    $_SESSION["Username"] = $_Username;
    $stmt = $conn->prepare("UPDATE Users SET Username=? WHERE UserID=?");
    $stmt->bind_param("ss", $_Username, $_UserID);
    $stmt->execute();
    $stmt->close();
}

//Update password
if (isset($_POST['pwd']) && $_POST['pwd'] != '' && $_POST['pwd'] != null) {
    $_HashedPassword = password_hash($_Password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE Users SET Password=? WHERE UserID=?");
    $stmt->bind_param("ss", $_HashedPassword, $_UserID);
    $stmt->execute();
    $stmt->close();
}

//Update email
if (isset($_POST['email']) && $_POST['email'] != '' && $_POST['email'] != null) {
    $_SESSION["Email"] = $_Email;
    $stmt = $conn->prepare("UPDATE Users SET Email=? WHERE UserID=?");
    $stmt->bind_param("ss", $_Email, $_UserID);
    $stmt->execute();
    $stmt->close();
}

}

$conn->close();

header("Location: profile.php");
exit();
}
?>