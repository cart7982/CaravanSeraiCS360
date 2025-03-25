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
            <!--<a href="login.html">Login</a> -->
            <a href="group_login.php">Group Login</a>
            <a href="logout.php">Logout</a>
            <a href="profile.php">Profile</a>
            <a href="product_listings.php">Product Listings</a>
        </div>
        
        <h1>CART</h1>

        <div class="card">
            <div class = "card-body">
                Look at the items you're currently bartering! <br>
                Continue to make offers until you're satisfied. <br>
                

                <?php
                $_UserID = $_SESSION["UserID"];
                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM transactions WHERE UserID1='$_UserID' LIMIT 50");
                $data = $result->fetch_all(MYSQLI_ASSOC);
                ?>

                <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data as $row): ?>
                <td>
                    <td><?= htmlspecialchars($row['ProductName1']) ?></td>
                    <td><?= htmlspecialchars($row['Quantity1']) ?></td>
                    <td><form action="barter_remove.php" method="post">
                            <label for="Quantity">Quantity></label>
                            <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                            <button style="height:30px; width:70px" input type="submit" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>">Remove</button>
                        </form></td>
                    <td><form action="cart_offer.php" method="post">
                            <button style="height:30px; width:100px" input type="submit" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>">Make Offer</button>
                        </form></td>
                </td>
                </tr>
                <?php endforeach ?>
                </table> 
            </div>
        </div>


    </body>
</html>