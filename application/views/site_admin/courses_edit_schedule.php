<?php 
	include 'table_constants.php';
	
	$lectureID = $this->uri->segment(4, 0);
	$selected = $this->uri->segment(5, 0);
	$lectureInfo = $this->lectures_model->getLectureInfo($lectureID);

	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; <a href="'.base_url().'site_admin/courses/edit_course/'.$lectureInfo->lectureClass.'/3">'.$this->classes_model->getClassTitle($lectureInfo->lectureClass).'</a> &raquo; Edit Schedule';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	$(document).ready(function() 
	{
		$('#tabs').tabs({ selected: <?php echo $selected ?> });
	});
</script>

<h2>Edit Schedule '<?php echo $lectureInfo->lectureTopic;?>'</h2>

<div id="tabs">
	<ul>
		<li><a href="#scheduleInformationTab">Schedule Information</a></li>
		<li><a href="#resourceTab">Resources</a></li>
		<li><a href="#announcementsTab">Announcements</a></li>
	</ul>
	
	<div id="scheduleInformationTab">
    </div>
    
    <div id="resourceTab">
    </div>
    
    <div id="announcementsTab">
    </div>
    
</div>

<?php $this->load->view('site_admin/footer'); ?>