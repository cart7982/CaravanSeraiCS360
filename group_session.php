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

//Check if that groupname exists in the database:
$sql = "SELECT GroupName as grpname, Password as pwd FROM groups WHERE GroupName='$_Groupname'";
$result = $conn->query($sql);


//Check that the group name exists
if($result->num_rows != 0 )
{
    //Check if user is in the group
    $sql = "SELECT UserID as userID FROM $_Groupname WHERE UserID='$_UserID'";
    $userCheck = $conn->query($sql);

    //If user is found, then proceed
    if($userCheck->num_rows != 0)
    {
        $row = mysqli_fetch_array($result); 

        //Retrieve the hashed password
        $_pwd = $row['pwd'];
    
        if(password_verify($_Password, $_pwd))
        {
            //Get the group ID to be put into a global form.
            $result = mysqli_query($conn, "SELECT GroupID as gID FROM groups WHERE GroupName='$_Groupname'");
            $row = mysqli_fetch_array($result);
            $GroupID = $row['gID'];
            //$_UserID = intval($UserID);
    
            //Declare global session variables.
            //These variables can then be used in any session() page.
            $_SESSION["GroupName"] = $_Groupname;
            $_SESSION["GroupID"] = $GroupID;

            echo "GroupID is: ".$GroupID;
            echo "_Groupname is: ".$_Groupname;
    
            $conn->close();
            header('Location:profile.php');
            exit();
        }
        else
        {
            echo "Group password failed to verify!";
        }
    }
    else
    {
        echo "User not found in group table!";
    }

}
else
{
    echo "Groupname or UserID not found!";
}


?>