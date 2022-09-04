<?php
$usuario = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/logo.png" type="image/ico" />

  <title>Projeto de vendas</title>

  <!-- Bootstrap -->
  <link href="model/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="model/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="model/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="model/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="model/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="model/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="model/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="model/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="principal.php" class="site_title">
              <img src="img/logo.png" width=25 height=25>
              </i> <span>Projeto <sup>Bistrô do Lula</sup> </span></a>
          </div>

          <div class="clearfix"></div>
      
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Sistema de vendas</h3>
              <br></br>
              <h3>Painel Administrativo</h3>
              <ul class="nav side-menu">
                <li><a><i class="fa fa-laptop"></i> Operacional <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="controle.php">Controle</a></li>
                    <li><a href="consultar_preco.php">Consultar preço</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Cadastro <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="produto.php">Produtos</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-cart-arrow-down"></i> Relátorios<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="gerar_planilha.php">Download</a></li>
                  </ul>
                </li>
              </ul>

              <br>
          

            </div>

          </div>
         
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="model/production/images/img.jpg" alt=""><?php echo ($usuario); ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                  <a class="dropdown-item" href="index.php"><i class="fa fa-sign-out pull-right"></i> Sair</a>
                </div>
              </li>

            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">

</body>

</html>