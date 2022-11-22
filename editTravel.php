  <?php
session_start();
require_once('./bd/conf.php');
include_once('./bd/verifyLogin.php');
include_once('./bd/verifyAccessAdm.php');



$idTravel = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM viagens WHERE viagem_id = $idTravel");
$sql->execute();

if($sql->rowCount() > 0) {
  $viagem = $sql->fetch();
} else {
  echo "ERROR: Nenhuma viagem encontrada!";
}

?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Viagem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/styles/cadViagens.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<?php
require_once('./components/sidebar.php')
?>

<body>
  <div class="boxRegister">
    <div class="boxInfos shadow">
      <div class="titleInfos">
        <h1>Editar Viagem</h1>
        <form class="row g-3" method="POST" action="/bd/editTravelAction.php?id=<?= $idTravel ?>">
          <div class="col-md-6">
            <label for="inputTravelTitle" class="form-label">Título da Viagem</label>
            <input type="text" class="form-control" id="inputTravelTitle" name="inputTravelTitle" value="<?= $viagem['titulo']?>" required>
          </div>
          <div class="col-md-6">
            <label for="inputClientName" class="form-label">Nome Cliente</label>
            <input type="text" class="form-control" name="inputClientName" value="<?= $viagem['nome_cliente']?>" required>
          </div>
          <div class="col-md-6">
            <label for="inputDate" class="form-label">Data</label>
            <input type="date" class="form-control" name="inputDate" value="<?= $viagem['data_viagem']?>" required>
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Cidade Destino</label>
            <input type="text" class="form-control" name="inputCity" value="<?= $viagem['cidade_destino']?>" required>
          </div>
          <div class="col-md-6 textarea-box">
            <label for="inputTravelReason" class="form-label">Motivo da Viagem</label>
            <textarea name="inputTravelReason" class="form-control" rows="2" cols="30" value=""><?= $viagem['motivo_viagem']?></textarea>
          </div>
          <div class="col-md-6 daily_box">
            <label for="inputDailyValue" class="form-label">Valor Diária</label>
            <div class="box-in-daily">
              <input type="text" class="form-control" name="inputDailyValue" value="R$ 50,00" id="valor" readonly>
              <input type="range" min="0" max="500.00" value="value="<?= $viagem['valor_diaria']?>" step="1" style="width:100%" oninput="converter(this.value)">
            </div>
          </div>

  
          <div class="col-md-6">
            <label for="inputLocomotion" class="form-label">Tipo de Locomoção:</label>
            <select name="inputLocomotion" class="form-select" required>
              <option hidden><?= $viagem['locomocao']?></option>
              <option value="Carro">Carro</option>
              <option value="Avião">Avião</option>
              <option value="Ônibus">Onibus</option>
            </select>
          </div>
          <div class="row g-3">
            <h5>Informações de Hospedagem:</h5>
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <label for="inputHotelName" class="form-label">Nome do Hotel</label>
              <input type="text" class="form-control" name="inputHotelName" value="<?= $viagem['nome_hotel']?>" required>
            </div>
            <div class="col-md-6">
              <label for="inputHoteAddress" class="form-label">Endereço do Hotel</label>
              <input type="text" class="form-control" name="inputHotelAddress" value="<?= $viagem['endereco_hotel']?>" required>
            </div>
            <div class="col-md-6 mt-2">
              <label for="inputCheckinDate" class="form-label">Data Check-in</label>
              <input type="date" class="form-control" name="inputCheckinDate" value="<?= $viagem['data_checkin']?>" required>
            </div>
            <div class="col-md-6 mt-2">
              <label for="inputCheckoutDate" class="form-label">Data Check-out</label>
              <input type="date" class="form-control" name="inputCheckoutDate" value="<?= $viagem['data_checkout']?>" required>
            </div>
          </div>
          <div class="col-12 button-box mt-5">
            <input type="submit" class="btn btn-primary" value="Continuar"></input>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script href="/js/formatInput.js"></script>
  <script>
    function converter(valor) {
      var numero = parseFloat(valor).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
      });
      document.getElementById('valor').value = numero;
    }
  </script>
</body>


</html>