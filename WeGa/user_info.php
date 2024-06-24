<?php
session_start();

$response = ['authenticated' => false];

if (isset($_SESSION['login_user'])) {
    include 'database.php';
    $username = $_SESSION['login_user'];

    $stmt = $conn->prepare("SELECT email FROM registration WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $response = [
            'authenticated' => true,
            'username' => $username,
            'email' => $user['email']
        ];
    }

    $stmt->close();
    $conn->close();
}

header('Content-Type: application/json');
echo json_encode($response);
