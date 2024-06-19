<?php
// Verificăm dacă parametrul reset este setat în solicitarea POST
if (isset($_POST['reset']) && $_POST['reset'] === 'true') {
    // Setăm valorile la cele normale
    $humidity = 50;
    $temperature = 15;
} else {
    // Generăm valorile aleatorii pentru umiditate și temperatură
    $humidity = rand(0, 100); // Umiditatea poate fi între 0 și 100%
    $temperature = rand(0, 50); // Temperatura poate fi între 0°C și 50°C
}

// Determinăm clasa și mesajul pentru umiditate și temperatură bazată pe valori
if ($humidity < 40) {
    $humidityMessage = "prea scăzută";
    $humidityMessageClass = "low-message";
} elseif ($humidity > 60) {
    $humidityMessage = "prea ridicată";
    $humidityMessageClass = "high-message";
} else {
    $humidityMessage = "normală";
    $humidityMessageClass = "normal-message";
}

if ($temperature < 15) {
    $temperatureMessage = "prea scăzută";
    $temperatureMessageClass = "low-message";
} elseif ($temperature > 18) {
    $temperatureMessage = "prea ridicată";
    $temperatureMessageClass = "high-message";
} else {
    $temperatureMessage = "normală";
    $temperatureMessageClass = "normal-message";
}

// Construim un array asociativ pentru răspunsul JSON
$response = array(
    "humidity" => $humidity,
    "humidityMessage" => $humidityMessage,
    "humidityMessageClass" => $humidityMessageClass,
    "temperature" => $temperature,
    "temperatureMessage" => $temperatureMessage,
    "temperatureMessageClass" => $temperatureMessageClass
);

// Setăm tipul de conținut al răspunsului la JSON
header('Content-Type: application/json');

// Returnăm răspunsul ca JSON
echo json_encode($response);
