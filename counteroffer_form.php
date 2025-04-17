<!DOCTYPE html>
<html>
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
    
    <div class = "topnav">
        <a href="index.php">
        <img class="img-logo" src = "logo_1.jpg">
        </a>
    </div>

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
        <a href = "group_signup.html">Sign Up For A Group</a>
        <a href = "group_login.php">Enter Group</a>
        <a href = "group_logout.php">Group Logout</a>
    </div>
</div>
        

        <h1>Make a Counteroffer:</h1>
        
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

                            <button style="height:30px; width:100px" input type="submit" name="MessageID" value="<?= htmlspecialchars($_MessageID) ?>">Make Offer</button>
                        </form></td>



                
                </tr>
                <?php endforeach ?>
                </table>

            </div>
        </div>
        </div>

       
        


    </body>
</html>