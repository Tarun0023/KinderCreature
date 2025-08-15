<?php
include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php';
require 'C:\xampp\htdocs\KinderCreature\src\database.php';

// Fetch the animal ID from the URL
$animal_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch animal details from the database
$query = "SELECT * FROM animal_in_care WHERE aic_id = $animal_id AND aic_status = 'Adoption'";
$result = mysqli_query($mysqli, $query);

// Check if the animal exists
if ($result && $animal = mysqli_fetch_assoc($result)) {
    // Extract animal data
    $name = htmlspecialchars($animal['aic_name']);
    $image = htmlspecialchars($animal['aic_image']);
    $status = htmlspecialchars($animal['aic_status']);
    $admission_date = htmlspecialchars($animal['aic_admission_date']);
    $species = htmlspecialchars($animal['aic_species']);
    $breed = htmlspecialchars($animal['aic_breed']);
    $color = htmlspecialchars($animal['aic_color']);
    $gender = htmlspecialchars($animal['aic_gender']);
    $age = htmlspecialchars($animal['aic_age']);
    $location = htmlspecialchars($animal['aic_location']);
    $description = htmlspecialchars($animal['aic_description']);
} else {
    echo "<p>Animal not found or no longer available for adoption.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detailed_adoption.css">
    <title><?php echo $name; ?> - Adoption Details</title>
</head>
<body class="theme-body">
    <main class="theme-main">
        <!-- Header Section -->
        <section class="theme-hero">
            <h1>Meet <?php echo $name; ?></h1>
            <p>A loving animal looking for a forever home!</p>
        </section>

        <!-- Details Section -->
        <section class="theme-details">
            <div class="details-row">
                <div class="image-box">
                    <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                </div>
                <div class="info-box">
                    <ul>
                        <li><strong>Name:</strong> <?php echo $name; ?></li>
                        <li><strong>Status:</strong> <?php echo $status; ?></li>
                        <li><strong>Admission Date:</strong> <?php echo $admission_date; ?></li>
                        <li><strong>Species:</strong> <?php echo $species; ?></li>
                        <li><strong>Breed:</strong> <?php echo $breed; ?></li>
                        <li><strong>Color:</strong> <?php echo $color; ?></li>
                        <li><strong>Gender:</strong> <?php echo $gender; ?></li>
                        <li><strong>Age:</strong> <?php echo $age; ?></li>
                        <li><strong>Location:</strong> <?php echo $location; ?></li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Description Section -->
        <section class="theme-description">
            <p><?php echo $description; ?></p>
            <a href="\KinderCreature\src\get_involved\donate\donate.php" class="donate-btn">Help <?php echo $name; ?></a>
        </section>

        <!-- Shelter Info Section -->
        <section class="theme-shelter-info">
            <h2>Adopt <?php echo $name; ?> from Our Shelter</h2>
            <p>
                <?php echo $name; ?> is currently located at <strong><?php echo $location; ?></strong>. 
                To adopt <?php echo $name; ?>, please visit our shelter or contact us for more information.
            </p>
            <ul>
                <li><strong>Shelter Name:</strong> Shelter A</li>
                <li><strong>Address:</strong> <a href="https://maps.app.goo.gl/B4GvWh3jnwLDu157A" class="ft-address-text">SG Highway, Ahmedabad, Gujarat INDIA</a></li>
                <li><strong>Contact:</strong> <a href="tel:+91 1234567890">+91 1234567890</a></li>
                <li><strong>Email:</strong> <a href="mailto:support.luxuriouslivings.in">kindercreature@gmail.com</a></li>
            </ul>
            <div class="map-box">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.9708608721876!2d72.49029207516344!3d22.988098979197986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b0f57f45edf%3A0x371e4963c483ec2d!2sLJ%20UNIVERSITY!5e0!3m2!1sen!2sin!4v1735316389767!5m2!1sen!2sin" 
                    width="100%"
                    height="400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>
    </main>
</body>
</html>
<?php include('C:\xampp\htdocs\KinderCreature\src\layout\footer.php'); ?>
