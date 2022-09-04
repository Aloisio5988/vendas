<?php


// função para cadastrar users
function cadastro($nome, $qtd, $marca,$categoria, $valor){
    $pdo = conecta();
    try{
        $cadastro = $pdo -> prepare("INSERT INTO produtos (nome, qtd, marca, categoria, valor) VALUES (?,?,?,?,?)");
        $cadastro -> bindValue(1, $nome, PDO::PARAM_STR);
        $cadastro -> bindValue(2, $qtd, PDO::PARAM_STR);
        $cadastro -> bindValue(3, $marca, PDO::PARAM_STR);
        $cadastro -> bindValue(4, $categoria, PDO::PARAM_STR);
        $cadastro -> bindValue(5, $valor, PDO::PARAM_STR);
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
        $listar = $pdo -> query("SELECT * FROM produtos");
        
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
        $pegaid = $pdo -> prepare("SELECT * FROM produtos WHERE id = ?");
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

function atualizar($nome, $qtd, $marca, $categoria, $valor, $id){
    $pdo = conecta();
    try{
    $atualizar = $pdo -> prepare("UPDATE produtos SET nome=?, qtd=?, marca=?, categoria=?, valor=? WHERE id =?");
    //die ($atualizar);   
    $atualizar -> bindValue(1, $nome, PDO::PARAM_STR);
        $atualizar -> bindValue(2, $qtd, PDO::PARAM_STR);
        $atualizar -> bindValue(3, $marca, PDO::PARAM_STR);
        $atualizar -> bindValue(4, $categoria, PDO::PARAM_STR);
        $atualizar -> bindValue(5, $valor, PDO::PARAM_STR);
        $atualizar -> bindValue(6, $id, PDO::PARAM_INT);
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
        $delete = $pdo -> prepare("DELETE FROM produtos WHERE id = ?");
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