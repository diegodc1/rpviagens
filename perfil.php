<?php
session_start();
include('bd/conf.php');
include_once('./bd/verifyLogin.php');
$lastId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];
$userCpf = $_SESSION['user_cpf'];
$userName = $_SESSION['user_name'];
$userPhone = $_SESSION['user_phone'];
$userImg = $_SESSION['user_img'];
$status = filter_input(INPUT_GET, 'status');


if (!isset($_SESSION['user_logado'])) {
  if (!$_SESSION['user_logado']) {
    header('Location: /index.php');
  }
}

?>

<head>
  <link rel="stylesheet" href="/styles/perfil.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Meu Perfil</title>
</head>

<?php require_once('./components/sidebar.php') ?>

<div class="container rounded mt-5 mb-5 shadow">
  <form enctype="multipart/form-data" method="POST" action="./bd/updatePerfil.php" enctype="">
    <div class="row">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <label class="textLabel" for="inputTag">
            <i class="imgBox"><img id="img1" class="imgPerfil" src="<?php echo $userImg ?>" alt=""></i>
          </label>
          <input name="updatearquivo" id="inputTag" type="file">
          <br />
          <span id=""></span>
          <span class="font-weight-bold"><?php echo $userName ?></span>
          <span class="text-black-50"><?php echo $userEmail ?></span>
        </div>


      </div>
      <div class="col-md-8 border-right">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Informações de perfil</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-6"><label class="labels">Nome</label><input type="text" name="inputName" class="form-control" placeholder="" value="<?php echo $userName ?>" disabled></div>
            <div class="col-md-6"><label class="labels">Email</label><input type="email" name="inputEmail" class="form-control" placeholder="" value="<?php echo $userEmail ?>" required></div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6"><label class="labels">CPF</label><input type="text" name="inputCpf" class="form-control" placeholder="121.543.234-99" value="<?php echo $userCpf ?>" disabled></div>
            <div class="col-md-6"><label class="labels">Telefone</label><input type="text" name="inputPhone" class="form-control" placeholder="Número de telefone" value="<?php echo $userPhone ?>" required></div>
          </div>
          <div class="row ">
         
                <?php if($status == 'trueInfo') {
                  echo "<style>.success-message-info{display: flex}</style>";
                }
                ?>
              <p class="error-message">Os campos <strong>Email</strong> e <strong>Telefone</strong> não podem estar vazios!</p>
              <p class="success-message-info">As informações foram atualizadas com sucesso!</p>
       
          </div>
          <div class="mt-1 text-start"><input class="btn btn-primary" name="upload" type="submit" value="Atualizar"></input>
          </div>
        </form>

        <!-- Formulário para alterar senha -->
        <form action="./bd/updatePassword.php" method="POST">
          <div class="col-md-15">
            <div class=" py-2">
              <div class="d-flex justify-content-between align-items-center experience"><h4 class="mt-5">Alterar Senha</h4></div><br>
              <div class="row">
                <div class="col-md-4"><label class="labels">Nova senha</label><input type="password" name="inputPassword" required class="form-control" placeholder="Digite a nova senha"></div> <br>
                <div class="col-md-4"><label class="labels">Confirme a nova senha</label><input type="password" name="inputConfirmPassword" class="form-control" placeholder="Digite novamente a senha" required></div>

              </div>
              <div class="col-md-6">
                <?php if($status == 'false') {
                  echo "<style>.error-message-pass{display: flex}</style>";
                } elseif($status == 'true') {
                  echo "<style>.success-message-pass{display: flex}</style>";
                  
                }?>
                <p class='error-message-pass'>Campos de senha incorretos!</p>
                <p class='success-message-pass'>Senha atualizada com sucesso!</p>
              </div>
            </div>
          </div>
    
          <div class="mt-1 text-start"><input class="btn btn-primary" name="upload" type="submit" value="Atualizar senha"></input></div>
        </form>
        </div>
      </div>


    </div>


</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    window.history.pushState("", "", "/cadUsers.php");


  let input = document.getElementById("inputTag");
  let imageName = document.getElementById("imageName")

  input.addEventListener("change", () => {
    let inputImage = document.querySelector("input[type=file]").files[0];

    imageName.innerText = inputImage.name;
  })

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#img1').attr('src', e.target.result); // <- ID do <img>
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#inputTag").change(function() { // <- ID do input

    readURL(this);

  });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>