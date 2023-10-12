-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Paź 12, 2023 at 12:45 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notepad`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `usernotes`
--

CREATE TABLE `usernotes` (
  `NoteID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usernotes`
--

INSERT INTO `usernotes` (`NoteID`, `UserID`, `Content`, `CreationDate`) VALUES
(1, 1, '', '2023-10-11 22:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePicture` varchar(255) NOT NULL DEFAULT 'user_photo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `ProfilePicture`) VALUES
(1, 'root', 'root', 'root@root.pl', '$2y$10$NEGluAjb4VIEIUZp/JQ8jOKMkxBGboVJ5.XLLNkyOkfwHP6gvmG5q', 'root6527cd71b6de70.43839246.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userstatistics`
--

CREATE TABLE `userstatistics` (
  `UserID` int(11) NOT NULL,
  `TotalLogins` int(11) DEFAULT NULL,
  `TotalNotes` int(11) DEFAULT NULL,
  `DaysRow` int(11) DEFAULT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userstatistics`
--

INSERT INTO `userstatistics` (`UserID`, `TotalLogins`, `TotalNotes`, `DaysRow`, `LastLogin`) VALUES
(1, 1, 0, 0, '2023-10-12 10:42:02');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `usernotes`
--
ALTER TABLE `usernotes`
  ADD PRIMARY KEY (`NoteID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indeksy dla tabeli `userstatistics`
--
ALTER TABLE `userstatistics`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usernotes`
--
ALTER TABLE `usernotes`
  MODIFY `NoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usernotes`
--
ALTER TABLE `usernotes`
  ADD CONSTRAINT `usernotes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `userstatistics`
--
ALTER TABLE `userstatistics`
  ADD CONSTRAINT `userstatistics_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
