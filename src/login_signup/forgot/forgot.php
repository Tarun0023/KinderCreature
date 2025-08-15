<?php

?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';
$message = "";  // Initialize the message variable to prevent undefined variable error.
$message_success = "";  // Initialize success message variable.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email_reg = mysqli_real_escape_string($mysqli, $_POST['email']);
    $details = mysqli_query($mysqli, "SELECT username, email FROM users WHERE email='$email_reg'");

    if (mysqli_num_rows($details) > 0) {
        // Email found in the database, generate key for reset
        $message_success = "Please check your email inbox or spam folder and follow the steps.";

        // Generate random key
        $key = md5(time() + rand(4000, 55000000));

        // Insert key into database
        $sql_insert = mysqli_query($mysqli, "INSERT INTO forget_password (email, temp_key) VALUES ('$email_reg', '$key')");

        // Send email with reset instructions
        $to = $email_reg;
        $subject = 'Password Reset Request - Kinder Creature';
        
    // Build a production-safe base URL (prefer HTTPS on the live site)
    $base_url = 'https://' . $_SERVER['HTTP_HOST'];
    $reset_link = $base_url . '/src/login_signup/forgot/reset_password.php?key=' . urlencode($key) . '&email=' . urlencode($email_reg);

    // HTML Email Content
    $msg = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Password Reset</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    max-width: 600px;
                    margin: 0 auto;
                    background: url("") no-repeat center center;
                    background-size: cover;
                    padding: 20px;
                    filter: blur(8px);
                    -webkit-filter: blur(8px);

                    border-radius: 10px;
                }
                .email-content {
                    background-color: #ffffff;
                    border-radius: 10px;
                    padding: 20px;
                    text-align: center;
                }
                .logo img {
                    width: 150px;
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    background-color: #007bff;
                    text-decoration: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    font-size: 16px;
                    margin-top: 20px;
                }

                p {
                    font-size: 16px;
                    color: #333333;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="email-content">
                    <div class="logo">
                        <img src="https://i.ibb.co/c2N71TZ/web-logo-removebg-preview.png" alt="Kinder Creatures Logo">
                    </div>
                    <h2>Password Reset Request</h2>
                    <p>
                        Please click the button below or copy the link into your browser to reset your password.
                    </p>
                    <a href="' . $reset_link . '" class="button" style="color:white;">
                        Reset Password
                    </a>
                    <p>
                        If you did not request a password reset, please ignore this email.
                    </p>
                </div>
            </div>
        </body>
        </html>
        ';
        
        // Email Headers
    // Use a sender address that matches the production domain
    $headers = "From: Kinder Creature <noreply@kindercreature.me>\r\n";
    $headers .= "Reply-To: noreply@kindercreature.me\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($to, $subject, $msg, $headers)) {
            $message_success = "A password reset link has been sent to your email.";
        } else {
            $message = "Failed to send the email. Please try again later.";
        }
    } else {
        $message = "Sorry! No account associated with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/img/web_logo.png">
    <link href="/src/login_signup/forgot/styleforgot.css" rel="stylesheet">
</head>
<body class="forgot-body">
    <div>
        <div class="logo text-center">
            <img class="nav-logo" src="/img/web_logo.png" alt="logo">
        </div>
        <h1><span style="color:black;">Kinder</span><span style="color:blue;">Creature</span></h1>
    </div>
    <div class="container">
        <h2 class="f-p-title">Forgot Password</h2>
        <p class="f-p-text">Please enter your email address to reset your password.</p>
        
        <form method="POST" action="">
            <div class="hi">
                <input class="form-control" type="email" placeholder="E-mail" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            
            <!-- Display messages if any -->
            <?php
            if (!empty($message)) {
                echo "<div class='alert-box-danger'>$message</div>";

            }
            if (!empty($message_success)) {
                echo "<div class='alert-box-success'>$message_success</div>";
            }
            ?>

            <div class="action">
                <button class="btn-block" type="submit">Reset Password</button>
            </div>
        </form>
        <div class="row">
            <ul class="page-links">
                <p>Remember your password? <a href="/src/login_signup/login/login.php">Login</a></p>
            </ul>
        </div>
    </div>
</body>
</html>