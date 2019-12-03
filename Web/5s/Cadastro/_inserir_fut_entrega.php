<?php
include 'cadastro.php';
include '../Entregas/conexao.php';


$empresa = $_POST['marca']; //RECEBE O VALOR DO ATRIBUTO
$prod = $_POST['produto'];
$quando = $_POST['data'];
$qtf = $_POST['quantidadeFardo'];
$qtu = $_POST['quantidadeUnidade'];
$cond = "Nao";

$sql = "INSERT INTO entregas (Fornecedor, Produto, quando, quantFardo, qauntUni, Entregue) 
VALUES('$empresa','$prod', '$quando', $qtf, $qtu, '$cond')";


$inserir = mysqli_query($conexao, $sql) or die("erro ".mysqli_error($conexao));
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="container" style="width: 500px; margin-top: 20px">
    <center>
        <h4> Marca adicionada com sucesso!</h4>
    </center>
    <div style="padding-top: 20px">
    </div>
</div>
<html lang="en">
<head>
<meta charset="utf-8">
<title>JavaScript Automatic Page Redirect</title>
<script>
    function pageRedirect() {
        window.location.replace("http://10.26.45.157/Cadastro/cadastro.php#");
    }      
    setTimeout("pageRedirect()", 3000);
</script>
</head>
<body>
</body>
</html>
