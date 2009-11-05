<div id="main">
<script type="text/javascript"> javascript:changeClass('annNav'); </script>
	<div id="index_level1">
		<div id="announcements">
			<h2>Announcements</h2>
            <br />
<?php echo 'class admin = '.$this->users_model->isClassAdmin(2); ?>
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
			foreach ($announcement->result() as $a) {
				echo '
				<tr>       
					<td><a href="'.base_url().'student/index/'.$a->id.'"style="color: rgb(0,0,0)"><font color="000000"><u>'.$a->announcementTitle.'</u></font></a></td>
					<td>'.$this->classes_model->getClassTitle($a->announcementClass).'</td>
					<td>'.$a->announcementCreatedDate.'</td>          
				</tr>';
        }}?>
        
    </tbody>
</table>
		</div>
        <div id="announcement">
        <?php
			echo '
        	<h2>'.$topic.'</h2>
            <p>'.$message.'</p>
            <br/>'.$class.'
            <br/>'.$date;
		 ?>
            
	</div>
</div>
