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


//Generate a new GUID for the user.
$NewID = GUID();
$NewUserGroupID = GUID();

echo "GUID is: ".$NewID;

if($_Groupname == NULL || $_Password == NULL)
{
    //If not all fields have been filled, return without committing.
    echo 'Not all fields filled!';
    exit();
    //header('Location:group_signup.php');
}
else
{
    //Validate that the group name is alphanumeric to sanitize the groupname
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $_Groupname)) {
        echo "Invalid group name!";
        exit();
    }


    $stmt = $conn->prepare("SELECT GroupID, Password from groups where GroupName=?");
    $stmt->bind_param("s", $_Groupname);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1)
    {

        $row = mysqli_fetch_array($result); 

        //Retrieve the hashed password
        $_pwd = $row['Password'];

        //Retrieve the group ID
        $_GroupID = $row['GroupID'];

        //Check the hashed password against inputted password
        if(password_verify($_Password, $_pwd))
        {
            //Check if user already exists in the group table
            //Groupname was sanitized above
            $stmt2 = $conn->prepare("SELECT UserID FROM user_groups WHERE UserID=? AND GroupID=?");
            $stmt2->bind_param("ss", $_UserID, $_GroupID);
            $stmt2->execute();
            $result = $stmt2->get_result();

            if($result->num_rows > 0)
            {
                echo "UserID already in that group!";
                //exit();
            }

            //Add the user into the user_groups table
            $stmt3 = $conn->prepare("INSERT INTO user_groups (UserGroupID, UserID, GroupID, Username, Joined_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
            $stmt3->bind_param("ssss", $NewUserGroupID, $_UserID, $_GroupID, $_Username);
            $stmt3->execute();

            $stmt3->close();
            $stmt2->close();
        }

    }

    $stmt->close();
    $conn->close();
    header('Location:profile.php');
    exit();

}

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