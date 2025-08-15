<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php'; // Ensure this connects to your database

// Check if 'blog_id' is provided in the URL
if (isset($_GET['blog_id']) && is_numeric($_GET['blog_id'])) {
    $blog_id = (int)$_GET['blog_id'];

    // Fetch blog details from the database
    $sql = "SELECT * FROM blogs WHERE blog_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    // Check if the blog exists
    if (!$blog) {
        echo "<p>Blog not found. Please check the URL or go back to the blog list.</p>";
        exit;
    }
} else {
    echo "<p>Invalid blog ID. Please go back to the blog list.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/who_we_are/blog/detailed_blog/detailed_blog.css">
    <title><?php echo htmlspecialchars($blog['blog_title']); ?></title>
</head>
<body class="detailed_blog body">
    <main class="blogs">
        <section class="blog-section">
            <div class="container blog-container">
                <div class="blog-card">
                    <div class="blog-thumb">
                        <img src="<?php echo htmlspecialchars($blog['blog_image']); ?>" alt="<?php echo htmlspecialchars($blog['blog_title']); ?>" />
                    </div>
                    <div class="blog-content">
                        <h2 class="blog-title"><?php echo htmlspecialchars($blog['blog_title']); ?></h2>
                        <div class="blog-meta">
                            <p class="blog-date">Published on: <?php echo htmlspecialchars(date("F j, Y", strtotime($blog['publish_date']))); ?></p>
                        </div>
                        <p class="blog-description">
                            <?php echo nl2br(htmlspecialchars($blog['blog_description'])); ?>
                        </p>
                        <p class="blog-footer">"Thank you for reading! Share your thoughts and feedback with us."</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/footer.php'; ?>
