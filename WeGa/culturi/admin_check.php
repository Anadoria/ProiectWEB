<?php
session_start();

$isAdmin = false;

// Verifică dacă utilizatorul este conectat și este admin
if (isset($_SESSION['login_user']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
}

// Răspunde cu un JSON care indică dacă utilizatorul este admin sau nu
echo json_encode(['isAdmin' => $isAdmin]);
