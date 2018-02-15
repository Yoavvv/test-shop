-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2017 at 02:24 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(3) NOT NULL,
  `category_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Sport'),
(33, 'Business'),
(34, 'Nature'),
(35, 'Computers'),
(36, 'Psychology'),
(37, 'Education'),
(38, 'Animals');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_course_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_course_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(37, 240, 'Messi', 'messi@gmail.com', 'The best course ever!!!', 'approved', '2017-05-15'),
(38, 241, 'Lebrone James', 'lb@gmail.com', 'Lovely pic :) !!!', 'approved', '2017-05-15'),
(39, 242, 'Dana simpson', 'dana@gmail.com', 'Waste of time!! learned sh*t!!', 'approved', '2017-05-15'),
(40, 243, 'asaf', 'as@gmail.com', 'Didn\'t find my goals from this course...', 'approved', '2017-05-15'),
(42, 245, 'מתן', 'mato@gmail.com', 'איזה כיף הקורס הזה', 'approved', '2017-05-15'),
(43, 246, 'ולאדימיר פוטין', 'vlad@gmail.com', 'למה אין דוגמאות לציד \r\nאיזה מעצבן', 'approved', '2017-05-15'),
(44, 240, 'מוישה אופניק', 'garbage@gmail.com', 'החיים בזבל', 'approved', '2017-05-15'),
(45, 241, 'Kevin durant', 'kevin@gmail.com', 'I LOVE THIS GAME!!!!!!', 'approved', '2017-05-15'),
(46, 243, 'Aristotle', 'aristo@gmail.com', 'I\'ME HERE MAN!!', 'approved', '2017-05-15'),
(47, 244, 'GULUM', 'gul@gmail.com', 'making money?! try losing your house maybe....', 'approved', '2017-05-15'),
(48, 246, 'Ukranian guy', 'ukr@gmail.com', 'Where is putin? i\'ll kill him!!', 'approved', '2017-05-15'),
(49, 244, 'money', 'mo@gmail.com', 'money money money must be...', 'approved', '2017-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(3) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text NOT NULL,
  `image_fileName` varchar(255) NOT NULL,
  `course_tags` varchar(255) NOT NULL,
  `course_category_id` int(3) NOT NULL,
  `course_comment_count` int(3) NOT NULL,
  `course_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `image_fileName`, `course_tags`, `course_category_id`, `course_comment_count`, `course_views_count`) VALUES
