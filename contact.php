<?php
// Verifică dacă formularul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date
    $conn = new mysqli('localhost', 'root', '', 'wega');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    }

    // Preia datele din formular
    $nume = $_POST['name'];
    $email = $_POST['email'];
    $telefon = $_POST['phone'];
    $mesaj = $_POST['message'];

    // Escapare și protejare împotriva SQL injection
    $nume = $conn->real_escape_string($nume);
    $email = $conn->real_escape_string($email);
    $telefon = $conn->real_escape_string($telefon);
    $mesaj = $conn->real_escape_string($mesaj);

    // Crează și execută interogarea MySQL pentru inserarea datelor în tabel
    $insert_query = "INSERT INTO contact (nume, email, telefon, mesaj) VALUES ('$nume', '$email', '$telefon', '$mesaj')";
    $result = $conn->query($insert_query);

    if ($result) {
        header("Location: Acasa.html");
        exit();
    } else {
        echo "Eroare la salvarea datelor în baza de date: " . $conn->error;
    }

    // Închide conexiunea la baza de date
    $conn->close();
}
