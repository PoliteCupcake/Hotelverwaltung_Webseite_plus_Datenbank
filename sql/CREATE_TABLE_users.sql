CREATE TABLE `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `usersAnrede` varchar(50) DEFAULT NULL,
  `usersNachname` varchar(255) NOT NULL,
  `usersVorname` varchar(255) NOT NULL,
  `usersEmail` varchar(255) NOT NULL,
  `usersPassword` varchar(255) NOT NULL,
  `usersUid` varchar(255) NOT NULL,
  `usersTyp` varchar(12) NOT NULL DEFAULT 'guest',
  `usersStatus` varchar(12) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`usersId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4	