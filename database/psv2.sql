-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 09:35 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_type` int(11) NOT NULL,
  `access_permission` text NOT NULL,
  `level` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `mobile`, `status`, `user_type`, `access_permission`, `level`, `deletion_status`) VALUES
(1, 'Admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '0', 1, 1, 'ALL,Medicine,MedicineList,ProductList,ProductType,rack,generic,company,expired,expiredSoon,Purchase,addNewPur,allPur,purRet,allPurRet,deletePur,deletePurRet,Payment,createPay,allPay,delPay,POS,newInv,allInv,salesRet,manageAllRet,deleteInv,deleteRet,Collection,addCollection,allCollection,delCollection,Customer,cusType,newCus,allCus,editCus,delCus,Finance,bank,allIncHead,inc,editInc,delInc,allExpHead,exp,editExp,delExp,overhead,allOverhead,Setting,Login History,Backup,Report,InCash,stkReport,stkAlert,currentStock,outStock,expStock,purReport,purReportSup,purReturnReport,salesReport,salesReturnReport,salesReportSalesman,salesProfit,lossReport,paymentReport,collectionReport,expReport,supplierReport,customerReport,netProfit,overheadReport,profit,sd', 1, 0),
(2, 'Test salesman', 'test', '', '098f6bcd4621d373cade4e832627b4f6', '0', 1, 2, 'ALL', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_history`
--

CREATE TABLE `admin_login_history` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `date_time` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank_name`, `status`, `deletion_status`) VALUES
(1, 'Bangladesh Bank', 1, 0),
(2, 'Sonali Bank', 1, 0),
(3, 'Dutch Bangla Bank Ltd.', 1, 0),
(4, 'IFIC bank', 1, 0),
(5, 'Islami Bank Bangladesh Ltd.', 1, 0),
(6, 'EXIM Bank', 1, 0),
(7, 'BDBL Bank', 1, 0),
(8, 'Rupali Bank', 1, 0),
(9, 'Janata Bank', 1, 0),
(10, 'Agrani Bank', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `discount` varchar(50) NOT NULL DEFAULT '0',
  `sub_total` double(10,2) NOT NULL,
  `net_cost` double(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `common_id` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collection_invoice_count`
--

CREATE TABLE `collection_invoice_count` (
  `id` int(11) NOT NULL,
  `invoice_insert_id` int(11) DEFAULT NULL,
  `inv_date` varchar(100) DEFAULT NULL,
  `inv_year` varchar(20) DEFAULT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `opening` double(10,2) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `medicine` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `opening` double(10,2) NOT NULL,
  `cus_type` int(11) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `followup_date` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `location`, `email`, `medicine`, `status`, `mobile`, `address`, `opening`, `cus_type`, `balance`, `followup_date`, `created`, `deletion_status`) VALUES
