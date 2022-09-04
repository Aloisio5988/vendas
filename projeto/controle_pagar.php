<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. ;D
 *-->
<?php
session_start();
$usuario = $_SESSION['nome'];
//die (var_dump($_POST));
include("funcoes/banco/conexao.php");
include("funcoes/crud/crud_vendas.php");
include("funcoes/crud/crud_itensvenda.php");
$pdo = conecta();
$cliente = $_POST['cliente'];

//INSERIR VENDA
cadastro($usuario, $cliente);

//PEGAR O ID DA VENDA
$id_venda = pegaIdVendas();


	try{
	$menuQuery = $pdo->prepare("SELECT p.id as cod_produto, ccea.cliente, nome, valor, ccea.id FROM conta_em_aberto as c
	inner join produtos as p on p.id = c.produto
	inner join cliente_conta_em_aberto as ccea  on ccea.id = c.cliente
	where c.bit_ativo = 1 and ccea.id = ".$cliente);
	$menuQuery->execute();

	$counter = 0;
	while ($menuRow = $menuQuery->fetch(PDO::FETCH_ASSOC)) {
        registro_vendas($id_venda, $menuRow['cod_produto'], 0);		

		$counter++;
	}
    
        $atualizar = $pdo -> prepare("UPDATE cliente_conta_em_aberto SET bit_ativo=? WHERE id =?");
        //die ($atualizar);   
            $atualizar -> bindValue(1, 0, PDO::PARAM_INT);
            $atualizar -> bindValue(2, $cliente, PDO::PARAM_INT);
            $atualizar -> execute();  

            $atualizar = $pdo -> prepare("UPDATE conta_em_aberto SET bit_ativo=? WHERE cliente =?");
            $atualizar -> bindValue(1, 0, PDO::PARAM_INT);
            $atualizar -> bindValue(2, $cliente, PDO::PARAM_INT);
            $atualizar -> execute();  

        }catch(PDOException $e) {
            echo $e -> getMessage();
        }
    