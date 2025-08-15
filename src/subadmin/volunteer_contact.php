<?php
require 'C:\xampp\htdocs\KinderCreature\src\database.php';

// Query to fetch volunteer contact details
$query = "SELECT * FROM volunteer_contacts";
$result = $mysqli->query($query);

// Check if data was fetched
if ($result->num_rows > 0) {
    // Fetch data row by row
    $volunteers = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $volunteers = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volunteer Contact</title>
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
      <h1>Volunteer Contact Information</h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>Phone Number</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($volunteers)) {
              // Loop through the volunteers and display each one
              foreach ($volunteers as $volunteer) {
                  echo "<tr>";
                  echo "<td>" . $volunteer['id'] . "</td>";
                  echo "<td>" . $volunteer['first_name'] . " " . $volunteer['last_name'] . "</td>";
                  echo "<td>" . $volunteer['email'] . "</td>";
                  echo "<td>" . $volunteer['country'] . "</td>";
                  echo "<td>" . $volunteer['phone'] . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5'>No volunteer data available</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </main>
  </div>
</body>
</html>
