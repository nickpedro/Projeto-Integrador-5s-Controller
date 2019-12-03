<?php
include 'conexao.php';

$prod = $_POST['Produto'];

$quant = 0;

$preco = $_POST['Preco'];


$sql = "INSERT INTO tbestoque (nome, quantidade, valor ) values('$prod', '$quant', '$preco')";
$inserir = mysqli_query($conexao, $sql);

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="container" style="margin-top: 40px;">
<center>
    <h4>Produto adicionado com sucesso!</h4>
</center>
    <div style="text-align: right">
        <a href="index.php" role="button" class="btn btn-sm btn-danger">Voltar</a>
    </div>
</div>

<html lang="en">
<head>
<meta charset="utf-8">
<title>JavaScript Automatic Page Redirect</title>
<script>
    function pageRedirect() {
        window.location.replace("http://10.26.45.157/Produtos/listar_produtos.php#");
    }      
    setTimeout("pageRedirect()", 3000);
</script>
</head>
<body>
</body>
</html>