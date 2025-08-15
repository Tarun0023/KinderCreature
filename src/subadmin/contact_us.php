<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
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
      <h1>Contact Us</h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Contact Number</th>
            <th>Received Date & Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Fetch data from the database
          $query = "SELECT * FROM contact_us";
          $result = $mysqli->query($query);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['co_id']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['co_name']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['co_email']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['co_message']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['co_contact']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['send_at']) . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='6'>No records found</td></tr>";
          }

          $mysqli->close();
          ?>
        </tbody>
      </table>
    </main>
  </div>
</body>
</html>
