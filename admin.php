<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.html"); 
    exit();
}

function inserirProduto() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newProductName = isset($_POST['nome']) ? $_POST['nome'] : '';
        $newProductPrice = isset($_POST['preco']) ? (int)$_POST['preco'] : 0;

        // Meter uma imagem como default, para se nenhuma for introduzida
        $defaultImage = 'img/default-product-image.png';
        $newProductImage = $defaultImage;

        if (isset($_FILES['imagem']) && isset($_FILES['imagem']['name']) && $_FILES['imagem']['size'] > 0) {
            $uploadDirectory = 'uploads/';
            $newProductImage = $uploadDirectory . basename($_FILES['imagem']['name']);

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            move_uploaded_file($_FILES['imagem']['tmp_name'], $newProductImage);
        }

        if (!empty($newProductName) && $newProductPrice > 0) {
            $productsFilePath = 'products.php';
            
            //Verificar se o ficheiro products.php existe
            if (file_exists($productsFilePath)) {
                include $productsFilePath;
                $_SESSION['productList'] = $productList;
            } else {
                $_SESSION['productList'] = [];
            }

            $newProduct = [
                'name' => $newProductName,
                'price' => $newProductPrice,
                'image' => $newProductImage,
            ];

            $productList = $_SESSION['productList'];
            $productList[] = $newProduct;

            $_SESSION['productList'] = $productList;
            echo '<script>alert("Produto adicionado com sucesso!");</script>';
            header("refresh:0.7;url=catalogo.php");
            updateCatalogoFile($productList);
        }
    }

    
}


function updateCatalogoFile($productList) {
    if (empty($productList)){
        #Se não existirem produtos, vai eliminar o ficheiro products.php
        $productsFile = 'products.php';
        if (file_exists($productsFile)) {
            unlink($productsFile);
        }
        return;
    }

    $productsFile = 'products.php';

    $file = fopen($productsFile, 'w');

    if ($file) {
        $content = '<?php' . PHP_EOL;
        $content .= '$productList = ' . var_export($productList, true) . ';' . PHP_EOL;
        $content .= '?>' . PHP_EOL;
        fwrite($file, $content);
        fclose($file);
    }
}


function deleteAllProducts() {
    if (isset($_SESSION['productList']) || file_exists('products.php')) {
        // Eliminar os produtos todos
        $_SESSION['productList'] = [];

        echo '<script>alert("Produtos eliminados com sucesso!");</script>';
        header("refresh:0.7;url=catalogo.php");

        // Atualizar o ficheiro dos produtos
        updateCatalogoFile([]);
    }
}


// Verificar se o form delete all foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
    deleteAllProducts();
}


inserirProduto();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>
<body style="overflow:hidden;">
    <div class="painel_admin">
        <h1>Painel Admin</h1>
        <table>
            <tr>
                <th><h2>-> Introduzir novos produtos</h2></th>
            </tr>
            <tr>
                <th><form method="post" action="" class="eliminar_produto"><h2>-> Eliminar produtos</h2><input type="submit" name="delete_all" value="Clica"></form></th>
            </tr>
            <tr>
                <th><br><br><a href="index.html"><h2 style="float: left;">-> Sair</h2></a></th>
            </tr>
        </table>
    </div>

    <div class="novo_produto">
        <div class="dados_produto">
            <h1>Dados produto</h1>
            <form name="inserir_produto" class="inserir_produto" method="post" action="" enctype="multipart/form-data">
                <h3>Título: <input type="text" id="produto_nome" class="produto-nome" name="nome" required></h3>
                <h3>Preço: <input type="text" id="produto_preco" name="preco" required></h3>
                <h3>Imagem: </h3><input type="file" id="produto_imagem" name="imagem" accept="image/*"><br>
                <input type="reset" value="Limpar" class="btn">
                <input type="submit" value="Confirmar" class="btn">
            </form>
        </div>
    </div>

</body>

</html>
