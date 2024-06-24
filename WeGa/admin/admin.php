<?php
session_start();

// Verifică dacă utilizatorul este autentificat și are rol de admin
if (!isset($_SESSION['login_user']) || $_SESSION['rol'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acces interzis.']);
    exit();
}

include '../database.php';

// Preia mesajele din baza de date
$query = "SELECT nume, email, telefon, mesaj FROM contact";
$result = $conn->query($query);

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode(['messages' => $messages]);
