<?php
// Resetăm valorile de umiditate și temperatură la normal
$humidity = 50; // Valoare normală pentru umiditate
$temperature = 18; // Valoare normală pentru temperatură

// Determinăm clasa și mesajul pentru umiditate și temperatură
$humidityClass = "normal";
$humidityMessage = "normală";
$humidityMessageClass = "normal-message";

$temperatureClass = "normal";
$temperatureMessage = "normală";
$temperatureMessageClass = "normal-message";

// Construim un array asociativ pentru răspunsul JSON
$response = array(
  "humidity" => $humidity,
  "humidityMessage" => $humidityMessage,
  "humidityMessageClass" => $humidityMessageClass,
  "temperature" => $temperature,
  "temperatureMessage" => $temperatureMessage,
  "temperatureMessageClass" => $temperatureMessageClass,
  "humidityClass" => $humidityClass,
  "temperatureClass" => $temperatureClass
);

// Setăm tipul de conținut al răspunsului la JSON
header('Content-Type: application/json');

// Returnăm răspunsul ca JSON
echo json_encode($response);
