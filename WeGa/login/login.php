<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $_SESSION['login_user'] = $user['username'];
        $_SESSION['rol'] = $user['rol'];

        setcookie('auth_token', 'valoare_unica', time() + (86400 * 30), "/");

        if ($user['rol'] === 'admin') {
            header("Location: ../admin/admin.html");
        } else {
            header("Location: ../Acasa.html");
        }
        exit();
    } else {
        echo json_encode(["message" => "Parolă incorectă sau utilizator inexistent."]);
    }

    $stmt->close();
    $conn->close();
}
