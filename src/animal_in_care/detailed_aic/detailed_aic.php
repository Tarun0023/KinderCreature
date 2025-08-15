<?php 
include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php'; 
require 'C:\xampp\htdocs\KinderCreature\src\database.php';


if (isset($_GET['animal_id']) && is_numeric($_GET['animal_id'])) {
    $aic_id = $_GET['animal_id'];

    
    $stmt = $mysqli->prepare("SELECT * FROM animal_in_care WHERE aic_id = ?");
    $stmt->bind_param("i", $aic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $animal = $result->fetch_assoc();
    } else {
        
        echo "Animal not found.";
        exit;
    }
} else {
    
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detailed_aic.css">
    <title><?php echo htmlspecialchars($animal['aic_name']); ?>'s Care Details</title>
</head>
<body class="detailed_aic-body">
    <main class="aic-detail">
    <section class="aic-details">
        <div class="container">
            <!-- Title -->
            <h1 class="aic-title">
                <?php echo htmlspecialchars($animal['aic_name']); ?>'s Care Details
            </h1>
            <!-- Content Wrapper -->
            <div class="aic-content">
                <!-- Left: Image -->
                <div class="aic-image">
                    <img src="<?php echo htmlspecialchars($animal['aic_image']); ?>" alt="<?php echo htmlspecialchars($animal['aic_name']); ?>'s Image">
                </div>
                <!-- Right: Details -->
                <div class="aic-details-content">
                    <ul>
                        <li><strong>Name:</strong> <?php echo htmlspecialchars($animal['aic_name']); ?></li>
                        <li><strong>Status:</strong> <?php echo htmlspecialchars($animal['aic_status']); ?></li>
                        <li><strong>Admission Date:</strong> <?php echo htmlspecialchars($animal['aic_admission_date']); ?></li>
                        <li><strong>Species:</strong> <?php echo htmlspecialchars($animal['aic_species']); ?></li>
                        <li><strong>Breed:</strong> <?php echo htmlspecialchars($animal['aic_breed']); ?></li>
                        <li><strong>Color:</strong> <?php echo htmlspecialchars($animal['aic_color']); ?></li>
                        <li><strong>Gender:</strong> <?php echo htmlspecialchars($animal['aic_gender']); ?></li>
                        <li><strong>Age:</strong> <?php echo htmlspecialchars($animal['aic_age']); ?> years</li>
                        <li><strong>Location:</strong> <?php echo htmlspecialchars($animal['aic_location']); ?></li>
                    </ul>
                </div>
            </div>
            <!-- Bottom Description -->
            <div class="aic-description">
                <p>
                    <?php echo htmlspecialchars($animal['aic_description']); ?>
                </p>
                <a href="\KinderCreature\src\get_involved\donate\donate.php" class="donate-button">Donate for them</a>
            </div>
        </div>
    </section>

    </main>
</body>
</html>

<?php include('C:\xampp\htdocs\KinderCreature\src\layout\footer.php'); ?>
