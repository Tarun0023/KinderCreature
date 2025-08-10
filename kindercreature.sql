-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kindercreature`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal_in_care`
--

CREATE TABLE `animal_in_care` (
  `aic_id` int(50) NOT NULL,
  `aic_name` varchar(50) NOT NULL,
  `aic_image` varchar(100) NOT NULL,
  `aic_description` varchar(255) NOT NULL,
  `aic_status` varchar(50) NOT NULL,
  `aic_admission_date` date NOT NULL,
  `aic_species` varchar(50) NOT NULL,
  `aic_breed` varchar(50) NOT NULL,
  `aic_color` varchar(50) NOT NULL,
  `aic_gender` varchar(50) NOT NULL,
  `aic_age` int(30) NOT NULL,
  `aic_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal_in_care`
--

INSERT INTO `animal_in_care` (`aic_id`, `aic_name`, `aic_image`, `aic_description`, `aic_status`, `aic_admission_date`, `aic_species`, `aic_breed`, `aic_color`, `aic_gender`, `aic_age`, `aic_location`) VALUES
(1, 'Missy', 'https://i.imgur.com/ph3tJRR.png', 'Missy was admitted to our hospital with a painful wound on her neck, and she is bravely enduring the discomfort. However, she urgently requires immediate treatment to heal properly and alleviate her suffering. Your support can make a significant differenc', 'In Treatment', '2025-01-02', 'Cat', 'Aegean', 'Black', 'Female', 8, 'Ahmedabad'),
(2, 'Dagger', 'https://i.imgur.com/aHLcfcB.png', 'Dagger was discovered wailing in agony on a rain-soaked highway, having suffered severe injuries, including an eyeball popped out, due to reckless driving. ', 'In Treatment', '2025-01-02', 'Dog', 'Beagle', 'White', 'Male', 4, 'Ahmedabad'),
(3, 'Fluffy', 'https://i.imgur.com/EXc288k.png', 'Fluffy, a small pup with a big heart, urgently needs your support to raise Rs. 35,000 for vital surgery and treatment after suffering a severe injury. With a half-chopped leg, Fluffy is unable to walk, and every moment counts as he battles to regain his m', 'In Treatment', '2025-01-02', 'Dog', 'Beagle', 'Black', 'Male', 5, 'Ahmedabad'),
(4, 'Gray', 'https://i.imgur.com/oBnC8HS.png', 'Grey is a brave soul battling paralysis and requires constant care and medication to lead a dignified life. Her journey is filled with challenges, but with your support, we can help her survive and thrive. ', 'In Treatment', '2025-01-02', 'Cat', 'Aegean', 'Dark Brown with black strips.', 'Male', 3, 'Ahmedabad'),
(8, 'Arthur', 'https://i.imgur.com/YFFAvEm.png', 'Extend a helping hand to Arthur, a brave 2-year-old male cat rescued. He is currently suffering from a painful maggot wound near his cheeks, which requires urgent medical attention. We need to raise ₹20,000 to cover his medical expenses.', 'In Treatment', '2025-01-02', 'Cat', 'Aegean', 'Light brown', 'Male', 2, 'Ahmedabad'),
(9, 'Chutki', 'https://i.imgur.com/CzFAW1h.png', 'Chutki’s story began with a heartbreaking accident, but thanks to the compassion of rescuers Ms. Mehta and Krun, her journey is one of hope and healing. Chutki, an adorable stray, was hit by a rash tempo driver. The impact was so severe that it caused her', 'Adoption', '2025-01-01', 'Dog', 'Beagle', 'White and Brown', 'Male', 3, 'Ahmedabad'),
(10, 'Coal', 'https://i.imgur.com/zmR0D7B.png', 'Coal is a 15-year-old Indie male dog who has been through a devastating ordeal. Found in Borivali West, Coal suffered severe injuries due to a tragic accident, leaving him paralysed, fractured, and badly wounded.', 'Adoption', '2025-01-01', 'Cat', 'Aegean', 'Black and White', 'Male', 15, 'Ahmedabad'),
(11, 'Pearl', 'https://i.imgur.com/vy6qwje.png', 'Pearl, a sweet 3-month-old Indie puppy, came into our care after a tragic accident caused by a careless Ola cab driver. The incident left her with a painful abscess wound on her front leg, requiring immediate medical attention to save her life.', 'Adoption', '2025-01-01', 'Dog', 'Beagle', 'White', 'Male', 3, 'Ahmedabad'),
(12, 'Sona', 'https://i.imgur.com/e4pf0oL.png', 'Sona is a young, 1.5-year-old Indie female dog who has been suffering from a severe maggot infection on her nose. Every breath she takes is painful, and without urgent medical attention, her condition could worsen. ', 'Adoption', '2025-01-01', 'Dog', 'Beagle', 'Light brown', 'Male', 6, 'Ahmedabad'),
(13, 'Basawa', 'https://i.imgur.com/VDgMMEh.png', 'Basawa, a 4-year-old cat, is in excruciating pain due to a severe maggot-infested wound. This sweet boy deserves to live a life free from suffering, but he urgently needs your assistance for medical treatment.', 'Adoption', '2025-01-01', 'Cat', 'Aegean', 'Light brown', 'Male', 4, 'Ahmedabad'),
(14, 'Abby & Gabby', 'https://i.imgur.com/iSKyHh2.png', 'Abby and Gabby, two precious 2-month-old puppies, were rescued from Auris Serenity, Malad West. These adorable pups have endured the pain of maggot wounds, and now, they need urgent medical attention to recover and live healthy, happy lives.', 'Adoption', '2025-01-01', 'Dog', 'Beagle', 'White and Brown', 'Male', 1, 'Ahmedabad'),
(15, 'Barki', 'https://i.imgur.com/kpNtTxQ.png', 'Barkie is just a 5-month-old puppy who is enduring excruciating pain from a major wound on his leg. He was rescued from the streets of Bhiwandi, where he suffered without any help or relief. ', 'Adoption', '2025-01-01', 'Dog', 'Beagle', 'Light brown', 'Male', 1, 'Ahmedabad'),
(16, 'Marble', 'https://i.imgur.com/inpoHPb.png', 'Marble is a 3-month-old black and white male puppy, found helpless on Aksa beach. This poor baby has an intense wound on his neck that requires immediate surgery and medical care.', 'Adoption', '2025-01-01', 'Dog', 'Beagle', 'Black and White', 'Male', 1, 'Ahmedabad'),
(17, 'Ramu', 'https://i.imgur.com/AWjKovx.png', 'Ramu, an innocent dog,tragically fell victim to a devastating car accident that left him with a severely fractured leg. He’s now fighting to recover, but he needs immediate medical treatment and rehabilitation to heal and regain his strength.', 'Adoption', '2025-01-01', 'Dog', 'Beagle', 'Black and White', 'Male', 3, 'Ahmedabad'),
(18, 'Roxie', 'https://i.imgur.com/9Ld4x8p.png', 'Roxie, a resilient soul, She has already overcome a vaginal infection, but her battle is far from over. Roxie is currently facing a tumour affecting her eyes and head, causing immense discomfort and threatening her well-being.', 'Adoption', '2025-01-01', 'Dog', 'Aegean', 'Light brown', 'Male', 6, 'Ahmedabad'),
(19, 'Sandy', 'https://i.imgur.com/v4TviDb.png', 'Sandy, a courageous dog, is in a critical condition, battling severe maggot infection wounds. His wounds require immediate medical attention, and he needs your help to survive this painful ordeal.', 'Adoption', '2025-01-01', 'Dog', 'INDog', 'Black and Brown', 'Male', 5, 'Ahmedabad'),
(20, 'Krish', 'https://i.imgur.com/VCAqEkL.png', 'Krish was rescued by a compassionate individual, suffering from a severely swollen throat and eye area. His condition requires immediate medical attention to alleviate his pain and prevent further complications.', 'Adoption', '2025-01-01', 'Dog', 'Asian', 'Black and White', 'Male', 7, 'Ahemdabad'),
(21, 'Choongoose', 'https://i.imgur.com/wjxl4PZ.png', 'Choongooose was brought to us in a dire condition, suffering from a severe maggot wound. Her injuries are painful and need immediate attention. To give her the best chance of recovery, she requires admission and ongoing care at our hospital.', 'Adoption', '2025-01-01', 'Dog', 'Oceanian', 'White', 'Male', 2, 'Ahmedabad'),
(22, 'Safedilaal', 'https://i.imgur.com/LYazSml.png', 'Safedilaal, a beautiful soul, was involved in a tragic accident that left her with a seriously injured leg. She is in immense pain, and our team is working hard to provide her with the best medical treatment to relieve her suffering.', 'Adoption', '2025-01-01', 'Dog', 'Asian', 'White', 'Male', 3, 'Ahmedabad'),
(23, 'Athena', 'https://i.imgur.com/cRHjUHF.png', 'Athena, a victim of a tragic hit-and-run accident, was brought to us by a kind-hearted samaritan who couldn’t stand to see her suffer. She sustained a painful injury to her left hind leg, and without immediate medical attention, her condition could worsen', 'Adoption', '2025-01-01', 'Dog', 'Asian', 'White and Brown', 'Male', 8, 'Ahmedabad'),
(24, 'Nemo', 'https://i.imgur.com/VmdtMyx.png', 'Nemo is a brave little 2-month-old puppy who was abandoned and left to fend for herself with a fractured leg. Despite the immense pain and fear she must have felt, Nemo continues to fight for her life.', 'Adoption', '2025-01-01', 'Dog', 'Oceanian', 'Light brown', 'Male', 4, 'Ahmedabad'),
(25, 'Kalu Mama', 'https://i.imgur.com/S7ufafa.png', '\r\nHelp Kalu Mama Recover from a Traumatic Attack\r\nKalu Mama, a helpless 2-month-old puppy, was found barely conscious in a dump after a brutal attack by larger dogs. His tiny body is covered in bite marks, and he is so weak that he can’t even stand on his', 'Adoption', '2025-01-01', 'Dog', 'Oceanian', 'Black', 'Male', 6, 'Ahmedabad');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(50) NOT NULL,
  `blog_title` varchar(50) NOT NULL,
  `blog_description` varchar(255) NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `publish_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_description`, `blog_image`, `publish_date`) VALUES
