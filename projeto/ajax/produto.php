<?php
require '../funcoes/banco/conexao.php';
require '../funcoes/crud/crud_produto.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {
	case 'form_cad':
?>

		<div class="retorno"></div>

		<form action="" name="form_cad" method="post">
			<div class="form-group">
				<label for="nome">Nome Produto</label>
				<input type="text" name="nome" class="form-control" placeholder="Digite o Nome do produto">
			</div>
			<div class="form-group">
				<label for="qtd">Quantidade</label>
				<input type="number" name="qtd" class="form-control" placeholder="Digite o Produto">
			</div>
				<div class="form-group">
					<label for="categoria">Categoria</label>
					<select class="form-control" name="categoria">
						<option value=""> Escolha uma opção</option>
						<option value="Bebidas"> Bebidas</option>
						<option value="Petiscos"> Petiscos</option>
						<option value="Lanches"> Lanches</option>
						<option value="Variados"> Variados</option>
					</select>
				</div>
			<div class="form-group">
				<label for="marca">Marca</label>
				<input type="text" name="marca" class="form-control" placeholder="Digite a Marca">
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input step="any" name="valor" class="form-control" placeholder="Digite o Valor" onkeyup="k(this);">
			</div>


			<div class="checkbox">
				<p class="pull-right">
					<img src="img/load.svg" class="load" alt="Carregando" style="display: none;" />
					<button type="submit" class="btn btn-default">Cadastrar</button>
				</p>
			</div>
		</form>
		<?php
		break;

	case 'listar_admin':
		if (listarAdmin()) :
			$admin = listarAdmin();
			foreach ($admin as $adm) :
		?>
				<tr>
					<td><?php echo $adm->nome; ?></td>
					<td><?php echo $adm->qtd; ?></td>
					<td><?php echo $adm->marca; ?></td>
					<td><?php echo $adm->categoria; ?></td>
					<td><?php echo number_format($adm->valor, 2, ',', '.'); ?></td>
					<td>
						<a href="#" id="btn_edit" data-id="<?php echo $adm->id; ?>" class="btn btn-warning">Editar</a>
						<a href="#" id="btn_excluir" data-id="<?php echo $adm->id; ?>" class="btn btn-danger">Excluir</a>
					</td>
				</tr>
		<?php
			endforeach;
		else :

		endif;

		break;

	case 'form_edit':
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$dados = pegaId($id);
		?>

		<div class="retorno"></div>

		<form action="" name="form_edit" method="post">
			<div class="form-group">
				<label for="nome">Nome Produto</label>
				<input type="text" name="nome" value="<?php echo $dados->nome; ?>" class="form-control" placeholder="Digite o Nome">
			</div>
			<div class="form-group">
				<label for="qtd">Quantidade</label>
				<input type="number" name="qtd" value="<?php echo $dados->qtd; ?>" class="form-control" placeholder="Digite o qtd">
			</div>
			<div class="form-group">
				<label for="marca">Marca</label>
				<input type="text" name="marca" value="<?php echo $dados->marca; ?>" class="form-control" placeholder="Digite a marca">
			</div>
				<div class="form-group">
					<label for="categoria">Categoria</label>
					<select class="form-control" name="categoria" value="<?php echo $dados->categoria;?>">
						<option value=""> Escolha uma opção</option>
						<option value="Bebidas"> Bebidas</option>
						<option value="Petiscos"> Petiscos</option>
						<option value="Lanches"> Lanches</option>
						<option value="Variados"> Variados</option>
					</select>
				</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input step="any" name="valor" value="<?php echo $dados->valor; ?>" class="form-control" placeholder="Digite o valor" onkeyup="k(this);">
			</div>

			<input type="hidden" name="id" value="<?php echo $dados->id; ?>" />

			<div class="checkbox">
				<p class="pull-right">
					<img src="img/load.svg" class="load" alt="Carregando" style="display: none;" />
					<button type="submit" class="btn btn-default">Atualizar</button>
				</p>
			</div>
		</form>

<?php break;


		break;
	default:
		echo 'Nada';
		break;
}?>

<script>
function k(i) {
	var v = i.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ".");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	i.value = v;
}
</script>
