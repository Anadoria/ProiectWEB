<?php
session_start();

$isAdmin = false;

if (isset($_SESSION['login_user'])) {
    error_log("User is logged in: " . $_SESSION['login_user']);
} else {
    error_log("No user is logged in");
}

if (isset($_SESSION['rol'])) {
    error_log("User role is: " . $_SESSION['rol']);
} else {
    error_log("No role is set");
}

// Verifică dacă utilizatorul este conectat și este admin
if (isset($_SESSION['login_user']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
    $isAdmin = true;
    error_log("User is admin");
} else {
    error_log("User is not admin");
}

// Răspunde cu un JSON care indică dacă utilizatorul este admin sau nu
header('Content-Type: application/json');
echo json_encode(['isAdmin' => $isAdmin]);
