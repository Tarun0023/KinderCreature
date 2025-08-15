<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';


$total_users_query = "SELECT COUNT(*) AS total_users FROM users";
$total_users_result = $mysqli->query($total_users_query);

$total_users = 0;

if ($total_users_result && $row = $total_users_result->fetch_assoc()) {
    $total_users = $row['total_users'];
}
?>
<?php
$total_blogs_query = "SELECT COUNT(*) AS total_blogs FROM blogs";
$total_blogs_result = $mysqli->query($total_blogs_query);

$total_blogs = 0;

if ($total_blogs_result && $row = $total_blogs_result->fetch_assoc()) {
    $total_blogs = $row['total_blogs'];
}
?>
<?php
$total_products_query = "SELECT COUNT(*) AS total_products FROM products";
$total_products_result = $mysqli->query($total_products_query);

$total_products = 0;

if ($total_products_result && $row = $total_products_result->fetch_assoc()) {
    $total_products = $row['total_products'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subadmin Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="dashboard">
    <!-- Sidebar -->
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
    <!-- Main Content -->
    <main class="main-content">
      <!-- Dashboard Overview Section -->
      <section id="overview">
        <h1>Dashboard Overview</h1>
        <div class="overview-cards">
          <div class="card">Total Users: <?php echo $total_users; ?></div>
          <div class="card">Total Blogs: <?php echo $total_blogs; ?></div>
          <div class="card">Total Products: <?php echo $total_products; ?></div>
          <div class="card">Total Donations: $5,000</div>
        </div>
      </section>

      <!-- View Users Section -->
      <section id="users">
        <h1>View Users</h1>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch users from the database
            $query = "SELECT id, username, email, role FROM users";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                // Loop through each row and display it in the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
