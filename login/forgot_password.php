<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date
    $conn = new mysqli('localhost', 'root', '', 'wega');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    }

    // Escapare și protejare împotriva SQL injection
    $email = $conn->real_escape_string($_POST['forgot_email']);
    $new_password = $conn->real_escape_string($_POST['new_password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // Verificăm dacă adresa de email există în baza de date
    $check_query = "SELECT * FROM registration WHERE email='$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows == 1) {
        // Adresa de email există, continuăm cu actualizarea parolei

        // Verificăm dacă parolele coincid
        if ($new_password != $confirm_password) {
            echo "Parolele nu coincid.";
            exit();
        }

        // Actualizăm parola în baza de date utilizând adresa de email
        $update_query = "UPDATE registration SET password='$new_password' WHERE email='$email'";
        $update_result = $conn->query($update_query);

        if ($update_result) {
            // Parola a fost actualizată cu succes
            header("Location: ../Acasa.html");
            exit;
        } else {
            // A apărut o eroare la actualizarea parolei
            echo "Eroare la schimbarea parolei: " . $conn->error;
        }
    } else {
        // Adresa de email nu există în baza de date
        echo "Adresa de email nu există în baza de date.";
    }

    // Închide conexiunea la baza de date
    $conn->close();
}
