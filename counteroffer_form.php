<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>CounterOffer</title>
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
                    <h1 class="display-4 fw-bolder">Counteroffer</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Negotiate the deal that YOU need</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
            <div class = "card bg-secondary">
            <div class = "card-header">
                Do you consider the current bargain not fair?  <br>
                Make your counteroffer and include a message to the other seller.
            </div>
 
            <div class = "card-body">
                    <?php

                    if(isset($_SESSION["GroupID"]))
                    {
                        $_GroupID = $_SESSION["GroupID"];
                        $_GroupName = $_SESSION["GroupName"];

                        //$GroupID = intval($_GroupID);
                        echo"Signed into group: ".$_SESSION['GroupName'];
                        //echo"\nSigned into group: ".$_SESSION['GroupID'];

                        $conn = mysqli_connect("localhost","root","","caravanserai");
                        $result = mysqli_query($conn,"SELECT * FROM products NATURAL JOIN users WHERE UserID IN (SELECT UserID FROM $_GroupName)");
                        $data = $result->fetch_all(MYSQLI_ASSOC);

                    }
                    else
                    {
                        $_UserID = $_SESSION["UserID"];
                        $conn = mysqli_connect("localhost","root","","caravanserai");
                        $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID='$_UserID' LIMIT 50");
                        $data = $result->fetch_all(MYSQLI_ASSOC);

                    }

                    //$_TransactionID = $_POST['TransactionID'];
                    $_Message = $_POST['message'];
                    $_Amount2 = $_POST['amount2']; //Their amount
                    $_ProductName2 = $_POST['ProductName2']; //Their productname
                    $_MessageID = $_POST['MessageID'];

                    echo "_ProductName2 is: ".$_ProductName2;
                    echo "_Message is: ".$_Message;
                    echo "_Amount2 is: ".$_Amount2;
                    echo "_MessageID is: ".$_MessageID;
                    ?>

                    <table class="table table-primary table-striped table-hover" border="1">
                    <tr>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ProductName']) ?></td>
                        <td><?= htmlspecialchars($row['Amount']) ?></td>
                        <td><form action="counteroffer.php" method="post">
                                <label for="amount1">How Much You're Offering></label>
                                <input style="height:30px; width:100px" id="amount1" name="amount1"></input>
                                <label for="message">Message to Send to Seller></label>
                                <input style="height:30px; width:100px" id="message" name="message"></input>
                                <label for="message">How Much You Want></label>
                                <input style="height:30px; width:100px" id="amount2" name="amount2"></input>
                                <!-- Hidden Input for ProductName -->
                                <input type="hidden" name="ProductID1" value="<?= htmlspecialchars($row['ProductID']) ?>"></input>
                                <input type="hidden" name="ProductName1" value="<?= htmlspecialchars($row['ProductName']) ?>"></input>
                                <input type="hidden" name="UserID" value="<?= htmlspecialchars($row['UserID']) ?>"></input>
                                <input type="hidden" name="ProductName2" value="<?= $_ProductName2 ?>"></input>

                                <button style="height:30px; width:100px" class="btn btn-secondary" input type="submit" name="MessageID" value="<?= htmlspecialchars($_MessageID) ?>">Make Offer</button>
                            </form></td>



                    
                    </tr>
                    <?php endforeach ?>
                    </table>

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
