<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style type="text/css">

        #tamanhoContainer{
            width: 500px;

        }
        #botao{
            background-color: #FF1168;
            color: #FFFFFF;
            font-weight: bold;
            
        }
        
    </style>
</head>
<body>
    <div class="container" id="tamanhoContainer" style="margin-top: 40px">
        <div style="text-align: right">
            <a href="index.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
        </div>
        <h4 style="text-align: center;">Formulário de Cadastro</h4>
        <form action="_inserir_produto.php" method="post" style="margin-top: 20px;">
            <div class="form-group">
                <label>Número do Produto</label>
                <input type="number" class="form-control" name="nroproduto" placeholder="Insira o número do Produto" required>
            </div>
            <div class="form-group">
                <label>Nome do Produto</label>
                <input type="text" class="form-control" name="nomeproduto" placeholder="Insira o nome do Produto" required autocomplete = "off">
            </div>

            <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" name="categoria">

                    <?php
                    include 'conexao.php';
                    $sql = "SELECT * FROM categoria order by nome_categoria ASC";
                    $buscar = mysqli_query($conexao, $sql);

                    while($array = mysqli_fetch_array($buscar)){
                        //listando
                        $id_categoria = $array['id_categoria'];
                        $nome_categoria = $array['nome_categoria'];
                    ?>
                        <option><?php echo $nome_categoria ?></option>
                    
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Quantidade</label>
                <input type="number" class="form-control" name="quantidade" placeholder="Insira a quantidade de Produto" autocomplete = "off">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Fornecedor</label>
                <select class="form-control" name="fornecedor">
                    <option>Fornecedor A </option>
                    <option>Fornecedor B</option>
                    <option>Fornecedor C </option>
                    <option>Fornecedor D</option>
                </select>
            </div>
            <div style="text-align: right;"> 
               
                <button type="submit" id="botao" class="btn btn-sm">Cadastrar</button>       
            </div>
        </form>

    </div>


    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>