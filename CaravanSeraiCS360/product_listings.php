<!DOCTYPE html>
<html>
    <head>
        <title>Product Listings</title>
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

        <h1>PRODUCT LISTINGS</h1>


    <div class = "card">
        <div class = "card-header">
            Similarly to a blogging site, this page holds the listings of various products.
        </div>
        <div class = "card-body">
            Product 1: Name, quantity, product to be exchanged, quantity. 
            <a href = "product_description.html">Detailed Description</a>
        </div>
        <div class = "card-body">
            Product 2: Name, quantity, product to be exchanged, quantity.
            <a href = "product_description.html">Detailed Description</a>
        </div>
        
        <div class = "card-footer">
            <button type = "button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal1">
                Create a Listing
            </button>
        
            <div class = "modal" id = "myModal1">
                <div class = "modal-dialog">
                    <div class = "modal-content">
        
                        <div class = "modal-header">
                            <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                        </div>
        
                        <div class = "modal-body">
                            <form>
                                <div class = "mb-3 mt-3">
                                    <label for = "product-name" class = "form-label">Product to sell: </label>
                                    <input type = "product-name" class = "form-control" id = "product-name" placeholder = "Enter product name" name = "product-name">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "quantity" class = "form-label">Quantity: </label>
                                    <input type = "quantity" class = "form-control" id = "quantity" placeholder = "Enter quantity" name = "quantity">
                                <div class = "mb-3">
                                    <label for = "prod-rec" class = "form-label">Product to recieve:  </label>
                                    <input type = "product-name" class = "form-control" id = "prod-rec" placeholder = "Enter product name" name = "prod-rec">
                                </div>
                                <div class = "mb-3">
                                    <label for = "quantity2" class = "form-label">Quantity: </label>
                                    <input type = "quantity" class = "form-control" id = "quantity2" placeholder = "Enter quantity" name = "quantity2">
                                </div>
                                <button type = "submit" class = "btn btn-primary"> Submit</button>
                            </form>
                        </div>
        
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
        
        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>