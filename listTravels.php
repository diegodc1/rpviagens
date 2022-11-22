<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="./styles/listarUsuarios.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <title>Viagens</title>
</head>
<?php
//Chamada do banco de dados
require_once('./bd/conf.php');

//Abertura de sessão
session_start();

//Conferência de sessão ativa.
include_once('./bd/verifyLogin.php');
include_once('./bd/verifyAccessAdm.php');

//Conferência de acesso. 
if (isset($_SESSION['user_access'])) {
  if ($_SESSION['user_access'] == 0) {
    header('Location: /home.php');
  }
}
//Chamada Sidebar
require_once('./components/sidebar.php');
//Definindo valor padrão para a variável afim de evitar erros visuais se não for setado em outro momento
$tipodeFiltro = 'titulo';
//msg
?>
<!-- Começo do header do Acordeon de Usuários -->
<div class="boxAccordion">
  <?php if (isset($_GET['msg'])) {
    $message = ($_GET['msg']);
    echo $message;
  }  ?>

  <nav class="navbar navbar-light bg-light">

    <!-- Barra de pesquisa -->
    <form class="form-inline" method="GET" action="./listTravels.php">
      <input class="form-control mr-sm-2" type="search" placeholder="Filtrado por ..." aria-label="Pesquisar" name="filtro" value="">
      <div class="btn-group dropend">

        <!-- Botão de Pesquisa -->
        <button class="btn btn-outline-success my-2 my-sm-0"><i class="fa-solid fa-magnifying-glass"></i></button>

        <!-- Botão de Filtro -->
        <button type="button" class="btn btn-secondary dropdown-toggle-split border-radius" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-filter"></i>
        </button>
        <!-- Começo da Lista de Usuários -->
        <ul class="dropdown-menu">
          <div class="FiltrosBox">

            <!-- Filtro por Cargo -->
            <div class="divFiltros">
            Cliente	
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroViagem" <?php if (isset($tipoFiltro)){ if($tipoFiltro == 'nome_cliente'){echo 'selected'; } } ?> value="nome_cliente">
              </div>
            </div>
            <div class="divFiltros">
            Data	
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroViagem" <?php if (isset($tipoFiltro)){ if($tipoFiltro == 'data_viagem'){echo 'selected'; } } ?> value="data_viagem">
              </div>
            </div>
            <div class="divFiltros">
            Destino	
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroViagem" <?php if (isset($tipoFiltro)){ if($tipoFiltro == 'cidade_destino'){echo 'selected'; } } ?> value="cidade_destino">
              </div>
            </div>
            <div class="divFiltros">
            Hotel
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroViagem" <?php if (isset($tipoFiltro)){ if($tipoFiltro == 'nome_hotel'){echo 'selected'; } } ?> value="nome_hotel">
              </div>
            </div>
            <div class="divFiltros">
            Status	
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroViagem" <?php if (isset($tipoFiltro)){ if($tipoFiltro == 'status_viagem'){echo 'selected'; } } ?> value="status_viagem">
              </div>
            </div>
        </ul>
      </div>
    </form>
  </nav>
  <?php

  //Definindo se o Valor do filtro existe ou é vazio, mesmo vazio ele executa como nome;
  $filtro = '';
  if (isset($_GET['filtro'])) {
    if ($_GET != '') {
      $filtro = rtrim(ltrim($_GET['filtro']));
    }
  }
  $tipodeFiltro = 'titulo';
  if (isset($_GET['filtroViagem'])) {
    if ($_GET != '') {
      $tipodeFiltro = $_GET['filtroViagem'];
    }
  }
  

  //Definindo os valores assumidos pelo filtro e passando variável para o Select
  $filtroSql = "$tipodeFiltro LIKE '%$filtro%'";
  $pagina = 1;
  if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT);
  }
  if (!$pagina) {
    $pagina = 1;
  }
  $limite = 17;
  $inicio = ($pagina * $limite) - $limite;
  $consultaRows = "SELECT * FROM viagens WHERE $filtroSql";
  $conRows = $pdo->query($consultaRows) or die($pdo->error);
  $consultaRowsResult = $conRows->rowCount();
  $paginas = ceil($consultaRowsResult / $limite);
  $consulta = "SELECT * FROM viagens WHERE $filtroSql";

  //Conferindo se foi setado um novo filtro
  if (isset($tipodeFiltro) != '') {
    $consulta = "SELECT * FROM viagens WHERE $tipodeFiltro LIKE '%$filtro%' ORDER BY titulo LIMIT $limite OFFSET $inicio";
    echo "<style>.$tipodeFiltro{ color: green; font-size:1.1em; font-weight: bold;}</style>";
  }

  //Chamada para criação da tabela de usuários captados do banco de dados
  $con = $pdo->query($consulta) or die($pdo->error);
  $result = $pdo->query($consulta);

  //Condição para checar se o Banco retornou algum resultado, se não, retorna uma mensagem de falha.
  if ($result->rowCount() < 1) {
    echo "<p class='AvisoErro'>$tipodeFiltro <label class='TextAvisoErro'>*$filtro*</label> não foi encontrado(a) ou não existe!</p>";
  }

  //Laço de repetição com os dados coletados do banco de dados, formando o conteúdo das tabelas.

  $dados = $con->fetchAll();
  foreach ($dados as $dado) {
  ?>
    <!-- Abertura do acordeon de informações -->
    <div class="accordion " id="accordionPanelsStayOpenExample">
      <div class="accordion-item <?php if($dado['status_viagem'] == 'Desativada'){echo "desativada";
        } else {echo "ativada";}?>">
        <h2 class="accordion-header " id="flush-headingTwo">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?php echo $dado['viagem_id'] ?>" aria-expanded="false" aria-controls="flush-collapseTwo">

            <!-- Nome de Usuário Cadastrado   -->
            <?php echo $dado['titulo'] ?>
          </button>
        </h2>
        <div id="flush-<?php if (isset($dado['viagem_id'])) echo $dado['viagem_id'] ?>" class="<?php if (isset($_GET['ids'])) echo $_GET['ids']; ?> accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
          <div class="accordion-body">
            <table class="table">
              <!-- Cabeçalho de informaçoes fixas da lista -->
              <thead>
                <tr>
                  <th scope="col">Nome Cliente</th>
                  <th scope="col">Data</th>
                  <th scope="col">Motivo</th>
                  <th scope="col">Destino</th>
                  <th scope="col">Hotel</th>
                  <th scope="col">Status</th>
                  <th scope="col" class="deleteText">Ações</th>
                </tr>
              </thead>
              <tbody>

                <!-- Formatação do corpo de informações resgatadas pelo banco -->
                <tr>
                  <td class="Cliente" scope="row">
                    <?php echo $dado['nome_cliente']; ?>
                  </td>
                  <td class="Data">
                    <?php echo $dado['data_viagem'] ?>
                  </td>
                  <td class="Motivo">
                    <?php echo $dado['motivo_viagem'] ?>
                  </td>
                  <td class="Destino">
                    <?php echo $dado['cidade_destino'] ?>
                  </td>
                  <td class="Hotel">
                    <?php echo $dado['nome_hotel'] ?>
                  </td>
                  <td class="Hotel">
                    <?php echo $dado['status_viagem'] ?>
                  </td>
                  <div class="iconsListUsers" style="display: flex">
                    <td class="deleteIcon">

                      <!-- Ações de usuários referente a sua conta, podendo excluir ou alterar -->
                      <div class="acoes">
                        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Editar" href="/editTravel.php?id=<?php echo $dado['viagem_id'] ?>">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Visualizar" href="./viagem.php?id=<?php echo $dado['viagem_id'] ?>">
                          <i class="fa-solid fa-circle-info"></i>
                        </a>

                        <?php
                          if($dado['status_viagem'] == 'Ativo') { ?>
                            <a data-bs-toggle="tooltip" data-bs-placement="right" title="Desativar" href="./bd/disableTravel.php?id=<?php echo $dado['viagem_id'] ?>&nome=<?php echo $dado['titulo'];?>" class="disable-icon"><i class="fa-solid fa-plane-slash"></i></a>
                        <?php } else { ?>
                            <a data-bs-toggle="tooltip" data-bs-placement="right" title="Ativar" href="./bd/ActiveTravel.php?id=<?php echo $dado['viagem_id'] ?>&nome=<?php echo $dado['titulo'];?>"class="disable-icon"><i class="fa-solid fa-plane-circle-check"></i></a>
                        <?php } ?>

                      
                      </div>

                  </div>
                  </td>
          </div>
          </tr>
          </tbody>
          </table>
        </div>
      </div>
    </div>
</div>



<?php }
?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="?pagina=<?php if ($pagina > 1) {
                                            echo $pagina - 1;
                                          } else {
                                            echo $pagina = 1;
                                          } ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina ?>"><?= $pagina ?></a></li>
    <li class="page-item">
      <a class="page-link" href="?pagina=<?php if ($pagina < $paginas) {
                                            echo $pagina + 1;
                                          } else if ($pagina = $paginas);
                                          else {
                                            echo $pagina = 1;
                                          } ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <span class="paginas"><?php echo $pagina . " / " . $paginas ?></span>
  </ul>
</nav>
<!-- Função para resetar a URL após exclusão de usuários -->
<script>
  window.history.pushState("", "", "../listTravels.php");
</script>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>