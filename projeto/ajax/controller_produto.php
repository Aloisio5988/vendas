<?php
ob_start(); 
session_start();
require '../funcoes/banco/conexao.php';
require '../funcoes/login/login.php';
require '../funcoes/crud/crud_produto.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
 switch ($acao) :
   
   // realiza cadastro
  case 'cadastro':

       $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
       $qtd = filter_input(INPUT_POST, 'qtd', FILTER_SANITIZE_NUMBER_INT);
       $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
       $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
       $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);

    if (cadastro($nome, $qtd, $marca, $categoria, $valor)) :
      echo "cadastrou";
   endif;    
  break;

// realiza a edição
  case 'edit':
       $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
       $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
       $qtd = filter_input(INPUT_POST, 'qtd', FILTER_SANITIZE_NUMBER_INT);
       $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
       $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
       $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);

     if (atualizar($nome, $qtd, $marca, $categoria, $valor, $id)) :
        echo "atualizou";
     endif;
 break;

// realiza um delete
 case 'excluir' :
      $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
     if (delete($id)) :
        echo "deletou";
     endif;
break;

  default :
     echo 'erro';
         break;

endswitch;
ob_end_flush();