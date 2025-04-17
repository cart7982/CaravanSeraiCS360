<!DOCTYPE html>
<html>
    <head>
        <title>Product Edit</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "styleII.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    
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
        <a href = "group_login.php">Enter Group</a>
        <a href = "group_logout.php">Group Logout</a>
    </div>
</div>
    <?php
        $conn = mysqli_connect("localhost","root","","caravanserai");
        session_start();
        $_ProductID = $_POST['ProductID'];
    ?>

        <h1>EDIT YOUR PRODUCT</h1>

        <div class = "card bg-info">
            <div class = "card-body">
                To ensure accurate barters, you may need to update your product information. 
            </div>
            <div class = "card-body">
                Please ensure that you have accurate, up-to-date information. 
            </div>
        </div>

        <!--This form starts the user session.  This allows for the usage of
            global variables as described in session.php.-->
        <form action="product_edit.php" method="post">
            <div class = "mb-3 mt-3">
                <label for = "productname" class = "form-label">New Product Name: </label>
                <input type = "productname" class = "form-control" id = "productname" placeholder = "Enter New Produt Name" name = "productname">
            </div>
            <div class = "mb-3">
                <label for = "description" class = "form-label"> New Description: </label>
                <input type = "description" class = "form-control" id = "description" placeholder = "Enter description" name = "description">
            </div>
            <button type = "submit" class = "btn btn-primary" name="ProductID" value="<?= $_ProductID ?>"> Submit</button>
        </form>
    </body>
</html>