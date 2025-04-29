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
            if (!isset($_SESSION["UserID"]))
            {
                echo "Login failed!  No user ID found!";
                header("Location:login.html");
                exit();
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
                    <h1 class="display-4 fw-bolder">Admin Offer/Message Edit</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Keep your listings up-to-date and accurate for optimal bartering</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">

                
        <div class = "card bg-secondary">
            <div class = "card-body">
                Admin Use Only
            </div>
            <div class = "card-body">
                This is the page for an admin to change information about a current tuple in the messages table.<br>
            </div>
        </div>

        <?php
            if(isset($_POST["MessageID"]))
            {
                $_MessageID = $_POST["MessageID"];
            }
            $_UserID = $_SESSION["UserID"];
            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM groups WHERE MessageID='$_MessageID'");
            //$data = $result->fetch_all(MYSQLI_ASSOC);
            $row = $result->fetch_assoc();
        ?>
        <!--This form starts the user session.  This allows for the usage of
            global variables as described in session.php.-->	
        <form action="offer_edit.php" method="post">
            <div class = "mb-3 mt-3">
                <?php echo "Current MessageID is: ".$row['MessageID']."<br>"; ?>
                <label for = "NewMessageID" class = "form-label">New MessageID: </label>
                <input type = "text" class = "form-control" id = "NewMessageID" placeholder = "Enter NewMessageID" name = "NewMessageID">
            </div>
            <div class = "mb-3">
                <?php echo "Current UserID1 is: ".$row['UserID1']."<br>"; ?>
                <label for = "UserID1" class = "form-label"> New UserID1: </label>
                <input type = "text" class = "form-control" id = "UserID1" placeholder = "Enter UserID1" name = "UserID1">
            </div>
            <div class = "mb-3">
                <?php echo "Current UserID2 is: ".$row['UserID2']."<br>"; ?>
                <label for = "UserID2" class = "form-label"> New UserID2: </label>
                <input type = "text" class = "form-control" id = "UserID2" placeholder = "Enter UserID2" name = "UserID2">
            </div>
            <div class = "mb-3">
                <?php echo "Current BarterMessage is: ".$row['BarterMessage']."<br>"; ?>
                <label for = "BarterMessage" class = "form-label"> New BarterMessage: </label>
                <input type = "text" class = "form-control" id = "BarterMessage" placeholder = "Enter BarterMessage" name = "BarterMessage">
            </div>
            <div class = "mb-3">
                <?php echo "Current TransactionID is: ".$row['TransactionID']."<br>"; ?>
                <label for = "TransactionID" class = "form-label"> New TransactionID: </label>
                <input type = "text" class = "form-control" id = "TransactionID" placeholder = "Enter TransactionID" name = "TransactionID">
            </div>
            <div class = "mb-3">
                <?php echo "Current Amount1 is: ".$row['Amount1']."<br>"; ?>
                <label for = "Amount1" class = "form-label"> New Amount1: </label>
                <input type = "text" class = "form-control" id = "Amount1" placeholder = "Enter Amount1" name = "Amount1">
            </div>
            <div class = "mb-3">
                <?php echo "Current Amount2 is: ".$row['Amount2']."<br>"; ?>
                <label for = "Amount2" class = "form-label"> New Amount2: </label>
                <input type = "text" class = "form-control" id = "Amount2" placeholder = "Enter Amount2" name = "Amount2">
            </div>
            <div class = "mb-3">
                <?php echo "Current ProductName1 is: ".$row['ProductName1']."<br>"; ?>
                <label for = "ProductName1" class = "form-label"> New ProductName1: </label>
                <input type = "text" class = "form-control" id = "ProductName1" placeholder = "Enter ProductName1" name = "ProductName1">
            </div>
            <div class = "mb-3">
                <?php echo "Current ProductName2 is: ".$row['ProductName2']."<br>"; ?>
                <label for = "ProductName2" class = "form-label"> New ProductName2: </label>
                <input type = "text" class = "form-control" id = "ProductName2" placeholder = "Enter ProductName2" name = "ProductName2">
            </div>
            <div class = "mb-3">
                <?php echo "Current MessageUserID is: ".$row['MessageUserID']."<br>"; ?>
                <label for = "MessageUserID" class = "form-label"> New MessageUserID: </label>
                <input type = "text" class = "form-control" id = "MessageUserID" placeholder = "Enter MessageUserID" name = "MessageUserID">
            </div>
            <div class = "mb-3">
                <?php echo "Current Product1UserID is: ".$row['Product1UserID']."<br>"; ?>
                <label for = "Product1UserID" class = "form-label"> New Product1UserID: </label>
                <input type = "text" class = "form-control" id = "Product1UserID" placeholder = "Enter Product1UserID" name = "Product1UserID">
            </div>
            <div class = "mb-3">
                <?php echo "Current Product2UserID is: ".$row['Product2UserID']."<br>"; ?>
                <label for = "Product2UserID" class = "form-label"> New Product2UserID: </label>
                <input type = "text" class = "form-control" id = "Product2UserID" placeholder = "Enter Product2UserID" name = "Product2UserID">
            </div>

            <button type = "submit" class = "btn btn-secondary" name="MessageID" value="<?= $_MessageID ?>"> Submit</button>
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
