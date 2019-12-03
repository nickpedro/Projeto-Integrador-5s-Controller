<?php

include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM estoque WHERE id_produto=$id";
$deletar = mysqli_query($conexao, $sql);

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="container" style="width: 500px; margin-top: 20px">
    <center>
        <h4> Produto deletado com sucesso!</h4>
    </center>
    <div style="padding-top: 20px">
        <center>
            <a href="listar_produtos.php" role="button" class="btn btn-sm btn-danger">Voltar</a>
        </center>
    </div>
</div>