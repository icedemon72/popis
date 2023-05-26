-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 10:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `popis`
--

-- --------------------------------------------------------

--
-- Table structure for table `administratori`
--

CREATE TABLE `administratori` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `lozinka` varchar(255) DEFAULT NULL,
  `glavni` smallint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administratori`
--

INSERT INTO `administratori` (`id`, `ime`, `email`, `lozinka`, `glavni`) VALUES
(1, 'admin', '', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `popisani`
--

CREATE TABLE `popisani` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `grad` varchar(255) NOT NULL,
  `opstina` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `objekat` varchar(255) NOT NULL,
  `povrsina` float NOT NULL,
  `broj_clanova` int(11) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `starost` int(11) NOT NULL,
  `strucna_sprema` varchar(255) DEFAULT NULL,
  `posao` varchar(255) DEFAULT NULL,
  `bracni_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `popisani`
--

INSERT INTO `popisani` (`id`, `ime`, `grad`, `opstina`, `adresa`, `objekat`, `povrsina`, `broj_clanova`, `datum_rodjenja`, `starost`, `strucna_sprema`, `posao`, `bracni_status`) VALUES
(1, 'Marko Marković', 'Leposavić', 'Leposavić', 'Oslobodjenja BB', 'Kuća', 85, 3, '2002-02-10', 21, 'Elektrotehničar Energetike', 'Nezaposlen', 'Razveden/a'),
(4, 'Marinko Marinkovic', 'Kosovska Mitrovica', 'Kosovska Mitrovica', 'Kralja Petra I, 27/2', 'Stan', 75, 5, '2003-05-10', 20, 'Diplomirani matematičar', 'Nezaposlen', 'U bračnom je odnosu'),
(5, 'Marko Marković', 'Leposavić', 'Leposavić', 'BB', 'Kuća', 100, 2, '2010-06-07', 12, '-', 'Učenik/Student', 'Nije u bračnom odnosu'),
(6, 'Mirko Mirković', 'Sočanica', 'Leposavić', 'BB', 'Kuća', 65, 3, '2001-10-05', 21, 'Mašinac', 'Zaposlen', 'Nije u bračnom odnosu'),
(7, 'Jovan Jovanović', 'Zvečan', 'Zvečan', 'Kralja Petra I', 'Stan', 65, 2, '1965-02-10', 58, 'Diplomirani Elektrotehničar', 'Zaposlen', 'U bračnom je odnosu'),
(8, 'Aleksa Aleksić', 'Grabovac', 'Zvečan', 'BB', 'Kuća', 120, 5, '1985-02-05', 38, 'Tehničar drumskog saobraćaja', 'Zaposlen', 'U bračnom je odnosu'),
(9, 'Dejan Dejanović', 'Kosovska Mitrovica', 'Kosovska Mitrovica', 'Nemanjina 20', 'Kuća', 85, 4, '2000-09-03', 22, 'Tehničar drumskog saobraćaja', 'Učenik/Student', 'Nije u bračnom odnosu'),
(10, 'Marija Marijanović', 'Zupče', 'Zubin Potok', 'BB', 'Kuća', 79, 4, '2003-03-05', 20, 'Ekonomski tehničar', 'Učenik/Student', 'Nije u bračnom odnosu'),
(11, 'Marta Martović', 'Zubin Potok', 'Zubin Potok', 'BB', 'Kuća', 100, 2, '1989-12-01', 33, 'Diplomirani ekonomista', 'Zaposlen', 'U bračnom je odnosu'),
(12, 'Petar Petrović', 'Kosovska Mitrovica', 'Kosovska Mitrovica', 'Džona Kenedija, 18', 'Stan', 75, 3, '2008-03-31', 15, '-', 'Učenik/Student', 'Nije u bračnom odnosu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratori`
--
ALTER TABLE `administratori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ime` (`ime`);

--
-- Indexes for table `popisani`
--
ALTER TABLE `popisani`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administratori`
--
ALTER TABLE `administratori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `popisani`
--
ALTER TABLE `popisani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
