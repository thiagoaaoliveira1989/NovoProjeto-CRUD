<?php
session_start();
require_once 'header.php';

?>

<div class="container ">
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Telefone</th>
      <th scope="col">Ações</th>
    </tr>
    <?php

require_once 'conectar.php';

//receber numero de paginas
$pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

//setar numero de registro por pagina
$limite_resultado = 10;

//calcular o inicio da visualização
$inicio = ($limite_resultado * $pagina) - $limite_resultado;


//selecionando dados da tabela usuario no banco de dados // o LIMIT limita o numero de registros por pagina de acordo com as variaves setadas;
$query_listar = "SELECT id, nome, email, telefone FROM usuario LIMIT $inicio, $limite_resultado";
$result_listar = $conn->prepare($query_listar);
$result_listar->execute();
 
// pega o dados do banco se o numero de linhas for diferente de 0
if(($result_listar) AND ($result_listar->rowCount()!=0)){
    //faz um foreach no array da variavel $resul_listar passando pra result_lita e depois introduz na tabela colocando sua posiçao.
    foreach($result_listar as $result_lista){
        echo "<tr>
                <th>".$result_lista['id']."</th>
                <th>".$result_lista['nome']."</th>
                <th>".$result_lista['email']."</th>
                <th>".$result_lista['telefone']."</th>
                <th>
                <a href='visualizar.php?id=$result_lista[id]'>Visualizar</a>
                <a href='editar.php?id=$result_lista[id]'>Editar</a>
                <a href='excluir.php?id=$result_lista[id]'>Excluir</a>
                </th>
                </tr>";
    }
?>
  </thead>

  
</table>
<?php
 

  //Contar a quantidade de registros no BD
  $query_quant_reg="SELECT COUNT(id) AS num_result FROM usuario";
  $result_quant_reg= $conn->prepare($query_quant_reg);
  $result_quant_reg->execute();
  $row_quant_reg = $result_quant_reg->fetch(PDO::FETCH_ASSOC);

  //quantidade de pagina de registros
  $quant_pag=ceil($row_quant_reg['num_result'] / $limite_resultado);
  
  for($i = 1; $i <= $quant_pag; $i++){
    echo " <a href='index.php?page=$i'>>$i<</a>  ";
  }

}else{
  echo "<p class='container' style='color: red;'>Error Nenhum Usuario Encontrado</p>";
}

?>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>