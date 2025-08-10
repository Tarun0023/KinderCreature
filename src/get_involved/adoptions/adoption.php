<?php
include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php';
require 'C:\xampp\htdocs\KinderCreature\src\database.php';


// Pagination setup
$records_per_page = 6; // Number of records per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;

// Calculate the offset
$offset = ($current_page - 1) * $records_per_page;

// Get the total number of records
$total_records_query = "SELECT COUNT(*) AS total FROM animal_in_care WHERE aic_status = 'Adoption'";
$total_records_result = mysqli_query($mysqli, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total'];

// Calculate total pages
$total_pages = ceil($total_records / $records_per_page);
if ($current_page > $total_pages) $current_page = $total_pages;

// Fetch paginated records
$query = "SELECT * FROM animal_in_care WHERE aic_status = 'Adoption' LIMIT $records_per_page OFFSET $offset";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adoption.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <title>Adoption</title>
</head>

<body>
    <section class="top">
        <div class="overlay"></div>
        <div class="top-container">
            <h1 class="adoption-title">Adoptions</h1>
        </div>
    </section>

    <div class="card-container">
        <div class="small-text">
            <h3 class="small">
                Meet the Animal
            </h3>
            <h2 class="big">
                Precious Souls Waiting for <span>Adoption</span>
            </h2>
        </div>
    </div>

    <section class="animal-cards-section">
        <div class="container">
            <div class="animal-cards-container">
                <?php
                // Check if any animals were found
                if (mysqli_num_rows($result) > 0) {
                    // Loop through and display each animal
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Variables for each animal's data
                        $image = $row['aic_image'];
                        $name = $row['aic_name'];
                        $description = $row['aic_description'];
                        ?>
                        <div class="animal-card">
                            <div class="animal-img">
                                <img src="<?php echo $image; ?>" alt="">
                            </div>
                            <div class="animal-text">
                                <div class="animal-heading">
                                    <h2><?php echo $name; ?></h2>
                                </div>
                                <div class="animal-detail">
                                    <p><?php echo $description; ?></p>
                                </div>
                            </div>
                            <div class="animal-button">
                                <a href="/KinderCreature/src/get_involved/adoptions/detailed_adoption/detailed_adoption.php?id=<?php echo $row['aic_id']; ?>">Read More</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No animals available for adoption at the moment.</p>";
                }
                ?>
            </div>
        </div>
        <!-- this is for pagination -->
        <div class="page-num">
            <div class="pagination">
                <?php
                // Previous Button
                if ($current_page > 1) {
                    echo '<a href="?page=' . ($current_page - 1) . '" class="prev">&laquo; Previous</a>';
                }
  
                // Page Buttons
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo '<a href="?page=' . $i . '" class="page ' . ($i === $current_page ? 'active' : '') . '">' . $i . '</a>';
                }
  
                // Next Button
                if ($current_page < $total_pages) {
                    echo '<a href="?page=' . ($current_page + 1) . '" class="next">Next &raquo;</a>';
                }
                ?>
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
                    <!-- Static Images -->
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
        <div class="pagination">
            <span class="dot"></span>
            <span class="dot active"></span>
            <span class="dot"></span>
        </div>
    </section>

</body>
</html>
<?php include('C:\xampp\htdocs\KinderCreature\src\layout\footer.php'); ?>
