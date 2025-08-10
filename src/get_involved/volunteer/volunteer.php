<?php
include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php';
?>

<?php
require 'C:\xampp\htdocs\KinderCreature\src\database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $firstName = $mysqli->real_escape_string($_POST['first-name']);
    $lastName = $mysqli->real_escape_string($_POST['last-name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $country = $mysqli->real_escape_string($_POST['country']);
    $phone = $mysqli->real_escape_string($_POST['phone']);

    // Insert data into the database
    $sql = "INSERT INTO volunteer_contacts (first_name, last_name, email, country, phone) 
            VALUES ('$firstName', '$lastName', '$email', '$country', '$phone')";

    if ($mysqli->query($sql)) {
        $successMessage = "Thank you for volunteering! Your details have been successfully submitted.";
    } else {
        $errorMessage = "Error: " . $mysqli->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteering Page</title>
    <link rel="stylesheet" href="volunteer.css">
</head>

<body class="volunteer-body">
    <div class="container">
        <section class="top">
            <div class="overlay"></div>
            <div class="top-container">
                <h1 class="under-care-title">Volunteer With Us</h1>
            </div>
        </section>
        <section class="main">
            <section class="perks">
                <div class="perks-content">
                    <img src="vol-1.jpg" alt="Volunteering Perks" class="perks-img">
                    <div class="perks-text">
                        <h2>PERKS OF VOLUNTEERING</h2>
                        <p>
                            By volunteering at the Wildlife SOS Rescue Facilities, you will make a major contribution to the
                            welfare of bears and elephants in India. The majority of the programme fees will go directly to
                            the centre, thus providing a critical source of funding for future work. Working with the local
                            community and the inspiring people who run Wildlife SOS is an opportunity of a lifetime!

                            No previous experience is required, but you will need to be willing and enthusiastic. A strong
                            interest in conservation and wildlife is recommended. You will need to be physically fit, able
                            to tolerate high temperatures and humidity, work well within a team and be adaptable to living
                            and working in a group.
                        </p>
                    </div>
                </div>
            </section>

            <section class="duties">
                <h2>VOLUNTEER DUTIES</h2>
                <div class="duties-content">
                    <div class="duties-text">
                        <!-- Volunteer duties description -->
                    </div>
                    <img src="vol-2.jpg" alt="Volunteer Duties" class="duties-img">
                </div>
            </section>

            <div class="form-container">
                <h1>Contact Form</h1>
                <?php if (!empty($successMessage)): ?>
                    <p class="success-message"><?php echo $successMessage; ?></p>
                <?php endif; ?>
                <?php if (!empty($errorMessage)): ?>
                    <p class="error-message"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
                <form action="volunteer.php" method="POST">
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" name="country" required>
                            <option value="" disabled selected>Select your country</option>
                            <option value="usa">United States</option>
                            <option value="india">India</option>
                            <option value="uk">United Kingdom</option>
                            <option value="canada">Canada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </section>
    </div>
</body>

</html>
