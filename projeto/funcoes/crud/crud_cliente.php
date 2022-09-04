<?php


// função para cadastrar users
function cadastro($nome, $endereco, $bairro, $numero, $complemento, $ponto){
    $pdo = conecta();
    try{
        $cadastro = $pdo -> prepare("INSERT INTO cliente (nome, endereco, numero, complemento, ponto, bairro) VALUES (?,?,?,?,?,?)");
        
        $cadastro -> bindValue(1, $nome, PDO::PARAM_STR);
        $cadastro -> bindValue(2, $endereco, PDO::PARAM_STR);
        $cadastro -> bindValue(3, $numero, PDO::PARAM_STR);
        $cadastro -> bindValue(4, $complemento, PDO::PARAM_STR);
        $cadastro -> bindValue(5, $ponto, PDO::PARAM_STR);
        $cadastro -> bindValue(6, $bairro, PDO::PARAM_STR);
        
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


// Funcao de listar

function listarAdmin(){
    $pdo = conecta();
    try {
        $listar = $pdo -> query("SELECT * FROM cliente");
        
        if ($listar -> rowCount() > 0) :
             return $listar->fetchAll(PDO::FETCH_OBJ);
        else :
             return FALSE;
        endif;
    } catch(PDOException $e){
        echo $e -> getMessage();
    }
    
}

// Funcao de PEGARID

function pegaId($id){
    $pdo = conecta();
    try {
        $pegaid = $pdo -> prepare("SELECT * FROM cliente WHERE id = ?");
        $pegaid->bindValue(1, $id, PDO::PARAM_INT);
        $pegaid->execute();
        
        if ($pegaid -> rowCount() > 0) :
             return $pegaid->fetch(PDO::FETCH_OBJ);
        else :
             return FALSE;
        endif;
    } catch(PDOException $e){
        echo $e -> getMessage();
    }    
}

// funcao atualizar

function atualizar($nome, $endereco, $numero, $complemento, $ponto,  $bairro, $id){
    $pdo = conecta();
    try{
    $atualizar = $pdo -> prepare("UPDATE cliente SET nome=?, endereco=?, numero=?, complemento=?, ponto=?, bairro=? WHERE id =?");
    //die ($atualizar);   
        $atualizar -> bindValue(1, $nome, PDO::PARAM_STR);
        $atualizar -> bindValue(2, $endereco, PDO::PARAM_STR);
        $atualizar -> bindValue(3, $numero, PDO::PARAM_STR);
        $atualizar -> bindValue(4, $complemento, PDO::PARAM_STR);
        $atualizar -> bindValue(5, $ponto, PDO::PARAM_STR);
        $atualizar -> bindValue(6, $bairro, PDO::PARAM_STR);
        $atualizar -> bindValue(7, $id, PDO::PARAM_INT);
        $atualizar -> execute();
     
        if ($atualizar -> rowCount() == 1) : 
           return TRUE;
        else :
           return FALSE;
        endif;
    }catch(PDOException $e) {
        echo $e -> getMessage();
    }
}

// funcao deletar

function delete($id){
    $pdo = conecta();
    try{
        $delete = $pdo -> prepare("DELETE FROM cliente WHERE id = ?");
        $delete->bindValue(1, $id, PDO::PARAM_INT);
        $delete->execute();
        
        if($delete -> rowCount() == 1) :
            return TRUE;
        else : 
            return FALSE;
        endif;
    } catch(PDOException $e) {
         echo $e -> getMessage();
    }
}