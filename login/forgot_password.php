<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="forgot_pass.css">
</head>
<body>
    <div class="main">
        <div id="forgot-password-div">
            <img src="padlock.png" alt="Padlock" id="forgot-password-img">
            <form action="send_reset_link.php" method="post">
                <label for="forgot-email">Reset your password</label>
                <div id="verification-process">Enter your email for the verification process</div>
                <input type="email" id="forgot-email" name="forgot_email" placeholder="Email" required="">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
