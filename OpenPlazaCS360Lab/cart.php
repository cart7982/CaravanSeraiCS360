<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <?php
    session_start();
    ?>
        <ul class="nav">
            <li class = "nav-item">
                <a class = "nav-link" href = "profile.php">User Profile</a>
            </li>
        </ul> 
        
        <h1>CART</h1>

        <div class="card">
            <div class = "card-body">
                This page holds a list of all items a user has put into their cart, <br>
                along with the requested quantities.  <br>
                Advanced functionality would allow for a checkbox to determine which ones would go into the checkout.<br>
                That, however, would be a stretch goal.

                <?php
                $_UserID = $_SESSION["UserID"];
                $conn = mysqli_connect("localhost","root","","openplaza");
                $result = mysqli_query($conn,"SELECT * FROM transactions WHERE UserID='$_UserID' LIMIT 50");
                $data = $result->fetch_all(MYSQLI_ASSOC);
                ?>

                <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ProductName']) ?></td>
                    <td><?= htmlspecialchars($row['TotalPrice']) ?></td>
                    <td><?= htmlspecialchars($row['Quantity']) ?></td>
                    <td><form action="remove_cart.php" method="post">
                            <button style="height:30px; width:70px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                        </tr>
                <?php endforeach ?>
                </table> 
            </div>
        </div>

        <div class = "card">
            <div class = "card-body">
                <a href = "checkout.html">
                    Proceed to Checkout
                </a>
            </div>
        </div>


    </body>
</html>