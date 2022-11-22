 <?php
session_start();
include_once('./bd/verifyLogin.php');
include_once('./bd/verifyAccessAdm.php');


$message = 'false';
$message = filter_input(INPUT_GET, 'cod');


?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/cadastro.css">

</head>

<body>

  <?php require_once('./components/sidebar.php'); ?>
  <div class="boxRegister">
    <div class="boxInfos shadow">
      <div class="titleInfos">
        <h1 class="title-page">Cadastro de usuários</h1>
        

        <form class="row g-3" enctype="multipart/form-data" method="POST" action="./bd/addUser.php">
          
          <div class="col-md-6">
            <label for="inputName" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inputName" autocomplete='off' name="inputName" placeholder="Digite o Nome" required>
          </div>
          <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" autocomplete='off'name="inputEmail" placeholder="Digite o Email" required>
          </div>

          <div class="col-md-6">
            <label for="inputCpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="inputCpf" name="inputCpf" autocomplete='off' placeholder="Digite o CPF" required maxlength="14" OnKeyPress="formatar('###.###.###-##', this)">
          </div>
          <div class="col-md-6">
            <label for="inputPhone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="inputPhone" name="inputPhone" autocomplete='off' placeholder="Digite o Telefone" required maxlength="13" OnKeyPress="formatar('##-#####-####', this)">
          </div>
          <div class="col-md-6">
            <label for="inputPassword" class="form-label">Senha</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder=" Digite a Senha" required>
          </div>
          <div class="col-md-6">
            <label for="inputRepeatPassword" class="form-label">Repita a Senha</label>
            <input type="password" class="form-control" id="inputRepeatPassword" name="inputRepeatPassword" placeholder=" Repita a Senha" required>
          </div>
          <div class="col-md-4">
            <label for="inputOffice" class="form-label">Cargo</label>
            <select id="inputOffice" name="inputOffice" class="form-select">
              <option hidden>Selecione</option>
              <option value="Desenvolvedor Front-End">Desenvolvedor Front-End</option>
              <option value="Desenvolvedor Back-End">Desenvolvedor Back-End</option>
              <option value="Desenvolvedor Full-Stack">Desenvolvedor Full-Stack</option>
              <option value="Analista de Suporte">Analista de Suporte</option>
              <option value="Analista de RH">Analista de RH</option>
              <option value="Gerente">Gerente</option>
              <option value="Diretor">Diretor</option>
              <option value="Supervisor">Supervisor</option>
              <option value="Aprendiz">Aprendiz</option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="inputSector" class="form-label">Setor</label>
            <select id="inputSector" name="inputSector" class="form-select">
              <option hidden>Selecione</option>
              <option value="Operações">Operações</option>
              <option value="Desenvolvimento">Desenvolvimento</option>
              <option value="Jurídico">Jurídico</option>
              <option value="RH">RH</option>
              <option value="Diretoria">Diretoria</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="inputUnity" class="form-label">Unidade</label>
            <select id="inputUnity" name="inputUnity" class="form-select">
              <option hidden>Selecione</option>
              <option value="Mariópolis">Mariópolis</option>
              <option value="Curitiba">Curitiba</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="inputType" class="form-label">Tipo</label>
            <select id="inputType" name="inputType" class="form-select">
              <option hidden>Selecione</option>
              <option value="1">Usuário Admin</option>
              <option value="0">Usuário Comum</option>
            </select>
          </div>
          <div class="alert-box col-md-6">
            <?php 
              if($message === 'true') {
                echo "<style> .alert-box{display: flex}</style>";
                echo "<script>setTimeout(removeMessage, 2000);</script>";
              }
             ?>
            <span class="alert-message-success">Usuário cadastrado com sucesso!</span>
          </div>
           <?php 
              if($message === 'passError') {
                echo "<style> .alert-password-error{display: flex}</style>";
                echo "<script>setTimeout(removeMessage, 2000);</script>";
              } else if($message === 'cpfError') {
                echo "<style> .alert-cpf-error{display: flex}</style>";
                echo "<script>setTimeout(removeMessage, 2000);</script>";
              } else if($message === 'userError') {
                echo "<style> .alert-user-error{display: flex}</style>";
                echo "<script>setTimeout(removeMessage, 2000);</script>";
              } else if($message === 'imgError') {
                echo "<style> .alert-user-error{display: flex}</style>";
                echo "<script>setTimeout(removeMessage, 2000);</script>";
              }
             ?>
          <span class="alert-password-error">As senhas devem ser iguais!</span>
          <span class="alert-cpf-error">CPF Inválido!</span>
          <span class="alert-user-error">Usuário já cadastrado!</span>

          <div class="box-file">
            <h1 class="perfil-title">Foto de Perfil</h1>
            <label class="textLabel upload-img" for="inputTag">
              <input name="arquivo" class="custom-file-input" id="inputTag" type="file" accept="image/png, image/jpg, image/gif, image/jpeg" required>
          </div>
          <div class="col-12 d-flex flex-row-reverse mt-5 gap-3">
            <input type="submit" name="upload" class="btn btn-primary" value="Registrar"></input>
            <input type="reset" class="btn btn-secondary" value="Limpar"></input>
          </div>
        </form>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    window.history.pushState("", "", "/cadUsers.php");
    function removeMessage() {
      document.querySelector('.alert-box').style.display = 'none';
      document.querySelector('.alert-password-error').style.display = 'none';
      document.querySelector('.alert-cpf-error').style.display = 'none';
      document.querySelector('.alert-user-error').style.display = 'none';
    }

    setTimeout(removeMessage, 4000);


    function formatar(mascara, documento) {
      var i = documento.value.length;
      var saida = mascara.substring(0, 1);
      var texto = mascara.substring(i)

      if (texto.substring(0, 1) != saida) {
        documento.value += texto.substring(0, 1);
      }

    }
  </script>

</body>


</html>