<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Profile</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="./Images/logo_1.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styles.css" rel="stylesheet" />
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

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">CaravanSerai</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <!--Home Page -->
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home Page</a></li>
                        <!-- Account -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" aria-current = "page" href="profile.php">Profile</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>
                                <li><a class="dropdown-item" href="login.html">Log In</a></li>
                                <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                            </ul>
                        </li>
                        <!-- Group -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Groups</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="group_create.html">Create Group</a></li>
                                <li><a class="dropdown-item" href="group_signup.html">Sign Up</a></li>
                                <li><a class="dropdown-item" href="group_login.html">Log In</a></li>
                                <li><a class="dropdown-item" href="group_logout.php">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Profile</h1>
                    <p class="lead fw-normal text-white-50 mb-0">The heart of your CaravanSerai bartering</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        
        <section class="py-5">
        <div class = "card bg-success">
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

            
        <div class="card bg-primary">
            <div class = "card-body">
                <h2>START A BARTER</h2><br>

                <?php
                $_UserID = $_SESSION["UserID"];
                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM transactions WHERE UserID2='$_UserID' AND Completed='0' LIMIT 50");
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
                        <th>Product Picture</th>
                        <th>Actions</th>
                        <th></th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><?= htmlspecialchars($row['Description']) ?></td>
                        <td><img class="img-product" src="./Images/<?php echo $row['ImagePath']; ?>"></td>
                        <td><form action="remove_product.php" method="post">
                            <button style="height:30px; width:150px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                        <td><form action="product_edit_entry.php" method="post">
                            <button style="height:30px; width:150px" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Edit</button></form></td>
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
                                <form action="add_product.php" method="post" enctype="multipart/form-data">
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
                                    <div class="form-group">
                                        <label for = "uploadfile" class = "form-label">Product picture:  </label>
                                        <input class="form-control" type="file" id = "uploadfile" name="uploadfile" >
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

        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; CaravanSerai 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
