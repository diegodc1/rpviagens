<?php
session_start();
// if(isset($_SESSION['user_logado']) === false) {
//   header('Location: /perfil.php');
// }
// include_once('./bd/verifyLogin.php');



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faça seu login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./styles/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <main>
    <div class="box1">
      <img src="assets/imgs/logoRp.png" alt="">
    </div>

    <div class="box2">
      <h1>Login</h1>

      <form action="./bd/loginUser.php" method="POST">
        <div class="input-box-1">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" id="userEmail" name="userEmail" placeholder="Email" required>
        </div>

        <div class="input-box-2">
          <i class="fa-solid fa-lock"></i>
          <input type="password" id="userPassword" name="userPassword" placeholder="Senha" required>
        </div>

        <div class="messages">
          <?php
          if (isset($_SESSION['erro_message'])) {
            if ($_SESSION['erro_message']) {
              echo "<style> .aviso{display: flex} </style>";
              echo "<style> .input-box-1{border: 2px solid #F63A3A} </style>";
              echo "<style> .input-box-2{border: 2px solid #F63A3A} </style>";
              session_unset();
            } else {
              echo "<style> .aviso{display: none} </style>";
            }
          }
          ?>
          <p class="aviso">Email ou senha incorreto!</p>
          <span><a href="esqSenha.php">Não lembro minha senha</a></span>
        </div>

        <input type="submit" value="Entrar" class="submit-button">
      </form>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>

</html>