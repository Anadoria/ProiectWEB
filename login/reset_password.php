<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="forgot_pass.css">
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if (isset($_POST['reset_code']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
           
            $resetCode = $_POST['reset_code'];

           
            $newPassword = $_POST['new_password'];

           
            $confirmPassword = $_POST['confirm_password'];

          
            echo "<p>Parola a fost resetata cu succes!</p>";
        } else {
            echo "<p>Va rugam sa furnizati toate datele necesare pentru resetarea parolei.</p>";
        }
    }
    ?>
    <a href="login.php">Back to Login</a>
</body>
</html>
