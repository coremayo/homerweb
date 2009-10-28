<?php 
$data['breadcrumb'] = 'Courses &raquo; Home';
$this->load->view('site_admin/header', $data); 
?>

<div id="content">
	<h2>All Courses</h2>
	<hr>
	<br>

	<div id="add_new_course_link">
		<img src="<?php echo base_url();?>images/site_admin/add_user.gif" alt="Add Course Image" />
		<div id="description">
			<a href="<?php echo base_url();?>site_admin/courses/add_course">Add New Course</a>
		</div>
	</div>

	<div id="table">
		<?php 
			$data['show_all'] = '';
			$this->load->view('site_admin/table_courses', $data);
		?>
	</div>
</div>

<?php $this->load->view('site_admin/footer'); ?>