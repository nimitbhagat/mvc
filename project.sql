-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 10:12 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `country` varchar(255) NOT NULL,
  `addressType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `customerId`, `address`, `city`, `state`, `zipcode`, `country`, `addressType`) VALUES
(12, 12, 'asdf', 'VALSAD', 'GUJARAT', '123456', 'INDIA', 'Billing'),
(13, 12, 'Rashmi Society', 'VALSAD', 'GUJARAT', '123456', 'INDIA', 'Shipping'),
(14, 8, 'Rashmi Society', 'VALSAD', 'GUJARAT', '396125', 'INDIA', 'Billing'),
(15, 8, 'Rashmi Society', 'VALSAD', 'GUJARAT', '396125', 'INDIA', 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `name`, `username`, `password`, `status`, `createdDate`) VALUES
(6, 'Nimit', 'nsbhagat', '', 1, '2021-03-22 23:12:09'),
(7, 'Hemil Bhagat', 'hmbhagat', '', 1, '2021-03-24 09:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(255) DEFAULT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `name`, `entityTypeId`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(30, 'Color', 'product', 'Color', 'radio', 'varchar(255)', 2, 'Model\\Attribute\\Option'),
(34, 'material', 'product', 'material', 'text', 'varchar(255)', 2, 'Model\\Attribute\\Option'),
(35, 'Brand', 'product', 'brand', 'text', 'varchar(255)', 2, 'Model\\Brand\\Option');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(35, 'Red', 30, 0),
(36, 'Green', 30, 1),
(37, 'Blue', 30, 2),
(38, 'Yellow', 30, 3),
(39, 'Brown', 30, 4);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sortOrder` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `name`, `image`, `status`, `sortOrder`, `createdDate`) VALUES
(38, 'ACME', 'acme-logo.png', 1, 0, '2021-03-25 00:25:25'),
(39, 'ALPINE', 'Alpine_logo.png', 1, 0, '2021-03-25 00:25:57'),
(40, 'American Drew', 'america.png', 1, 0, '2021-03-25 00:26:18'),
(41, 'Artisan & Post', 'Artisan & Post.png', 1, 0, '2021-03-25 00:26:41'),
(42, 'Ashley', 'Ashley.png', 1, 0, '2021-03-25 00:26:58'),
(43, 'Aspenhome', 'Aspenhome.png', 1, 0, '2021-03-25 00:27:13'),
(44, 'Bernards', 'Bernards.png', 1, 0, '2021-03-25 00:27:35'),
(45, 'Bobby Berk', 'Bobby Berk.png', 1, 0, '2021-03-25 00:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `pathId` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentId`, `name`, `pathId`, `status`, `description`) VALUES
(1, NULL, 'Bedroom', '1', 1, 'Bedroom'),
(2, NULL, 'Living Room', '2', 1, ''),
(3, NULL, 'Dining & Kitchen', '3', 1, '\r\n'),
(4, 1, 'Beds', '1=4', 1, ''),
(5, 1, 'Nightstand', '1=5', 1, ''),
(6, 2, 'Sofas', '2=6', 1, ''),
(7, 2, 'Chairs', '2=7', 1, ''),
(8, 3, 'Dining Sets', '3=8', 1, ''),
(9, 3, 'Dining Tables', '3=9', 1, ''),
(10, NULL, 'Office', '10', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `pageId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`pageId`, `title`, `identifier`, `content`, `status`, `CreatedDate`) VALUES
(1, 'CONTACT US', 'Contact US', '<nav class=\"navbar navbar-expand-lg navbar-dark bg-primary\"><a class=\"navbar-brand\" href=\"#\">Navbar</a>\r\n<div id=\"navbarColor01\" class=\"collapse navbar-collapse\">\r\n<ul class=\"navbar-nav mr-auto\">\r\n<li class=\"nav-item active\"><a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span> </a></li>\r\n<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Features</a></li>\r\n<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Pricing</a></li>\r\n<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">About</a></li>\r\n<li class=\"nav-item dropdown\"><a class=\"nav-link dropdown-toggle\" role=\"button\" href=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Dropdown</a>\r\n<div class=\"dropdown-menu\"><a class=\"dropdown-item\" href=\"#\">Action</a> <a class=\"dropdown-item\" href=\"#\">Another action</a> <a class=\"dropdown-item\" href=\"#\">Something else here</a>\r\n<div class=\"dropdown-divider\">&nbsp;</div>\r\n<a class=\"dropdown-item\" href=\"#\">Separated link</a></div>\r\n</li>\r\n</ul>\r\n<form class=\"form-inline my-2 my-lg-0\"><input class=\"form-control mr-sm-2\" type=\"text\" placeholder=\"Search\" /> <button class=\"btn btn-secondary my-2 my-sm-0\" type=\"submit\">Search</button></form></div>\r\n</nav><!--tinycomments|2.1|data:application/json;base64,eyJtY2UtY29udmVyc2F0aW9uXzg0ODk1NzY4NDIxNjE1MjMyMjQyODE3Ijp7InVpZCI6Im1jZS1jb252ZXJzYXRpb25fODQ4OTU3Njg0MjE2MTUyMzIyNDI4MTciLCJjb21tZW50cyI6W3sidWlkIjoibWNlLWNvbnZlcnNhdGlvbl84NDg5NTc2ODQyMTYxNTIzMjI0MjgxNyIsImF1dGhvciI6IkF1dGhvciBuYW1lIiwiYXV0aG9yTmFtZSI6IkF1dGhvciBuYW1lIiwiY29udGVudCI6Ik5hZWVtIiwiY3JlYXRlZEF0IjoiMjAyMS0wMy0wOFQxOTozNzoyMi44MTdaIiwibW9kaWZpZWRBdCI6IjIwMjEtMDMtMDhUMTk6Mzc6MjIuODE3WiJ9LHsidWlkIjoibWNlLXJlcGx5XzczMzcwNjY1ODMxNjE1MjMyMjQ1Mjk0IiwiYXV0aG9yIjoiQXV0aG9yIG5hbWUiLCJhdXRob3JOYW1lIjoiQXV0aG9yIG5hbWUiLCJjb250ZW50IjoiTmltaXQiLCJjcmVhdGVkQXQiOiIyMDIxLTAzLTA4VDE5OjM3OjI1LjI5NFoiLCJtb2RpZmllZEF0IjoiMjAyMS0wMy0wOFQxOTozNzoyNS4yOTRaIn0seyJ1aWQiOiJtY2UtcmVwbHlfMjIwMTI2NzI2NDE2MTUyMzIyNDcxOTciLCJhdXRob3IiOiJBdXRob3IgbmFtZSIsImF1dGhvck5hbWUiOiJBdXRob3IgbmFtZSIsImNvbnRlbnQiOiJQaW5hayIsImNyZWF0ZWRBdCI6IjIwMjEtMDMtMDhUMTk6Mzc6MjcuMTk3WiIsIm1vZGlmaWVkQXQiOiIyMDIxLTAzLTA4VDE5OjM3OjI3LjE5N1oifV19fQ==-->', 1, '2021-03-09 01:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `mobile`, `password`, `status`, `groupId`, `createdDate`, `updatedDate`) VALUES
(8, 'Nimit', 'Bhagat', 'nimit@gmail.com', '1234567890', '12354', 1, 5, '2021-03-10 01:24:04', '0000-00-00 00:00:00'),
(12, 'Hemil', 'Bhagat', 'hemil@gmail.com', '1234567890', '12345678', 1, 5, '2021-03-13 21:36:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customergroup`
--

CREATE TABLE `customergroup` (
  `groupId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customergroup`
--

INSERT INTO `customergroup` (`groupId`, `name`, `status`, `createdDate`) VALUES
(2, 'Wholesale', 1, '2021-03-02 15:04:53'),
(5, 'Retail', 1, '2021-03-07 12:51:01'),
(7, 'Regular', 1, '2021-03-17 14:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(2, 'Debit Card', '60382dbae258f8.30414610', 4000, '  ABC', 1, '2021-02-26 04:37:38'),
(4, 'Net Banking', '65498416', 5000, 'ICICI BANK', 1, '2021-03-07 00:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `Brand` varchar(255) DEFAULT NULL,
  `Color` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`, `categoryId`, `Brand`, `Color`, `material`) VALUES
(1, 'n-110', 'Nokia 1100', 1600, 0, 1, '', 1, '2021-03-24 10:10:39', '2021-03-24 11:56:42', 6, '', 'Green', 'Leather');

-- --------------------------------------------------------

--
-- Table structure for table `productmedia`
--

CREATE TABLE `productmedia` (
  `productId` int(11) NOT NULL,
  `mediaId` int(11) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `thumb` tinyint(1) NOT NULL DEFAULT 0,
  `base` tinyint(1) NOT NULL DEFAULT 0,
  `gallery` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productmedia`
--

INSERT INTO `productmedia` (`productId`, `mediaId`, `imageName`, `label`, `small`, `thumb`, `base`, `gallery`) VALUES
(1, 46, '41U8x8N34aL.jpg', 'abc', 0, 1, 0, 1),
(1, 47, '41wGEmM0S4L.jpg', '123', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_customer_group_price`
--

CREATE TABLE `product_customer_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `customerGroupId` int(11) DEFAULT NULL,
  `groupPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_customer_group_price`
--

INSERT INTO `product_customer_group_price` (`entityId`, `productId`, `customerGroupId`, `groupPrice`) VALUES
(13, NULL, 2, 49000),
(14, NULL, 5, 39500),
(15, NULL, NULL, 40000),
(16, NULL, 7, 50000),
(17, 1, 2, 1500),
(18, 1, 5, 1600),
(19, 1, 7, 1600);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shippingId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shippingId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(1, 'DHL', '603886a1c95674.96804890', 5000, 'courier', 1, '2021-02-25 11:14:17'),
(3, 'Blue Dart', '6916519165', 50000, 'International', 1, '2021-03-07 01:19:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `address_ibfk_1` (`customerId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentId` (`parentId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `customergroup`
--
ALTER TABLE `customergroup`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `product_ibfk_1` (`categoryId`);

--
-- Indexes for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `productmedia_ibfk_1` (`productId`);

--
-- Indexes for table `product_customer_group_price`
--
ALTER TABLE `product_customer_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `customerGroupId` (`customerGroupId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shippingId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customergroup`
--
ALTER TABLE `customergroup`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productmedia`
--
ALTER TABLE `productmedia`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_customer_group_price`
--
ALTER TABLE `product_customer_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shippingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `customergroup` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD CONSTRAINT `productmedia_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_customer_group_price`
--
ALTER TABLE `product_customer_group_price`
  ADD CONSTRAINT `product_customer_group_price_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_customer_group_price_ibfk_2` FOREIGN KEY (`customerGroupId`) REFERENCES `customergroup` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
