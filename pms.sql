-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 10:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE PMS

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--




CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 for not paid, 1 for paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `qty`, `status`) VALUES
(24, 8, 12, 2, 1),
(25, 21, 12, 1, 1),
(26, 11, 12, 1, 1),
(27, 20, 12, 1, 1),
(28, 15, 12, 1, 1),
(29, 20, 12, 1, 1),
(33, 11, 12, 1, 1),
(34, 21, 12, 1, 1),
(35, 4, 12, 1, 1),
(41, 2, 12, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE `main_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`id`, `name`) VALUES
(1, 'Prescription Medicine'),
(2, 'Medical Devices'),
(3, 'Skin care');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `cart_ids` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL COMMENT '0 for cash on delivery',
  `status` int(11) NOT NULL COMMENT '0 for pending, 1 for delivered',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `phone`, `cart_ids`, `total_amount`, `payment_method`, `status`, `date`) VALUES
(1, 12, 'Muhammad Huzaifa', 'Mirpur', '01813016898', '24,25', 144, 0, 0, '2024-04-24'),
(2, 12, 'Muhammad Huzaifa', 'Uttara', '01813016898', '26,27,28', 2113, 0, 0, '2024-04-24'),
(3, 12, 'Muhammad Huzaifa', 'Mirpur', '01813016898', '29', 1500, 0, 0, '2024-04-24'),
(4, 12, 'Muhammad Huzaifa', 'Mirpur', '01813016898', '33,34,35', 120, 0, 0, '2024-04-24'),
(5, 12, 'Muhammad Huzaifa', 'Mirpur', '01813016898', '41', 30, 0, 0, '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `main_category_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `generic` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `p_price` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `main_category_id`, `brand`, `generic`, `manufacturer`, `image`, `description`, `p_price`, `status`) VALUES
(2, 1, 'Tylenol', 'Acetaminophen', 'Johnson & Johnson', 'tylenol.jpg', 'Tylenol is a pain reliever and a fever reducer.', 6, 0),
(3, 1, 'Advil', 'Ibuprofen', 'Pfizer', 'advil.jpg', 'Advil is a nonsteroidal anti-inflammatory drug (NSAID) used to relieve pain.', 7, 0),
(4, 1, 'Aleve', 'Naproxen', 'Bayer', 'aleve.jpg', 'Aleve is used to temporarily relieve minor aches and pains.', 7, 0),
(5, 1, 'Zyrtec', 'Cetirizine', 'Johnson & Johnson', 'zyrtec.jpg', 'Zyrtec is an antihistamine used to treat allergy symptoms such as itching, sneezing, and runny nose.', 16, 0),
(6, 1, 'Claritin', 'Loratadine', 'Bayer', 'claritin.jpg', 'Claritin is an antihistamine used to treat allergy symptoms such as itching, sneezing, and watery eyes.', 14, 0),
(7, 1, 'Lipitor', 'Atorvastatin', 'Pfizer', 'lipitor.jpg', 'Lipitor is used to lower cholesterol levels in the blood.', 21, 0),
(8, 1, 'Crestor', 'Rosuvastatin', 'Johnson & Johnson', 'crestor.jpg', 'Crestor is used to lower cholesterol levels and triglycerides in the blood.', 22, 0),
(9, 1, 'Synthroid', 'Levothyroxine', 'AbbVie', 'synthroid.jpg', 'Synthroid is used to treat hypothyroidism (low thyroid hormone).', 19, 0),
(10, 1, 'Armour Thyroid', 'Thyroid Desiccated', 'Pfizer', 'armour_thyroid.jpg', 'Armour Thyroid is a natural thyroid hormone replacement.', 26, 0),
(11, 1, 'Prozac', 'Fluoxetine', 'Eli Lilly', 'prozac.jpg', 'Prozac is used to treat depression, panic attacks, obsessive-compulsive disorder, and bulimia.', 13, 0),
(12, 2, 'Omron', 'Blood Pressure Monitor', 'Omron Healthcare', 'omron_bp_monitor.jpg', 'This Omron Blood Pressure Monitor provides accurate readings of your blood pressure.', 50, 0),
(13, 2, 'Braun', 'Thermometer', 'Braun GmbH', 'braun_thermometer.jpg', 'The Braun Thermometer provides quick and accurate temperature readings.', 20, 0),
(14, 2, 'Drive Medical', 'Wheelchair', 'Drive Medical', 'drive_wheelchair.jpg', 'This Drive Medical wheelchair provides mobility assistance for individuals with disabilities.', 200, 0),
(15, 2, 'Philips', 'CPAP Machine', 'Philips Respironics', 'philips_cpap_machine.jpg', 'The Philips CPAP Machine helps treat obstructive sleep apnea.', 600, 0),
(16, 2, 'Dexcom', 'Continuous Glucose Monitor', 'Dexcom', 'dexcom_cgm.jpg', 'The Dexcom Continuous Glucose Monitor provides real-time glucose readings for diabetic patients.', 300, 0),
(17, 2, 'Fitbit', 'Fitness Tracker', 'Fitbit Inc.', 'fitbit_fitness_tracker.jpg', 'The Fitbit Fitness Tracker monitors your activity levels and heart rate.', 80, 0),
(18, 2, 'ResMed', 'BiPAP Machine', 'ResMed', 'resmed_bipap_machine.jpg', 'The ResMed BiPAP Machine provides bilevel positive airway pressure therapy for patients with respiratory disorders.', 800, 0),
(19, 2, 'Medtronic', 'Insulin Pump', 'Medtronic', 'medtronic_insulin_pump.jpg', 'The Medtronic Insulin Pump delivers insulin to diabetic patients continuously.', 900, 0),
(20, 2, 'Stryker', 'Hospital Bed', 'Stryker Corporation', 'stryker_hospital_bed.jpg', 'The Stryker Hospital Bed provides comfort and adjustability for patients in healthcare facilities.', 1500, 0),
(21, 2, 'Stethoscope', 'Stethoscope', '3M Littmann', 'littmann_stethoscope.jpg', 'The 3M Littmann Stethoscope is used by healthcare professionals to listen to heart and lung sounds.', 100, 0),
(24, 3, 'Cetaphil', 'Gentle Skin Cleanser', 'Galderma Laboratories', 'cetaphil_cleanser.jpg', 'Cetaphil Gentle Skin Cleanser is suitable for all skin types and effectively removes dirt, oil, and makeup without stripping the skin.', 10, 0),
(25, 3, 'Neutrogena', 'Hydro Boost Water Gel', 'Johnson & Johnson', 'neutrogena_moisturizer.jpg', 'Neutrogena Hydro Boost Water Gel instantly quenches dry skin and keeps it looking smooth, supple, and hydrated day after day.', 15, 0),
(26, 3, 'The Ordinary', 'Niacinamide 10% + Zinc 1%', 'Deciem', 'theordinary_serum.jpg', 'The Ordinary Niacinamide 10% + Zinc 1% helps reduce the appearance of blemishes, congestion, and uneven skin tone.', 7, 0),
(27, 3, 'CeraVe', 'Moisturizing Cream', 'Valeant Pharmaceuticals', 'cerave_moisturizer.jpg', 'CeraVe Moisturizing Cream provides all-day hydration for dry to very dry skin and helps restore the protective skin barrier.', 120, 0),
(28, 3, 'La Roche-Posay', 'Anthelios Clear Skin Sunscreen', 'L\'Oréal', 'larocheposay_sunscreen.jpg', 'La Roche-Posay Anthelios Clear Skin Sunscreen provides broad-spectrum SPF 60 protection and is suitable for acne-prone skin.', 20, 0),
(29, 3, 'Paula\'s Choice', 'Skin Perfecting 2% BHA Liquid Exfoliant', 'Paula\'s Choice Skincare', 'paulaschoice_exfoliant.jpg', 'Paula\'s Choice Skin Perfecting 2% BHA Liquid Exfoliant unclogs pores, smooths skin texture, and reduces blackheads.', 30, 0),
(30, 3, 'The Body Shop', 'Tea Tree Oil', 'The Body Shop', 'thebodyshop_teatreeoil.jpg', 'The Body Shop Tea Tree Oil helps target blemishes and purify skin, leaving it feeling refreshed and clear.', 9, 0),
(31, 3, 'Bioderma', 'Sensibio H2O Micellar Water', 'NAOS', 'bioderma_cleanser.jpg', 'Bioderma Sensibio H2O Micellar Water gently cleanses and removes makeup without causing irritation, suitable for sensitive skin.', 17, 0),
(32, 3, 'Mario Badescu', 'Drying Lotion', 'Mario Badescu', 'mariobadescu_dryinglotion.jpg', 'Mario Badescu Drying Lotion helps dry out surface blemishes overnight, reducing their appearance.', 17, 0),
(33, 3, 'Pixi', 'Glow Tonic', 'Pixi Beauty', 'pixi_toner.jpg', 'Pixi Glow Tonic exfoliates and purifies the skin with 5% glycolic acid, revealing a brighter, smoother complexion.', 22, 0),
(38, 1, 'Napa', 'Paracitamol', 'Beximco', '66285adf1221f6.03335719.jpg', 'ndications of Napa 500 mg\r\nNapa 500 mg is indicated for fever, common cold and influenza, headache, toothache, earache, bodyache, myalgia, neuralgia, dysmenorrhoea, sprains, colic pain, back pain, post-operative pain, postpartum pain, inflammatory pain and post vaccination pain in children. It is also indicated for rheumatic & osteoarthritic pain and stiffness of joints.\r\n\r\nTheropeutic Class\r\nNon opioid analgesics\r\n\r\nPharmacology\r\nNapa 500 mg has analgesic and antipyretic properties with weak anti-inflammatory activity. Napa 500 mg (Acetaminophen) is thought to act primarily in the CNS, increasing the pain threshold by inhibiting both isoforms of cyclooxygenase, COX-1, COX-2, and COX-3 enzymes involved in prostaglandin (PG) synthesis. Napa 500 mg is a para aminophenol derivative, has analgesic and antipyretic properties with weak anti-inflammatory activity. Napa 500 mg is one of the most widely used, safest and fast acting analgesic. It is well tolerated and free from various side effects of aspirin.', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `p_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `t_price` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `product_id`, `qty`, `p_price`, `discount`, `t_price`, `date`) VALUES
(2, 10, 12, 26, 0, 312, '2024-04-19 20:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `production_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `vendor`, `qty`, `production_date`, `expiry_date`, `unit_price`, `total_price`, `purchase_date`) VALUES
(1, 38, 'Beximco', 5000, '2024-01-01', '2029-12-29', 2, 10000, '2024-04-24'),
(2, 2, 'Beximco', 200, '2024-01-01', '2024-12-25', 13, 2600, '2024-04-23'),
(3, 21, 'Beximco', 10, '0000-00-00', '0000-00-00', 690, 6900, '2024-04-23'),
(4, 28, 'Beximco', 12, '2024-02-22', '2025-01-15', 165, 1980, '2024-04-24'),
(5, 5, 'Beximco', 300, '2023-01-02', '2028-10-31', 4, 1200, '2024-04-24'),
(6, 13, 'Beximco	', 421, '2023-02-15', '2028-06-13', 8, 3368, '2024-04-24'),
(7, 9, 'Beximco	', 21, '2023-06-12', '2026-06-11', 30, 630, '2024-04-25'),
(8, 14, 'Beximco	', 7, '0000-00-00', '0000-00-00', 740, 5180, '2024-04-20'),
(9, 16, 'Beximco	', 3, '0000-00-00', '0000-00-00', 500, 1500, '2024-04-24'),
(10, 33, 'Beximco	', 14, '2023-06-13', '2027-06-26', 300, 4200, '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `u_role` int(11) NOT NULL DEFAULT 3,
  `status` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `u_name`, `email`, `password`, `phone`, `address`, `u_role`, `status`) VALUES
(12, 'Muhammad Huzaifa', 'hamim109837@gmail.com', '$2y$10$tgvhnf1.7Zji8Tv/KzGlv.K/Mbru0HVC8QT9YVtZ96iwUOVxJsFqS', '01813016898', 'Mirpur', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id_cart` (`user_id`),
  ADD KEY `fk_product_id_cart` (`product_id`);

--
-- Indexes for table `main_category`
--
ALTER TABLE `main_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cat_id_product` (`main_category_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prod_id_offline_sale` (`product_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prod_id_stock` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `main_category`
--
ALTER TABLE `main_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product_id_cart` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_user_id_cart` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_cat_id_product` FOREIGN KEY (`main_category_id`) REFERENCES `main_category` (`id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `fk_prod_id_offline_sale` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_prod_id_stock` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
