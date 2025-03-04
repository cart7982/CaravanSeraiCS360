<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <?php
    session_start();
    ?>
        <h1>PROFILE</h1>

        <div class = "card">
            <div class = "card-header">
                Welcome, <?php echo $_SESSION["Username"] ?>!<br>
                User ID is: <?php echo $_SESSION["UserID"] ?>
            </div>
            <div class = "card-body">
                This page is where the user information will be.  <br>
                This includes username, email, and- depending on functionality 
                and priorities, possibly the generated listings 
                and the most recent purchase.  <br>
                There will be a link to the cart and checkout on the profile.  
            </div>
        </div>

        <div class = "card">
            <div class = "card-header">
                Welcome to your OpenPlaza homepage!
            </div>
            <div class = "card-body">
                Your Products for Sale: 
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","openplaza");
                    $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID='$_UserID' LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['Price']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><?= htmlspecialchars($row['Description']) ?></td>
                        <td><form action="remove_product.php" method="post">
                            <button style="height:30px; width:70px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                        </tr>
                    <?php endforeach ?>
                    </table>

            </div>
        </div>

        <div class = "card">
            <div class = "card-header">
                Actions Avaliable
            </div>
            <div class = "card-body">
                <a href = "product_listings.php">See Avaliable Products</a>
            </div>
            <div class = "card-body">
                <a href = "cart.php">See Your Cart</a>
            </div>
            <div class = "card-body">
                <a href = "logout.php">Log Out</a>
            </div>
        </div>

    </body>
</html>