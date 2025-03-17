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

//Grab the username and password from login.
$_Groupname = $_POST['groupname'];
$_Password = $_POST['pwd'];

echo $_Groupname;
echo $_Password;

//Check if that username and password combo exist in the database:
$sql = "SELECT GroupName, Password FROM groups WHERE GroupName='$_Groupname' AND Password='$_Password'";

$result = $conn->query($sql);

//Check if username/password combo exists in database.  
//If so, start the session, otherwise go back to login.
if($result->num_rows != 0){
    session_start();
    echo "Session started!";
}
else
{
    header('Location:profile.php');
}

//Get the user ID to be put into a global form.
$result = mysqli_query($conn, "SELECT GroupID as gID FROM groups WHERE GroupName='$_Groupname' AND Password='$_Password'");
$row = mysqli_fetch_array($result);
$GroupID = $row['gID'];
//$_UserID = intval($UserID);


//Declare global session variables.
//These variables can then be used in any session() page.
$_SESSION["GroupName"] = $_Groupname;
$_SESSION["GroupID"] = $GroupID;


$conn->close();

//If a session started, go to product listings.
if($result->num_rows!= 0){
    header('Location:profile.php');
}

?>