<?php
// Include the database connection file
include('C:\xampp\htdocs\KinderCreature\src\database.php');

// Fetch the total number of users from the database
$total_users_query = "SELECT COUNT(*) AS total_users FROM users";
$total_users_result = $mysqli->query($total_users_query);

// Initialize the total users count
$total_users = 0;

if ($total_users_result && $row = $total_users_result->fetch_assoc()) {
    $total_users = $row['total_users'];
}

// Handle Delete Request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: dashboard.php?message=User deleted successfully");
        exit;
    } else {
        $error_message = "Failed to delete the user.";
    }
}

// Handle Edit Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'], $_POST['role'])) {
    $edit_id = intval($_POST['edit_id']);
    $new_role = $_POST['role'];

    $edit_query = "UPDATE users SET role = ? WHERE id = ?";
    $stmt = $mysqli->prepare($edit_query);
    $stmt->bind_param("si", $new_role, $edit_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?message=Role updated successfully");
        exit;
    } else {
        $error_message = "Failed to update the role.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="\KinderCreature\src\admin\adminstyle.css">
</head>
<body>
  <div class="dashboard">
    <!-- Sidebar -->
    <nav id="sidebar">
    <div class="logo">
        <img src="\KinderCreature\img\web_logo.png" alt="" class="kc-img" >
        <p>KinderCreature</p>
      </div>


      <ul>
        <li>Dashboard</li>
        <li class="active">
          <a href="dashboard.php">Dashboard Overview & view user</a>
        </li>
      </ul>

      <div class="home-button">
        <a href="\KinderCreature\src\home_page\home.php" class="btn">Home Page</a>
      </div>


    </nav>
    <!-- Main Content -->
    <main class="main-content">
      <!-- Dashboard Overview Section -->
      
      
      <!-- <div class="topnav">
      <div class="profile">
      <img src="profile-pic.jpg" alt="Profile Picture" class="profile-pic">
      <span class="username">John Doe</span>
     <button class="log-out">Log-Out</button>
    </div>
</div> -->
      <section id="overview">
        <div class="heading">
        <h1>Dashboard Overview</h1>
        </div>
        <div class="overview-cards">
          <div class="card">Total Users: <?php echo $total_users; ?></div>
          <!-- <div class="card">Total Blogs: 30</div>
          <div class="card">Total Products: 20</div>
          <div class="card">Total Donations: $5,000</div> -->
        </div>
      </section>

      <!-- View Users Section -->
      <section id="users">
        <h1>View Users</h1>
        <?php if (isset($error_message)): ?>
          <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['message'])): ?>
          <div class="success"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch users from the database
            $query = "SELECT id, username, email, role FROM users";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                            <td>
                                <form action='' method='post' style='display:inline-block;'>
                                    <input type='hidden' name='edit_id' value='{$row['id']}'>
                                    <select name='role'>
                                        <option value='User' " . ($row['role'] === 'User' ? 'selected' : '') . ">User</option>
                                        <option value='Subadmin' " . ($row['role'] === 'Subadmin' ? 'selected' : '') . ">Subadmin</option>
                                        <option value='Admin' " . ($row['role'] === 'Admin' ? 'selected' : '') . ">Admin</option>
                                    </select>
                                    <button type='submit'>Edit</button>
                                </form>
                                <button class='delete-button'><a href='dashboard.php?delete_id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
