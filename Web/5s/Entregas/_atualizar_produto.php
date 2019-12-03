<?php
include 'adicionar_produto.php';
include 'conexao.php';


$id = $_GET['id'];
//$nroproduto = $_POST['nroproduto'];
$quantidade = $_GET['qtu'];
$nomeproduto = $_GET['prod'];

$sql = "UPDATE tbestoque SET quantidade = quantidade + $quantidade WHERE Nome = '$nomeproduto'";

$inserir = mysqli_query($conexao,$sql);
$sql = "UPDATE entregas SET Entregue = 'Sim' WHERE id = $id ";

$inserir = mysqli_query($conexao,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
echo $nomeproduto; ?>
</body>
</html>