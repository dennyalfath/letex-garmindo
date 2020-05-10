-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 03:31 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letex-garmindo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`cat_id`, `cat_name`) VALUES
(1, 'Baju');

-- --------------------------------------------------------

--
-- Table structure for table `tb_client`
--

CREATE TABLE `tb_client` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(125) NOT NULL,
  `client_contact` varchar(15) NOT NULL,
  `client_date_register` date NOT NULL DEFAULT current_timestamp(),
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_client`
--

INSERT INTO `tb_client` (`client_id`, `client_name`, `client_contact`, `client_date_register`, `company_id`) VALUES
(1, 'Heri', '8888', '2020-05-10', 1),
(2, 'Reee', '666', '2020-05-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_company`
--

CREATE TABLE `tb_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_code` char(3) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `so_number` int(11) NOT NULL,
  `company_status` enum('Active','Inactive') NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `invoice_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_company`
--

INSERT INTO `tb_company` (`company_id`, `company_name`, `company_code`, `company_contact`, `company_address`, `so_number`, `company_status`, `company_logo`, `invoice_number`) VALUES
(1, 'PT Letex', 'LTX', '123456', 'Batam', 4, 'Active', '', NULL),
(2, '4444', '242', '32323', '232323', 0, 'Active', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_fabric`
--

CREATE TABLE `tb_fabric` (
  `fab_id` int(11) NOT NULL,
  `fab_code` int(11) NOT NULL,
  `fab_description` varchar(255) DEFAULT NULL,
  `fab_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `invoice_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `date_issued` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice_detail`
--

CREATE TABLE `tb_invoice_detail` (
  `invd_id` int(11) NOT NULL,
  `invd_invoice_id` int(11) NOT NULL,
  `so_detail_id` int(11) NOT NULL,
  `invd_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `pr_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pr_name` varchar(100) NOT NULL,
  `style` varchar(100) DEFAULT NULL,
  `sell_price` int(11) NOT NULL,
  `pr_description` varchar(255) DEFAULT NULL,
  `pr_picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`pr_id`, `client_id`, `cat_id`, `pr_name`, `style`, `sell_price`, `pr_description`, `pr_picture`) VALUES
(1, 1, 1, 'Baju Batik', '-', 3500, 'blabla', NULL),
(2, 1, 1, 'Kemeja', 'wwww', 5666, 'zzz', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sales_order`
--

CREATE TABLE `tb_sales_order` (
  `so_id` int(11) NOT NULL,
  `so_number` varchar(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `so_description` varchar(255) DEFAULT NULL,
  `so_date_order` date NOT NULL DEFAULT current_timestamp(),
  `so_total_amount` int(11) DEFAULT NULL,
  `so_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sales_order`
--

INSERT INTO `tb_sales_order` (`so_id`, `so_number`, `client_id`, `so_description`, `so_date_order`, `so_total_amount`, `so_status`) VALUES
(1, 'LTX-002', 1, 'sss', '2020-05-10', NULL, 'sew'),
(2, 'LTX-003', 1, '4444', '2020-05-10', 8500000, 'cut'),
(3, 'LTX-004', 1, 's', '2020-05-10', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sales_order_detail`
--

CREATE TABLE `tb_sales_order_detail` (
  `sod_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `so_number` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `remark_size` varchar(100) NOT NULL,
  `sod_description` varchar(255) DEFAULT NULL,
  `sod_status` varchar(50) NOT NULL,
  `last_updated` date NOT NULL DEFAULT current_timestamp(),
  `invoice_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sales_order_detail`
--

INSERT INTO `tb_sales_order_detail` (`sod_id`, `pr_id`, `so_number`, `user_id`, `qty`, `price`, `remark_size`, `sod_description`, `sod_status`, `last_updated`, `invoice_qty`) VALUES
(18, 1, 'LTX-003', 1, 30, 150000, 'S', '', 'cancelled', '2020-05-10', NULL),
(19, 2, 'LTX-003', 1, 50, 170000, 'L', '', 'cut', '2020-05-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `block` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`, `role`, `block`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 'N'),
(2, 'denny', '34814f45c5b89ee4ea7e77662747a0e6', 'drafter', 'N'),
(9, 'heri', 'af25458116a2464f9401870dff1e11f5', 'admin', 'N'),
(10, 'manager', '0795151defba7a4b5dfa89170de46277', 'manager', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tb_client`
--
ALTER TABLE `tb_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tb_company`
--
ALTER TABLE `tb_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tb_fabric`
--
ALTER TABLE `tb_fabric`
  ADD PRIMARY KEY (`fab_id`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tb_invoice_detail`
--
ALTER TABLE `tb_invoice_detail`
  ADD PRIMARY KEY (`invd_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `tb_sales_order`
--
ALTER TABLE `tb_sales_order`
  ADD PRIMARY KEY (`so_id`);

--
-- Indexes for table `tb_sales_order_detail`
--
ALTER TABLE `tb_sales_order_detail`
  ADD PRIMARY KEY (`sod_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_client`
--
ALTER TABLE `tb_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_company`
--
ALTER TABLE `tb_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_fabric`
--
ALTER TABLE `tb_fabric`
  MODIFY `fab_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_invoice_detail`
--
ALTER TABLE `tb_invoice_detail`
  MODIFY `invd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_sales_order`
--
ALTER TABLE `tb_sales_order`
  MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sales_order_detail`
--
ALTER TABLE `tb_sales_order_detail`
  MODIFY `sod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