(1, 'The Importance of Sterilization', 'Sterilization, often referred to as spaying (for females) or neutering (for males), is one of the most vital and effective actions taken to control the population of stray and domestic animals. Beyond population control, sterilization improves the health.', 'https://i.imgur.com/qcLYypW.png', '2025-01-01'),
(2, 'The Journey of Rescued Animals', 'Owning a pet is a joy, but it’s also a responsibility that requires compassion, commitment, and care. Whether you’re a new pet parent or have been sharing your home with animals for years, there’s always more to learn about being the best caregiver.', 'https://i.imgur.com/OGpetyX.png', '2025-01-01'),
(3, 'Be a Compassionate Pet Owner', 'Owning a pet is a joy, but it’s also a responsibility that requires compassion, commitment, and care. Whether you’re a new pet parent or have been sharing your home with animals for years, there’s always more to learn about being the best caregiver.', 'https://i.imgur.com/zcZkIul.png', '2025-01-01'),
(4, 'Pets and Mental health', 'In the hustle and bustle of modern life, where stress and anxiety seem to be constant companions, more people are turning to profoundly effective sources of comfort and support—animals. The bond between humans and animals extends beyond companionship.', 'https://i.imgur.com/GmFuYZs.png', '2025-01-01'),
(5, 'Introducing a new pet to your comapanion', 'Welcoming a new pet into your home can be an exciting adventure, but it can also trigger feelings of jealousy in your existing furry friend. Pets, like humans, can experience a range of emotions, and introducing a new companion requires careful planning.', 'https://i.imgur.com/YjmmhRO.png', '2025-01-01'),
(6, 'Embracing Indie-pendency: The advantage of adoptin', 'In a world where dog lovers often gravitate towards popular breeds, there’s a quiet revolution happening in the canine community. Independent or “indie” dogs are gaining popularity for their unique qualities and the numerous advantages they bring.', 'https://i.imgur.com/gt1CpBN.png', '2025-01-01'),
(7, 'Paws,Claws and Crafts: DIY toys to delight your fu', 'Activate your inner DIY enthusiast and treat your pets to a world of handmade joy! Join us as we embark on a creative journey, crafting toys that will entertain and engage your furry companions. ', 'https://i.imgur.com/zShejTY.png', '2025-01-01'),
(8, 'Paws and you: Things to consider before adopting a', ' Bringing a furry friend into your life can be an enriching experience but it also comes with its fair share of responsibilities. Before you decide to adopt a dog, it’s essential to consider various factors to ensure a happy and healthy relationship.', 'https://i.imgur.com/VT8El2d.png', '2025-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `ckt_id` int(11) NOT NULL,
  `ckt_fname` varchar(50) NOT NULL,
  `ckt_lname` varchar(50) NOT NULL,
  `ckt_email` varchar(50) NOT NULL,
  `ckt_co_no` varchar(50) NOT NULL,
  `ckt_address` varchar(255) NOT NULL,
  `ckt_state` varchar(50) NOT NULL,
  `ckt_city` varchar(50) NOT NULL,
  `ckt_zipcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`ckt_id`, `ckt_fname`, `ckt_lname`, `ckt_email`, `ckt_co_no`, `ckt_address`, `ckt_state`, `ckt_city`, `ckt_zipcode`) VALUES
(9, 'harshil', 'patel', 'harshil4943@gmail.com', '1234567890', 'sample', 'Gujarat', ' Ahmedabad ', '123456'),
(10, 'harshil', 'patel', 'harshil4943@gmail.com', '1234567890', 'sample', 'Gujarat', ' Ahmedabad ', '123456'),
(11, 'y', 'P', 'yash@gmail.com', '234567890', 'ok', 'Gujarat', ' Ahmedabad ', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `co_id` int(11) NOT NULL,
  `co_name` varchar(50) NOT NULL,
  `co_email` varchar(50) NOT NULL,
  `co_contact` varchar(15) NOT NULL,
  `co_message` text NOT NULL,
  `send_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`co_id`, `co_name`, `co_email`, `co_contact`, `co_message`, `send_at`) VALUES
