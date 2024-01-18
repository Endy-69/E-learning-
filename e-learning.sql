-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 06:32 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `sex` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `middlename`, `lastname`, `email`, `sex`) VALUES
(1, 'berhan', 'gashaw', 'yigizaw', 'berhan.216@gmail.com', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `assignno` int(11) NOT NULL,
  `assigntype` varchar(30) NOT NULL,
  `studentid` varchar(30) NOT NULL,
  `coursecode` varchar(50) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `filetype` varchar(500) NOT NULL,
  `deadline` date NOT NULL,
  `submissiondate` date NOT NULL,
  `section` int(11) NOT NULL,
  `description` text NOT NULL,
  `instructorid` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `assignno`, `assigntype`, `studentid`, `coursecode`, `filename`, `filetype`, `deadline`, `submissiondate`, `section`, `description`, `instructorid`, `status`) VALUES
(92, 1, 'Individual', '', 'data1', '2 software testing life cycle.pdf', 'application/pdf', '2023-06-12', '0000-00-00', 1, 'BSC   ABEBE   KEN  do it', 'ins17290', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ca`
--

CREATE TABLE `ca` (
  `capacityid` int(11) NOT NULL,
  `coursecode_capacity_ch` int(11) NOT NULL,
  `coursecode_capacity_etc` int(11) NOT NULL,
  `instructor_capacity_bsc` int(11) NOT NULL,
  `instructor_capacity_msc` int(11) NOT NULL,
  `instructor_capacity_phd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ca`
--

INSERT INTO `ca` (`capacityid`, `coursecode_capacity_ch`, `coursecode_capacity_etc`, `instructor_capacity_bsc`, `instructor_capacity_msc`, `instructor_capacity_phd`) VALUES
(1, 7, 12, 9, 12, 14);

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `calendarid` int(11) NOT NULL,
  `departmentid` varchar(20) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `filetype` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`calendarid`, `departmentid`, `filename`, `filetype`, `date`, `description`, `status`) VALUES
(82, 'dept01', 'chapter 1 - introduction - software architecture.pdf', '', '2023-06-09', 'read it', 0),
(83, 'dept03', '4 software testing techniques.pdf', 'application/pdf', '2023-06-10', 'rrrrr', 0),
(84, 'dept03', '4 software testing techniques.pdf', 'application/pdf', '2023-06-10', 'rrrrr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `coursecode` varchar(50) NOT NULL,
  `coursename` varchar(50) NOT NULL,
  `credithour` int(11) NOT NULL,
  `departmentid` varchar(20) NOT NULL,
  `year` varchar(4) NOT NULL,
  `semister` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`coursecode`, `coursename`, `credithour`, `departmentid`, `year`, `semister`) VALUES
('algo1', 'algorithm', 4, 'dept03', 'I', 'I'),
('bio1', 'blood cell', 3, 'dept02', 'I', 'I'),
('data1', 'data mining', 2, 'dept03', 'V', '..se'),
('eco1', 'economics', 2, 'dept01', 'V', 'II'),
('eco2', 'economics', 6, 'dept01', 'III', 'II'),
('mg1', 'management', 4, 'dept01', 'V', 'II'),
('soft1', 'software engineering', 2, 'dept03', 'I', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `courseinstructor`
--

CREATE TABLE `courseinstructor` (
  `id` int(11) NOT NULL,
  `coursecode` varchar(50) NOT NULL,
  `instructorid` varchar(30) NOT NULL,
  `section` int(11) NOT NULL,
  `credithour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseinstructor`
--

INSERT INTO `courseinstructor` (`id`, `coursecode`, `instructorid`, `section`, `credithour`) VALUES
(57, 'data1', 'ins3662', 1, 2),
(58, 'data1', 'ins17290', 1, 2),
(59, 'algo1', 'ins26844', 1, 4),
(60, 'soft1', 'ins46526', 1, 2),
(61, 'soft1', 'ins22511', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `coursematerial`
--

CREATE TABLE `coursematerial` (
  `cmid` int(11) NOT NULL,
  `coursecode` varchar(50) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `filetype` varchar(500) NOT NULL,
  `uploaddate` date NOT NULL,
  `section` int(11) NOT NULL,
  `description` text NOT NULL,
  `instructorid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursematerial`
--

INSERT INTO `coursematerial` (`cmid`, `coursecode`, `filename`, `filetype`, `uploaddate`, `section`, `description`, `instructorid`) VALUES
(69, 'data1', 'ml_cha_3_data and data preprocessing (1) (2).pdf', 'application/pdf', '2023-06-10', 1, 'BSC   ABEBE   KEN  read it', 'ins17290'),
(70, 'data1', 'chapter 1 - introduction - software architecture.pdf', '', '2023-06-10', 1, 'BSC   ABEBE   KEN  rr', 'ins17290'),
(71, 'data1', 'chapter 1 - introduction - software architecture.pdf', '', '2023-06-10', 1, 'BSC   ABEBE   KEN  rr', 'ins17290');

-- --------------------------------------------------------

--
-- Table structure for table `coursestudent`
--

CREATE TABLE `coursestudent` (
  `id` int(11) NOT NULL,
  `coursecode` varchar(30) NOT NULL,
  `studentid` varchar(30) NOT NULL,
  `assign1` varchar(10) NOT NULL,
  `assign2` varchar(10) NOT NULL,
  `quizz` varchar(10) NOT NULL,
  `test1` varchar(10) NOT NULL,
  `test2` varchar(10) NOT NULL,
  `test3` varchar(10) NOT NULL,
  `final_exam` varchar(10) NOT NULL,
  `total` varchar(10) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentid` varchar(20) NOT NULL,
  `departmentname` varchar(50) NOT NULL,
  `faculity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentid`, `departmentname`, `faculity`) VALUES
