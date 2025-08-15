<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/database.php'; // Include database connection

// Fetch the animal for editing (if "edit" is set in the query string)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $sql = "SELECT * FROM animal_in_care WHERE aic_id = ?";
  $stmt = $mysqli->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $animal = $result->fetch_assoc(); // Fetch the animal data into the $animal variable
    $stmt->close();
  }
}

// Handle form submission for adding or updating an animal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['save'])) {
    // Insert new animal
    $name = $_POST['aic-name'];
    $image = $_POST['aic-image'];
    $description = $_POST['aic-description'];
    $status = $_POST['aic-status'];
    $admission_date = $_POST['aic-admission-date'];
    $species = $_POST['aic-species'];
    $breed = $_POST['aic-breed'];
    $color = $_POST['aic-color'];
    $gender = $_POST['aic-gender'];
    $age = $_POST['aic-age'];
    $location = $_POST['aic-location'];

    $sql = "INSERT INTO animal_in_care (aic_name, aic_image, aic_description, aic_status, aic_admission_date, aic_species, aic_breed, aic_color, aic_gender, aic_age, aic_location) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
      $stmt->bind_param("sssssssssis", $name, $image, $description, $status, $admission_date, $species, $breed, $color, $gender, $age, $location);
      $stmt->execute();
      $stmt->close();
    }
  } elseif (isset($_POST['update'])) {
    // Update existing animal
    $id = $_POST['aic-id'];
    $name = $_POST['aic-name'];
    $image = $_POST['aic-image'];
    $description = $_POST['aic-description'];
    $status = $_POST['aic-status'];
    $admission_date = $_POST['aic-admission-date'];
    $species = $_POST['aic-species'];
    $breed = $_POST['aic-breed'];
    $color = $_POST['aic-color'];
    $gender = $_POST['aic-gender'];
    $age = $_POST['aic-age'];
    $location = $_POST['aic-location'];

    $sql = "UPDATE animal_in_care 
                SET aic_name = ?, aic_image = ?, aic_description = ?, aic_status = ?, aic_admission_date = ?, aic_species = ?, aic_breed = ?, aic_color = ?, aic_gender = ?, aic_age = ?, aic_location = ?
                WHERE aic_id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
      $stmt->bind_param("sssssssssisi", $name, $image, $description, $status, $admission_date, $species, $breed, $color, $gender, $age, $location, $id);
      $stmt->execute();
      $stmt->close();
    }
  }
}

// Handle deletion of an animal
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM animal_in_care WHERE aic_id = ?";
  $stmt = $mysqli->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
  }
}

// Pagination setup
$records_per_page = 10; // Number of records per page
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($current_page < 1)
  $current_page = 1;

// Calculate the offset
$offset = ($current_page - 1) * $records_per_page;

// Get the total number of records
$total_records_sql = "SELECT COUNT(*) AS total FROM animal_in_care";
$total_result = $mysqli->query($total_records_sql);
if (!$total_result) {
  die("Error fetching total records: " . $mysqli->error);
}
$total_records = $total_result->fetch_assoc()['total'];

// Calculate total pages
$total_pages = ceil($total_records / $records_per_page);
if ($current_page > $total_pages) {
  $current_page = $total_pages;
  $offset = ($current_page - 1) * $records_per_page; // Recalculate offset
}

