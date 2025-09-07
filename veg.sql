-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 01:46 AM
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
-- Database: `veg`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(2, 'travinahis14@gmail.com', '$2y$10$FP/WhFhWLZfn9PP3iFlzaOEPEcVlqHRdNSE0XTpFD8Yh9sKoPPGlC', 'Travin', 'Ahishayan', '2025-01-15 08:46:40', '2025-01-15 08:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'admin', '$2y$10$RycFIIRlPB8LkwvVOv3o1u1ZRVFqc6sA71sJwJej9egI5l.KjThr2', '2025-01-07 13:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Vegetables'),
(6, 'Fruits');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('gautham', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_05_19_190216_create_users_table', 2),
(7, '2025_05_20_193319_add_image_to_products_table', 2),
(8, '2025_05_25_140621_create_sessions_table', 2),
(9, '2025_05_27_145133_add_is_admin_to_users_table', 2),
(10, '2025_05_31_083534_create_sessions_table', 3),
(11, '2025_05_31_100827_add_user_id_to_orders_table', 3),
(12, '2025_05_31_101608_add_total_to_orders_table', 3),
(13, '2025_05_31_104042_create_orders_table', 4),
(14, '2025_06_01_154620_add_unit_to_order_items_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `full_name`, `phone`, `address`, `city`, `postal_code`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Travin Ahishayan', '0769069268', '202/38.1/1', 'Wattala', '11300', 200.00, 'Shipped', '2025-06-01 07:22:54', '2025-06-01 07:38:13'),
(2, 1, 'Travin Ahishayan', '0769069268', '202/38.1/1', 'Wattala', '11300', 400.00, 'Processing', '2025-06-01 09:54:34', '2025-06-01 09:54:34'),
(3, 1, 'Travin Ahishayan', '0769069268', '202/38.1/1', 'Wattala', '11300', 400.00, 'Processing', '2025-06-01 10:27:49', '2025-06-01 10:27:49'),
(4, 1, 'Travin Ahishayan', '0769069268', '202/38.1/1', 'Wattala', '11300', 200.00, 'Processing', '2025-06-01 10:43:28', '2025-06-01 10:43:28'),
(5, 1, 'Travin Ahishayan', '0769069268', '202/38.1/1', 'Wattala', '11300', 400.00, 'Processing', '2025-06-01 16:32:00', '2025-06-01 16:32:00'),
(6, 1, 'Travin Ahishayan', '0769069268', '202/38.1/1', 'Wattala', '11300', 430.00, 'Shipped', '2025-06-01 17:08:47', '2025-06-01 17:09:26'),
(7, 2, 'Travin Ahishayan', '0769069268', '202/38.1/1', 'Wattala', '11300', 320.00, 'Shipped', '2025-06-01 17:18:53', '2025-06-01 17:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit` varchar(255) NOT NULL DEFAULT 'kg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`, `unit`) VALUES
(1, 1, 8, 200.00, 1, '2025-06-01 07:22:54', '2025-06-01 07:22:54', 'kg'),
(2, 3, 7, 200.00, 1, '2025-06-01 10:27:49', '2025-06-01 10:27:49', 'kg'),
(3, 3, 8, 200.00, 1, '2025-06-01 10:27:49', '2025-06-01 10:27:49', 'kg'),
(4, 4, 7, 200.00, 1, '2025-06-01 10:43:28', '2025-06-01 10:43:28', 'kg'),
(5, 5, 7, 200.00, 2, '2025-06-01 16:32:00', '2025-06-01 16:32:00', 'kg'),
(6, 6, 7, 200.00, 1, '2025-06-01 17:08:47', '2025-06-01 17:08:47', 'kg'),
(7, 6, 12, 230.00, 1, '2025-06-01 17:08:47', '2025-06-01 17:08:47', 'kg'),
(8, 7, 17, 120.00, 1, '2025-06-01 17:18:53', '2025-06-01 17:18:53', 'kg'),
(9, 7, 7, 200.00, 1, '2025-06-01 17:18:53', '2025-06-01 17:18:53', 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `image` mediumblob DEFAULT NULL,
  `on_sale` tinyint(1) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `in_stock`, `image`, `on_sale`, `category_id`, `sale_price`) VALUES
(5, 'Tomato', 'Fresh, Juicy, and Full of Flavor Tomatoes\r\nBrighten your meals with the vibrant taste of farm-fresh tomatoes. Perfectly ripe and bursting with natural sweetness, these versatile gems are ideal for salads, sauces, sandwiches, or cooking up your favorite recipes. Handpicked for quality, they bring a touch of garden freshness to your kitchen.', 300.00, 1, 0x70726f64756374732f6d64696d74524162443045763133564642474d78376639314356376c714442696c59616568314a382e6a7067, 1, 5, 250.00),
(6, 'Banana', 'Sweet, Creamy, and Naturally Energizing Bananas\r\nSavor the classic goodness of perfectly ripened bananas. Packed with natural sweetness and essential nutrients,\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 300.00, 1, 0x70726f64756374732f454e4957566b313432704679373654574f54327845394a774672564c6851503351646e34704135512e6a7067, 0, 6, 0.00),
(7, 'Mango', 'Juicy, Sweet, and Irresistible Mangoes\r\nIndulge in the rich, tropical flavor of premium mangoes. Perfectly ripened for a burst of sweetness in every bite, these mangoes are a versatile treat—enjoy them fresh, blend into smoothies, or add a splash of sunshine to your recipes. Handpicked for quality, they’re nature’s delicious gift, delivered straight to your doorstep.\r\n\r\n', 250.00, 1, 0x70726f64756374732f64595371466a4d62466d6b614d435672325a6c7670365634614a37487565584a7a485268534f48772e6a7067, 1, 6, 200.00),
(8, 'Beans', 'Crisp, Nutritious, and Versatile Beans\r\nEnjoy the garden-fresh goodness of premium beans. Packed with flavor and essential nutrients, these beans are perfect for stir-fries, salads, or steaming as a healthy side dish. Handpicked for quality and freshness, they’re a wholesome addition to every meal. Elevate your cooking with nature’s green delight!', 200.00, 1, 0x70726f64756374732f6c65545451776766414f456f7645624c6d444c33356a4668395a736b687962654b614f4c6b68376a2e706e67, 0, 5, 0.00),
(9, 'Drumstick', 'Fresh, Nutritious, and Flavorful Drumsticks\r\nAdd a healthy twist to your meals with premium drumsticks. Known for their distinct flavor and rich nutritional value, they’re perfect for curries, soups, or stews. Handpicked for freshness and quality, these drumsticks are a wholesome ingredient to elevate your culinary creations.', 250.00, 1, 0x70726f64756374732f6e645752474e46583477775a713159746d4f6f713034455978786c466461723579566c336b5a47302e6a7067, 0, 5, 0.00),
(10, 'Carrot', 'Crunchy, Sweet, and Packed with Goodness Carrots\r\nBrighten your meals with the natural sweetness and vibrant color of fresh carrots. Perfect for snacking, salads, soups, or roasting, these versatile veggies are a rich source of nutrients and flavor. Handpicked for quality and freshness, they’re a must-have for every healthy kitchen.', 150.00, 1, 0x70726f64756374732f6b6c637233636c396d31397534774b4463376b30534e3875446d70637371345a53515446544732512e6a7067, 0, 5, 0.00),
(11, 'Potato', 'Versatile, Nutritious, and Perfectly Fresh Potatoes\r\nStock up on the hearty goodness of premium potatoes. Naturally rich in flavor and nutrients, these kitchen staples are perfect for mashing, roasting, frying, or adding to your favorite dishes. Handpicked for quality and freshness, they’re a must-have ingredient for countless delicious recipes.', 250.00, 1, 0x70726f64756374732f336844575573554b546d3979733579383074666c324e494e657635397736415a57345565716d61312e6a7067, 1, 5, 175.00),
(12, 'Watermelon', 'Refreshing, Juicy, and Bursting with Sweetness Watermelons\r\nQuench your thirst with the hydrating sweetness of fresh watermelons. Packed with natural juices and vibrant flavor, they’re perfect for snacking, blending into drinks, or enjoying as a summertime treat. Handpicked for ripeness and quality, these watermelons bring a splash of freshness to your table.\r\n\r\n', 230.00, 1, 0x70726f64756374732f6d634539444251464e4f575970437071357a7a73686e777772594e574e4a47395a71417a714c506d2e6a7067, 0, 6, 0.00),
(15, 'Pineapple', 'the sweetest ever.', 250.00, 1, 0x70726f64756374732f575973506a4645445036767866596253796c747835357537724c46506e4a504c58546449414769302e706e67, 1, 6, 200.00),
(16, 'cucumber', 'Cool, crisp, and incredibly refreshing — cucumbers are a hydrating vegetable perfect for salads, smoothies, or snacking. With their high water content and subtle, clean flavor, cucumbers are a must-have for healthy eating and natural detox.\r\n\r\n✅ Naturally hydrating (over 95% water)\r\n\r\n✅ Low in calories, high in vitamins K and C\r\n\r\n✅ Ideal for skin, digestion, and summer cooling', 334.00, 1, 0x70726f64756374732f546a397a6744744c6e753969633276367868735a6e496575525277537945776969306d7131794e642e6a7067, 0, 5, NULL),
(17, 'apple', 'Juicy, crisp, and naturally sweet — apples are a timeless favorite enjoyed by all ages. Packed with fiber and vitamin C, they\'re not only delicious but also support a healthy lifestyle.\r\n\r\n✅ Crunchy texture with a perfect balance of sweet and tart\r\n\r\n✅ Great for snacking, baking, juicing, or salads\r\n\r\n✅ Rich in antioxidants and dietary fiber', 150.00, 1, 0x70726f64756374732f6e616c70594a78426f53594a726a37384b616b717a70376864364c584e6a4d7653383947744143732e6a7067, 1, 5, 120.00),
(18, 'Papaya', 'Description:\r\n\r\nTropical, tender, and naturally sweet — papaya is a vibrant fruit known for its juicy orange flesh and powerful health benefits. Rich in enzymes and nutrients, it\'s loved for its taste and digestive properties.\r\n\r\n✅ Sweet, melt-in-your-mouth texture\r\n\r\n✅ Excellent source of vitamin C, A, and folate\r\n\r\n✅ Contains papain enzyme — supports digestion\r\n\r\n✅ Great in fruit bowls, smoothies, or eaten fresh', 400.00, 1, 0x70726f64756374732f35654d716d6d474f4f7637754652475643444d4157706e5a556b66736944754c4a365657627567582e6a7067, 0, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JsEaKJIIhsKn29od2NdiMTX3e13YSGs1SbTSnI6L', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTnVRNGl2NExaVW1LY0owZ2lRejJ5OUpMT0dONFZ0ZU5SRlJNclJVTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czoxODoiaXNfYWRtaW5fbG9nZ2VkX2luIjtiOjE7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImNhcnQiO2E6Mjp7czo0OiI4X2tnIjthOjc6e3M6MjoiaWQiO2k6ODtzOjQ6Im5hbWUiO3M6NToiQmVhbnMiO3M6NDoidW5pdCI7czoyOiJrZyI7czo4OiJxdWFudGl0eSI7ZDoxO3M6MTQ6InByaWNlX3Blcl91bml0IjtzOjY6IjIwMC4wMCI7czoxMToidG90YWxfcHJpY2UiO2Q6MjAwO3M6NToiaW1hZ2UiO3M6NTM6InByb2R1Y3RzL2xlVFRRd2dmQU9Fb3ZFYkxtREwzNWpGaDlac2toeWJlS2FPTGtoN2oucG5nIjt9czo0OiI5X2tnIjthOjc6e3M6MjoiaWQiO2k6OTtzOjQ6Im5hbWUiO3M6OToiRHJ1bXN0aWNrIjtzOjQ6InVuaXQiO3M6Mjoia2ciO3M6ODoicXVhbnRpdHkiO2Q6MTtzOjE0OiJwcmljZV9wZXJfdW5pdCI7czo2OiIyNTAuMDAiO3M6MTE6InRvdGFsX3ByaWNlIjtkOjI1MDtzOjU6ImltYWdlIjtzOjUzOiJwcm9kdWN0cy9uZFdSR05GWDR3d1pxMVl0bU9vcTA0RVl4eGxGZGFyNXlWbDNrWkcwLmpwZyI7fX19', 1748818315);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details`
--

CREATE TABLE `shipping_details` (
  `id` int(11) NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_details`
--

INSERT INTO `shipping_details` (`id`, `account_id`, `full_name`, `address`, `city`, `postal_code`, `phone`, `created_at`) VALUES
(2, 2, 'Travin Ahishayan', '202/38.1/1', 'Wattala', '11300', '0769069268', '2025-01-15 08:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Travin Ahishayan', 'travinahis14@gmail.com', 0, '$2y$10$VEWRC8YregZ98p/7VMlWyu5nXFVfTeT9qKAldD2/jb6kvW3dRZ20y', '2025-06-01 07:22:44', '2025-06-01 07:22:44'),
(2, 'nehansa vethakan', 'nehansavethakan6@gmail.com', 0, '$2y$10$S4Hacl9lRIt0Wov.Mtp93.SMPHCmTLSnBNe24cDRExYh9pLaMwLWK', '2025-06-01 17:13:22', '2025-06-01 17:13:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shipping_details`
--
ALTER TABLE `shipping_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD CONSTRAINT `shipping_details_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
