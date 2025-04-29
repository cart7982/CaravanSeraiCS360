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
                    <h1 class="display-4 fw-bolder">Admin Group Edit</h1>
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
                This is the page for an admin to change information about a group.<br>
                All information must be updated, or it will be deleted.<br> 
                Copy-paste the information that already exists if it's not being updated! <br>
            </div>
        </div>

        <?php
            if(isset($_POST["GroupID"]))
            {
                $_GroupID = $_POST["GroupID"];
            }
            $_UserID = $_SESSION["UserID"];
            $conn = mysqli_connect("localhost","root","","caravanserai");
            $result = mysqli_query($conn,"SELECT * FROM groups WHERE GroupID='$_GroupID'");
            //$data = $result->fetch_all(MYSQLI_ASSOC);
            $row = $result->fetch_assoc();

        ?>
        <!--This form starts the user session.  This allows for the usage of
            global variables as described in session.php.-->
        <form action="group_edit.php" method="post">
            <div class = "mb-3 mt-3">
                <?php echo "Current GroupID is: ".$row['GroupID']."<br>"; ?>
                <label for = "NewGroupID" class = "form-label">New GroupID: </label>
                <input type = "text" class = "form-control" id = "NewGroupID" placeholder = "Enter NewGroupID" name = "NewGroupID">
            </div>
            <div class = "mb-3">
                <?php echo "Current Documentation is: ".$row['Documents']."<br>"; ?>
                <label for = "Documents" class = "form-label"> New Documents: </label>
                <input type = "text" class = "form-control" id = "Documents" placeholder = "Enter Documents" name = "Documents">
            </div>
            <div class = "mb-3">
                <?php echo "Current Group Name is: ".$row['GroupName']."<br>"; ?>
                <label for = "GroupName" class = "form-label"> New GroupName: </label>
                <input type = "text" class = "form-control" id = "GroupName" placeholder = "Enter GroupName" name = "GroupName">
            </div>
            <div class = "mb-3">
                <?php echo "Current Password (hashed) is: ".$row['Password']."<br>"; ?>
                <label for = "NewPassword" class = "form-label"> New Password: </label>
                <input type = "text" class = "form-control" id = "NewPassword" placeholder = "Enter NewPassword" name = "NewPassword">
            </div>
            <div class = "mb-3">
                <?php echo "Current Email is: ".$row['Email']."<br>"; ?>
                <label for = "Email" class = "form-label"> New Email: </label>
                <input type = "email" class = "form-control" id = "Email" placeholder = "Enter Email" name = "Email">
            </div>

            <button type = "submit" class = "btn btn-secondary" name="GroupID" value="<?= $_GroupID ?>"> Submit</button>
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
