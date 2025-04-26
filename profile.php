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
                                <li><a class="dropdown-item" href="group_login.php">Log In</a></li>
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

        
    
        <?php if(isset($_SESSION["AdminID"])) 
            { 
        ?>


        <!-- Admin Panels Section-->
        <section class="py-5">
            <div class = "card bg-success">
                <div class = "card-header">
                    Welcome, <?php echo $_SESSION["Username"] ?>!<br>
                    User ID is: <?php echo $_SESSION["UserID"] ?><br>
                    Admin ID is: <?php echo $_SESSION["AdminID"] ?><br>
                    Email is: <?php echo $_SESSION["Email"] ?><br>
                    <?php 
                        if(isset($_SESSION["GroupID"]))
                        {
                            echo "Logged into group: ".$_SESSION["GroupName"]."";
                        }
                        $_UserID = $_SESSION["UserID"];
                        ?>
                    <form action="profile_edit.html" method="post">
                            <button style="height:30px; width:240px" class="btn btn-light" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Edit Profile</button></form><br>
                        
                </div>
            </div>

            <div class = "card-body">
                    <h2>All Products for Sale: </h2>
                <!-- Modal button to create product listing -->
                <div class = "card-footer bg-success">
                    <button type = "button" class = "btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal1">
                        Create a Listing
                    </button>
                
                    <div class = "modal" id = "myModal1">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                
                                <div class = "modal-header">
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                                </div>
                
                                <div class = "modal-body">
                                    <form action="product_add.php" method="post">
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
                                        <div class="form-group">
                                            <label for = "uploadfile" class = "form-label">Product picture:  </label>
                                            <input class="form-control" type="file" id = "uploadfile" name="uploadfile" >
                                        </div>
                                        <div class="form-group">
                                            <label for = "UserID" class = "form-label">User ID:  </label>
                                            <input class="form-control" type="text" id = "UserID" name="UserID" >
                                        </div>
                                        <button type = "submit" class = "btn btn-secondary"> Submit</button>
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
                <!-- Start of admin product list -->
            <?php

                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM products");
                $data = $result->fetch_all(MYSQLI_ASSOC);                

            ?>	
                <table border="1" class="table table-success table-striped table-hover">
                    <tr>
                        <th>Product Name</th>
                        <th>ProductID</th>
                        <th>UserID</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['ProductID']) ?></td>
                        <td><?= htmlspecialchars($row['UserID']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><?= htmlspecialchars($row['Description']) ?></td>
                        <td><img class="img-productthumb" src="./Images/<?php echo $row['ImagePath']; ?>"></td>
                        
                        <td><form action="product_remove.php" method="post">
                            <button style="height:30px; width:100px" class="btn btn-light" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Delete</button></form>
                            </td>
                        <td><form action="product_edit_entry.php" method="post">
                            <input type="hidden" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>"></input>
                            <button style="height:30px; width:100px" class="btn btn-light" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Update</button></form>
                            </td>
                    </tr>
                    <?php endforeach ?>
                </table>       
        
            <!-- Admin Users Table -->
            <div class = "card bg-primary">
                <div class = "card-body">
                    <h2>All Users In The Database: </h2>

                <!-- Modal button to create a user -->
                <div class = "card-footer bg-success">
                    <button type = "button" class = "btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal2">
                        Create a User
                    </button>
                
                    <div class = "modal" id = "myModal2">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                
                                <div class = "modal-header">
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                                </div>
                
                                <div class = "modal-body">
                                    <form action="user_add.php" method="post">
                                        <div class = "mb-3 mt-3">
                                            <label for = "username" class = "form-label">Username: </label>
                                            <input type = "text" class = "form-control" id = "username" placeholder = "Enter username" name = "username">
                                        </div>
                                        <div class = "mb-3 mt-3">
                                            <label for = "pwd" class = "form-label">Password: </label>
                                            <input type = "password" class = "form-control" id = "pwd" placeholder = "Enter password" name = "pwd">
                                        </div>
                                        <div class = "mb-3 mt-3">
                                            <label for = "email" class = "form-label">Email: </label>
                                            <input type = "email" class = "form-control" id = "email" placeholder = "Enter email" name = "email">
                                        </div>
                                        <div class = "mb-3">
                                            <p> Are they a Merchant or an Admin?</p>
                                            <input type="radio" id="customer" name="usertype" value="customer">
                                            <label for="customer">Customer</label><br>
                                            <input type="radio" id="admin" name="usertype" value="admin">
                                            <label for="admin">Admin</label><br>
                                        </div>
                                        <button type = "submit" class = "btn btn-secondary"> Submit</button>
                                    </form>
                                </div>
                
                                <div class = "modal-footer">
                                    <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start of admin users list -->
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM users LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                            <?php 
                            //Select all users:
                            $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);

                            //Go through list to display dynamically:
                            while ($row = $result->fetch_assoc()) { ?>
                                <div class="card h-100 bg-light">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder"><?php echo htmlspecialchars($row['Username']); ?></h5>
                                            <?php echo htmlspecialchars($row['Email']); ?><br>
                                            <?php echo htmlspecialchars($row['UserID']); ?>
                                            <form action="user_remove.php" method="post">
                                                <button style="height:30px; width:100px" class="btn btn-success" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Delete</button></form>
                                            <form action="profile_edit_entry.php" method="post">
                                                <button style="height:30px; width:100px" class="btn btn-success" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Update</button></form>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Admin Groups Table -->
             <div class = "card bg-primary">
                <div class = "card-body">
                    <h2>All Groups In The Database: </h2>

                <!-- Modal button to create a group -->
                <div class = "card-footer bg-success">
                    <button type = "button" class = "btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal7">
                        Create a Group
                    </button>
                
                    <div class = "modal" id = "myModal7">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                
                                <div class = "modal-header">
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                                </div>
                
                                <div class = "modal-body">                                   

                                    <form action="group_create.php" method="post">
                                        <div class = "mb-3 mt-3">
                                            <label for = "groupname" class = "form-label">Group Name: </label>
                                            <input type = "text" class = "form-control" id = "groupname" placeholder = "Enter group name" name = "groupname">
                                        </div>
                                        <div class = "mb-3 mt-3">
                                            <label for = "email" class = "form-label">Group Email: </label>
                                            <input type = "email" class = "form-control" id = "email" placeholder = "Enter email" name = "email">
                                        <div class = "mb-3">
                                            <label for = "pwd" class = "form-label"> Group Password: </label>
                                            <input type = "password" class = "form-control" id = "pwd" placeholder = "Enter password" name = "pwd">
                                        </div>
                                        <button type = "submit" class = "btn btn-secondary"> Submit</button>
                                    </form>
                                </div>
                
                                <div class = "modal-footer">
                                    <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start of admin groups list -->
                    <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM groups LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                            <?php 
                            //Select all users:
                            $sql = "SELECT * FROM groups";
                            $result = $conn->query($sql);

                            //Go through list to display dynamically:
                            while ($row = $result->fetch_assoc()) { ?>
                                <div class="card h-100 bg-light">
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder"><?php echo htmlspecialchars($row['GroupName']); ?></h5>
                                            <?php echo htmlspecialchars($row['Email']); ?><br>
                                            <?php echo htmlspecialchars($row['GroupID']); ?>
                                            <form action="group_delete.php" method="post">
                                                <button style="height:30px; width:100px" class="btn btn-success" input type="submit" name="GroupID" value="<?= htmlspecialchars($row['GroupID']) ?>">Delete</button></form>
                                            <form action="group_edit.php" method="post">
                                                <button style="height:30px; width:100px" class="btn btn-success" input type="submit" name="GroupID" value="<?= htmlspecialchars($row['GroupID']) ?>">Update</button></form>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-primary">
            
                <h2>ALL CURRENT TRANSACTIONS</h2><br>

                <!-- Modal button to create new transaction -->
                <div class = "card-footer bg-success">
                    <button type = "button" class = "btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal6">
                        Create a Transaction
                    </button>
                
                    <div class = "modal" id = "myModal6">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                
                                <div class = "modal-header">
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                                </div>
                                <div class = "modal-body">
                                    <form action="barter_create.php" method="post">
                                        <div class = "mb-3 mt-3">
                                            <label for = "userid1" class = "form-label">User 1: </label>
                                            <input type = "text" class = "form-control" id = "userid1" placeholder = "Enter User id" name = "userid1">
                                        </div>
                                        <div class = "mb-3 mt-3">
                                            <label for = "userid2" class = "form-label">User 2: </label>
                                            <input type = "text" class = "form-control" id = "userid2" placeholder = "Enter User id" name = "userid2">
                                        </div>
                                        <div class = "mb-3 mt-3">
                                            <label for = "quantity" class = "form-label">Quantity: </label>
                                            <input type = "text" class = "form-control" id = "quantity" placeholder = "Enter quantity" name = "quantity">
                                        </div>
                                        <div class = "mb-3 mt-3">
                                            <label for = "amount" class = "form-label">ProductID1: </label>
                                            <input type = "text" class = "form-control" id = "amount" placeholder = "Enter amount" name = "amount">
                                        </div>
                                        <div class = "mb-3">
                                            <label for = "ProductID1" class = "form-label">Product ID:  </label>
                                            <input type = "text" class = "form-control" id = "ProductID1" placeholder = "Enter product ProductID1" name = "ProductID1">
                                        </div>
                                        <div class = "mb-3">
                                            <label for = "ProductName1" class = "form-label">ProductName1:  </label>
                                            <input type = "text" class = "form-control" id = "ProductName1" placeholder = "Enter product ProductName1" name = "ProductName1">
                                        </div>
                                        <button type = "submit" class = "btn btn-secondary"> Submit</button>
                                    </form>
                                </div>
                
                                <div class = "modal-footer">
                                    <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM transactions LIMIT 50");
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                ?>

                <table border="1" class="table table-secondary table-striped table-hover">
                    <tr>
                        <th>Transaction ID</th>
                        <th>Product ID 1</th>
                        <th>Product ID 2</th>
                        <th>Quantity 1</th>
                        <th>Quantity 2</th>
                        <th>User ID 1</th>
                        <th>User ID 2</th>
                        <th>Product Name 1</th>
                        <th>Product Name 2</th>
                        <th>Completed</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['TransactionID']) ?></td>
                        <td><?= htmlspecialchars($row['ProductID1']) ?></td>
                        <td><?= htmlspecialchars($row['ProductID2']) ?></td>
                        <td><?= htmlspecialchars($row['Quantity1']) ?></td>
                        <td><?= htmlspecialchars($row['Quantity2']) ?></td>
                        <td><?= htmlspecialchars($row['UserID1']) ?></td>
                        <td><?= htmlspecialchars($row['UserID2']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName1']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName2']) ?></td>
                        <td><?= htmlspecialchars($row['Completed']) ?></td>
                        <td><form action="barter_delete.php" method="post">
                                <button style="height:30px; width:100px" class="btn btn-light" input type="submit" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>">Delete</button>
                            </form></td>
                        <td><form action="barter_edit_entry.php" method="post">
                                <button style="height:30px; width:100px" class="btn btn-light" input type="submit" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>">Update</button>
                            </form></td>
                    </tr>
                    <?php endforeach ?>
                </table> 
            </div>    
            

            <!-- Admin Table of All Messages -->
            <div class = "card-body">
                <h2>ALL OFFERS ON THE MARKET:</h2> 
                <?php
                    $_UserID = $_SESSION["UserID"];
                    $conn = mysqli_connect("localhost","root","","caravanserai");
                    $result = mysqli_query($conn,"SELECT * FROM messages LIMIT 50");
                    $data2 = $result->fetch_all(MYSQLI_ASSOC);
                ?>
                    
                    <table  class="table table-primary table-striped table-hover" border="1">
                    <tr>
                        <th>User ID 1</th>
                        <th>User ID 2</th>
                        <th>Barter Message</th>
                        <th>Transaction ID</th>
                        <th>Amount 1</th>
                        <th>Message ID</th>
                        <th>Amount 2</th>
                        <th>Product Name 1</th>
                        <th>Product Name 2</th>
                        <th>MessageUser ID</th>
                        <th>Product 1 User ID</th>
                        <th>Product 2 User ID</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data2 as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['UserID1']) ?></td>
                        <td><?= htmlspecialchars($row['UserID2']) ?></td>
                        <td><?= htmlspecialchars($row['BarterMessage']) ?></td>
                        <td><?= htmlspecialchars($row['TransactionID']) ?></td>
                        <td><?= htmlspecialchars($row['Amount1']) ?></td>
                        <td><?= htmlspecialchars($row['MessageID']) ?></td>
                        <td><?= htmlspecialchars($row['Amount2']) ?></td>
                        <td><?= htmlspecialchars($row['Amount1']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName1']) ?></td>
                        <td><?= htmlspecialchars($row['ProductName2']) ?></td>
                        <td><?= htmlspecialchars($row['MessageUserID']) ?></td>
                        <td><?= htmlspecialchars($row['Product1UserID']) ?></td>
                        <td><?= htmlspecialchars($row['Product2UserID']) ?></td>
                        
                        <td><form action="offer_delete.php" method="post">
                            <button style="height:30px; width:120px" class="btn btn-light" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Delete</button></form></td>
                        
                        <td><form action="offer_edit.php" method="post">
                            <button style="height:30px; width:120px" class="btn btn-light" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Update</button></form></td>
                    </tr>
                    <?php endforeach ?>
                    </table>

            </div>


        </section>
   
        <?php 
            }
            else
            {
        ?>

        <!-- Normal Merchant Section-->
        
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
                            <button style="height:30px; width:180px" class="btn btn-light" input type="submit" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>">Update Profile</button></form><br>
                        
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

                    <table border="1" class="table table-light table-striped table-hover">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName1']) ?></td>
                        <td><?= htmlspecialchars($row['Quantity1']) ?></td>
                        <td><form action="barter_remove.php" method="post">
                                <label for="Quantity">Remove></label>
                                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                                <button style="height:30px; width:70px" class="btn btn-light" input type="submit" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>">Remove</button>
                            </form></td>
                        <td><form action="barter_add.php" method="post">
                                <label for="Quantity">Add></label>
                                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                                <button style="height:30px; width:70px" class="btn btn-light" input type="submit" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>">Add</button>
                            </form></td>
                        <td><form action="cart_offer.php" method="post">
                                <button style="height:30px; width:100px" class="btn btn-light" input type="submit" name="TransactionID" value="<?= htmlspecialchars($row['TransactionID']) ?>">Make Offer</button>
                            </form></td>
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

                        <table border="1" class="table table-light table-striped table-hover">
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
                                <button style="height:30px; width:120px" class="btn btn-light" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Accept Offer</button></form></td>
                            <td><form action="offer_delete.php" method="post">
                                <button style="height:30px; width:120px" class="btn btn-light" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Cancel Offer</button></form></td>
                            
                            <td><form action="counteroffer_form.php" method="post">
                                <input type="hidden" name="message" value="<?= htmlspecialchars($row['BarterMessage']) ?>"></input>
                                <input type="hidden" name="amount2" value="<?= htmlspecialchars($row['Amount2']) ?>"></input>
                                <input type="hidden" name="ProductName2" value="<?= htmlspecialchars($row['ProductName2']) ?>"></input>
                                <button style="height:30px; width:150px" class="btn btn-light" input type="submit" name="MessageID" value="<?= $row['MessageID'] ?>">Counteroffer</button></form></td>
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

                        <table border="1" class="table table-light table-striped table-hover">
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
                                <button style="height:30px; width:120px" class="btn btn-light" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Accept Offer</button></form></td>
                            <td><form action="offer_delete.php" method="post">
                                <button style="height:30px; width:120px" class="btn btn-light" input type="submit" name="MessageID" value="<?= htmlspecialchars($row['MessageID']) ?>">Cancel Offer</button></form></td>
                            
                            <td><form action="counteroffer_form.php" method="post">
                                <input type="hidden" name="message" value="<?= htmlspecialchars($row['BarterMessage']) ?>"></input>
                                <input type="hidden" name="amount2" value="<?= htmlspecialchars($row['Amount1']) ?>"></input>
                                <input type="hidden" name="ProductName2" value="<?= htmlspecialchars($row['ProductName1']) ?>"></input>
                                <button style="height:30px; width:150px" class="btn btn-light" input type="submit" name="MessageID" value="<?= $row['MessageID'] ?>">Counteroffer</button></form></td>
                                                                            
                        </tr>
                        <?php endforeach ?>
                        </table>
                </div>
            

                <div class = "card-body">
                    <h2>Your Products for Sale: </h2>


                    <div class = "card-footer">
                    <button type = "button" class = "btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal1">
                        Create a Listing
                    </button>
                
                    <div class = "modal" id = "myModal1">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                
                                <div class = "modal-header">
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                                </div>
                
                                <div class = "modal-body">
                                    <form action="product_add.php" method="post" enctype="multipart/form-data">
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
                                        <button type = "submit" class = "btn btn-secondary"> Submit</button>
                                    </form>
                                </div>
                
                                <div class = "modal-footer">
                                    <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                

                        <?php
                            $_UserID = $_SESSION["UserID"];
                            $conn = mysqli_connect("localhost","root","","caravanserai");
                            $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID='$_UserID' LIMIT 50");
                            $data = $result->fetch_all(MYSQLI_ASSOC);
                        ?>

                        <table border="1" class="table table-dark table-striped table-hover">
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
                                <td><img class="img-productthumb" src="./Images/<?php echo $row['ImagePath']; ?>"></td>
                                <td><form action="product_remove.php" method="post">
                                    <button style="height:30px; width:150px" class="btn btn-light" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Remove</button></form></td>
                                <td><form action="product_edit_entry.php" method="post">
                                    <button style="height:30px; width:150px" class="btn btn-light" input type="submit" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>">Update</button></form></td>
                                </tr>
                            <?php endforeach ?>
                        </table>

                </div>

                
            </div>

        </section>

        <?php 
            }
        ?>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; CaravanSerai 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
