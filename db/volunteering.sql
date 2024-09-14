-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 04:16 AM
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
-- Database: `volunteering`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminName` text NOT NULL,
  `adminEmail` varchar(300) NOT NULL,
  `adminPassword` text NOT NULL,
  `adminContact` varchar(10) NOT NULL,
  `adminType` int(1) NOT NULL COMMENT 'admin=1, subadmin=0',
  `adminRegDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `adminEmail`, `adminPassword`, `adminContact`, `adminType`, `adminRegDate`) VALUES
(1, 'admin', 'admin@vms.lk', '21232f297a57a5a743894a0e4a801fc3', '0766604494', 0, '2024-09-13 19:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(11) NOT NULL,
  `eventName` text NOT NULL,
  `eventDesc` text NOT NULL,
  `eventStart` datetime NOT NULL,
  `eventEnd` datetime NOT NULL,
  `eventNeed` int(11) NOT NULL,
  `eventConfirm` int(11) NOT NULL,
  `orgID` int(11) NOT NULL,
  `eventApproval` text NOT NULL,
  `eventImg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `eventName`, `eventDesc`, `eventStart`, `eventEnd`, `eventNeed`, `eventConfirm`, `orgID`, `eventApproval`, `eventImg`) VALUES
(1, 'Tech Innovations Symposium', 'The Tech Innovations Symposium is a premier gathering of technology enthusiasts professionals and innovators. This event will feature keynote speakers from leading tech companies hands-on workshops and networking opportunities to explore the latest advancements in technology. Join us to discuss emerging trends share ideas and collaborate on groundbreaking projects.', '2024-09-20 10:00:00', '2024-09-20 18:00:00', 75, 75, 1, 'Finished', 'default/event.png'),
(2, 'Green Initiatives Summit', 'The Green Initiatives Summit aims to bring together environmental advocates policymakers and community leaders to discuss sustainable practices and solutions. Attendees will learn about innovative green technologies successful case studies and strategies for reducing environmental impact. The summit will also offer sessions on policy advocacy and community engagement for a greener future.', '2024-09-21 09:00:00', '2024-09-21 17:00:00', 65, 64, 1, 'Pending', 'default/event.png'),
(3, 'Youth Leadership Conference', 'The Youth Leadership Conference is designed to empower young leaders with the skills and knowledge necessary for effective leadership. This conference will include workshops on leadership development public speaking and project management. Participants will also have the opportunity to network with seasoned leaders and gain insights into making a positive impact in their communities.', '2024-09-22 08:00:00', '2024-09-22 16:00:00', 80, 79, 2, 'Approved', 'default/event.png'),
(4, 'Global Peace Forum', 'The Global Peace Forum focuses on fostering international cooperation and dialogue to promote peace and conflict resolution. The forum will feature discussions on global peace initiatives presentations from peacebuilders and collaborative sessions to develop actionable strategies for conflict prevention. Join us in exploring ways to build a more harmonious world.', '2024-09-23 11:00:00', '2024-09-23 19:00:00', 90, 88, 2, 'Pending', 'default/event.png'),
(5, 'Emergency Relief Workshop', 'The Emergency Relief Workshop is dedicated to providing training and resources for effective emergency response and relief efforts. Participants will engage in practical exercises learn about the latest emergency response technologies and hear from experts on best practices for disaster management. This workshop aims to enhance preparedness and improve relief operations.', '2024-09-24 13:00:00', '2024-09-24 21:00:00', 85, 83, 3, 'Approved', 'default/event.png'),
(6, 'Tech Innovations Symposium', 'The Tech Innovations Symposium is a premier gathering of technology enthusiasts professionals and innovators. This event will feature keynote speakers from leading tech companies hands-on workshops and networking opportunities to explore the latest advancements in technology. Join us to discuss emerging trends share ideas and collaborate on groundbreaking projects.', '2024-09-25 10:00:00', '2024-09-25 18:00:00', 60, 58, 3, 'Pending', 'default/event.png'),
(7, 'Green Initiatives Summit', 'The Green Initiatives Summit aims to bring together environmental advocates policymakers and community leaders to discuss sustainable practices and solutions. Attendees will learn about innovative green technologies successful case studies and strategies for reducing environmental impact. The summit will also offer sessions on policy advocacy and community engagement for a greener future.', '2024-09-26 09:00:00', '2024-09-26 17:00:00', 55, 52, 4, 'Approved', 'default/event.png'),
(8, 'Youth Leadership Conference', 'The Youth Leadership Conference is designed to empower young leaders with the skills and knowledge necessary for effective leadership. This conference will include workshops on leadership development public speaking and project management. Participants will also have the opportunity to network with seasoned leaders and gain insights into making a positive impact in their communities.', '2024-09-27 08:00:00', '2024-09-27 16:00:00', 70, 68, 4, 'Pending', 'default/event.png'),
(9, 'Global Peace Forum', 'The Global Peace Forum focuses on fostering international cooperation and dialogue to promote peace and conflict resolution. The forum will feature discussions on global peace initiatives presentations from peacebuilders and collaborative sessions to develop actionable strategies for conflict prevention. Join us in exploring ways to build a more harmonious world.', '2024-09-28 11:00:00', '2024-09-28 19:00:00', 95, 92, 5, 'Approved', 'default/event.png'),
(10, 'Emergency Relief Workshop', 'The Emergency Relief Workshop is dedicated to providing training and resources for effective emergency response and relief efforts. Participants will engage in practical exercises learn about the latest emergency response technologies and hear from experts on best practices for disaster management. This workshop aims to enhance preparedness and improve relief operations.', '2024-09-29 13:00:00', '2024-09-29 21:00:00', 80, 78, 5, 'Pending', 'default/event.png');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `orgID` int(11) NOT NULL,
  `orgName` text NOT NULL,
  `orgEmail` varchar(300) NOT NULL,
  `orgPassword` text NOT NULL,
  `orgDesc` text NOT NULL,
  `orgAddress` varchar(300) NOT NULL,
  `orgRegNo` varchar(12) NOT NULL,
  `orgContact` varchar(10) NOT NULL,
  `orgImg` text NOT NULL DEFAULT 'default/org.png',
  `orgRegDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`orgID`, `orgName`, `orgEmail`, `orgPassword`, `orgDesc`, `orgAddress`, `orgRegNo`, `orgContact`, `orgImg`, `orgRegDate`) VALUES
