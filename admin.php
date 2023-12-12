<?php
function inserirProduto() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $newProductName = isset($_POST['nome']) ? $_POST['nome'] : '';
        $newProductPrice = isset($_POST['preco']) ? $_POST['preco'] : '';

        $newProductImage = '';
        if (isset($_FILES['imagem']) && isset($_FILES['imagem']['name'])) {
            $uploadDirectory = 'uploads/';
            $newProductImage = $uploadDirectory . basename($_FILES['imagem']['name']);

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            move_uploaded_file($_FILES['imagem']['tmp_name'], $newProductImage);
        }

        //se não existir a session produtos, ele vai buscar ao ficheiro os produtos
        if (!isset($_SESSION['productList'])) {
            include 'products.php'; 
            $_SESSION['productList'] = $productList;
        }


        $newProduct = [
            'name' => $newProductName,
            'price' => $newProductPrice,
            'image' => $newProductImage,
        ];
        
        $productList = $_SESSION['productList'];
        $productList[] = $newProduct;

        $_SESSION['productList'] = $productList;
        updateCatalogoFile($productList);
        
    } 
}

function updateCatalogoFile($productList) {
    if ($productList == []){
        return false;
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
    // Check if the session variable exists
    if (isset($_SESSION['productList'])) {
        // Clear the product list
        $_SESSION['productList'] = [];

        // Update the products file
        updateCatalogoFile([]);
    }
}

session_start();


// Check if the "delete all" form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
    // Call the function to delete all products
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
                <h3>Imagem: </h3><input type="file" id="produto_imagem" name="imagem" accept="image/*">
                <input type="reset" value="Limpar" class="btn">
                <input type="submit" value="Confirmar" class="btn">
            </form>
        </div>
    </div>

</body>

</html>
