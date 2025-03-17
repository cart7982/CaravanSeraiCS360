<!DOCTYPE html>
<html>
    <style>
.topnav {
  overflow: hidden;
  background-color: #rgb(133, 255, 255);
}

.topnav a {
  float: left;
  color:rgb(0, 0, 0);
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
</style>
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
        <a href="login.html">Login</a>
        <a href="logout.php">Logout</a>
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