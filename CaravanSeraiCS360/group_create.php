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

//Grab the highest ID in the GroupID column, then increment it by one for the new GroupID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(GroupID) AS max FROM groups");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$NewID = intval($PrevID) + 1;

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

    //If user exists, result will have >0 rows
    if($result->num_rows!= 0){
        echo "Registration failed!";
        header('Location:group_create.html');
    }
    else
    {
        //Register the new user.  This assigns them a unique UserID.
        $sql = "INSERT INTO groups (GroupName, Password, Email, GroupID) VALUES ('$_Groupname', '$_Password', '$_Email', '$NewID')";
        //$sql = "INSERT INTO users (FirstName, LastName, Passwrd, Email) VALUES ('Saruman', 'TheWhite', 'mine', 'neutral@sauron.com')";

        //Commit the query to the database connection.
        $conn->query($sql);

        // sql to create table
        $sql = "CREATE TABLE $_Groupname (
            UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Username VARCHAR(30) NOT NULL,
            FirstName VARCHAR(30) NOT NULL,
            LastName VARCHAR(30) NOT NULL,
            Email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";



        $conn->query($sql);


        $conn->close();
    }
    header('Location:profile.php');
}


?>