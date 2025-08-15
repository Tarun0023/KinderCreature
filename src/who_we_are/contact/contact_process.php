<?php
include('C:\xampp\htdocs\KinderCreature\src\database.php'); // Include the database connection
session_start(); // Start session to store flash messages

$message = "";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phoneno = trim($_POST['phoneno']);
    $message = trim($_POST['message']);
    $send_at = date("Y-m-d H:i:s"); // Current timestamp

    // Validate input fields
    if (empty($name) || empty($email) || empty($phoneno) || empty($message)) {
        $_SESSION['error_msg'] = "All fields are required. Please fill out the form.";
        header("Location: contact.php");
        exit();
    } else {
        // Prepare SQL query to insert data
        $sql = "INSERT INTO contact_us (co_name, co_email, co_contact, co_message, send_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssiss", $name, $email, $phoneno, $message, $send_at);

            if ($stmt->execute()) {
                $_SESSION['success_msg'] = "Your message has been sent successfully!";
                header("Location: contact.php");
                exit();
            } else {
                $_SESSION['error_msg'] = "Failed to send your message. Please try again later.";
                header("Location: contact.php");
                exit();
            }

            $stmt->close();
        } else {
            $_SESSION['error_msg'] = "Error in the SQL query: " . $mysqli->error_msg;
            header("Location: contact.php");
            exit();
        }
    }
}
?>
