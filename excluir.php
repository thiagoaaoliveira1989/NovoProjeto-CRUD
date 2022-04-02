<?php
session_start();
ob_start();
require_once 'conectar.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
var_dump($id);

if(empty($id)){
    $_SESSION['msg'] = "<p class='' style='color: red;'>Usuario não encontrado!</p>";
    header("Location: index.php");
    exit();
}

$query_usuario="SELECT id FROM usuario WHERE id = $id LIMIT 1";
$result_usuario=$conn->prepare($query_usuario);
$result_usuario->execute();


if(($result_usuario) AND ($result_usuario->rowCount()!=0)){
    $query_del_usuario="DELETE FROM usuario WHERE id=$id";
    $apagar_usuario=$conn->prepare($query_del_usuario);
    
    if($apagar_usuario->execute()){
        $_SESSION['msg'] = "<p class='' style='color: green;'>Usuario apagado com Sucesso!</p>";
        header("Location: index.php");
    }else{
        $_SESSION['msg'] = "<p class='' style='color: red;'>Usuario não apagado!</p>";
    header("Location: index.php");
    }


}else{
    $_SESSION['msg'] = "<p class='' style='color: red;'>Usuario não encontrado!</p>";
    header("Location: index.php");
    exit();
}

?>