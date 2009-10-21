USE cs4911;
--
-- Dumping data for table `user`
--
INSERT INTO `user` (`id`, `userEmail`, `userFirstName`, `userLastName`, `userPasswdHash`, `userRegistrationDate`) VALUES
(1, 'me@yahoo.com', NULL, NULL, 'cffb0d21c420fdda412eab787bb5fa8e9a62bcd0', '2009-10-19'),
(2, 'robert@gmail.com', 'Robert', 'Billinghurst', SHA1( 'abc' ), '2009-10-04');

INSERT INTO `group` (`id` ,`groupName`)
VALUES (1, 'Site Admins'),
	   (2, 'Neuro 2009 Users');

INSERT INTO `site` (`id` ,`siteAdmins` ,`siteName`)
VALUES ('1', '1', 'Chicago Review Courses');

INSERT INTO `class` (`id` ,`classTitle` ,`classUsers` ,`classAdmins` ,`classStartDate` ,`classEndDate` ,`classSite`)
VALUES ('1', 'Neuro 2009', '2', '1', '2009-10-05', '2009-10-30', '1'),
		('2', 'Rar', '2', '1', '2009-10-05', '2009-10-21', '1'),
		('3', 'Neuro 2007', '2', '1', '2006-10-05', '2007-10-25', '1');

INSERT INTO `subscription` (`id` ,`subscriptionStartDate` ,`subscriptionEndDate` ,`subscriptionClass` ,`subscriptionUser`)
VALUES ('1', '2009-10-05', '2009-10-30', '1', '2'),
		('2', '2009-10-05', '2009-10-21', '2', '2'),
		('3', '2006-10-05', '2007-10-25', '3', '2');

INSERT INTO `announcement` (`id` ,`announcementCreatedDate` ,`announcementTitle` ,`announcementMessage` ,`announcementFrom` ,`announcementClass`)
VALUES ( '1', '2009-10-05', 'Welcome', 'Welcome to Neuro 2009!', '1', '1');