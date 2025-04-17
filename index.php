<!DOCTYPE html>
<html>
    <head>
        <title>Landing Page</title>
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
                <a href = "group_login.php">Group Login</a>
                <a href = "group_logout.php">Group Logout</a>
            </div>
        </div>

        <h1>CaravanSerai</h1>
        <h3>LANDING PAGE</h3>

        <div class = "card bg-warning">
            <div class = "card-header">
                Welcome to CaravanSerai!
            </div>
            <div class = "card-body">
                CaravanSerai is an anonymous trading site that allows you to 
                exchange goods securely.
            </div>
            <div class = "card-body">
                You can trade as an individual merchant or as part of a group, 
                allowing access to collective resources. 
            </div>
        </div>

        
        <?php
        session_start();
        
        if(isset($_SESSION["UserID"]) && isset($_SESSION["GroupID"]))
        {
            $_GroupID = $_SESSION["GroupID"];
            $_GroupName = $_SESSION["GroupName"];

            //$GroupID = intval($_GroupID);
            echo "Welcome, ".$_SESSION["Username"]."!<br>";
            echo "User ID is: ".$_SESSION["UserID"]."<br>";
            echo "Signed into group: ".$_SESSION['GroupName'];
            //echo"\nSigned into group: ".$_SESSION['GroupID'];

            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM products NATURAL JOIN users WHERE UserID NOT IN (SELECT UserID FROM $_GroupName)");
            $data = $result->fetch_all(MYSQLI_ASSOC);

        }
        else if(isset($_SESSION["UserID"]) && !isset($_SESSION["GroupID"]))
        {
            echo "Welcome, ".$_SESSION["Username"]."!<br>";
            echo "User ID is: ".$_SESSION["UserID"]."!<br>";

            $_UserID = $_SESSION["UserID"];
            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID!='$_UserID' LIMIT 50");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        else
        {
            session_destroy();
            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM products LIMIT 50");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }

        ?>

        <h1>WHAT'S ON THE MARKET</h1>
        <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Picture</th>
            <th>How Much You Want</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['ProductName']) ?></td>
            <td><?= htmlspecialchars($row['Amount']) ?></td>
            <td><?= htmlspecialchars($row['Description']) ?></td>
            <td><img class="img-product" src="./Images/<?php echo $row['ImagePath']; ?>"></td>
            <!-- <?php //$imagePath = !empty($row['ImagePath']) ? htmlspecialchars($row['ImagePath']) : 'images/placeholder.png'; ?>
        echo "
            <td><img src='$imagePath' alt='Product Image' style='width:100px;height:auto;'></td>"; -->

            <td><form action="barter_create.php" method="post">
                <label for="Quantity">Quantity></label>
                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                <button style="height:30px; width:150px" input type="submit" name="ProductID" value="<?= $row['ProductID'] ?>">Request Barter</button></form></td>
            </tr>
        <?php endforeach ?>
        </table>       
        


    </body>
</html>