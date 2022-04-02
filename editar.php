<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="body">


    <?php
session_start();
ob_start();
require_once 'conectar.php';


$id =   filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
    $_SESSION['msg'] = "<p class='' style='color: red;'>Usuario não encontrado!</p>";
    header("Location: index.php");
    exit();
}

$query_usuario = "SELECT id, nome, email, telefone FROM usuario WHERE id = $id LIMIT 1";
$result_usuario= $conn->prepare($query_usuario);
$result_usuario->execute();

if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
} else{
    $_SESSION['msg'] = "<p class='' style='color: red;'>Usuario não encontrado!</p>";
    header("Location: index.php");
    exit();
}



$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($dados['atualizar_usuario'])){
    $empty_input =false;
    //retirar espaços no começo e no final
$dados = array_map('trim', $dados); 

if(in_array("", $dados)){
    $empty_input = true;
    echo "<p class='container' style='color: red;'>Error preecha todos os campos</p>";
  
}elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
    $empty_input = true;
    echo "<p class='container' style='color: red;'>Preencha um email válido</p>";
   
}

if(!$empty_input){
    $query_update = "UPDATE usuario SET nome=:nome, email=:email, telefone=:telefone WHERE id=:id";
$result_update= $conn->prepare($query_update);
$result_update->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
$result_update->bindParam(':email', $dados['email'], PDO::PARAM_STR);
$result_update->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
$result_update->bindParam(':id', $id, PDO::PARAM_INT);
if($result_update->execute()){
    echo "<p class='' style='color: green;'>Usuario atualizado com Sucesso!</p>";
    header("Location: index.php");
 
}else{
    echo "<p class='' style='color: green;'>Error: Usuario Não atualizado!</p>";
    header("Location: index.php");
}
}

}
 
?>


    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logos/usuario.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Editar Usuários
            </a>
            <a class="navbar-brand" href="#">Editar Cadastro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastrar.php">Cadastrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <form name="cad-usuario" method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input name="nome" type="text" class="form-control" id="nome" value="<?php if(isset($row_usuario['nome'])){
        echo $row_usuario['nome'];
    } ?>">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php if(isset($row_usuario['email'])){
        echo $row_usuario['email'];
    } ?>">

                </div>
                <div class="mb-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="telefone" class="form-control" id="telefone" value="<?php if(isset($row_usuario['telefone'])){
        echo $row_usuario['telefone'];
    } ?>">
                </div>

                <input name='atualizar_usuario' type="submit" class="btn btn-primary" value="Atualizar"></input>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>