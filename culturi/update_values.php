<?php
// Simulăm generarea de valori aleatorii pentru umiditate și temperatură
$humidity = rand(0, 100); // Umiditatea poate fi între 0 și 100%
$temperature = rand(0, 50); // Temperatura poate fi între 0°C și 50°C

// Determinăm clasa pentru umiditate și temperatură bazată pe valori
$humidityClass = ($humidity < 40) ? "low" : (($humidity > 60) ? "high" : "normal");
$temperatureClass = ($temperature < 16) ? "low" : (($temperature > 20) ? "high" : "normal");

// Construim un array asociativ pentru răspunsul JSON
$response = array(
    "humidity" => $humidity,
    "temperature" => $temperature,
    "humidityClass" => $humidityClass,
    "temperatureClass" => $temperatureClass
);

// Setăm tipul de conținut al răspunsului la JSON
header('Content-Type: application/json');

// Returnăm răspunsul ca JSON
echo json_encode($response);
