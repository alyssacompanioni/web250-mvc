-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 19, 2025 at 10:29 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salamander`
--

-- --------------------------------------------------------

--
-- Table structure for table `salamanders`
--

CREATE TABLE `salamanders` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `habitat` text,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `salamanders`
--

INSERT INTO `salamanders` (`id`, `name`, `habitat`, `description`) VALUES
(1, 'Southern Red-Backed', 'The southern red-backed salamander occurs in a small area in western North Carolina. These rare salamanders may be found in wooded areas near springs or cave mouths. They also inhabit rocky areas with deep, cool crevices.', 'There are two distinct color morphs of the southern red-backed salamander. The striped morph has a dark grey or brown base color with an orange or red stripe stretching from the head to the end of the tail.'),
(2, 'Southern Zig Zag', 'The southern zigzag salamander occurs in a small area in western North Carolina. These rare salamanders may be found in wooded areas near springs or cave mouths. They also inhabit rocky areas with deep, cool crevices.', 'Coloration of the body is dark grey with a wavy or jagged “zigzag” stripe down the back. This stripe is yellow to red in color.'),
(3, 'Pigeon Mountain Salamander', 'These species are very common in the Blue Ridge Mountains of western North Carolina. Ocoee salamanders are found in southwestern North Carolina and are separated from the Carolina mountain dusky salamander by the Pigeon River.', 'These species were formerly considered to be a single species, Desmognathus ochrophaeus. All exhibit highly variable coloration and are best separated from one another by location.'),
(4, 'Slimy Salamander', 'Slimy salamanders are entirely terrestrial. In North Carolina, they are most abundant in moist forest floor habitats in deciduous forests but may be found in pine forests, bottomland hardwood forests, and caves.', 'The slimy salamander was formerly considered a single species but has since been divided into a complex of closely related species.'),
(5, 'Green Salamander', 'Green salamanders inhabit moist, shady crevices in cliffs and rock faces. In North Carolina, the green salamander is found only in a small mountainous region in the southwestern corner of the state.', 'The green salamander has an unmistakable lichen-like pattern of green or yellow-green on a dark background. This salamander is laterally flattened and has squared toe tips.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salamanders`
--
ALTER TABLE `salamanders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salamanders`
--
ALTER TABLE `salamanders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
