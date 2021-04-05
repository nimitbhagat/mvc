-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2021 at 04:09 PM
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
(15, 8, 'Rashmi Society', 'VALSAD', 'GUJARAT', '396001', 'INDIA', 'Shipping'),
(26, 8, 'Damni Zampa', 'VALSAD', 'GUJARAT', '396125', 'INDIA', 'Billing');

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `paymentMethodId` int(11) DEFAULT NULL,
  `shippingMethodId` int(11) DEFAULT NULL,
  `shippingAmount` decimal(10,2) NOT NULL,
  `createdDate` datetime NOT NULL,
  `sessionId` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `total`, `discount`, `paymentMethodId`, `shippingMethodId`, `shippingAmount`, `createdDate`, `sessionId`) VALUES
(6, 8, '1495.74', '0.00', 4, 1, '5000.00', '2021-03-30 00:21:31', 'rli930ns2lk2lva20j9atokcg7');

-- --------------------------------------------------------

--
-- Table structure for table `cartaddress`
--

CREATE TABLE `cartaddress` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) DEFAULT NULL,
  `addressId` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `addressType` enum('Billing','Shipping') NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartaddress`
--

INSERT INTO `cartaddress` (`cartAddressId`, `cartId`, `addressId`, `address`, `addressType`, `city`, `state`, `country`, `zipcode`, `sameAsBilling`) VALUES
(78, 6, 26, 'Damni Zampa', 'Billing', 'VALSAD', 'GUJARAT', 'INDIA', '396001', 0),
(79, 6, 15, 'Damni Zampa', 'Shipping', 'VALSAD', 'GUJARAT', 'INDIA', '396001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`cartItemId`, `cartId`, `productId`, `quantity`, `basePrice`, `price`, `discount`, `createdDate`) VALUES
(36, 6, 4, 1, '2094.00', '2094.00', '28.57', '2021-04-05 11:12:44');

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
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `groupId`, `title`, `code`, `value`, `createdDate`) VALUES
(2, 1, 'Nimit', 'Bhagat', 'Suryakant', '2021-04-05 14:50:59'),
(3, 1, 'Hemil', 'Bhagat', 'Mahendra', '2021-04-05 14:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`groupId`, `name`, `createdDate`) VALUES
(1, 'Customer', '2021-04-05 12:07:30'),
(2, 'Admin', '2021-04-05 12:07:35');

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
-- Table structure for table `orderaddress`
--

CREATE TABLE `orderaddress` (
  `orderAddressId` int(11) NOT NULL,
  `addressId` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `addressType` enum('billing','shipping') NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customerFirstName` varchar(50) NOT NULL,
  `customerLastName` varchar(50) NOT NULL,
  `customerEmail` varchar(255) NOT NULL,
  `customerContact` varchar(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `paymentName` varchar(255) NOT NULL,
  `paymentCode` varchar(255) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingName` varchar(255) NOT NULL,
  `shippingCode` varchar(255) NOT NULL,
  `shippingAmount` decimal(10,2) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderItemId` int(11) NOT NULL,
  `orderDetailId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(2, 'Debit Card', '60382dbae258f8.30414610', '4000.00', '  ABC', 1, '2021-02-26 04:37:38'),
(4, 'Net Banking', '65498416', '5000.00', 'ICICI BANK', 1, '2021-03-07 00:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
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
(4, 'B720-57-54-96', 'Birlanny Silver Queen Upholstered Panel Bed', '2094.00', '28.57', 20, 'Part of Birlanny Collection\r\nCrafted from ash swirl and birch veneers and select hardwood solids\r\nSilver toned finish\r\nSubtle glazing effects\r\nLarge and integrated bracket feet\r\nSturdy foundation\r\nMirrored framing elements\r\nDeep carved moulding\r\nShapely, folded and crystal look\r\nButton tufted upholstered panels in a silver color faux leather\r\nTraditional bail and backplate\r\nOptional nightstand\r\nBed is available in Queen, King & Cal. King sizes\r\nGrace your room with the opulence of the birlanny bed. Carved mouldings curving around the top and bottom along with fluted pilasters and a traditional silvertone finish create elegance.', 1, '2021-03-31 19:12:37', '2021-03-31 08:11:34', 4, NULL, 'Red', 'Leather'),
(5, 'B733-77-74-98', 'Lettner Light Gray Queen Sleigh Bed', '1109.00', '29.52', 5, 'Part of Lettner Collection from Ashley\r\nCrafted fom select birch veneers and hardwood solids\r\nBurnished light gray finish\r\nStorage footboard\r\nOptional Nightstand\r\nRequired slat rolls\r\nBox Spring Not Required\r\nBed is Available in Queen, King & Cal. King Sizes', 1, '2021-03-31 19:38:32', '2021-03-31 07:55:21', 4, NULL, 'Blue', 'Wood'),
(7, 'B733-92', 'Lettner Light Gray 2 Drawer Nightstand', '649.00', '20.00', 5, 'Made of veneers, wood and engineered wood\r\nSilvertone patina hardware\r\n2 smooth-gliding drawers with dovetail construction\r\nTop drawer felt-lined\r\n1 felt-lined pull-out tray\r\nSmall Space Solution\r\nMade with select Birch veneers and hardwood solids. Burnished light gray finish. Drawers feature a silver-tone patina color knob and back plate. Dovetail drawer construction. Drawer interior with color finish. Ball bearing drawer glide. Felt drawer bottoms on select drawers. Beveled mirror. Both the sleigh headboards (77/78) or panel headboards (57/58) can use either storage footboards (74/98 and 76/99) and panel footboards (54/96 and 56/97). Choose from a timeless storage sleigh bed design, offered in twin or full size. The twin over full bunk bed has underbed storage.\r\n\r\nSatisfying your taste for tradition, this nightstand sports serene sophistication. Forever classic design details\"inlaid panels, silvertone patina hardware and bun feet\"are so easy to love. Burnished light gray finish elevates the look with modern sensibility. Two roomy drawers keep bedside odds and ends within easy reach.', 1, '2021-03-31 22:02:51', '2021-03-31 10:03:31', 5, NULL, 'Brown', 'Wood'),
(8, 'B720-92', 'Birlanny Silver 2 Drawer Nightstand', '659.00', '10.00', 5, 'Made of ash and birch veneers, wood and engineered wood\r\nSilvertone finish with subtle glazing effects\r\nSilvertone hardware\r\n2 smooth-operating drawers (top drawer felt lined)\r\nSmall Space Solution\r\nMade with Ash Swirl and Birch veneers and select hardwood solids, finished in a silver toned color with subtle glazing effects to bring out dimension. Cases feature large mouldings that gracefully curve around the case, fluting on the pilasters and framed drawers give the case a lot of dimension. Large, integrated bracket feet give the cases a sturdy foundation. Mirrored framing elements that accent the mirror, dresser doors, headboard and footboard give this bedroom an air of elegance. Bed has deep carved moulding that captures a mirrored frame element and shapely, folded and crystal look button tufted upholstered panels in a silver color faux leather. Traditional bail and back plate hardware with faux crystal center insert in a silver toned finish with glaze application.\r\n\r\nLife is but a dream when you grace your room with this opulent nightstand. Its alluring blend of ash swirl and birch veneers is treated to a metallic silvertone finish with subtle glazing for a feel of faded elegance. Fluting on the pilasters adds rich dimension. Traditional bail and back plate hardware with faux crystal center inserts is an inspired finishing touch.', 1, '2021-03-31 22:07:58', '2021-03-31 10:10:22', 5, NULL, '', 'Wood');

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
(4, 56, 'b720-31-36-46-58-56-97-92-q325_2.jpg', '', 0, 0, 0, 1),
(4, 57, 'b720-31-36-46-58-56-97-92-q326_2.jpg', '', 0, 0, 0, 1),
(4, 58, 'b720-detail-b.jpg', '', 0, 0, 0, 1),
(4, 59, 'b720-detail-c.jpg', '', 0, 0, 0, 1),
(4, 60, 'b720-finish_1_1.jpg', '', 0, 0, 0, 1),
(4, 61, 'b720-mood-b.jpg', '', 0, 0, 0, 1),
(4, 62, 'b720-mood-c.jpg', '', 0, 0, 0, 1),
(4, 63, 'b720-mood-d.jpg', '', 1, 1, 1, 1),
(5, 64, 'lettner-light-gray-queen-sleigh-bed_qb1223009_14.jpg', '', 1, 0, 0, 1),
(5, 65, 'lettner-light-gray-queen-sleigh-bed_qb1223009_15.jpg', '', 0, 1, 0, 1),
(5, 66, 'lettner-light-gray-queen-sleigh-bed_qb1223009_16.jpg', '', 0, 0, 1, 1),
(5, 67, 'lettner-light-gray-queen-sleigh-bed_qb1223009_17.jpg', '', 0, 0, 0, 1),
(5, 68, 'lettner-light-gray-queen-sleigh-bed_qb1223009_18.jpg', '', 0, 0, 0, 1),
(5, 69, 'lettner-light-gray-queen-sleigh-bed_qb1223009_19.jpg', '', 0, 0, 0, 1),
(5, 70, 'lettner-light-gray-queen-sleigh-bed_qb1223009_20.jpg', '', 0, 0, 0, 1),
(5, 71, 'lettner-light-gray-queen-sleigh-bed_qb1223009_21.jpg', '', 0, 0, 0, 1),
(7, 77, 'lettner-light-gray-2-drawer-nightstand_qb1222999.webp', '', 0, 0, 0, 1),
(7, 78, 'lettner-light-gray-2-drawer-nightstand_qb1222999_1.webp', '', 1, 0, 0, 1),
(7, 79, 'lettner-light-gray-2-drawer-nightstand_qb1222999_2.webp', '', 0, 1, 0, 1),
(7, 80, 'lettner-light-gray-2-drawer-nightstand_qb1222999_3.webp', '', 0, 0, 1, 1),
(7, 81, 'lettner-light-gray-2-drawer-nightstand_qb1222999_4.webp', '', 0, 0, 0, 1),
(8, 82, 'b720-31-36-46-58-56-97-92-q325_2_1.jpg', '', 0, 0, 0, 1),
(8, 83, 'b720-31-36-46-58-56-97-92-q326_3.jpg', '', 0, 0, 0, 1),
(8, 84, 'b720-92.jpg', '', 0, 0, 1, 1),
(8, 85, 'b720-92-sw.webp', '', 1, 0, 0, 1),
(8, 86, 'b720-finish_3.jpg', '', 0, 1, 0, 1),
(8, 87, 'b720-handle_2.jpg', '', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_customer_group_price`
--

CREATE TABLE `product_customer_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `customerGroupId` int(11) DEFAULT NULL,
  `groupPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_customer_group_price`
--

INSERT INTO `product_customer_group_price` (`entityId`, `productId`, `customerGroupId`, `groupPrice`) VALUES
(20, 4, 2, '1900.00'),
(21, 4, 5, '2000.00'),
(22, 4, 7, '2094.00'),
(23, 5, 2, '1000.00'),
(24, 5, 5, '1050.00'),
(25, 5, 7, '1109.00'),
(26, 7, 2, '600.00'),
(27, 7, 5, '625.00'),
(28, 7, 7, '649.00'),
(29, 8, 2, '600.00'),
(30, 8, 5, '630.00'),
(31, 8, 7, '659.00');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shippingId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shippingId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(1, 'DHL', '603886a1c95674.96804890', '5000.00', 'courier', 1, '2021-02-25 11:14:17'),
(3, 'Blue Dart', '6916519165', '50000.00', 'International', 1, '2021-03-07 01:19:20');

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `cart_ibfk_1` (`customerId`),
  ADD KEY `cart_ibfk_2` (`paymentMethodId`),
  ADD KEY `cart_ibfk_3` (`shippingMethodId`);

--
-- Indexes for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cartaddress_ibfk_1` (`addressId`),
  ADD KEY `cartaddress_ibfk_2` (`cartId`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartItemId`),
  ADD KEY `cartitem_ibfk_1` (`cartId`),
  ADD KEY `cartitem_ibfk_2` (`productId`);

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
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`groupId`);

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
-- Indexes for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD PRIMARY KEY (`orderAddressId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderItemId`),
  ADD KEY `orderDetailId` (`orderDetailId`);

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
  ADD KEY `product_customer_group_price_ibfk_1` (`productId`),
  ADD KEY `product_customer_group_price_ibfk_2` (`customerGroupId`);

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
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `cartaddress`
--
ALTER TABLE `cartaddress`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `config_group`
--
ALTER TABLE `config_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `orderaddress`
--
ALTER TABLE `orderaddress`
  MODIFY `orderAddressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productmedia`
--
ALTER TABLE `productmedia`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `product_customer_group_price`
--
ALTER TABLE `product_customer_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `payment` (`paymentId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `shipping` (`shippingId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD CONSTRAINT `cartaddress_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartaddress_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartitem_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `config_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `config_group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `customergroup` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderDetailId`) REFERENCES `orderdetails` (`orderId`);

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
  ADD CONSTRAINT `product_customer_group_price_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_customer_group_price_ibfk_2` FOREIGN KEY (`customerGroupId`) REFERENCES `customergroup` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
