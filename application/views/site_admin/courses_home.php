<?php $this->load->view('site_admin/header'); ?>

<div id="breadcrumb">
	Courses &raquo; Home
</div>

<?php if ($this->session->flashdata('type'))
	  {
		echo '<div class="'.$this->session->flashdata('type').'">
			  '.$this->session->flashdata('msg').'
			  </div>';
	  }
?>

<div id="content">
	<h2>Current Courses</h2>
	<hr>
	<br>

	<div id="add_new_course_link">
		<img src="<?php echo base_url();?>images/site_admin/add_user.gif" alt="Add Course Image" />
		<div id="description">
			<a href="<?php echo base_url();?>site_admin/courses/add_course">Add New Course</a>
		</div>
	</div>

	<div id="table">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>Price</th>
					<th>Users Group</th>
					<th>Admins Group</th>
					<th>Start Date</th>
					<th>End Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$classes = $this->classes_model->getAllClasses();

					foreach ($classes as $class)
					{
						$title = $class->classTitle;
						$desc = $class->classDesc;
						$price = $class->classPrice;
						$users = $class->classUsers;
						$admins = $class->classAdmins;
						$start = $class->classStartDate;
						$end = $class->classEndDate;
						
						if ($price == 0)
						{
							$price = '$0.00';
						}
						else
						{
							$price = '$'.$price;
						}

						echo '
							<tr>
								<td><a href="'.base_url().'site_admin/courses/edit_course/'.$class->id.'">'.$title.'</a></td>
								<td>'.$desc.'</td>
								<td>'.$price.'</td>
								<td>'.$users.'</td>
								<td>'.$admins.'</td>
								<td>'.$start.'</td>
								<td>'.$end.'</td>
							</tr>';
					}
				?>	
			</tbody>
		</table>
	</div>
</div>

<?php $this->load->view('site_admin/footer'); ?>