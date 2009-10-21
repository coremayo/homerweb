<div id="main">
	<div id="index_level1">
		<div id="announcements">
			<h2>Announcements</h2>
            <br />

		
        <table id="user_ann">
    <thead>
        <tr>
            <th>Topic</th>
            <th>Course</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    	<?php $result = $this->announcements_model->getStudentAnnouncements($this->users_model->getId($this->session->userdata('email')));
   		foreach ($result as $announcement) {
		foreach ($announcement->result() as $a) {?> 
        <tr>       
            <td><a href="<?php echo base_url();?>student/index/<?php echo($a->id)?>"><?php echo($a->announcementTitle);?></a></td>
            <td><?php echo($this->classes_model->getClassTitle($a->announcementClass));?></td>
            <td><?php echo($a->announcementCreatedDate);?></td>          
        </tr>
        <?php }}?>
        
    </tbody>
</table>
		</div>
        <div id="announcement">
        	<h2><?php echo($topic) ?></h2>
            <p><?php echo($message) ?></p>
           <br /><?php echo($class) ?>
           <br /><?php echo($date) ?>
            
	</div>
</div>