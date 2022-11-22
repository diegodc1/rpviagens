<?php
if (isset($_SESSION['user_name']) && isset($_SESSION['user_cargo'])) {
  $userName = $_SESSION['user_name'];
  $userCargo = $_SESSION['user_cargo'];
  $userImg = $_SESSION['user_img'];
}

if (isset($_SESSION['user_access'])) {
  if ($_SESSION['user_access'] == 1) {
    echo "<style> .admin-access {display:flex !important}</style>";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar</title>

  <!-- Styles -->
  <link rel="stylesheet" href="/styles/sidebar.css" />
  <link rel="stylesheet" href="/styles/style.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="shortcut icon" href="/assets/imgs/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/assets/imgs/favicon.ico" type="image/x-icon">
</head>

<body>

  <div class="overlay close none"></div>
  <aside class="close">
    <div class="header-sidebar">
      <img src="/assets/imgs/logo.png" alt="" id="logo" />
      <i class="icon-sidebar fa-solid fa-bars" onclick="sidebar()"></i>
      <!-- <i class="fa-solid fa-x"></i> -->
    </div>

    <div class="menu-sections close">
      <a href="/home.php" class="sections" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
        <i class="fa-solid fa-house"></i>
        <span>Home</span>
      </a>

      <div class="line"></div>


      <a href="/cadUsers.php" class="sections cad-user-link admin-access" data-bs-toggle="tooltip" data-bs-placement="right" title="Cadastrar Usuário">
        <i class=" fa-solid fa-user-plus"></i>
        <span>Cadastrar Usuário</span>
      </a>




      <a href="/cadViagens.php" class="sections admin-access" data-bs-toggle="tooltip" data-bs-placement="right" title="Cadastrar Viagem">
        <i class="fa-solid fa-map-location-dot "></i>
        <span>Cadastrar Viagem</span>
      </a>

      <a href="/listUsers.php" class="sections admin-access" data-bs-toggle="tooltip" data-bs-placement="right" title="Usuários">
        <i class="fa-solid fa-users admin-access"></i>
        <span>Usuários Cadastrados</span>
      </a>
      <a href="/listTravels.php" class="sections admin-access" data-bs-toggle="tooltip" data-bs-placement="right" title="Viagens Cadastradas">
        <i class="fa-solid fa-ticket"></i>
        <span>Viagens Cadastradas</span>
      </a>

      <a href="/perfil.php" class="sections" data-bs-toggle="tooltip" data-bs-placement="right" title="Perfil">
        <i class="fa-solid fa-user-gear"></i>
        <span>Editar Perfil</span>
      </a>
    </div>
    <div class="footer-sidebar close">
      <div class="info-user">
        <img src="<?php echo $userImg?>" alt="Foto do usuário" width="100px" id="user-photo" />
        <div class="text-info">
          <span id="user-name"><?php echo $userName ?></span>
          <p id="user-office"><?php echo $userCargo ?></p>
        </div>
      </div>

      <div class="log-out" id="log-out">
        <a href="/bd/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
      </div>
    </div>
  </aside>
  <script src="/js/sidebar.js"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>

</html>