(1, 'Default Customer', '', 'xvirus.bd@gmail.com', '', 1, '0', 'Bangladesh', 0.00, 3, 0.00, '', '2020-03-26 14:59:20', 0),
(2, 'Test', 'Dhaka', '0', '', 1, '0', '0', 0.00, 3, 0.00, '', '2020-07-30 23:11:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_collection`
--

CREATE TABLE `customer_collection` (
  `id` int(11) NOT NULL,
  `collection_receipt` text NOT NULL,
  `customerId` int(11) NOT NULL,
  `previous_due` double(10,2) NOT NULL,
  `collection` double(10,2) NOT NULL,
  `current_due` double(10,2) NOT NULL,
  `collectionDate` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_invoice_info`
--

CREATE TABLE `customer_invoice_info` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `previous_due` double(10,2) NOT NULL,
  `invoice_number` text NOT NULL,
  `sale_date` varchar(100) NOT NULL,
  `mainTotalAmount` double(10,2) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `totalNetAmount` double(10,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `less` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `changeAmount` double(10,2) NOT NULL,
  `dues` double(10,2) NOT NULL,
  `inv_due` double(10,2) NOT NULL DEFAULT 0.00,
  `checkAmount` double(10,2) NOT NULL,
  `bankName` varchar(200) NOT NULL,
  `checkNumber` varchar(200) NOT NULL,
  `checkAppDate` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `invdatetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_return_invoice_info`
--

CREATE TABLE `customer_return_invoice_info` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `previous_due` double(10,2) NOT NULL,
  `invoice_number` text NOT NULL,
  `sale_date` varchar(100) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `totalNetAmount` double(10,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `less` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `dues` double(10,2) NOT NULL,
  `checkAmount` double(10,2) NOT NULL,
  `bankName` varchar(200) NOT NULL,
  `checkNumber` varchar(200) NOT NULL,
  `checkAppDate` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` double(10,2) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `customer_type` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`id`, `customer_type`, `status`, `created`, `deletion_status`) VALUES
(1, 'Indoor Customer', 1, '2018-07-18 21:47:43', 0),
(2, 'Outdoor Customer', 1, '2018-07-18 22:11:03', 0),
(3, 'Walking Customer', 1, '2018-07-18 22:11:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `expense_head` int(11) NOT NULL,
  `expense_amount` double(10,2) NOT NULL,
  `expense_date` varchar(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_head`
--

CREATE TABLE `expense_head` (
  `id` int(11) NOT NULL,
  `expense_head_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_head`
--

INSERT INTO `expense_head` (`id`, `expense_head_name`, `status`, `deletion_status`) VALUES
(1, 'Others', 1, 0),
(2, 'Tea Bill', 1, 0),
(3, 'Personal', 1, 0),
(4, 'Lunch', 1, 0),
(5, 'Poor Donation', 1, 0),
(6, 'Religious Donation', 1, 0),
(7, 'Electricity Bill', 1, 0),
(8, 'Staff Salary', 1, 0),
(9, 'Mobile Bill', 1, 0),
(10, 'Overhead Cost', 1, 0),
(11, 'Internet', 1, 0),
(12, 'Dr Fee ', 1, 0),
(13, 'Paharadar', 1, 0),
(14, 'Polythin', 1, 0),
(15, 'Petrol ', 1, 0),
(16, 'Pharmacuticals Company', 1, 0),
(17, 'Bkash Dhaka', 1, 0),
(18, 'Shukur Pharma', 1, 0),
(19, 'CC Camera (mainuddin)', 1, 0),
(20, 'Jenator Repair', 1, 0),
(21, 'Register khata', 1, 0),
(22, 'Company bill', 1, 0),
(23, 'Pharmachy Software Monthly', 1, 0),
(24, 'Computer windows', 1, 0),
(25, 'Dokan Bara', 1, 0),
(26, 'Medicine Correction', 1, 0),
(27, 'Eid Bonous', 1, 0),
(28, 'Meter Reading Writer', 1, 0),
(29, 'MINODIN NEW COMPUTER', 1, 1),
(30, 'MINODIN NEW COMPUTER 3', 1, 0),
(31, 'MEDICINE CARING SHOPPING BAG ', 1, 0),
(32, 'MEDICINE MINI BAG', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expired_stock`
--

CREATE TABLE `expired_stock` (
  `id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `mdate` varchar(100) NOT NULL,
  `edate` varchar(100) NOT NULL,
  `pur_date` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generic`
--

CREATE TABLE `generic` (
  `id` int(11) NOT NULL,
  `generic_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `income_head` int(11) NOT NULL,
  `income_amount` double(10,2) NOT NULL,
  `income_date` varchar(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `income_head`
--

CREATE TABLE `income_head` (
  `id` int(11) NOT NULL,
  `income_head_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income_head`
--

INSERT INTO `income_head` (`id`, `income_head_name`, `status`, `deletion_status`) VALUES
(1, 'Nebulize', 1, 0),
(2, 'Doctor Visit', 1, 0),
(3, 'Diabetic test', 1, 0),
(4, 'bull sonsudon', 1, 0),
(5, 'due', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `address_line1` text NOT NULL,
  `address_line2` text NOT NULL,
  `mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `store_name`, `address_line1`, `address_line2`, `mobile`) VALUES
(1, 'Super Pharmacy', 'Dhaka, Bangladesh', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

CREATE TABLE `investment` (
  `id` int(11) NOT NULL,
  `invest` double(10,2) NOT NULL,
  `investmentDate` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `in_cash_history`
--

CREATE TABLE `in_cash_history` (
  `id` int(11) NOT NULL,
  `date` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `opening` double(10,2) NOT NULL DEFAULT 0.00,
  `inc` double(10,2) NOT NULL,
  `exp` double(10,2) NOT NULL,
  `less` double(10,2) NOT NULL,
  `access` double(10,2) NOT NULL,
  `incash` double(10,2) NOT NULL,
  `remarks` text COLLATE utf8_german2_ci NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_cash_income`
--

CREATE TABLE `in_cash_income` (
  `id` int(11) NOT NULL,
  `date` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `logoId` int(10) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`logoId`, `logo`) VALUES
(1, '2626cf4618.png');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(255) DEFAULT NULL,
  `medicine_form` varchar(200) DEFAULT NULL,
  `medicine_strength` varchar(200) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `generic_id` int(11) NOT NULL DEFAULT 0,
  `company_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `pro_type` int(11) NOT NULL DEFAULT 1,
  `indication` text DEFAULT NULL,
  `side_effect` text DEFAULT NULL,
  `administration` text DEFAULT NULL,
  `rack_id` int(11) NOT NULL DEFAULT 1,
  `min_stock` int(11) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `purchases_price` double(10,2) NOT NULL DEFAULT 0.00,
  `sale_price` double(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `net_capital`
--

CREATE TABLE `net_capital` (
  `id` int(11) NOT NULL,
  `total_purchase` double(10,2) NOT NULL,
  `total_due` double(10,2) NOT NULL,
  `opening_balance` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `total_supplier_due` double(10,2) NOT NULL,
  `net_capital` double(10,2) NOT NULL,
  `date` varchar(100) NOT NULL,
  `deletion_status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `overhead`
--

CREATE TABLE `overhead` (
  `id` int(11) NOT NULL,
  `overhead_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `overhead_info`
--

CREATE TABLE `overhead_info` (
  `id` int(11) NOT NULL,
  `overhead_info_head` int(11) NOT NULL,
  `overhead_info_amount` double(10,2) NOT NULL,
  `overhead_info_date` varchar(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_invoice_count`
--

CREATE TABLE `payment_invoice_count` (
  `id` int(11) NOT NULL,
  `invoice_insert_id` int(11) DEFAULT NULL,
  `inv_date` varchar(100) DEFAULT NULL,
  `inv_year` varchar(20) DEFAULT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `product_type` varchar(100) COLLATE utf8_german2_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `product_type`, `status`, `created`, `deletion_status`) VALUES
(1, 'Medicine', 1, '2018-10-16 11:12:05', 0),
(2, 'Consumer', 1, '2018-10-16 11:12:05', 0),
(3, 'Baby Product', 1, '2018-10-16 11:59:01', 0),
(4, 'Surgical ', 1, '2018-10-20 14:34:06', 0),
(5, 'other income', 1, '2018-10-30 18:34:50', 0),
(6, 'roller bandage 4 inche', 1, '2018-12-23 19:06:25', 1),
(7, 'surgical gauze arjun brand', 1, '2018-12-23 19:07:18', 0),
(8, 'Savlon Cream 60gm', 1, '2019-12-16 13:58:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product_info`
--

CREATE TABLE `purchase_product_info` (
  `id` int(11) NOT NULL,
  `medicine` int(11) NOT NULL,
  `manufacturing` varchar(100) NOT NULL,
  `expire_date` varchar(100) NOT NULL,
  `purchase_price` double(10,2) NOT NULL,
  `sale_price` double(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `unit_type` varchar(100) NOT NULL,
  `carton_quantity` int(11) NOT NULL DEFAULT 0,
  `box_quantity` int(11) NOT NULL DEFAULT 0,
  `status_flag` tinyint(4) NOT NULL DEFAULT 0,
  `common_id` text NOT NULL,
  `supplier` int(11) NOT NULL DEFAULT 0,
  `pur_date` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_product_info`
--

INSERT INTO `purchase_product_info` (`id`, `medicine`, `manufacturing`, `expire_date`, `purchase_price`, `sale_price`, `qty`, `sub_total`, `unit_type`, `carton_quantity`, `box_quantity`, `status_flag`, `common_id`, `supplier`, `pur_date`, `deletion_status`) VALUES
(1, 7368, '1970-01-01', '2022-01-31', 18.00, 20.00, 18, 324.00, 'Pcs', 0, 0, 1, '01', 37, '2021-06-19', 0),
(2, 19397, '1970-01-01', '2021-06-30', 0.69, 0.80, 15, 10.35, 'Pcs', 0, 0, 1, '01', 37, '2021-06-19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_product_info`
--

CREATE TABLE `purchase_return_product_info` (
  `id` int(11) NOT NULL,
  `medicine` int(11) NOT NULL,
  `manufacturing` varchar(100) NOT NULL,
  `expire_date` varchar(100) NOT NULL,
  `purchase_price` double(10,2) NOT NULL,
  `sale_price` double(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `unit_type` varchar(100) NOT NULL,
  `carton_quantity` int(11) NOT NULL DEFAULT 0,
  `box_quantity` int(11) NOT NULL DEFAULT 0,
  `status_flag` tinyint(4) NOT NULL DEFAULT 0,
  `common_id` text NOT NULL,
  `supplier` int(11) NOT NULL DEFAULT 0,
  `pur_date` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE `rack` (
  `id` int(11) NOT NULL,
  `rack_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`id`, `rack_name`, `status`, `created`, `deletion_status`) VALUES
(1, 'Rack1', 1, '2018-07-03 16:13:14', 0),
(2, 'Rack2', 1, '2018-07-03 16:40:46', 0),
(3, 'rack3', 1, '2018-07-03 16:40:46', 0),
(4, 'Rack4', 1, '2018-07-03 17:05:22', 0),
(5, '5', 1, '2019-04-17 19:53:03', 1),
(6, 'Rack 5', 1, '2019-04-17 19:53:30', 0),
(7, 'Rack 6', 1, '2019-04-17 19:53:37', 0),
(8, 'Rack 7', 1, '2019-04-17 19:53:41', 0),
(9, 'Rack 8', 1, '2019-04-17 19:53:46', 0),
(10, 'Rack 9', 1, '2019-04-17 19:53:54', 0),
(11, 'Rack 10', 1, '2019-04-17 19:53:59', 0),
(12, 'Rack 11', 1, '2019-04-17 19:54:03', 0),
(13, 'Rack 12', 1, '2019-04-17 19:54:10', 0),
(14, 'Rack 13', 1, '2019-04-17 19:54:16', 0),
(15, 'Rack 14', 1, '2019-04-17 19:54:21', 0),
(16, 'Rack 15', 1, '2019-04-17 19:54:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `return_cart`
--

CREATE TABLE `return_cart` (
  `id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `net_cost` double(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `common_id` varchar(100) CHARACTER SET latin1 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `return_sale_product_info`
--

CREATE TABLE `return_sale_product_info` (
  `id` int(11) NOT NULL,
  `medicine` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `net_cost` double(10,2) NOT NULL,
  `inv_number` text NOT NULL,
  `commonId` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nid` varchar(100) NOT NULL,
  `birth` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salesman_login_history`
--

CREATE TABLE `salesman_login_history` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `date_time` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice_count`
--

CREATE TABLE `sale_invoice_count` (
  `id` int(11) NOT NULL,
  `invoice_insert_id` int(11) DEFAULT NULL,
  `inv_date` varchar(100) DEFAULT NULL,
  `inv_year` varchar(20) DEFAULT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sale_product_info`
--

CREATE TABLE `sale_product_info` (
  `id` int(11) NOT NULL,
  `medicine` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `discount` varchar(50) NOT NULL DEFAULT '0',
  `sub_total` double(10,2) NOT NULL,
  `net_cost` double(10,2) NOT NULL,
  `inv_number` text NOT NULL,
  `commonId` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `product_os` double(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_invoice_count`
--

CREATE TABLE `sale_return_invoice_count` (
  `id` int(11) NOT NULL,
  `invoice_insert_id` int(11) DEFAULT NULL,
  `inv_date` varchar(100) DEFAULT NULL,
  `inv_year` varchar(20) DEFAULT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `company` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `opening` double(10,2) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `address` text COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `company`, `mobile`, `status`, `opening`, `balance`, `address`, `email`, `created`, `deletion_status`) VALUES
(1, 'Beximco', 'Beximco', '01847240545', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:19:06', 0),
(2, 'Square', 'Square', '01730333506', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:19:27', 0),
(3, 'Acme', 'Acme', '01755519210', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:20:09', 0),
(4, 'Drug International', 'Drug International', '01855981354', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:20:31', 0),
(5, 'Globe ', 'Globe', '01708465893', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:20:46', 0),
(6, 'Kemiko', 'Kemiko', '01847449929, 01761743577', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:21:25', 0),
(7, 'Incepta', 'Incepta', '01737412538 habib, 01747093846-ovaidul vai', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:22:13', 0),
(8, 'Aristo Pharma', 'Aristo Pharma', '01959922771, 01799774558(hasan), 01959920352 (Somr', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:22:31', 0),
(9, 'Opsonin', 'Opsonin', '01921557232', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:22:48', 0),
(10, 'General Pharma', 'General Pharma', '01872600315', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:23:04', 0),
(11, 'Radiant', 'Radiant', '01847052405', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:23:20', 0),
(12, 'Health Care', 'Health Care', '01977157481', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:23:38', 0),
(13, 'Reneta', 'Reneta', '01847195961, 01718433201', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:23:59', 0),
(14, 'ACI', 'ACI', '01799980925', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:24:15', 0),
(15, 'Beacon', 'Beacon', '01735943058', 1, 0.00, 0.00, 'Dhaka', '', '2018-10-20 18:24:40', 0),
(16, 'Team pharma', 'Team pharmaceuticals', '01847220851', 1, 0.00, 0.00, 'baherchor ', '', '2018-10-23 18:07:01', 0),
(17, 'abani', 'addin', '01843564989', 1, 0.00, 0.00, '', '', '2018-10-23 18:11:42', 1),
(18, 'Ad-din', 'Ad-din', '111', 1, 0.00, 0.00, '', '', '2018-10-25 05:54:39', 0),
(19, 'Decent Pharma', 'Decent Pharma', '111', 1, 0.00, 0.00, '', '', '2018-10-25 06:22:17', 0),
(20, 'Nahar Medical', 'Shamim', '01843564989', 1, 0.00, 0.00, '', '', '2018-10-30 19:13:41', 0),
(21, 'JAMAN BROTHERS', 'JAMAN BROTHERS', '01711205175', 1, 0.00, 0.00, 'HASIMPURA BAZAR', '', '2018-11-13 12:03:24', 0),
(22, 'Genial Unani Laboratories', 'Genial Unani Laboratories', '018', 0, 0.00, 0.00, '', '', '2019-01-29 20:37:46', 1),
(23, 'SMC ENTERPRIZE', 'SMC ENTERPRIZE', '01711248811-Samsuddin Vai', 1, 0.00, 0.00, '', '', '2019-03-01 19:37:26', 0),
(24, 'Ibn Sina', 'Ibn Sina', '01779505074', 1, 0.00, 0.00, '', '', '2019-03-15 17:26:48', 0),
(25, 'Orion Pharma', 'Orion Pharma', '01769926460', 1, 0.00, 0.00, 'monir infusion mo.01718964976', '', '2019-03-15 17:28:51', 0),
(26, 'SKF', 'SKF', '01710440827', 1, 0.00, 0.00, 'wed-saturday-mon', '', '2019-03-16 12:28:06', 0),
(27, 'Popular', 'Popular', 'Mehidi Hasan-01635822410', 1, 0.00, 0.00, '', '', '2019-03-16 12:28:43', 0),
(28, 'Unimed Unihealth', 'Unimed Unihealth', '01671796018   01751067573 akter vai bairb', 1, 0.00, 0.00, '', '', '2019-03-16 12:29:22', 0),
(29, 'Nipro Jmi', 'Nipro Jmi', '01777780430', 1, 0.00, 0.00, '', '', '2019-03-16 12:30:20', 0),
(30, 'Rangs Pharmaceuticals', 'Rangs Pharmaceuticals', '01936001572', 1, 0.00, 0.00, '', '', '2019-03-21 20:10:04', 0),
(31, 'foreign Company', 'foreign Company', '018', 1, 0.00, 0.00, '', '', '2019-03-26 09:21:35', 0),
(32, 'Sun Pharma', 'Sun Pharma', '01721368408, 01 (mahabub Vai) 01715917301 Sun mamu', 1, 0.00, 0.00, '', '', '2019-03-26 14:17:23', 0),
(33, 'Ziska Pharma', 'Ziska Pharma', '01975991475', 1, 0.00, 0.00, '', '', '2019-03-27 10:08:37', 0),
(34, 'Pharmasia', 'Pharmasia', '018', 1, 0.00, 0.00, '', '', '2019-03-28 07:38:17', 0),
(35, 'Albion Pharma', 'Albion Pharma', '018', 1, 0.00, 0.00, '', '', '2019-03-28 07:58:10', 0),
(36, 'Pacific Pharmacuticals', 'Pacific Pharmacuticals', '018', 1, 0.00, 0.00, '', '', '2019-03-28 21:40:11', 0),
(37, 'Unidrug Unani Labrotory', 'Unidrug Unani Labrotory', '018', 1, 0.00, 0.00, '', '', '2019-03-28 21:52:40', 0),
(38, 'UNIVERSAL FOOD', 'UNIVERSAL FOOD', '018', 1, 0.00, 0.00, '', '', '2019-03-28 22:53:47', 0),
(39, 'Nuvista Pharma', 'Nuvista Pharma', '018', 1, 0.00, 0.00, '', '', '2019-03-29 07:39:36', 0),
(40, 'Sandoz Pharma', 'Sandoz Pharma', '017', 1, 0.00, 0.00, '', '', '2019-03-29 07:40:27', 0),
(41, 'The Ibn Sina Pharma', 'The Ibn Sina Pharma', '017', 1, 0.00, 0.00, '', '', '2019-03-29 07:41:16', 0),
(42, 'Navana', 'Navana pharmaceuticals', '01713515257', 1, 0.00, 0.00, 'hasimpur', '', '2019-03-30 12:23:05', 0),
(43, 'Opso saline', 'Opso saline', '00', 1, 0.00, 0.00, 'hasimpur', '', '2019-03-31 14:30:05', 0),
(44, 'Labaid pharma', 'Labaid pharma obaydur rahman', '01737917883', 1, 0.00, 0.00, 'hasimpur', '', '2019-04-02 19:22:58', 0),
(45, 'Jayson Pharma', 'Jayson Pharma', '018', 1, 0.00, 0.00, '', '', '2019-04-02 19:24:52', 0),
(46, 'chemist laboratories', 'chemist laboratories', 'Akter Hossain-01959910696', 1, 0.00, 0.00, '000', '0', '2019-04-05 08:46:12', 0),
(47, 'Sharif Pharma', 'Sharif Pharma', '017', 1, 0.00, 0.00, '', '', '2019-04-07 09:39:14', 0),
(48, 'Asiatic', 'Asiatic', '018', 1, 0.00, 0.00, '', '', '2019-04-07 22:17:58', 0),
(49, 'SAS marketing Company', 'Sas marketing company', '018', 1, 0.00, 0.00, 'hasimpur', '', '2019-04-08 08:30:59', 0),
(50, 'Saha Enterprise', 'Saha Enterprise', '018', 1, 0.00, 0.00, '', '', '2019-04-08 12:51:08', 0),
(51, 'Glaxo ', 'Glaxo ', '0', 1, 0.00, 0.00, '', '', '2019-04-08 19:04:41', 0),
(52, 'Libra Infusions', 'Libra Infusions', '018', 1, 0.00, 0.00, '', '', '2019-04-09 07:56:49', 0),
(53, 'Sanofi', 'Sanofi', '01709992322', 1, 0.00, 0.00, '', '', '2019-04-10 21:49:53', 0),
(54, 'SHARIF ISLAM', 'SHARIF ISLAM', '01735081676', 1, 0.00, 0.00, 'Hasimpur ', 'SHA@GMAIL.COM', '2019-04-11 19:59:25', 0),
(55, 'Hamdard labratories bangladesh', 'Hamdard labratories bangladesh', '01730087364', 1, 0.00, 0.00, 'hasimpur', '', '2019-04-12 13:18:20', 0),
(56, 'Leon Pharma', 'Leon Pharma', '017', 1, 0.00, 0.00, '', '', '2019-04-13 19:21:21', 0),
(57, 'Novo Nordisk', 'Novo Nordisk', '01787680554, 01919455922', 1, 0.00, 0.00, 'dhaka', '', '2019-04-21 16:41:00', 0),
(58, 'kumudini pharma', 'kumudini pharma', '018', 1, 0.00, 0.00, 'mamudpur', '', '2019-04-28 17:05:30', 0),
(59, 'Bio pharma', 'Bio pharma ', '018', 1, 0.00, 0.00, 'dhaka ', '', '2019-05-09 12:57:46', 0),
(60, 'White horse pharma', 'White horse pharma', '0178', 1, 0.00, 0.00, '', '', '2019-05-10 21:01:23', 0),
(61, 'Ripon DR', 'Ripon dr', '018', 1, 0.00, 0.00, 'koroitola', '', '2019-05-14 22:06:38', 0),
(62, 'Sunman Birdem', 'Sunman Birdem', '018', 1, 0.00, 0.00, '', '', '2019-05-17 11:52:36', 0),
(63, 'Cosmetics ', 'Cosmetics  ', '018', 1, 0.00, 0.00, 'bhairab ', '', '2019-05-24 11:22:54', 0),
(64, 'Din Islam', 'Din Islam', '017', 1, 0.00, 0.00, '', '', '2019-05-24 20:41:34', 0),
(65, 'Bhoiya Store', 'bhoia store + junayed vai', '018', 1, 0.00, 0.00, 'hasimpur bazer', '', '2019-05-29 10:12:50', 0),
(66, 'Medicine Inventory Purchase Correction', 'Medicine Inventory Purchase Correction', '018', 1, 0.00, 0.00, '', '', '2019-06-16 10:55:59', 0),
(67, 'Gaco Pharma', 'Gaco Pharma', '018', 1, 0.00, 0.00, '', '', '2019-06-17 20:06:38', 0),
(68, 'Sampol ', 'Sampol ', '01813922644', 1, 0.00, 0.00, 'hasimpur ', '', '2019-06-23 12:20:23', 0),
(69, 'Delta Pharma', 'Delta Pharma', '01713193418', 1, 0.00, 0.00, '', '', '2019-06-23 21:22:55', 0),
(70, 'Surgical', 'Surgical ', '018', 1, 0.00, 0.00, '', '', '2019-06-23 21:29:37', 0),
(71, 'Arif Medical hall', 'Arif Medical hall', '01963860263', 1, 0.00, 0.00, 'Station Road Narsingdi,', '', '2019-06-27 19:13:39', 0),
(72, 'Novartis bangaldesh', 'Novartis Bangladesh', '01713241534 Asad Miah', 1, 0.00, 0.00, 'mamudpur ', '', '2019-07-20 14:57:12', 0),
(73, 'All Companies Bonus Item (Zero Taka)', 'All Companies Bonus Item (Zero Taka)', '017', 1, 0.00, 0.00, '', '', '2019-07-25 22:57:01', 0),
(74, 'Bonus', 'Bonus', '01851119129', 1, 0.00, 0.00, 'sukur pharma', '', '2019-08-02 22:27:24', 0),
(75, 'Silva Pharmaceuticals', 'Silva Pharmaceuticals', '018/', 1, 0.00, 0.00, '', '', '2019-08-09 10:28:30', 0),
(76, 'Hayat Healthcare Co.', 'Hayat Healthcare Co.', '018', 1, 0.00, 0.00, '', '', '2019-08-09 21:16:00', 0),
(77, 'Bairab+Narsingdi', 'Bairab+Narsingdi', '018', 1, 0.00, 0.00, '', '', '2019-08-21 22:22:40', 0),
(78, 'Somatec', 'Somatec', '017', 1, 0.00, 0.00, '', '', '2019-08-22 13:52:18', 0),
(79, 'Bashundhara ', 'Bashundhara ', '015', 1, 0.00, 0.00, '', '', '2019-09-13 19:49:07', 0),
(80, 'Medicare', 'Medicare', '017', 1, 0.00, 0.00, '', '', '2019-09-20 12:44:27', 0),
(81, 'Square Toiletries Ltd', 'Square Toiletries Ltd', '00', 1, 0.00, 0.00, 'dhaka', '', '2019-09-28 19:04:42', 0),
(82, 'Square Pharmachy', 'Square Pharmachy', '01748140500', 1, 0.00, 0.00, 'Narsingdi, Station Road, Pro-Gopal Das', '', '2019-12-01 14:12:50', 0),
(83, 'Sohel Bhuyan', 'Sohel Bhuyan', '01828188105', 1, 0.00, 0.00, 'Raipura Bazar, Raipura, ', '', '2019-12-04 13:42:32', 0),
(84, 'Jupiter Healthcare', 'Jupiter Healthcare', '017', 1, 0.00, 0.00, '', '', '2019-12-17 13:45:59', 0),
(85, 'Alamgir Out Medicine', 'Alamgir Out Medicine', '01746641445', 1, 0.00, 0.00, '', '', '2019-12-23 19:26:08', 0),
(86, 'Al Falah', 'Al Falah', '01711937990', 1, 0.00, 0.00, 'Dhaka (Mitford)', '', '2019-12-24 13:19:52', 0),
(87, 'Allar Dan (Dhaka)', 'Allar Dan (Dhaka)', '01729755609', 1, 0.00, 0.00, 'Dhaka (Mitford)', '', '2019-12-24 13:27:15', 0),
(88, 'Centeon Pharma ', 'Centeon Pharma ', '017-Nur Ullah', 1, 0.00, 0.00, '', '', '2020-01-10 21:57:57', 0),
(89, 'Desh Pharmacuticals', 'Desh Pharmacuticals', '01715346683 Dulal Vai', 1, 0.00, 0.00, '', '', '2020-01-15 13:37:46', 0),
(90, 'Ergon Pharmaceuticals', 'Ergon Pharmaceuticals', '018', 1, 0.00, 0.00, 'hasimpur hannan doctor diller', '', '2020-02-05 11:46:14', 0),
(91, 'Alco Pharma', 'Alco Pharma', '0105', 1, 0.00, 0.00, '', '', '2020-02-10 19:29:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_invoice_info`
--

CREATE TABLE `supplier_invoice_info` (
  `id` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `previous_due` double(10,2) NOT NULL,
  `invoice_number` text NOT NULL,
  `purchase_date` varchar(100) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `less` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `dues` double(10,2) NOT NULL,
  `checkAmount` double(10,2) NOT NULL,
  `bankName` varchar(200) NOT NULL,
  `checkNumber` varchar(200) NOT NULL,
  `checkAppDate` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment`
--

CREATE TABLE `supplier_payment` (
  `id` int(11) NOT NULL,
  `payment_receipt` text NOT NULL,
  `supplierId` int(11) NOT NULL,
  `previous_due` double(10,2) NOT NULL,
  `payment` double(10,2) NOT NULL,
  `current_due` double(10,2) NOT NULL,
  `paymentDate` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_return_invoice_info`
--

CREATE TABLE `supplier_return_invoice_info` (
  `id` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `previous_due` double(10,2) NOT NULL,
  `invoice_number` text NOT NULL,
  `purchase_date` varchar(100) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `less` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `dues` double(10,2) NOT NULL,
  `checkAmount` double(10,2) NOT NULL,
  `bankName` varchar(200) NOT NULL,
  `checkNumber` varchar(200) NOT NULL,
  `checkAppDate` varchar(100) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `id` int(11) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `deletion_status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`id`, `user_type`, `status`, `deletion_status`) VALUES
(1, 'Super Admin', 1, 0),
(2, 'Salesman', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_name`, `status`, `deletion_status`) VALUES
(1, 'Pcs', 1, 1),
(2, 'Box', 1, 0),
(3, 'test', 1, 1),
(4, 'Carton', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `unq_admin_adminname` (`adminName`);

--
-- Indexes for table `admin_login_history`
--
ALTER TABLE `admin_login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_invoice_count`
--
ALTER TABLE `collection_invoice_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_collection`
--
ALTER TABLE `customer_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_invoice_info`
--
ALTER TABLE `customer_invoice_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_return_invoice_info`
--
ALTER TABLE `customer_return_invoice_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_head`
--
ALTER TABLE `expense_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expired_stock`
--
ALTER TABLE `expired_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generic`
--
ALTER TABLE `generic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_head`
--
ALTER TABLE `income_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment`
--
ALTER TABLE `investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_cash_history`
--
ALTER TABLE `in_cash_history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `in_cash_income`
--
ALTER TABLE `in_cash_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`logoId`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_name` (`medicine_name`);

--
-- Indexes for table `net_capital`
--
ALTER TABLE `net_capital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overhead`
--
ALTER TABLE `overhead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overhead_info`
--
ALTER TABLE `overhead_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_invoice_count`
--
ALTER TABLE `payment_invoice_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_product_info`
--
ALTER TABLE `purchase_product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return_product_info`
--
ALTER TABLE `purchase_return_product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_cart`
--
ALTER TABLE `return_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_sale_product_info`
--
ALTER TABLE `return_sale_product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesman_login_history`
--
ALTER TABLE `salesman_login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_invoice_count`
--
ALTER TABLE `sale_invoice_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_product_info`
--
ALTER TABLE `sale_product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_return_invoice_count`
--
ALTER TABLE `sale_return_invoice_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_invoice_info`
--
ALTER TABLE `supplier_invoice_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_return_invoice_info`
--
ALTER TABLE `supplier_return_invoice_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_type` (`user_type`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_login_history`
--
ALTER TABLE `admin_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_invoice_count`
--
ALTER TABLE `collection_invoice_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_collection`
--
ALTER TABLE `customer_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_invoice_info`
--
ALTER TABLE `customer_invoice_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_return_invoice_info`
--
ALTER TABLE `customer_return_invoice_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_head`
--
ALTER TABLE `expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `expired_stock`
--
ALTER TABLE `expired_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generic`
--
ALTER TABLE `generic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_head`
--
ALTER TABLE `income_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `investment`
--
ALTER TABLE `investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `in_cash_history`
--
ALTER TABLE `in_cash_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_cash_income`
--
ALTER TABLE `in_cash_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `logoId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `net_capital`
--
ALTER TABLE `net_capital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `overhead`
--
ALTER TABLE `overhead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `overhead_info`
--
ALTER TABLE `overhead_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_invoice_count`
--
ALTER TABLE `payment_invoice_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_product_info`
--
ALTER TABLE `purchase_product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_return_product_info`
--
ALTER TABLE `purchase_return_product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `rack`
--
ALTER TABLE `rack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `return_cart`
--
ALTER TABLE `return_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_sale_product_info`
--
ALTER TABLE `return_sale_product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salesman_login_history`
--
ALTER TABLE `salesman_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `sale_invoice_count`
--
ALTER TABLE `sale_invoice_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_product_info`
--
ALTER TABLE `sale_product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_return_invoice_count`
--
ALTER TABLE `sale_return_invoice_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `supplier_invoice_info`
--
ALTER TABLE `supplier_invoice_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_payment`
--
ALTER TABLE `supplier_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_return_invoice_info`
--
ALTER TABLE `supplier_return_invoice_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
