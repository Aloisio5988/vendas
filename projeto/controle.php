<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. ;D
 *-->
<?php
ob_start();
session_start();
require 'funcoes/banco/conexao.php';
require 'funcoes/login/login.php';
require 'funcoes/crud/crud_produto.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'menu/menu.php'; ?>
<div class="container-fluid">

   <h2 style="font-size: 18px" class="linha" style="color: #a19f9f"><b>CONTROLE</b></h2>
   <br>
   <div class="row">
      <div class="col-lg-6">
         <div class="card text-white bg-success mb-3">
            <div style="font-size: 16px" class="card-header">
               <i class="fa fa-users"></i>
               <b>Informe dados do cliente</b>
            </div>
         </div>
         <label style="font-size: 16px"><b> &emsp; Cliente:</b> <input id="cliente" list="a" style="width:280px;" /></label>

         <label style="font-size: 16px">
            <b> &emsp; Produto:</b>
            <select  id="produto" name="produto_select" style="width:280px;">
               <option value="0">Não Informado</option>
               <?php
               $pdo = conecta();
               try {

                  $menuQuery = $pdo->prepare("SELECT * FROM produtos");
                  $menuQuery->execute();
                  while ($prod = $menuQuery->fetch(PDO::FETCH_ASSOC)) { ?>
                     <option value="<?php echo $prod['id'] ?>"><?php echo $prod['nome'] ?></option>
               <?php }
                  $pdo = null;
               } catch (PDOException $erro) {
                  echo $erro->getmessage();
               } ?>
            </select>
         </label>

         <button class="btn btn-dark" id="teste" onclick="controle_processo()">Enviar</button>
         <br></br>
         <div class="card mb-3">
            <div class="card text-white bg-success mb-3">
               <div style="font-size: 16px" class="card-header">
                  <i class="fa fa-anchor"></i>
                  Pedidos em aberto
               </div>
            </div>
            <div class="card-body">
               <table style="font-size: 16px" class="table table-bordered text-center" width="100%" cellspacing="0">
                  <tr>
                     <?php
                     $pdo = conecta();
                     try {
                        $menuQuery = $pdo->prepare("SELECT ccea.cliente, ccea.id FROM conta_em_aberto as c
                        inner join cliente_conta_em_aberto as ccea  on ccea.id = c.cliente
                        where ccea.bit_ativo = 1
                        group by cliente, ccea.id");
                        $menuQuery->execute();
                        $counter = 0;
                        while ($menuRow = $menuQuery->fetch(PDO::FETCH_ASSOC)) {

                           if ($counter >= 3) {
                              echo '</tr>';
                              $counter = 0;
                           }
                           if ($counter == 0) {
                              echo '<tr>';
                           }
                     ?>
                           <td><button style="margin-bottom:4px;white-space: normal;" class="btn btn-success" ] onclick="carrega_itens(<?php echo $menuRow['id']; ?>)">
                                 <?php echo ("<b>" . $menuRow['cliente'] . "</b>"); ?></button>
                           </td>
                           <!--<?php //echo nl2br("<b>".$menuRow['cliente']."</b> \n ".$menuRow['nome']); 
                                 ?></button></td>-->
                     <?php $counter++;
                        }
                        $pdo = null;
                     } catch (PDOException $erro) {
                        echo $erro->getmessage();
                     }
                     ?>
                  </tr>
               </table>
               <table id="tblItem" class="table table-bordered text-center" width="100%" cellspacing="0"></table>
               <div id="qtypanel" hidden="">
                  Cantidad : <input id="qty" required="required" type="number" min="1" max="50" name="qty" value="1" />
                  <button class="btn btn-info" onclick="insertItem()">Enviar</button>
                  <br><br>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">


         <div class="card mb-3">

            <div class="card text-white bg-success mb-3">
               <div style="font-size: 16px" class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  Lista detalhada
               </div>
            </div>
            <div class=" card-body">
               <form action="controle_enviar.php" method="POST">
                  <table style="font-size: 16px" id="tblOrderList" class="table table-bordered text-center" width="100%" cellspacing="0">
                     <tr>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Valor</th>
                     </tr>
                  </table>
                  <!--MODAL-->
                  <button type="button" class="tn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal">
                     PAGAMENTO
                  </button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Realizar pagamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <table id="tblModalList" class="table table-bordered text-center" width="100%" cellspacing="0">
               <tr>
                  <th>Cliente</th>
                  <th>Produto</th>
                  <th>Valor</th>
               </tr>
            </table>
            <label id="qtdtotal">Total: </label>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="controle_exec()" class="btn btn-primary">REALIZAR PAGAMENTO</button>
         </div>
      </div>
   </div>
</div>
<!-- FIM DO MODAL -->
<script>
   var currentItemID = null;

   function controle_exec() {
      var id = currentItemID;
      var cliente = $("#cod_cliente").val();
      $.ajax({
         url: "controle_pagar.php",
         type: 'POST',
         data: {
            btnMenuItemID: id,
            cliente: cliente
         },
         success: function(output) {
            $("#tblModalList").append(output);
         }
      });
      alert("Pagamento realizado");
      document.location.reload(true);
   }

   function controle_processo() {
      var id = currentItemID;
      var cliente = $("#cliente").val();
      var produto = $("#produto").val();
      $.ajax({
         url: "controle_proc.php",
         type: 'POST',
         data: {
            btnMenuItemID: id,
            cliente: cliente,
            produto: produto
         },
         success: function(output) {
            $("#tblOrderList").append(output);
            $("#tblModalList").append(output);

            $("#qtypanel").prop('hidden', true);
            $("#qtypanel_a").prop('hidden', true);
         }
      });
      document.location.reload(true);
   }

   function controle_servico() {
      var id = currentItemID;
      var cliente = $("#cod_cliente").val();
      var servico = $("#servico").val();
      $.ajax({
         url: "controle_servico.php",
         type: 'POST',
         data: {
            btnMenuItemID: id,
            cliente: cliente,
            servico: servico
         },
         success: function(output) {
            $("#tblOrderList").append(output);
            $("#tblModalList").append(output);

            $("#qtypanel").prop('hidden', true);
            $("#qtypanel_a").prop('hidden', true);
         }
      });
      //document.location.reload(true);  
   }

   function carrega_itens(currentItemID) {
      var id = currentItemID;
      $.ajax({
         url: "controle_carrega_itens.php",
         type: 'POST',
         data: {
            btnMenuID: id
         },
         success: function(output) {
            $("#tblOrderList").append(output);
            $("#tblModalList").append(output);
            $("#qtypanel").prop('hidden', true);

         }
      });

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
</script>
</body>
<?php include 'menu/footer.php'; ?>

</html>