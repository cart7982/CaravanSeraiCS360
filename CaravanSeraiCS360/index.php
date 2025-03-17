<!DOCTYPE html>
<html>
    <style>
    .topnav {
    overflow: hidden;
    background-color: rgb(133, 255, 255);
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
    background-color:blue;
    color: white;
    }
</style>
    <head>
        <title>Landing Page</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "styleII.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    
    <body>
        <div class="topnav">
            <a href="index.php">Home</a>
            <a href="signup.html">Sign Up</a>
            <a href="login.html">Login</a>
            <a href="logout.php">Logout</a>
            <a href="profile.php">Profile</a>
            <a href="group_signup.html">Group Sign Up</a>
            <a href="group_login.html">Group Login</a>
        </div>
        
        <h1>CaravanSerai</h1>
        <h3>LANDING PAGE</h3>

        <div class = "card">
            <div class = "card-header">
                Welcome to CaravanSerai!
            </div>
            <div class = "card-body">
                CaravanSerai is an anonymous trading site that allows you to 
                exchange goods securely.
            </div>

        
        <?php
        //$_UserID = $_SESSION["UserID"];
        $conn = mysqli_connect("localhost","root","","caravanserai");
        $result = mysqli_query($conn,"SELECT * FROM products LIMIT 50");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        ?>

        <h1>WHAT'S ON THE MARKET</h1>
        <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Description</th>
            <th>How Much You Want</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['ProductName']) ?></td>
            <td><?= htmlspecialchars($row['Amount']) ?></td>
            <td><?= htmlspecialchars($row['Description']) ?></td>
            <td><form action="barter_add.php" method="post">
                <label for="Quantity">Quantity></label>
                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                <button style="height:30px; width:150px" input type="submit" name="ProductID" value="<?= $row['ProductID'] ?>">Request Barter</button></form></td>
            </tr>
        <?php endforeach ?>
        </table>       
        


    </body>
</html>