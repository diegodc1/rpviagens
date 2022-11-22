<!DOCTYPE html>
<html lang="pt_br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Viagem</title>
  <link rel="stylesheet" href="./styles/viagem.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>


<?php
session_start();
include_once('./bd/verifyLogin.php');


if (!isset($_SESSION['user_logado'])) {
  if (!$_SESSION['user_logado']) {
    header('Location: /index.php');
  }
}

require_once('./components/sidebar.php');
require_once('./bd/conf.php');
$idUser = $_SESSION['user_id'];
$idViagem = $_GET['id'];
if (isset($_GET['msg'])){$msg = $_GET['msg'];}
$consulta = "SELECT * FROM usuario_viagem LEFT JOIN usuarios ON usuarios.id = usuario_viagem.fk_id_usuario
         LEFT JOIN viagens ON viagens.viagem_id = usuario_viagem.fk_id_viagem WHERE  viagem_id = '$idViagem'";
$con = $pdo->query($consulta) or die($pdo->error);
$dado = $con->fetch(PDO::FETCH_ASSOC);


$sql = $pdo->prepare("SELECT * FROM comentarios LEFT JOIN usuarios ON usuarios.id = comentarios.user_id_fk WHERE viagem_id_fk = :idViagem ORDER BY id_comentario DESC");
$sql->bindValue(':idViagem', $idViagem);
$sql->execute();

if ($sql->rowCount() > 0) {
  $comments = $sql->fetchAll(PDO::FETCH_ASSOC);
  $_SESSION['comentario_vazio'] = false;
} else {
  $_SESSION['comentario_vazio'] = true;
  echo "<style> .view-modal{display: none};</style>";
}

?>

