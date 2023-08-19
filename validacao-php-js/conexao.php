<?php

// Inicio da conexão com o banco de dados utilizando PDO
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'form-contato';
$port = 3306;

// Verificando se a conexão foi bem sucedida
try {

    // Realizando a conexão com porta
    // $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

    // Realizando a conexão sem porta
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

    // echo "Sucesso: Conexão com o banco realizado com sucesso.";
    
} catch (PDOException $err) {
    echo "Erro: Conexão com o banco de dados não realizado com sucesso. Erro gerado " . $err->getMessage();
}

?>