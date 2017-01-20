CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(75) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `type` int(11) NOT NULL,
  `otherType` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `location` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;