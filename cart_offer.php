<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Cart</title>
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
				                <li><a class="dropdown-item" href="group_create.php">Create Group</a></li>
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
                    <h1 class="display-4 fw-bolder">Cart</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Your items for barter and barters in progress</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
                
            <div class = "card bg-secondary">
                
                    <?php

                    if(isset($_SESSION["GroupID"]))
                    {
                        $_GroupID = $_SESSION["GroupID"];
                        $_GroupName = $_SESSION["GroupName"];
                        $_UserID = $_SESSION["UserID"];

                        //$GroupID = intval($_GroupID);
                        echo"Signed into group: ".$_SESSION['GroupName'];
                        //echo"\nSigned into group: ".$_SESSION['GroupID'];

                        $conn = mysqli_connect("localhost","root","","caravanserai");
                        $result = mysqli_query($conn,"SELECT * FROM products 
                                                                    NATURAL JOIN owners 
                                                                    WHERE UserID IN 
                                                                        (SELECT UserID 
                                                                        FROM user_groups 
                                                                        WHERE GroupID='$_GroupID')");
                        $data = $result->fetch_all(MYSQLI_ASSOC);

                    }
                    else
                    {
                        $_UserID = $_SESSION["UserID"];
                        $conn = mysqli_connect("localhost","root","","caravanserai");
                        $result = mysqli_query($conn,"SELECT * FROM products NATURAL JOIN owners WHERE UserID='$_UserID' LIMIT 50");
                        $data = $result->fetch_all(MYSQLI_ASSOC);

                    }

                    $_TransactionID = $_POST['TransactionID'];

                    $result = mysqli_query($conn, "SELECT ProductName1 as prdname1, Quantity1 as quantity FROM transactions WHERE TransactionID='$_TransactionID'");
                    $row = mysqli_fetch_array($result);
                    $ProductName1 = $row['prdname1'];
                    $Quantity = $row['quantity'];
                    $_Quantity = intval($Quantity);

                    echo "<br>Make an offer using your available products for their: ".$_Quantity." ".$ProductName1."<br>";

                    ?>

                    <table border="1" class="table table-light table-striped table-hover">
                    <tr>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><form action="offer_create.php" method="post">
                                <label for="amount">Quantity></label>
                                <input style="height:30px; width:100px" id="amount" name="amount"></input>
                                <label for="message">Message to Send to Seller></label>
                                <input style="height:30px; width:100px" id="message" name="message"></input>
                                <!-- Hidden Input for ProductName -->
                                <input type="hidden" name="ProductID" value="<?= htmlspecialchars($row['ProductID']) ?>"></input>
                                <input type="hidden" name="ProductName" value="<?= htmlspecialchars($row['ProductName']) ?>"></input>
                                <input type="hidden" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>"></input>

                                <button style="height:30px; width:120px" class="btn btn-secondary"input type="submit" name="TransactionID" value="<?= htmlspecialchars($_TransactionID) ?>">Make Offer</button>
                            </form></td>
                    
                    </tr>
                    <?php endforeach ?>
                    </table>

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
