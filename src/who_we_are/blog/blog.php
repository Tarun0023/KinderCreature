<?php

include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php';
include 'C:\xampp\htdocs\KinderCreature\src\database.php'; 


$limit = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$page = max($page, 1); 
$offset = ($page - 1) * $limit; 


$total_sql = "SELECT COUNT(*) AS total FROM blogs";
$total_result = $mysqli->query($total_sql);
$total_blogs = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_blogs / $limit); 


$sql = "SELECT * FROM blogs ORDER BY publish_date DESC LIMIT $limit OFFSET $offset";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="/KinderCreature/src/who_we_are/blog/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body class="blog-body">
    <header>
        <div class="main">
            <div class="background-over"></div>
            <div class="container-main">
                <h1 class="our-blg">Our Blogs</h1>
            </div>
        </div>
    </header>
    <section class="card" id="card">
        <div class="container">
            <div class="box-container">
                <?php
                if ($result && $result->num_rows > 0) {
                    
                    while ($blog = $result->fetch_assoc()) {
                        echo '<div class="box">
                                <div class="img">
                                    <img src="' . htmlspecialchars($blog['blog_image']) . '" alt="' . htmlspecialchars($blog['blog_title']) . '">
                                </div>
                                <div class="text">
                                    <div class="heading">
                                        <h2>' . htmlspecialchars($blog['blog_title']) . '</h2>
                                    </div>
                                    <div class="detial">' . htmlspecialchars(substr($blog['blog_description'], 0, 100)) . '...</div>
                                </div>
                                
                                    <a class="button" href="/KinderCreature/src/who_we_are/blog/detailed_blog/detailed_blog.php?blog_id=' . $blog['blog_id'] . '">Read more</a>
                                
                            </div>';
                    }
                } else {
                    echo '<p>No blogs available at the moment. Please check back later.</p>';
                }
                ?>
            </div>
            <div class="page-num">
                <div class="pagination">
                    <?php
                    if ($page > 1) {
                        echo '<a href="?page=' . ($page - 1) . '" class="prev">&laquo; Previous</a>';
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<a href="?page=' . $i . '" class="page ' . ($i === $page ? 'active' : '') . '">' . $i . '</a>';
                    }
                    if ($page < $total_pages) {
                        echo '<a href="?page=' . ($page + 1) . '" class="next">Next &raquo;</a>';
                    }
                    ?>
                </div>
            </div>
            <div class="share">
                <div class="share-container">
                    <h2>Share on Social</h2>
                    <div class="social-icons">
                        <a href="#" class="icon facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="icon twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="icon linkedin"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="icon instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<?php include('C:\xampp\htdocs\KinderCreature\src\layout\footer.php'); ?>
