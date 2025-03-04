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
                Welcome to your CaravanSerai homepage!
            </div>
            <div class = "card-body">
                Your Products for Trade: 
            </div>
            <div class = "card-body">
                Your Trades in Progress: 
            </div>
            <div class = "card-body">
                Your Completed Trades: 
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
                <a href = "cart.html">See Your Cart</a>
            </div>
        </div>

    </body>
</html>