<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    echo "Trebuie să fiți conectat pentru a trimite un mesaj.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include configurarea bazei de date
    include 'database.php';

    // Preia datele din formular
    $nume = $_POST['name'];
    $email = $_POST['email'];
    $telefon = $_POST['phone'];
    $mesaj = $_POST['message'];

    // Crează și execută interogarea MySQL folosind interogări pregătite
    $stmt = $conn->prepare("INSERT INTO contact (nume, email, telefon, mesaj) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nume, $email, $telefon, $mesaj);

    if ($stmt->execute()) {
        header("Location: Acasa.html");
        exit();
    } else {
        echo "Eroare la salvarea datelor în baza de date: " . $stmt->error;
    }

    // Închide interogarea pregătită și conexiunea la baza de date
    $stmt->close();
    $conn->close();
}
