<?php
require_once 'conectar.php';


    // sql to create table
    $sql = "CREATE TABLE usuario (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        telefone VARCHAR(30) NOT NULL
        )";
     
     if($conn->exec($sql)){
         echo 'Tabela criada Com Sucesso';
     }else{
         echo 'Error ao criar tabela';
     }


    



?>