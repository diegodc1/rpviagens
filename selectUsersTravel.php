<?php
session_start();
include_once('./bd/verifyLogin.php');
include_once('./bd/verifyAccessAdm.php');



$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];
$userCpf = $_SESSION['user_cpf'];
$userName = $_SESSION['user_name'];
$userPhone = $_SESSION['user_phone'];

if (!isset($_SESSION['user_logado'])) {
  if (!$_SESSION['user_logado']) {
    header('Location: /index.php');
  }
}

?>

<?php

require_once('./components/sidebar.php');
require_once('./bd/conf.php');

$sql = $pdo->prepare("SELECT * FROM usuarios WHERE status = 'Ativo' ORDER BY nome");
$sql->execute();

if($sql->rowCount() > 0) {
  $data = $sql->fetchAll();
}

?>

<head>
  <title>Selecionar os usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="./styles/selectUsers.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>

<body>
  <main>
    <h2 class="title-list">Selecione os usuários:</h2>
    <form action="/bd/addUserToTravel.php" method="POST">
      <table class="table table-select-users table align-middle" id="listSelectUsers">
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Email</th>
                  <th scope="col">Cargo</th>
                  <th scope="col">Setor</th>
                  <th scope="col">Unidade</th>
                  <th scope="col ">Selecionar</th>
                </tr>
              </thead>
              <tbody class="table-striped">
                <?php 
                  foreach($data as $user) { ?>
                    <tr>
                      <td scope="row" class="td-nome"> <?php echo $user['nome'] ?></td>
                      <td scope="row" class="td-email"><?php echo $user['email'] ?></td>
                      <td class="td-cargo"><?php echo $user['cargo'] ?></td>
                      <td class="td-setor"><?php echo $user['setor'] ?></td>
                      <td class="td-unidade"><?php echo $user['unidade'] ?></td>
                      <td class="deleteIcon td-select"> <input type="checkbox" class="check-box-user" name="selectedUsers[]" value="<?= $user['id'] ?>"></td>
                    </tr>
                  <?php }
                ?>
              </tbody>
          </table>
          <div class="button-box">     
            <input type="submit" value="Finalizar" class="btn btn-primary select-users-button">
          </div>
    </form>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="/js/datatable.js"></script>
</body>