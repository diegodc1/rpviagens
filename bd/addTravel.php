<?php
require_once('conf.php');
session_start();

$travel_title = filter_input(INPUT_POST, 'inputTravelTitle');
$client_name =  filter_input(INPUT_POST, 'inputClientName');
$travel_date = filter_input(INPUT_POST, 'inputDate');
$travel_reason = filter_input(INPUT_POST, 'inputTravelReason');
$daily_value = filter_input(INPUT_POST, 'inputDailyValue');
$city = filter_input(INPUT_POST, 'inputCity');
$funcionarios = filter_input(INPUT_POST, 'inputFuncionarios');
$locomotion = filter_input(INPUT_POST, 'inputLocomotion');
$hotel_name = filter_input(INPUT_POST, 'inputHotelName');
$hotel_address = filter_input(INPUT_POST, 'inputHotelAddress');
$checkin = filter_input(INPUT_POST, 'inputCheckinDate');
$checkout = filter_input(INPUT_POST, 'inputCheckoutDate');
$status = 'Ativo';

$sql = $pdo->prepare("INSERT INTO viagens (titulo, nome_cliente, data_viagem, motivo_viagem, valor_diaria, cidade_destino, locomocao, nome_hotel, endereco_hotel, data_checkin, data_checkout, status_viagem) VALUES (:titulo, :cliente, :data, :motivo, :diaria, :cidade, :locomocao, :hotel, :endereco_hotel, :checkin, :checkout, :status)");

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
$sql->bindValue(':status', $status);

$sql->execute();

$_SESSION['id_viagem'] = $pdo->lastInsertId();

header("Location: ../selectUsersTravel.php");
