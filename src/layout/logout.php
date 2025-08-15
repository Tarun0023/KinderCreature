<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

header("Location: /KinderCreature/src/home_page/home.php"); // Redirect to login page
exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="\KinderCreature\src\layout\header.css" rel="stylesheet"/>
</head>
<body>
    
</body>
</html>