<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Donated Users</title>
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
      <h1>View Donated Users</h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Donation Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Include database connection
          include '../database.php';

          // Fetch donation data
          $sql = "SELECT donate_id, CONCAT(f_name, ' ', l_name) AS full_name, donate_email, donate_amount FROM donations";
          $result = $mysqli->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>" . htmlspecialchars($row['donate_id']) . "</td>
                          <td>" . htmlspecialchars($row['full_name']) . "</td>
                          <td>" . htmlspecialchars($row['donate_email']) . "</td>
                          <td>₹" . htmlspecialchars($row['donate_amount']) . "</td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='4'>No donated users found</td></tr>";
          }

          // Close connection
          $mysqli->close();
          ?>
        </tbody>
      </table>
    </main>
  </div>
</body>
</html>