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


//Prepare statement to check for user by username
$stmt = $conn->prepare("SELECT Password, UserID, Email FROM users WHERE Username = ?");
$stmt->bind_param("s", $_Username);
$stmt->execute();
$result = $stmt->get_result();


//Check if username exists in database.  
//If so, start the session, otherwise go back to login.
if($result->num_rows === 1){

    $row = mysqli_fetch_array($result); 

    //Retrieve the hashed password
    $_pwd = $row['Password'];

    //Check the hashed password against inputted password
    if(password_verify($_Password, $_pwd))
    {
        session_start();
        echo "Session started!";
        
        //Put the user into global form
        $_SESSION["Username"] = $_Username;
        $_SESSION["UserID"] = $row['UserID'];
        $_SESSION["Email"] = $row['Email'];

        if(isset($_SESSION["GroupID"]))
        {
            unset($_SESSION["GroupID"]);
            unset($_SESSION["GroupName"]);
        }
        

                // Saved code from a different project 
                //Get the age of the pet from the pets table.
                //  $stmt_age = $conn->prepare("SELECT Age as age FROM pets WHERE PetID=?");
                //  $stmt_age->bind_param("s", $petID);
                //  $stmt_age->execute();
                //  $result_age = $stmt_age->get_result();
                //  $row = mysqli_fetch_array($result_age);
                //  $ageatownership = $row['age'];
                 
        $stmt->close();
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