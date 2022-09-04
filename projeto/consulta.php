<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. ;D
 *-->
<?php
//die (var_dump($_POST['btnMenuID']));
include("funcoes/banco/conexao.php");
$pdo = conecta();

if (isset($_POST['btnMenuID'])) {

	$menuID = $_POST['btnMenuID'];
	$menuQuery = $pdo->prepare("SELECT * FROM produtos where id = ".$menuID);
	$menuQuery->execute();

	$counter = 0;
	while ($menuRow = $menuQuery->fetch(PDO::FETCH_ASSOC)) {
		if ($counter >= 3) {
			echo "</tr>";
			$counter = 0;
		}
		if ($counter == 0) {
			echo "<tr>";
		}
		$valor = $menuRow['valor'];
		$calculo = $valor * (10/100);
		$calculo = $calculo + $valor;
		echo "<br>
		<td><b>Á vista </b><button style='margin-bottom:4px;white-space: normal;' 
		class='btn btn-warning' onclick = 'setQty({$menuRow['id']})'>{$menuRow['valor']}
		</button></td>
		
		<td><b>Á prazo </b><button style='margin-bottom:4px;white-space: normal;' 
		class='btn btn-warning' onclick = 'setQty({$menuRow['id']})'>{$calculo}
		</button></td>";

		$counter++;
	}
}

if (isset($_POST['btnMenuItemID']) && isset($_POST['qty'])) {

	$menuItemID = $_POST['btnMenuItemID'];
	$quantity = $_POST['qty'];

	$menuItemQuery = $pdo->prepare("SELECT * FROM produtos where id = " . $menuItemID);
	$menuItemQuery->execute();

	while ($menuItemRow = $menuItemQuery->fetch(PDO::FETCH_ASSOC)) {
		echo "
					<tr>
						<input type = 'hidden' name = 'itemID[]' value ='" . $menuItemRow['id'] . "'/>
						<td>" . $menuItemRow['nome'] . " : " . $menuItemRow['marca'] . "</td>
						<td>" . $menuItemRow['valor'] . "</td>
						<td><input type = 'number' required='required' min='1' name = 'itemqty[]' width='10px' class='form-control' value ='" . $quantity . "'/></td>
						<td>" . number_format((float)$menuItemRow['valor'] * $quantity, 2,',','.') . "</td>
						<td><button class='btn btn-danger deleteBtn' type='button' onclick='deleteRow()'><i class='fas fa-times'></i></button></td>
					</tr>
					";
	}
}
