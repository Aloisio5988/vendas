<?php
session_start();
require 'funcoes/banco/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Contato</title>

	<head>

	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'lista de vendas.xls';

		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Planilha Mensagem de Contatos</tr>';
		$html .= '</tr>';


		$html .= '<tr>';
		$html .= '<td colspan="3"><b>Descrição </b></td>';
		$html .= '<td><b>Valor (unidade)</b></td>';
		$html .= '<td><b>quantidade</b></td>';
		$html .= '<td><b>Total</b></td>';
		$html .= '<td><b>Data</b></td>';
		$html .= '</tr>';

		//Selecionar todos os itens da tabela 
		$pdo = conecta();

		$menuQuery = $pdo->prepare("SELECT  distinct (DATE_FORMAT(v.data_hora,'%d-%m-%y')) as data,
		p.nome,
		p.valor as unidade,
		p.marca as categoria,
		iv.quantidade as quantidade,
		round(SUM((p.valor * iv.quantidade)),2) AS valor
		FROM  vendas as v
		inner join itensvenda as iv on id_venda = v.id
		inner join produtos as p on item_vendido = p.id
		group by p.nome, p.valor, p.marca,v.data_hora, iv.quantidade");
		$menuQuery->execute();

		while ($row_msg_contatos = $menuQuery->fetch(PDO::FETCH_ASSOC)) {

			$valor_unidade = str_replace('.', ',', $row_msg_contatos["unidade"]);
			$valor_total = str_replace('.', ',', $row_msg_contatos["valor"]);

			$html .= '<tr> <strong style="font-size: 18px;">';
			$html .= '<td colspan="3">' . $row_msg_contatos["nome"] . '</td>';
			$html .= '<td>' . $valor_unidade . '</td>';
			$html .= '<td>' . $row_msg_contatos["quantidade"] . '</td>';
			$html .= '<td>' . $valor_total . '</td>';
			$html .= '<td>' . $row_msg_contatos["data"] . '</td>';
			$html .= '</strong> </tr>';;
		}
		// Configurações header para forçar o download
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-type: application/x-msexcel");
		header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		header("Content-Description: PHP Generated Data");
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>

</html>