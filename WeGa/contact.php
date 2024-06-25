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
    $floare = $_POST['floare'] === 'Nimic' ? null : $_POST['floare']; // Setăm floare la null dacă valoarea este Nimic
    $mesaj = $_POST['message'];

    // Crează și execută interogarea MySQL folosind interogări pregătite
    $stmt = $conn->prepare("INSERT INTO contact (nume, email, telefon, floare, mesaj) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nume, $email, $telefon, $floare, $mesaj);

    if ($stmt->execute()) {
        // Verificăm dacă floarea nu este null și apoi decrementăm stocul
        if ($floare !== null) {
            $updateStmt = $conn->prepare("UPDATE stocflori SET stoc = stoc - 1 WHERE floare = ?");
            $updateStmt->bind_param("s", $floare);

            if ($updateStmt->execute()) {
                // Redirectăm utilizatorul la pagina Acasa.html
                header("Location: Acasa.html");
                exit();
            } else {
                echo "Eroare la actualizarea stocului: " . $updateStmt->error;
            }

            $updateStmt->close();
        } else {
            // Dacă floarea este null, nu facem nimic pentru decrementarea stocului
            header("Location: Acasa.html");
            exit();
        }
    } else {
        echo "Eroare la salvarea datelor în baza de date: " . $stmt->error;
    }

    // Închide interogarea pregătită și conexiunea la baza de date
    $stmt->close();
    $conn->close();
}
