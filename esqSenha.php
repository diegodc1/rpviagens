<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/esqSenha.css">
  <title>Recuperar Senha</title>
</head>

<body>

  <div class="box">
    <h1>Recuperar Senha</h1>
    <form action="bd/esqMysenha.php" method="post">
      <?php if (!isset($_SESSION['errorSenha'])) { ?>
        <div class="container">
          <div class="left_line">
            <div class="label_content">
              <label class="labels margin" for="">Digite seu CPF:</label>
            </div>
            <input class="inputs" placeholder="Ex.: 045.400.380-36" type="text" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)">
            <label class="labels" for="">Nova senha:</label>
            <input class="inputs" name="newSenha" placeholder=" Digite a nova senha" type="password">
            <label class="labels right" for="">Confirme a senha:</label>
            <input class="inputs" name="repeat" placeholder=" Digite novamente a nova senha" type="password">
          <?php } else { ?>
            <div class="container">
              <div class="left_line">
                <div class="label_content">
                  <label class="labels margin" for="">Digite seu CPF</label>
                </div>
                <input class="inputs" placeholder="Ex.: 045.400.380-36" type="text" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)">
                <label class="labels" for="">Nova senha:</label>
                <input class="inputs" name="newSenha" style="border: 1px solid red;" placeholder="As senhas devem ser iguais" type="password">
                <label class="labels right" for="">Confirme a senha:</label>
                <input class="inputs" name="repeat" style="border: 1px solid red;" placeholder="Por favor, tente novamente!" type="password">
              <?php } unset($_SESSION['errorSenha']); ?>
              <input type="submit" class="btn-primary">
              </div>
    </form>
  </div>




  <script>
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