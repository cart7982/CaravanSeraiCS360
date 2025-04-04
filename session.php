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
$_Username = $_POST['username'];
$_Password = $_POST['pwd'];

echo $_Username;
echo $_Password;

//Check if that username and password combo exist in the database:
$sql = "SELECT Username as username, Password as pwd FROM users WHERE Username='$_Username'";

$result = $conn->query($sql);

//Check if username/password combo exists in database.  
//If so, start the session, otherwise go back to login.
if($result->num_rows != 0){

    $row = mysqli_fetch_array($result); 

    //Retrieve the hashed password
    $_pwd = $row['pwd'];

    //Check the hashed password against inputted password
    if(password_verify($_Password, $_pwd))
    {
        session_start();
        echo "Session started!";
        
        //Get the user ID to be put into a global form.
        $result = mysqli_query($conn, "SELECT UserID as userID FROM users WHERE Username='$_Username'");
        $row = mysqli_fetch_array($result);
        $UserID = $row['userID'];
        //$_UserID = intval($UserID);

        //Get the user email
        $result = mysqli_query($conn, "SELECT Email as email FROM users WHERE Username='$_Username'");
        $row = mysqli_fetch_array($result);
        $Email = $row['email'];

        //Declare global session variables.
        //These variables can then be used in any session() page.
        $_SESSION["Username"] = $_Username;
        $_SESSION["Password"] = $_Password;
        $_SESSION["UserID"] = $UserID;
        $_SESSION["Email"] = $Email;

        $conn->close();

        //If a session started, go to profile.
        header('Location:profile.php');
        exit();

    }
    else
    {
        echo "Password couldn't be verified for username!  Login failed!";
    }


}
else
{
    echo "Username and password combination not found!  Login failed!";
    //header('Location:login.html');
}

?>