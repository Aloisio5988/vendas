<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. ;D
 *-->
<?php
session_destroy();
session_start();
require 'funcoes/banco/conexao.php';
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
  <link rel="icon" type="imagem/png" href="img/logo.png" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Aloisio Carvalho">

  <title>Projeto - Sistema de vendas</title>
  
    
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/login_style.css" rel="stylesheet" type="text/css">  
  <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">


</head>
<body>
  <div class="logo"></div>
 
  <div class="login"> <!-- Login -->
  
    <h1><img src="img/logo.png" width=40 height=40> Logue na sua conta</h1>
  
    <div class="retorno"></div>
      <form class="form" method="post" action="" name="form_login">
          
  
      <p class="field">
        <input type="text" name="login" placeholder="Email(usuário)" required/>
        <i class="fa fa-user"></i>
      </p>

      <p class="field">
        <input type="password" name="senha" placeholder="Senha" required/>
        <i class="fa fa-lock"></i>
      </p>

        <p class="submit"><button type="submit" name="commit">Login</button></p>
       <p><center><img src="img/load.svg" class="load" alt="Carregando" style="display: none;" /></center></p>    
      <p class="remember">
        <input type="checkbox" id="remember" name="remember" />
        <label for="remember"><span></span>Lembrar login</label>
      </p>
          <div id="plataforma"></div>
    </form>
       <center><img src="img/load-login.svg" align="center" id="load" alt="carregando" style="display: none;" /></center>
  </div> <!--/ Login-->
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>