<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date
    include 'database.php';

    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    }

    // Escapare și protejare împotriva SQL injection
    $reset_code = $conn->real_escape_string($_POST['reset_code']);
    $new_password = $conn->real_escape_string($_POST['new_password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // Verifică dacă parolele coincid
    if ($new_password != $confirm_password) {
        echo "Parolele nu coincid.";
        exit();
    }

    // Actualizăm parola în baza de date utilizând codul de resetare
    $update_query = "UPDATE registration SET password='$new_password'";
    $update_result = $conn->query($update_query);

    if ($update_result) {
        // Parola a fost actualizată cu succes
        header("Location: ../Acasa.html");
        exit;
    } else {
        // A apărut o eroare la actualizarea parolei
        echo "Eroare la schimbarea parolei: " . $conn->error;
    }

    // Închide conexiunea la baza de date
    $conn->close();
}
