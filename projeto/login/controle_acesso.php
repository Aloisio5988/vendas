<?php
session_start();
require '../funcoes/banco/conexao.php';
require '../funcoes/login/login.php';
require '../funcoes/crud/crud.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

   $login = $_POST['login'];
   $senha = $_POST['senha'];
   
      //cria a sessao
      //$_SESSION['usuarios'] = $registro['nome_completo'];
      $dados = pegaLogin($login);

      if (empty($login) || empty($senha)) :
         echo 'vazio';
      elseif (!$dados) :
         echo 'naoexiste';
      elseif ($dados->senha != $senha) :
         echo 'diferentesenha';
      elseif ($dados->nivel_id = 1) :
         echo 'nivel';
         $_SESSION['nome'] =  $dados->nome_completo;
         $_SESSION['id'] =  $dados->id;
      endif;
      
     