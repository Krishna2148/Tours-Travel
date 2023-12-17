-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 02, 2022 at 02:45 PM
-- Server version: 8.0.30
-- PHP Version: 7.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghumgham`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `packageid` int NOT NULL,
  `arrivaldate` varchar(50) NOT NULL,
  `adults` int NOT NULL,
  `children` int NOT NULL,
  `bookingdate` date NOT NULL,
  `contactmethod` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `message` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `userid`, `packageid`, `arrivaldate`, `adults`, `children`, `bookingdate`, `contactmethod`, `status`, `message`) VALUES
(34, 20, 30, '2022-09-15', 2, 3, '2022-09-02', 'Email', 'pending', 'thanks');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `contact_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `contact_date`) VALUES
(27, 'Prabhat Kiran Sigdel', 'prabhatkiransigdel@kcc.edu.np', 'I want to know about lumbini tour packages', '2022-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `packageid` int NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `packageid`, `image`) VALUES
(22, 28, 'IMG-6311a934b42dc8.77100818.jpeg'),
(23, 28, 'IMG-6311a934b4a6b1.51294417.jpeg'),
(24, 28, 'IMG-6311a934b4f5d6.17835493.jpeg'),
(25, 29, 'IMG-6311aa67d9bf10.53348246.jpg'),
(26, 29, 'IMG-6311aa67daac94.84668323.jpg'),
(27, 29, 'IMG-6311aa67daf702.63253166.jpg'),
(28, 29, 'IMG-6311aa67db2a89.25944904.jpg'),
(29, 30, 'IMG-6311ac49a1fab3.25517720.jpeg'),
(30, 30, 'IMG-6311ac49a2aeb3.99745122.jpeg'),
(31, 30, 'IMG-6311ac49a2d852.38666048.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `route` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `estimatedcost` int NOT NULL,
  `childaddons` int NOT NULL,
  `overview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `included` text NOT NULL,
  `notincluded` text NOT NULL,
  `itinerary` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `location`, `route`, `duration`, `estimatedcost`, `childaddons`, `overview`, `included`, `notincluded`, `itinerary`, `image`) VALUES
(28, 'Illam Tea Garden visit', 'Illam', 'Kathmandu - Iilam - Kathmandu', '3', 20000, 10000, 'An excellent getaway from city life, Ilam is famous for its tea. It is a district largely covered in tea bushes with a hill town right beside a plantation enjoying views of pristine landscapes made up of sloping tea gardens, mountain streams, dense natural forests, holy sites and unique culture.', '--Free dinner and snacks\r\n--Free Accomodation\r\n--Free Transportation', '—Personal Expenses\r\n—Drinks', 'Day 1: Arrive Illam from Kathmandu\r\nDay 2:Visit Tea Garden\r\nDay 3: Return Back to kathmandu', '6311a92987a73.jpeg'),
(29, 'Janakpur visit', 'Janakpurdham', 'Kathmandu - Janakpur - Kathmandu', '4', 15000, 7500, 'Janakpur, also known as Janakpurdham, was founded in the early 18th century. It is a sub-metropolitan city in Dhanusa District of Nepal. This city is located about 225km south-east of Kathmandu. Janakpur is the third largest city in the Terai region after Biratnagar and Birgunj, and it is the seventh largest city in Nepal. The five major rivers surrounding Janakpur are Dudhmati, Jalad, Rato, Balan and Kamala. The climate here is humid-subtropical. It is one of the fastest developing cities of Nepal.', '--Free dinner and snacks\r\n--Free Accomodation\r\n--Free Transportation', '—Personal Expenses\r\n—Drinks', 'Day 1: Start journey from kathmandu and arrival to janakpur\r\nDay 2: Explore janaki temple\r\nDay 3: Explore other popular areas\r\nDay 4: Return back to Kathmandu', '6311aa42ca39e.jpg'),
(30, 'Lumbini visit package', 'Kapilvastu', 'Kathmandu - lumbini - Kathmandu', '3', 15000, 7400, 'Siddhartha Gautama, the Lord Buddha, was born in 623 B.C. in the famous gardens of Lumbini, which soon became a place of pilgrimage. Among the pilgrims was the Indian emperor Ashoka, who erected one of his commemorative pillars there. The site is now being developed as a Buddhist pilgrimage centre, where the archaeological remains associated with the birth of the Lord Buddha form a central feature.', '-Free dinner and snacks\r\n--Free Accomodation\r\n--Free Transportation', '—Personal Expenses\r\n—Drinks', 'Day 1: Reach Lumbini\r\nDay 2: Explore birthplace of Lord Buddha\r\nDay 3: Return back to kathmandu', '6311ac32e0f75.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `privacypolicy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `privacypolicy`) VALUES
(2, '<div data-widget_type=\"heading.default\" data-element_type=\"widget\" data-id=\"7725305\">\r\n<div>\r\n<h4>Privacy Policy Promise</h4>\r\n</div>\r\n</div>\r\n<div data-widget_type=\"text-editor.default\" data-element_type=\"widget\" data-id=\"f247c95\">\r\n<div>\r\n<div>While information is the cornerstone of our ability to provide superior service, our most important asset is our clients&rsquo; trust. Keeping client information secure, and using it only as our clients would want us to, is a top priority for all of us at Journey Travel &amp; Tours. Here then, is our promise to our individual customers:\r\n<ul>\r\n<li>We will safeguard, according to strict standards of security and confidentiality, any information our customers share with us.</li>\r\n<li>We will limit the collection and use of customer information to the minimum we require to deliver superior service to our customers, which includes advising our customers about our products, services and other opportunities, and to administer our business.</li>\r\n<li>We will permit only authorized employees, who are trained in the proper handling of customer information, to have access to that information. Employees who violate our Privacy Promise will be subject to our normal disciplinary process.</li>\r\n<li>We will not reveal customer information to any external organization unless we have previously informed the customer in disclosures or agreements, or are required by law.</li>\r\n<li>We will always maintain control over the confidentiality of our customer information. We may, however, share customer information with reputable companies when a customer has expressed an interest in their service or product. Please note that this Privacy Policy does not apply to these other companys use of customer information.</li>\r\n<li>Whenever we hire other organizations to provide support services, we will require them to conform to our privacy standards and to allow us to audit them for compliance.</li>\r\n<li>We will attempt to keep customer files complete, up-to-date, and accurate. We will tell our customers how and where to conveniently access their information (except when we&rsquo;re prohibited by law) and how to notify us about errors which we will promptly correct.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<div data-widget_type=\"heading.default\" data-element_type=\"widget\" data-id=\"2330eec\">\r\n<div>\r\n<h4>Information We Collect</h4>\r\n</div>\r\n</div>\r\n<div data-widget_type=\"text-editor.default\" data-element_type=\"widget\" data-id=\"89769aa\">\r\n<div>\r\n<div><strong>General:</strong><br>When you register, and at other times, we may collect personally identifiable information from you that may include your name, address, telephone number, e-mail address, and facts about your computer. We do not, however, knowingly collect personal information from children under the age of thirteen. In addition, if a user is under 18, unless consent is obtained from your parent/guardian, you are not allowed to provide us with personal information.<br><br><strong>Web Site Usage Information:</strong> We automatically collect IP addresses and Web site usage information from you when you visit our Web site. This information helps us evaluate how our visitors and customers use and navigate our Web site on an aggregate basis, including the number and frequency of visitors and customers to each Web page, and the length of their visits.</div>\r\n</div>\r\n</div>\r\n<div data-widget_type=\"heading.default\" data-element_type=\"widget\" data-id=\"6ed6110\">\r\n<div>\r\n<h4>How We Use Information Collected</h4>\r\n</div>\r\n</div>\r\n<div data-widget_type=\"text-editor.default\" data-element_type=\"widget\" data-id=\"4c4c43c\">\r\n<div>\r\n<div>We may use information in the following ways:\r\n<ul>\r\n<li>For the purposes for which you specifically provided the information.</li>\r\n<li>To send you e-mail notifications about our new or existing products and services, special offers, or to otherwise contact you.</li>\r\n<li>To enhance existing features or develop new features, products and services.</li>\r\n<li>To allow us to personalize the content and advertising that you and others see based on personal characteristics or preferences.</li>\r\n<li>We may combine the information that we collect from you on information that you provide to us in connection with your use of our other products, services and web site.</li>\r\n<li>We may disclose and use personally identifiable information in special circumstances where it is necessary to enforce our Terms of Use (for example, when necessary to protect our intellectual property rights). We may also disclose or use your personal information when we, in good faith, believe that the law requires us to do so.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `contact`, `address`, `email`, `image`, `created_at`, `updated_at`) VALUES
(20, 'Ishwar Khadka', '$2y$04$LIo.8S.jGZrDbWqu7Sim9.iITTlpfzQPsGFkmU1rvlBqq3VpQnzFm', '9828039221', 'Thimi Bhaktapur', 'ishwarkhadka@kcc.edu.np', '630f76b235afe.jpeg', '2022-08-31', '2022-08-31'),
(21, 'Yubraj Khadka', '$2y$04$84caUGNfOsWW4wk83tXKeOERYDDgiIdWA17qaXKF8tFNGhHnDW.5m', '9860562381', 'Baluwatar', 'yubrajkhadka@kcc.edu.np', '63119c3ed9ee9.jpeg', '2022-09-02', '2022-09-02'),
(22, 'ishwar', '$2y$04$ztL7DdrY2DDL56eAVWP/HOH7ywpQYlAVPIGyi.vCil1khIjKodaxy', '9828039221', 'thimi', 'ishhwar@gmail.com', '631214980f4ee.jpeg', '2022-09-02', '2022-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `usersreview`
--

CREATE TABLE `usersreview` (
  `id` int NOT NULL,
  `packageid` int NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `review` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersreview`
--

INSERT INTO `usersreview` (`id`, `packageid`, `username`, `rating`, `review`, `date`) VALUES
(17, 30, 'Ishwar Khadka', 4, 'Value for money', '2022-09-02'),
(18, 30, 'Yubraj Khadka', 5, 'Awesome for group', '2022-09-02'),
(19, 30, 'Prabhat Kiran Sigdel', 3, 'Not satisfied fully', '2022-09-02');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_packages`
-- (See below for the actual view)
--
CREATE TABLE `view_packages` (
`id` int
,`name` varchar(100)
,`location` varchar(100)
,`route` varchar(100)
,`duration` varchar(100)
,`estimatedcost` int
,`childaddons` int
,`overview` text
,`included` text
,`notincluded` text
,`itinerary` text
,`image` varchar(255)
,`packageid` int
,`rating` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Structure for view `view_packages`
--
DROP TABLE IF EXISTS `view_packages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_packages`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`location` AS `location`, `p`.`route` AS `route`, `p`.`duration` AS `duration`, `p`.`estimatedcost` AS `estimatedcost`, `p`.`childaddons` AS `childaddons`, `p`.`overview` AS `overview`, `p`.`included` AS `included`, `p`.`notincluded` AS `notincluded`, `p`.`itinerary` AS `itinerary`, `p`.`image` AS `image`, `r`.`packageid` AS `packageid`, `r`.`rating` AS `rating` FROM (`packages` `p` left join (select `usersreview`.`packageid` AS `packageid`,avg(`usersreview`.`rating`) AS `rating` from `usersreview` group by `usersreview`.`packageid`) `r` on((`p`.`id` = `r`.`packageid`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `packageid` (`packageid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_ibfk_1` (`packageid`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `usersreview`
--
ALTER TABLE `usersreview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersreview_ibfk_1` (`packageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `usersreview`
--
ALTER TABLE `usersreview`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`packageid`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`packageid`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usersreview`
--
ALTER TABLE `usersreview`
  ADD CONSTRAINT `usersreview_ibfk_1` FOREIGN KEY (`packageid`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
