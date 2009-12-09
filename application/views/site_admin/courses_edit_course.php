<?php 
	include 'table_constants.php';
	
	$courseID = $this->uri->segment(4, 0);
	$selected = $this->uri->segment(5, 0);
	$courseInfo = $this->classes_model->getClassInfo($courseID);
	$thisCourseAdmin = $this->users_model->isCourseAdminOf($this->users_model->getId($this->session->userdata('email')), $courseID);
	// Kick them from this page if they arent a site, course, or lecture admin of this course
	if(!$siteAdmin && !$this->users_model->isAdminOf($this->users_model->getId($this->session->userdata('email')), $courseID)){
		$data['siteAdmin'] = $siteAdmin;
		$this->load->view('site_admin/unauthorized', $data);
		return;
	}


	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; Edit Course';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	var addCourseAdminDialogTable;
	var courseAdminsTable;
	var subIDs;
	
	$(document).ready(function() 
	{
		$('#tabs').tabs({ selected: <?php echo $selected ?> });
		
		$("#end_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#start_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#eday").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#sday").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		
		$("#setStart").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#setEnd").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$('.extStart').hide();
		$('.extEnd').hide();
	
		$("input[name='edit_option']").change(
			function()
			{
				$('.extStart').toggle();
				$('.extEnd').toggle();
				$('.setStart').toggle();
				$('.setEnd').toggle();
			}
		);
		
		<!-- Course Admin tables, dailogs, and buttons -->
		
		addCourseAdminDialogTable = $('#addCourseAdminDialogTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});

		courseAdminsTable = $('#courseAdminsTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});

		$("#addCourseAdminDialog").dialog
		({
			bgiframe: true,
			height: 500,
			width: 800,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: 
			{
				'Cancel'			:	function() 
										{
											$(this).dialog('close');
										}
				,			
				'Add Admin'	:	function() 
										{
											var data = $('input', addCourseAdminDialogTable.fnGetNodes()).serialize();

											if (data == '')
											{
												$("input[name='selected_admins']").val('none');

											}
											else
											{
												$("input[name='selected_admins']").val(data);
												document.addAdmin.submit();

											}

											$(this).dialog('close');
										}
			}
		});
		
		$("#addCourseAdminDialog input[name='select_user_all']").change
		(
			function()
			{
				if ($("#addCourseAdminDialog input[name='select_user_all']").attr('checked'))
				{
					$('td input', addCourseAdminDialogTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', addCourseAdminDialogTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)

		$("#courseAdminsTable input[name='select_user_all']").change
		(
			function()
			{
				if ($("#courseAdminsTable input[name='select_user_all']").attr('checked'))
				{
					$('td input', courseAdminsTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', courseAdminsTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)

		$('#addCourseAdminButton').click
		(
			function(data)
			{
					$("#addCourseAdminDialog").dialog("open");
			}
		);
		
		$('#deleteCourseAdminButton').click
		(
			function(data)
			{
				var data = $('input', courseAdminsTable.fnGetNodes()).serialize();
				
				if (data == '')
				{
					$("#alert").dialog("open");
				}
				else
				{
					$("input[name='selected_admins']").val(data);
					document.deleteAdmin.submit();
				}
			}
		);
		
		<!-- Student and subscription tables, dailogs, and buttons -->
		
		addStudentDialogTable = $('#addStudentDialogTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		studentTable = $('#studentTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		
		
		$("#addStudentDialog").dialog
		({
			bgiframe: true,
			height: 500,
			width: 800,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: 
			{
				'Cancel'			:	function() 
										{
											$(this).dialog('close');
										}
				,			
				'Add Subscriptions'	:	function() 
										{
											var data = $('input', addStudentDialogTable.fnGetNodes()).serialize();
	
											if (data == '')
											{
												$("input[name='selected_students']").val('none');

											}
											else
											{
												$("input[name='selected_students']").val(data);
												document.addStudent.submit();
												
											}
	
											$(this).dialog('close');
										}
			}
		});
		
		$("#editSubDialog").dialog
		({
			bgiframe: true,
			height: 400,
			width: 500,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: 
			{
				'Cancel'			:	function() 
										{
											
											$("input[name='setStart']").val('');
											$("input[name='setEnd']").val('');
											$("input[name='extStart']").val('');
											$("input[name='extEnd']").val('');
											$(this).dialog('close');
										}
				,			
				'Save Changes'	:		function() 
										{
											var data = $('input', studentTable.fnGetNodes()).serialize();
	
											if (data == '')
											{
												$("input[name='selected_subs']").val('none');

											}
											else
											{
												$("input[name='selected_subs']").val(data);
												document.editSubs.submit();
												
											}
	
											$(this).dialog('close');
										}
			}
			
		});
		
		$("#addStudentDialog input[name='select_user_all']").change
		(
			function()
			{
				if ($("#addStudentDialog input[name='select_user_all']").attr('checked'))
				{
					$('td input', addStudentDialogTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', addStudentDialogTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)
		
		$("#studentTable input[name='select_user_all']").change
		(
			function()
			{
				if ($("#studentTable input[name='select_user_all']").attr('checked'))
				{
					$('td input', studentTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', studentTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)
		
		$('#deleteSubButton').click
		(
			function(data)
			{
				var data = $('input', studentTable.fnGetNodes()).serialize();
				
				if (data == '')
				{
					$("#alert").dialog("open");
				}
				else
				{
					$("input[name='selected_subs']").val(data);
					document.deleteSub.submit();
				}
			}
		);

		$('#addStudentButton').click
		(
			function(data)
			{
				$("#addStudentDialog").dialog("open");
			}
		);
		
		$('#editSelectedButton').click
		( 	
		 function(data){
			var x = $('input', studentTable.fnGetNodes()).serialize();
			if (x == ''){
				$("#alert").dialog("open");
			}
			else{
				$("#editSubDialog").dialog("open");
			}
		 }
		);
		
		<!-- Alert dailog -->
		
		$("#alert").dialog
		({
			bgiframe: true,
			height: 100,
			width: 200,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			title: 'Warning:',
			buttons: 
			{
				'OK'			:	function() 
										{
											$(this).dialog('close');
										}

			}
			
		});
		
		<!-- Schedule and lecture tables, dailogs, and buttons -->
		
		selectLectureAdminDialogTable = $('#selectLectureAdminDialogTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		
		scheduleTable = $('#scheduleTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		$("#addItemDialog").dialog
		({
			bgiframe: true,
			height: 400,
			width: 500,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: 
			{
				'Cancel'			:	function() 
										{
											$(this).dialog('close');
										}
				,			
				'Add Item'	:	function() 
										{
											document.addItem.submit();
											$(this).dialog('close');
										}
			}
		});
		
		$("#selectLectureAdminDialog").dialog
		({
			bgiframe: true,
			height: 500,
			width: 800,
			modal: true,
			resizable: false,
			draggable: false,
			autoOpen: false,
			buttons: 
			{
				'Cancel'			:	function() 
										{
											$(this).dialog('close');
										}
				,			
				'Add Admin'	:	function() 
										{
											var data = $('input', selectLectureAdminDialogTable.fnGetNodes()).serialize();

											if (data == '')
											{
												$("input[name='selected_admins']").val('none');

											}
											else
											{
												$("input[name='selected_admins']").val(data);

											}

											$(this).dialog('close');
										}
			}
		});
		
		$('#addItemButton').click
		(
			function(data)
			{
				$("#addItemDialog").dialog("open");
			}
		);

		$('#selectLectureAdminButton').click
		(
			function(data)
			{
					$("#selectLectureAdminDialog").dialog("open");
			}
		);
		
		
	});
	

</script>

<h2>Edit Course '<?php echo $courseInfo->classTitle;?>'</h2>

<div id="tabs">
	<ul>
		<?php // Display Information, admin, and student tab only if site or course admin
		if($siteAdmin || $thisCourseAdmin){ 
		echo '<li><a href="#courseInformationTab">Course Information</a></li>
			  <li><a href="#courseAdminsTab">Course Admins</a></li>
			  <li><a href="#studentTab">Subscriptions</a></li>';}?>
			  <li><a href="#scheduleTab">Schedule</a></li>
	</ul>
     
	<?php // Display Information, admin, and student sections only if site or course admin
		if($siteAdmin || $thisCourseAdmin){
			$data['courseID'] = $courseID;
			$data['courseInfo'] = $courseInfo;
			$this->load->view('site_admin/courses_edit_course_information', $data);
			$this->load->view('site_admin/courses_edit_course_admins', $data);
			$this->load->view('site_admin/courses_edit_course_students', $data);
		 }
		?>

	<?php // Always show this
			$data['courseID'] = $courseID;
			$data['courseInfo'] = $courseInfo;
			$data['siteAdmin'] = $siteAdmin;
			$data['thisCourseAdmin'] = $thisCourseAdmin;
			$this->load->view('site_admin/courses_edit_course_schedule', $data);
		?>
</div>

<?php $this->load->view('site_admin/footer'); ?>