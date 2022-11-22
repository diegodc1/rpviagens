<?php
require_once('conf.php');
session_start();

$travel_title = filter_input(INPUT_POST, 'inputTravelTitle');
$client_name =  filter_input(INPUT_POST, 'inputClientName');
$travel_date = filter_input(INPUT_POST, 'inputDate');
$travel_reason = filter_input(INPUT_POST, 'inputTravelReason');
$daily_value = filter_input(INPUT_POST, 'inputDailyValue');
$city = filter_input(INPUT_POST, 'inputCity');
$locomotion = filter_input(INPUT_POST, 'inputLocomotion');
$hotel_name = filter_input(INPUT_POST, 'inputHotelName');
$hotel_address = filter_input(INPUT_POST, 'inputHotelAddress');
$checkin = filter_input(INPUT_POST, 'inputCheckinDate');
$checkout = filter_input(INPUT_POST, 'inputCheckoutDate');
$idViagem = $_GET['id'];

$sql = $pdo->prepare("UPDATE `viagens` SET `titulo` = :titulo, `nome_cliente` = :cliente, `data_viagem` = :data, `motivo_viagem` = :motivo, `valor_diaria` = :diaria, `cidade_destino` = :cidade, `locomocao` = :locomocao, `nome_hotel` = :hotel, `endereco_hotel` = :endereco_hotel, `data_checkin` = :checkin, `data_checkout` = :checkout WHERE viagem_id = :idViagem");

$sql->bindValue(':titulo', $travel_title);
$sql->bindValue(':cliente', $client_name);
$sql->bindValue(':data', $travel_date);
$sql->bindValue(':motivo', $travel_reason);
$sql->bindValue(':diaria', $daily_value);
$sql->bindValue(':cidade', $city);
$sql->bindValue(':locomocao', $locomotion);
$sql->bindValue(':hotel', $hotel_name);
$sql->bindValue(':endereco_hotel', $hotel_address);
$sql->bindValue(':checkin', $checkin);
$sql->bindValue(':checkout', $checkout);
$sql->bindValue(':idViagem', $idViagem);

$sql->execute();
echo $idViagem;



header("Location: ../listTravels.php");
