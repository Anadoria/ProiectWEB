<?php
$flower = $_POST['flower'] ?? null; // Preluăm floarea din formular

if (!$flower) {
  echo "Nu ați ales nicio floare!";
  exit;
}

// Cod pentru a porni sistemul de irigatii (conectare la senzori/releu)
// ... (a se implementa in functie de sistemul specific)

// Simulare udare
sleep(2); // Simulare timp de udare

echo "Florile au fost udate!";

// Redirecționare către pagina florii
header("Location: flower.php?flower=$flower");
?>