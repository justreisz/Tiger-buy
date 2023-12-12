<?php

session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: erro.php"); 
    exit();
}

$descontoAtivo = isset($_COOKIE['desconto']);
function aplicarDesconto($preco) {
    return $preco * 0.9; 
}


include 'products.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        /* Add your styling for the modal */
        .discount-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    
    <div class="topnav">
        <div class="nav-container">
            <a href="index.html" target="_parent">Home</a>
            <a href="catalogo.php" target="_parent">Catálogo</a>
            <img src="img/tigerbuy.png" class="topnav-icon">
            <a href="index.html#sobre" target="_parent">Sobre</a>
            <?php
            if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
                echo '<a href="login.php" target="_parent">Login</a>';
            } else {
                echo '<a href="logout.php" target="_parent">Logout</a>';
            }
            ?>
            <div style="height: 50px;">
                <h1 class="quantity"></h1>
                <img src="img/cart.png" id="cart-icon">
            </div>
            <div class="cart-menu">
                <h2 class="cart-title">O seu carrinho</h2>
                <div class="cart-content">
                    
                </div>

                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">$0</div>
                </div>

                <button type="button" class="btn-buy">Comprar</button>

                <i class='bx bx-x' id="close-cart"></i>
            </div>
        </div>
    </div>

    <section class="loja" id="loja">
        <h1>Sweats</h1>
        <div class="container-sweats" id="container-sweats">
            <div class="box">
                <img class="product-img" src="img/Sweats/verde.jpg ">
                <h4 class="product-title">Sweat Verde</h4>
                <h5 class="product-price">19.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>

            <div class="box">
                <img class="product-img" src="img/Sweats/azul.jpg">
                <h4 class="product-title">Sweat Azul</h4>
                <h5 class="product-price">21.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>

            <div class="box">
                <img class="product-img" src="img/Sweats/branco.jpg">
                <h4 class="product-title">Sweat Branca</h4>
                <h5 class="product-price">19.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>

            <div class="box">
                <img class="product-img" src="img/Sweats/castanho.jpg">
                <h4 class="product-title">Sweat Castanha</h4>
                <h5 class="product-price">23.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>            
            </div>

        </div>

        <h1 style="margin-top: 120px;">Calças</h1>
        <div class="container-calcas" id="container-calcas">
        
            <div class="box">
                <img class="product-img" src="img/calcas/ganga.jpg">
                <h4 class="product-title">Calças azuis baggy</h4>
                <h5 class="product-price">29.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
            <div class="box">
                <img class="product-img" src="img/calcas/branca.jpg">
                <h4 class="product-title">Calças branca baggy</h4>
                <h5 class="product-price">31.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
            <div class="box">
                <img class="product-img" src="img/calcas/preto.jpg">
                <h4 class="product-title">Calças pretas baggy</h4>
                <h5 class="product-price">27.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
            <div class="box">
                <img class="product-img" src="img/calcas/castanha.png">
                <h4 class="product-title">Calças castanha baggy</h4>
                <h5 class="product-price">29.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
        </div>

        <h1 style="margin-top: 80px;">Novos produtos</h1>
        <?php
            if ($descontoAtivo){
                echo "Desconto ativo";
            }
        ?>
        <div class="overlay" id="overlay"></div>
        <div class="discount-popup" id="discount-popup">
            <p>Special Discount Available!</p>
            <button onclick="hideDiscountPopup()">Close</button>
        </div>

        <script>
                    // JavaScript functions to show/hide the discount popup
            function showDiscountPopup() {
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('discount-popup').style.display = 'block';
            }

            function hideDiscountPopup() {
                document.getElementById('overlay').style.display = 'none';
                document.getElementById('discount-popup').style.display = 'none';
            }

            // Use window.onload to ensure the DOM is fully loaded before executing the code
            window.onload = function() {
                <?php
                if ($descontoAtivo) {
                    // Display a button to trigger the discount popup
                    echo 'showDiscountPopup();';
                }
                ?>
            };
        </script>
        <div class="newItems-content">
          <?php
              if (isset($productList) && is_array($productList)) {
                  foreach ($productList as $product) {
                      echo '<div class="box">';
                      echo '<img class="product-img" src="' . $product['image'] . '">';
                      echo '<h4 class="product-title">' . $product['name'] . '</h4>';
                      if ($descontoAtivo){
                        $precoComDesconto = aplicarDesconto($product['price']);
                        echo '<h5 class="product-price">$' . number_format($precoComDesconto, 2) . '</h5>';
                      }else {
                        echo '<h5 class="product-price">$' . $product['price'] . '</h5>';
                      }
                      echo '<i class=\'bx bx-shopping-bag add-cart\'></i>';
                      echo '</div>';
                  }
              } else {
                  echo '<p>Sem produtos disponiveis.</p>';
              }
          ?>
        </div>
</body>