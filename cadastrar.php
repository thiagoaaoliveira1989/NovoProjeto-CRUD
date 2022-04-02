<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="body">


<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img/logos/usuario.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
      Cadastro de Usuários
    </a>
    <a class="navbar-brand" href="#">Cadastrar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
<form name="cad-usuario" method="POST" action="enviar-cadastrar.php">
<div class="mb-3">
    <label  class="form-label">Nome</label>
    <input name="nome"  type="text" class="form-control" id="nome" value="<?php if(isset($dados['nome'])){
        echo $dados['nome'];
    } ?>" >
   
  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="email" value="<?php if(isset($dados['email'])){
        echo $dados['email'];
    } ?>"  >
    
  </div>
  <div class="mb-3">
    <label  class="form-label">Telefone</label>
    <input type="text" name="telefone" class="form-control" id="telefone" value="<?php if(isset($dados['telefone'])){
        echo $dados['telefone'];
    } ?>"  >
  </div>
 
  <input name='cadUsuario' type="submit" class="btn btn-primary"></input>
</form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>