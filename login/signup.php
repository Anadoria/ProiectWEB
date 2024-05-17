<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = htmlspecialchars($_POST['txt']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['pswd']);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'wega');
    if ($conn->connect_error) {
        die("Connection Failed : " . $conn->connect_error);
    } else {
        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO registration (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $userName, $email, $password);

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
        $conn->close();
    }
}
