<div id="main">
	<div id="level1">
		<div id="announcements">
			<h2>Announcements</h2>
            <?php echo $this->users_model->getId($this->session->userdata('email'))?>
			<p>
            Welcome to Chicago Review Courses Course Repository!
            </p>
		</div>

		<div id="recent">
			<h2>Recent Updates</h2>
            <p>
            Neurosergery Lecture 1 video uploaded - 01/05/2010
            </p>
			
		</div>
	</div>
</div>