('dept01', 'accounting', 'fb'),
('dept02', 'biology', 'health'),
('dept03', 'computer science', 'Tecnology');

-- --------------------------------------------------------

--
-- Table structure for table `departmenthead`
--

CREATE TABLE `departmenthead` (
  `departmentheadid` varchar(30) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `sex` varchar(8) NOT NULL,
  `departmentid` varchar(20) NOT NULL,
  `profile` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departmenthead`
--

INSERT INTO `departmenthead` (`departmentheadid`, `firstname`, `middlename`, `lastname`, `email`, `sex`, `departmentid`, `profile`) VALUES
('head76162', 'moges', 'mm', 'mmm', 'moges@gmail.com', 'M', 'dept03', '');

-- --------------------------------------------------------

--
-- Table structure for table `examlist`
--

CREATE TABLE `examlist` (
  `exam_id` int(11) NOT NULL,
  `coursecode` varchar(30) NOT NULL,
  `coursename` varchar(50) NOT NULL,
  `duration` time NOT NULL,
  `status` varchar(10) NOT NULL,
  `instructorid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examlist`
--

INSERT INTO `examlist` (`exam_id`, `coursecode`, `coursename`, `duration`, `status`, `instructorid`) VALUES
(7725, 'data1', 'data mining', '00:45:00', 'active', 'ins17290');

-- --------------------------------------------------------

--
-- Table structure for table `examresult`
--

CREATE TABLE `examresult` (
  `exam_result_id` int(11) NOT NULL,
  `studentid` varchar(30) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `result` float NOT NULL,
  `correct` int(11) NOT NULL,
  `incorrect` int(11) NOT NULL,
  `date` date NOT NULL,
  `videorecord` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `here`
--

CREATE TABLE `here` (
  `id` int(11) NOT NULL,
  `coursecode` varchar(50) NOT NULL,
  `instructorid` varchar(30) NOT NULL,
  `studentid` varchar(30) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructorid` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `sex` varchar(8) NOT NULL,
  `status` varchar(30) NOT NULL,
  `departmentid` varchar(20) NOT NULL,
  `profile` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructorid`, `firstname`, `middlename`, `lastname`, `email`, `sex`, `status`, `departmentid`, `profile`) VALUES
('ins17290', 'ABEBE', 'KENDIE', 'KEN', 'ABEBE@GMAIL.COM', 'F', 'BSC', 'dept03', ''),
('ins22511', 'BERHAN', 'YIGZAW', 'GASHAW', 'BERHANGASHAW@GMAIL.COM', 'M', 'BSC', 'dept03', ''),
('ins24298', 'ALEMITU', 'GASHAW', 'YIGIZAW', 'ALEMITU@GMAIL.COM', 'F', 'MSC', 'dept02', ''),
('ins26844', 'AMELACU', 'GETIE', 'GET', '', 'M', 'BSC', 'dept03', ''),
('ins31421', 'BBB', 'BBBB', 'BBBBB', 'BBB@GMAIL.COM', 'M', 'BSC', 'dept02', ''),
('ins3662', 'MOGES', 'MM', 'MMM', 'MOGES', 'M', 'BSC', 'dept03', ''),
('ins44780', 'CHALACHEW ', 'SNTIE', 'CHALE', 'CHALACHEW@GMAIL.COM', 'M', 'MSC', 'dept01', ''),
('ins46526', 'ALEMU', 'ABEBE', 'YIGIZAW', 'ALEMU@GMAIL.COM', 'M', 'BSC', 'dept03', '');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `departmentid` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(500) NOT NULL,
  `filetype` varchar(500) NOT NULL,
  `filesize` decimal(10,0) NOT NULL,
  `created` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `year`, `departmentid`, `description`, `filename`, `filetype`, `filesize`, `created`, `status`) VALUES
(69, 'I', 'dept03', 'look', 'state of art.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '140', '2023-06-09', 0),
(70, 'III', 'dept03', 'read', 'chapter 1 - introduction - software architecture.pdf', '', '0', '2023-06-10', 0),
(71, 'I', 'dept03', 'read this', '4 software testing techniques.pdf', 'application/pdf', '948', '2023-06-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `registrarid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `sex` varchar(8) NOT NULL,
  `profile` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrar`
--

INSERT INTO `registrar` (`registrarid`, `firstname`, `middlename`, `lastname`, `email`, `sex`, `profile`) VALUES
(1, 'mulugeta', 'awoke', 'alamire', 'mulugeta@gmail.com', 'm', '');

-- --------------------------------------------------------

--
-- Table structure for table `resultrecovery`
--

CREATE TABLE `resultrecovery` (
  `recovery_id` int(11) NOT NULL,
  `testid` int(11) NOT NULL,
  `studentid` varchar(30) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `result` float NOT NULL,
  `correct` int(11) NOT NULL,
  `incorrect` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `email` varchar(70) NOT NULL,
  `year` varchar(2) NOT NULL,
  `semister` varchar(2) NOT NULL,
  `departmentid` varchar(20) NOT NULL,
  `section` int(11) NOT NULL,
  `profile` varchar(50) NOT NULL,
  `enroll` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `firstname`, `middlename`, `lastname`, `sex`, `email`, `year`, `semister`, `departmentid`, `section`, `profile`, `enroll`, `status`) VALUES
('stud28276', 'AGERIE', 'HONELIGN', 'HON', 'F', 'AGERIE@GMAIL.COM', 'I', 'I', 'dept03', 0, '', 'regular', 0),
('stud28444', 'SELAMAWIT ', 'TESFAW', 'TES', 'F', 'SELAMAWIT@GMAIL.COM', 'V', 'II', 'dept01', 0, '', 'extension', 0),
('stud33812', 'ALEMU', 'ABEBE', 'ABE', 'M', 'ALEMU@GMAIL.COM', 'IV', 'I', 'dept01', 0, '', 'extension', 0),
('stud42335', 'BERHAN', 'GASHAW', 'YIGIZAW', 'M', 'BERHANGASHAW.216@GMAIL.COM', 'II', 'II', 'dept03', 0, '', 'extension', 0),
('stud47709', 'AAA', 'AAAA', 'AAAAA', 'M', 'AAA@GMAIL.COM', 'I', 'I', 'dept02', 0, '', 'regular', 0);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `number` int(11) NOT NULL,
  `testid` int(11) NOT NULL,
  `question` text NOT NULL,
  `a` varchar(500) NOT NULL,
  `b` varchar(500) NOT NULL,
  `c` varchar(500) NOT NULL,
  `d` varchar(500) NOT NULL,
  `answer` varchar(1) NOT NULL,
  `mark` float NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`number`, `testid`, `question`, `a`, `b`, `c`, `d`, `answer`, `mark`, `exam_id`) VALUES
(48, 1, 'what is your name?', 'aaa', 'berhan', 'ccc', 'ddd', 'B', 10, 7725),
(49, 2, 'are you fine?', 'yes ', 'no ', 'else', 'none of the above', 'A', 5, 7725);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `conformation_code` varchar(20) NOT NULL,
  `adminid` int(11) NOT NULL,
  `studentid` varchar(30) NOT NULL,
  `instructorid` varchar(30) NOT NULL,
  `departmentheadid` varchar(30) NOT NULL,
  `registrarid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `usertype` varchar(40) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`conformation_code`, `adminid`, `studentid`, `instructorid`, `departmentheadid`, `registrarid`, `username`, `password`, `usertype`, `status`) VALUES
