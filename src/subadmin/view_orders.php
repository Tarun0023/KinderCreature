<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';  // Include the database connection

// Fetch orders from the database
$sql = "SELECT ckt_id, ckt_fname, ckt_lname, ckt_email, ckt_co_no, ckt_address, ckt_state, ckt_city, ckt_zipcode FROM checkout";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Orders</title>
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
    <h1>Orders</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Address</th>
                <th>State</th>
                <th>City</th>
                <th>Pincode</th>
                <th>Product Order List</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $result->fetch_assoc()): ?>
                <?php
                // Fetch order items for the current order
                $orderItemsSql = "SELECT oi.product_id, oi.quantity, oi.price, p.product_image 
                                  FROM order_items oi 
                                  JOIN products p ON oi.product_id = p.product_id 
                                  WHERE oi.ckt_id = ?";
                $stmt = $mysqli->prepare($orderItemsSql);
                $stmt->bind_param("i", $order['ckt_id']);
                $stmt->execute();
                $orderItemsResult = $stmt->get_result();
                $totalPrice = 60; // Start with a default value of ₹60

                ?>
                <tr>
                    <td><?= htmlspecialchars($order['ckt_id']) ?></td>
                    <td><?= htmlspecialchars($order['ckt_fname'] . ' ' . $order['ckt_lname']) ?></td>
                    <td><?= htmlspecialchars($order['ckt_email']) ?></td>
                    <td><?= htmlspecialchars($order['ckt_co_no']) ?></td>
                    <td><?= htmlspecialchars($order['ckt_address']) ?></td>
                    <td><?= htmlspecialchars($order['ckt_state']) ?></td>
                    <td><?= htmlspecialchars($order['ckt_city']) ?></td>
                    <td><?= htmlspecialchars($order['ckt_zipcode']) ?></td>
                    <td>
                        <ul>
                            <?php while ($item = $orderItemsResult->fetch_assoc()): ?>
                                <li><img src="<?= htmlspecialchars($item['product_image']) ?>" alt="Product Image" width="50"></li>
                            <?php
                                $totalPrice += $item['quantity'] * $item['price'];
                            ?>
                            <?php endwhile; ?>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <?php
                            $orderItemsResult->data_seek(0); // Reset result pointer
                            while ($item = $orderItemsResult->fetch_assoc()): ?>
                                <li><?= htmlspecialchars($item['quantity']) ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </td>
                    <td>
                        <ul>
                        ₹60 + <br>
                            <?php
                            $orderItemsResult->data_seek(0); // Reset result pointer
                            while ($item = $orderItemsResult->fetch_assoc()): ?>
                                <li>₹ <?= htmlspecialchars($item['price']) ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </td>
                    <td>₹ <?= htmlspecialchars($totalPrice) ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
</div>
</body>
</html>
