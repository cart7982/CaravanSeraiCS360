<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "styleII.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php
        session_start();
        if(!isset($_SESSION["UserID"]))
        {
            echo "User not detected!  Please log in to proceed!";
            header('Location:login.html');
        }
        ?>

        <div class = "topnav" tabindex = "1">
            <i class = "db2" tabindex = "1"></i>
            <a class = "dropbtn">Account</a>
            <div class = "drop-content">
                <a href = "signup.html">Sign Up</a>
                <a href = "login.html">Login</a>
                <a href = "logout.php">Logout</a>
                <a href = "profile.php">Profile</a>
                <a href = "index.php">Listings</a>
            </div>
        </div>

        <div class = "topnav" tabindex = "1">
            <i class = "db2" tabindex = "1"></i>
            <a class = "dropbtn">Groups</a>
            <div class = "drop-content">
                <a href = "group_create.html">Create Group</a>
                <a href = "group_signup.html">Sign Up for A Group</a>
                <a href = "group_login.php">Group Login</a>
                <a href = "group_logout.php">Group Logout</a>
            </div>
        </div>

        <h1>MERCHANT PROFILE</h1>

        <div class = "card">
            <div class = "card-header">
                Welcome, <?php echo $_SESSION["Username"] ?>!<br>
                User ID is: <?php echo $_SESSION["UserID"] ?><br>
                Email is: <?php echo $_SESSION["Email"] ?><br>
                <?php 
                    if(isset($_SESSION["GroupID"]))
                    {
                        echo "Logged into group: ".$_SESSION["GroupName"]."";
                    }
                    $_UserID = $_SESSION["UserID"];
                    ?>
                <form action="profile_edit.html" method="post">
                        <button style="height:30px; width:120px" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Edit Profile</button></form><br>
                    
            </div>
        </div>

            
        <div class="card">
            <div class = "card-body">
                <h2>START A BARTER</h2><br>

                <?php
                $_UserID = $_SESSION["UserID"];
                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM transactions WHERE UserID2='$_UserID' LIMIT 50");
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
                            <label for="Quantity">Remove></label>
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
    
            
            <div class = "card-body">
                <h2>OFFERS YOU HAVE MADE:</h2> 
                <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM messages WHERE UserID1='$_UserID' LIMIT 50");
                    $data2 = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Message</th>
                        <th></th>
                        <th>Your Product</th>
                        <th></th>
                        <th></th>
                        <th>Their Product</th>
                        <th>Accept</th>
                        <th>Reject</th>
                        <th>Counteroffer</th>
                    </tr>
                    <?php foreach($data2 as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['BarterMessage']) ?></td>
                        <td><?= htmlspecialchars($row['Amount1']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName1']) ?></td>
                        <td>in exchange for</td>
                        <td><?= htmlspecialchars($row['Amount2']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName2']) ?></td>
                        <td><form action="barter_accept.php" method="post">
                            <button style="height:30px; width:120px" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Accept Offer</button></form></td>
                        <td><form action="remove_offer.php" method="post">
                            <button style="height:30px; width:120px" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Cancel Offer</button></form></td>
                        
                        <td><form action="counteroffer_form.php" method="post">
                            <input type="hidden" name="message" value="<?= htmlspecialchars($row['BarterMessage']) ?>"></input>
                            <input type="hidden" name="amount2" value="<?= htmlspecialchars($row['Amount2']) ?>"></input>
                            <input type="hidden" name="ProductName2" value="<?= htmlspecialchars($row['ProductName2']) ?>"></input>
                            <button style="height:30px; width:150px" input type="submit" name="MessageID" value="<?= $row['MessageID'] ?>">Counteroffer</button></form></td>
                                                                        
                        </tr>
                    <?php endforeach ?>
                    </table>

            </div>


            <div class = "card-body">
                <h2>OFFERS MADE TO YOU:</h2> 
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM messages WHERE UserID2='$_UserID' LIMIT 50");
                    $data2 = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Message</th>
                        <th></th>
                        <th>Your Product</th>
                        <th></th>
                        <th></th>
                        <th>Their Product</th>
                        <th>Accept</th>
                        <th>Reject</th>
                        <th>Counteroffer</th>
                    </tr>
                    <?php foreach($data2 as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['BarterMessage']) ?></td>
                        <td><?= htmlspecialchars($row['Amount2']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName2']) ?></td>
                        <td>in exchange for</td>
                        <td><?= htmlspecialchars($row['Amount1']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName1']) ?></td>
                        <td><form action="barter_accept.php" method="post">
                            <button style="height:30px; width:120px" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Accept Offer</button></form></td>
                        <td><form action="remove_offer.php" method="post">
                            <button style="height:30px; width:120px" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Cancel Offer</button></form></td>
                        
                        <td><form action="counteroffer_form.php" method="post">
                            <input type="hidden" name="message" value="<?= htmlspecialchars($row['BarterMessage']) ?>"></input>
                            <input type="hidden" name="amount2" value="<?= htmlspecialchars($row['Amount1']) ?>"></input>
                            <input type="hidden" name="ProductName2" value="<?= htmlspecialchars($row['ProductName1']) ?>"></input>
                            <button style="height:30px; width:150px" input type="submit" name="MessageID" value="<?= $row['MessageID'] ?>">Counteroffer</button></form></td>
                                                                        
                        </tr>
                    <?php endforeach ?>
                    </table>

            </div>
        

            <div class = "card-body">
                <h2>Your Products for Sale: </h2>
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID='$_UserID' LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <table border="1">
                    <tr>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><?= htmlspecialchars($row['Description']) ?></td>
                        <td><form action="remove_product.php" method="post">
                            <button style="height:30px; width:70px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                        <td><form action="product_edit_entry.php" method="post">
                            <button style="height:30px; width:70px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">EDIT</button></form></td>
                        </tr>
                    <?php endforeach ?>
                    </table>

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
                                <form action="add_product.php" method="post">
                                    <div class = "mb-3 mt-3">
                                        <label for = "product-name" class = "form-label">Product to sell: </label>
                                        <input type = "text" class = "form-control" id = "product-name" placeholder = "Enter product name" name = "product-name">
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