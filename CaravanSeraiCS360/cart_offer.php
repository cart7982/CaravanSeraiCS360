<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "styleII.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <?php
    session_start();
    ?>
        
        <div class="topnav">
            <a href="index.php">Home</a>
            <!-- <a href="login.html">Login</a> -->
            <a href="group_login.php">Group Login</a>
            <a href="logout.php">Logout</a>
            <a href="profile.php">Profile</a>
            <a href="product_listings.php">Product Listings</a>
        </div>
        

        <h1>Your Products Available To Offer:</h1>

        <div class = "card-body">
                <?php

                if(isset($_SESSION["GroupID"]))
                {
                    $_GroupID = $_SESSION["GroupID"];
                    $_GroupName = $_SESSION["GroupName"];

                    //$GroupID = intval($_GroupID);
                    echo"Signed into group: ".$_SESSION['GroupName'];
                    //echo"\nSigned into group: ".$_SESSION['GroupID'];

                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM products NATURAL JOIN users WHERE UserID IN (SELECT UserID FROM $_GroupName)");
                    $data = $result->fetch_all(MYSQLI_ASSOC);

                }
                else
                {
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID='$_UserID' LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);

                }

                $_TransactionID = $_POST['TransactionID'];
                ?>

                <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ProductName']) ?></td>
                    <td><?= htmlspecialchars($row['Amount']) ?></td>
                    <td><form action="make_offer.php" method="post">
                            <label for="amount">Quantity></label>
                            <input style="height:30px; width:100px" id="amount" name="amount"></input>
                            <label for="message">Message to Send to Seller></label>
                            <input style="height:30px; width:100px" id="message" name="message"></input>
                            <!-- Hidden Input for ProductName -->
                            <input type="hidden" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>"></input>
                            <input type="hidden" name="ProductName" value="<?= htmlspecialchars($row['ProductName']) ?>"></input>
                            <input type="hidden" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>"></input>

                            <button style="height:30px; width:100px" input type="submit" name="TransactionID" value="<?= htmlspecialchars($_TransactionID) ?>">Make Offer</button>
                        </form></td>
                
                </tr>
                <?php endforeach ?>
                </table>

            </div>
        </div>

       
        


    </body>
</html>