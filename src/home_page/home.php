<?php
// Use document-root relative includes so this works on the host (htdocs)
include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="icon" type="image/x-icon" href="/img/web_logo.png">
    <link rel="stylesheet" href="/src/home_page/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">

</head>

<body class="home-body">
    <section class="home">
        <div class="main">
            <div class="both-parent">
                <div class="imgs"></div>
                <div class="content">
                    <div class="heading">
                        <h2>Help us help them.</h2>
                    </div>
                    <div class="detials">
                        <p>Every day, we come across countless animals in need of rescuing, nourishment, medical aid, shelter, and rehabilitation.</p>
                    </div>
                    <div class="highlight">
                        <p><strong>This is your chance to save a life.</strong></p>
                    </div>
                    <div class="button">
                        <a href="/src/get_involved/donate/donate.php" class="support-btn">
                            Support Our Cause
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="treatment">
        <div class="container">
            <div class="heading-trt">
                <h2>Animals In Treatment</h2>
                <div class="line-img">
                    <img src="/src/home_page/home_img/line.png" alt="">
                </div>
            </div>
            <div class="trt-container">
                <div class="trt-box">
                    <div class="trt-img">
                        <img src="/src/home_page/home_img/bx1.jpeg" alt="">
                    </div>
                    <div class="trt-desrip">
                        <div class="name">
                            <a href="#" class="trt-a">
                                <h2>Shaurya</h2>
                            </a>
                        </div>
                        <div class="trt-detial">
                            <p>Shaurya, a 5-year-old male dog rescued from Malad East, desperately needs Rs. 25,000 for
                                treatment of a severe back injury that has led to a maggot infection. The poor pup is in
                                excruciating pain and requires immediate medical attention to save his life. Please help
                                this innocent animal in urgent distress regain his health and freedom from suffering.
                            </p>
                        </div>
                    </div>
                    <div class="trt-btn">
                        <a href="/src/animal_in_care/animal_in_care.php" class="trt-btn-span">Read More</a>
                    </div>

                </div>
                <div class="trt-box">

                    <div class="trt-img">
                        <img src="/src/home_page/home_img/bx2.jpeg" alt="">
                    </div>
                    <div class="trt-desrip">
                        <div class="name">
                            <a href="#" class="trt-a">
                                <h2>Shera</h2>
                            </a>
                        </div>
                        <div class="trt-detial">
                            <p>Shera, a one-year-old male cat rescued from Malad West, desperately needs Rs. 25,000 for
                                medical treatment after being attacked by dogs, leaving him paralysed. The poor cat
                                requires immediate surgery and rehabilitation to have any chance of walking again. Your
                                donation can provide Shera with the care he needs to recover and find a loving home.
                                Please help this innocent victim of a tragic accident regain his health and mobility.
                            </p>
                        </div>
                    </div>
                    <div class="trt-btn">
                        <a href="/src/animal_in_care/animal_in_care.php" class="trt-btn-span">Read More</a>
                    </div>
                </div>

                <div class="trt-box">
                    <div class="trt-img">
                        <img src="/src/home_page/home_img/bx3.jpeg" alt="">
                    </div>
                    <div class="trt-desrip">
                        <div class="name">
                            <a href="#" class="trt-a">
                                <h2>Brownie</h2>
                            </a>
                        </div>
                        <div class="trt-detial">
                            <p>Brownie, a one-year-old male cat rescued from Kharodi, Malad West, is in urgent need of
                                Rs. 20,000 for medical treatment of a severe leg wound sustained in an accident. The
                                poor cat requires immediate care to recover and avoid further suffering. Your donation
                                can make a lifesaving difference for Brownie.</p>
                        </div>
                    </div>
                    <div class="trt-btn" id="trt-read">
                        <a href="/src/animal_in_care/animal_in_care.php" class="trt-btn-span">Read More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="ambu-bed">
        <div class="container">
            <div class="both-container">
                <div class="both-boxs">
                    <div class="heading-both">
                        <a href="" class="trt-a">
                            <h2>We Require a Large Ambulance</h2>
                        </a>
                    </div>
                    <div class="trt-img">
                        <img src="/src/home_page/home_img/ambulence.jpg" alt="">
                    </div>
                    <div class="contents">
                        <div class="discri">
                            <p class="first"> We urgently need a larger animal ambulance to provide timely emergency
                                care for severely injured cows and horses. </p>
                            <p class="second">Please donate to help us purchase this vital vehicle and save these
                                animals’ lives.</p>
                        </div>
                    </div>
                    <div class="btns">
                        <a href="/src/get_involved/donate/donate.php" class="support-btn">
                            Donate now
                        </a>
                    </div>


                </div>

                <div class="both-boxs">
                    <div class="heading-both">
                        <a href="" class="trt-a">
                            <h2>We Require a Large Ambulance</h2>
                        </a>
                    </div>
                    <div class="trt-img">
                        <img src="/src/home_page/home_img/bed.jpg" alt="">
                    </div>
                    <div class="contents">
                        <p class="first">Kinder Creature is procuring beds for the animals at the shelter. A total of 30 small, 90
                            medium and 30 large-sized beds will be purchased.</p>
                        <p class="second">Your contribution will help animals sleep better and live healthy lives.</p>
                    </div>
                    <div class="btns">
                        <a href="/src/get_involved/donate/donate.php" class="support-btn">
                            Donate now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="care">
        <div class="container">
            <div class="care-tips">
                <div class="heading-trt">
                    <h2>Animal care, tips and more on our blog</h2>
                </div>
            </div>
            <div class="card-container">
                <div class="card">
                    <img src="/src/home_page/home_img/tips1.png" alt="Pet Introduction">
                    <div class="card-content">
                        <h3 class="card-title">Introducing a New Pet to Your Existing Companion</h3>
                        <p class="card-description">Introducing a new pet to a jealous furry friend may take time and patience, but with the right approach, it can lead to a harmonious household.</p>
                        <div class="read-more">
                            <a href="/src/who_we_are/blog/blog.php">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="/src/home_page/home_img/tips2.jpg" alt="Bathing Fussy Pets">
                    <div class="card-content">
                        <h3 class="card-title">Taming the Tub: A Soapy Guide to Bathing Fussy Pets</h3>
                        <p class="card-description">If you’re the proud parent of a furry (or scaly, or feathery) friend who sees bath time as an extreme sport, fear not! We’ve got your back.</p>
                        <div class="read-more">
                            <a href="/src/who_we_are/blog/blog.php">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="/src/home_page/home_img/tips3.jpg" alt="Medication for Pets">
                    <div class="card-content">
                        <h3 class="card-title">Taming the Tricksters: A Guide to Administering Medication to Finicky Furballs</h3>
                        <p class="card-description">Administering medication to our beloved pets can be a real challenge.</p>
                        <div class="read-more">
                            <a href="/src/who_we_are/blog/blog.php">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    <section class="NGO-detial">
        <div class="container">
            <div class="Kinder-info">
                <div class="k-box">
                    <div class="k-image">
                        <img src="/src/home_page/home_img/dogs.png" alt="">
                    </div>
                    <div class="k-content">
                        <div class="k-logo">
                            <!-- <img src="/img/web_logo.png" alt=""> -->
                             <h1>Kinder Creature</h1>
                        </div>
                        <div class="k-descript">Kinder Creature is a clinical rescue facility for strays & abandoned
                            ownerless animals, birds & reptiles in need of help. We run a shelter cum hospital in Malad,
                            Mumbai and offer services of Adoption, Animal Shelter, Medical Treatment, Sterilisation &
                            Animal Ambulance</div>
                        <div class="k-btn" id="know-btn">
                            <a href="" class="k-btn">
                                <span>Know More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/footer.php'; ?>