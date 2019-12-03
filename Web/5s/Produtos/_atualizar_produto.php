<?php
include 'conexao.php';

$id = $_POST['id'];
//$nroproduto = $_POST['nroproduto'];
$nomeproduto = $_POST['prod'];
$quantidade = $_POST['qtu'];


$sql = "UPDATE tbestoque SET quantidade = quantidade + '$quantidade' WHERE Nome = '$nomeproduto'";
$inserir = mysqli_query($conexao, $sql);


$sql = "UPDATE entregas SET Entregue = 'Sim' WHERE id = $id ";

$atualizar = mysqli_query($conexao,$sql);

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="container" style="width: 500px; margin-top: 20px">
    <center>
        <h4> Produto atualizado com sucesso!</h4>
    </center>
    <div style="padding-top: 20px">
        <center>
            <a href="listar_produtos.php" role="button" class="btn btn-sm btn-danger">Voltar</a>
            <a href="index.php" role="button" class="btn btn-sm btn-success">Cadastrar novo item</a>
        </center>
    </div>
</div>