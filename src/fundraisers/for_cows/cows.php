<?php include('C:\xampp\htdocs\KinderCreature\src\layout\header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care for our Cows</title>
    <link rel="icon" type="image/x-icon" href="/KinderCreature/img/web_logo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="container">
            <section class="donation-section">
                <div class="donation-content">
                    <h2>Care for our Cows</h2>
                    <p>We recently rescued 3 cows and they have found a safe haven at our sanctuary, away from harm and neglect.</p>
                    <p>However, caring for these gentle souls requires constant attention, food, and other resources. We rely on the generosity of animal lovers like you to ensure their well-being. Join us in our mission to provide these cows with the care and nourishment they deserve.</p>
                    <button class="donate-btn">donate now (india donors)</button>
                </div>
                <div class="donation-image">
                    <img src="../images/WhatsApp-Image-2024-03-13-at-10.56.55.jpeg" alt="Rescued cows relaxing at the sanctuary">
                </div>
            </section>

            <!-- New Campaign Section with Slider -->
            <section class="campaign-section">
                <h2>Discover other campaigns</h2>

                <div class="campaign-slider">
                    <button class="slider-btn left" id="slide-left">&#9664;</button>
                    <div class="campaign-cards" id="campaign-cards">
                        <div class="campaign-card">
                            <img src="../images/Large-Ambulance-Campaign_One-size-does-not-fit-all.jpg" alt="Campaign Image 1">
                            <h3>Large Ambulance</h3>
                            <p>sample1.</p>
                            <button class="learn-btn"><a href="\KinderCreature\src\fundraisers\large_ambulance\large_ambulance.php" style="color: white;">learn more</a></button>
                        </div>
                        <div class="campaign-card">
                            <img src="../images/WhatsApp-Image-2024-03-13-at-10.56.55.jpeg" alt="Campaign Image 2">
                            <h3>Care for our Cows</h3>
                            <p>sample2.</p>
                            <button class="learn-btn"><a href="\KinderCreature\src\fundraisers\for_cows\cows.php" style="color: white;">learn more</a></button>
                        </div>
                        <div class="campaign-card">
                            <img src="../images/beds-for-pets.jpeg" alt="Campaign Image 3">
                            <h3>A bed in need is a friend indeed</h3>
                            <p>sample3.</p>
                            <button class="learn-btn"><a href="\KinderCreature\src\fundraisers\A_bed_in_need_is_a_friend_indeed\a_bed_in_need_is_a_friend_indeed.php" style="color: white;">learn more</a></button>
                        </div>
                        <div class="campaign-card">
                            <img src="campaign3.jpg" alt="Campaign Image 3">
                            <h3>Sponsor Our Animals</h3>
                            <p>sample4.</p>
                            <button class="learn-btn">learn more</button>
                        </div>
                        <div class="campaign-card">
                            <img src="campaign3.jpg" alt="Campaign Image 3">
                            <h3>Sponsor Our Animals</h3>
                            <p>sample5.</p>
                            <button class="learn-btn">learn more</button>
                        </div>
                    </div>

                    <button class="slider-btn right" id="slide-right">&#9654;</button>
                </div>
            </section>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>
<?php include('C:\xampp\htdocs\KinderCreature\src\layout\footer.php'); ?>