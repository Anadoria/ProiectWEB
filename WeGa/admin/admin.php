<?php
// Conectarea la baza de date
include '../database.php';

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Obținem ID-ul mesajului de șters
    parse_str(file_get_contents("php://input"), $params);
    $id = $params['id'] ?? null;

    if ($id !== null) {
        // Ștergem mesajul din baza de date
        $sql = "DELETE FROM contact WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "Executarea query-ului a eșuat"]);
            }
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "error" => "Pregătirea query-ului a eșuat"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "ID-ul nu este setat corect"]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Citim mesajele din baza de date
    $sql = "SELECT id, nume, email, telefon, mesaj FROM contact";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        echo json_encode(["messages" => $messages]);
    } else {
        echo json_encode(["messages" => []]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Metoda de cerere nu este GET sau DELETE"]);
}

$conn->close();