// Fetch records for the current page
$sql = "SELECT * FROM animal_in_care LIMIT ? OFFSET ?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
  die("Error preparing statement: " . $mysqli->error);
}
$stmt->bind_param("ii", $records_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

$animals = [];
if ($result) {
  while ($row = $result->fetch_assoc()) {
    $animals[] = $row;
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
  <title>Add Animals</title>
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
      <h1>Add Animals</h1>
      <!-- Animal Form -->
      <form class="add-animal-form" method="POST" action="">
        <input type="hidden" id="aic-id" name="aic-id" value="">
        <label for="aic-name">Animal Name:</label>
        <input type="text" id="aic-name" name="aic-name" placeholder="Enter Animal Name" required>
        <p></p>

        <label for="aic-image">Animal Image URL:</label>
        <input type="text" id="aic-image" name="aic-image" placeholder="Enter Image URL" required>
        <p></p>

        <label for="aic-description">Animal Description:</label>
        <textarea id="aic-description" name="aic-description" placeholder="Enter Description About Animal"
          required></textarea>
        <p></p>

        <label for="aic-status">Animal Status:</label>
        <select id="aic-status" name="aic-status">
          <option value="In Treatment">In Treatment</option>
          <option value="Treatment Done">Treatment Done</option>
          <option value="Adoption">Adoption</option>
        </select>
        <p></p>

        <label for="aic-admission-date">Admission Date:</label>
        <input type="date" id="aic-admission-date" name="aic-admission-date" required>
        <p></p>

        <label for="aic-species">Species:</label>
        <input type="text" id="aic-species" name="aic-species" placeholder="Enter Species Name" required>
        <p></p>

        <label for="aic-breed">Breed:</label>
        <input type="text" id="aic-breed" name="aic-breed" placeholder="Enter Breed" required>
        <p></p>

        <label for="aic-color">Color:</label>
        <input type="text" id="aic-color" name="aic-color" placeholder="Enter Color" required>
        <p></p>

        <label for="aic-gender">Gender:</label>
        <select id="aic-gender" name="aic-gender">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <p></p>

        <label for="aic-age">Age:</label>
        <input type="number" id="aic-age" name="aic-age" placeholder="Enter Age (in years)" required>
        <p></p>

        <label for="aic-location">Current Location:</label>
        <textarea id="aic-location" name="aic-location" placeholder="Enter Current Location" required></textarea>
        <p></p>

        <button type="submit" name="save" class="add-btn">Save Animal</button>
      </form>

      <!-- Edit Animal Form (Visible when editing an animal) -->
      <?php if (isset($animal)): ?>
        <h2>Edit Animal</h2>
        <form method="POST" class="edit-animal-form">
          <input type="hidden" name="aic-id" value="<?= htmlspecialchars($animal['aic_id']) ?>">

          <label for="aic-name">Animal Name:</label>
          <input type="text" id="aic-name" name="aic-name" value="<?= htmlspecialchars($animal['aic_name']) ?>" required>
          <p></p>

          <label for="aic-image">Animal Image URL:</label>
          <input type="text" id="aic-image" name="aic-image" value="<?= htmlspecialchars($animal['aic_image']) ?>"
            required>
          <p></p>

          <label for="aic-description">Animal Description:</label>
          <textarea id="aic-description" name="aic-description"
            required><?= htmlspecialchars($animal['aic_description']) ?></textarea>
          <p></p>

          <label for="aic-status">Status:</label>
          <select id="aic-status" name="aic-status" required>
            <option value="In Treatment" <?= $animal['aic_status'] == "In Treatment" ? 'selected' : '' ?>>In Treatment
            </option>
            <option value="Treatment Done" <?= $animal['aic_status'] == "Treatment Done" ? 'selected' : '' ?>>Treatment Done
            </option>
            <option value="Adoption" <?= $animal['aic_status'] == "Adoption" ? 'selected' : '' ?>>Adoption</option>
          </select>


          <label for="aic-admission-date">Admission Date:</label>
          <input type="date" id="aic-admission-date" name="aic-admission-date"
            value="<?= htmlspecialchars($animal['aic_admission_date']) ?>" required>
          <p></p>

          <label for="aic-species">Species:</label>
          <input type="text" id="aic-species" name="aic-species" value="<?= htmlspecialchars($animal['aic_species']) ?>"
            required>
          <p></p>

          <label for="aic-breed">Breed:</label>
          <input type="text" id="aic-breed" name="aic-breed" value="<?= htmlspecialchars($animal['aic_breed']) ?>"
            required>
          <p></p>

          <label for="aic-color">Color:</label>
          <input type="text" id="aic-color" name="aic-color" value="<?= htmlspecialchars($animal['aic_color']) ?>"
            required>
          <p></p>

          <label for="aic-gender">Gender:</label>
          <input type="text" id="aic-gender" name="aic-gender" value="<?= htmlspecialchars($animal['aic_gender']) ?>"
            required>
          <p></p>

          <label for="aic-age">Age:</label>
          <input type="number" id="aic-age" name="aic-age" value="<?= htmlspecialchars($animal['aic_age']) ?>" required>
          <p></p>

          <label for="aic-location">Location:</label>
          <textarea id="aic-location" name="aic-location"
            required><?= htmlspecialchars($animal['aic_location']) ?></textarea>
          <p></p>

          <button type="submit" name="update" class="update-btn">Update Animal</button>
        </form>
      <?php endif; ?>


      <!-- Animal List Table -->
      <h2>Animal List</h2>
      <table border="1">
        <thead>
          <tr>
            <th>Animal ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Status</th>
            <th>Admission Date</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Color</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Location</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($animals as $animal): ?>
            <tr>
              <td class="blog-td"><?php echo htmlspecialchars($animal['aic_id']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_name']); ?></td>
              <td><img src="<?php echo htmlspecialchars($animal['aic_image']); ?>" alt="Animal Image" width="50"></td>
              <td class="description-td"><?php echo htmlspecialchars($animal['aic_description']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_status']); ?></td>
              <td class="date"><?php echo htmlspecialchars($animal['aic_admission_date']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_species']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_breed']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_color']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_gender']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_age']); ?></td>
              <td><?php echo htmlspecialchars($animal['aic_location']); ?></td>
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