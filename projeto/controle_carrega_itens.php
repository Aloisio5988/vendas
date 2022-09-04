<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. ;D
 *-->
<?php
//die (var_dump($_POST));
include("funcoes/banco/conexao.php");
$pdo = conecta();

	$menuID = $_POST['btnMenuID'];
	$menuQuery = $pdo->prepare("SELECT ccea.cliente, nome, valor, ccea.id FROM conta_em_aberto as c
	inner join produtos as p on p.id = c.produto
	inner join cliente_conta_em_aberto as ccea  on ccea.id = c.cliente
	where c.bit_ativo = 1 and ccea.id = ".$menuID);
	$menuQuery->execute();

	$counter = 0;
	while ($menuRow = $menuQuery->fetch(PDO::FETCH_ASSOC)) {
		echo "
		<tr>
			<input type = 'hidden' id='cod_cliente' name = 'itemID[]' value ='" . $menuRow['id'] . "'/>
			<input type = 'hidden' name = 'tipo_venda[]' value ='prazo'/>
			<td>" . $menuRow['cliente']."</td>
			<td>" . $menuRow['nome']."</td>
			<td class="."valor-calculado".">" . $menuRow['valor']. "</td>
	</tr>
		";

		$counter++;
	}
