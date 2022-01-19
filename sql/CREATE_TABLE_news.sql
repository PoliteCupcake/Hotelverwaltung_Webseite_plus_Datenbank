CREATE TABLE `news` (
  `newsid` int(11) NOT NULL AUTO_INCREMENT,
  `newsfile_path` varchar(255) NOT NULL,
  `newstitle` varchar(255) NOT NULL,
  `newsarticle` varchar(255) NOT NULL,
  `newsdate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`newsid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4	
