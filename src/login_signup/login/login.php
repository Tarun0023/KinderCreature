<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require('C:\xampp\htdocs\KinderCreature\src\database.php');
    $sql = sprintf("SELECT * FROM users WHERE email='%s'", $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {     
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION["user_id"] = $user["email"];
            $_SESSION["role"] = $user["role"];
            header("location: /KinderCreature/src/home_page/home.php");
            exit;
        }
    }
    $is_invalid = true;
}

include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="/KinderCreature/img/web_logo.png">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="/KinderCreature/src/login_signup/login/stylelogin.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emailInput = document.querySelector("input[name='email']");
            const passwordInput = document.querySelector("input[name='password']");
            if (emailInput) emailInput.value = "";
            if (passwordInput) passwordInput.value = "";
        });
    </script>
</head>
<body class="login-body">
    <div>
        <div class="logo text-center">
            <img class="nav-logo" src="/KinderCreature/img/web_logo.png" alt="logo">
        </div>
        <h1><span style="color:black;">Kinder</span><span style="color:blue;">Creature</span></h1>
    </div>
    <div class="container">
        <form method="POST" autocomplete="off">
            <div class="loginpage">
                <input class="email-input" type="text" placeholder="E-mail" name="email" required>
                <input class="password-input" type="password" placeholder="Password" name="password" required>
            </div>
            <?php if ($is_invalid): ?>
                <div class="alert-box-danger">
                    <h5><b>Invalid email or password.</b></h5>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn-block">Login</button>
        </form>
        <div class="row">
            <ul class="page-links">
                <a href="/KinderCreature/src/login_signup/forgot/forgot.php">Forgot Password?</a>
                <a href="/KinderCreature/src/login_signup/signup/signup.php">Sign Up</a>
            </ul>
        </div>
    </div>
</body>
</html>
