<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $amount = trim($_POST['amount']);
    $payment_id = trim($_POST['payment_id']);

    // Split name into first and last name
    $name_parts = explode(" ", $full_name, 2);
    $f_name = $name_parts[0];
    $l_name = isset($name_parts[1]) ? $name_parts[1] : "";

    // Validate inputs
    if (empty($f_name) || empty($email) || empty($phone) || empty($amount) || empty($payment_id)) {
        echo json_encode(["status" => "error", "message" => "Missing required fields!"]);
        exit;
    }

    // Prepare SQL statement
    $stmt = $mysqli->prepare("INSERT INTO donations (f_name, l_name, donate_email, donate_contact, donate_amount, payment_id) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Prepare failed: " . $mysqli->error);
        echo json_encode(["status" => "error", "message" => "Database error"]);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("ssssds", $f_name, $l_name, $email, $phone, $amount, $payment_id);


    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request!"]);
}
?>
