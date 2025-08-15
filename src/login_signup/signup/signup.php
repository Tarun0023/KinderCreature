<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="/img/web_logo.png">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <link href="/src/login_signup/signup/stylesignup.css" rel="stylesheet">
    <script>
        // Clear input fields on page load
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll("input");
            inputs.forEach(input => input.value = "");
        });
    </script>
</head>
<body class="signup-body">
    <div>
        <div class="logo text-center">
           <img class="nav-logo" src="/img/web_logo.png" alt="logo">
        </div>
        <h1><span style="color:black;">Kinder</span><span style="color:blue;">Creature</span></h1>
    </div>
    <div class="container">
    <form action="/src/login_signup/signup/process_signup.php" method="post" autocomplete="off">
            <div class="loginpage">
                <input class="user-input" type="text" placeholder="Username" name="username" required>
                <input class="email-input" type="email" placeholder="E-mail" name="email" required>
                <input class="password-input" type="password" placeholder="Password" name="password" required>
                <input class="retype-password-input" type="password" placeholder="Retype Password" name="retype_password" required>
            </div>
            <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert-box-danger">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['success'])) {
                    echo '<div class="alert-box-success">' . $_SESSION['success'] . '</div>';
                    unset($_SESSION['success']);
                }
            ?>
            <button type="submit" class="btn-block">Sign Up</button>
        </form>
        <div class="row">
            <ul class="page-links">
                <span>Already have an account? </span>
                <a href="/src/login_signup/login/login.php">Login</a>
            </ul>
        </div>
    </div>
</body>
</html>