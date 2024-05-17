<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', '', 'wega');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['pswd']);

    $query = "SELECT * FROM registration WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc(); // Obține rândul rezultatului

        // Extrage parola din rezultatul interogării
        $stored_password = $row['password'];

        // Verifică parola folosind password_verify()
        if (password_verify($password, $stored_password)) {
            // Parola introdusă este corectă

            // Setează variabilele de sesiune pentru utilizator
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];

            // Redirecționează către pagina de acasă
            header("Location: ../Acasa.html");
            exit();
        } else {
            // Parola introdusă nu este corectă
            echo "Parolă incorectă.";
        }
    } else {
        // Utilizatorul nu a fost găsit în baza de date
        echo "Utilizatorul nu există.";
    }

    // Închide conexiunea la baza de date
    $conn->close();
}
