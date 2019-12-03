<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

$idEnt
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Cadastrar Produto Entregue</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/style.css">


    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script src="../JS/js.js"></script>
</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="../welcome.php">Home</a>
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
                  <a href="../Cadastro/cadastro.php">Registar Futura Entrega
                  </a>
                </li>
                <li>
                  <a href="../Entregas/listar_produtos.php">Listar Produtos Entregues
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
                  <a href="../Produtos/listar_produtos.php">Estoque

                  </a>
                </li>

                <li>
                  <a href="../Entregas/adicionar_produto.php">Cadastrar Produto

                  </a>
                </li>
      
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>Fornecedores</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="../AdicionarMarca.php">Fornecedores

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
      <a href="../reset-password.php">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="../logout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
    

    </div>


    <h3>Futuras Entregas</h3>
<br>
<div class="table-responsive">
<?php
            include("conexao.php");

            $rowperpage = 4;
            $row = 0;

            // Previous Button
            if(isset($_POST['but_prev'])){
                $row = $_POST['row'];
                $row -= $rowperpage;
                if( $row < 0 ){
                    $row = 0;
                }
            }

            // Next Button
            if(isset($_POST['but_next'])){
                $row = $_POST['row'];
                $allcount = $_POST['allcount'];

                $val = $row + $rowperpage;
                if( $val < $allcount ){
                    $row = $val;
                }
            }
            ?>
<table class="table" id="emp_table" border="0">
            <tr class="tr_header">
            <th scope="col">Nro Da entrega</th>
            <th scope="col">Empresa</th>
            <th scope="col">Produto</th>
            <th scope="col">Quando</th>
            <th scope="col">Fardos Esperados</th>
            <th scope="col">Quantidade Esperada</th>
            <th scope="col">Entregue ?</th>
            </tr>
            <?php
            // count total number of rows
            $sql = "SELECT COUNT(*) AS cntrows FROM entregas ";
            $result = mysqli_query($conexao,$sql);
            $fetchresult = mysqli_fetch_array($result);
            $allcount = $fetchresult['cntrows'];

            // selecting rows
            $sql = "SELECT * FROM entregas   ORDER BY ID ASC limit $row,".$rowperpage;
            $result = mysqli_query($conexao,$sql);
            $sno = $row + 1;
            while($fetch = mysqli_fetch_array($result)){
                $id_produto = $fetch['id'];
                $marca = $fetch['Fornecedor'];
                $prod = $fetch['Produto'];
                $quantidade = $fetch['quando'];
                $qtFrd = $fetch['quantFardo'];
                $qtUND = $fetch['qauntUni'];
                $Entregue = $fetch['Entregue'];
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
            <td>
            <a class="btn btn-warning btn-sm" style="color: #000" href="_atualizar_produto.php?id=<?php echo $id_produto ?>&qtu=<?php echo $qtUND?>&prod=<?php echo $prod?>" role="button"><i class="fas fa-edit"></i>&nbsp;Atualizar</a>
            </td>

            <td>

            </td>
                </tr>
            <?php
                $sno ++;
            }
            ?>
        </table>
        <form method="post" action="">
            <div id="div_pagination">
                <input type="hidden" name="row" value="<?php echo $row; ?>">
                <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                <input type="submit" class="btn btn-primary" name="but_prev" value="Previous">
                <input type="submit" class="btn btn-primary" name="but_next" value="Next">
            </div>
        </form>
</div>
            </div>


            
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>



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
   


    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>