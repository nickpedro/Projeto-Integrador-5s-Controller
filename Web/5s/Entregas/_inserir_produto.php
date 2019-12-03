<?php
include 'adicionar_produto.php';
include 'conexao.php';


$marca = $_POST['marca']; //RECEBE O VALOR DO ATRIBUTO
$quantidadeFardo = $_POST['quantidadeFardo'];
$Produto = $_POST['Produto'];
$horario = 'NOW()';
$idEnt = $_POST['Entrega'];

$idUnidade = $_POST['quantidadeUnidade'];

$sql = "INSERT INTO tbadega (marca, quantidadeFrd, nome, horario, entregues) 
VALUES('$marca', '$quantidadeFardo', '$Produto', $horario, '$idEnt')";


$inserir = mysqli_query($conexao, $sql);





$sql = "UPDATE tbestoque SET quantidade = quantidade + '$idUnidade' WHERE Nome = '$Produto'";
$inserir = mysqli_query($conexao, $sql);
?>




