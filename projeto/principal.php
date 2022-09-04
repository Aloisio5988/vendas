<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. 
 *-->
<?php 
   session_start();
   $usuario = $_SESSION['nome'];
   if ($usuario == '') {
       session_destroy();
       header("Location: index.php");
   }
    
   include 'menu/menu.php';
   require 'funcoes/banco/conexao.php';
   require 'funcoes/login/login.php';
   require 'funcoes/crud/crud.php';
   require 'funcoes/auditoria/auditoria.php';
   //dados de venda
   registro_auditoria($usuario, "Acessou a tela de Principal", $_SERVER["REQUEST_URI"]);
   $admin = saldo();
   foreach ($admin as $adm) :   
   endforeach;
   $saldo_loja2 = saldo_loja2();
   foreach ($saldo_loja2 as $loja2) :   
   endforeach;
   $saldo_loja3 = saldo_loja3();
   foreach ($saldo_loja3 as $loja3) :   
   endforeach;
   $saldo_loja4 = saldo_loja4();
   foreach ($saldo_loja4 as $loja4) :   
   endforeach;
   $saldo_hoje = saldo_hoje();
   foreach ($saldo_hoje as $hoje) :   
   endforeach;
   $saldo_mes = saldo_mes();
   foreach ($saldo_mes as $mes) :   
   endforeach;
   ?>
<!-- top tiles -->
<div class="row" style="display: inline-block;" >
   <div class="tile_count">
      <div class="col-md-3 col-sm-2  tile_stats_count">
         <span class="count_top"><i class="fa fa-beer"></i> Bistrô Open Bar</span>
         <div class="count" style="font-weight: 10px;"><?php echo ("R$ ").$loja2->valor; ?></div>
      </div>
      <div class="col-md-3 col-sm-2  tile_stats_count">
         <span class="count_top"><i class="fa fa-cutlery"></i> Bistrô Restaurante</span>
         <div class="count" style="font-weight: 10px;"><?php echo ("R$ ").$loja3->valor; ?></div>
      </div>
      <div class="col-md-3 col-sm-2  tile_stats_count">
         <span class="count_top"><i class="fa fa-coffee"></i> Bistrô Lanchonete</span>
         <div class="count" style="font-weight: 10px;"><?php echo ("R$ ").$loja4->valor; ?></div>
      </div>
      <div class="col-md-3 col-sm-2  tile_stats_count">
         <span class="count_top"><i class="red"><i class="fa fa-money"></i> Lucro diário</span>
         <div class="count" style="font-weight: 10px;"><?php echo ("R$ ").$hoje->valor; ?></div> </i>
      </div>
      <div class="col-md-3 col-sm-2  tile_stats_count">
         <span class="count_top"><i class="blue"><i class="fa fa-money"></i> Lucro mês atual</span>
         <div class="count" style="font-weight: 10px;"><?php echo ("R$ ").$mes->valor; ?></div> </i>
      </div>
      <div class="col-md-3 col-sm-2  tile_stats_count">
         <span class="count_top"><i class="green"><i class="fa fa-money"></i> Lucro total</span>
         <div class="count" style="font-weight: 10px;"><?php echo ("R$ ").$adm->valor; ?></div> </i>
      </div>
     
   </div>
</div>
<!-- /top tiles -->
<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="col-md-2 col-sm-2 ">
      <div class="dashboard_graph">
         <!-- js of google of chart --> 
         <script type="text/javascript" src="https://www.google.com/jsapi"></script>
         <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
            
            var data_val = google.visualization.arrayToDataTable([
            ['Nome', 'Total'],
            <?php 
               $pdo = conecta();
               
               $menuQuery = $pdo->prepare("SELECT nome, count(p.valor) as soma FROM vendas as v 
               inner join itensvenda as iv on id_venda = v.id 
               inner join produtos as p on item_vendido = p.id group by nome limit 5; ");
               $menuQuery->execute();
               
               while ($menuRow = $menuQuery->fetch(PDO::FETCH_ASSOC)) {
               
               echo "['".$menuRow['nome']."',".$menuRow['soma']."],";
               }
               ?>
            ]);
            
            var options_val = {
            title: 'Produtos mais vendidos'
            };
            
            var chart_val = new google.visualization.PieChart(document.getElementById('piechart'));
            
            chart_val.draw(data_val, options_val);
            }
         </script>
         <body>
            <div id="piechart" style="width: 510px; height: 350px;"></div>
         </body>
         <div class="clearfix"></div>
        </div>
      </div>
    </div>
     
    <div class="col-sm">
    <div class="col-md-10 col-sm-10 ">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Produtos com estoque baixo');
        data.addColumn('number', 'Quantidade');
        data.addRows([
          <?php 
              
               
              $menuQuery = $pdo->prepare("SELECT nome, qtd from produtos order by qtd asc; ");
              $menuQuery->execute();
              
              while ($menuRow = $menuQuery->fetch(PDO::FETCH_ASSOC)) {
              
              echo "['".$menuRow['nome']."',".$menuRow['qtd']."],";
              }
              ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '400px', height: '310px'});
      }
    </script>
  </head>
  <body>
    <div id="table_div"></div>
  </body>

    </div>
    </div>
  </div>
</div>

</div>
<!-- /page content -->
<?php include 'menu/footer.php'; ?>

