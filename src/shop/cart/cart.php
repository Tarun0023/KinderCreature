<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="/src/shop/cart/cart.css">
    <title>Shopping Cart</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="/src/shop/shop.php" class="back-btn">
                <i class="fa-sharp fa-solid fa-arrow-left-long"></i> BACK
            </a>
            <h1>Shopping Cart</h1>
        </div>

        <!-- Dynamic Cart Items -->
        <div class="cart-items" id="cart-items">
            <!-- Cart items will be rendered dynamically using JavaScript -->
        </div>

        <!-- Summary Section -->
        <div class="summary" id="summary">
            <h2>Summary</h2>
            <div class="summary-item">
                <span>ITEMS <span id="total-items">0</span></span>
                <span id="items-total">₹ 0</span>
            </div>
            <div class="summary-item">
                <span>Shipping</span>
                <span id="shipping">₹ 60</span>
            </div>
            <div class="summary-item total">
                <span>TOTAL PRICE</span>
                <span id="total-price">₹ 0</span>
            </div>
            <a class="checkout-btn" href="/src/shop/checkout/checkout.php">CHECKOUT</a>
        </div>
    </div>

    <script>
        // Retrieve cart data from localStorage
        const cartContainer = document.getElementById('cart-items');
        const summarySection = document.getElementById('summary');
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Render cart items
        function renderCart() {
            cartContainer.innerHTML = ''; // Clear the cart container

            if (cart.length === 0) {
                // Display "Cart is Empty" message
                cartContainer.innerHTML = `
                    <div class="empty-cart">
                        <p>Your cart is empty.</p>
                        <a href="/src/shop/shop.php" class="continue-shopping">Continue Shopping</a>
                    </div>
                `;
                // Hide the summary section
                summarySection.style.display = 'none';
                return; // Exit the function early
            }

            // Show the summary section if the cart is not empty
            summarySection.style.display = 'block';

            let totalItems = 0;
            let itemsTotal = 0;

            cart.forEach((item, index) => {
                totalItems += item.quantity;
                itemsTotal += item.quantity * item.price;

                // Create cart item HTML
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <div class="item-details" onclick="window.location.href='/src/shop/detailed_product/detailed_product.php?id=${item.id}'">
                        <div class="item-name">${item.name}</div>
                        <div class="item-description">${item.description}</div>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn minus" onclick="updateQuantity(${index}, -1)"><i class="fa-solid fa-minus"></i></button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="quantity-btn plus" onclick="updateQuantity(${index}, 1)"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div class="item-price">₹ ${item.price * item.quantity}</div>
                    <button class="remove-btn" onclick="removeItem(${index})">×</button>
                `;
                cartContainer.appendChild(cartItem);
            });

            // Update totals
            document.getElementById('total-items').innerText = totalItems;
            document.getElementById('items-total').innerText = `₹ ${itemsTotal}`;
            document.getElementById('total-price').innerText = `₹ ${itemsTotal + 60}`;
        }

        // Update item quantity
        function updateQuantity(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1); // Remove item if quantity is zero
            }
            saveCart();
        }

        // Remove an item from the cart
        function removeItem(index) {
            cart.splice(index, 1);
            saveCart();
        }

        // Save the cart to localStorage and re-render
        function saveCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }

        // Initialize cart rendering
        renderCart();
    </script>
</body>
</html>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout\footer.php'; ?>