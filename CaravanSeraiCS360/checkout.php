<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">

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

        <h1>CHECKOUT</h1>

        <div class = "card">
            <div class = "card-body">
                Last check!  Please confirm that these are the items you wish to trade.  
            </div>
        </div>

        <button type = submit class = "btn btn-primary">Confirm Trade?</button>
    </body>
</html>