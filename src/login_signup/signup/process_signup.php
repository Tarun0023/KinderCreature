<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Password validation
    if (strlen($_POST["password"]) < 8) {
        $_SESSION['error'] = "❌ Password must be at least 8 characters.";
        echo "Error set in session, redirecting..."; // Debugging line
        header("Location: /KinderCreature/src/login_signup/signup/signup.php");
        exit;
    }
    if (trim($_POST["password"]) !== trim($_POST["retype_password"])) {
        $_SESSION['error'] = "❌ Passwords do not match.";
        header("Location: /KinderCreature/src/login_signup/signup/signup.php");
        exit;
    }    

    // Database connection
    $mysqli = require('C:\xampp\htdocs\KinderCreature\src\database.php');

    // Check if the email already exists
    $email = $_POST["email"];
    $check_email_query = "SELECT id FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "❌ User already exists.";
        header("Location: /KinderCreature/src/login_signup/signup/signup.php");
        exit;
    }

    // Hash the password
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        $_SESSION['error'] = "❌ SQL error: " . $mysqli->error;
        header("Location: /KinderCreature/src/login_signup/signup/signup.php");
        exit;
    }

    $stmt->bind_param("sss", $_POST["username"], $_POST["email"], $password_hash);

    if ($stmt->execute()) {
        // Set success message and redirect to login page
        $_SESSION['success'] = "✔️ Account created successfully! You can now log in.";
        header("Location: /KinderCreature/src/login_signup/signup/signup.php");
        exit;
    } else {
        $_SESSION['error'] = "❌ Failed to create user. Please try again later.";
        header("Location: /KinderCreature/src/login_signup/signup/signup.php");
        exit;
    }
}
?>