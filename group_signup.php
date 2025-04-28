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

        //Check the hashed password against inputted password
        if(password_verify($_Password, $_pwd))
        {
            //Check if user already exists in the group table
            //Groupname was sanitized above
            $stmt2 = $conn->prepare("SELECT UserID FROM $_Groupname WHERE UserID=?");
            $stmt2->bind_param("s", $_UserID);
            $stmt2->execute();
            $result = $stmt2->get_result();

            if($result->num_rows < 0)
            {
                echo "UserID already in table!";
                exit();
            }

            //Groupname was sanitized above
            $stmt3 = $conn->prepare("INSERT INTO $_Groupname (UserID, Username, FirstName, LastName, Email) VALUES (?, ?, '', '', '')");
            $stmt3->bind_param("ss", $_UserID, $_Username);
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

?>