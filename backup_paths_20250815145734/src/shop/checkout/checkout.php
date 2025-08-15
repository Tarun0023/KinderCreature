<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php';
?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $cart = json_decode($_POST['cart'], true);  // Decode the cart JSON string
    
    // Validate the data (you can add more validation if needed)
    if (empty($firstName) || empty($lastName) || empty($email) || empty($contactNo) || empty($address) || empty($state) || empty($city) || empty($zipcode)) {
        echo "All fields are required!";
        exit;
    }
    
    // Insert the data into the checkout table
    $sql = "INSERT INTO checkout (ckt_fname, ckt_lname, ckt_email, ckt_co_no, ckt_address, ckt_state, ckt_city, ckt_zipcode) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssss", $firstName, $lastName, $email, $contactNo, $address, $state, $city, $zipcode);
    
    // Execute the query
    if ($stmt->execute()) {
        // Get the checkout (order) ID of the last inserted record
        $checkout_id = $mysqli->insert_id;
        
        // Insert cart items into the order_items table
        foreach ($cart as $item) {
            // Validate product_id
            if (empty($item['id'])) {
                echo "Error: Product ID is missing for one of the cart items.";
                exit;
            }
    
            $sql = "INSERT INTO order_items (ckt_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iiii", $checkout_id, $item['id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }
    
        echo "<script>alert('Checkout and order items saved successfully!'); window.location.href = '/KinderCreature/src/shop/shop.php';</script>";
        // Optionally, redirect to a confirmation page or display a message
    } else {
        echo "Error: " . $stmt->error;
    }
    // Close the statement
    $stmt->close();
}
?>

<script src="/src/shop/checkout/cities.js"></script>
<!DOCTYPE html>
<html lang="en">
<button type="button" class="back-btn"><a href="/src/shop/cart/cart.php">Return to Cart</a></button>
<head>
    echo "<script>alert('Checkout and order items saved successfully!'); window.location.href = '/src/shop/shop.php';</script>";
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/footer.php'; ?>
    <link rel="stylesheet" href="checkout.css">
    <script src="\KinderCreature\src\shop\checkout\cities.js"></script>
</head>
<body class="checkout-body">
    <div class="container">
        <div class="checkout-container">
            <div class="checkout-form">
                <h2 class="section-title">Checkout Info</h2>
                <form id="checkoutForm" method="POST" action="checkout.php">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" id="firstName" name="firstName" required>
                            <label for="firstName">First Name</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="lastName" name="lastName" required>
                            <label for="lastName">Last Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="contactNo" name="contactNo" required>
                        <label for="contactNo">Contact No</label>
                    </div>
                    <div class="form-group">
                        <input type="text" id="address" name="address" required>
                        <label for="address">Address</label>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <select id="state" name="state" class="form-control" required onchange="print_city('city', this.selectedIndex);"></select>
                        </div>
                        <div class="form-group">
                            <select id="city" name="city" class="form-control" required></select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="zipcode" name="zipcode" required>
                            <label for="zipcode">Zipcode</label>
                        </div>
                    </div>
                    <div class="form-buttons">
                        <button type="button" class="back-btn"><a href="\KinderCreature\src\shop\cart\cart.php">Return to Cart</a></button>
                        <button type="submit" class="continue-btn">Continue</button>
                    </div>
                    <div class="payment-info">
                        <p class="cod-info">* Only Cash on Delivery is accepted</p>
                    </div>
                    <!-- Hidden input to send cart data to server -->
                    <input type="hidden" id="cartData" name="cart" value=""/>
                </form>
            </div>
            <div class="cart-summary">
                <h2 class="section-title">Your Cart</h2>
                <div class="cart-items" id="cart-items">
                    <!-- Cart items will be dynamically generated -->
                </div>
                <div class="price-details">
                    <div class="price-row">
                        <span>Item Subtotal</span>
                        <span id="subtotal">₹0</span>
                    </div>
                    <div class="price-row">
                        <span>Shipping</span>
                        <span id="shipping">₹60</span>
                    </div>
                    <div class="price-row total">
                        <span>Total</span>
                        <span id="total">₹0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to check if cart is empty and submit the form
        function checkCartAndSubmit() {
            // Retrieve cart data from localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Log cart data for debugging
            console.log(cart);

            // Check if cart is empty and prevent further actions
            if (cart.length === 0) {
                alert("Your cart is empty!");
                document.getElementById('checkoutForm').querySelector('button[type="submit"]').disabled = true;  // Disable the submit button
                return;
            }

            // Render cart summary and update hidden input field
            const cartItemsContainer = document.getElementById('cart-items');
            const subtotalElement = document.getElementById('subtotal');
            const totalElement = document.getElementById('total');
            const shippingCost = 60;

            // Clear previous items
            cartItemsContainer.innerHTML = '';

            // Calculate subtotal
            let subtotal = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);

            // Update UI with cart items
            cart.forEach(item => {
                if (!item.image || !item.name || !item.quantity || !item.price) {
                    console.error('Missing required item data:', item);
                    return;
                }

                // Create HTML for cart item
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="item-image">
                    <div class="item-details">
                        <p class="item-name">${item.name}</p>
                        <p class="item-quantity">Quantity: ${item.quantity}</p>
                        <p class="item-price">₹${item.price * item.quantity}</p>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);
            });

            // Update subtotal and total
            subtotalElement.textContent = `₹${subtotal}`;
            totalElement.textContent = `₹${subtotal + shippingCost}`;

            // Add the cart data as a JSON string to the hidden input field
            document.getElementById('cartData').value = JSON.stringify(cart);

            // Initialize state dropdown
            print_state("state");
        }

        // Call the function to check cart and submit the form
        checkCartAndSubmit();
    </script>
</body>
</html>
