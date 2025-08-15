<?php

?>

<?php 
$message = "";
$valid = 'true';
include('C:\xampp\htdocs\KinderCreature\src\database.php');

if (isset($_GET['key']) && isset($_GET['email'])) {
    $key = mysqli_real_escape_string($mysqli, $_GET['key']);
    $email = mysqli_real_escape_string($mysqli, $_GET['email']);
    
    // Validate the key and email in the forget_password table
    $check = mysqli_query($mysqli, "SELECT * FROM forget_password WHERE email='$email' AND temp_key='$key'");
    if (mysqli_num_rows($check) != 1) {
        echo "<div class='alert-box-danger'>This URL is invalid or has already been used. Please try again.</div>";
        exit;
    }
} else {
    header('Location: /KinderCreature/src/login_signup/forgot/reset_password.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password1 = mysqli_real_escape_string($mysqli, $_POST['password1']);
    $password2 = mysqli_real_escape_string($mysqli, $_POST['password2']);

    // Password validation
    if (strlen($password1) < 8) {
        $message = "❌ Password must be at least 8 characters long.";
    } elseif ($password1 === $password2) {
        $message_success = "✔️ New password has been set for " . htmlspecialchars($email);
        $hashed_password = password_hash($password1, PASSWORD_BCRYPT); // Securely hash the password
        
        // Remove the key from the forget_password table
        mysqli_query($mysqli, "DELETE FROM forget_password WHERE email='$email' AND temp_key='$key'");
        
        // Update the password in the users table
        mysqli_query($mysqli, "UPDATE users SET password_hash='$hashed_password' WHERE email='$email'");
    } else {
        $message = "❌ Passwords do not match. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="/KinderCreature/img/web_logo.png">
    <link href="/KinderCreature/src/login_signup/forgot/reset_password.css" rel="stylesheet">
</head>
<body class="forgot-body">
    <div>
        <div class="logo text-center">
            <img class="nav-logo" src="/KinderCreature/img/web_logo.png" alt="logo">
        </div>
        <h1><span style="color:black;">Kinder</span><span style="color:blue;">Creature</span></h1>
    </div>
    <div class="container">
        <h2 class="f-p-title">Reset Your Password</h2>
        <p class="f-p-text">Please enter your new password below.</p>

        <form method="POST" action="">
            <div class="hi">
                <input class="form-control" type="password" name="password1" placeholder="New Password" required>
            </div>
            <div class="hi">
                <input class="form-control" type="password" name="password2" placeholder="Re-type New Password" required>
            </div>

            <?php if ($message !== "") {
                echo "<div class='alert-box-danger'>$message</div>";
            } ?>
            <?php if (isset($message_success)) {
                echo "<div class='alert-box-success'>$message_success</div>";
            } ?>

            <div class="action">
                <button class="btn-block" type="submit">Save Password</button>
            </div>
        </form>

        <div class="row">
            <ul class="page-links">
                <p>This link will work only once for a limited time period.</p>
                <p class="direct-redirection">Back to <a href="/KinderCreature/src/login_signup/login/login.php">Login</a></p>
            </ul>
        </div>
    </div>
</body>
</html>
