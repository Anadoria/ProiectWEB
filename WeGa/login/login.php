<?php
session_start();

// Verifică dacă utilizatorul este deja autentificat
if (isset($_SESSION['login_user'])) {
    header("Location: disclaimer.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifică autentificarea utilizatorului
    include '../database.php';

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['pswd']);

    $stmt = $conn->prepare("SELECT * FROM registration WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['login_user'] = $user['username']; // Setează variabila de sesiune pentru autentificare
        $_SESSION['rol'] = $user['rol']; // Setează rolul utilizatorului în sesiune

        // Setează un cookie pentru a menține autentificarea între sesiuni
        setcookie('auth_token', 'valoare_unica', time() + (86400 * 30), "/"); // Valabil timp de 30 de zile

        // Redirecționează utilizatorul în funcție de rol
        if ($user['rol'] === 'admin') {
            header("Location: ../admin/admin.html");
        } else {
            header("Location: ../Acasa.html");
        }
        exit();
    } else {
        echo "Parolă incorectă sau utilizator inexistent.";
    }

    $stmt->close();
    $conn->close();
}