('11685', 0, '', 'ins44780', '', 0, 'chalie', 'dded425de94663d10907197eb06a99dd', 'Instructor', 'on'),
('3423', 0, '', '', '', 0, 'bera', 'c95931f8f6f03e68a88cd48f8dd13730', 'Student', 'on'),
('39565', 0, '', '', '', 0, 'berhan', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'on'),
('50327', 0, '', '', 'head76162', 0, 'moges', 'b13ec27d3d8263db358bbbd5b52cd1f1', 'Department head', 'on'),
('50644', 0, '', 'ins22511', '', 0, 'bersh', '7e17964069e878fb502babe91eadc864', 'Instructor', 'off'),
('5618', 0, '', 'ins17290', '', 0, 'abebe', '597c0ffd2d6c443622066f6635b705e8', 'Instructor', 'on'),
('63245', 0, '', '', '', 2, 'mulugeta', '33c0ee425e2c0efe834afc1aa1e33a4c', 'Registrar', 'on'),
('65206', 0, '', '', '', 0, 'selam', 'dc16c90a80b51c6df700322ad04cd596', 'Student', 'on'),
('65662', 0, '', '', '', 0, 'agerie', '0bd7b7be6eb8d8e94326398742bfffb0', 'Student', 'on'),
('75911', 0, '', 'ins46526', '', 0, 'alemu', '2afba4aea0875725747d7d9794e68271', 'Instructor', 'on'),
('92669', 0, '', 'ins31421', '', 0, 'bbb', '810247419084c82d03809fc886fedaad', 'Instructor', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `video` blob NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coursecode` (`coursecode`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `coursecode_2` (`coursecode`),
  ADD KEY `section` (`section`),
  ADD KEY `instructorid` (`instructorid`),
  ADD KEY `studentid_2` (`studentid`),
  ADD KEY `instructorid_2` (`instructorid`),
  ADD KEY `studentid_3` (`studentid`);

--
-- Indexes for table `ca`
--
ALTER TABLE `ca`
  ADD PRIMARY KEY (`capacityid`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`calendarid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`coursecode`),
  ADD UNIQUE KEY `coursecode` (`coursecode`),
  ADD KEY `department` (`departmentid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `courseinstructor`
--
ALTER TABLE `courseinstructor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coursecode` (`coursecode`),
  ADD KEY `instructorid` (`instructorid`),
  ADD KEY `coursecode_2` (`coursecode`);

--
-- Indexes for table `coursematerial`
--
ALTER TABLE `coursematerial`
  ADD PRIMARY KEY (`cmid`),
  ADD KEY `coursecode` (`coursecode`),
  ADD KEY `coursecode_2` (`coursecode`),
  ADD KEY `instructorid` (`instructorid`);

--
-- Indexes for table `coursestudent`
--
ALTER TABLE `coursestudent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coursecode` (`coursecode`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `studentid_2` (`studentid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentid`),
  ADD UNIQUE KEY `departmentcode` (`departmentname`);

--
-- Indexes for table `departmenthead`
--
ALTER TABLE `departmenthead`
  ADD PRIMARY KEY (`departmentheadid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department` (`departmentid`),
  ADD KEY `department_2` (`departmentid`),
  ADD KEY `department_3` (`departmentid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `examlist`
--
ALTER TABLE `examlist`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `coursecode` (`coursecode`),
  ADD KEY `instructorid` (`instructorid`),
  ADD KEY `instructorid_2` (`instructorid`);

--
-- Indexes for table `examresult`
--
ALTER TABLE `examresult`
  ADD PRIMARY KEY (`exam_result_id`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `studentid_2` (`studentid`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `here`
--
ALTER TABLE `here`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coursecode` (`coursecode`),
  ADD KEY `coursecode_2` (`coursecode`),
  ADD KEY `instructorid` (`instructorid`),
  ADD KEY `studentid` (`studentid`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructorid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department` (`departmentid`),
  ADD KEY `department_2` (`departmentid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `registrar`
--
ALTER TABLE `registrar`
  ADD PRIMARY KEY (`registrarid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `resultrecovery`
--
ALTER TABLE `resultrecovery`
  ADD PRIMARY KEY (`recovery_id`),
  ADD KEY `testid` (`testid`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `studentid_2` (`studentid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`number`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`conformation_code`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `instructorid` (`instructorid`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `departmentheadid` (`departmentheadid`),
  ADD KEY `registrarid` (`registrarid`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `studentid_2` (`studentid`),
  ADD KEY `registrarid_2` (`registrarid`),
  ADD KEY `departmentheadid_2` (`departmentheadid`),
  ADD KEY `instructorid_2` (`instructorid`),
  ADD KEY `studentid_3` (`studentid`),
  ADD KEY `studentid_4` (`studentid`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `ca`
--
ALTER TABLE `ca`
  MODIFY `capacityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `calendarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courseinstructor`
--
ALTER TABLE `courseinstructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `coursematerial`
--
ALTER TABLE `coursematerial`
  MODIFY `cmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `coursestudent`
--
ALTER TABLE `coursestudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `examlist`
--
ALTER TABLE `examlist`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9110;

--
-- AUTO_INCREMENT for table `examresult`
--
ALTER TABLE `examresult`
  MODIFY `exam_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `here`
--
ALTER TABLE `here`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `registrar`
--
ALTER TABLE `registrar`
  MODIFY `registrarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resultrecovery`
--
ALTER TABLE `resultrecovery`
  MODIFY `recovery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `user` (`adminid`);

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`coursecode`) REFERENCES `course` (`coursecode`);

--
-- Constraints for table `courseinstructor`
--
ALTER TABLE `courseinstructor`
  ADD CONSTRAINT `courseinstructor_ibfk_1` FOREIGN KEY (`coursecode`) REFERENCES `course` (`coursecode`),
  ADD CONSTRAINT `courseinstructor_ibfk_2` FOREIGN KEY (`instructorid`) REFERENCES `instructor` (`instructorid`);

--
-- Constraints for table `coursematerial`
--
ALTER TABLE `coursematerial`
  ADD CONSTRAINT `coursematerial_ibfk_1` FOREIGN KEY (`instructorid`) REFERENCES `instructor` (`instructorid`),
  ADD CONSTRAINT `coursematerial_ibfk_2` FOREIGN KEY (`coursecode`) REFERENCES `course` (`coursecode`);

--
-- Constraints for table `coursestudent`
--
ALTER TABLE `coursestudent`
  ADD CONSTRAINT `coursestudent_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`);

--
-- Constraints for table `departmenthead`
--
ALTER TABLE `departmenthead`
  ADD CONSTRAINT `departmenthead_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`departmentid`);

--
-- Constraints for table `examlist`
--
ALTER TABLE `examlist`
  ADD CONSTRAINT `examlist_ibfk_1` FOREIGN KEY (`coursecode`) REFERENCES `course` (`coursecode`),
  ADD CONSTRAINT `examlist_ibfk_2` FOREIGN KEY (`instructorid`) REFERENCES `instructor` (`instructorid`);

--
-- Constraints for table `examresult`
--
ALTER TABLE `examresult`
  ADD CONSTRAINT `examresult_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
  ADD CONSTRAINT `examresult_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `examlist` (`exam_id`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`departmentid`);

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`departmentid`);

--
-- Constraints for table `resultrecovery`
--
ALTER TABLE `resultrecovery`
  ADD CONSTRAINT `resultrecovery_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
  ADD CONSTRAINT `resultrecovery_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `examlist` (`exam_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`departmentid`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `examlist` (`exam_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
