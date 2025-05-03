-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2024 at 08:57 PM
-- Server version: 8.0.37
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web1212179_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int NOT NULL,
  `productName` varchar(50) NOT NULL,
  `category` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `price` int NOT NULL,
  `rating` varchar(30) NOT NULL,
  `quantity` int NOT NULL,
  `productImageName` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `category`, `description`, `price`, `rating`, `quantity`, `productImageName`) VALUES
(1, 'shirt ', 'Sweater', 'hhhh', 10, '3', 79, '1.jpeg'),
(2, 'nice shart ', 'Sweater', 'very nice tshart \r\ncoton quality\r\nvery hight quality ', 108, '3/5', 78, '2.jpeg'),
(3, 'beutiful shart ', 'Sweater', 'this is from turkya \r\ncoton\r\n', 10, '4/5', 7, '3.jpeg'),
(4, 'dania shirt ', 'Sweater', 'it will give you a very nice look\r\nmad in turky  \r\nmad from quton ', 88, '4.5/5', 12, '4.jpeg'),
(5, 'tests', 'FormalShirt', 'very hight quality \r\nnice \r\nmase for you ', 100, '4/5', 8, '5.jpeg'),
(6, 'special for you', 'FormalShirt', 'very  hight material \r\nfor you', 50, '4.5/5', 8, '6.jpeg'),
(7, 'special design ', 'FormalShirt', 'special design for you \r\nvery hight quality \r\nmad turk', 100, '4/5', 8, '7.jpeg'),
(8, 'nice pice', 'FormalShirt', 'very hight quality \r\nmade  with coton matirial \r\nvery confident ', 99, '4/5', 8, '8.jpeg'),
(9, 'shirt mad for you', 'Sweater', 'great pice to yoy \r\nmade from one of the best material ', 50, '3/5', 11, '9.jpeg'),
(10, 'tests for tests ', 'FormalShirt', 'nice shirt\r\nmade for you \r\n', 40, '3/5', 8, '10.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