<body>
  <div class="m-4 box-abas shadow">

    <!-- Tabs title -->
    <ul class="nav nav-tabs" id="myTab">
      <li class="nav-item">
        <a href="#info" class="nav-link <?php if (empty($_GET['pg'])) {
                                          echo 'active';
                                        } ?>" data-bs-toggle="tab">Informações</a>
      </li>
      <li class="nav-item">
        <a href="#host" class="nav-link" data-bs-toggle="tab">Hospedagem</a>
      </li>
      <li class="nav-item">
        <a href="#notes" class="nav-link <?php if (isset($_GET['pg'])) {
                                            if ($_GET['pg'] == 'notas') {
                                              echo 'active';
                                            }
                                          } ?>" data-bs-toggle="tab">Notas</a>
      </li>
      <li class="nav-item">
        <a href="#comments" class="nav-link <?php if (isset($_GET['pg'])) {
                                              if ($_GET['pg'] == 'comentarios') {
                                                echo 'active';
                                              }
                                            } ?>" data-bs-toggle="tab">Comentários</a>
      </li>
    </ul>

    <div class="tab-content">
      <!-- Tab 1 -->
      <div class="tab-pane fade <?php if (empty($_GET['pg'])) {
                                  echo 'active' . ' show';
                                } ?>" id="info">
        <h4><?php echo $dado['titulo'] ?></h4>
        <div class="box-in-aba">
          <?php if ($dado['status_viagem'] == 'Desativada') {
            echo "<style> 
                      input, .button-add-note{pointer-events:none; opacity: 0.8};
                      .textarea{pointer-events:none; opacity: 0.8};
                      select{user-select: none; opacity: 0.8};
                    </style>";
          } ?>

          <div class="area1">
            <div class="item-area">
              <p><span> <i class="fa-solid fa-building"></i>Nome cliente: </span><?php echo $dado['nome_cliente'] ?></p>
            </div>
            <div class="item-area">
              <p><span><i class="fa-sharp fa-solid fa-circle-info"></i>Motivo viagem: </span> <?php echo $dado['motivo_viagem'] ?></p>
            </div>

            <div class="item-area">
              <p><span><i class="fa-solid fa-location-dot"></i>Cidade de destino </span><?php echo $dado['cidade_destino'] ?></p>
            </div>
            <div class="item-area">
              <p><span><i class="fa-solid fa-road"></i>Distância: </span>230km</p>
            </div>
          </div>

          <div class="area2">
            <div class="item-area">
              <p><span> <i class="fa-solid fa-calendar-days"></i>Data:</span> <?php echo $dado['data_viagem'] ?></p>
            </div>
            <div class="item-area">
              <p><span> <i class="fa-solid fa-money-bill-1-wave"></i>Valor diária:</span> <?php echo $dado['valor_diaria'] ?></p>
            </div>
            <div class="item-area">
              <span> <i class="fa-sharp fa-solid fa-users"></i>Funcionários:</span>
              <div class="nomes">
                <?php
                $viagemId = $dado['viagem_id'];
                $consultaNomes = "SELECT * FROM usuario_viagem
                  LEFT JOIN usuarios ON usuarios.id = usuario_viagem.fk_id_usuario
                  LEFT JOIN viagens ON viagens.viagem_id = usuario_viagem.fk_id_viagem
                  WHERE usuario_viagem.fk_id_viagem = '$viagemId'";
                $conNomes = $pdo->query($consultaNomes) or die($pdo->error);
                while ($dadoNomes = $conNomes->fetch(PDO::FETCH_ASSOC)) { ?>
                  <p><?php echo $dadoNomes['nome']; ?></p>
                <?php } ?>
              </div>
            </div>

            <div class="item-area">
              <p><span><i class="fa-solid fa-car"></i>Tipo de locomoção: </span><?php echo $dado['locomocao'] ?></p>
            </div>
          </div>
          <div class="area3">
            <img src="./assets/imgs/logoViagem.svg" style="height: 100%;" alt="">
          </div>
        </div>
      </div>

      <!-- Tab 3 -->
      <div class="tab-pane fade" id="host">
        <h4><?php echo $dado['titulo'] ?></h4>
        <div class="box-in-aba3">

          <div class="area1">
            <div class="item-area">
              <p><span> <i class="fa-solid fa-hotel"></i>Nome hotel: </span><?php echo $dado['nome_hotel'] ?></p>
            </div>
            <div class="item-area">
              <p><span><i class="fa-solid fa-location-dot"></i> Endereço Hotel: </span> <?php echo $dado['endereco_hotel'] ?></p>
            </div>

          </div>

          <div class="area2">
            <div class="item-area">
              <p><span><i class="fa-solid fa-calendar"></i> Check-in: </span> <?php echo $dado['data_checkin'] ?> </p>
            </div>
            <div class="item-area">
              <p><span><i class="fa-solid fa-calendar"></i> Check-out: </span> <?php echo $dado['data_checkout'] ?> </p>
            </div>
          </div>

          <div class="area3">
            <img src="./assets/imgs/logoViagem.svg" style="height: 100%;" alt="">
          </div>
        </div>
      </div>

      <!-- Tab 4 -->
      <div class="tab-pane fade <?php if (isset($_GET['pg'])) {
                                  if ($_GET['pg'] == 'notas') {
                                    echo 'active ' . 'show';
                                  }
                                } ?>" id="notes">
        <h4><?php echo $dado['titulo'] ?></h4>
        <div class="box-in-aba4">

          <div class="area1-notes">
            <h3>ADICIONAR NOTA</h3>

            <form class="row" method="post" action="./bd/addNote.php?id=<?php echo $viagemId ?>" enctype="multipart/form-data">
              <div class="col-md-6">
                <label class="form-label">Titulo:</label>
                <input required name="tituloNota" type="text" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Categoria:</label>
                <select id="categoriaNota" name="categoriaNota" class="form-select">
                  <option value="Alimentação">Alimentação</option>
                  <option value="Hotel">Hotel</option>
                  <option value="Passagem">Passagem</option>
                  <option value="Reparos">Reparos</option>
                  <option value="Outros">Outros...</option>
                </select>
              </div>

              <div class="col-md-6 mt-3">
                <?php date_default_timezone_set('America/Sao_Paulo');
                $data = date('Y-m-d'); ?>
                <label class="form-label">Data:</label>
                <input required name="dataNota" type="date" class="form-control" value="<?php echo $data ?>">
              </div>
              <div class="col-md-6 m mt-3">
                <label class="form-label">Valor:</label>
                <input required name="valorNota" type="number" step="0.01" name="quantity" min="0.01" class="form-control">
              </div>

              <div class="col-md-12 mt-3">
                <label class="form-label">Nota fiscal:</label>
                <input required name="nota" type="file" class="form-control">
              </div>

              <div class="col-md-4">
                <br>
                <button class="btn btn-primary form-control button-add-note">Adicionar nota</button>
              </div>
            </form>
          </div>
          <div class="area2 notes notas">
            <h3>NOTAS ADICIONADAS</h3>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Por</th>
                  <th scope="col">Título</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Data</th>
                  <th scope="col">Valor</th>
                  <th scope="col">Nota</th>
                  <?php if($dado['status_viagem'] == 'Ativo') {?>
                  <th scope="col" class="center">Excluir</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $viagemId = $dado['viagem_id'];
                $consultaNotas = "SELECT * FROM notas LEFT JOIN usuarios ON notas.fk_usuario_id = usuarios.id WHERE fk_viagem_id  = $viagemId ORDER BY id_notas DESC";
                $conNotas = $pdo->query($consultaNotas) or die($pdo->error);
                while ($dadoNotas = $conNotas->fetch(PDO::FETCH_ASSOC)) { ?>

                  <tr>
                    <td><?php if (isset($dadoNotas['nome'])) {
                          echo $dadoNotas['nome'];
                        } ?></td>
                    <td><?php if (isset($dadoNotas['titulo_notas'])) {
                          echo $dadoNotas['titulo_notas'];
                        } ?></td>
                    <td><?php if (isset($dadoNotas['categoria_notas'])) {
                          echo $dadoNotas['categoria_notas'];
                        } ?></td>
                    <td><?php if (isset($dadoNotas['data_notas'])) {
                          echo $dadoNotas['data_notas'];
                        } ?></td>
                    <td><?php if (isset($dadoNotas['valor_notas'])) {
                          echo 'R$ ' . $dadoNotas['valor_notas'];
                        } ?></td>
                    <td><a href="<?php if (isset($dadoNotas['path_notas'])) {
                                    echo $dadoNotas['path_notas'];
                                  } ?>" target="_blank" class="view-img">Ver arquivo</a></td>
                                  <?php if($dado['status_viagem'] == 'Ativo') {?>
                    <td id="deleteNota" class="center"><a class="center" href="./bd/deleteNote.php?id=<?php echo $viagemId ?>&idNota=<?php echo $dadoNotas['id_notas'] ?>&nome=<?php echo $dadoNotas['titulo_notas'] ?>" class="view-img"><i class="fa-solid center fa-trash"></i></a></td>
                                  <?php } ?>
                  </tr>
              </tbody>
            <?php } ?>
            </table>
          </div>
        </div>
      </div>
      <!-- Tab 5 -->
      <div class="tab-pane fade <?php if (isset($_GET['pg'])) {
                                  if ($_GET['pg'] == 'comentarios') {
                                    echo 'active ' . 'show';
                                  }
                                } ?>" id="comments">
        <h4><?php echo $dado['titulo'] ?></h4>
        <div class="box-in-aba5">
          <div class="area1 comments">
            <h3>Adicionar Comentário</h3>
            <form action="bd/addComment.php?idViagem= <?= $idViagem ?>" method="POST">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Título:</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="inputTitleComment" placeholder="Ex.: Acidente no percurso" required>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Escreva seu comentário:</label>
                <textarea class="form-control textarea" id="exampleFormControlTextarea1" rows="3" name="inputTextComment" required></textarea>
              </div>

              <input type="submit" value="Adicionar Comentário" class="btn btn-primary form-control submit-comment-button">
            </form>
          </div>

          <div class="area2  comments">
            <h3>Comentários adicionados</h3>

            <?php
            if ($sql->rowCount() > 0) {
              echo "<p class='comment-message'>Foi adicionado " . $sql->rowCount() . " comentário(s).</p>";
            } else {
              echo "Nenhum comentário foi adicionado.";
            }
            ?>


            <button type="button" class="view-modal btn btn-primary " data-bs-toggle="modal" data-bs-target="#static2">
              Visualizar comentários
            </button>

            <!-- Modal -->
            <div class="modal fade" id="static2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Comentários da Viagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php
                    if ($_SESSION['comentario_vazio'] === false) {
                      foreach ($comments as $comment) { ?>
                        <div class="box-text-modal">
                          <h3 class="title-comment-modal"><?= $comment['titulo_comentario'] ?></h3>
                          <p class="name-comment-modal"> Comentado por: <?= $comment['nome'] ?> </p>
                          <p class="text-comment-modal"><?= $comment['texto_comentario'] ?></p>
                        </div> <?php }
                            } else { ?>
                      <div class="box-text-modal">
                        <h5>Nenhum comentário foi adicionado</h5>
                      </div> <?php
                            }
                            unset($_SESSION['comentario_vazio']);
                              ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if(isset($msg)){echo $msg;} ?>
</body>
<script>
  window.history.pushState("", "", "/viagem.php?id=<?php echo $idViagem ?>");

  function formatar(mascara, documento) {
    var i = documento.value.length;
    var saida = mascara.substring(0, 1);
    var texto = mascara.substring(i)

    if (texto.substring(0, 1) != saida) {
      documento.value += texto.substring(0, 1);
    }

  }
</script>

</html>