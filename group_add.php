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

if(!isset($_SESSION["UserID"]))
{
    echo "User not detected!  Please log in to proceed!";
    //header('Location:login.html');
}
else
{

$_UserID = $_SESSION["UserID"];
$_Username = $_SESSION["Username"];

$_Groupname = $_POST['groupname'];
$_Password = $_POST['pwd'];


if($_Groupname == NULL || $_Password == NULL)
{
    //If not all fields have been filled, return without committing.
    echo 'Not all fields filled!';
    //header('Location:group_signup.php');
}
else
{
    $sql = "SELECT GroupID from groups where GroupName='$_Groupname' AND Password='$_Password'";
    $result = $conn->query($sql);    
    
    if($result->num_rows!= 0){
        echo "Group not found!  Registration failed!";
        //header('Location:signup.php');
    }
    //Check if user already exists
    $sql = "SELECT UserID FROM $_Groupname WHERE UserID='$_UserID'";
    $result = $conn->query($sql);

    //If user exists, result will have >0 rows
    if($result->num_rows!= 0){
        echo "User already in group database!  Registration failed!";
        //header('Location:signup.php');
    }
    else
    {
        //Register the new user.  This assigns them a unique UserID.
        $sql = "INSERT INTO $_Groupname (UserID, Username) VALUES ('$_UserID', '$_Username')";

        //Commit the query to the database connection.
        $conn->query($sql);

        $conn->close();
    }
    if(isset($_SESSION["UserID"]))
    {
        //header('Location:group_login.html');
    }
}
}

?>