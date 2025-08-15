<?php
// Include the database connection file
include('C:\xampp\htdocs\KinderCreature\src\database.php');

// Handle adding a new blog
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-blog'])) {
    $blog_title = $_POST['blog-title'];
    $blog_description = $_POST['blog-description'];
    $blog_image = $_POST['blog-image'];
    $publish_date = $_POST['published-date'];

    $sql = "INSERT INTO blogs (blog_title, blog_description, blog_image, publish_date) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $blog_title, $blog_description, $blog_image, $publish_date);
        if ($stmt->execute()) {
            echo "<script>alert('Blog added successfully!'); window.location='manage_blogs.php';</script>";
        } else {
            echo "<script>alert('Error adding blog: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $mysqli->error . "');</script>";
    }
}

// Handle deleting a blog
if (isset($_GET['delete'])) {
    $blog_id = $_GET['delete'];
    $sql = "DELETE FROM blogs WHERE blog_id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $blog_id);
        if ($stmt->execute()) {
            echo "<script>alert('Blog deleted successfully!'); window.location='manage_blogs.php';</script>";
        } else {
            echo "<script>alert('Error deleting blog: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $mysqli->error . "');</script>";
    }
}

// Handle editing a blog
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update-blog'])) {
    $blog_id = $_POST['blog-id'];
    $blog_title = $_POST['blog-title'];
    $blog_description = $_POST['blog-description'];
    $blog_image = $_POST['blog-image'];
    $publish_date = $_POST['published-date'];

    $sql = "UPDATE blogs SET blog_title = ?, blog_description = ?, blog_image = ?, publish_date = ? WHERE blog_id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $blog_title, $blog_description, $blog_image, $publish_date, $blog_id);
        if ($stmt->execute()) {
            echo "<script>alert('Blog updated successfully!'); window.location='manage_blogs.php';</script>";
        } else {
            echo "<script>alert('Error updating blog: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $mysqli->error . "');</script>";
    }
}

// Pagination setup
$records_per_page = 10; // Number of records per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;

// Calculate the offset
$offset = ($current_page - 1) * $records_per_page;

// Get the total number of records
$total_records_sql = "SELECT COUNT(*) AS total FROM blogs";
$total_result = $mysqli->query($total_records_sql);
if (!$total_result) {
    die("Error fetching total product: " . $mysqli->error);
}
$total_records = $total_result->fetch_assoc()['total'];

// Calculate total pages
$total_pages = ceil($total_records / $records_per_page);
if ($current_page > $total_pages) {
    $current_page = $total_pages;
    $offset = ($current_page - 1) * $records_per_page; // Recalculate offset
}

// Fetch records for the current page
$sql = "SELECT * FROM blogs LIMIT ? OFFSET ?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Error preparing statement: " . $mysqli->error);
}
$stmt->bind_param("ii", $records_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

$blogs = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
} else {
    die("Error fetching records: " . $stmt->error);
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Blogs</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="dashboard">
  <nav id="sidebar">
  <div class="logo">
        <img src="web_logo.png" alt="" class="kc-img" >
        <p>KinderCreature</p>
      </div>
      <ul>
        <!-- <li>Subadmin Dashboard</li> -->
        <li class="active"><a href="dashboard.php">Dashboard Overview & View Users</a></li>
        <li class="active"><a href="manage_blogs.php">Manage Blogs</a></li>
        <li class="active"><a href="contact_us.php">Contact Us</a></li>
        <li class="active"><a href="add_products.php">Add Products</a></li>
        <li class="active"><a href="add_animals.php" class="active">Add Animals</a></li>
        <li class="active"><a href="view_donated_users.php">View Donated Users</a></li>
        <li class="active"><a href="view_orders.php">View Orders</a></li>
        <li class="active"><a href="volunteer_contact.php">Volunteer Contact</a></li>
      </ul>
      <div class="home-button">
        <a href="\KinderCreature\src\home_page\home.php" class="btn">Home Page</a>
      </div>
    </nav>

    <main class="main-content">
      <h1>Manage Blogs</h1>

      <!-- Add Blog Form -->
      <h2>Add Blog</h2>
      <form class="add-blog-form" method="POST">
        <div class="form-row">
          <div class="form-column">
            <p>
              <label for="blog-title">Blog Title:</label>
              <input type="text" id="blog-title" name="blog-title" placeholder="Enter Blog Title" required>
            </p>
          </div>
          <div class="form-column">
            <p>
              <label for="blog-description">Description:</label>
              <textarea id="blog-description" name="blog-description" placeholder="Enter Blog Description" required></textarea>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
              <label for="blog-image">Image URL:</label>
              <input type="text" id="blog-image" name="blog-image" placeholder="Enter Blog Image URL" required>
            </p>
          </div>
          <div class="form-column">
            <p>
              <label for="published-date">Published Date:</label>
              <input type="date" id="published-date" name="published-date" required>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
              <button type="submit" name="add-blog" class="add-btn">Add Blog</button>
            </p>
          </div>
        </div>
      </form>

      <!-- Edit Blog Form -->
      <?php if (isset($_GET['edit'])): 
        $edit_id = $_GET['edit'];
        $sql = "SELECT * FROM blogs WHERE blog_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $edit_blog = $result->fetch_assoc();
        $stmt->close();
      ?>
      <h2>Edit Blog</h2>
      <form class="edit-blog-form" method="POST">
        <input type="hidden" name="blog-id" value="<?= htmlspecialchars($edit_blog['blog_id']) ?>">
        <div class="form-row">
          <div class="form-column">
            <p>
              <label for="blog-title">Blog Title:</label>
              <input type="text" id="blog-title" name="blog-title" value="<?= htmlspecialchars($edit_blog['blog_title']) ?>" required>
            </p>
          </div>
          <div class="form-column">
            <p>
              <label for="blog-description">Description:</label>
              <textarea id="blog-description" name="blog-description" required><?= htmlspecialchars($edit_blog['blog_description']) ?></textarea>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
              <label for="blog-image">Image URL:</label>
              <input type="text" id="blog-image" name="blog-image" value="<?= htmlspecialchars($edit_blog['blog_image']) ?>" required>
            </p>
          </div>
          <div class="form-column">
            <p>
              <label for="published-date">Published Date:</label>
              <input type="date" id="published-date" name="published-date" value="<?= htmlspecialchars($edit_blog['publish_date']) ?>" required>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
              <button type="submit" name="update-blog" class="update-btn">Update Blog</button>
            </p>
          </div>
        </div>
      </form>
      <?php endif; ?>

      <!-- Blog List -->
      <table>
        <thead>
          <tr>
            <th>Blog ID</th>
            <th>Blog Title</th>
            <th class="description-td">Description</th>
            <th>Image</th>
            <th>Published Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($blogs as $blog): ?>
            <tr>
              <td class="blog-td"><?= htmlspecialchars($blog['blog_id']) ?></td>
              <td><?= htmlspecialchars($blog['blog_title']) ?></td>
              <td class="description-td"><?= htmlspecialchars($blog['blog_description']) ?></td>
              <td><img src="<?= htmlspecialchars($blog['blog_image']) ?>" alt="Blog Image" width="50"></td>
              <td><?= htmlspecialchars($blog['publish_date']) ?></td>
              <td>
                <div class="buttonn">
                  <div class="edit">
                <a href="manage_blogs.php?edit=<?= $blog['blog_id'] ?>" class="edit-button">Edit</a>
                </div>
                <div class="delete">
                <a href="manage_blogs.php?delete=<?= $blog['blog_id'] ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a></div>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>


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
    </main>
  </div>
</body>
</html>
