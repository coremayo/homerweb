<div id="main">
	<div id="level1">
		<div id="announcements">
			<h2>Announcements</h2>
            <?php $result = $this->announcements_model->getStudentAnnouncements($this->users_model->getId($this->session->userdata('email')));
            	foreach ($result as $announcement) {
				foreach ($announcement->result() as $a) {echo($a->announcementMessage);}}?> 
		</div>

		<div id="recent">
			<h2>Recent Updates</h2>
            <p>
            Neurosergery Lecture 1 video uploaded - 01/05/2010
            </p>
			
		</div>
	</div>
</div>