(1, 'IEEE', 'org1@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'A global professional association for advancing technology', '123 Tech Park', 'ORG1234567', '0771234561', 'ieee.png', '2024-09-13 22:45:43'),
(2, 'ZeroPlastic', 'org2@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'An organization dedicated to eliminating plastic waste', '456 Eco Road', 'ORG1234568', '0771234562', 'zeroplastic.png', '2024-09-13 22:45:43'),
(3, 'AIESEC', 'org3@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'A youth-run organization providing leadership development opportunities', '789 Global St', 'ORG1234569', '0771234563', 'aiesec.png', '2024-09-13 22:45:43'),
(4, 'UN', 'org4@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'An international organization fostering global cooperation', '101 Peace Ave', 'ORG1234570', '0771234564', 'un.png', '2024-09-13 22:45:43'),
(5, 'Red Cross', 'org5@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'An organization providing emergency assistance and disaster relief', '202 Relief Blvd', 'ORG1234571', '0771234565', 'redcross.png', '2024-09-13 22:45:43'),
(6, 'Tech Innovators', 'org6@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'A group focused on fostering innovation in technology', '303 Startup Lane', 'ORG1234572', '0771234566', 'default/org.png', '2024-09-13 20:09:36'),
(7, 'Green Earth', 'org7@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'A nonprofit organization promoting environmental sustainability', '404 Nature Dr', 'ORG1234573', '0771234567', 'default/org.png', '2024-09-13 20:09:36'),
(8, 'Youth for Change', 'org8@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'An organization empowering young leaders to make social impact', '505 Future Rd', 'ORG1234574', '0771234568', 'default/org.png', '2024-09-13 20:09:36'),
(9, 'Health & Hope', 'org9@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'A charity organization providing healthcare in underprivileged areas', '606 Wellness Way', 'ORG1234575', '0771234569', 'default/org.png', '2024-09-13 20:09:36'),
(10, 'Innovate Tomorrow', 'org10@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'An organization supporting innovation and entrepreneurship', '707 Visionary St', 'ORG1234576', '0771234570', 'default/org.png', '2024-09-13 20:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `userID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `attendanceStatus` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`userID`, `eventID`, `attendanceStatus`, `timestamp`) VALUES
(1, 1, 1, '2024-09-14 02:09:00'),
(1, 3, 0, '2024-09-14 02:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` text NOT NULL,
  `userEmail` varchar(300) NOT NULL,
  `userPassword` text NOT NULL,
  `userAddress` varchar(300) NOT NULL,
  `userNIC` varchar(12) NOT NULL,
  `userContact` varchar(10) NOT NULL,
  `userImg` text NOT NULL DEFAULT 'default/user.png',
  `userNoOfEvents` int(11) NOT NULL,
  `userRegDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userEmail`, `userPassword`, `userAddress`, `userNIC`, `userContact`, `userImg`, `userNoOfEvents`, `userRegDate`) VALUES
(1, 'Lakpriya Gurugamage', 'user1@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', 'Nugegoda', '200030402702', '0766604494', 'user1.png', 2, '2024-09-14 02:09:00'),
(2, 'Olivia Johnson', 'user2@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '456 Oak St', '123456788V', '0771234562', 'user5.png', 0, '2024-09-13 20:23:15'),
(3, 'Noah Williams', 'user3@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '789 Pine St', '123456787V', '0771234563', 'user2.png', 0, '2024-09-13 20:23:24'),
(4, 'Emma Brown', 'user4@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '101 Cedar St', '123456786V', '0771234564', 'user4.png', 0, '2024-09-13 20:23:31'),
(5, 'Ava Jones', 'user5@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '202 Birch St', '123456785V', '0771234565', 'user3.png', 0, '2024-09-13 20:23:39'),
(6, 'Elijah Davis', 'user6@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '303 Willow St', '123456784V', '0771234566', 'default/user.png', 0, '2024-09-13 19:57:37'),
(7, 'Sophia Garcia', 'user7@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '404 Spruce St', '123456783V', '0771234567', 'default/user.png', 0, '2024-09-13 19:57:37'),
(8, 'James Miller', 'user8@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '505 Redwood St', '123456782V', '0771234568', 'default/user.png', 0, '2024-09-13 19:57:37'),
(9, 'Isabella Martinez', 'user9@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '606 Cypress St', '123456781V', '0771234569', 'default/user.png', 0, '2024-09-13 19:57:37'),
(10, 'William Anderson', 'user10@vms.lk', '5f4dcc3b5aa765d61d8327deb882cf99', '707 Palm St', '123456780V', '0771234570', 'default/user.png', 0, '2024-09-13 19:57:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `orgID` (`orgID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`orgID`),
  ADD UNIQUE KEY `userEmail` (`orgEmail`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`userID`,`eventID`),
  ADD KEY `fk_participation_event` (`eventID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `orgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_organization` FOREIGN KEY (`orgID`) REFERENCES `organization` (`orgID`) ON DELETE CASCADE;

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `fk_participation_event` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
