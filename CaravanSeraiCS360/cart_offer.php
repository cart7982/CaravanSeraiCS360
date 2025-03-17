<!DOCTYPE html>
<html>
    <style>
    .topnav {
    overflow: hidden;
    background-color: #333;
    }

    .topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    }

    .topnav a:hover {
    background-color: #ddd;
    color: black;
    }

    .topnav a.active {
    background-color: #04AA6D;
    color: white;
    }
</style>
    <head>
        <title>Cart</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "styleII.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <?php
    session_start();
    ?>
        
        <div class="topnav">
            <a href="index.php">Home</a>
            <a href="login.html">Login</a>
            <a href="logout.php">Logout</a>
            <a href="profile.php">Profile</a>
            <a href="index.php">Product Listings</a>
        </div>
        

        <h1>Your Products Available To Offer:</h1>

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

                $_TransactionID = $_POST['TransactionID'];
                ?>

                <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ProductName']) ?></td>
                    <td><?= htmlspecialchars($row['Amount']) ?></td>
                
                    <td>

                    <div class = "card-footer">
            <button type = "button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal1">
                Make an Offer
            </button>
        
            <div class = "modal" id = "myModal1">
                <div class = "modal-dialog">
                    <div class = "modal-content">
        
                        <div class = "modal-header">
                            <button type = "button" class = "btn-close" data-bs-dismiss = "modal"></button>
                        </div>
        
                        <div class = "modal-body">
                            <form action="make_offer.php" method="post">
                                Time to make your offer!
                                <div class = "mb-3 mt-3">
                                    <label for = "message" class = "form-label">Message to send seller: </label>
                                    <input type = "text" class = "form-control" id = "message" placeholder = "Write message here" name = "message">
                                </div>
                                <div class = "mb-3 mt-3">
                                    <label for = "message" class = "form-label">Offered amount: </label>
                                    <input type = "text" class = "form-control" id = "amount" placeholder = "amount" name = "amount">
                                </div>
                                <button type = "submit" class = "btn btn-primary" name="TransactionID" value="<?= htmlspecialchars($_TransactionID) ?>"></button> Submit</button>
                            </form>
                        </div>
        
                        <div class = "modal-footer">
                            <button type = "button" class = "btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                    </td>

                
                </tr>
                <?php endforeach ?>
                </table>

            </div>
        </div>

       
        


    </body>
</html>