<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>
<body>
    <div class="topnav">
        <div class="nav-container">
            <a href="index.html" target="_parent">Home</a>
            <a href="catalogo.php" target="_parent">Catálogo</a>
            <img src="img/tigerbuy.png" class="topnav-icon">
            <a href="index.html#sobre" target="_parent">Sobre</a>
            
            <?php
            session_start();
            if (!isset($_SESSION['user'])) {
                echo '<a href="login.php" target="_parent">Login</a>';
            } else {
                echo '<a href="logout.php" target="_parent">Logout</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>
