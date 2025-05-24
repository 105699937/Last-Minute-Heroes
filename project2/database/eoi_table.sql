CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `job_reference` varchar(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skill1` varchar(50) NOT NULL DEFAULT "Not selected",
  `skill2` varchar(50) NOT NULL DEFAULT "Not selected",
  `skill3` varchar(50) NOT NULL DEFAULT "Not Selected",
  `other_skills` text NOT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT "New"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 