<?php
	include 'table_constants.php';
	$data['breadcrumb'] = 'Courses &raquo; Home';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	var coursesTable;
	
	$(document).ready(function() 
	{
		coursesTable = $('#coursesTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
	});
</script>

<div id="content">
	<h2>All Courses</h2>
	<hr>
	<br>

	<?php if($siteAdmin){ echo '<button type="button" class="addButton" id="addNewCourseButton" onclick="window.location.href=\''.base_url().'site_admin/courses/add_course\'">Add New Course</button>';}?>

	<?php 
	
	if($siteAdmin){
		$data['ID'] = 'coursesTable';
		$data['TABLE'] = array(SHOW_ALL_COURSES, null);
		$data['FIELDS'] = TITLE_FIELD | DESC_FIELD | PRICE_FIELD | SUBLENGTH_FIELD | USERS_FIELD | ADMINS_FIELD | STARTDATE_FIELD | ENDDATE_FIELD;
		$this->load->view('site_admin/table', $data);
	}else{
		$data['ID'] = 'coursesTable';
		$data['TABLE'] = array(SHOW_ALL_ADMIN_COURSES, $this->users_model->getId($this->session->userdata('email')));
		$data['FIELDS'] = TITLE_FIELD | DESC_FIELD | PRICE_FIELD | SUBLENGTH_FIELD | USERS_FIELD | ADMINS_FIELD | STARTDATE_FIELD | ENDDATE_FIELD;
		$this->load->view('site_admin/table', $data);
	}
	?>
</div>

<?php $this->load->view('site_admin/footer'); ?>