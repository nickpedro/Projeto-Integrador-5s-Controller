<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$tipo = $_SESSION["cargo"];
?>
 
 <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Sidebar template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
 
<script src="JS/js.js"></script>
</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="welcome.php">Home</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
        </div>
        <div class="user-info">
          <span class="user-name"><?php echo htmlspecialchars($_SESSION["username"]); ?>
          </span>
          <span class="user-role"><?php echo htmlspecialchars($_SESSION["cargo"]); ?></span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      <!-- sidebar-header  -->
     
      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-address-book" aria-hidden="true" ></i>
              <span>Entregas</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="Cadastro/cadastro.php">Registar Futura Entrega
                  </a>
                </li>
                <li>
                  <a href="Entregas/listar_produtos.php">Listar Produtos Entregues
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>Produtos</span>
              <span class="badge badge-pill badge-danger">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="Produtos/listar_produtos.php">Estoque
                  </a>
                </li>
                <li>
                  <a href="Entregas/adicionar_produto.php">Cadastrar Produto
                  </a>
                </li>                
              </ul>
            </div>
          </li>
          
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>Marcas</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="AdicionarMarca.php">Marcas

                  </a>
                </li>


                
      
              </ul>
            </div>
          </li>
          
          
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="reset-password.php">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="logout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
  <div id="conteudo"></div>

<h3>Lista Das Futuras Entregas</h3>
<br>
<table class="table">
    <thead>
        <tr>
        <th scope="col">Nro Da entrega</th>
            <th scope="col">Empresa</th>
            <th scope="col">Produto</th>
            <th scope="col">Quando</th>
            <th scope="col">Fardos Esperados</th>
            <th scope="col">Quantidade Esperada</th>
            <th scope="col">Entregue ?</th>

        </tr>
    </thead>

    <?php
    include 'conexao.php';

    $sql = "SELECT * FROM entregas order by id desc limit 20";
    $busca = mysqli_query($conexao, $sql);

    while ($array = mysqli_fetch_array($busca)) {
          $id_produto = $array['id'];
                $marca = $array['Fornecedor'];
                $prod = $array['Produto'];
                $quantidade = $array['quando'];
                $qtFrd = $array['quantFardo'];
                $qtUND = $array['qauntUni'];
                $Entregue = $array['Entregue'];
        ?>
        <tr>
        <<td><?php echo $id_produto ?></td>
            <td><?php echo $marca ?></td>
            <td><?php echo $prod ?></td>
            <td><?php echo $quantidade ?></td>
            <td><?php echo $qtFrd ?></td>
            <td><?php echo $qtUND ?></td>
            <td><?php if($Entregue == "Sim")
            {$corS = "color:green";}
            else{$corS = "color:Red";} 
            echo"<span style=$corS>".$Entregue."</span>" ?></td>

        </tr>

    <?php } ?>

</table>

    



    

  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    
</body>

</html>