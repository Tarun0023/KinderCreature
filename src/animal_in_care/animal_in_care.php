<?php
include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php';
require 'C:\xampp\htdocs\KinderCreature\src\database.php';



$animals_per_page = 6; // Number of animals per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($current_page - 1) * $animals_per_page; // Calculate offset


$total_animals_result = $mysqli->query("SELECT COUNT(*) as total FROM animal_in_care");
$total_animals = $total_animals_result->fetch_assoc()['total'];
$total_pages = ceil($total_animals / $animals_per_page);


$sql = "SELECT * FROM animal_in_care LIMIT $offset, $animals_per_page";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="animal_in_care.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <title>Animal in care</title>
</head>

<body>
    <section class="top">
        <div class="overlay"></div>
        <div class="top-container">
            <h1 class="under-care-title">Under Care</h1>
        </div>
    </section>

    <section class="card-name">
    <div class="card-container">
        <div class="small-text">
            <h3 class="small">Meet the Animal</h3>
            <h2 class="big">
                Precious Souls Waiting for <span><span>Adoption</span></span>
            </h2>
        </div>
    </div>
    </section>
        
    <section class="animal-cards-section">
        <div class="container">
            <div class="animal-cards-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($animal = $result->fetch_assoc()): ?>
                        <div class="animal-card">
                            <div class="animal-img">
                                <img src="<?php echo $animal['aic_image']; ?>" alt="<?php echo $animal['aic_name']; ?>">
                            </div>
                            <div class="animal-text">
                                <div class="animal-heading">
                                    <h2><?php echo $animal['aic_name']; ?></h2>
                                </div>
                                <div class="animal-detail">
                                    <p><?php echo $animal['aic_description']; ?></p>
                                </div>
                            </div>
                            <div class="animal-button">
                                <a href="/kindercreature/src/animal_in_care/detailed_aic/detailed_aic.php?animal_id=<?php echo $animal['aic_id']; ?>">Read More</a>
                            </div>

                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No animals found.</p>
                <?php endif; ?>
            </div>
            <!-- Pagination -->
            <div class="pagination">
                <?php if ($current_page > 1): ?>
                    <a href="?page=<?php echo $current_page - 1; ?>" class="prev">&laquo; Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="page-number <?php echo $i === $current_page ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?php echo $current_page + 1; ?>" class="next">Next &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="our-work">
        <div class="card-container">
            <h3 class="small">Our Work</h3>
            <h2 class="big">
                WE CONSIDER <span>ANIMAL WELFARE</span> AS OUR TOP PRIORITY
            </h2>
        </div>
    </section>

    <section class="image-card">
        <div class="over"></div>
        <div class="our-image">
            <div class="container">
                <div class="image-grid">
                    <!-- Images -->
                    <img src="img1.png" alt="Animal 1">
                    <img src="img2.png" alt="Animal 2">
                    <img src="img 3.png" alt="Animal 3">
                    <img src="img4.png" alt="Animal 4">
                    <img src="img5.png" alt="Animal 5">
                    <img src="img6.png" alt="Animal 6">
                    <img src="img7.png" alt="Animal 7">
                    <img src="img8.png" alt="Animal 8">
                    <img src="img9.png" alt="Animal 9">
                    <img src="img10.png" alt="Animal 10">
                    <img src="img11.png" alt="Animal 11">
                    <img src="img12.png" alt="Animal 12">
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-section">
        <h2> <span>TESTIMONIALS</span><br>WHAT PEOPLE SAYS ABOUT US</h2>
        
        <!-- Testimonials Container -->
        <div class="testimonials">
            <!-- Testimonial 1 -->
            <div class="testimonial-card">
                <div class="quote">
                    <i class="fa-solid fa-quote-right"></i>
                </div>
                <p>
                    What Kinder Creature does for helpless animals is nothing short of extraordinary. They don’t just rescue animals; they heal them, rehabilitate them, and give them a second chance at life. Knowing that my donations go toward helping so many stray dogs and cats find a safe home makes me feel like I’m part of a bigger mission.
                </p>
                <div class="name">Karishma Shah</div>
                <div class="role">Donor</div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-card">
                <div class="quote">
                    <i class="fa-solid fa-quote-right"></i>
                </div>
                <p>
                    I’ve been a regular donor to Kinder Creature for the past few years, and I can vouch for the incredible work they do. Their rescue operations are efficient, and the way they care for sick and injured animals is touching. I’m deeply moved by their efforts to give every animal a better life.
                </p>
                <div class="name">Sanjay Rao</div>
                <div class="role">Donor</div>
            </div>
        </div>

        <!-- Pagination Dots -->
        <div class="pagination-dot">
            <span class="dot"></span>
            <span class="dot active"></span>
            <span class="dot"></span>
        </div>
    </section>
</body>

</html>

<?php include('C:\xampp\htdocs\KinderCreature\src\layout\footer.php'); ?>