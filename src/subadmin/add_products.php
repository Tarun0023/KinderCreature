<?php
// Include the database connection file
include $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';

// DELETE PRODUCT FUNCTION
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully!'); window.location.href='add_products.php';</script>";
    } else {
        echo "<script>alert('Failed to delete product.'); window.location.href='add_products.php';</script>";
    }
}

// EDIT PRODUCT FUNCTION
$product = null;  // Default value for edit
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $stmt = $mysqli->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

// Handle form submission for adding or updating a product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = strtolower($_POST['category-name']);
    $product_name = $_POST['product-name'];
    $product_price = $_POST['product-price'];
    $product_picture = $_POST['product-picture'];
    $product_description = $_POST['product-description'];

    if (isset($_POST['edit_product_id'])) {
        // Update product
        $edit_product_id = $_POST['edit_product_id'];
        $sql = "UPDATE products SET category_name = ?, product_name = ?, product_price = ?, product_image = ?, product_description = ? WHERE product_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssdssi', $category_name, $product_name, $product_price, $product_picture, $product_description, $edit_product_id);

        if ($stmt->execute()) {
            echo "<script>alert('Product updated successfully!'); window.location.href='add_products.php';</script>";
        } else {
            echo "<script>alert('Failed to update product.'); window.location.href='add_products.php';</script>";
        }
    } else {
        // Add new product
        $sql = "INSERT INTO products (category_name, product_name, product_price, product_image, product_description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssdss', $category_name, $product_name, $product_price, $product_picture, $product_description);

        if ($stmt->execute()) {
            echo "<script>alert('Product added successfully!');</script>";
        } else {
            echo "<script>alert('Failed to add product.');</script>";
        }
    }
}

// Pagination setup
$records_per_page = 5; // Number of records per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) $current_page = 1;

// Calculate the offset
$offset = ($current_page - 1) * $records_per_page;

// Get the total number of records
$total_records_sql = "SELECT COUNT(*) AS total FROM products";
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
$sql = "SELECT * FROM products LIMIT ? OFFSET ?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Error preparing statement: " . $mysqli->error);
}
$stmt->bind_param("ii", $records_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
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
  <title>Add Products</title>
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
      <!-- Add Product Form -->
      <h2>Add Product</h2>
      <form method="POST" class="add-product-form">
        <div class="form-row">
          <div class="form-column">
            <p>
            <label for="category-name">Category Name:</label>
            <input type="text" id="category-name" name="category-name" placeholder="Enter Category" required>
            </p>
          </div>
          <div class="form-column">
            <p>
            <label for="product-name">Name of Product:</label>
            <input type="text" id="product-name" name="product-name" placeholder="Enter Product Name" required>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
            <label for="product-price">Price of Product:</label>
            <input type="number" id="product-price" name="product-price" placeholder="Enter Product Price" required>
            </p>
          </div>
          <div class="form-column">
            <p>
            <label for="product-picture">Product Image URL:</label>
            <input type="text" id="product-picture" name="product-picture" placeholder="Enter Product Image URL" required>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
            <label for="product-description">Product Description:</label>
            <textarea id="product-description" name="product-description" placeholder="Enter Product Description" required></textarea>
            </p>
          </div>
        </div>
        <div class="form-row">
          <p><button type="submit" class="add-btn">Add Product</button></p>
        </div>
      </form>

      <!-- Edit Product Form (Visible when editing a product) -->
      <?php if (isset($product)): ?>
      <h2>Edit Product</h2>
      <form method="POST" class="edit-product-form">
        <input type="hidden" name="edit_product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
        <div class="form-row">
          <div class="form-column">
            <p>
            <label for="category-name">Category Name:</label>
            <input type="text" id="category-name" name="category-name" value="<?= htmlspecialchars($product['category_name']) ?>" required>
            </p>
          </div>
          <div class="form-column">
            <p>
            <label for="product-name">Name of Product:</label>
            <input type="text" id="product-name" name="product-name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
            <label for="product-price">Price of Product:</label>
            <input type="number" id="product-price" name="product-price" value="<?= htmlspecialchars($product['product_price']) ?>" required>
            </p>
          </div>
          <div class="form-column">
            <p>
            <label for="product-picture">Product Image URL:</label>
            <input type="text" id="product-picture" name="product-picture" value="<?= htmlspecialchars($product['product_image']) ?>" required>
            </p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <p>
            <label for="product-description">Product Description:</label>
            <textarea id="product-description" name="product-description" required><?= htmlspecialchars($product['product_description']) ?></textarea>
            </p>
          </div>
        </div>
        <div class="form-row">
          <p><button type="submit" class="update-btn">Update Product</button></p>
        </div>
      </form>
      <?php endif; ?>

      <!-- Product List Table -->
      <h2>Product List</h2>
      <table border="1">
        <thead>
          <tr>
            <th>Product ID</th>
            <th>Category Name</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Picture</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
            <tr>
              <td class="blog-td"><?= $product['product_id'] ?></td>
              <td><?= $product['category_name'] ?></td>
              <td><?= $product['product_name'] ?></td>
              <td>₹<?= number_format($product['product_price'], 2) ?></td>
              <td><img src="<?= $product['product_image'] ?>" alt="<?= $product['product_name'] ?>" width="50"></td>
              <td  class="description-td"><?= $product['product_description'] ?></td>
              <td>
                <div class="buttonn">
                  <div class="edit">
                  <a href="add_products.php?edit_id=<?= $product['product_id'] ?>" class="edit-button">Edit</a>
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
