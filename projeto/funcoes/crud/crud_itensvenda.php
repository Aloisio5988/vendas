<?php

// função para cadastrar users
//function cadastro($usuario, $itemID, $itemqty, $cliente_select){
    function registro_vendas($id_venda, $item_vendido, $quantidade){
        //die($id_venda);
        //die (var_dump($id_venda));
    $pdo = conecta();
    try{
        $cadastro = $pdo -> prepare("INSERT INTO itensvenda (id_venda, item_vendido, quantidade) VALUES (?,?,?)");
        //die (var_dump($cadastro));
        
       $cadastro -> bindValue(1, $id_venda, PDO::PARAM_STR);
        $cadastro -> bindValue(2, $item_vendido, PDO::PARAM_STR);
        $cadastro -> bindValue(3, $quantidade, PDO::PARAM_STR);
        
        
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

// Funcao de listar

function listarItens(){
    $pdo = conecta();
    try {
        $listar = $pdo -> query("SELECT * FROM itensvenda");
        
        if ($listar -> rowCount() > 0) :
             return $listar->fetchAll(PDO::FETCH_OBJ);
        else :
             return FALSE;
        endif;
    } catch(PDOException $e){
        echo $e -> getMessage();
    }    
}

?>