<?php



function cadastro_vendas($usuario, $id_loja)
{
    //die($id_loja);
    $pdo = conecta();
    try {
        $cadastro = $pdo->prepare("INSERT INTO vendas (usuario, cliente, id_loja) VALUES (?,?,?)");
        //die (var_dump($cadastro));

        $cadastro->bindValue(1, $usuario, PDO::PARAM_STR);
        $cadastro->bindValue(2, 0, PDO::PARAM_STR);
        $cadastro->bindValue(3, $id_loja, PDO::PARAM_INT);

        $cadastro->execute();

        if ($cadastro->rowCount() > 0) :
            return true;
        else :
            return  $cadastro;
        endif;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


// função para cadastrar users
//function cadastro($usuario, $itemID, $itemqty, $cliente_select){
function cadastro($usuario, $cliente_select)
{
    // die($usuario);
    $pdo = conecta();
    try {
        $cadastro = $pdo->prepare("INSERT INTO vendas (usuario, cliente) VALUES (?,?)");
        //die (var_dump($cadastro));

        $cadastro->bindValue(1, $usuario, PDO::PARAM_STR);
        $cadastro->bindValue(2, $cliente_select, PDO::PARAM_STR);

        $cadastro->execute();

        if ($cadastro->rowCount() > 0) :
            return true;
        else :
            return  $cadastro;
        endif;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// Funcao de listar

function listarAdmin()
{
    $pdo = conecta();
    try {
        $listar = $pdo->query("SELECT * FROM vendas");

        if ($listar->rowCount() > 0) :
            return $listar->fetchAll(PDO::FETCH_OBJ);
        else :
            return FALSE;
        endif;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function pegaIdVendas()
{
    $pdo = conecta();
    try {
        $pegaid = $pdo->prepare("SELECT id FROM vendas ORDER BY id DESC LIMIT 1");
        $pegaid->execute();

        if ($pegaid->rowCount() > 0) :
            $linha = $pegaid->fetch(PDO::FETCH_ASSOC);

            return $linha["id"];
        else :
            return FALSE;
        endif;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
