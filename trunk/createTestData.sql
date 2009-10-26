USE cs4911;
--
-- Dumping data for table `user`
--
INSERT INTO `user` (`id`, `userEmail`, `userFirstName`, `userLastName`, `userPasswdHash`, `userRegistrationDate`) VALUES
(1, 'me@yahoo.com', 'Jason', 'Faulk', 'cffb0d21c420fdda412eab787bb5fa8e9a62bcd0', '2009-10-19'),
(2, 'robert@gmail.com', 'Robert', 'Billinghurst', SHA1( 'abc' ), '2009-10-04');

INSERT INTO `group` (`id`, `groupName`) VALUES
(1, 'Site Admins'),
(2, 'Neuro 2009 Users'),
(3, 'Rar Admins'),
(4, 'Rar Users'),
(5, 'Neuro 2007 Admins'),
(6, 'Neuro 2007 Users'),
(7, 'Neuro 2009 Admins');

INSERT INTO `group_has_user` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(2, 2);

INSERT INTO `site` (`id` ,`siteAdmins` ,`siteName`)
VALUES ('1', '1', 'Chicago Review Courses');

INSERT INTO `class` (`id`, `classTitle`, `classDesc`, `classPrice`, `classUsers`, `classAdmins`, `classStartDate`, `classEndDate`, `classSite`) VALUES
(1, 'Neuro 2009', 'This is an example description for the neuro 2009 class.', 19.95, 2, 7, '2009-10-05', '2010-10-30', 1),
(2, 'Rar', '', 0, 4, 3, '2009-10-05', '2009-10-28', 1),
(3, 'Neuro 2007', '', 0, 6, 5, '2006-10-05', '2007-10-25', 1);

INSERT INTO `subscription` (`id` ,`subscriptionStartDate` ,`subscriptionEndDate` ,`subscriptionClass` ,`subscriptionUser`)
VALUES ('1', '2009-10-05', '2009-10-30', '1', '2'),
		('2', '2009-10-05', '2009-10-28', '2', '2'),
		('3', '2006-10-05', '2007-10-25', '3', '2');

INSERT INTO `announcement` (`id` ,`announcementCreatedDate` ,`announcementTitle` ,`announcementMessage` ,`announcementFrom` ,`announcementClass`)
VALUES ( '1', '2010-10-05', 'Time Machine', 'Impossible!', '1', '1'),
( '2', '2007-10-07', 'Welcome', 'Welcome to Neuro 2009!', '1', '1'),
( '3', '2009-10-05', 'Welcome', 'Welcome to Rar!', '1', '2'),
( '4', '2003-10-02', 'What happens if I make this super long. Oh nooooooooooooooooooooooooooooooooooooooooooooooo', 'That topic was long!', '1', '2'),
( '5', '2005-10-05', 'Cant See me', 'Shouldnt be able to see this!', '1', '3');

INSERT INTO `lecture` (`id`, `lectureTopic`, `lectureClass`, `lectureStartTime`, `lectureEndTime`, `lectureAdmin`) 
VALUES ('1', 'Brain Tumors', '1', '2009-10-27 02:15:09', '2009-10-27 02:50:14', '1'),
('2', 'Brain Bleeding', '1', '2009-10-28 06:15:09', '2009-10-28 06:50:14', '1'),
('3', 'Brain Explosions', '1', '2009-10-28 07:15:09', '2009-10-28 08:50:14', '2'),
('4', 'Rar Fundamentals', '2', '2009-10-19 07:15:09', '2009-10-19 08:50:14', '2'),
('5', 'Dusty Brain', '3', '2006-12-19 07:15:09', '2006-12-19 08:50:14', '1');