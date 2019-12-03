<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por Favor digite um nome de usuario.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM usuario WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este nome ja está em uso.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo deu errado. Por favor tente mais tarde.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira uma senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Senha precisa ter no minimo 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por Favor comfirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Senha diferente.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $email = trim($_POST["email"]);
        $cargo = trim($_POST["cargo"]);
        
        // Prepare an insert statement
        $sql = "INSERT INTO usuario (username, password, email, cargo) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
          
           
            
            // Set parameters
            $param_username = $username;
            $param_password =$password; // Creates a password hash

            $param_email = $email;
            $param_cargo = $cargo;

              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "ssss",$param_username, $param_password, $param_email, $param_cargo);

            echo $param_email, $param_password, $param_email;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/styleForm.css">
    <title>Document</title>
</head>
<body class="align">
<h2>Cadastro</h2>
        <p>Preencha este formulário para se cadastrar.</p>
        <span class="help-block"><?php echo $username_err; ?></span>
        <span class="help-block"><?php echo $password_err; ?></span>
        <span class="help-block"><?php echo $confirm_password_err; ?></span>
        <div class="grid">
      
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form login">
      
            <div class="form__field <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <label for="username"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Username</span></label>
              <input id="username" type="text" name="username" class="form__input" placeholder="Username" required value="<?php echo $username; ?>">
              
            </div>
      
            <div class="form__field <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <label for="password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
              <input id="password" type="password" name="password" class="form__input" placeholder="Password" required>

            </div>

            <div class="form__field <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
              <label for="confirm_password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
              <input id="confirm_password" type="password" name="confirm_password" class="form__input" placeholder="Password" required>
              
            </div>
            <div class="form__field ? 'has-error' : ''; ?>">
              <label for="confirm_Email"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Email</span></label>
              <input id="email" type="text" name="email" class="form__input" placeholder="Email" required>
              
            </div>
            <div class="form__field <? ? 'has-error' : ''; ?>">
              <label for="cargo"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Cargo</span></label>
              <input id="cargo" type="text" name="cargo" class="form__input" placeholder="Cargo" required>
              
            </div>
      
            <div class="form__field">
              <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
            <p>Já possui uma conta ? <a href="login.php">Entre aqui</a>.</p>
      
          </form>
      
          
      
        </div>
      
        <svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"/></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"/></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></symbol></svg>
      
      </body>
</html>