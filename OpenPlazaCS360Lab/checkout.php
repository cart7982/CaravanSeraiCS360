<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel = "stylesheet">

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <?php
    session_start();
    ?>
        <ul class="nav">
            <li class = "nav-item">
                <a class = "nav-link" href = "profile.html">User Profile</a>
            </li>
        </ul>
        <h1>CHECKOUT</h1>

        <div class = "card">
            <div class = "card-body">
                This page serves as final confirmation for the purchased items.  
            </div>
        </div>

        <button type = submit class = "btn btn-primary">Confirm Trade?</button>
    </body>
</html>