-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 04:29 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ftps_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `khowledge_items`
--

CREATE TABLE `khowledge_items` (
  `id` int(11) NOT NULL,
  `study_place_id` int(11) DEFAULT NULL,
  `title` varchar(350) DEFAULT NULL,
  `desc` text,
  `images` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khowledge_items`
--

INSERT INTO `khowledge_items` (`id`, `study_place_id`, `title`, `desc`, `images`) VALUES
(6, 24, 'น้ำสมุนไพร', '-', 'knowledge-6.jpg'),
(7, 6, 'กล้วยฉาบ', 'กลุ่มวิสาหกิจชุมชน ทำกล้วยไข่กรอบแก้วที่มีชื่อเสียง วิทยากรถ่ายทอดความรู้เกี่ยวกับวิธีการทำกล้วยไข่กรอบแก้วและสาธิตให้นักศึกษาได้เห็นขั้นตอนการทำทุกขั้นตอน', 'knowledge-7.jpg'),
(11, 13, 'ตลาดน้ำ', 'ลองแดน สามคลอง สองเมือง กันก่อน โดยลำคลอง 3 สาย ซึ่งเป็นที่ตั้งของชุมชนคลองแดน ตั้งแต่อดีตจนถึงปัจจุบัน ประกอบด้วยลำคลอง 3 สาย ได้แก่ คลองระโนด คลองชะอวด และคลองปากพนัง เชื่อมต่อบรรจบกัน ณ จุดนี้ เป็นเส้นแบ่งเขตแดน 2 จังหวัด คือ ตำบลคลองแดน อำเภอระโนด จังหวัดสงขลา กับตำบลรามแก้ว อำเภอหัวไทร จังหวัดนครศรีธรรมราช และนี้ก็คือที่มาของตลาดริมน้ำคลองแดน “สามคลอง สองจังหวัด” …(สงขลา-นครศรีฯ)', 'knowledge-11.jpg'),
(12, 13, 'มวยทะเล', 'ลูกหลานชาวคลองแดน อบรมมัคคุเทศน์น้อย อีกไม่นานจะเป็นมัคคุเทศน์อาสาบริการนักท่องเที่ยวฟรีครับ', 'knowledge-12.jpg'),
(14, 12, 'ตลาด', 'ตลาดป่าไผ่ เป็นตลาดแนวใหม่ อนุรักษ์ธรรมชาติ โอบล้อมไปด้วยต้นไผ่และมีพื้นที่ ที่กว้างขวางกว่า 30 ไร่ เหมาะสำหรับดูงานด้านเกษตรเชิงท่องเที่ยว และด้านเศรษฐศาสตร์เกษตร', 'knowledge-14.jpg'),
(17, 32, 'สวนครูนอง', '-', 'knowledge-17.jpg'),
(18, 23, 'โฮมสเตย์', '-', 'knowledge-18.jpg'),
(20, 20, 'ปลูกข้าว', '-', 'knowledge-20.jpg'),
(21, 5, 'สถานีพัฒนาที่ดิน', 'การพัฒนาที่ดิน สวนเกษตรผสมผสาน การทำน้ำหมักชีวภาพ ', 'knowledge-21.jpg'),
(22, 13, 'โฮมสเตย์', '-', 'none-images.png'),
(23, 4, 'สวนสละ', 'สวนสละ เกษตรผสมผสาน สามารถจัดกิจกรรมเรียนรู้ แข่งขันกิน ปอกสละ อย่างถูกวิธี ค่าใช้จ่ายในการจัดกิจกรรมคิดเป็นรายบุคคล คนละ 80 บาท', 'knowledge-23.jpg'),
(24, 7, 'เห็ดทอดนาโหนด', 'ฟาร์มเห็ด และผลิตภัณฑ์เห็ดทอด ', 'knowledge-24.jpg'),
(25, 8, 'สถาบันการเงินชุมชน', 'สถาบันการเงินชุมชน องค์กรหมู่บ้าน สถาบันเกษตรกร', 'knowledge-25.JPG'),
(26, 9, 'วิสาหกิจชุมชน', 'เป็นวิสาหกิจชุมชนเข้มแข็ง รวบรวมผลผลิตของเกษตรกร ให้บริการด้านการเงิน สินเชื่อแก่สมาชิกในกลุ่ม', 'knowledge-26.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `khowledge_items`
--
ALTER TABLE `khowledge_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `khowledge_items`
--
ALTER TABLE `khowledge_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
