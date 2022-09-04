<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. ;D
 *-->
<?php
session_start();
$usuario = $_SESSION['nome'];
if ($usuario == '') {
    session_destroy();
    header("Location: index.php");
}
include 'menu/header.php';
require 'funcoes/banco/conexao.php';
require 'funcoes/login/login.php';
require 'funcoes/crud/crud_produto.php';
require 'funcoes/auditoria/auditoria.php';
//AUDITORIA
//dados de venda
registro_auditoria($usuario, "Consultou preço", $_SERVER["REQUEST_URI"]);

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'menu/menu.php'; ?>


<div class="container-fluid">
 
  <h2 style="font-size: 16px" class="linha" style="color: #a19f9f">CONSULTA PREÇO</h2>
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div style="font-size: 16px"  class="card-header">
          <i class="fas fa-atlas"></i>
          Consulta de preço
        </div>
        <div style="font-size: 16px"  class="card-body">
        <b>Selecione o Produto: </b>
          <select id="select_page" style="width:400px;" class="operator">
            <option value="">Selecione...</option>
            <?php
            $pdo = conecta();
            try {
              $menuQuery = $pdo->prepare("SELECT * FROM produtos");
              $menuQuery->execute();
              $counter = 0;
              while ($prod = $menuQuery->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $prod['id'] ?>"><?php echo $prod['nome'] ?></option>
            <?php }
              $pdo = null;
            } catch (PDOException $erro) {
              echo $erro->getmessage();
            } ?>
            <br>
          </select>
          <br>
          <table id="tblItem" class="table table-bordered text-center" width="100%" cellspacing="0">
            <br>
          </table>

        </div>
      </div>
    </div>


  </div>
</div>

<script>
  var currentItemID = null;

  document.getElementById("select_page").onchange = function() {
    var valor = $("#select_page").val();
    displayItem(valor);
  }

  function displayItem(id) {
    $.ajax({
      url: "consulta.php",
      type: 'POST',
      data: {
        btnMenuID: id
      },

      success: function(output) {
        $("#tblItem").html(output);
      }
    });
  }

  function insertItem() {
    var id = currentItemID;
    var quantity = $("#qty").val();
    $.ajax({
      url: "consulta.php",
      type: 'POST',
      data: {
        btnMenuItemID: id,
        qty: quantity
      },

      success: function(output) {
        $("#tblOrderList").append(output);
        $("#qtypanel").prop('hidden', true);
      }
    });

    $("#qty").val(1);
  }

  function setQty(id) {
    currentItemID = id;
    $("#qtypanel").prop('hidden', false);
  }

  $(document).on('click', '.deleteBtn', function(event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    return false;
  });

  $(document).ready(function() {
    //change selectboxes to selectize mode to be searchable
    $("select").select2();
  });
</script>

</body>
<?php include 'menu/footer.php'; ?>

</html>