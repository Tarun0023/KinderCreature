<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/KinderCreature/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <link href="https://fonts.cdnfonts.com/css/brasika-display-trial" rel="stylesheet">
        <script src="/KinderCreature/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
        <link href="\KinderCreature\src\layout\header.css" rel="stylesheet"/>
        <title>Header</title>
        <link rel="icon" type="image/x-icon" href="/KinderCreature/img/web_logo.png">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container-fluid">
                <a href="\KinderCreature\src\home_page\home.php">
                    <img class="nav-logo" src="\KinderCreature\img\web_logo.png" alt="logo"></a>
                <a class="navbar-brand" >Kinder<span class="navbar-brand-name"> Creature</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav column-gap-2 mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/KinderCreature/src/home_page/home.php">Home</a>
                        </li>
                        <li class="nav-item dropdown navbar-nav">
                            <a href="products.php" type="button" class="nav-link dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                                Work
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="">
                                        what we do &raquo;
                                    </a>
                                    <ul class="dropdown-menu dropdown-submenu">
                                        <li>
                                            <a class="dropdown-item" href="/KinderCreature/src/work/what_we_do/sterilization/sterilization.php">sterilization</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        Fundraisers &raquo;
                                    </a>
                                    <ul class="dropdown-menu dropdown-submenu">
                                    <li><a class="dropdown-item" href="\KinderCreature\src\fundraisers\for_cows\cows.php">care for our cows</a></li>
                                <li><a class="dropdown-item" href="\KinderCreature\src\fundraisers\large_ambulance\large_ambulance.php">large ambulance</a></li>
                                <li><a class="dropdown-item" href="\KinderCreature\src\fundraisers\A_bed_in_need_is_a_friend_indeed\a_bed_in_need_is_a_friend_indeed.php">a bed in need is a friend indeed</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="\KinderCreature\src\animal_in_care\animal_in_care.php">Animal in care</a>
                        </li>
                        <li class="nav-item dropdown navbar-nav">
                            <a href="products.php" type="button" class="nav-link dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                                Get Involved
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="\KinderCreature\src\get_involved\adoptions\adoption.php">adoptions</a></li>
                                <li><a class="dropdown-item" href="\KinderCreature\src\get_involved\volunteer\volunteer.php">volunteer</a></li>
                                <li><a class="dropdown-item" href="\KinderCreature\src\get_involved\donate\donate.php">donate</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown navbar-nav">
                            <a href="products.php" type="button" class="nav-link dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                                Who we are
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/KinderCreature/src/who_we_are/about/about.php">about</a></li>
                                <li><a class="dropdown-item" href="/KinderCreature/src/who_we_are/blog/blog.php">blog</a></li>
                                <li><a class="dropdown-item" href="/KinderCreature/src/who_we_are/contact/contact.php">contact</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/KinderCreature/src/shop/shop.php">Shop</a>
                        </li>
                    </ul>
                    <ul class="nav justify-content-end column-gap-3">
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                            <li class="nav-item logout-button" >
                                <a class="nav-link" href="\KinderCreature\src\layout\logout.php">Logout</a>
                            </button>
                        <?php else: ?>
                            <li class="nav-item signup-button">
                                <a class="nav-link" href="/KinderCreature/src/login_signup/signup/signup.php">Sign Up</a>
                            </li>
                            <li class="nav-item login-button">
                                <a class="nav-link" href="/KinderCreature/src/login_signup/login/login.php">Log in</a>
                            </li>
                        <?php endif; ?>
                        <!-- Check user role and display corresponding button -->
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item logout-button">
                                <a class="nav-link admin" href="/KinderCreature/src/admin/dashboard.php">Admin Dashboard</a>
                            </li>
                        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'subadmin'): ?>
                            <li class="nav-item logout-button">
                                <a class="nav-link subadmin" href="/KinderCreature/src/subadmin/dashboard.php">Subadmin Dashboard</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item logout-button">
                                <a class="nav-link donate" href="/KinderCreature/src/get_involved/donate/donate.php">Donate <i class="fa-solid fa-heart"></i></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>