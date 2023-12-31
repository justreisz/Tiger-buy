<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy(); 
    setcookie('desconto', '', time() - 3600, '/');
    header("Location: login.php");
    exit();
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>
<body style="overflow: hidden;">
    <iframe src="menu.php" width="100%" height="100%" frameborder="0"></iframe>
    
    <div class="login-container">
        <div class="divLogin">
            <form name="logoutForm" class="formLogin" method="post" action="">
                <br><br>
                <h1>LOGOUT</h1>
                <?php
                   if(isset($_SESSION['user'])){
                        $user = $_SESSION['user'];
                   } elseif (isset($_SESSION['admin'])){
                        $user = 'admin';
                   }
                ?>
                <p>Tu estás logado como : <?php echo $user ?></p>
                <input type="submit" name="logout" value="Logout" class="btn">
            </form>
        </div>
    </div>
</body>
</html>
