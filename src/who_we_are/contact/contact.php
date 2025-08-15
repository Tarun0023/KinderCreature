<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/src/who_we_are/contact/contact.css">
    <title>Contact Us</title>
    <link rel="icon" type="image/x-icon" href="/img/web_logo.png">
</head>

<body>
    <main>
        <section class="contactus section">
            <div class="container contactus-container">
                <div class="contactus-box">
                    <div class="contactus-title-box">
                        <h3 class="contactus-title">Contact Form</h3>
                    </div>

                    <form action="contact_process.php" method="post">
                        <div class="contactus-form-main">
                            <div class="contactus-form">
                            <?php
                                if (!empty($_SESSION['success_msg'])) {
                                    echo '<div class="alert-box-success_msg">' . $_SESSION['success_msg'] . '</div>';
                                    unset($_SESSION['success_msg']); // Clear the message after displaying
                                }

                                if (!empty($_SESSION['error_msg'])) {
                                    echo '<div class="alert-box-error_msg">' . $_SESSION['error_msg'] . '</div>';
                                    unset($_SESSION['error_msg']); // Clear the message after displaying
                                }
                        ?>
                                <label for="name">Name</label>
                                <input type="text" id="contact name" name="name" placeholder="Your Name.." required>

                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" placeholder="Your E-mail.." required>

                                <label for="phoneno">Phone No.</label>
                                <input type="tel" id="phoneno" name="phoneno" placeholder="Your Phone No.." required>
                            </div>
                            <div class="contactus-form second">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" placeholder="Write Your Message Here.."
                                    style="height:150px" required></textarea>
                                <input type="submit" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="boxs">
            <div class="container">
                <div class="heading">
                    <span> Get in touch </span>
                    <div class="main-heading">
                        <h3>We’re Here to <span>Help</span></h3>
                    </div>
                </div>
                <div class="box-parent">
                    <div class="box">
                        <div class="loc-img"><i class="fa-solid fa-location-dot fa-2xl"></i></div>
                        <div class="detail">
                            <div class="name">Kolad Location</div>
                            <div class="other">GUT NO 360 Roha, Maharashtra 402109</div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="loc-img"><i class="fa-regular fa-envelope fa-2xl"></i></div>
                        <div class="detail">
                            <div class="name">Contact Us</div>
                            <div class="phone-address">
                                <a href="tel:+91 1234567890">
                                            +91 1234567890
                                </a>
                                <br>
                                <a href="#" class="ft-address-text">
                                            SG Highway, Ahmedabad, Gujarat INDIA
                                </a>
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/src/layout/footer.php'; ?>