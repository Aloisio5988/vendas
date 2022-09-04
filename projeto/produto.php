<?php
session_start();
$usuario = $_SESSION['nome'];
if ($usuario == '') {
    session_destroy();
    header("Location: index.php");
}
require 'funcoes/banco/conexao.php';
require 'funcoes/login/login.php';
require 'funcoes/crud/crud_produto.php';
require 'funcoes/auditoria/auditoria.php';
//dados de venda
registro_auditoria($usuario, "Acessou a tela de produtos", $_SERVER["REQUEST_URI"]);
?>
<!DOCTYPE html>
<html>

<body>
  <?php include 'menu/menu.php'; ?>
  <div class="title_left">
                <h3>Produtos</h3>
              </div>
              <div class="x_title">
             
                <h4 style="color: #999fc7; text-align:right"><a href="#" id="janela">Cadastrar</a></h4>
                
                    <div class="clearfix"></div>
                    <div class="container-fluid">
    <!-- Breadcrumbs-->
    
  
    <div class="box-content nopadding">
      <table style="font-size: 16px" class="table table-striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Quant.</th>
            <th>Marca</th>
            <th>Categoria</th>
            <th>Valor</th>
            <th width="200">Ação</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="5"><img src="img/load.svg" class="load" alt="Carregando" /></td>
          </tr>
        </tbody>
      </table>
    </div>


  </div>
                  </div>


  </div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cadastro</h4>
        </div>
        <div class="modal-body">

        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  </div>

  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/produto.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>
</div>
<!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<?php include 'menu/footer.php'; ?>
</body>
</html>