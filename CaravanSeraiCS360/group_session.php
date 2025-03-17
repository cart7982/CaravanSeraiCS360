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
    header('Location:login.html');
}

$_UserID = $_SESSION['UserID'];

//Grab the groupname and password from group login.
$_Groupname = $_POST['groupname'];
$_Password = $_POST['pwd'];

echo $_Groupname;
echo $_Password;

//Check if that groupname and password combo exist in the database:
$sql = "SELECT GroupName, Password FROM groups WHERE GroupName='$_Groupname' AND Password='$_Password'";
$groupCheck = $conn->query($sql);

//Check if the userID is in the group's database
//$sql = "SELECT UserID FROM $_Groupname WHERE UserID='$_UserID'";
//$userCheck = $conn->query($sql);
//$result = $conn->query($sql);

$result = mysqli_query($conn, "SELECT UserID as userID FROM $_Groupname WHERE UserID='$_UserID'");
if(isset($result) && $result != null || $result != '')
{
    $row = mysqli_fetch_array($result);
}
if($row != null)
{
    $UserID = $row['userID'];
}
//$UserID = $row['userID'];

if(!isset($UserID) || $UserID == '' || $UserID == null)
{
    echo "User not in database!  Abort!";    
    header('Location:group_login.php');
}
else
{
//Check if groupname/password/userID combo exists in database.  
//If so, start the session, otherwise go back to login.
if($groupCheck->num_rows != 0){
    echo "Group Session started!";
}
else
{
    echo  "Group not found!  Login failed!";
    //header('Location:group_login.php');
}

//Get the group ID to be put into a global form.
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
if($groupCheck->num_rows!= 0){
    header('Location:profile.php');
}
}
?>