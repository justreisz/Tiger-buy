<?php
session_start();

function inserirProduto() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newProductName = $_POST['nome'];
        $newProductPrice = $_POST['preco'];
        $newProductImage = $_POST['imagem'];

        $productList = isset($_SESSION['productList']) ? $_SESSION['productList'] : [];

        $newProduct = [
            'name' => $newProductName,
            'price' => $newProductPrice,
            'image' => $newProductImage,
        ];

        $productList[] = $newProduct;

        $_SESSION['productList'] = $productList;

        updateCatalogoFile($productList);
        
    } 
}

function updateCatalogoFile($productList) {
    $catalogoFile = 'catalogo.php';

    $file = fopen($catalogoFile, 'a');

    if ($file) {
        $content = '<?php' . PHP_EOL;
        $content .= '$productList = ' . var_export($productList, true) . ';' . PHP_EOL;
        $content .= '?>' . PHP_EOL;
        fwrite($file, $content);
        fclose($file);
    }
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
                <th><br><br><a href="index.html"><h2 style="float: left;">-> Sair</h2></a></th>
            </tr>
        </table>
    </div>
    <div class="novo_produto">
        <div class="dados_produto">
            <h1>Dados produto</h1>
            <form name="inserir_produto" class="inserir_produto" method="post" action="">
                <h3>Título: <input type="text" id="produto_nome" class="produto-nome" name="nome" required></h3>
                <h3>Preço: <input type="text" id="produto_preco" name="preco" required></h3>
                <h3>Imagem: </h3><input type="file" id="produto_imagem" name="imagem"><br><br>
                <input type="reset" value="Limpar" class="btn">
                <input type="submit" value="Confirmar" class="btn">
            </form>
        </div>
    </div>
</body>
</html>
