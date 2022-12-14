<?php
// CONSTANTES 
define('HOST', 'localhost');
define('USER','root');
define('PASS', 'root');
define('DB', 'grafico');

// FUNCAO DE CONEXAO

function conecta() {   
    $dns = "mysql:host=" . HOST . ";dbname=" . DB;
    try {
        $conn = new PDO($dns, USER, PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
        
    } catch(PDOException $erro) {  
        echo $erro->getMessage();
    }
    
}