<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php'; // Database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate-Form</title>
    <link rel="stylesheet" href="donate.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script> <!-- Razorpay Checkout -->
</head>

<body>
    <section class="Donate">
        <div class="container">
            <div class="heading">
                <h2 class="name">
                    Donate For Kinder Creature
                </h2>
            </div>
        </div>
        
        <div class="donation-amount-name">
            <div class="donate-name">
                <h2>Donation Amount</h2>
            </div>
        </div>
        
        <div class="donation-box">
            <div class="box" onclick="setAmount(100)">Rs 100</div>
            <div class="box" onclick="setAmount(200)">Rs 200</div>
            <div class="box" onclick="setAmount(500)">Rs 500</div>
            <div class="box" onclick="setAmount(1000)">Rs 1000</div>
            <div class="box" onclick="setAmount(1500)">Rs 1500</div>
            <div class="box" onclick="setAmount(2000)">Rs 2000</div>
            <div class="box" onclick="setAmount(2500)">Rs 2500</div>
            <div class="box" onclick="setAmount(3000)">Rs 3000</div>
            <div class="input-box">
                <input type="number" id="custom-amount" class="input" placeholder="Custom Amount" oninput="updateAmount()">
            </div>
        </div>

        <div class="donation-container">
            <form id="donation-form">
                <div class="cus-label">
                    <label for="donation" class="information">Custom Amount</label>
                </div>
                <div class="input-container">
                    <span class="currency-symbol">₹</span>
                    <input type="number" id="donation" name="donation" value="0" class="cus-inp" oninput="updateAmountDisplay()">
                </div>

                <div class="donation-info">
                    <div class="heading">
                        <h2>Personal Info</h2>
                        <hr>
                    </div>
                    <div class="feild">
                        <label for="name" class="info">Your Name *</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" class="d-inp" required>

                        <label for="email" class="info">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="Email Address" class="d-inp" required>

                        <label for="phone" class="info">Phone *</label>
                        <input type="tel" id="phone" name="phone" placeholder="Phone" class="d-inp" required>

                        <label for="address" class="info">Address *</label>
                        <input type="text" id="address" name="address" placeholder="Address" class="d-inp" required>
                    </div>

                    <p id="amount-display" class="amountDisplay">Entered Amount: ₹0</p>

                    <button type="button" class="donate-btn" onclick="openRazorpay()">Donate Now</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function updateAmount() {
            let customAmount = document.getElementById('custom-amount').value;
            document.getElementById('donation').value = customAmount;
            updateAmountDisplay();
        }

        function setAmount(amount) {
            document.getElementById('donation').value = amount;
            updateAmountDisplay();
        }

        function updateAmountDisplay() {
            const donationInput = document.getElementById('donation');
            const amountDisplay = document.getElementById('amount-display');
            const amount = donationInput.value;
            amountDisplay.textContent = `Entered Amount: ₹${amount}`;
        }

        function openRazorpay() {
    let amount = document.getElementById('donation').value;
    if (amount <= 0) {
        alert("Please enter a valid donation amount!");
        return;
    }

    let options = {
        "key": "rzp_test_0hLwpCzX3vhsQW", // Replace with your Razorpay API key
        "amount": amount * 100, // Convert to paise
        "currency": "INR",
        "name": "Kinder Creature",
        "description": "Donation",
        "image": "https://i.imgur.com/uQKCuzN.png",
        "handler": function(response) {
            // Create overlay
            let overlay = document.createElement("div");
            overlay.id = "thank-you-overlay";
            overlay.innerHTML = `<h1 class="thank-you-text">THANKS FOR SUPPORTING US! ❤️</h1>`;
            document.body.appendChild(overlay);

            // Force a reflow to ensure the element is rendered before applying the fade-in
            void overlay.offsetWidth;

            // Apply fade-in effect
            overlay.classList.add("fade-in");

            // Send donation details to save in the database
            let donorData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                amount: amount,
                payment_id: response.razorpay_payment_id
            };

            fetch('save_donation.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(donorData)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Log response
            })
            .catch(error => console.error('Error:', error));

            // Redirect back to donation page after 4 seconds
            setTimeout(() => {
                overlay.classList.add("fade-out");
                setTimeout(() => {
                    window.location.href = "donate.php";
                }, 1000); // Wait for fade-out before redirect
            }, 4000);
        },
        "prefill": {
            "name": document.getElementById('name').value,
            "email": document.getElementById('email').value,
            "contact": document.getElementById('phone').value
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    let rzp = new Razorpay(options);
    rzp.open();
}


        document.addEventListener('DOMContentLoaded', function() {
            updateAmountDisplay();
        });
    </script>

</body>
</html>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/footer.php'; ?>
