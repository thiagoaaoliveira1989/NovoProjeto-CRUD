<?php
require_once 'conectar.php';

//pega os dados do input do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//verificar se o usuario clicou no botao
if(!empty($dados['cadUsuario'])){
    $empty_input =false;
    //retirar espaços no começo e no final
$dados = array_map('trim', $dados); 

if(in_array("", $dados)){
    $empty_input = true;
    echo "<p class='container' style='color: red;'>Error preecha todos os campos</p>";
    require_once 'cadastrar.php';  
}elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
    $empty_input = true;
    echo "<p class='container' style='color: red;'>Preencha um email válido</p>";
    require_once 'cadastrar.php';  
}

if(!$empty_input){
    $query_usuario = "INSERT INTO usuario (nome, email, telefone) VALUES (:nome,:email,:telefone)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['nome'] , PDO::PARAM_STR);
    $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $cad_usuario->bindParam(':telefone', $dados['telefone']);
    $cad_usuario->execute();
    
    if($cad_usuario->rowCount()){
        echo "<p class='container' style='color: green;'>Usuario Cadastrado com Sucesso</p>";
        unset($dados); // apaga dados da tabela cadastrar quando cadastrado com sucesso.
        require_once 'index.php';
    }else{
        echo "<p class='container'  style='color: red;'>Error ao Cadastrado usuario</p>";
        require_once 'cadastrar.php';   
    }
}



}

?>