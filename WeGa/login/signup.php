<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include '../database.php';

    // Verifică dacă sunt setate variabilele POST
    if (isset($_POST['txt'], $_POST['email'], $_POST['pswd'])) {
        $userName = $_POST['txt'];
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        } else {
            // Verifică dacă există deja un cont cu acest email
            $check_query = "SELECT * FROM registration WHERE email = ?";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();

            if ($check_result->num_rows > 0) {
                echo "Există deja un cont cu acest email.";
            } else {
                // Nu există un cont cu acest email, puteți insera datele în baza de date

                // Prepare and bind statement
                $stmt = $conn->prepare("INSERT INTO registration (username, email, password, rol) VALUES (?, ?, ?, ?)");
                $rol = 'client'; // Setează rolul utilizatorului ca fiind "client"
                $stmt->bind_param("ssss", $userName, $email, $password, $rol);

                // Execute the statement
                $execval = $stmt->execute();
                if (!$execval) {
                    echo "Error: " . $stmt->error;
                } else {
                    header("Location: ../Acasa.html");
                    exit;
                }

                // Close statement and connection
                $stmt->close();
            }

            // Close the check statement
            $check_stmt->close();
            $conn->close();
        }
    } else {
        echo "Toate câmpurile sunt necesare.";
    }
}
