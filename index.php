<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>CaravanSerai</title>
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
        //Acquire results for product listing table based on user/group:
        if(isset($_SESSION["UserID"]) && isset($_SESSION["GroupID"]))
        {
            $_UserID = $_SESSION["UserID"];
            $_Username = $_SESSION["Username"];
            $_GroupID = $_SESSION["GroupID"];
            $_GroupName = $_SESSION["GroupName"];

            echo "Username is: ".$_Username."<br>";
            echo "Group Name is: ".$_GroupName."<br>";

            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM products NATURAL JOIN users WHERE UserID NOT IN (SELECT UserID FROM $_GroupName)");
            $data = $result->fetch_all(MYSQLI_ASSOC);

        }
        else if(isset($_SESSION["UserID"]) && !isset($_SESSION["GroupID"]))
        {
            $_UserID = $_SESSION["UserID"];
            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID!='$_UserID' LIMIT 50");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        else
        {
            session_destroy();
            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM products LIMIT 50");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }

        ?>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" aria-current = "page" href="index.php">CaravanSerai</a>
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
                    <h1 class="display-4 fw-bolder">Home Page</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Welcome to CaravanSerai!</p>
                </div>
            </div>
        </header>

        <!-- Section-->
        <section class="py-5">
            <div class = "card bg-success">
                <div class = "card-header">
                    Welcome to CaravanSerai!
                </div>
                <div class = "card-body">
                    CaravanSerai is an anonymous trading site that allows you to 
                    exchange goods securely.
                </div>
                <div class = "card-body">
                    You can trade as an individual merchant or as part of a group, 
                    allowing access to collective resources. 
                </div>
            </div>

            <h1>WHAT'S ON THE MARKET</h1>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php
            //Acquire results for product cards based on logged in user/group:
            if(isset($_SESSION["UserID"]) && isset($_SESSION["GroupID"]))
            {
                $_UserID = $_SESSION["UserID"];
                $_Username = $_SESSION["Username"];
                
                $_GroupID = $_SESSION["GroupID"];
                $_GroupName = $_SESSION["GroupName"];

                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM products NATURAL JOIN users WHERE UserID NOT IN (SELECT UserID FROM $_GroupName)");

            }
            else if(isset($_SESSION["UserID"]) && !isset($_SESSION["GroupID"]))
            {
                $_UserID = $_SESSION["UserID"];
                $_Username = $_SESSION["Username"];

                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM products WHERE UserID!='$_UserID' LIMIT 50");
            }
            else
            {
                session_destroy();
                $conn = mysqli_connect("localhost","root","","caravanserai");
                $result = mysqli_query($conn,"SELECT * FROM products LIMIT 50");
            }

            while ($row = $result->fetch_assoc()) { ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product Image -->
                        <img class="card-img-top" src="<?php echo './Images/' .$row['ImagePath']; ?>" alt="Product Image" style="height:300px; object-fit: cover;" />

                        <!-- Product Details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?php echo htmlspecialchars($row['ProductName']); ?></h5>
                                <?php echo "Description: <br>".htmlspecialchars($row['Description']); ?><br>
                                <?php echo "Avaliable: <br>".htmlspecialchars($row['Amount']); ?><br>
                            </div>
                        </div>

                        <!--Product Actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                            <form action="barter_create.php" method="post">
                                <label for="Quantity">Quantity></label>
                                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                                <button style="height:30px; width:150px" class="btn btn-light" input type="submit" name="ProductID" value="<?= $row['ProductID'] ?>">Request Barter</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            </div>

            <table border="1" class="table table-success table-striped table-hover">
            <tr>
                <th>Product Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Picture</th>
                <th>How Much You Want</th>
            </tr>
            <?php foreach($data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['ProductName']) ?></td>
                <td><?= htmlspecialchars($row['Amount']) ?></td>
                <td><?= htmlspecialchars($row['Description']) ?></td>
                <td><img class="img-productthumb" src="./Images/<?php echo $row['ImagePath']; ?>"></td>
                <!-- <?php //$imagePath = !empty($row['ImagePath']) ? htmlspecialchars($row['ImagePath']) : 'images/placeholder.png'; ?>
            echo "
                <td><img src='$imagePath' alt='Product Image' style='width:100px;height:auto;'></td>"; -->

                <td><form action="barter_create.php" method="post">
                    <label for="Quantity">Quantity></label>
                    <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                    <button style="height:30px; width:150px" class="btn btn-dark" input type="submit" name="ProductID" value="<?= $row['ProductID'] ?>">Request Barter</button></form></td>
                </tr>
            <?php endforeach ?>
            </table>       
        
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; CaravanSerai 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