(1, 'harshil', 'harshil4943@gmail.com', '1234567890', 'hello', '2024-12-27 10:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donate_id` int(10) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `donate_email` varchar(50) NOT NULL,
  `donate_contact` bigint(50) NOT NULL,
  `donate_amount` int(10) NOT NULL,
  `payment_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donate_id`, `f_name`, `l_name`, `donate_email`, `donate_contact`, `donate_amount`, `payment_id`) VALUES
(1, 'Harshil', 'Patel', 'harshil4943@gmail.com', 9016543304, 1, 'pay_PvAmoOpqJuISUS'),
(2, 'Harshil', 'Patel', 'harshil4943@gmail.com', 9016543304, 100, 'pay_PvAuXM9sNJ34kC'),
(3, 'Harshil', 'Patel', 'harshil4943@gmail.com', 9016543304, 1, 'pay_PvAxiJyzjktw3X');

-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE `forget_password` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `temp_key` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `forget_password`
--

INSERT INTO `forget_password` (`id`, `email`, `temp_key`, `created`) VALUES
(0, 'rathodtarun2355@gmai.com', '99b42a8b8dfcc9f8778abe772a145248', '2024-12-20 08:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(50) NOT NULL,
  `ckt_id` int(11) NOT NULL,
  `product_id` int(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `ckt_id`, `product_id`, `quantity`, `price`) VALUES
(9, 9, 3, 1, 1800),
(10, 10, 3, 1, 1800),
(11, 10, 1, 1, 800),
(12, 11, 6, 1, 249);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(50) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_name`, `product_name`, `product_price`, `product_image`, `product_description`) VALUES
(1, 'travelling ', 'Pet Carrier', 800, 'https://media-cldnry.s-nbcnews.com/image/upload/t_fit-260w,f_auto,q_auto:best/newscms/2023_19/3580419/screen_shot_2022-11-10_at_4-18-37_pm.png', 'This roomy Pet Travel Crate installs in the car with an integrated latch system and is designed to decrease driver distraction, keep your pet comfy and secure, and keep your vehicle interior clean.'),
(2, 'food', 'Bacon flavoured dog treats', 300, 'https://media-cldnry.s-nbcnews.com/image/upload/t_fit-260w,f_auto,q_auto:best/newscms/2024_28/3606845/41bfnm7zitl-sl500-645d6c493fbb4.jpg', 'These Pet Botanics Bacon-Flavored Treats are just 3 calories each and made with real pork liver.'),
(3, 'travelling ', 'Litter Box', 1800, 'https://media-cldnry.s-nbcnews.com/image/upload/t_fit-260w,f_auto,q_auto:best/newscms/2023_19/3607014/41pcsxuur2l-sl500-645e9e9404112.jpg', 'Insistent that we were going to make sure the cat\'s stuff was cool and didn\'t clash with my design style.'),
(5, 'travelling ', 'M-Pets Travel Foldable Feeding Bowl', 599, 'https://www.petsy.online/cdn/shop/products/M-Pets_On_the_Road_Foldable_Feeding_Bowl_-_D-MPE-BF-007.png?v=1582217724&width=832', '1) Lightweight and easy to carry with metal carabiners\r\n2) Convenient to pop up and fold away\r\n3) Sturdy plastic frame\r\n4) Made with high quality flexible Food-Grade silicone \r\n100% lead­free, BPA­-free'),
(6, 'travelling ', 'M-Pets Travel Drinking Bottle for Dogs', 249, 'https://www.petsy.online/cdn/shop/products/M-PetsTravelDrinkingBottleforDogs.png?v=1626018621&width=832', '1) Lightweight and easy to carry \r\n2) Convenient to pop up and fold away\r\n3) Sturdy plastic frame\r\n This bottle is perfect for water when you\'re on the go!'),
(7, 'travelling ', 'Trixie Buggy / Stroller for Pets (Black)', 8999, 'https://www.petsy.online/cdn/shop/products/Shipsinassortedstylesdependingonstockavailability_1.png?v=1670159233&width=352', '1) easily manoeuvrable due to front wheel with 360° joint, spring-loaded\r\n2) with quick-fold function\r\n3) for old, sick, timid or very young dogs and cats\r\n4) one-hand folding system on handle\r\n5) with 2 parking brakes'),
(8, 'food', 'Bellotta Premium Wet Cat Food - Tuna with Chicken ', 89, 'https://www.petsy.online/cdn/shop/products/8_94fea84e-0cb6-44d9-9372-ef928285c29b.jpg?v=1650036273&width=352', 'Bellotta wet gravy for cats is delicious for cats along with other nutrition. It’s a complete meal and doesn’t require any substitutes.it is a 100% complete and balanced diet for cats. It’s made with real ingredients and contains minerals and vitamins.'),
(9, 'food', 'Kit Cat Kitten & Pregnant Cat Food', 279, 'https://www.petsy.online/cdn/shop/files/9361Front.jpg?v=1719992174&width=832', 'Food for kittens and pregnant cats. Complete meal wothout requiring any substitutes. Made with real ingreadients containing minerals and vitamins.'),
(10, 'food', 'Vetster 1 Litre Vitamin H for Cow, Buffalo, Birds,', 599, 'https://m.media-amazon.com/images/I/312lkwipXLL._SX300_SY300_QL70_FMwebp_.jpg', 'Supports Animal Health: Vetster Veterinary Vitamin H is a high-quality multivitamin liquid feed supplement suitable for various animals. Suitable for animals of all ages. Available in different size variations.\r\nVersatile and Enriching: This supplement in'),
(11, 'food', 'RV-MIN Mmc 10 Kg, Mineral Mixture for Cow, Buffalo', 1149, 'https://m.media-amazon.com/images/I/518n2Nmf-aL._SX300_SY300_QL70_FMwebp_.jpg', 'Cattle Feed Supplement  \r\n\r\nAnimal Feed Supplemen\r\n\r\nMilk Booster\r\n\r\nImprove overall health of animal\r\n\r\ncomplete every vitamin defieciency in animals\r\n\r\nincrease milk quality also\r\n'),
(12, 'toys', 'Foodie Puppies Latex Rubber Squeaky Dog Chew Ball ', 179, 'https://m.media-amazon.com/images/I/31x7VWEhLwL._SY300_SX300_QL70_FMwebp_.jpg', 'This squeaky latex dogs toy is a great gift for puppies and small to medium dogs, very cute and funny, greatly attracting your puppies. Diameter: 6.5cm.'),
(13, 'clothes', 'Dog Autumn Wind Proof Pure Woolen Sweater Fleece W', 449, 'https://m.media-amazon.com/images/I/71ThQfqx53L._SY450_.jpg', 'Easy to Wear, Soft Breathable Comfortable, Streachable for Proper Fit, Lightweight Washable Fabric.'),
(14, 'food', 'Kennel Kitchen Soft Baked Fish Sticks Treats for D', 569, 'https://m.media-amazon.com/images/I/51dZEq7SNLL._SX300_SY300_QL70_FMwebp_.jpg', 'PACKAGE CONTENTS: 3 Packets of Fish Stick Dog Treats 80 Grams (Each)\r\nSUITABLE FOR: Dogs Of All Ages, Breeds And Sizes\r\nGRAIN FREE TREATS: Highly Digestible Treats That Are Free Of Fillers Such As Corn, Wheat And Soy. Made Without Any Artificial Colours O'),
(15, 'food', 'Kennel Kitchen Calcium Chicken Nugget Treats for D', 199, 'https://m.media-amazon.com/images/I/41PJ9eWvXzL._SX300_SY300_QL70_FMwebp_.jpg', 'LIMITED INGREDIENT TREATS: Protein-rich dog and cat treats with real chicken as the number one ingredient for a taste your pet will love.\r\nGRAIN FREE TREATS: Highly Digestible Treats That Are Free Of Fillers Such As Corn, Wheat And Soy. Made Without Any A'),
(16, 'food', 'For The Fur Kids Chip Chops Chicken Dog Treats (Ro', 1149, 'https://m.media-amazon.com/images/I/71VawM7qZ8L._SX679_.jpg', 'Highly nutritional, digestible and delicious snack for your dog\r\nSuitable for all age groups in appropriate quantities\r\nAvailable in different flavours - Diced Chicken, Chicken Tenders and Roast Chicken Strips\r\nComes in an easy-to-carry and resealable pou'),
(17, 'food', 'Kennel Kitchen Air Dried Dog Food | 2 Kgs | Chicke', 1899, 'https://m.media-amazon.com/images/I/51fpWamHVZL._SX300_SY300_QL70_FMwebp_.jpg', 'Container Type: Bag\r\nUNLEASH THE POWER OF RAW ? Our raw, unprocessed recipes provide a fresh, nutrient-rich diet that supports your furry companions!'),
(18, 'food', 'Chewers Pumpkin & Sweet Potato Dog Biscuits, 1 Kg', 229, 'https://m.media-amazon.com/images/I/51kSVe-qUhL._SX300_SY300_QL70_FMwebp_.jpg', 'Simple and Pure: Made with wholesome ingredients that allow for easy digestion with nothing artificial. Delicious mix of flavors from locally sourced ingredients lets you give even the pickiest dogs a worthy treat. Our Oven Baked Biscuits are all natural,'),
(19, 'toys', 'PETS EMPIRE Wireless Remote Control Rat Mouse Toy ', 779, 'https://www.petsempire.in/cdn/shop/files/513OTZkD4BL._SL1500_2048x2048.jpg?v=1722509631', 'Realistic mouse design with lifelike movements\r\nEasy-to-use remote control for versatile play\r\nWireless and battery-operated for convenient use\r\nDurable, pet-safe materials for safe play\r\nStimulates natural hunting instincts and keeps pets active\r\nHelps r'),
(20, 'toys', 'Pets Empire Suction Cup Dog Tug Toys, Interactive ', 449, 'https://www.petsempire.in/cdn/shop/products/81DnCR2_0aL._SX569_2048x2048.jpg?v=1718615957', 'Suitable for puppies/dogs\r\nMade of natural rubber\r\ncomes in 3 different colours.\r\nTeaches appropriate chewing behavior\r\nAlways buy size appropriate toys for your pet.'),
(21, 'toys', 'Pets Empire Rubber Ball for Dogs.', 249, 'https://www.petsempire.in/cdn/shop/files/Untitleddesign_1_5f313a6c-133a-4382-8fb8-97b86dc3985c_2048x2048.png?v=1716034704', 'This Dog Chew Toy is in the shape of a rugby ball. \r\nSuitable only for toy breed dogs\r\nPack contains: 1 ball\r\nIt is designed specially for your pet to play.\r\nIt will give out sound when your pet chew and squeeze it.\r\nRubber Squeaky Rugby keeps your dog in'),
(22, 'toys', 'PETS EMPIRE Squeak Dog Toy for Medium Breeds Dog (', 399, 'https://www.petsempire.in/cdn/shop/files/61mS-kDjBfL._SL1500_2048x2048.jpg?v=1721646450', 'No Stuffing Design for Safety: This dog toy is thoughtfully designed without any stuffing, ensuring there\'s no mess to clean up and significantly reducing the risk of choking or ingestion hazards, making it a safer choice for your furry friend.\r\nSoft Sque'),
(23, 'toys', 'PETS EMPIRE Squeak Dog Toy for Small Breeds Dog (M', 349, 'https://www.petsempire.in/cdn/shop/files/61AQ-_WTJHL._SL1500_2048x2048.jpg?v=1721644827', 'No Stuffing Design for Safety: This dog toy is thoughtfully designed without any stuffing, ensuring there\'s no mess to clean up and significantly reducing the risk of choking or ingestion hazards, making it a safer choice for your furry friend.\r\nSoft Sque'),
(24, 'toys', 'Pets Empire Hide & Seek Treat Training Dog Puzzle ', 549, 'https://www.petsempire.in/cdn/shop/files/WhatsAppImage2024-08-16at14.29.10_2048x2048.jpg?v=1723799162', 'Challenge & Engage: Interactive puzzle toy stimulates your dog\'s mind, encouraging problem-solving and critical thinking, helping to reduce boredom and stress.\r\nSlow & Healthy Feeding: Dispenser design slows down eating, reducing overeating, improving dig'),
(25, 'toys', 'Pets Empire Combo Of Rope Toy for All Breed Dogs -', 1066, 'https://www.petsempire.in/cdn/shop/files/Ha6ca2b3a91ab4047aef65ce7efecd1acd.jpg_1200x1200_1_2048x2048.jpg?v=1723290070', 'SUPER SAFE NON-TOXIC Our Rope Dog Chew Toys are handmade by twining high quality cotton & polyester threads; this rope is further knotted together for added strength, protection & durability.\r\nSUPER LONG DURABLE Our Rope Dog Chew Toys have thick and tight'),
(26, 'toys', 'Pets Empire Rainbow Balls for Dogs ( Pack of 2)', 319, 'https://www.petsempire.in/cdn/shop/files/61Ai7uc3UOL._SL1500_2048x2048.jpg?v=1687599975', 'Dogs find immense joy in playing fetch, catch and hide and seek. For never ending fun, we have the perfect toy for your pet.\r\n\r\nMade with Natural Rubber, these balls are perfect for everyday indoor and outdoor play time. These lightweight balls are useful'),
(27, 'toys', 'Pets Empire Tire Squeaky Chew Dog Toy', 279, 'https://www.petsempire.in/cdn/shop/files/51FzqavBirL_2048x2048.jpg?v=1718611128', '【Multifunctional】Preventing dogs from suffering from depression and causing anorexia, screaming, and biting furniture. Relieve the dog\'s loneliness, release the pressure of the dog, help control plaque and tartar accumulation, prevent gum disease, and mai'),
(28, 'clothes', 'PawsIndia Sleeveless Printed Dog T-Shirt - Kha Mag', 699, 'https://pawsindia.com/cdn/shop/files/15-Khamagararamse-Blue.png?v=1735903633', 'Premium Quality: Made from high-quality materials ensuring durability and comfort.\r\nVibrant Prints: Available in a variety of eye-catching prints to suit your dog\'s personality.\r\nEasy to Wear: Features velcro closures for easy dressing and removal.\r\nComfo'),
(29, 'clothes', 'Black Plain Cow Winter Blanket, Packaging Type: Po', 1649, 'https://5.imimg.com/data5/SELLER/Default/2023/12/364862928/GI/WI/RE/75318805/cow-winter-blanket-1000x1000.jpg', 'A cow winter blanket is a product that is designed to keep cows warm and comfortable during the cold season. It is usually made of fleece, sherpa, or other insulating materials that provide warmth and protection for the cows. Some cow winter blankets also'),
(30, 'clothes', 'Cow Coat Warm Filled with Polyfill', 849, 'https://5.imimg.com/data5/SELLER/Default/2023/11/362223682/YM/BH/PV/690432/whatsapp-image-2023-01-16-at-2-32-24-pm-4-1000x1000.jpeg', 'Cow Coat warm filled with polyfill - Good for winter & rain water proof with polyfill.\r\nA good durable products for cow\r\nThree Layer Coat.'),
(31, 'clothes', 'Dunzy 2 Pcs Goat Coat for Winter Goat Blanket Cold', 249, 'https://m.media-amazon.com/images/I/71vnS1C6lzL._SX679_.jpg', 'Fit Most Lambs: the package contains 2 pieces of goat coats for winter in blue color, which is suitable for most lambs to wear, 2 pieces can be worn interchangeably.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('user','subadmin','admin') DEFAULT 'user',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'harshil patel', 'harshil4943@gmail.com', '$2y$10$ERJCRuE/pxuUbRfK4DkL8OWNOmjjuxWbr8dKY1Q8fYc5n1oSZDs.m', 'admin', '0000-00-00 00:00:00'),
(2, 'tarun rathod', 'rathodtarun2355@gmail.com', '$2y$10$2obKg7JluS75tSlYFxM/9uY3GZLBU179F.EF2VYomyWJqEd2ajcri', 'subadmin', '0000-00-00 00:00:00'),
(3, 'yash pandya', 'pandyayash08@gmail.com', '$2y$10$qz0OKS513szf2neh.1HRr.hE.2KBC84L7fuZCAm04lG.h41yNNbrO', 'user', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_contacts`
--

CREATE TABLE `volunteer_contacts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer_contacts`
--

INSERT INTO `volunteer_contacts` (`id`, `first_name`, `last_name`, `email`, `country`, `phone`, `created_at`) VALUES
(1, 'harshil', 'patel', 'harshil4943@gmail.com', 'india', '1234567890', '2025-01-04 13:25:00'),
(2, 'tarun', 'rathod', 'rathodtarun2355@gmai.com', 'india', '1234567890', '2025-01-04 13:32:21'),
(3, 'pandya', 'yash', 'pandyayash08@gmail.com', 'india', '1234567890', '2025-01-04 13:33:09'),
(4, 'sample', 'sample', 'sample@gmail.com', 'india', '1234567890', '2025-01-04 14:08:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal_in_care`
--
ALTER TABLE `animal_in_care`
  ADD PRIMARY KEY (`aic_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`ckt_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donate_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `ckt_id` (`ckt_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteer_contacts`
--
ALTER TABLE `volunteer_contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal_in_care`
--
ALTER TABLE `animal_in_care`
  MODIFY `aic_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `ckt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donate_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `volunteer_contacts`
--
ALTER TABLE `volunteer_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`ckt_id`) REFERENCES `checkout` (`ckt_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
