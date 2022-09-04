<?php
require '../funcoes/banco/conexao.php';
require '../funcoes/crud/crud_cliente.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {
	case 'form_cad':
?>

		<div class="retorno"></div>

		<form action="" name="form_cad" method="post">
			<div class="form-group">
				<label for="nome">Nome Cliente</label>
				<input type="text" name="nome" class="form-control" placeholder="Digite o Nome do cliente">
			</div>
			<div class="form-group">
				<label for="endereco">Endereço</label>
				<input type="text" name="endereco" class="form-control" placeholder="Digite o endereço">
				
			</div>
			<div class="form-group">
				<label for="bairro">Bairro</label>
				<input name="bairro" class="form-control" placeholder="Digite o Bairro">
			</div>
			<div class="input-group">
			<label for="numero">Nº</label>
				<input  type="text" id="numero" name="numero" class="form-control" placeholder="Digite o Nº">
			
				<label for="complemento">Complemento</label>
				<input type="text" name="complemento" class="form-control" placeholder="Digite o complemento">
			</div>
			<div class="form-group">
				<label for="ponto">Ponto de Referência</label>
				<input name="ponto" class="form-control" placeholder="Digite o Ponto de Referência">
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
					<td><?php echo $adm->endereco; ?></td>
					<td><?php echo $adm->bairro; ?></td>
					<td><?php echo $adm->numero; ?></td>
					<td><?php echo $adm->ponto; ?></td>
					
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
				<label for="nome">Nome Cliente</label>
				<input type="text" name="nome" value="<?php echo $dados->nome; ?>" class="form-control" placeholder="Digite o Nome">
			</div>
			<div class="form-group">
				<label for="endereco">Endereço</label>
				<input type="text" name="endereco" value="<?php echo $dados->endereco; ?>" class="form-control" placeholder="Digite o Endereço">
			</div>
			<div class="form-group">
				<label for="bairro">Bairro</label>
				<input type="text" name="bairro" value="<?php echo $dados->bairro; ?>" class="form-control" placeholder="Digite o Bairro">
			</div>
			<div class="form-group">
				<label for="numero">Nº</label>
				<input type="text" name="numero" value="<?php echo $dados->numero; ?>" class="form-control" placeholder="Digite o numero">
				
				<label for="complemento">Complemento</label>
				<input type="text" name="complemento" value="<?php echo $dados->complemento; ?>" class="form-control" placeholder="Digite o complemento">
			
			</div>
			<div class="form-group">
				<label for="ponto">Ponto de Referência</label>
				<input type="text" name="ponto" value="<?php echo $dados->ponto; ?>" class="form-control" placeholder="Digite o ponto">
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

