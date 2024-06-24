<?php
// Include fișierul pentru conectarea la baza de date
include 'database.php';

// Verifică dacă floarea a fost trimisă prin metoda POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['flower'])) {
    // Obține numele florii din cererea POST
    $flower = $_POST['flower'];

    // Pregătește și execută interogarea pentru decrementarea stocului
    $sql = "UPDATE stocflori SET stoc = stoc - 1 WHERE floare = ? AND stoc > 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $flower);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Stocul a fost actualizat cu succes.";
    } else {
        echo "Eroare la actualizarea stocului sau stoc insuficient.";
    }

    $stmt->close();
} else {
    echo "Cerere invalidă.";
}

$conn->close();

// Redirecționează înapoi la pagina anterioară
header("Location: culturi/lalele/lalele.html");
exit();
?>