(240, 'Soccer basics', '<p>Learn how to be a&nbsp;<strong>PRO&nbsp;</strong>soccer player with 30 hrs of fun lessons!!</p>', 'soccer.jpg', 'Soccer, Sport, Fun', 1, 0, 8),
(241, 'Bascketball basics', '<p>Learn to be a<strong> PRO</strong> by study everything about bascketball<strong>!!!</strong></p>', 'basketball.jpg', 'Bascketball, Sport, Fun', 1, 0, 8),
(242, 'אילוף כלבים', '<p>למד איך להיות מאלף כלבים מקצועי בחווה <strong>ענקית</strong> בדרום הארץ</p>', 'dog-training.jpg', 'כלב, חיות, אילוף, training', 38, 0, 6),
(243, 'History', '<p>Know everything about world history!!!</p>', 'history.jpg', 'History, Education, Aristo', 37, 0, 7),
(244, 'Finance', '<p>Learn to make money with <strong>trading</strong> on the stock market :)</p>', 'stock.jpg', 'Money, Market, Trading, Finance, Buisness', 33, 0, 8),
(245, 'Fullstack Web Developer', '<p>Learn to be pro <strong>web</strong> developer!!!</p>', 'fullstack1.png', 'Computers, Web-developing, Money', 35, 0, 5),
(246, 'Camping', '<p>Learn to build &amp; manipulate <strong>great</strong> <strong>camping</strong> gear!!</p>', 'camping.jpg', 'Camping, Fun', 34, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_phone` int(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_phone`, `user_email`, `user_password`, `user_role`, `user_image`, `user_course_name`) VALUES
(448, 'Asaf', 'Fink', 549988776, 'asaf@gmail.com', '$2y$12$9smWkiFdm1RicvPxrYDI1elNaqBRvkVl3cZBpKyYauG7C/htvszL2', 'manager', 'Assaf_Finkelshtein.jpg', ''),
(449, 'Andre', 'Fischer', 547483456, 'andre@gmail.com', '$2y$10$8VmFLC5vzOrxB2xoaKZCS.kaAys3.wfZr3hUjv6VFgiJZpq4d3YKO', 'student', 'donald-duck.jpg', 'אילוף כלבים , <br />Fullstack Web Developer , <br />Camping'),
(450, 'Matan', 'Ben Shushan', 575436789, 'matan@gmail.com', '$2y$10$gmvsTLWYJdBPnWrXeqhMh.CsQDI1pZr8uBBGUfMEeqaMBkFV2oyNS', 'student', 'mickey_m.jpg', 'Soccer basics , <br />Bascketball basics , <br />אילוף כלבים , <br />Fullstack Web Developer , <br />Camping'),
(451, 'אורן', 'ליקוביץ', 46754543, 'oren@gmail.com', '$2y$10$jLl9enzV4RWV4m8mACDl8uNIeS.s.GcrMSvugKDxVn1c37RBUeejW', 'student', 'pigy.jpg', 'Soccer basics , <br />אילוף כלבים'),
(452, 'שגיב', 'ראדה', 352765434, 'sagiv@gmail.com', '$2y$10$yiIwkf8d4xXwG4TgaTRVMeAOjgjVzHUZflZlIhev0q1euZm3VhIVW', 'student', 'rabit.jpg', 'Fullstack Web Developer'),
(453, 'Lior', 'Harush', 32584389, 'lior@gmail.com', '$2y$10$3N1ZkEu0GwHfAe3O7wO5wOYKtzSVZh2dBOf.DqtfI.M/5ZOFcEwPW', 'student', 'stewi.jpg', 'Soccer basics , <br />History , <br />Finance , <br />Camping'),
(454, 'חיים', 'טופול', 463276945, 'chaim@gmail.com', '$2y$10$eXXcClgY7SxDh72vkc9Mo.vbX33zigQX3wDEabffiq/sRB3wZNlte', 'student', 'ugi.jpeg', 'Bascketball basics , <br />אילוף כלבים , <br />History'),
(455, 'Vladimir', 'Putin', 43289132, 'putin@gmail.com', '$2y$10$Nrp1uLkT0a50jTMJYxDZu.cdzw5hhCazmnV42cw95X.ngkGMkyxNm', 'student', 'bart.jpeg', 'History , <br />Finance , <br />Camping'),
(456, 'משה', 'פלטקוב', 124832423, 'moshe@gmail.com', '$2y$10$mn224F6O6ZLp6wr9NIZeaeeWy4hGg/t287I09T3UvUz3zImyqwFBC', 'manager', 'DJ-Khaled.jpg', ''),
(457, 'God', 'All Mighty', 99999999, 'god@gmail.com', '$2y$10$Fpd1hQWUUExL6q1hx0l6d.BZ2SQl1i4nFOfMi.gCcijf8VqJRJOTO', 'manager', 'god.jpg', ''),
(458, 'חתוליהו', 'מייאווו', 2147483647, 'cat@gmail.com', '$2y$10$Ac/HEDSnULXeG6QuuPoGde3607UJ7B1wOKCrOOoPKfwF20w2YLUxK', 'manager', 'cat.jpg', ''),
(459, 'Yoav', 'Kugler', 543621721, 'yoav@gmail.com', '$2y$10$ldhc.XOiqnDZnBp83Ce3tuOY6RNKwKhhY.frogLaQ6Xr/jsBkgMTW', 'manager', 'zoo.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
