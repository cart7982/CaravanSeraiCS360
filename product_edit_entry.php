<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Product Edit</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="./Images/logo_1.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styles.css" rel="stylesheet" />
    </head>
    <body>
        <?php
            $conn = mysqli_connect("localhost","root","","caravanserai");
            session_start();
            $_ProductID = $_POST['ProductID'];
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
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
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
                    <h1 class="display-4 fw-bolder">Product Listing Edit</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Keep your listings up-to-date and accurate for optimal bartering</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">

            <?php
                $_UserID = $_SESSION["UserID"];

                if(isset($_POST["ProductID"]))
                {
                    $_ProductID = $_POST["ProductID"];
                }
                if(isset($_POST["ProductID"]))
                {
                    $_UserID = $_POST["UserID"];
                }
                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM products WHERE ProductID='$_ProductID' LIMIT 50");
                //$data = $result->fetch_all(MYSQLI_ASSOC);
                $row = $result->fetch_assoc();

            ?>

            
                    
            <div class = "card bg-secondary">
                <div class = "card-body">
                    To ensure accurate barters, you may need to update your product information. 
                </div>
                <div class = "card-body">
                    Please ensure that you have accurate, up-to-date information. 
                </div>
            </div>

            <!--This form starts the user session.  This allows for the usage of
                global variables as described in session.php.-->
            <form action="product_edit.php" method="post" enctype="multipart/form-data">
                <div class = "mb-3 mt-3">
                    <?php echo "Current ProductName is: ".$row['ProductName']; ?><br>
                    <label for = "productname" class = "form-label">New Product Name: </label>
                    <input type = "text" class = "form-control" id = "productname" placeholder = "Enter New Produt Name" name = "productname">
                </div>
                <div class = "mb-3">
                    <?php echo "Current amount is: ".$row['Amount']; ?><br>
                    <label for = "amount" class = "form-label"> New Amount in Stock: </label>
                    <input type = "text" class = "form-control" id = "amount" placeholder = "Enter amount" name = "amount">
                </div>
                <div class = "mb-3">
                    <?php echo "Current Description is: ".$row['Description']; ?><br>
                    <label for = "description" class = "form-label"> New Description: </label>
                    <input type = "text" class = "form-control" id = "description" placeholder = "Enter description" name = "description">
                </div>
                <div class="form-group">
                    <?php echo "Current Product image is: "; ?><br>
                    <img class="img-productthumb" src="./Images/<?php echo $row['ImagePath']; ?>"><br>
                    <label for = "uploadfile" class = "form-label">Product picture:  </label>
                    <input class="form-control" type="file" id = "uploadfile" name="uploadfile" >
                </div>
                

                <?php 
                if(isset($_SESSION["AdminID"]) && $_SESSION["AdminID"] != null && $_SESSION["AdminID"] != "0")
                { ?>
                    <input type="hidden" name="ProductID" value="<?= htmlspecialchars($_ProductID) ?>"></input>
                    <div class="form-group">
                        <?php echo "Current ProductID is: ".$row['ProductID']; ?><br>
                        <label for = "NewProductID" class = "form-label">New Product ID:  </label>
                        <input class="form-control" type="text" id = "NewProductID" name="NewProductID" >
                    </div>
                    <div class="form-group">
                        <?php echo "Current UserID is: ".$row['UserID']; ?><br>
                        <label for = "UserID" class = "form-label">New User ID:  </label>
                        <input class="form-control" type="text" id = "UserID" name="UserID" >
                    </div>
                <?php
                }
                else
                {
                ?>
                    <input type="hidden" name="ProductID" value="<?= htmlspecialchars($_ProductID) ?>"></input>
                <?php
                }
                ?>
                <button type = "submit" class = "btn btn-secondary" name="ProductID" value="<?= $_ProductID ?>"> Submit</button>
            </form>
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; CaravanSerai 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
