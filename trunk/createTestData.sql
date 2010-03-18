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
(7, 'david@test.com', 'David', 'Laborde', 'cfadc7dc40efa15e1bfa4ab8c2680cb81c6b9c0e', '2009-11-27', 1),
(8, 'robertCombo@gmail.com', 'Robert', 'Billinghurst', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(9, 'turner@gmail.com', 'Tim', 'Turner', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(10, 'buckman@gmail.com', 'John', 'Buckman', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(11, 'simons@gmail.com', 'Mike', 'Simons', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(12, 'rock@gmail.com', 'Susan', 'Rock', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(13, 'button@gmail.com', 'Mary', 'Button', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(14, 'striker@gmail.com', 'Tom', 'Striker', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(15, 'racer@gmail.com', 'Speed', 'Racer', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2009-11-26', 1),
(16, 'd@d.com', 'd', 'd', 'a9993e364706816aba3e25717850c26c9cd0d89d', '2010-3-15', 1);


INSERT INTO `group` (`id`, `groupName`) VALUES
(1, 'Site Admins'),
(2, 'Neurosurgery Review Course 2009 Admins'),
(3, 'Rar Admins'),
(4, 'Neuro 2007 Admins');

INSERT INTO `group_has_user` (`group_id`, `user_id`) VALUES
(1, 1),
(1, 4),
(1, 7),
(2, 5),
(3, 5),
(4, 8);

INSERT INTO `site` (`id` ,`siteAdmins` ,`siteName`)
VALUES ('1', '1', 'Chicago Review Courses');

INSERT INTO `class` (`id`, `classTitle`, `classDesc`, `classPrice`, `classSubLength`, `classAdmins`, `classStartDate`, `classEndDate`, `classSite`) VALUES
(1, 'Neurosurgery Review Course 2009', 'This rigorous eleven-day review in neurosurgery is now a traditional learning experience for residents, newly established neurosurgeons, and seasoned surgeons who want to ensure that their diagnostic and surgical skills are current.Lecture content reflects the ongoing clinical developments in the field and what constitutes optimal care in diagnostic and therapeutic approaches, as well as the management of complications.', 19.95, 60, 2, '2009-01-29', '2009-02-08', 1),
(2, 'Rar', 'This is an example description for the Rar class.', 15.99, 70, 3, '2009-9-15', '2009-10-28', 1),
(3, 'Neuro 2007', 'This is an example description for the Neuro 2007 class.', 29.99, 120, 4, '2006-7-24', '2007-10-03', 1),
(4, 'Brain 2009', 'This is an example description for the Brain 2009 class.', 59.99, 30, 1, '2009-011-12', '2009-12-04', 1),
(5, 'Upcoming 2009', 'This is an example description for the Upcoming 2009 class.', 79.99, 20, 1, '2010-01-05', '2010-01-25', 1),
(6, 'Cancer 2010', 'This is an example description for the Cancer 2010 class.', 69.99, 20, 1, '2010-02-14', '2010-03-22', 1),
(7, 'Neurology 2009', 'This is an example description for the Neurology 2010 class.', 49.99, 20, 1, '2009-09-08', '2010-06-15', 1);

INSERT INTO `subscription` (`id` ,`subscriptionStartDate` ,`subscriptionEndDate` ,`subscriptionClass` ,`subscriptionUser`)
VALUES ('1', '2009-10-05', '2019-11-30', '1', '2'),
		('2', '2009-10-05', '2019-11-28', '2', '2'),
		('3', '2006-10-05', '2007-11-25', '3', '2'),
		('4', '2009-10-05', '2019-11-30', '1', '3'),
		('5', '2009-10-05', '2019-11-28', '2', '3'),
		('6', '2006-10-05', '2007-11-25', '3', '3');

INSERT INTO `announcement` (`id` ,`announcementCreatedDate` ,`announcementTitle` ,`announcementMessage` ,`announcementFrom` ,`announcementClass`)
VALUES ( '1', '2009-01-28', 'Welcome to Neurosurgery Review Course 2009!', 'Please check out the courses tab to view uploaded resources.', '1', '1'),
( '2', '2009-01-30', 'Jan 29 Video uploaded', 'Jan 29 lecture video has been uploaded', '1', '1'),
( '3', '2009-02-01', 'Spinal Tumors and Mimics lecture notes uploaded', 'Take a look at the lecture notes', '1', '1'),
( '4', '2009-01-28', 'Substitute Speaker', 'I will not be able to speak about Acute Stroke Treatment on Thursday, but Dr. Nelson will take my place.', '1', '1'),
( '5', '2005-10-05', 'Cant See me', 'Shouldnt be able to see this!', '1', '3');

INSERT INTO `lecture` (`id`, `lectureTopic`, `lectureClass`, `lectureStartTime`, `lectureEndTime`, `lectureAdmin`) 
VALUES ('1', 'Introduction', '1', '2009-01-29 07:30:00', '2009-01-29 07:45:00', '9'),
('2', 'Neuropathies & Myopathies & Motor Neuron Diseases & EMG', '1', '2009-01-29 07:45:00', '2009-01-29 09:45:00', '10'),
('3', 'Pediatric Neurology', '1', '2009-01-29 10:00:00', '2009-01-29 12:00:00', '13'),
('4', 'Basic Stroke Syndromes and Diagnosis', '1', '2009-01-29 13:00:00', '2009-01-29 14:00:00', '6'),
('5', 'Acute Stroke Treatment', '1', '2009-01-29 14:00:00', '2009-01-29 15:00:00', '8'),
('6', 'Stroke Prevention', '1', '2009-01-29 15:00:00', '2009-01-29 16:00:00', '11'),
('7', 'Surgery of the Cranial Nerves', '1', '2009-01-29 16:15:00', '2009-01-29 17:30:00', '12'),
('8', 'Demyelinating Disorders', '1', '2009-01-29 16:15:00', '2009-01-29 17:30:00', '12'),
('9', 'Anatomy: The Brain Surface(with f-MRI)', '1', '2009-01-30 07:30:00', '2009-01-30 08:30:00', '14'),
('10', 'Ischemic Stroke', '1', '2009-01-30 08:30:00', '2009-01-30 09:15:00', '15'),
('11', 'Intracranial Hemorrhage', '1', '2009-01-30 09:35:00', '2009-01-30 10:25:00', '9'),
('12', 'Birth: HIE & Hemorrhage', '1', '2009-01-30 10:25:00', '2009-01-30 11:00:00', '10'),
('13', 'Rar Fundamentals', '2', '2009-10-19 07:15:09', '2009-10-19 08:50:14', '12'),
('14', 'Dusty Brain', '3', '2006-12-19 07:15:09', '2006-12-19 08:50:14', '1');

INSERT INTO `resource` (`id`, `resourceTitle`, `resourceDescription`, `resourceLocation`, `resourceType`, `resourceCreatedDate`) VALUES
(1, 'syllabus', 'The syllabus for the class.', 'http://localhost/homerweb/resources/Neurosurgery Review Course 2009/Introduction/syllabus.pdf', 'pdf', '2009-10-27'),
(2, 'lecture_notes', 'Notes for this lecture', 'http://localhost/homerweb/resources/Neurosurgery Review Course 2009/Introduction/lecture_notes.pdf', 'pdf', '2009-10-27'),
(3, 'sample_presentation', 'A sample lecture presentation', 'http://localhost/homerweb/resources/Neurosurgery Review Course 2009/Introduction/sample_presentation.pptx', 'pptx', '2009-10-28'),
(4, 'sample_video(FLV)', 'A test video (FLV version). See if it plays embedded in a web browser.', 'http://localhost/homerweb/resources/Neurosurgery Review Course 2009/Introduction/sample_video(FLV).flv', 'flv', '2010-3-15'),
(5, 'sample_video', 'A test video. See if it plays embedded in a web browser.', 'http://localhost/homerweb/resources/Neurosurgery Review Course 2009/Introduction/sample_video.wmv', 'wmv', '2009-10-28');

INSERT INTO `lecture_has_resource` (`lecture_id`, `resource_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'main_banner_image', 'back_disabled.jpg'),
(2, 'main_banner_border', '#bd3ad9'),
(3, 'main_banner_text_color', '#12345'),
(4, 'main_banner_text', ''),
(5, 'main_background_color', '#12345'),
(6, 'main_header_color', '#12345'),
(7, 'main_header_text_color', '#12345'),
(8, 'main_header_border', '#12345'),
(9, 'main_module_background_color', '#12345'),
(10, 'main_module_background_image', 'doctor.jpg'),
(11, 'main_footer_border', '#12345'),
(12, 'main_footer_background_image', 'back_disabled.jpg'),
(13, 'main_inactive_tab_background_color', '#12345'),
(14, 'main_inactive_tab_background_image', 'back_disabled.jpg'),
(15, 'main_inactive_tab_border', ''),
(16, 'main_inactive_tab_text_color', '#dd4646'),
(17, 'main_inactive_tab_hover_border', '#12345'),
(18, 'main_inactive_tab_hover_background', '#12345'),
(19, 'main_inactive_tab_hover_text_color', '#12345'),
(20, 'main_active_tab_background', '#12345'),
(21, 'main_active_tab_border', '#12345'),
(22, 'main_active_tab_text_color', '#12345'),
(23, 'main_tab_content_border', '#12345'),
(24, 'main_about_us', ''),
(25, 'main_qbank', '');
