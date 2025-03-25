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

    <div class="topnav">
        <a href="index.php">Home</a>
        <!-- <a href="login.html">Login</a> -->
        <a href="logout.php">Logout</a>
        <a href="profile.php">Profile</a>
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

        <div class = card>
            <div class = card-header>
                A group will allow you to barter using the group's resources collectively.  <br>
                This can enable you to make better deals. <br>
                Please be mindful of your group members' goods.
            </div>
            <div class = card-body>
                You will need the group name and the password, which were decided on creation. <br>
                If you do not know these things, please contact the creator of the group.
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