<?php
session_start(); 
$error_message = "";

function verificarPassword() {
    global $error_message;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pass1 = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        $utilizador = $_POST['user'];
        $mail = $_POST['mail'];

        if (empty($utilizador) || empty($pass1) || empty($mail) || empty($pass2)) {
            $error_message = "*Preencha todos os campos";
            return false;
        } elseif (!strpos($mail, "@gmail.com")) {
            $error_message = "*Insira um email válido";
            return false;
        } elseif (strlen($pass1) < 6) {
            $error_message = "*A password tem de ter pelo menos 6 caracteres";
            return false;
        } elseif ($pass1 !== $pass2) {
            $error_message = "*Introduza corretamente as passwords";
            return false;
        }

        if ($utilizador == "admin" && $mail == "admin@gmail.com" && $pass1 == "admin123" && $pass2 == "admin123") {
            $_SESSION['admin'] = true;
            header("Location: admin.php");
            exit();
        } else {
            $_SESSION['user'] = $utilizador;
            setcookie('desconto', '10', time() + 250);
            header("Location: catalogo.php");
            exit();
        }
    }

    return false;
}

verificarPassword();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>

</head>
<body style="overflow: hidden;">
    <iframe src="menu.php" width="100%" height="100%" frameborder="0"></iframe>
    
    <div class="login-container">
        <div class="divLogin">
            <form name="login" class="formLogin" method="post" action="">
                <h1>LOGIN</h1>
                <table class="formLogin-table">
                    <tr>
                        <th><h3>Utilizador </h3></th>
                        <th><input type="text" name="user" autocomplete="off" required></th>
                    </tr>
                    <tr>
                        <th><h3>Email </h3></th>
                        <th><input type="email" name="mail" autocomplete="off" required></th>
                    </tr>
                    <tr>
                        <th><h3>Password </h3></th>
                        <th><input type="password" name="pass" autocomplete="off" required></th>
                    </tr>
                    <tr>
                        <th><h3>Reintroduzir password </th>
                        <th><input type="password" name="pass2" autocomplete="off" required></h3></th>
                    </tr>
                </table>
                <h4 id="erro" class="erro"><?php echo $error_message; ?></h4>
                <input type="reset" value="Limpar" class="btn">
                <input type="submit" value="Confirmar" class="btn">
                
            </form> 
        </div> 
    </div>
</body>
</html>
