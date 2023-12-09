<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: erro.php"); 
    exit();
} 

$productList = isset($_SESSION['productList']) ? $_SESSION['productList'] : [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    
    <div class="topnav">
        <div class="nav-container">
            <a href="index.html" target="_parent">Home</a>
            <a href="catalogo.php" target="_parent">Catálogo</a>
            <img src="img/tigerbuy.png" class="topnav-icon">
            <a href="index.html#sobre" target="_parent">Sobre</a>
            <?php
            if (!isset($_SESSION['user'])) {
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
        <h1>Halteres</h1>
        <div class="container-halteres" id="container-halteres">
            <div class="box">
                <img class="product-img" src="img/Halteres/2.5kg.jpg">
                <h4 class="product-title">Haltere 2.5kg</h4>
                <h5 class="product-price">19.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>

            <div class="box">
                <img class="product-img" src="img/Halteres/5kg.jpg">
                <h4 class="product-title">Haltere 5kg</h4>
                <h5 class="product-price">34.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>

            <div class="box">
                <img class="product-img" src="img/Halteres/8kg.jpg">
                <h4 class="product-title">Haltere 8kg</h4>
                <h5 class="product-price">29.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>

            <div class="box">
                <img class="product-img" src="img/Halteres/15kg.jpg">
                <h4 class="product-title">Haltere 15kg</h4>
                <h5 class="product-price">115.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>            
            </div>

        </div>

        <h1 style="margin-top: 80px;">Discos</h1>
        <div class="container-discos" id="container-discos">
        
            <div class="box">
                <img class="product-img" src="img/Discos/5kg.jpg">
                <h4 class="product-title">Disco 5kg</h4>
                <h5 class="product-price">29.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
            <div class="box">
                <img class="product-img" src="img/Discos/10kg.jpg">
                <h4 class="product-title">Disco 10kg</h4>
                <h5 class="product-price">59.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
            <div class="box">
                <img class="product-img" src="img/Discos/15kg.jpg">
                <h4 class="product-title">Disco 15kg</h4>
                <h5 class="product-price">69.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
            <div class="box">
                <img class="product-img" src="img/Discos/20kg.png">
                <h4 class="product-title">Disco 20kg</h4>
                <h5 class="product-price">99.99$</h5>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        
        </div>

        <h1 style="margin-top: 80px;">Novos produtos</h1>
        <div class="newItems-content">
        <?php
            foreach ($productList as $product) {
                echo '<div class="box">';
                echo '<img class="product-img" src="' . $product['image'] . '">';
                echo '<h4 class="product-title">' . $product['name'] . '</h4>';
                echo '<h5 class="product-price">' . $product['price'] . '</h5>';
                echo '<i class=\'bx bx-shopping-bag add-cart\'></i>';
                echo '</div>';
            }
        ?>
        </div>
</body>

<?php
$productList = array (
  0 => 
  array (
    'name' => 'Casaco',
    'price' => '25',
    'image' => 'sweatHome.webp',
  ),
);
?>
<?php
$productList = array (
  0 => 
  array (
    'name' => 'casaco',
    'price' => '25',
    'image' => 'sweatHome.webp',
  ),
);
?>
<?php
$productList = array (
  0 => 
  array (
    'name' => 'casaco',
    'price' => '25',
    'image' => 'sweatHome.webp',
  ),
  1 => 
  array (
    'name' => 'Ya',
    'price' => '20',
    'image' => 'sweatHome.webp',
  ),
);
?>
<?php
$productList = array (
  0 => 
  array (
    'name' => 'casaco',
    'price' => '25',
    'image' => 'sweatHome.webp',
  ),
  1 => 
  array (
    'name' => 'Ya',
    'price' => '20',
    'image' => 'sweatHome.webp',
  ),
  2 => 
  array (
    'name' => 'Ya',
    'price' => '20',
    'image' => 'sweatHome.webp',
  ),
);
?>
<?php
$productList = array (
  0 => 
  array (
    'name' => 'casaco',
    'price' => '25',
    'image' => 'sweatHome.webp',
  ),
  1 => 
  array (
    'name' => 'Ya',
    'price' => '20',
    'image' => 'sweatHome.webp',
  ),
  2 => 
  array (
    'name' => 'Ya',
    'price' => '20',
    'image' => 'sweatHome.webp',
  ),
  3 => 
  array (
    'name' => 'Ya',
    'price' => '20',
    'image' => 'sweatHome.webp',
  ),
);
?>
