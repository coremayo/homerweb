<?php 
	include 'table_constants.php';
	
	$courseID = $this->uri->segment(4, 0);
	$courseInfo = $this->classes_model->getClassInfo($courseID);

	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/courses/">Courses</a> &raquo; Edit Course';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	var addCourseAdminDialogTable;
	var courseAdminsTable;
	
	$(document).ready(function() 
	{
		$('#tabs').tabs();
		
		$("#end_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#start_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#eday").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#sday").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		
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
				'Add Students'	:	function() 
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
		
		$('#addStudentButton').click
		(
			function(data)
			{
				$("#addStudentDialog").dialog("open");
			}
		);
		
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
		
		$("#studentsTable input[name='select_user_all']").change
		(
			function()
			{
				if ($("#studentsTable input[name='select_user_all']").attr('checked'))
				{
					$('td input', studentsTable.fnGetNodes()).attr({checked: 'checked'});
				}
				else
				{
					$('td input', studentsTable.fnGetNodes()).attr({checked: ''});
				}
			}
		)

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
				'Add Students'	:	function() 
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

		$('#addCourseAdminButton').click
		(
			function(data)
			{
				$("#addCourseAdminDialog").dialog("open");
			}
		);

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
		
		
		
		scheduleTable = $('#scheduleTable').dataTable( 
		{
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		$('#addItemButton').click
		(
			function(data)
			{
				$("#addItemDialog").dialog("open");
			}
		);
		
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
		
		
	});
</script>

<h2>Edit Course '<?php echo $courseInfo->classTitle;?>'</h2>

<div id="tabs">
	<ul>
		<li><a href="#courseInformationTab">Course Information</a></li>
		<li><a href="#courseAdminsTab">Course Admins</a></li>
		<li><a href="#studentTab">Students</a></li>
		<li><a href="#scheduleTab">Schedule</a></li>
	</ul>
	
	<div id="courseInformationTab">
		<form action="<?php echo base_url();?>site_admin/db_editCourseInfo" method="POST">
		
			<input type="hidden" name="id" value="<?php echo $courseID;?>">
			
			<table width="700px" class="outer">
				<tr>
					<td>
						<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
							<tr height="40px">
								<td colspan="2" class="formHeading">Edit Course Information </td>
							</tr>
	
							<tr>
								<td colspan="2" class="note" bgcolor="#E8E8E8"><span class="red">*</span> indicates a required field</td>
							<tr>
	
							<tr height="10px">
								<td colspan="2"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Title<span class="red">*</span></td>
								<td width ="68%"><input type="text" name="title" size="35" maxlength"50" class="input" value="<?php echo $courseInfo->classTitle;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Description</td>
								<td width ="68%"><textarea name="description" cols="60" rows="10" class="input"><?php echo $courseInfo->classDesc;?></textarea></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Price<span class="red">*</span></td>
								<td width ="68%">$<input type="text" name="price" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classPrice;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Start Date<span class="red">*</span></td>
								<td width ="68%"><input type="text" id="start_date" name="start_date" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classStartDate;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">End Date<span class="red">*</span></td>
								<td width ="68%"><input type="text" id="end_date" name="end_date" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classEndDate;?>"></td>
							</tr>
	
							<tr>
								<td align="right" bgcolor="#E8E8E8" width="32%">Subscription Length<span class="red">*</span></td>
								<td width ="68%"><input type="text" name="subscription_length" size="10" maxlength"10" class="input" value="<?php echo $courseInfo->classSubLength;?>"></td>
							</tr>
	
							<tr>
								<td></td>
								<td height="30">
									<button type="submit">Save Changes</button>
									<button type="button" onclick="window.location.href='<?php echo base_url();?>site_admin/courses'">Cancel</button>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="courseAdminsTab">
		<form name="addAdmin" action="<?php echo base_url();?>site_admin/db_editCourseAdmins" method="POST">
        	<input type="hidden" name="id" value="<?php echo $courseID;?>">
        	<input type="hidden" name="classID" value="<?php echo $courseInfo->classAdmins;?>">
            <input type="hidden" name="selected_admins" value="none">

			<button type="button" class="addButton" id="addCourseAdminButton">Add Course Admin</button>
			
			<?php
				$data['ID'] = 'courseAdminsTable';
				$data['TABLE'] = array(SHOW_ADMINS_IN_COURSE, $courseID);
				$data['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD | REGDATE_FIELD | ACTIVE_FIELD;
				$this->load->view('site_admin/table', $data);
			?>
			
			<div id="addCourseAdminDialog" title="Add Course Admins">
				<?php
					$dialogData['ID'] = 'addCourseAdminDialogTable';
					$dialogData['TABLE'] = array(SHOW_ADMINS_NOT_IN_COURSE, $courseID);
					$dialogData['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD;
					$this->load->view('site_admin/table', $dialogData);
				?>
			</div>
		</form>
	</div>
	
	<div id="studentTab">
		<form name="addStudent" action="<?php echo base_url();?>site_admin/db_editCourseStudents" method="POST">
			<input type="hidden" name="id" value="<?php echo $courseID;?>">
			<input type="hidden" name="classID" value="<?php echo $courseInfo->classAdmins;?>">
			<input type="hidden" name="selected_students" value="none">

			<button type="button" class="addButton" id="addStudentButton">Add Student</button>

			<?php
				$data['ID'] = 'studentTable';
				$data['TABLE'] = array(SHOW_STUDENTS_IN_COURSE, $courseID);
				$data['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD | REGDATE_FIELD | ACTIVE_FIELD;
				$this->load->view('site_admin/table', $data);
			?>

			<div id="addStudentDialog" title="Add Students">
				<?php
					$dialogData['ID'] = 'addStudentDialogTable';
					$dialogData['TABLE'] = array(SHOW_STUDENTS_NOT_IN_COURSE, $courseID);
					$dialogData['FIELDS'] = SELECT_FIELD | EMAIL_FIELD | FNAME_FIELD | LNAME_FIELD;
					$this->load->view('site_admin/table', $dialogData);
				?>
			</div>
		</form>
	</div>
	
	<div id="scheduleTab">
		<button type="button" class="addButton" id="addItemButton">Add Items</button>

		<?php
			$data['ID'] = 'scheduleTable';
			$data['TABLE'] = array(SHOW_SCHEDULE_IN_COURSE, $courseID);
			$data['FIELDS'] = TOPIC_FIELD | STARTTIME_FIELD | ENDTIME_FIELD | ADMIN_FIELD;
			$this->load->view('site_admin/table', $data);
		?>

		<div id="addItemDialog" title="Add Item">
			<form name="addItem" action="<?php echo base_url();?>site_admin/db_editCourseSchedule" method="POST">
				<table width="400px" class="outer">
					<tr>
						<td>
							<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
								<tr height="40px">
									<td colspan="2" class="formHeading">Add New Item</td>
								</tr>
	
								<tr height="10px">
									<td colspan="2"></td>
								</tr>
	
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">Topic</td>
									<td width ="68%"><input type="text" name="topic" size="35" maxlength"50" class="input"></td>
								</tr>
								
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">Lecture Admin</td>
									<td width ="68%"><input type="text" name="topic" size="35" maxlength"50" class="input"></td>
								</tr>
	
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">Start Time</td>
									<td width ="68%">
										Date: <input id="sday" type="text" name="sday" size="20" maxlength"20" class="input">
										<br>
										<br>
										Time: <input id="stime_hr" type="text" name="stime_hr" size="2" maxlength"2" class="input"> 
										: <input id="stime_min" type="text" name="stime_min" size="2" maxlength"2" class="input">

										<select name="stime_am_pm">
											<option value="AM" selected>AM</option
											<option value="PM">PM</option>
										</select>
									</td>
								</tr>
	
								<tr>
									<td align="right" bgcolor="#E8E8E8" width="32%">End Time</td>
									<td width ="68%">
										Date: <input id="eday" type="text" name="eday" size="20" maxlength"20" class="input">
										<br>
										<br>
										Time: <input id="etime_hr" type="text" name="etime_hr" size="2" maxlength"2" class="input"> 
										: <input id="etime_min" type="text" name="etime_min" size="2" maxlength"2" class="input">

										<select name="etime_am_pm">
											<option value="AM" selected>AM</option
											<option value="PM">PM</option>
										</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('site_admin/footer'); ?>