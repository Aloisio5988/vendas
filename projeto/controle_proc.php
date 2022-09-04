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
$cliente = $_POST["cliente"];
$produto = $_POST["produto"];

try{
		$pegaCliente = $pdo -> prepare("SELECT id FROM cliente_conta_em_aberto where cliente = '".$cliente."'");
       $pegaCliente->execute();
        
        if ($pegaCliente -> rowCount() > 0) {
              $linha = $pegaCliente->fetch(PDO::FETCH_ASSOC);
			  $id_venda=$linha["id"];
              $atualizar = $pdo -> prepare("UPDATE cliente_conta_em_aberto SET bit_ativo=? WHERE id =?");
        //die ($atualizar);   
            $atualizar -> bindValue(1, 1, PDO::PARAM_INT);
            $atualizar -> bindValue(2, $id_venda, PDO::PARAM_INT);
            $atualizar -> execute();  

			  inserir_produto_where($id_venda);
		}else{

        $cadastro = $pdo -> prepare("INSERT INTO cliente_conta_em_aberto (cliente, bit_ativo) VALUES (?,?)");
        
        $cadastro -> bindValue(1, $cliente, PDO::PARAM_STR);
        $cadastro -> bindValue(2, 1, PDO::PARAM_STR);        
        $cadastro -> execute();
		
        if ($cadastro -> rowCount() > 0) :
			inserir_produto(); 
           return true;
        else :
           return false;
        endif;
	}
    }catch(PDOException $e) {
        echo $e -> getMessage();
    }


//inserir os itens  
function inserir_produto(){
    try{
		$pdo = conecta();
		$produto = $_POST["produto"];
		$pegaid = $pdo -> prepare("SELECT id FROM cliente_conta_em_aberto ORDER BY id DESC LIMIT 1");
        $pegaid->execute();
        
        if ($pegaid -> rowCount() > 0) {
              $linha = $pegaid->fetch(PDO::FETCH_ASSOC);
			  $id_venda=$linha["id"];
		}

        $cadastro = $pdo -> prepare("INSERT INTO conta_em_aberto (cliente, produto, bit_ativo) VALUES (?,?,?)");
        
        $cadastro -> bindValue(1, $id_venda, PDO::PARAM_STR);
        $cadastro -> bindValue(2, $produto, PDO::PARAM_STR);
        $cadastro -> bindValue(3, 1, PDO::PARAM_STR);        
        $cadastro   -> execute();
        
        if ($cadastro -> rowCount() > 0) : 
           return true;
        else :
           return false;
        endif;
    }catch(PDOException $e) {
	        echo $e -> getMessage();
	}
    
}


//inserir os itens via where
function inserir_produto_where($id_venda){
    try{
		$pdo = conecta();
		$produto = $_POST["produto"];
		
        $cadastro = $pdo -> prepare("INSERT INTO conta_em_aberto (cliente, produto, bit_ativo) VALUES (?,?,?)");
        
        $cadastro -> bindValue(1, $id_venda, PDO::PARAM_STR);
        $cadastro -> bindValue(2, $produto, PDO::PARAM_STR);
        $cadastro -> bindValue(3, 1, PDO::PARAM_STR);        
        $cadastro -> execute();
        
        if ($cadastro -> rowCount() > 0) : 
           return true;
        else :
           return false;
        endif;
    }catch(PDOException $e) {
	        echo $e -> getMessage();
	}
    
}
