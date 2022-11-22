<?php
session_start();



if (!isset($_SESSION['user_logado'])) {
  if (!$_SESSION['user_logado']) {
    header('Location: /index.php');
  }
}

if (isset($_SESSION['user_access'])) {
  if ($_SESSION['user_access'] == 0) {
    header('Location: /home.php');
  }
}

if (isset($_SESSION['update_success'])) {
  if ($_SESSION['update_success']  == true) {
    echo "<style>.show {display: flex}</style>";
  }
}


$message = 'false';
$message = filter_input(INPUT_GET, 'cod');

include_once('conf.php');

// Pega info do user no bd.
if (!empty($_GET['id'])) {
  $id = $_GET['id'];

  $sql = $pdo->prepare("SELECT *  FROM usuarios WHERE id = :id");
  $sql->bindValue(':id', $id);
  $sql->execute();

  $result = $sql->fetch();
  if ($sql->rowCount() > 0) {
    $userNameEdit = $result['nome'];
    $userEmail = $result['email'];
    $userCpf = $result['cpf'];
    $userPhone = $result['telefone'];
    $userUpOffice = $result['cargo'];
    $userUpSector = $result['setor'];
    $userUpUnity = $result['unidade'];
    $userUpAccess = $result['acesso'];
    $userImage = $result['path_img'];
  } else {
    echo "Nada encontrado!";
  }
}
?>

<head>
  <link rel="stylesheet" href="/styles/perfil.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <title>Editar Usuário</title>
</head>

<?php require_once('../components/sidebar.php') ?>

<div class="container rounded mt-5 mb-5 shadow">
  <form method="POST" action="admUpdatePerfil.php?id=<?php echo $id ?>">

    <div class="row">
      <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" height="150px" src="<?php if(($userImage == '../imgs/6374d46f0b2cc.')){$userImage = '../imgs/6353410fc775a.png'; echo $userImage;} else { echo $userImage;}?>"><span class="font-weight-bold"><?php echo $userNameEdit ?></span><span class="text-black-50"><?php echo $userEmail ?></span></div>
      </div>
      <div class="col-md-8 border-right">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Informações de perfil</h4>
          </div>
          <div class="row mt-2">
            <div class="col-md-5"><label class="labels">Nome</label><input type="text" name="inputName" class="form-control" placeholder="" value="<?php echo $userNameEdit ?>"></div>
            <div class="col-md-5"><label class="labels">Email</label><input type="email" name="inputEmail" class="form-control" placeholder="" value="<?php echo $userEmail ?>" required></div>
            <div class="col-md-2">
              <label for="inputType" class="form-label labels">Tipo de acesso</label>
              <select id="inputType" name="inputType" class="form-select">
                <!-- <option hidden>Selecione</option> -->
                <?php
                if ($userUpAccess == 1) { ?>
                  <option value="1">Admin</option>
                  <option value="0">Comum</option>
                <?php } else { ?>
                  <option value="0">Comum</option>
                  <option value="1">Admin</option>
                <?php } ?>
                ?>
              </select>
            </div>

          </div>
          <div class="row mt-3">
            <div class="col-md-4"><label class="labels">CPF</label><input type="text" name="inputCpf" class="form-control" placeholder="121.543.234-99" value="<?php echo $userCpf ?>" required maxlength="14" OnKeyPress="formatar('###.###.###-##', this)"></div>
            <div class="col-md-4"><label class="labels">Telefone</label><input type="text" name="inputPhone" class="form-control" placeholder="Número de telefone" value="<?php echo $userPhone ?>" required maxlength="13" OnKeyPress="formatar('##-#####-####', this)"></div>
            <div class="col-md-4">
              <label for="inputOffice" class="form-label labels">Cargo</label>
              <select id="inputOffice" name="inputOffice" class="form-select">
                <option hidden><?php echo $userUpOffice ?></option>
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
          </div>
          <div class="row mt-3">
            <div class="col-md-4">
              <label for="inputSector" class="form-label labels">Setor</label>
              <select id="inputSector" name="inputSector" class="form-select">
                <option hidden><?php echo $userUpSector ?></option>
                <option value="Operações">Operações</option>
                <option value="Desenvolvimento">Desenvolvimento</option>
                <option value="Jurídico">Jurídico</option>
                <option value="RH">RH</option>
                <option value="Diretoria">Diretoria</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="inputUnity" class="form-label labels">Unidade</label>
              <select id="inputUnity" name="inputUnity" class="form-select">
                <option hidden><?php echo $userUpUnity ?></option>
                <option value="Mariópolis">Mariópolis</option>
                <option value="Curitiba">Curitiba</option>
              </select>
            </div>

          <div class="row mb-3">
            <div class="col-md-2 mt-3">
              <div class="mt-1 text-start"><input class="submit-button" type="submit" value="Atualizar"></input>
              </div>
            </div>
          </div>

           <div class="alert-box">
            <?php 
              if(isset($_SESSION['update_success']) ) {
                if($_SESSION['update_success'] == true) {

                  echo "<style> .alert-box{display: flex}</style>";
                  echo "<script>window.history.pushState('', '', '/bd/changeUser.php?id=$id');</script>";
                  echo "<script>setTimeout(removeMessage, 2000);</script>";
                }
              }
             ?>
            <span class="alert-message-success">Usuário atualizado com sucesso!</span>
          </div>  
        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>

<script>

  function removeMessage() {
    document.querySelector('.alert-box').style.display = 'none';
  }

  function formatar(mascara, documento) {
    var i = documento.value.length;
    var saida = mascara.substring(0, 1);
    var texto = mascara.substring(i)

    if (texto.substring(0, 1) != saida) {
      documento.value += texto.substring(0, 1);
    }

  }
</script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>