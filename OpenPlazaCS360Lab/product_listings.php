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

        <?php
        $conn = mysqli_connect("localhost","root","","openplaza");
        $result = mysqli_query($conn,"SELECT * FROM products LIMIT 50");
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
            <td>        
            <div class = "card-footer">
                <button type = "button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal2">
                    Add To Cart
                </button>
            
                <div class = "modal" id = "myModal2">
                    <div class = "modal-dialog">
                        <div class = "modal-content">
            
                            <div class = "modal-header">
                                <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                            </div>
            
                            <div class = "modal-body">
                                <form action="add_cart.php" method="post">
                                    <div class = "mb-3 mt-3">
                                        <label for = "Amount" class = "form-label">Amount: </label>
                                        <input type = "text" class = "form-control" id = "Amount" placeholder = "Enter amount" name = "Amount">
                                        <!-- <input type = "text" class = "form-control" value="<?= htmlspecialchars($row['ProductID']) ?>" placeholder = "Enter amount" name = "ProductID">-->
                                    </div>
                                    <button type = "submit" name="ProductID" value="<td><?= htmlspecialchars($row['ProductID']) ?></td>" class = "btn btn-primary"> Submit</button>
                                </form>
                            </div>
            
                            <div class = "modal-footer">
                                <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div></td>
        

        
            </tr>
        <?php endforeach ?>
        </table>       
        
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
                            <form action="add_product.php" method="post">
                                <div class = "mb-3 mt-3">
                                    <label for = "product-name" class = "form-label">Product to sell: </label>
                                    <input type = "text" class = "form-control" id = "product-name" placeholder = "Enter product name" name = "product-name">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "price" class = "form-label">Price: </label>
                                    <input type = "text" class = "form-control" id = "price" placeholder = "Enter price" name = "price">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "amount" class = "form-label">Amount: </label>
                                    <input type = "text" class = "form-control" id = "amount" placeholder = "Enter amount" name = "amount">
                                </div>
                                <div class = "mb-3">
                                    <label for = "description" class = "form-label">Product description:  </label>
                                    <input type = "text" class = "form-control" id = "description" placeholder = "Enter product description" name = "description">
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