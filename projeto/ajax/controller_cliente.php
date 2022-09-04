<?php
ob_start(); session_start();
require '../funcoes/banco/conexao.php';
require '../funcoes/login/login.php';
require '../funcoes/crud/crud_cliente.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
 switch ($acao) :
   
   // realiza cadastro
  case 'cadastro':

       $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
       $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
       $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);       
       $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
       $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
       $ponto = filter_input(INPUT_POST, 'ponto', FILTER_SANITIZE_STRING);

    if (cadastro($nome, $endereco, $bairro, $numero, $complemento, $ponto)) :
      echo "cadastrou";
   endif;    
  break;

// realiza a edição
  case 'edit':
   
   $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
   $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
   $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
   $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
   $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
   $ponto = filter_input(INPUT_POST, 'ponto', FILTER_SANITIZE_STRING);   
   $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);   

     if (atualizar($nome, $endereco, $numero, $complemento, $ponto, $bairro, $id)) :
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