<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php';  // Include the header (if needed)
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';  // Include the database connection

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
    <link rel="stylesheet" href="/src/shop/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <title>Products</title>
    <style>
        .toast-top-right-custom {
            top: 70px; /* Adjust this value to move the notification down */
            right: 12px;
        }
    </style>
</head>
<body>
    <!-- <div class="container">
        <div class="sidenav">
            
            <a href="#category1-section">Category 1</a>
            <a href="#category2-section">Category 2</a>
            <a href="#category3-section">Category 3</a>
        </div>
    </div> -->

    <?php
    // Fetch categories from the database
    $categoriesQuery = "SELECT DISTINCT category_name FROM products";
    $categoriesResult = $mysqli->query($categoriesQuery);

    // Loop through categories to display each category's products
    while ($category = $categoriesResult->fetch_assoc()) {
        $categoryName = $category['category_name'];

        // Fetch products for the current category
        $productsQuery = "SELECT * FROM products WHERE category_name = '$categoryName'";
        $productsResult = $mysqli->query($productsQuery);
    ?>
        <!-- Dynamic Category Section -->
        <section class="category-section" id="category-<?php echo $categoryName; ?>-section">
            <div class="container category-container" id="category-container-<?php echo $categoryName; ?>">
                <div class="ourproduct">
                    <div class="ourproduct-text">
                        <p class="ourproduct-title"><?php echo $categoryName; ?></p>
                    </div>

                    <div class="card-list">
                        <?php
                        // Display products for the current category
                        while ($product = $productsResult->fetch_assoc()) {
                            $productId = $product['product_id'];
                            $productName = $product['product_name'];
                            $productDescription = $product['product_description'];
                            $productPrice = $product['product_price'];
                            $productImage = $product['product_image'];
                        ?>
                            <!-- Product Card -->
                            <div class="product-card" id="product-<?php echo $productId; ?>" name="pd_id">
                                <a href="/src/shop/detailed_product/detailed_product.php?id=<?php echo $productId; ?>" class="product-tumb">
                                    <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
                                </a>
                                <div class="product-details">
                                    <h4><a href="/src/shop/detailed_product/detailed_product.php?id=<?php echo $productId; ?>"><?php echo $productName; ?></a></h4>
                                    <a href="/src/shop/detailed_product/detailed_product.php?id=<?php echo $productId; ?>" class="product-description"><?php echo $productDescription; ?></a>
                                    <hr>
                                    <div class="product-bottom-details">
                                        <span class="product-price">MRP : ₹ <span class="product-prize-actual"><?php echo $productPrice; ?></span></span>
                                        <form id="add-to-cart-form-<?php echo $productId; ?>" onsubmit="addToCart(event, <?php echo $productId; ?>)">
                                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                            <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">
                                            <input type="hidden" name="product_image" value="<?php echo $productImage; ?>">
                                            <input type="hidden" name="product_description" value="<?php echo $productDescription; ?>">
                                            <button type="submit" name="addtocart" class="product-addtocart">
                                                <span class="cart-icon"><i class="fas fa-shopping-cart"></i></span>
                                                <span class="add-to-cart-text">Add to Cart</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>

    <!-- Floating Add to Cart Button -->
    <a href="/src/shop/cart/cart.php" class="floating-cart-button">
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
            toastr.success('Product added to cart successfully!');
        }

        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-count').textContent = totalItems;
        }

        // Call this on page load to initialize the count
        document.addEventListener('DOMContentLoaded', updateCartCount);

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right-custom",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
</body>
</html>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/footer.php'; ?>
