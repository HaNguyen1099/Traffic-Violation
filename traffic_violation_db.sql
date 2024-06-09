-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 11:44 AM
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
-- Database: `traffic_violation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `password`) VALUES
('Nguyễn Ngọc Hà', 'nnha.1099@gmail.com', '$2y$10$D6dwJ0av8Nw4sNbDk6PVWuhsiFtfxCR4kqDuNCsemtVUT2RYXT00K');

-- --------------------------------------------------------

--
-- Table structure for table `driving_licenses`
--

CREATE TABLE `driving_licenses` (
  `license_id` int(11) NOT NULL,
  `license_number` varchar(20) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `date_of_issue` date NOT NULL,
  `date_of_expiry` date NOT NULL,
  `issuing_authority` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driving_licenses`
--

INSERT INTO `driving_licenses` (`license_id`, `license_number`, `driver_name`, `date_of_issue`, `date_of_expiry`, `issuing_authority`) VALUES
(1, '123456', 'Nguyễn Ngọc Hà', '2024-05-14', '2028-10-17', 'Sở GTVT Ninh Bình'),
(2, '543210', 'Nguyễn Ngọc Quỳnh', '2020-01-02', '2025-01-02', 'Sở GTVT Thái Bình'),
(3, '678901', 'Đào Duy Thông', '2020-01-03', '2025-01-03', 'Sở GTVT Thanh Hóa'),
(4, '987651', 'Nguyễn Minh Tùng', '2024-04-29', '2027-10-05', 'Sở GTVT Quảng Bình'),
(5, '135790', 'Dương Tuấn Nam', '2023-02-28', '2026-10-17', 'Sở GTVT Hà Nội'),
(6, '246812', 'Phạm Thị Ngọc Mai', '2024-04-30', '2027-10-17', 'Sở GTVT Hải Phòng'),
(7, '236812', 'Phan Ngọc Minh', '2021-02-18', '2024-06-08', 'Sở GTVT Ninh Bình'),
(8, '436912', 'Nguyễn Hữu Mạnh', '2024-04-30', '2024-06-06', 'Sở GTVT Hải Phòng'),
(9, '536912', 'Nguyễn Minh Quân', '2022-10-17', '2026-10-17', 'Sở GTVT Hưng Yên'),
(10, '423454', 'Nguyễn Minh Vương', '2024-04-29', '2028-10-17', 'Sở GTVT Hưng Yên'),
(11, '256812', 'Phạm Đình Tiến', '2023-06-14', '2027-06-22', 'Sở GTVT Hà Nội'),
(12, '123455', 'Nguyễn Quang Thắng', '2024-01-03', '2028-09-11', 'Sở GTVT Thanh Hóa'),
(13, '335790', 'Nguyễn Xuân Phong', '2024-04-29', '2028-10-17', 'Sở GTVT Nam Định'),
(14, '536812', 'Đinh Hoàng Anh', '2021-12-27', '2026-10-06', 'Sở GTVT Nghệ An'),
(15, '998765', 'Nguyễn Thế Đức', '2024-02-06', '2028-10-24', 'Sở GTVT Hải Dương');

-- --------------------------------------------------------

--
-- Table structure for table `traffic_reports`
--

