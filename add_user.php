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


$_Username = $_POST['username'];
$_Email = $_POST['email'];
$_Password = $_POST['pwd'];

//Grab the highest ID in the UserID column, then increment it by one for the new UserID to be assigned.
$result = mysqli_query($conn, "SELECT MAX(UserID) AS max FROM users");
$row = mysqli_fetch_array($result);
$PrevID = $row['max'];
$NewID = intval($PrevID) + 1;



if($_Username == NULL || $_Password == NULL || $_Email == NULL)
{
    //If not all fields have been filled, return without committing.
    header('Location:signup.php');
}
else
{
    //Check if user already exists
    $sql = "SELECT Username, Email FROM users WHERE Username='$_Username' AND Email='$_Email'";

    $result = $conn->query($sql);

    //If user exists, result will have >0 rows
    if($result->num_rows!= 0){
        echo "Registration failed!";
        header('Location:signup.php');
    }
    else
    {
        //Register the new user.  This assigns them a unique UserID.
        $sql = "INSERT INTO users (Username, Password, Email, UserID) VALUES ('$_Username', '$_Password', '$_Email', '$NewID')";
        //$sql = "INSERT INTO users (FirstName, LastName, Passwrd, Email) VALUES ('Saruman', 'TheWhite', 'mine', 'neutral@sauron.com')";

        //Commit the query to the database connection.
        $conn->query($sql);

        $conn->close();
    }
    header('Location:login.html');
}


?>