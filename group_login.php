<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "styleII.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    
    <div class = "topnav">
        <a href="index.php">
        <img class="img-logo" src = "Images/logo_1.jpg">
        </a>
    </div>

        <div class = "topnav" tabindex = "1">
            <i class = "db2" tabindex = "1"></i>
            <a class = "dropbtn">Account</a>
            <div class = "drop-content">
                <a href = "signup.html">Sign Up</a>
                <a href = "login.html">Login</a>
                <a href = "logout.php">Logout</a>
                <a href = "profile.php">Profile</a>
                <a href = "index.php">Listings</a>
            </div>
        </div>

<div class = "topnav" tabindex = "1">
    <i class = "db2" tabindex = "1"></i>
    <a class = "dropbtn">Groups</a>
    <div class = "drop-content">
        <a href = "group_create.html">Create Group</a>
        <a href = "group_signup.html">Sign Up For A Group</a>
        <a href = "group_login.php">Group Login</a>
        <a href = "group_logout.php">Group Logout</a>
    </div>
</div>

    <?php
    session_start();

    if(!isset($_SESSION["UserID"]))
    {
        echo "User not detected!  Please log in to proceed!";
        header('Location:login.html');
    }
    ?>

        <h1>LOGIN TO A GROUP</h1>
        <div class = "card bg-primary">
            <div class = "card-body">
                Groups allow for the use of resources collectively; that is, each user who joins the group 
                allows their items to be used by any member of the group.  
            </div>
            <div class = "card-body">
                To log into a group, please enter the name of the group and the group password.
            </div>
        </div>

        <!--This form starts the user session.  This allows for the usage of
            global variables as described in session.php.-->
        <form action="group_session.php" method="post">
            <div class = "mb-3 mt-3">
                <label for = "groupname" class = "form-label">Groupname: </label>
                <input type = "groupname" class = "form-control" id = "groupname" placeholder = "Enter group name" name = "groupname">
            </div>
            <div class = "mb-3">
                <label for = "pwd" class = "form-label"> Password: </label>
                <input type = "password" class = "form-control" id = "pwd" placeholder = "Enter password" name = "pwd">
            </div>
            <button type = "submit" class = "btn btn-primary"> Submit</button>
        </form>
    </body>
</html>