CREATE TABLE `traffic_reports` (
  `report_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `license_id` int(11) NOT NULL,
  `report_date` date NOT NULL,
  `violation_type` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `fine` int(11) NOT NULL,
  `officer_name` varchar(100) NOT NULL,
  `notes` text DEFAULT NULL,
  `isPaymentDone` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traffic_reports`
--

INSERT INTO `traffic_reports` (`report_id`, `vehicle_id`, `license_id`, `report_date`, `violation_type`, `location`, `fine`, `officer_name`, `notes`, `isPaymentDone`) VALUES
(1, 1, 1, '2024-02-07', 'Đi sai làn đường', 'ABC đường XYZ Hà Nội', 500000, 'Nguyễn Ngọc Hà', '2019-11-14 00:03:20', 1),
(2, 3, 3, '2020-01-02', 'Chuyển làn không có tín hiệu', 'ABC đường XYZ Hà Nội', 100000, 'Đào Duy Thông', '2019-11-14 00:28:30', 0),
(3, 4, 4, '2020-01-03', 'Vượt đèn đỏ', 'ABC đường XYZ Hà Nội', 1000000, 'Nguyễn Minh Tùng', '2019-11-14 00:29:24', 0),
(4, 6, 6, '2024-05-17', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 400000, 'Phạm Thị Ngọc Mai', '2019-11-14 00:29:55', 1),
(5, 5, 5, '2023-09-18', 'Không thắt dây an toàn', 'ABC đường XYZ Hà Nội', 500000, 'Dương Tuấn Nam', '2019-11-14 00:30:52', 1),
(6, 7, 7, '2024-04-30', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 400000, 'Phan Ngọc Minh', '2019-11-14 00:03:20', 0),
(7, 7, 7, '2024-04-29', 'Chở hàng hóa quá tải trọng', 'ABC đường XYZ Hà Nội', 700000, 'Phan Ngọc Minh', '2019-11-14 00:03:20', 0),
(8, 2, 2, '2024-04-29', 'Không có giấy phép lái xe', 'ABC đường XYZ Hà Nội', 200000, 'Nguyễn Ngọc Quỳnh', '2019-11-14 00:03:20', 1),
(9, 11, 11, '2024-05-07', 'Vượt quá tốc độ cho phép', 'ABC đường XYZ Hà Nội', 2000000, 'Phạm Đình Tiến', '2019-11-14 00:03:20', 0),
(10, 8, 8, '2024-04-28', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 500000, 'Nguyễn Hữu Mạnh', '2019-11-14 00:03:20', 0),
(11, 13, 13, '2024-04-28', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 500000, 'Nguyễn Xuân Phong', '2019-11-14 00:03:20', 1),
(12, 13, 13, '2024-04-28', 'Không có giấy phép lái xe', 'ABC đường XYZ Hà Nội', 200000, 'Nguyễn Xuân Phong', '2019-11-14 00:03:20', 1),
(13, 12, 12, '2024-04-30', 'Vượt đèn đỏ', 'ABC đường XYZ Hà Nội', 1000000, 'Nguyễn Quang Thắng', '2019-11-14 00:03:20', 0),
(14, 15, 15, '2024-04-28', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 500000, 'Nguyễn Thế Đức', '2019-11-14 00:03:20', 1),
(15, 15, 15, '2024-04-29', 'Không có giấy phép lái xe', 'ABC đường XYZ Hà Nội', 200000, 'Nguyễn Thế Đức', '2019-11-14 00:03:20', 1),
(16, 4, 4, '2024-04-29', 'Không thắt dây an toàn', 'ABC đường XYZ Hà Nội', 500000, 'Nguyễn Minh Tùng', '2019-11-14 00:03:20', 0),
(17, 14, 14, '2024-04-29', 'Không thắt dây an toàn', 'ABC đường XYZ Hà Nội', 500000, 'Đinh Hoàng Anh', '2019-11-14 00:03:20', 1),
(18, 15, 15, '2024-06-01', 'Không đội mũ bảo hiểm ', 'ABC đường XYZ Hà Nội', 400000, 'Nguyễn Thế Đức', '2019-11-14 00:03:20', 0),
(19, 8, 8, '2024-05-15', 'Không có giấy phép lái xe', 'ABC đường XYZ Hà Nội', 200000, 'Nguyễn Hữu Mạnh', '2019-11-14 00:03:20', 1),
(20, 10, 10, '2024-04-28', 'Chuyển làn không có tín hiệu', 'ABC đường XYZ Hà Nội', 100000, 'Nguyễn Minh Vương', '2019-11-14 00:03:20', 0),
(21, 9, 9, '2024-05-06', 'Vượt đèn đỏ', 'ABC đường XYZ Hà Nội', 1000000, 'Nguyễn Minh Quân', '2019-11-14 00:03:20', 0),
(22, 15, 15, '2024-05-17', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 400000, 'Nguyễn Thế Đức', '2019-11-14 00:03:20', 1),
(23, 6, 6, '2024-05-17', 'Không có giấy phép lái xe', 'ABC đường XYZ Hà Nội', 200000, 'Phạm Thị Ngọc Mai', '2019-11-14 00:03:20', 1),
(24, 11, 11, '2024-05-17', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 400000, 'Phạm Đình Tiến', '2019-11-14 00:03:20', 0),
(25, 10, 10, '2024-04-28', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 400000, 'Nguyễn Minh Vương', '2019-11-14 00:03:20', 1),
(26, 9, 9, '2024-04-30', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 400000, 'Nguyễn Minh Quân', '2019-11-14 00:03:20', 0),
(27, 15, 15, '2024-05-15', 'Vượt đèn đỏ', 'ABC đường XYZ Hà Nội', 1000000, 'Nguyễn Thế Đức', '2019-11-14 00:03:20', 0),
(28, 14, 14, '2024-05-01', 'Không có giấy phép lái xe', 'ABC đường XYZ Hà Nội', 200000, 'Đinh Hoàng Anh', '2019-11-14 00:03:20', 1),
(29, 14, 14, '2024-05-08', 'Chuyển làn không có tín hiệu', 'ABC đường XYZ Hà Nội', 100000, 'Đinh Hoàng Anh', '2019-11-14 00:03:20', 0),
(30, 1, 1, '2024-05-08', 'Không đội mũ bảo hiểm', 'ABC đường XYZ Hà Nội', 400000, 'Nguyễn Ngọc Hà', '2019-11-14 00:03:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `registration_date` date NOT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `license_plate`, `owner_name`, `registration_date`, `vehicle_type`, `color`) VALUES
(1, '35B-99999', 'Nguyễn Ngọc Hà', '2024-05-14', 'Xe máy', 'Đen'),
(2, '17B-54321', 'Nguyễn Ngọc Quỳnh', '2020-01-02', 'Ô tô', 'Trắng'),
(3, '36B-67890', 'Đào Duy Thông', '2020-01-03', 'Xe máy', 'Xanh'),
(4, '73B-13335', 'Nguyễn Minh Tùng', '2023-01-11', 'Ô tô', 'Đen'),
(5, '30A-23456', 'Dương Tuấn Nam', '2024-04-29', 'Ô tô', 'Đen'),
(6, '16B-98765', 'Phạm Thị Ngọc Mai', '2024-04-28', 'Xe máy', 'Đỏ'),
(7, '35B-23456', 'Phan Ngọc Minh', '2022-02-17', 'Xe máy', 'Đen'),
(8, '15B-87654', 'Nguyễn Hữu Mạnh', '2024-05-09', 'Xe máy', 'Xanh'),
(9, '89B-89898', 'Nguyễn Minh Quân', '2022-06-07', 'Xe máy', 'Trắng'),
(10, '89B-98989', 'Nguyễn Minh Vương', '2024-04-28', 'Xe máy', 'Đen'),
(11, '29B-29292', 'Phạm Đình Tiến', '2024-04-29', 'Xe máy', 'Đen'),
(12, '36A-36666', 'Nguyễn Quang Thắng', '2023-05-30', 'Ô tô', 'Trắng'),
(13, '18B-18881', 'Nguyễn Xuân Phong', '2024-04-30', 'Xe máy', 'Đen'),
(14, '37B-33377', 'Đinh Hoàng Anh', '2024-04-28', 'Ô tô', 'Xanh'),
(15, '34B-44433', 'Nguyễn Thế Đức', '2024-04-28', 'Xe máy', 'Xanh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driving_licenses`
--
ALTER TABLE `driving_licenses`
  ADD PRIMARY KEY (`license_id`),
  ADD UNIQUE KEY `license_number` (`license_number`);

--
-- Indexes for table `traffic_reports`
--
ALTER TABLE `traffic_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `license_id` (`license_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD UNIQUE KEY `license_plate` (`license_plate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driving_licenses`
--
ALTER TABLE `driving_licenses`
  MODIFY `license_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `traffic_reports`
--
ALTER TABLE `traffic_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `traffic_reports`
--
ALTER TABLE `traffic_reports`
  ADD CONSTRAINT `traffic_reports_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `traffic_reports_ibfk_2` FOREIGN KEY (`license_id`) REFERENCES `driving_licenses` (`license_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
