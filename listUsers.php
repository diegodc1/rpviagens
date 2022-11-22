<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="./styles/listarUsuarios.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <title>Usuários</title>
  <meta charset="UTF-8">

</head>
<?php
//Chamada do banco de dados
require_once('./bd/conf.php');

//Abertura de sessão
session_start();
include_once('./bd/verifyLogin.php');
include_once('./bd/verifyAccessAdm.php');


//Conferência de sessão ativa.
if (!isset($_SESSION['user_logado'])) {
  if (!$_SESSION['user_logado']) {
    header('Location: /index.php');
  }
}

//Conferência de acesso. 
if (isset($_SESSION['user_access'])) {
  if ($_SESSION['user_access'] == 0) {
    header('Location: /home.php');
  }
}

//Chamada Sidebar
require_once('./components/sidebar.php');
//Definindo valor padrão para a variável afim de evitar erros visuais se não for setado em outro momento
?>
<!-- Começo do header do Acordeon de Usuários -->
<div class="boxAccordion">
  <?php if (isset($_GET['msg'])) {
    $message = ($_GET['msg']);
    echo $message;
  }
  if (isset($_GET['filtroCargo'])){$tipodeFiltro = $_GET['filtroCargo'];}
  else {$tipodeFiltro = 'nome';}
  if (isset($_GET['filtro'])){$filtro = $_GET ['filtro'];}
  else {$filtro = '';}
  ?>

  <nav class="navbar navbar-light bg-light">

    <!-- Barra de pesquisa -->
    <form class="form-inline" method="GET" action="./listUsers.php">
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

            <!-- Filtro por Nome -->
            <div class="divFiltros">
              Nome
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="nome" checked>
              </div>

              <!--PHP do Filtro por Cargo -->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                }
              ?>
            </div>

            <hr class="dropdown-divider">

            <!-- Filtro por Cargo -->
            <div class="divFiltros">
              Cargo
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="cargo">
              </div>

              <!--PHP do Filtro por Cargo -->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                }  ?>
            </div>

            <hr class="dropdown-divider">

            <div class="divFiltros">
              Acesso
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="acesso">
              </div>

              <!--PHP do Filtro por Cargo -->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                }
               ?>
            </div>

            <hr class="dropdown-divider">

            <!-- Filtro por Setor -->
            <div class="divFiltros">
              Setor
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="setor">
              </div>

              <!--PHP do Filtro por Setor-->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                }
                 ?>
            </div>

            <hr class="dropdown-divider">

            <!-- Filtro por CPF -->
            <div class="divFiltros">
              CPF
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="cpf">
              </div>

              <!--PHP do Filtro por CPF-->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                } ?>
            </div>

            <hr class="dropdown-divider">

            <!-- Filtro por Email -->
            <div class="divFiltros">
              Email
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="email">
              </div>

              <!--PHP do Filtro por Email-->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                }?>
            </div>

            <hr class="dropdown-divider">

            <!-- Filtro por Telefone -->
            <div class="divFiltros">
              Telefone
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="telefone">
              </div>

              <!--PHP do Filtro por Telefone-->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                } ?>
            </div>

            <hr class="dropdown-divider">

            <!-- Filtro por Unidade -->
            <div class="divFiltros">
              Unidade
              <div class="divFiltrosCheckBox">
                <input id="check" type="radio" name="filtroCargo" value="unidade">
              </div>

              <!--PHP do Filtro por Unidade-->
              <?php if (isset($_GET['filtroCargo'])) {
                  $tipodeFiltro = $_GET['filtroCargo'];
                } ?>

            </div>
          </div>
        </ul>
      </div>
    </form>
  </nav>
  <?php

  //Definindo se o Valor do filtro existe ou é vazio, mesmo vazio ele executa como nome;
  if (isset($_GET['filtro'])) {
    if ($_GET != '') {
      $filtro = rtrim(ltrim($_GET['filtro']));
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
  $consultaRows = "SELECT * FROM usuarios WHERE $filtroSql";
  $conRows = $pdo->query($consultaRows) or die($pdo->error);
  $consultaRowsResult = $conRows->rowCount();
  $paginas = ceil($consultaRowsResult / $limite);
  $consulta = "SELECT * FROM usuarios WHERE $filtroSql ORDER BY nome";

  //Conferindo se foi setado um novo filtro
  if (isset($tipodeFiltro) != '') {
    $consulta = "SELECT * FROM usuarios WHERE $tipodeFiltro LIKE '%$filtro%' ORDER BY nome LIMIT $limite OFFSET $inicio";
    echo "<style>.$tipodeFiltro{ color: green; font-size:1.1em; font-weight: bold;}</style>";
  }

  //Chamada para criação da tabela de usuários captados do banco de dados
  $con = $pdo->query($consulta) or die($pdo->error);
  $result = $pdo->query($consulta);

  //Condição para checar se o Banco retornou algum resultado, se não, retorna uma mensagem de falha.
  if ($result->rowCount() < 1) {
    echo "<p class='AvisoErro'>$tipodeFiltro = <label class='TextAvisoErro'>*$filtro*</label> não foi encontrado(a) ou não existe!</p>";
  }

  //Laço de repetição com os dados coletados do banco de dados, formando o conteúdo das tabelas.
  while ($dado = $con->fetch(PDO::FETCH_ASSOC)) { ?>

    <!-- Abertura do acordeon de informações -->
    <div class="accordion " id="accordionPanelsStayOpenExample">
      <div class="accordion-item ">
        <h2 class="accordion-header " id="flush-headingTwo">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?php echo $dado['id'] ?>" aria-expanded="false" aria-controls="flush-collapseTwo">

            <!-- Nome de Usuário Cadastrado   -->
            <?php echo $dado['nome'] ?>
          </button>
        </h2>
        <div id="flush-<?php if (isset($dado['id'])) echo $dado['id'] ?>" class="<?php if (isset($_GET['ids'])) echo $_GET['ids']; ?> accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
          <div class="accordion-body">
            <table class="table">
              <!-- Cabeçalho de informaçoes fixas da lista -->
              <thead>
                <tr>
                  <th scope="col">Email</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Cargo</th>
                  <th scope="col">Setor</th>
                  <th scope="col">Unidade</th>
                  <th scope="col">Acesso</th>
                  <th scope="col" class="deleteText">Status</th>
                  <th scope="col">Perfil</th>
                </tr>
              </thead>
              <tbody>

                <!-- Formatação do corpo de informações resgatadas pelo banco -->
                <tr>
                  <td class="Email" scope="row">
                    <?php echo $dado['email']; ?>
                  </td>
                  <td class="CPF">
                    <?php echo $dado['cpf'] ?>
                  </td>
                  <td class="Telefone">
                    <?php echo $dado['telefone'] ?>
                  </td>
                  <td class="Cargo">
                    <?php echo $dado['cargo'] ?>
                  </td>
                  <td class="Setor">
                    <?php echo $dado['setor'] ?>
                  </td>
                  <td class="Unidade">
                    <?php echo $dado['unidade'] ?>
                  </td>
                  <td class="Acesso">
                    <?php if ($dado['acesso'] > 0) {
                      echo "Admin";
                    } else {
                      echo "Comum"; 
                    } ?>
                  </td>
                  <div class="iconsListUsers" style="display: flex">
                    <td class="deleteIcon">

                      <!-- Ações de usuários referente a sua conta, podendo excluir ou alterar -->
                      <div class="acoes">
                        <?php if ($dado['status'] == 'Inativo'){ ?>
                        <a href="./bd/disableUser.php?id=<?php echo $dado['id'] ?>&nome=<?php echo $dado['nome']; ?>"><i class="fa-solid size fa-toggle-off"></i></i></a>
                        <?php } else{?>
                        <a href="./bd/disableUser.php?id=<?php echo $dado['id'] ?>&nome=<?php echo $dado['nome']; ?>"><i class="fa-solid size fa-toggle-on"></i></i></a>
                        <?php }?>
                      </div>
                    </td>
                  </div>
                  <td class="Perfil">
                    <a href="./bd/changeUser.php?id=<?php echo $dado['id'] ?>"><i class="fa-solid size fa-pen-to-square"></i></a>
                  </td>
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
                                            } ?>&filtro=<?php if (isset($filtro)) {
                                                          echo $filtro;
                                                        } ?>&filtroCargo=<?php if (isset($tipodeFiltro)) {
                                                                            echo $tipodeFiltro;
                                                                          } ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina ?>&filtro=<?php if (isset($filtro)) {
                                                                                        echo $filtro;
                                                                                      } ?>&filtroCargo=<?php if (isset($tipodeFiltro)) {
                                                                                                          echo $tipodeFiltro;
                                                                                                        } ?>"><?= $pagina ?></a></li>
      <li class="page-item">
        <a class="page-link" href="?pagina=<?php if ($pagina < $paginas) {
                                              echo $pagina + 1;
                                            } else if ($pagina == $paginas) {
                                              echo $pagina;
                                            } else {
                                              echo $pagina = 1;
                                            } ?>&filtro=<?php if (isset($filtro)) {
                                                          echo $filtro;
                                                        } ?>&filtroCargo=<?php if (isset($tipodeFiltro)) {
                                                                            echo $tipodeFiltro;
                                                                          } ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      <span class="paginas"><?php echo $pagina . " / " . $paginas ?></span>
    </ul>
  </nav>
  <!-- Função para resetar a URL após exclusão de usuários -->
  <script>
      window.history.pushState("", "", "../listUsers.php");
  </script>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>