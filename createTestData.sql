USE cs4911;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userEmail`, `userFirstName`, `userLastName`, `userPasswdHash`, `userRegistrationDate`, `userActive`) VALUES
(1, 'me@yahoo.com', 'Jason', 'Faulk', 'cffb0d21c420fdda412eab787bb5fa8e9a62bcd0', '2009-10-19', 1),
(2, 'robert@gmail.com', 'Robert', 'Billinghurst', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-10-04', 1),
(3, 'jonny@gmail.com', 'Jonny', 'L', 'cd863cad8b0b08b0fb64979298ed9ad7ea5c73bb', '2009-10-26', 1),
(4, 'robertAdmin@gmail.com', 'Robert', 'Billinghurst', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(5, 'robertCAdmin@gmail.com', 'Robert', 'Billinghurst', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(6, 'robertLAdmin@gmail.com', 'Robert', 'Billinghurst', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(7, 'david@test.com', 'David', 'Laborde', 'cfadc7dc40efa15e1bfa4ab8c2680cb81c6b9c0e', '2009-11-27', 1);


INSERT INTO `group` (`id`, `groupName`) VALUES
(1, 'Site Admins'),
(2, 'Neuro 2009 Admins'),
(3, 'Rar Admins'),
(4, 'Neuro 2007 Admins');

INSERT INTO `group_has_user` (`group_id`, `user_id`) VALUES
(1, 1),
(1, 4),
(1, 7),
(2, 5),
(3, 5);

INSERT INTO `site` (`id` ,`siteAdmins` ,`siteName`)
VALUES ('1', '1', 'Chicago Review Courses');

INSERT INTO `class` (`id`, `classTitle`, `classDesc`, `classPrice`, `classSubLength`, `classAdmins`, `classStartDate`, `classEndDate`, `classSite`) VALUES
(1, 'Neuro 2009', 'This is an example description for the neuro 2009 class.', 19.95, 60, 2, '2009-10-05', '2010-10-30', 1),
(2, 'Rar', '', 15.99, 70, 3, '2009-10-05', '2009-10-28', 1),
(3, 'Neuro 2007', '', 29.99, 120, 4, '2006-10-05', '2007-10-25', 1);

INSERT INTO `subscription` (`id` ,`subscriptionStartDate` ,`subscriptionEndDate` ,`subscriptionClass` ,`subscriptionUser`)
VALUES ('1', '2009-10-05', '2019-11-30', '1', '2'),
		('2', '2009-10-05', '2019-11-28', '2', '2'),
		('3', '2006-10-05', '2007-11-25', '3', '2'),
		('4', '2009-10-05', '2019-11-30', '1', '3'),
		('5', '2009-10-05', '2019-11-28', '2', '3'),
		('6', '2006-10-05', '2007-11-25', '3', '3');

INSERT INTO `announcement` (`id` ,`announcementCreatedDate` ,`announcementTitle` ,`announcementMessage` ,`announcementFrom` ,`announcementClass`)
VALUES ( '1', '2010-10-05', 'Time Machine', 'Impossible!', '1', '1'),
( '2', '2007-10-07', 'Welcome', 'Welcome to Neuro 2009!', '1', '1'),
( '3', '2009-10-05', 'Welcome', 'Welcome to Rar!', '1', '2'),
( '4', '2003-10-02', 'What happens if I make this super long. Oh nooooooooooooooooooooooooooooooooooooooooooooooo', 'That topic was long!', '1', '2'),
( '5', '2005-10-05', 'Cant See me', 'Shouldnt be able to see this!', '1', '3');

INSERT INTO `lecture` (`id`, `lectureTopic`, `lectureClass`, `lectureStartTime`, `lectureEndTime`, `lectureAdmin`) 
VALUES ('1', 'Brain Tumors', '1', '2009-10-27 02:15:09', '2009-10-27 02:50:14', '1'),
('2', 'Brain Bleeding', '1', '2009-10-28 06:15:09', '2009-10-28 06:50:14', '1'),
('3', 'Brain Explosions', '1', '2009-10-28 07:15:09', '2009-10-28 08:50:14', '6'),
('4', 'Rar Fundamentals', '2', '2009-10-19 07:15:09', '2009-10-19 08:50:14', '6'),
('5', 'Dusty Brain', '3', '2006-12-19 07:15:09', '2006-12-19 08:50:14', '1');

INSERT INTO `resource` (`id`, `resourceTitle`, `resourceDescription`, `resourceLocation`, `resourceType`, `resourceCreatedDate`) VALUES
(1, 'syllabus', 'The syllabus for the class.', 'http://localhost/homerweb/resources/Neuro 2009/Brain Explosions/syllabus.pdf', 'pdf', '2009-10-27'),
(2, 'lecture_notes', 'Notes for this lecture', 'http://localhost/homerweb/resources/Neuro 2009/Brain Explosions/lecture_notes.pdf', 'pdf', '2009-10-27'),
(3, 'sample_presentation', 'A sample lecture presentation', 'http://localhost/homerweb/resources/Neuro 2009/Brain Explosions/sample_presentation.pptx', 'pptx', '2009-10-28'),
(4, 'sample_video', 'A test video. See if it plays embedded in a web browser.', 'http://localhost/homerweb/resources/Neuro 2009/Brain Explosions/sample_video.wmv', 'wmv', '2009-10-28');

INSERT INTO `lecture_has_resource` (`lecture_id`, `resource_id`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4);
