<?php
$flower = $_GET['flower'] ?? null; // Preluăm floarea din parametrul GET

if (!$flower) {
  echo "Nu ați ales nicio floare!";
  exit;
}

$flowers = [
    "zambila" => [
      "title" => "Zambila",
      "image" => "zambila.jpg",
      "humidity" => 60,
      "temperature" => 20,
    ],
    "lalele" => [
      "title" => "Lalele",
      "image" => "lalele.jpg",
      "humidity" => 50,
      "temperature" => 15,
    ],
    "narcise" => [
      "title" => "Narcise",
      "image" => "narcisa.jpg",
      "humidity" => 60,
      "temperature" => 18,
    ],
    "bujori" => [
      "title" => "Bujori",
      "image" => "bujori.jpg",
      "humidity" => 65,
      "temperature" => 20,
    ],
    "irisi" => [
      "title" => "Irisi",
      "image" => "iris.jpg",
      "humidity" => 55,
      "temperature" => 18,
    ],
    "crini" => [
      "title" => "Crini",
      "image" => "crin.jpg",
      "temperature" => 20,
      "humidity" => 70,
    ],
  ];

$flowerData = $flowers[$flower] ?? null; // Preluăm informații despre floarea selectată

if (!$flowerData) {
  echo "Floarea selectată nu există!";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $flowerData['title'] ?></title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1><?= $flowerData['title'] ?></h1>
  <img src="<?= $flowerData['image'] ?>" alt="<?= $flowerData['title'] ?>">
  <p>Umiditatea solului: <?= $flowerData['humidity'] ?>%</p>
  <p>Temperatura ambientală: <?= $flowerData['temperature'] ?>°C</p>
  <form action="irrigate.php" method="post">
    <input type="hidden" name="flower" value="<?= $flower ?>">
    <button type="submit">Udă florile</button>
  </form>
  
</body>
</html>