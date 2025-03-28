<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "style2.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <?php
    session_start();

    //This page will serve as the final checkout and "payment" page.
    //It needs to display a final total for all products in the user's cart.
    //Then there needs to be a form that "takes" the users payment information.
    //Once the info has been received, the products table is checked again for amounts and adjusted with new totals.


    ?>
        <div class = "navbar">    
            <div class="dropdown" tabindex="1">
                <i class="db2" tabindex="1"></i>
                <a class="dropbtn">Account</a>
                <div class="dropdown-content">
                    <a href = "signup.html">Sign Up</a>
                    <a href = "login.html">Log In</a>
                    <a href = "logout.php">Log Out</a>
                    <a href = "profile.php">Profile</a>
                </div>
            </div>
            <a href = "product_listings.php" class="dropbtn">Product Listings</a>
            <a href = "cart.php" class="dropbtn">Cart</a>
            <a href = "checkout.php" class="dropbtn">Checkout</a>
        </div>
        <h1>CHECKOUT</h1>

        <div class = "card">
            <div class = "card-body">
                This page serves as final confirmation for the purchased items.  
            </div>
        </div>

        <button type = submit class = "btn btn-primary">Confirm Trade?</button>
    </body>
</html>