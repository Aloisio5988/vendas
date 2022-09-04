<!--**
 * Olá Dev, esse projeto faz parte de um sistema o qual desenvolvi
 * e já está em uso. Espero que tenha um bom proveito *--*
 * @author Aloisio Carvalho  - carvalhoaloisio@hotmail.com
 * Qualquer dúvida, pode entrar em contato. ;D
 *-->
<?php

    function registro_auditoria($usuario, $acao, $tela){
       // die($usuario);
    $pdo = conecta();
    try{
        $cadastro = $pdo -> prepare("INSERT INTO auditoria (usuario, acao, tela) VALUES (?,?,?)");
        //die (var_dump($cadastro));
        
       $cadastro -> bindValue(1, $usuario, PDO::PARAM_STR);
        $cadastro -> bindValue(2, $acao, PDO::PARAM_STR);
        $cadastro -> bindValue(3, $tela, PDO::PARAM_STR);
        
        
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

function listarAuditoria(){
    $pdo = conecta();
    try {
        $listar = $pdo -> query("SELECT * FROM auditoria");
        
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