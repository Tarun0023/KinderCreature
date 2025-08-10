<?php
include 'C:\xampp\htdocs\KinderCreature\src\layout\header.php';
include 'C:\xampp\htdocs\KinderCreature\src\database.php'; // Include database connection

// Fetch product details based on ID
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    // Prepare and execute the query
    $stmt = $mysqli->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<script>alert('Product not found!'); window.location.href = '/KinderCreature/src/shop/shop.php';</script>";
        exit();
    }
    $stmt->close();
} else {
    echo "<script>alert('Invalid Product ID!'); window.location.href = '/KinderCreature/src/shop/shop.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="detailed_product.css">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Detailed Product</title>
</head>

<body class="detailed-product-body">
  <main class="d-p-main">
    <div class="card">
      <div class="card__title">
        <div>
          <a class="icon-d-p" href="/KinderCreature/src/shop/shop.php">
            <span class="back-icon"><i class="fa fa-arrow-left d-p"></i></span>
            <span class="back-text">Back</span>
          </a>
        </div>
        <h3 class="cat-name"><?php echo htmlspecialchars(strtoupper($product['category_name'])); ?></h3>

      </div>
      <div class="card__body">
        <div class="half one">
          <div class="image">
            <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
          </div>
        </div>
        <div class="half two">
          <div class="featured_text">
              <h1 class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></h1>
          </div>
          <hr>
          <div class="description">
              <p class="product-description"><?php echo htmlspecialchars($product['product_description']); ?></p>
          </div>
          <span class="stock">
              <i class="fa fa-check"></i> In stock
          </span>
          <hr>
          <p class="price">MRP ₹<span class="product-price"><?php echo htmlspecialchars($product['product_price']); ?></span></p>
      </div>
      </div>
      <div class="card__footer">
          <div class="action">
              <form id="add-to-cart-form" onsubmit="addToCart(event)">
                  <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>">
                  <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>">
                  <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['product_image']); ?>">
                  <input type="hidden" name="product_description" value="<?php echo htmlspecialchars($product['product_description']); ?>">
                  <button type="submit" name="addtocart">Add to cart</button>
              </form>
          </div>
      </div>
      </div>
      </main>

        
        <!-- Floating Add to Cart Button -->
        <a href="/KinderCreature/src/shop/cart/cart.php" class="floating-cart-button">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-text">Cart</span>
            <span class="cart-count" id="cart-count">0</span>
        </a>

        <script>
            function addToCart(event, productId) {
                event.preventDefault(); // Prevent the default form submission
                const form = document.getElementById(`add-to-cart-form-${productId}`);
                const formData = new FormData(form);
                const product = {
                    id: formData.get('product_id'),
                    name: formData.get('product_name'),
                    price: formData.get('product_price'),
                    image: formData.get('product_image'),
                    description: formData.get('product_description'),
                    quantity: 1
                };
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const existingProductIndex = cart.findIndex(item => item.id === product.id);
                if (existingProductIndex !== -1) {
                    cart[existingProductIndex].quantity += 1;
                } else {
                    cart.push(product);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
                alert('Product added to cart successfully!');
            }
            function updateCartCount() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                document.getElementById('cart-count').textContent = totalItems;
            }
            // Call this on page load to initialize the count
            document.addEventListener('DOMContentLoaded', updateCartCount);
        </script>
      </body>
</html>

<?php include('C:\xampp\htdocs\KinderCreature\src\layout\footer.php'); ?>
