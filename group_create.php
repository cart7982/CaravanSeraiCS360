<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$_Groupname = $_POST['groupname'];
$_Email = $_POST['email'];
$_Password = $_POST['pwd'];

//Generate a new GUID for the group.
$NewID = GUID();

//Create hashed password
$_HashedPassword = password_hash($_Password, PASSWORD_DEFAULT);

if($_Groupname == NULL || $_Password == NULL || $_Email == NULL)
{
    //If not all fields have been filled, return without committing.
    header('Location:group_create.html');
}
else
{
    //Check if group already exists
    $sql = "SELECT groupname, Email FROM groups WHERE GroupName='$_Groupname' AND Email='$_Email'";

    $result = $conn->query($sql);

    //If user group, result will have >0 rows
    if($result->num_rows!= 0){
        echo "Registration failed!";
        //header('Location:group_create.html');
    }
    else
    {
        //Register the new group.  This assigns them a unique GroupID.
        //$sql = "INSERT INTO groups (GroupName, Password, Documents, Email, GroupID) VALUES ('$_Groupname', '$_HashedPassword', '', '$_Email', '$NewID')";
        //$sql = "INSERT INTO users (FirstName, LastName, Passwrd, Email) VALUES ('Saruman', 'TheWhite', 'mine', 'neutral@sauron.com')";

        //Commit the query to the database connection.ss
        //$conn->query($sql);

        $stmt = $conn->prepare("INSERT INTO groups (GroupName, Password, Documents, Email, GroupID) VALUES (?, ?, '', ?, ?)");
        $stmt->bind_param("ssss", $_Groupname, $_HashedPassword, $_Email, $NewID);
        $stmt->execute();


        // sql to create table
        //Each group contains basic user data to keep track of members.
        $sql = "CREATE TABLE $_Groupname (
            UserID VARCHAR(255) PRIMARY KEY,
            Username VARCHAR(30) NOT NULL,
            GroupID VARCHAR(255) NOT NULL,
            )";

        $conn->query($sql);

        $stmt = $conn->prepare("INSERT INTO $_Groupname (GroupID) VALUES (?)");
        $stmt->bind_param("s", $NewID);
        $stmt->execute();


        $stmt->close();
        $conn->close();
    }
    header('Location:profile.php');
}

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        //It says this is wrong, but it still works, so w/e
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

?>