<!DOCTYPE html>
<html>
    <head>
        <title>Product Description</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">
        <link href = "styleII.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <ul class="nav">
            <li class = "nav-item">
                <a class = "nav-link" href = "profile.php">User Profile</a>
            </li>
        </ul>

        <h1>PRODUCT DESCRIPTION</h1>
        <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['ProductName']) ?></td>
            <td><?= htmlspecialchars($row['Amount']) ?></td>
            <td><?= htmlspecialchars($row['Description']) ?></td>
            <td><form action="add_cart.php" method="post">
                <label for="Quantity">Quantity></label>
                <input style="height:30px; width:100px" id="Quantity" name="Quantity"></input>
                <button style="height:30px; width:100px" input type="submit" name="ProductID" value="<?= $row['ProductID'] ?>">Add to Cart</button></form></td>
            </tr>
        <?php endforeach ?>
        </table>       
        

    



    </body>
</html>