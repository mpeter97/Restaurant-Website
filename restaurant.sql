-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2017 at 04:50 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_accounts`
--

CREATE TABLE `employee_accounts` (
  `EmployeeID` int(5) NOT NULL,
  `Username` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_accounts`
--

INSERT INTO `employee_accounts` (`EmployeeID`, `Username`) VALUES
(10001, 'owner1'),
(10002, 'owner2'),
(10003, 'owner3'),
(10004, 'manager123'),
(10005, 'manager427'),
(10006, 'manager8210'),
(10007, 'manager1'),
(10008, 'manager2'),
(10009, 'manager3'),
(10010, 'manager4'),
(10011, 'manager5'),
(10012, 'manager6'),
(10013, 'manager7'),
(10014, 'manager8'),
(10015, 'manager9'),
(10016, 'manager10'),
(10017, 'employee1'),
(10018, 'employee2'),
(10019, 'employee3'),
(10020, 'employee4'),
(10021, 'employee5'),
(10022, 'employee6'),
(10023, 'employee7'),
(10024, 'employee8'),
(10025, 'employee9'),
(10026, 'employee10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_stores`
--

CREATE TABLE `employee_stores` (
  `EmployeeID` int(5) NOT NULL,
  `StoreNumber` int(5) NOT NULL,
  `IsManager` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_stores`
--

INSERT INTO `employee_stores` (`EmployeeID`, `StoreNumber`, `IsManager`) VALUES
(10001, 1, 'y'),
(10002, 1, 'y'),
(10003, 1, 'y'),
(10004, 1, 'y'),
(10007, 1, 'y'),
(10017, 1, 'n'),
(10001, 2, 'y'),
(10002, 2, 'y'),
(10003, 2, 'y'),
(10004, 2, 'y'),
(10008, 2, 'y'),
(10018, 2, 'n'),
(10001, 3, 'y'),
(10002, 3, 'y'),
(10003, 3, 'y'),
(10004, 3, 'y'),
(10009, 3, 'y'),
(10019, 3, 'n'),
(10001, 4, 'y'),
(10002, 4, 'y'),
(10003, 4, 'y'),
(10005, 4, 'y'),
(10010, 4, 'y'),
(10020, 4, 'n'),
(10001, 5, 'y'),
(10002, 5, 'y'),
(10003, 5, 'y'),
(10005, 5, 'y'),
(10011, 5, 'y'),
(10021, 5, 'n'),
(10001, 6, 'y'),
(10002, 6, 'y'),
(10003, 6, 'y'),
(10005, 6, 'y'),
(10012, 6, 'y'),
(10022, 6, 'n'),
(10001, 7, 'y'),
(10002, 7, 'y'),
(10003, 7, 'y'),
(10005, 7, 'y'),
(10013, 7, 'y'),
(10023, 7, 'n'),
(10001, 8, 'y'),
(10002, 8, 'y'),
(10003, 8, 'y'),
(10006, 8, 'y'),
(10014, 8, 'y'),
(10024, 8, 'n'),
(10001, 9, 'y'),
(10002, 9, 'y'),
(10003, 9, 'y'),
(10006, 9, 'y'),
(10015, 9, 'y'),
(10025, 9, 'n'),
(10001, 10, 'y'),
(10002, 10, 'y'),
(10003, 10, 'y'),
(10006, 10, 'y'),
(10016, 10, 'y'),
(10026, 10, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_information`
--

CREATE TABLE `ingredient_information` (
  `IngredientID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Price` float NOT NULL,
  `Calories` int(3) NOT NULL,
  `Carbs` int(3) NOT NULL,
  `Fat` int(3) NOT NULL,
  `Sodium` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredient_information`
--

INSERT INTO `ingredient_information` (`IngredientID`, `Name`, `Price`, `Calories`, `Carbs`, `Fat`, `Sodium`) VALUES
(1, 'Burger Patty', 1, 209, 20, 14, 71),
(2, 'Bun', 0, 280, 39, 9, 330),
(3, 'Cheese', 0.5, 70, 0, 8, 310),
(4, 'Ketchup', 0, 20, 5, 0, 160),
(5, 'Mustard', 0, 0, 0, 0, 55),
(6, 'Pickles', 0, 5, 1, 0, 260),
(7, 'Onions', 0, 10, 2, 0, 1),
(8, 'Tomatoes', 0, 9, 2, 0, 3),
(9, 'Lettuce', 0, 4, 1, 0, 3),
(10, 'Mushrooms', 0, 5, 1, 0, 55),
(11, 'Jalapeno Peppers', 0, 3, 0, 0, 0),
(12, 'Green Peppers', 0, 5, 1, 0, 1),
(13, 'Hot Sauce', 0, 0, 0, 0, 200),
(14, 'Mayo', 0, 100, 0, 11, 70),
(15, 'Bacon', 0.5, 86, 0, 7, 274),
(16, 'BBQ Sauce', 0, 29, 7, 0, 175),
(17, 'Banana Peppers', 0, 27, 2, 0, 13),
(18, 'Avocado', 0, 234, 12, 21, 10),
(19, 'Blue Cheese', 0.5, 119, 1, 10, 471),
(20, 'Ranch', 0, 73, 1, 8, 164),
(21, 'Fries', 2, 365, 48, 17, 246),
(22, 'Water', 0, 0, 0, 0, 0),
(23, 'Coca-Cola', 2, 140, 39, 0, 45),
(24, 'Diet Coke', 2, 0, 0, 0, 40),
(25, 'Cherry Coke', 2, 150, 42, 0, 35),
(26, 'Sprite', 2, 140, 38, 0, 65),
(27, 'Fanta', 2, 100, 28, 0, 35),
(28, 'Minute Maid', 2, 110, 27, 0, 15),
(29, 'Powerade', 2, 80, 21, 0, 150);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `OrderID` int(5) NOT NULL,
  `ItemNumber` int(5) NOT NULL,
  `ProductName` varchar(30) NOT NULL,
  `IngredientID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_user`
--

CREATE TABLE `order_user` (
  `OrderID` int(5) NOT NULL,
  `StoreNumber` int(5) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `DatePlaced` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateFulfilled` timestamp NULL DEFAULT NULL,
  `FulfilledBy` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_locations`
--

CREATE TABLE `store_locations` (
  `StoreNumber` int(5) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(40) NOT NULL,
  `State` varchar(2) NOT NULL,
  `ZipCode` int(5) NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_locations`
--

INSERT INTO `store_locations` (`StoreNumber`, `Address`, `City`, `State`, `ZipCode`, `Latitude`, `Longitude`) VALUES
(1, '4310 Stadium Drive', 'Kalamazoo', 'MI', 49007, 42.2710251, -85.6445881),
(2, '3900 Sprinkle Road', 'Kalamazoo', 'MI', 49001, 42.2520689, -85.533597),
(3, '5530 Gull Road', 'Kalamazoo', 'MI', 49001, 42.3232286, -85.5232593),
(4, '6925 South Westnedge Avenue', 'Portage', 'MI', 49002, 42.2165371, -85.5908228),
(5, '10280 Miller Drive', 'Galesburg', 'MI', 49053, 42.2750649, -85.4304368),
(6, '710 North Grand Street', 'Schoolcraft', 'MI', 49087, 42.1220857, -85.6386873),
(7, '1016 West Michigan Avenue', 'Three Rivers', 'MI', 49093, 41.942136, -85.6478753),
(8, '1160 East Michigan Avenue', 'Battle Creek', 'MI', 49014, 42.3099543, -85.1275187),
(9, '829 South Kalamazoo Street', 'Paw Paw', 'MI', 49097, 42.2097863, -85.8929632),
(10, '889 Marshall Street', 'Allegan', 'MI', 49010, 42.5175762, -85.8384949);

-- --------------------------------------------------------

--
-- Table structure for table `store_picture_pairs`
--

CREATE TABLE `store_picture_pairs` (
  `PictureID` int(11) NOT NULL,
  `UnlitPicture` varchar(255) NOT NULL,
  `LitPicture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_picture_pairs`
--

INSERT INTO `store_picture_pairs` (`PictureID`, `UnlitPicture`, `LitPicture`) VALUES
(1, 'UnlitBurger.png', 'LitBurger.png'),
(2, 'UnlitDoubleCheeseburger.png', 'LitDoubleCheeseburger.png'),
(3, 'UnlitBaconBurger.png', 'LitBaconBurger.png');

-- --------------------------------------------------------

--
-- Table structure for table `store_product_ingredients`
--

CREATE TABLE `store_product_ingredients` (
  `ProductName` varchar(30) NOT NULL,
  `IngredientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_product_ingredients`
--

INSERT INTO `store_product_ingredients` (`ProductName`, `IngredientID`) VALUES
('Avocado Burger', 1),
('Avocado Burger', 2),
('Avocado Burger', 3),
('Avocado Burger', 18),
('Bacon Burger', 1),
('Bacon Burger', 2),
('Bacon Burger', 3),
('Bacon Burger', 4),
('Bacon Burger', 14),
('Bacon Burger', 15),
('Bacon Fries', 3),
('Bacon Fries', 15),
('Bacon Fries', 21),
('BBQ Burger', 1),
('BBQ Burger', 2),
('BBQ Burger', 3),
('BBQ Burger', 15),
('BBQ Burger', 16),
('Blue Cheese Burger', 1),
('Blue Cheese Burger', 2),
('Blue Cheese Burger', 7),
('Blue Cheese Burger', 9),
('Blue Cheese Burger', 19),
('California Burger', 1),
('California Burger', 2),
('California Burger', 3),
('California Burger', 7),
('California Burger', 8),
('California Burger', 9),
('Cheese Fries', 3),
('Cheese Fries', 21),
('Cheeseburger', 1),
('Cheeseburger', 2),
('Cheeseburger', 3),
('Cheeseburger', 4),
('Cheeseburger', 5),
('Cheeseburger', 6),
('Cheeseburger', 7),
('Cheeseburger', 8),
('Cheeseburger', 9),
('Cheeseburger', 14),
('Cherry Coke', 25),
('Coca-Cola', 23),
('Diet Coke', 24),
('Fanta', 27),
('Fries', 21),
('Hamburger', 1),
('Hamburger', 2),
('Hamburger', 4),
('Hamburger', 5),
('Hamburger', 6),
('Hamburger', 7),
('Hamburger', 8),
('Hamburger', 9),
('Hamburger', 14),
('Inferno Burger', 1),
('Inferno Burger', 2),
('Inferno Burger', 3),
('Inferno Burger', 11),
('Inferno Burger', 13),
('Minute Maid', 28),
('Mushroom Burger', 1),
('Mushroom Burger', 2),
('Mushroom Burger', 3),
('Mushroom Burger', 10),
('Pepper Burger', 1),
('Pepper Burger', 2),
('Pepper Burger', 3),
('Pepper Burger', 11),
('Pepper Burger', 12),
('Pepper Burger', 17),
('Powerade', 29),
('Ranch Burger', 1),
('Ranch Burger', 2),
('Ranch Burger', 3),
('Ranch Burger', 15),
('Ranch Burger', 20),
('Spicy Fries', 11),
('Spicy Fries', 13),
('Spicy Fries', 21),
('Sprite', 26),
('Tartar Burger', 1),
('Tartar Burger', 2),
('Tartar Burger', 3),
('Tartar Burger', 6),
('Tartar Burger', 14),
('Veggie Burger', 2),
('Veggie Burger', 3),
('Veggie Burger', 4),
('Veggie Burger', 5),
('Veggie Burger', 6),
('Veggie Burger', 7),
('Veggie Burger', 8),
('Veggie Burger', 9),
('Veggie Burger', 14),
('Water', 22);

-- --------------------------------------------------------

--
-- Table structure for table `store_product_offerings`
--

CREATE TABLE `store_product_offerings` (
  `StoreNumber` int(5) NOT NULL,
  `ProductName` varchar(30) NOT NULL,
  `ProductType` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_product_offerings`
--

INSERT INTO `store_product_offerings` (`StoreNumber`, `ProductName`, `ProductType`) VALUES
(1, 'Avocado Burger', 'Burger'),
(1, 'Bacon Burger', 'Burger'),
(1, 'Bacon Fries', 'Side'),
(1, 'BBQ Burger', 'Burger'),
(1, 'Blue Cheese Burger', 'Burger'),
(1, 'California Burger', 'Burger'),
(1, 'Cheese Fries', 'Side'),
(1, 'Cheeseburger', 'Burger'),
(1, 'Cherry Coke', 'Drink'),
(1, 'Coca-Cola', 'Drink'),
(1, 'Diet Coke', 'Drink'),
(1, 'Fanta', 'Drink'),
(1, 'Fries', 'Side'),
(1, 'Hamburger', 'Burger'),
(1, 'Inferno Burger', 'Burger'),
(1, 'Minute Maid', 'Drink'),
(1, 'Pepper Burger', 'Burger'),
(1, 'Powerade', 'Drink'),
(1, 'Ranch Burger', 'Burger'),
(1, 'Spicy Fries', 'Side'),
(1, 'Sprite', 'Drink'),
(1, 'Tartar Burger', 'Burger'),
(1, 'Veggie Burger', 'Burger'),
(1, 'Water', 'Drink'),
(2, 'Bacon Burger', 'Burger'),
(2, 'Bacon Fries', 'Side'),
(2, 'BBQ Burger', 'Burger'),
(2, 'Cheese Fries', 'Side'),
(2, 'Cheeseburger', 'Burger'),
(2, 'Cherry Coke', 'Drink'),
(2, 'Coca-Cola', 'Drink'),
(2, 'Fries', 'Side'),
(2, 'Hamburger', 'Burger'),
(2, 'Inferno Burger', 'Burger'),
(2, 'Minute Maid', 'Drink'),
(2, 'Powerade', 'Drink'),
(2, 'Ranch Burger', 'Burger'),
(2, 'Sprite', 'Drink'),
(2, 'Tartar Burger', 'Burger'),
(2, 'Veggie Burger', 'Burger'),
(2, 'Water', 'Drink'),
(3, 'Bacon Burger', 'Burger'),
(3, 'BBQ Burger', 'Burger'),
(3, 'Cheese Fries', 'Side'),
(3, 'Cheeseburger', 'Burger'),
(3, 'Cherry Coke', 'Drink'),
(3, 'Coca-Cola', 'Drink'),
(3, 'Diet Coke', 'Drink'),
(3, 'Fanta', 'Drink'),
(3, 'Fries', 'Side'),
(3, 'Hamburger', 'Burger'),
(3, 'Inferno Burger', 'Burger'),
(3, 'Pepper Burger', 'Burger'),
(3, 'Spicy Fries', 'Side'),
(3, 'Sprite', 'Drink'),
(3, 'Veggie Burger', 'Burger'),
(3, 'Water', 'Drink'),
(4, 'Avocado Burger', 'Burger'),
(4, 'Bacon Burger', 'Burger'),
(4, 'Blue Cheese Burger', 'Burger'),
(4, 'California Burger', 'Burger'),
(4, 'Cheese Fries', 'Side'),
(4, 'Cheeseburger', 'Burger'),
(4, 'Coca-Cola', 'Drink'),
(4, 'Diet Coke', 'Drink'),
(4, 'Fries', 'Side'),
(4, 'Hamburger', 'Burger'),
(4, 'Minute Maid', 'Drink'),
(4, 'Powerade', 'Drink'),
(4, 'Tartar Burger', 'Burger'),
(4, 'Veggie Burger', 'Burger'),
(4, 'Water', 'Drink'),
(5, 'Bacon Burger', 'Burger'),
(5, 'BBQ Burger', 'Burger'),
(5, 'Cheeseburger', 'Burger'),
(5, 'Cherry Coke', 'Drink'),
(5, 'Coca-Cola', 'Drink'),
(5, 'Diet Coke', 'Drink'),
(5, 'Fries', 'Side'),
(5, 'Hamburger', 'Burger'),
(5, 'Mushroom Burger', 'Burger'),
(5, 'Powerade', 'Drink'),
(5, 'Ranch Burger', 'Burger'),
(5, 'Sprite', 'Drink'),
(5, 'Veggie Burger', 'Burger'),
(5, 'Water', 'Drink'),
(6, 'Bacon Burger', 'Burger'),
(6, 'BBQ Burger', 'Burger'),
(6, 'California Burger', 'Burger'),
(6, 'Cheeseburger', 'Burger'),
(6, 'Coca-Cola', 'Drink'),
(6, 'Diet Coke', 'Drink'),
(6, 'Fries', 'Side'),
(6, 'Hamburger', 'Burger'),
(6, 'Inferno Burger', 'Burger'),
(6, 'Minute Maid', 'Drink'),
(6, 'Pepper Burger', 'Burger'),
(6, 'Ranch Burger', 'Burger'),
(6, 'Spicy Fries', 'Side'),
(6, 'Veggie Burger', 'Burger'),
(6, 'Water', 'Drink'),
(7, 'Bacon Burger', 'Burger'),
(7, 'Bacon Fries', 'Side'),
(7, 'BBQ Burger', 'Burger'),
(7, 'Blue Cheese Burger', 'Burger'),
(7, 'California Burger', 'Burger'),
(7, 'Cheese Fries', 'Side'),
(7, 'Cheeseburger', 'Burger'),
(7, 'Cherry Coke', 'Drink'),
(7, 'Coca-Cola', 'Drink'),
(7, 'Fanta', 'Drink'),
(7, 'Fries', 'Side'),
(7, 'Hamburger', 'Burger'),
(7, 'Minute Maid', 'Drink'),
(7, 'Powerade', 'Drink'),
(7, 'Ranch Burger', 'Burger'),
(7, 'Spicy Fries', 'Side'),
(7, 'Veggie Burger', 'Burger'),
(7, 'Water', 'Drink'),
(8, 'Avocado Burger', 'Burger'),
(8, 'Bacon Burger', 'Burger'),
(8, 'BBQ Burger', 'Burger'),
(8, 'Blue Cheese Burger', 'Burger'),
(8, 'Cheeseburger', 'Burger'),
(8, 'Cherry Coke', 'Drink'),
(8, 'Coca-Cola', 'Drink'),
(8, 'Diet Coke', 'Drink'),
(8, 'Fanta', 'Drink'),
(8, 'Fries', 'Side'),
(8, 'Hamburger', 'Burger'),
(8, 'Inferno Burger', 'Burger'),
(8, 'Minute Maid', 'Drink'),
(8, 'Pepper Burger', 'Burger'),
(8, 'Powerade', 'Drink'),
(8, 'Ranch Burger', 'Burger'),
(8, 'Spicy Fries', 'Side'),
(8, 'Tartar Burger', 'Burger'),
(8, 'Veggie Burger', 'Burger'),
(8, 'Water', 'Drink'),
(9, 'Avocado Burger', 'Burger'),
(9, 'Bacon Burger', 'Burger'),
(9, 'BBQ Burger', 'Burger'),
(9, 'Blue Cheese Burger', 'Burger'),
(9, 'Cheese Fries', 'Side'),
(9, 'Cheeseburger', 'Burger'),
(9, 'Cherry Coke', 'Drink'),
(9, 'Coca-Cola', 'Drink'),
(9, 'Diet Coke', 'Drink'),
(9, 'Fries', 'Side'),
(9, 'Hamburger', 'Burger'),
(9, 'Powerade', 'Drink'),
(9, 'Ranch Burger', 'Burger'),
(9, 'Spicy Fries', 'Side'),
(9, 'Veggie Burger', 'Burger'),
(9, 'Water', 'Drink'),
(10, 'Bacon Burger', 'Burger'),
(10, 'Cheeseburger', 'Burger'),
(10, 'Coca-Cola', 'Drink'),
(10, 'Diet Coke', 'Drink'),
(10, 'Fries', 'Side'),
(10, 'Hamburger', 'Burger'),
(10, 'Veggie Burger', 'Burger'),
(10, 'Water', 'Drink');

-- --------------------------------------------------------

--
-- Table structure for table `store_product_pictures`
--

CREATE TABLE `store_product_pictures` (
  `ProductName` varchar(30) NOT NULL,
  `PictureID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_product_pictures`
--

INSERT INTO `store_product_pictures` (`ProductName`, `PictureID`) VALUES
('Avocado Burger', 1),
('Bacon Burger', 3),
('BBQ Burger', 3),
('Blue Cheese Burger', 2),
('California Burger', 1),
('Cheeseburger', 2),
('Hamburger', 1),
('Inferno Burger', 3),
('Pepper Burger', 2),
('Ranch Burger', 1),
('Tartar Burger', 1),
('Veggie Burger', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE `user_comments` (
  `Username` varchar(40) NOT NULL,
  `Comment` varchar(60) NOT NULL,
  `CommentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Selected` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_comments`
--

INSERT INTO `user_comments` (`Username`, `Comment`, `CommentDate`, `Selected`) VALUES
('owner1', 'That was one of the best burgers I\'ve had in a long time!', '2017-11-14 02:39:50', 'y'),
('owner2', 'WOW! No word is fit for food THAT good.', '2017-11-14 02:39:50', 'y'),
('owner3', 'Your life\'s not complete until you\'ve been to Three Guys.', '2017-11-14 02:39:50', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `Username` varchar(40) NOT NULL,
  `FirstName` varchar(60) NOT NULL,
  `LastName` varchar(60) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(40) NOT NULL,
  `State` varchar(2) NOT NULL,
  `ZipCode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`Username`, `FirstName`, `LastName`, `Address`, `City`, `State`, `ZipCode`) VALUES
('customer1', 'Kevin', 'Sharp', '111 Customer Avenue', 'Plainwell', 'MI', 49080),
('customer2', 'Milton', 'Robbins', '222 Customer Avenue', 'Plainwell', 'MI', 49080),
('customer3', 'Sammy', 'Logan', '333 Customer Avenue', 'Plainwell', 'MI', 49080),
('employee1', 'Tyler', 'Huff', '111 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee10', 'Eduardo', 'Simpson', '1010 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee2', 'Amanda', 'Bridges', '222 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee3', 'Julio', 'Grant', '333 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee4', 'Jerome', 'Thompson', '444 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee5', 'Tom', 'Fisher', '555 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee6', 'Megan', 'McDaniel', '666 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee7', 'Gustavo', 'Ballard', '777 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee8', 'Anita', 'Morgan', '888 Employee Drive', 'Three Rivers', 'MI', 49093),
('employee9', 'Johnnie', 'Hall', '999 Employee Drive', 'Three Rivers', 'MI', 49093),
('manager1', 'Waylong', 'Dalton', '111 Manager Street', 'Battle Creek', 'MI', 49015),
('manager10', 'Hadassah', 'Hartman', '1010 Manager Street', 'Battle Creek', 'MI', 49015),
('manager123', 'Joanna', 'Shaffer', '123 Manager Street', 'Portage', 'MI', 49002),
('manager2', 'Justine', 'Henderson', '222 Manager Street', 'Battle Creek', 'MI', 49015),
('manager3', 'Abdullah', 'Lang', '333 Manager Street', 'Battle Creek', 'MI', 49015),
('manager4', 'Marcus', 'Cruz', '444 Manager Street', 'Battle Creek', 'MI', 49015),
('manager427', 'Jonathon', 'Sheppard', '427 Manager Street', 'Portage', 'MI', 49002),
('manager5', 'Thalia', 'Cobb', '555 Manager Street', 'Battle Creek', 'MI', 49015),
('manager6', 'Mathias', 'Little', '666 Manager Street', 'Battle Creek', 'MI', 49015),
('manager7', 'Eddie', 'Randolph', '777 Manager Street', 'Battle Creek', 'MI', 49015),
('manager8', 'Angela', 'Walker', '888 Manager Street', 'Battle Creek', 'MI', 49015),
('manager8210', 'Pablo', 'Craig', '8210 Manager Street', 'Portage', 'MI', 49002),
('manager9', 'Lia', 'Shelton', '999 Manager Street', 'Battle Creek', 'MI', 49015),
('owner1', 'Matt', 'Peter', '111 Owner Road', 'Kalamazoo', 'MI', 49007),
('owner2', 'Jonah', 'Kubath', '222 Owner Road', 'Kalamazoo', 'MI', 49007),
('owner3', 'Greg', 'Smith', '333 Owner Road', 'Kalamazoo', 'MI', 49007);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `Username` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`Username`, `Password`) VALUES
('customer1', 'custo1Password'),
('customer2', 'custo2Password'),
('customer3', 'custo3Password'),
('employee1', 'emplo1Password'),
('employee10', 'emplo10Password'),
('employee2', 'emplo2Password'),
('employee3', 'emplo3Password'),
('employee4', 'emplo4Password'),
('employee5', 'emplo5Password'),
('employee6', 'emplo6Password'),
('employee7', 'emplo7Password'),
('employee8', 'emplo8Password'),
('employee9', 'emplo9Password'),
('manager1', 'manag1Password'),
('manager10', 'manag10Password'),
('manager123', 'manag123Password'),
('manager2', 'manag2Password'),
('manager3', 'manag3Password'),
('manager4', 'manag4Password'),
('manager427', 'manag427Password'),
('manager5', 'manag5Password'),
('manager6', 'manag6Password'),
('manager7', 'manag7Password'),
('manager8', 'manag8Password'),
('manager8210', 'manag8210Password'),
('manager9', 'manag9Password'),
('owner1', 'owner1Password'),
('owner2', 'owner2Password'),
('owner3', 'owner3Password');

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE `user_products` (
  `Username` varchar(40) NOT NULL,
  `ProductName` varchar(30) NOT NULL,
  `IngredientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_accounts`
--
ALTER TABLE `employee_accounts`
  ADD PRIMARY KEY (`EmployeeID`,`Username`);

--
-- Indexes for table `employee_stores`
--
ALTER TABLE `employee_stores`
  ADD PRIMARY KEY (`StoreNumber`,`EmployeeID`);

--
-- Indexes for table `ingredient_information`
--
ALTER TABLE `ingredient_information`
  ADD PRIMARY KEY (`IngredientID`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`OrderID`,`ItemNumber`,`ProductName`,`IngredientID`);

--
-- Indexes for table `order_user`
--
ALTER TABLE `order_user`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `store_locations`
--
ALTER TABLE `store_locations`
  ADD PRIMARY KEY (`StoreNumber`);

--
-- Indexes for table `store_picture_pairs`
--
ALTER TABLE `store_picture_pairs`
  ADD PRIMARY KEY (`PictureID`);

--
-- Indexes for table `store_product_ingredients`
--
ALTER TABLE `store_product_ingredients`
  ADD PRIMARY KEY (`ProductName`,`IngredientID`);

--
-- Indexes for table `store_product_offerings`
--
ALTER TABLE `store_product_offerings`
  ADD PRIMARY KEY (`StoreNumber`,`ProductName`);

--
-- Indexes for table `store_product_pictures`
--
ALTER TABLE `store_product_pictures`
  ADD PRIMARY KEY (`ProductName`);

--
-- Indexes for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD PRIMARY KEY (`Username`,`CommentDate`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `user_products`
--
ALTER TABLE `user_products`
  ADD PRIMARY KEY (`Username`,`ProductName`,`IngredientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredient_information`
--
ALTER TABLE `ingredient_information`
  MODIFY `IngredientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `order_user`
--
ALTER TABLE `order_user`
  MODIFY `OrderID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `store_locations`
--
ALTER TABLE `store_locations`
  MODIFY `StoreNumber` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
